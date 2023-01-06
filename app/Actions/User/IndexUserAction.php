<?php

namespace App\Actions\User;

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class IndexUserAction
{
    function __invoke(): JsonResource
    {
        return UserCollection::collection(Cache::rememberForever('users', function () {
            return User::all();
        }));
    }
}