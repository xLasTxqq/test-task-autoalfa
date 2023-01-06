<?php

namespace App\Actions\Permission;

use App\Http\Resources\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexPermissionAction
{
    function __invoke(): JsonResource
    {
        return PermissionResource::collection(auth()->user()->getAllPermissions());
    }
}
