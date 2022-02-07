<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MrcResource extends JsonResource
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
            'id'=> $this->id,
            'name'=> $this->name,
            'spell_name'=> $this->spell_name,
            'img_path'=> $this->img_path,
            'spell_img_path'=> $this->spell_img_path,
            'dota_link'=> $this->dota_link,
            'start_date'=> $this->start_date->format('d-m-Y'),
            'end_date'=> $this->end_date->format('d-m-Y'),
            'is_active'=> $this->is_active,
            'winner_entry_id'=>  $this->winner_entry_id,

        ];
//        return parent::toArray($request);
    }
}
