<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use Illuminate\Http\Response;

class DestroyCommentAction
{
    function __invoke(Comment $comment): Response
    {
        $comment->delete();
        return response()->noContent();
    }
}