<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dota2HeroResource extends JsonResource
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
        'primary_attribute'=> $this->primary_attribute,
        'attack_type'=> $this->attack_type,
        'complexity'=> $this->complexity,
        'strength'=> $this->strength,
        'lvlup_strength'=> $this->lvlup_strength,
        'agility'=> $this->agility,
        'lvlup_agility'=> $this->lvlup_agility,
        'intelligence'=> $this->intelligence,
        'lvlup_intelligence'=> $this->lvlup_intelligence,
        'attack_damage_min'=> $this->attack_damage_min,
        'attack_damage_max'=> $this->attack_damage_max,
        'attack_bat'=> $this->attack_bat,
        'attack_ias'=> $this->attack_ias,
        'attack_range'=> $this->attack_range,
        'defense_armor'=> $this->defense_armor,
        'defense_magic_resistance'=> $this->defense_magic_resistance,
        'mobility_speed'=> $this->mobility_speed,
        'mobility_turn_rate'=> $this->mobility_turn_rate,
        'mobility_vision_day'=> $this->mobility_vision_day,
        'mobility_vision_night'=> $this->mobility_vision_night,
        'basic_regen_hp'=> $this->basic_regen_hp,
        'basic_regen_mana'=> $this->basic_regen_mana,
        'roles_carry'=> $this->roles_carry,
        'roles_support'=> $this->roles_support,
        'roles_nuker'=> $this->roles_nuker,
        'roles_disabler'=> $this->roles_disabler,
        'roles_jungler'=> $this->roles_jungler,
        'roles_durable'=> $this->roles_durable,
        'roles_escape'=> $this->roles_escape,
        'roles_pusher'=> $this->roles_pusher,
        'roles_initiator'=> $this->roles_initiator,
        'strengths_team_fight'=> $this->strengths_team_fight,
        'strengths_farm'=> $this->strengths_farm,
        'strengths_split_push'=> $this->strengths_split_push,
        'strengths_siege'=> $this->strengths_siege,
        'strengths_base_defense'=> $this->strengths_base_defense,
        'strengths_roshan'=> $this->strengths_roshan,
        'damage_pure'=> $this->damage_pure,
        'damage_physical'=> $this->damage_physical,
        'damage_magical'=> $this->damage_magical
        ];
    }
}
