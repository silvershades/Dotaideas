<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MrcResource;
use App\Http\Resources\MrcSpellResource;
use App\Models\Mrc;
use App\Models\MrcSpell;
use App\Models\MrcVote;
use App\Models\SpellAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MrcController extends Controller
{
    public function load()
    {
        return MrcResource::collection(Mrc::where('is_active', 1)->get());
    }

    public function vote(Request $request)
    {
        $DATA = [];
        $DATA['mrc'] = $request->input('mrc');
        $DATA['mrc_spell'] = $request->input('mrc_spell');
        $DATA['vote'] = $request->input('vote');
        try {
            $validator = $this->checkValidMrc($DATA);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                if (Auth::check()) {
                    //check if vote exists and delete
                    $old_vote = MrcVote::where('user_id',Auth::id())->where('mrc_id',$DATA['mrc'])->where('mrc_spell_id',$DATA['mrc_spell'])->first();
                    if($old_vote){
                        MrcVote::where('user_id',Auth::id())->where('mrc_id',$DATA['mrc'])->where('mrc_spell_id',$DATA['mrc_spell'])->delete();
                    }
                    $new_vote = new MrcVote();
                    $new_vote->user_id = Auth::id();
                    $new_vote->mrc_id = $DATA['mrc'];
                    $new_vote->mrc_spell_id = $DATA['mrc_spell'];

                    if ($DATA['vote'] == '-1') {
                        $new_vote->vote = -1;
                    } elseif ($DATA['vote'] == '1') {
                        $new_vote->vote = 1;
                    }

                    $new_vote->save();

                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Voted',
                    ], 201);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Access denied',
                    ], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 201);
        }

    }


    public function spells(Request $request)
    {
        $DATA = [];
        $DATA['mrc'] = $request->input('mrc');

        try {
            $validator = $this->checkValidMrc($DATA);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                return MrcSpellResource::collection(MrcSpell::where('mrc_id', $DATA['mrc'])->get());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 201);
        }
    }

    public function store(Request $request)
    {
        $DATA = [];
        $DATA['mrc'] = $request->input('mrc');
        $DATA['spell'] = (array)json_decode($request->input('spell'));

        try {
            $validator = $this->checkValid($DATA);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                if (Auth::check()) {
                    //check if already posted
                    $count = MrcSpell::where('mrc_id', $DATA['mrc'])->where('user_id', Auth::id())->count();
                    if ($count > 0) {
                        return response()->json([
                            'status' => 'error',
                            'msg' => 'Already posted MRC',
                        ], 201);
                    } else {
                        $new_mrc_spell = new MrcSpell();
                        $new_mrc_spell->mrc_id = $DATA['mrc'];
                        $new_mrc_spell->user_id = Auth::id();
                        $this->addNewSpell($new_mrc_spell, 'MRC', $DATA['spell']);
                        $new_mrc_spell->save();
                        Auth::user()->add_points(150,'Participated on MRC');
                        return response()->json([
                            'status' => 'success',
                            'msg' => 'Saved',
                        ], 201);

                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'Access denied',
                    ], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 201);
        }
    }

    public function addNewSpell($initialSpell, $hotkey, $spell)
    {
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

    public function checkValid($DATA)
    {
        $validator = Validator::make($DATA, [
            'mrc' => 'required|exists:mrcs,id',
            'spell.name' => 'required',
            'spell.description' => 'required|max:4000',
        ]);

        return $validator;
    }

    public function checkValidMrc($DATA)
    {
        $validator = Validator::make($DATA, [
            'mrc' => 'required|exists:mrcs,id',
        ]);

        return $validator;
    }
}
