<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'shop_item_category_id'=> $this->shop_item_category_id,
            'name'=> $this->name,
            'description'=> $this->description,
            'img_path'=> $this->img_path,
            'value'=> $this->value,
            'charges'=> $this->charges,
            'active'=> $this->active,
            'menu_opened'=> false,

        ];
    }
}
