<?php

namespace App\Http\Resources;

use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
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
            'comments' => CommentResource::collection($this->comments->sortByDesc('id')),
            'avg_grade' => $this->grades->avg('stars'),
            'grade' => $this->grades->where('user_id', auth()->id())->first(),
            'subscribe' => $this->when($this->subscribers->where('user_id',auth()->id())->count()>0, true, false)
        ];
    }
}
