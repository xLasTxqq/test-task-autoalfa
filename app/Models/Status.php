<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function actions(){
        return $this->hasMany(Status::class, 'status_id', 'id');
    }
}
