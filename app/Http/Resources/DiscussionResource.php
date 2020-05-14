<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'user'=>$this->User,
            'channel'=>$this->Channel,
            'replies'=>ReplyResource::collection($this->Replies),
            'replies_count'=>$this->Replies->count(),
            'slug'=>$this->slug,
            'published_at'=>Carbon::parse($this->created_at)->diffForHumans(),
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,

        ];
    }
}
