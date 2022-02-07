<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Http\Resources\HeroSpellsResource;
use App\Models\Hero;
use App\Models\Post;
use App\Models\Spell;
use App\Models\SpellAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class HeroController extends Controller
{
    public function index(Hero $hero)
    {
        $hero->post->views++;
        $hero->post->save();
        return HeroResource::collection(Hero::where('id', $hero->id)->get());
    }

    public function spells(Hero $hero)
    {
        $post_id = $hero->post->id;
        return HeroSpellsResource::collection(Spell::where('post_id', $post_id)->get());
    }

    public function gethero(Hero $hero)
    {
        return HeroResource::collection(Hero::where('id', $hero->id)->get());
    }

    public function store(Request $request)
    {
        $DATA = [];
        $DATA['hero'] = (array)json_decode($request->input('hero'));
        $DATA['spell_Q'] = (array)json_decode($request->input('spell_Q'));
        $DATA['spell_W'] = (array)json_decode($request->input('spell_W'));
        $DATA['spell_E'] = (array)json_decode($request->input('spell_E'));
        $DATA['spell_R'] = (array)json_decode($request->input('spell_R'));
        $DATA['spell_D'] = (array)json_decode($request->input('spell_D'));
        $DATA['spell_F'] = (array)json_decode($request->input('spell_F'));
        $DATA['image_hero'] = $request->file('image_hero');
        $DATA['image_spell_Q'] = $request->file('image_Q');
        $DATA['image_spell_W'] = $request->file('image_W');
        $DATA['image_spell_E'] = $request->file('image_E');
        $DATA['image_spell_R'] = $request->file('image_R');
        $DATA['image_spell_D'] = $request->file('image_D');
        $DATA['image_spell_F'] = $request->file('image_F');

        try {
            $validator = $this->checkValid($DATA, $DATA['hero']['is_active']);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                DB::beginTransaction();
                //----------------------- POST -----------------------------------------
                $post = new Post();
                $post->user_id = Auth::id();
                $post->post_type_id = 1;
                $post->is_active = $DATA['hero']['is_active'];
                if ($DATA['hero']['is_active'] == 1) {
                    $post->is_published = date("Y-m-d H:i:s");
                    Auth::user()->add_points(50,'Created HERO post');
                }
                $post->save();

                //----------------------- HERO -----------------------------------------
                $hero = new Hero();
                $hero->post_id = $post->id;
                $this->createHero($hero, $DATA['hero']);
                $hero->save();
                //----------------------- SPELLS -----------------------------------------
                //create new objects
                $spell_new_Q = new Spell();
                $spell_new_W = new Spell();
                $spell_new_E = new Spell();
                $spell_new_R = new Spell();
                $spell_new_D = new Spell();
                $spell_new_F = new Spell();
                //fill objects with data
                $this->addNewSpell($spell_new_Q, 'Q', $DATA['spell_Q'], $post->id);
                $this->addNewSpell($spell_new_W, 'W', $DATA['spell_W'], $post->id);
                $this->addNewSpell($spell_new_E, 'E', $DATA['spell_E'], $post->id);
                $this->addNewSpell($spell_new_R, 'R', $DATA['spell_R'], $post->id);
                $this->addNewSpell($spell_new_D, 'D', $DATA['spell_D'], $post->id);
                $this->addNewSpell($spell_new_F, 'F', $DATA['spell_F'], $post->id);
                //----------------------- IMAGES -----------------------------------------
                $this->addNewImage($hero, $DATA['image_hero'], '_hero_image', 450, 320);
                $this->addNewImage($spell_new_Q, $DATA['image_spell_Q'], '_spell_image', 150, 150);
                $this->addNewImage($spell_new_W, $DATA['image_spell_W'], '_spell_image', 150, 150);
                $this->addNewImage($spell_new_E, $DATA['image_spell_E'], '_spell_image', 150, 150);
                $this->addNewImage($spell_new_R, $DATA['image_spell_R'], '_spell_image', 150, 150);
                $this->addNewImage($spell_new_D, $DATA['image_spell_D'], '_spell_image', 150, 150);
                $this->addNewImage($spell_new_F, $DATA['image_spell_F'], '_spell_image', 150, 150);

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Post successfully created.',
                    'post_id' => $hero->id,
                ], 201);
            }
        } catch (\Exception $e) {
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
        $DATA['hero'] = (array)json_decode($request->input('hero'));
        $DATA['spell_Q'] = (array)json_decode($request->input('spell_Q'));
        $DATA['spell_W'] = (array)json_decode($request->input('spell_W'));
        $DATA['spell_E'] = (array)json_decode($request->input('spell_E'));
        $DATA['spell_R'] = (array)json_decode($request->input('spell_R'));
        $DATA['spell_D'] = (array)json_decode($request->input('spell_D'));
        $DATA['spell_F'] = (array)json_decode($request->input('spell_F'));
        $DATA['image_hero'] = $request->file('image_hero');
        $DATA['image_spell_Q'] = $request->file('image_Q');
        $DATA['image_spell_W'] = $request->file('image_W');
        $DATA['image_spell_E'] = $request->file('image_E');
        $DATA['image_spell_R'] = $request->file('image_R');
        $DATA['image_spell_D'] = $request->file('image_D');
        $DATA['image_spell_F'] = $request->file('image_F');


        try {
            $validator = $this->checkValid($DATA, $DATA['hero']['is_active']);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                $hero = Hero::where('id', $DATA['hero']['id'])->first();

                if (!Gate::allows('update-post', $hero->post)) {
                    abort(403);
                }

                DB::beginTransaction();
                //----------------------- POST -----------------------------------------
                if ($hero == null || Auth::id() != $hero->post->user->id) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Error Throwable',
                        'errors' => 'Post Not Found or User Not Authorized'
                    ], 201);
                } else {
                    $postID = $hero->post_id;
                    $hero->post->is_active = $DATA['hero']['is_active'];
                    if ($DATA['hero']['is_active'] == 1 && !$hero->post->is_published) {
                        $hero->post->is_published = date("Y-m-d H:i:s");
                        Auth::user()->add_points(50,'Created HERO post');
                    }
                    $hero->post->save();
                    //----------------------- HERO -----------------------------------------
                    $this->createHero($hero, $DATA['hero']);
                    $hero->save();
                    //----------------------- SPELLS -----------------------------------------
                    //get old spells
                    $spell_new_Q = Spell::where('id', $DATA['spell_Q']['id'])->first();
                    $spell_new_W = Spell::where('id', $DATA['spell_W']['id'])->first();
                    $spell_new_E = Spell::where('id', $DATA['spell_E']['id'])->first();
                    $spell_new_R = Spell::where('id', $DATA['spell_R']['id'])->first();
                    $spell_new_D = Spell::where('id', $DATA['spell_D']['id'])->first();
                    $spell_new_F = Spell::where('id', $DATA['spell_F']['id'])->first();
                    //fill objects with new data
                    $this->addNewSpell($spell_new_Q, 'Q', $DATA['spell_Q'], $postID);
                    $this->addNewSpell($spell_new_W, 'W', $DATA['spell_W'], $postID);
                    $this->addNewSpell($spell_new_E, 'E', $DATA['spell_E'], $postID);
                    $this->addNewSpell($spell_new_R, 'R', $DATA['spell_R'], $postID);
                    $this->addNewSpell($spell_new_D, 'D', $DATA['spell_D'], $postID);
                    $this->addNewSpell($spell_new_F, 'F', $DATA['spell_F'], $postID);
                    //----------------------- IMAGES -----------------------------------------
                    $this->addNewImage($hero, $DATA['image_hero'], '_hero_image', 450, 320);
                    $this->addNewImage($spell_new_Q, $DATA['image_spell_Q'], '_spell_image', 150, 150);
                    $this->addNewImage($spell_new_W, $DATA['image_spell_W'], '_spell_image', 150, 150);
                    $this->addNewImage($spell_new_E, $DATA['image_spell_E'], '_spell_image', 150, 150);
                    $this->addNewImage($spell_new_R, $DATA['image_spell_R'], '_spell_image', 150, 150);
                    $this->addNewImage($spell_new_D, $DATA['image_spell_D'], '_spell_image', 150, 150);
                    $this->addNewImage($spell_new_F, $DATA['image_spell_F'], '_spell_image', 150, 150);

                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Post successfully created.',
                        'post_id' => $hero->id,
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

    public function createHero($initialHero, $data)
    {

        $initialHero->name = $data['name'];
        $initialHero->description = $data['description'];
        $initialHero->lore = $data['lore'];
        $initialHero->attack_type = $data['attack_type'];
        $initialHero->complexity = $data['complexity'];
        $initialHero->basic_regen_hp = $data['basic_regen_hp'];
        $initialHero->basic_regen_mana = $data['basic_regen_mana'];
        $initialHero->primary_attribute = $data['primary_attribute'];
        $initialHero->strength = $data['strength'];
        $initialHero->agility = $data['agility'];
        $initialHero->intelligence = $data['intelligence'];
        $initialHero->lvlup_strength = $data['lvlup_strength'];
        $initialHero->lvlup_agility = $data['lvlup_agility'];
        $initialHero->lvlup_intelligence = $data['lvlup_intelligence'];
        $initialHero->attack_damage_min = $data['attack_damage_min'];
        $initialHero->attack_damage_max = $data['attack_damage_max'];
        $initialHero->attack_bat = $data['attack_bat'];
        $initialHero->attack_ias = $data['attack_ias'];
        $initialHero->attack_range = $data['attack_range'];
        $initialHero->defense_armor = $data['defense_armor'];
        $initialHero->defense_magic_resistance = $data['defense_magic_resistance'];
        $initialHero->mobility_speed = $data['mobility_speed'];
        $initialHero->mobility_turn_rate = $data['mobility_turn_rate'];
        $initialHero->mobility_vision_day = $data['mobility_vision_day'];
        $initialHero->mobility_vision_night = $data['mobility_vision_night'];
        $initialHero->roles_carry = $data['roles_carry'];
        $initialHero->roles_support = $data['roles_support'];
        $initialHero->roles_nuker = $data['roles_nuker'];
        $initialHero->roles_disabler = $data['roles_disabler'];
        $initialHero->roles_jungler = $data['roles_jungler'];
        $initialHero->roles_durable = $data['roles_durable'];
        $initialHero->roles_escape = $data['roles_escape'];
        $initialHero->roles_pusher = $data['roles_pusher'];
        $initialHero->roles_initiator = $data['roles_initiator'];
        $initialHero->strengths_team_fight = $data['strengths_team_fight'];
        $initialHero->strengths_farm = $data['strengths_farm'];
        $initialHero->strengths_split_push = $data['strengths_split_push'];
        $initialHero->strengths_siege = $data['strengths_siege'];
        $initialHero->strengths_base_defense = $data['strengths_base_defense'];
        $initialHero->strengths_roshan = $data['strengths_roshan'];
        $initialHero->damage_pure = $data['damage_pure'];
        $initialHero->damage_physical = $data['damage_physical'];
        $initialHero->damage_magical = $data['damage_magical'];
        $initialHero->talent_25_left = $data['talent_25_left'];
        $initialHero->talent_25_right = $data['talent_25_right'];
        $initialHero->talent_20_left = $data['talent_20_left'];
        $initialHero->talent_20_right = $data['talent_20_right'];
        $initialHero->talent_15_left = $data['talent_15_left'];
        $initialHero->talent_15_right = $data['talent_15_right'];
        $initialHero->talent_10_left = $data['talent_10_left'];
        $initialHero->talent_10_right = $data['talent_10_right'];
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
                'hero.name' => 'required|max:40'
            ],
                [
                    'hero.name.required' => 'The hero name is required',
                ]);
        } else {
            $validator = Validator::make($DATA, [
                'hero.name' => 'required|min:2|max:40',
                'hero.description' => 'required|min:50|max:4000',
                'spell_Q.name' => 'required|max:40',
                'spell_Q.description' => 'required|max:4000',
                'spell_W.name' => 'required|max:40',
                'spell_W.description' => 'required|max:4000',
                'spell_E.name' => 'required|max:40',
                'spell_E.description' => 'required|max:4000',
                'spell_R.name' => 'required|max:40',
                'spell_R.description' => 'required|max:4000',
                'spell_D.name' => 'max:40',
                'spell_D.description' => 'max:4000',
                'spell_F.name' => 'max:40',
                'spell_F.description' => 'max:4000',
                'image_hero' => 'mimes:jpg,png|max:2048',
                'image_spell_Q' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_W' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_E' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_R' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_D' => 'nullable|mimes:jpg,png|max:2048',
                'image_spell_F' => 'nullable|mimes:jpg,png|max:2048',
            ],
                [
                    'hero.name.required' => 'The hero name is required.',
                    'hero.description.required' => 'The hero description is required.',
                    'spell_Q.name.required' => 'The Q spell name is required.',
                    'spell_W.name.required' => 'The W spell name is required.',
                    'spell_E.name.required' => 'The E spell name is required.',
                    'spell_R.name.required' => 'The R spell name is required.',
                    'spell_D.name.required' => 'The D spell name is required.',
                    'spell_F.name.required' => 'The F spell name is required.',
                    'spell_Q.description.required' => 'The Q spell description is required.',
                    'spell_W.description.required' => 'The W spell description is required.',
                    'spell_E.description.required' => 'The E spell description is required.',
                    'spell_R.description.required' => 'The R spell description is required.',
                    'spell_D.description.required' => 'The D spell description is required.',
                    'spell_F.description.required' => 'The F spell description is required.',
                    'image_hero.mimes' => 'The hero image must be a jpg or png.',
                    'image_spell_Q.mimes' => 'The Q spell image must be a jpg or png.',
                    'image_spell_W.mimes' => 'The W spell image must be a jpg or png.',
                    'image_spell_E.mimes' => 'The E spell image must be a jpg or png.',
                    'image_spell_R.mimes' => 'The R spell image must be a jpg or png.',
                    'image_spell_D.mimes' => 'The D spell image must be a jpg or png.',
                    'image_spell_F.mimes' => 'The F spell image must be a jpg or png.',
                ]);
        }
        return $validator;
    }
}
