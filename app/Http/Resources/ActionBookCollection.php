<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionBookCollection extends JsonResource
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
            'avg_grade' => $this->grades->avg('stars'),
        ];
    }
}
