<?php

namespace App\Actions\Grade;

use App\Models\Grade;
use Illuminate\Http\Response;

class DestroyGradeAction
{
    function __invoke(Grade $grade): Response
    {
        $grade->delete();
        return response()->noContent();
    }
}
