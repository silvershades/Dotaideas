<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserStashResource extends JsonResource
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
            'created_at' => $this->created_at,
            'shop_item_id' => $this->shop_item_id,
            'user_id' => $this->user_id,
            'consumed_on_post' => $this->consumed_on_post,
            'consumed_on_date' => $this->consumed_on_date,
            'shop_item' => $this->shop_item,
        ];
    }
}
