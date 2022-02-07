<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MrcSpellResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mrc_id' => $this->mrc_id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'user_points' => $this->user->get_total_points(),
            'user_avatar' => $this->user->di_avatar,
            'spell_type' => $this->spellType->id,
            'spell_target' => $this->spellTarget->id,
            'spell_damage_type' => $this->spellDamageType->id,
            'spell_type_name' => $this->spellType->name,
            'spell_target_name' => $this->spellTarget->name,
            'spell_damage_type_name' => $this->spellDamageType->name,

            'name' => $this->name,
            'description' => $this->description,
            'img_is_uploaded' => $this->img_is_uploaded,
            'img_path' => $this->img_path,
            'hotkey' => $this->hotkey,

            'manacost' => $this->manacost,
            'cooldown' => $this->cooldown,

            'mod_by_aghanims_scepter' => $this->mod_by_aghanims_scepter,
            'mod_by_aghanims_scepter_desc' => $this->mod_by_aghanims_scepter_desc,
            'mod_by_aghanims_shard' => $this->mod_by_aghanims_shard,
            'mod_by_aghanims_shard_desc' => $this->mod_by_aghanims_shard_desc,

            'pierces_bkb' => $this->pierces_bkb,
            'dispellable' => $this->dispellable,
            'breakable' => $this->breakable,
            'blocked_by_linkens' => $this->blocked_by_linkens,
            'cast_while_rooted' => $this->cast_while_rooted,

            'spell_attributes' => $this->mrc_spell_attributes,



            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'voted' => $this->mrc_voted_user(),
        ];
    }
}
