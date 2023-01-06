<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const BOOKED_STATUS_ID = 1;
    public const BOOKED_STATUS_NAME = 'Booked';
    public const TAKEN_STATUS_ID = 2;
    public const TAKEN_STATUS_NAME = 'Taken';
    public const FREE_STATUS_NAME = 'Free';
    public const STATUSES = [1, 2];

    protected $fillable = [
        'name'
    ];

    public function actions()
    {
        return $this->hasMany(Status::class, 'status_id', 'id');
    }
}
