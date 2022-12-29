<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LaravelPermissionToVueJS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function subscribers()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function actions()
    {
        return $this->hasMany(Actions::class, 'user_id', 'id');
    }

    public function takenBooks($query)
    {
        $status_id = Status::where(['name'=>'taken'])->first()->id;
        return $query->with(['actions'=>fn($queryActions)=>$queryActions->where(['id_status' => $status_id])]);
    }

    public function bookedBooks($query)
    {
        $status_id = Status::where(['name'=>'booked'])->first()->id;
        return $query->with(['actions'=>fn($queryActions)=>$queryActions->where(['id_status' => $status_id])]);
    }
}
