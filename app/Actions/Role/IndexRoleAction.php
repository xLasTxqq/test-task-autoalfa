<?php

namespace App\Actions\Role;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class IndexRoleAction
{
    function __invoke(): JsonResource
    {
        return RoleResource::collection(Cache::rememberForever('roles', function () {
            return Role::all();
        }));
    }
}
