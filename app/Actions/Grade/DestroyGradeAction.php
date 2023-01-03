<?php

namespace App\Actions\Grade;

use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyGradeAction
{
    function __invoke(Grade $grade): JsonResource
    {
        $grade->delete();
        return new GradeResource($grade);
    }
}
