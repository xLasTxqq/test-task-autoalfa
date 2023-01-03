<?php

namespace App\Actions\Grade;

use App\Http\Requests\GradeRequest;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreGradeAction
{
    function __invoke(GradeRequest $request): JsonResource
    {
        return new GradeResource(Grade::updateOrCreate(
            ['book_id' => $request->book_id, 'user_id' => auth()->id()],
            ['stars' => $request->stars]
        ));
    }
}
