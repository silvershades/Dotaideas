<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserPostsResource;
use App\Http\Resources\UserStashResource;
use App\Models\Achievement;
use App\Models\Post;
use App\Models\ShopItem;
use App\Models\User;
use App\Models\UserShopItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function stash(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $validator = $this->checkValid($DATA);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {
            try {

                return response()->json([
                    'status' => 'success',
                    'stash_avatars' => UserStashResource::collection(
                        UserShopItems::leftJoin('shop_items', 'user_shop_items.shop_item_id', '=', 'shop_items.id')
                            ->where('user_shop_items.user_id', $DATA['user'])->where('shop_items.shop_item_category_id', 3)->get()
                    ),
                    'stash_unlocks' => UserStashResource::collection(
                        UserShopItems::leftJoin('shop_items', 'user_shop_items.shop_item_id', '=', 'shop_items.id')
                            ->where('user_shop_items.user_id', $DATA['user'])->where('shop_items.shop_item_category_id', 1)->get()
                    ),
                    'stash_post_bg_emerald' => UserStashResource::collection(UserShopItems::leftJoin('shop_items', 'user_shop_items.shop_item_id', '=', 'shop_items.id')
                        ->where('user_shop_items.user_id', $DATA['user'])->where('shop_items.id', 5)->whereNull('user_shop_items.consumed_on_post')->get()
                    ),
                    'stash_post_bg_golden' => UserStashResource::collection(UserShopItems::leftJoin('shop_items', 'user_shop_items.shop_item_id', '=', 'shop_items.id')
                        ->where('user_shop_items.user_id', $DATA['user'])->where('shop_items.id', 6)->whereNull('user_shop_items.consumed_on_post')->get()
                    ),
                    'stash_shards_purchase' => UserStashResource::collection(
                        UserShopItems::leftJoin('shop_items', 'user_shop_items.shop_item_id', '=', 'shop_items.id')
                            ->where('user_shop_items.user_id', $DATA['user'])->where('shop_items.shop_item_category_id', 4)->get()
                    ),
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => $e->getMessage(),

                ], 201);
            }

        }
    }

    public function name(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $validator = $this->checkValid($DATA);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {
            $user_name = User::where('id', $DATA['user'])->first()->name;
            return response()->json([
                'status' => 'success',
                'user_name' => $user_name,
            ], 201);
        }
    }

    public function rename(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $DATA['name'] = $request->input('name');
        $validator = $this->checkValidAndName($DATA);

        if (Auth::check() && Auth::id() == $DATA['user']) {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                $user = User::where('id', $DATA['user'])->first();
                $user->name = $DATA['name'];
                $user->save();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Name changed',
                ], 201);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Access denied',
            ], 201);
        }
    }

    public function posts(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $validator = $this->checkValid($DATA);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {
            return UserPostsResource::collection(Post::where('user_id', $DATA['user'])->orderBy('created_at', 'desc')->get());
        }
    }

    public function achievements(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $validator = $this->checkValid($DATA);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {
            $achievements = Achievement::where('user_id', $DATA['user'])->get();

            return response()->json([
                'status' => 'success',
                'achievements' => $achievements,
            ], 201);
        }
    }

    public function visibility(Request $request)
    {
        $DATA = [];
        $DATA['post'] = $request->input('post');
        $DATA['visibility'] = $request->input('visibility');
        $validator = $this->checkValidVisibility($DATA);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {

            $post = Post::where('id', $DATA['post'])->first();
            if ($post->is_flagged) {
                return response()->json([
                    'status' => 'error',
                ], 201);
            }
            $post->is_active = $DATA['visibility'];
            $post->save();

            return response()->json([
                'status' => 'success',
                'visibility' => $post->is_active,
            ], 201);
        }
    }

    public function avatar(Request $request)
    {
        $DATA = [];
        $DATA['user'] = $request->input('user');
        $validator = $this->checkValid($DATA);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator->errors(),
            ], 201);
        } else {
            $avatar = User::where('id', $DATA['user'])->first()->di_avatar;

            return response()->json([
                'status' => 'success',
                'avatar' => $avatar,
            ], 201);
        }

    }

    public function change_avatar(Request $request)
    {
        $DATA = [];
        $DATA['avatar'] = $request->input('avatar');
        if (Auth::check()) {
            $validator = $this->checkValidAvatar($DATA);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                //does the user actually have this item?
                $has_item = UserShopItems::where('user_id', Auth::id())->where('shop_item_id', $DATA['avatar'])->count();
                if ($has_item > 0) {
                    $shop_item = ShopItem::where('id', $DATA['avatar'])->first();
                    Auth::user()->di_avatar = $shop_item->img_path;
                    Auth::user()->save();
                    $avatar = $shop_item->img_path;

                    return response()->json([
                        'status' => 'success',
                        'avatar' => $avatar,
                    ], 201);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Error Validating',
                    ], 201);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Access denied.',
            ], 201);
        }
    }

    public function make_pro(Request $request)
    {
        $DATA = [];
        $DATA['bg'] = $request->input('bg');
        $DATA['post'] = $request->input('post');
        if (Auth::check()) {
            $validator = $this->checkValidMakePRo($DATA);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                //does the user actually have this item?
                if ($DATA['bg'] == 1) {
                    $bg = 5;
                } elseif ($DATA['bg'] == 2) {
                    $bg = 6;
                }
                $has_item = UserShopItems::where('user_id', Auth::id())->where('shop_item_id', $bg)->whereNull('consumed_on_post')->count();
                if ($has_item > 0) {
                    //does post belong to same user
                    $post = Post::where('id', $DATA['post'])->first();
                    if ($post && $post->user->id == Auth::id()) {
                        //does that post already has applied a style
                        $post_exists_with_style_already = UserShopItems::where('consumed_on_post', $DATA['post'])->count();
                        if ($post_exists_with_style_already <= 0) {

                            $shop_item = UserShopItems::where('user_id', Auth::id())->where('shop_item_id', $bg)->whereNull('consumed_on_post')->first();
                            $shop_item->consumed_on_post = $DATA['post'];
                            $shop_item->consumed_on_date = date("Y-m-d H:i:s");
                            $shop_item->save();

                            return response()->json([
                                'status' => 'success',
                            ], 201);
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'msg' => 'Post already styled',
                            ], 201);
                        }
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'msg' => 'Access denied.',
                        ], 201);
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'You dont have that item.',
                    ], 201);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Access denied.',
            ], 201);
        }
    }


    public function checkValid($DATA)
    {
        $validator = Validator::make($DATA, [
            'user' => 'required|exists:users,id',
        ]);
        return $validator;
    }

    public function checkValidAndName($DATA)
    {
        $validator = Validator::make($DATA, [
            'user' => 'required|exists:users,id',
            'name' => 'required|string|max:20',
        ]);
        return $validator;
    }

    public function checkValidVisibility($DATA)
    {
        $validator = Validator::make($DATA, [
            'post' => 'required|exists:posts,id',
            'visibility' => 'required|numeric',
        ]);
        return $validator;
    }

    public function checkValidAvatar($DATA)
    {
        $validator = Validator::make($DATA, [
            'avatar' => 'required|exists:shop_items,id',
        ]);
        return $validator;
    }

    public function checkValidMakePRo($DATA)
    {
        $validator = Validator::make($DATA, [
            'bg' => 'required|numeric',
            'post' => 'required|exists:posts,id',
        ]);
        return $validator;
    }
}
