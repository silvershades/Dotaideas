<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->post_type_id) {
            case 1:
            {
                $link_show = '/post/hero/' . $this->hero->id;
                $link_edit = '/post/edit/hero/' . $this->hero->id;
                $post = $this->hero;
                break;
            }
            case 2:
            {
                $link_show = '/post/item/' . $this->item->id;
                $link_edit = '/post/edit/item/' . $this->item->id;
                $post = $this->item;
                break;
            }
            case 3:
            {
                $link_show = '/post/other/' . $this->other->id;
                $link_edit = '/post/edit/other/' . $this->other->id;
                $post = $this->other;
                break;
            }
        }

        return [
            'id' => $this->id,
            'created_at' => $this->created_at->format('d-m-Y'),
            'user_id' => $this->user_id,
            'post_type' => $this->post_type_id,
            'is_published' => $this->is_published,
            'is_active' => $this->is_active,
            'is_flagged' => $this->is_flagged,
            'flag_reason' => $this->flag_reason,
            'is_pinned' => $this->is_pinned,
            'views' => $this->views,
            'comments' => $this->comments->count(),
            'votes' => $this->votes->sum('vote'),
            'awards' => $this->awards->count(),
            'post' => $post,
            'loading' => false,
            'is_golden' => $this->has_golden_bg(),
            'is_emerald' => $this->has_emerald_bg(),
            'post_link_show' => $link_show,
            'post_link_edit' => $link_edit,
        ];
    }
}
