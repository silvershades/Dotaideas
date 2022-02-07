<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Models\Coins;
use App\Models\ShopItem;
use App\Models\ShopItemCategory;
use App\Models\UserShopItems;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index()
    {
        $returnedItems = [];
        $shop_item_cats = ShopItemCategory::all();
        foreach ($shop_item_cats as $cat) {
            $newpos = [];
            $newpos['id'] = $cat->id;
            $newpos['name'] = $cat->name;
            $newpos['description'] = $cat->description;
            $newpos['data'] = ShopResource::collection(ShopItem::where('active', true)->where('shop_item_category_id', $cat->id)->get());
            $returnedItems[] = $newpos;
        }

        return JsonResource::collection($returnedItems);
    }

    public function balance()
    {
        $coins = 0;
        if (Auth::check()) {
            $coins = Auth::user()->coins->sum('amount');
        }

        return response()->json([
            'status' => 'success',
            'coins' => $coins,
        ], 201);
    }

    public function purchase(Request $request)
    {
        if (Auth::check()) {

            $DATA = [];
            $DATA['shop_item'] = (array)json_decode($request->input('shop_item'));

            $validator = $this->checkValid($DATA);

            try {
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Error Validating',
                        'errors' => $validator->errors(),
                    ], 201);
                } else {
                    //get item to buy
                    $shop_item = ShopItem::where('id', $DATA['shop_item']['id'])->first();
                    //check one time buy and avoid repeat buy
                    if ($shop_item->one_time_buy){
                        $qty_owned_by_user = UserShopItems::where('shop_item_id',$shop_item->id)->where('user_id',Auth::id())->count();
                        if ($qty_owned_by_user > 0){
                            return response()->json([
                                'status' => 'error',
                                'msg' => 'You already unlocked this item.',
                            ], 201);
                        }
                    }

                    //check balance
                    $balance = Auth::user()->coins->sum('amount');


                    if ($balance > 0 && $balance >= $shop_item->value) {
                        DB::beginTransaction();
                        //add item
                        $newITem = new UserShopItems();
                        $newITem->user_id = Auth::id();
                        $newITem->shop_item_id = $DATA['shop_item']['id'];
                        $newITem->save();
                        //deduct sale
                        $newCoinsSpent = new Coins();
                        $newCoinsSpent->user_id = Auth::id();
                        $newCoinsSpent->amount = $shop_item->value * -1;
                        $newCoinsSpent->reason = 'Sideshop purchase';
                        $newCoinsSpent->save();
                        DB::commit();
                        return response()->json([
                            'status' => 'success',
                            'msg' => 'Purchase successfully completed!',
                            'post_id' => $DATA['shop_item']['id'],
                        ], 201);
                    } else {
                        DB::rollBack();
                        return response()->json([
                            'status' => 'error',
                            'msg' => 'Insuficient founds.',
                        ], 201);
                    }
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Access denied',
                ], 201);
            }

        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Access denied',
            ], 201);
        }

    }

    public function checkValid($DATA)
    {
        $validator = Validator::make($DATA, [
            'shop_item.id' => 'required|exists:shop_items,id',
        ]);
        return $validator;
    }
}
