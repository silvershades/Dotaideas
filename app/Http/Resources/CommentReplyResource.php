<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentReplyResource extends JsonResource
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
            'user_id' => $this->user_id,
            'comment_id' => $this->comment_id,
            'user_name' => $this->user->name,
            'user_points' => $this->user->get_total_points(),
            'message' => $this->message,
            'likes' => $this->likes,
            'created_at' => $this->created_at_days_ago(),
        ];
    }
}
