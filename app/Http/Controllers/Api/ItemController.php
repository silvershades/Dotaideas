<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroSpellsResource;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemAttribute;
use App\Models\ItemRecipe;
use App\Models\Post;
use App\Models\Spell;
use App\Models\SpellAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
    public function index(Item $item)
    {
        $item->post->views++;
        $item->post->save();
        return ItemResource::collection(Item::where('id', $item->id)->get());
    }

    public function spells(Item $item)
    {
        $post_id = $item->post->id;
        return HeroSpellsResource::collection(Spell::where('post_id', $post_id)->get());
    }

    public function getitem(Item $item)
    {
        return ItemResource::collection(Item::where('id', $item->id)->get());
    }

    public function store(Request $request)
    {
        $DATA = [];
        $DATA['item'] = (array)json_decode($request->input('item'));
        $DATA['spell_1'] = (array)json_decode($request->input('spell_1'));
        $DATA['spell_2'] = (array)json_decode($request->input('spell_2'));
        $DATA['spell_3'] = (array)json_decode($request->input('spell_3'));

        $DATA['image_item'] = $request->file('image_item');
        $DATA['image_spell_1'] = $request->file('image_spell_1');
        $DATA['image_spell_2'] = $request->file('image_spell_2');
        $DATA['image_spell_3'] = $request->file('image_spell_3');

        try {
            $validator = $this->checkValid($DATA, $DATA['item']['is_active']);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                DB::beginTransaction();

                //----------------------- POST ----------------------------------------
                $post = new Post();
                $post->user_id = Auth::id();
                $post->post_type_id = 2;
                $post->is_active = $DATA['item']['is_active'];
                if ($DATA['item']['is_active'] == 1) {
                    $post->is_published = date("Y-m-d H:i:s");
                    Auth::user()->add_points(40,'Created ITEM post');
                }
                $post->save();

                //----------------------- ITEM ----------------------------------------
                $item = new Item();
                $item->post_id = $post->id;
                $this->createItem($item, $DATA['item']);
                $item->save();

                //----------------------- ITEM BONUS ATTRIBUTES -----------------------
                $ATTR_array = (array)$DATA['item']['modifiers'];
                foreach ($ATTR_array as $mod) {
                    $item_bonus_attribute = new ItemAttribute();
                    $item_bonus_attribute->item_id = $item->id;
                    $item_bonus_attribute->value = $mod->value;
                    $item_bonus_attribute->save();
                }
                //----------------------- ITEM RECIPE ---------------------------------
                $RECIPE_array = (array)$DATA['item']['recipe'];
                foreach ($RECIPE_array as $mod) {
                    $item_recipe_item = new ItemRecipe();
                    $item_recipe_item->item_id = $item->id;
                    $item_recipe_item->item = $mod->value;
                    $item_recipe_item->save();
                }

                //----------------------- ITEM SPELLS --------------------------------------
                //create new objects
                $spell_new_1 = new Spell();
                $spell_new_2 = new Spell();
                $spell_new_3 = new Spell();

                //fill objects with data

                //tratar evitar que el primer spell sea con nombre vacio
                if ($DATA['spell_1']['name'] != '') {
                    $this->addNewSpell($spell_new_1, '1', $DATA['spell_1'], $post->id);
                    $this->addNewSpell($spell_new_2, '2', $DATA['spell_2'], $post->id);
                    $this->addNewSpell($spell_new_3, '3', $DATA['spell_3'], $post->id);
                } elseif ($DATA['spell_2']['name'] != '') {
                    $this->addNewSpell($spell_new_2, '1', $DATA['spell_2'], $post->id);
                    $this->addNewSpell($spell_new_3, '2', $DATA['spell_3'], $post->id);
                    $this->addNewSpell($spell_new_1, '3', $DATA['spell_1'], $post->id);
                } else {
                    $this->addNewSpell($spell_new_3, '1', $DATA['spell_3'], $post->id);
                    $this->addNewSpell($spell_new_2, '2', $DATA['spell_2'], $post->id);
                    $this->addNewSpell($spell_new_1, '3', $DATA['spell_1'], $post->id);
                }

                //----------------------- IMAGES -----------------------------------------
                $this->addNewImage($item, $DATA['image_item'], '_item_image', 450, 320);
                $this->addNewImage($spell_new_1, $DATA['image_spell_1'], '_item_spell_image', 150, 150);
                $this->addNewImage($spell_new_2, $DATA['image_spell_2'], '_item_spell_image', 150, 150);
                $this->addNewImage($spell_new_3, $DATA['image_spell_3'], '_item_spell_image', 150, 150);

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Post successfully created.',
                    'post_id' => $item->id,
                ], 201);
            }
        } catch
        (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Throwable',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Exception',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        }


    }

    public function update(Request $request)
    {
        $DATA = [];
        $DATA['item'] = (array)json_decode($request->input('item'));
        $DATA['spell_1'] = (array)json_decode($request->input('spell_1'));
        $DATA['spell_2'] = (array)json_decode($request->input('spell_2'));
        $DATA['spell_3'] = (array)json_decode($request->input('spell_3'));

        $DATA['image_item'] = $request->file('image_item');
        $DATA['image_spell_1'] = $request->file('image_spell_1');
        $DATA['image_spell_2'] = $request->file('image_spell_2');
        $DATA['image_spell_3'] = $request->file('image_spell_3');

        try {
            $validator = $this->checkValid($DATA, $DATA['item']['is_active']);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                $item = Item::where('id', $DATA['item']['id'])->first();
                if (!Gate::allows('update-post', $item->post)) {
                    abort(403);
                }

                DB::beginTransaction();
                if ($item == null || Auth::id() != $item->post->user->id) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Error Throwable',
                        'errors' => 'Post Not Found or User Not Authorized'
                    ], 201);
                } else {
                    //----------------------- POST ----------------------------------------
                    $postID = $item->post_id;
                    $item->post->is_active = $DATA['item']['is_active'];
                    if ($DATA['item']['is_active'] == 1 && !$item->post->is_published) {
                        $item->post->is_published = date("Y-m-d H:i:s");
                        Auth::user()->add_points(40,'Created ITEM post');
                    }
                    $item->post->save();

                    //----------------------- ITEM ----------------------------------------
                    $this->createItem($item, $DATA['item']);
                    $item->save();

                    //----------------------- ITEM BONUS ATTRIBUTES -----------------------
                    //delete old spell_attributes
                    ItemAttribute::where('item_id', '=', $item->id)->delete();
                    $ATTR_array = (array)$DATA['item']['modifiers'];
                    foreach ($ATTR_array as $mod) {
                        $item_bonus_attribute = new ItemAttribute();
                        $item_bonus_attribute->item_id = $item->id;
                        $item_bonus_attribute->value = $mod->value;
                        $item_bonus_attribute->save();
                    }
                    //----------------------- ITEM RECIPE ---------------------------------
                    //delete old spell_attributes
                    ItemRecipe::where('item_id', '=', $item->id)->delete();
                    $RECIPE_array = (array)$DATA['item']['recipe'];
                    foreach ($RECIPE_array as $mod) {
                        $item_recipe_item = new ItemRecipe();
                        $item_recipe_item->item_id = $item->id;
                        $item_recipe_item->item = $mod->item;
                        $item_recipe_item->save();
                    }

                    //----------------------- ITEM SPELLS --------------------------------------
                    //create new objects
                    $spell_new_1 = Spell::where('id', $DATA['spell_1']['id'])->first();
                    $spell_new_2 = Spell::where('id', $DATA['spell_2']['id'])->first();
                    $spell_new_3 = Spell::where('id', $DATA['spell_3']['id'])->first();
                    //fill objects with data
                    $this->addNewSpell($spell_new_1, '1', $DATA['spell_1'], $postID);
                    $this->addNewSpell($spell_new_2, '2', $DATA['spell_2'], $postID);
                    $this->addNewSpell($spell_new_3, '3', $DATA['spell_3'], $postID);
                    //----------------------- IMAGES -----------------------------------------
                    $this->addNewImage($item, $DATA['image_item'], '_item_image', 450, 320);
                    $this->addNewImage($spell_new_1, $DATA['image_spell_1'], '_item_spell_image', 150, 150);
                    $this->addNewImage($spell_new_2, $DATA['image_spell_2'], '_item_spell_image', 150, 150);
                    $this->addNewImage($spell_new_3, $DATA['image_spell_3'], '_item_spell_image', 150, 150);

                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Post successfully created.',
                        'post_id' => $item->id,
                    ], 201);
                }
            }
        } catch
        (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Throwable',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Exception',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        }


    }


    public function createItem($initialItem, $data)
    {
        $initialItem->name = $data['name'];
        $initialItem->description = $data['description'];
        $initialItem->lore = $data['lore'];
        $initialItem->gold = $data['gold'];
        $initialItem->item_shop_id = $data['item_shop_id'];
        $initialItem->item_type_id = $data['item_type_id'];
        $initialItem->bonus_strength = $data['bonus_strength'];
        $initialItem->bonus_agility = $data['bonus_agility'];
        $initialItem->bonus_intelligence = $data['bonus_intelligence'];
        $initialItem->roles_armor = $data['roles_armor'];
        $initialItem->roles_damage = $data['roles_damage'];
        $initialItem->roles_utility = $data['roles_utility'];
        $initialItem->roles_support = $data['roles_support'];
        $initialItem->roles_siege = $data['roles_siege'];
        $initialItem->roles_heal = $data['roles_heal'];
        $initialItem->roles_mana = $data['roles_mana'];
        $initialItem->roles_disable = $data['roles_disable'];
        $initialItem->roles_resistance = $data['roles_resistance'];
        $initialItem->damage_pure = $data['damage_pure'];
        $initialItem->damage_physical = $data['damage_physical'];
        $initialItem->damage_magical = $data['damage_magical'];
    }

    public function addNewSpell($initialSpell, $hotkey, $spell, $post_id)
    {
        $initialSpell->post_id = $post_id;
        $initialSpell->spell_type_id = $spell['spell_type'];
        $initialSpell->spell_target_id = $spell['spell_target'];
        $initialSpell->spell_damage_type_id = $spell['spell_damage_type'];
        $initialSpell->name = $spell['name'];
        $initialSpell->description = $spell['description'];
        $initialSpell->hotkey = $hotkey;
        $initialSpell->manacost = $spell['manacost'];
        $initialSpell->cooldown = $spell['cooldown'];
        $initialSpell->mod_by_aghanims_scepter = $spell['mod_by_aghanims_scepter'];
        $initialSpell->mod_by_aghanims_scepter_desc = $spell['mod_by_aghanims_scepter_desc'];
        $initialSpell->mod_by_aghanims_shard = $spell['mod_by_aghanims_shard'];
        $initialSpell->mod_by_aghanims_shard_desc = $spell['mod_by_aghanims_shard_desc'];
        $initialSpell->created_by_aghanims_scepter = $spell['created_by_aghanims_scepter'];
        $initialSpell->created_by_aghanims_shard = $spell['created_by_aghanims_shard'];
        $initialSpell->pierces_bkb = $spell['pierces_bkb'];
        $initialSpell->dispellable = $spell['dispellable'];
        $initialSpell->breakable = $spell['breakable'];
        $initialSpell->blocked_by_linkens = $spell['blocked_by_linkens'];
        $initialSpell->cast_while_rooted = $spell['cast_while_rooted'];
        $initialSpell->save();
        $_array = (array)$spell['spell_attributes'];
        //delete old spell_attributes
        SpellAttribute::where('spell_id', '=', $initialSpell->id)->delete();
        //fill new spell_attributes
        foreach ($_array as $mod) {
            $spell_attribute = new SpellAttribute();
            $spell_attribute->spell_id = $initialSpell->id;
            $spell_attribute->name = $mod->name;
            $spell_attribute->value = $mod->value;
            $spell_attribute->save();
        }
    }

    public function addNewImage($save_target, $data_image, $subfix, $width, $height)
    {
        if ($data_image) {
            $input['imagename'] = rand(111, 999) . time() . $subfix . '.jpg';
            $destinationPath = public_path('/img_public');
            $save_target->img_path = '/img_public/' . $input['imagename'];
            $save_target->img_is_uploaded = true;
            $save_target->save();

            $img = Image::make($data_image->getRealPath());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename'], 90, 'jpg');
        }
    }

    public function checkValid($DATA, $active)
    {
        if ($active == 0) {
            $validator = Validator::make($DATA, [
                'item.name' => 'required|max:40',
            ],
                [
                    'item.name.required' => 'The item name is required.',
                ]);
        } else {
            $validator = Validator::make($DATA, [
                'item.name' => 'required|min:2|max:40',
                'item.description' => 'required|min:50|max:4000',
                'spell_1.name' => 'max:40',
                'spell_1.description' => 'max:4000',
                'spell_2.name' => 'max:40',
                'spell_2.description' => 'max:4000',
                'spell_3.name' => 'max:40',
                'spell_3.description' => 'max:4000',

                'image_item' => 'mimes:jpg,png|max:2048',
                'image_spell_1' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_2' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_3' => 'nullable|mimes:jpg,png|max:2048',

            ],
                [
                    'item.name.required' => 'The item name is required.',
                    'item.description.required' => 'The item description is required.',
                    'image_item.image' => 'The item image must be a jpg or png.',
                    'image_spell_1.mimes' => 'The 1 spell image must be a jpg or png.',
                    'image_spell_2.mimes' => 'The 2 spell image must be a jpg or png.',
                    'image_spell_3.mimes' => 'The 3 spell image must be a jpg or png.',
                ]);
        }
        return $validator;
    }
}
