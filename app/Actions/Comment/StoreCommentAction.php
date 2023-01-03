<?php

namespace App\Actions\Comment;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreCommentAction
{
    function __invoke(CommentRequest $request): JsonResource
    {
        return new CommentResource(Comment::create($request->validated()));
    }
}
