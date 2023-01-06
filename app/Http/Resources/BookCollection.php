<?php

namespace App\Http\Resources;

use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class BookCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'author' => new AuthorResource($this->author),
            'publisher' => new PublisherResource($this->publisher),
            'genre' => new GenreResource($this->genre),
            'action' => $this->when($this->action && $this->action->user_id === auth()->id(), new ActionResource($this->action)),
            'status' => $this->when($this->action && $this->action->status, new StatusResource($this->action), ['name' => Status::FREE_STATUS_NAME]),
            'avg_grade' => $this->grades->avg('stars'),
            'subscribe' => $this->when($this->subscribers->where('user_id',auth()->id())->count()>0, true, false)
        ];
    }
}
