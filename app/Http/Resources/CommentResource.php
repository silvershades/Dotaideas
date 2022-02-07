<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'user_name' => $this->user->name,
            'user_di_avatar' => $this->user->di_avatar,
            'user_points' => $this->user->get_total_points(),
            'message' => $this->message,
            'likes' => $this->likes,
            'replies' => CommentReplyResource::collection($this->comment_reply),

            'created_at' => $this->created_at_days_ago(),
            'show_reply_box' => 0,
            'reply' => '',
            'loading' => 0,
        ];
    }
}
