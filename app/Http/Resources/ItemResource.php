<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'post_id' => $this->post->id,
            'item_type_id' => $this->item_type_id,
            'item_shop_id' => $this->item_shop_id,
            'gold' => $this->gold,
            'bonus_strength' => $this->bonus_strength,
            'bonus_agility' => $this->bonus_agility,
            'bonus_intelligence' => $this->bonus_intelligence,
            'modifiers' => $this->item_attributes,
            'recipe' => $this->item_recipes,

            'name' => $this->name,
            'description' => $this->description,
            'lore' => $this->lore,
            'img_is_uploaded' => $this->img_is_uploaded,
            'img_path' => $this->img_path,

            'roles_armor' => $this->roles_armor,
            'roles_damage' => $this->roles_damage,
            'roles_utility' => $this->roles_utility,
            'roles_support' => $this->roles_support,
            'roles_siege' => $this->roles_siege,
            'roles_heal' => $this->roles_heal,
            'roles_mana' => $this->roles_mana,
            'roles_disable' => $this->roles_disable,
            'roles_resistance' => $this->roles_resistance,
            'damage_pure' => $this->damage_pure,
            'damage_physical' => $this->damage_physical,
            'damage_magical' => $this->damage_magical,


            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
