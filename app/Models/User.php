<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; 


    public const PERMISSION_CREATE_UPDATE_DELETE_BOOKS = 'create_update_delete_books';
    public const PERMISSION_UPDATE_OTHERS_PASSWORD = 'update_others_password';
    public const PERMISSION_CREATE_DELETE_USERS = 'create_delete_users';
    public const PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS = 'reserve_and_cancel_reserve_books';
    public const PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS = 'lend_out_and_accept_books';
    public const PERMISSION_SUBSCRIBE_TO_BOOKS = 'subscribe_to_books';
    public const PERMISSION_COMMENT_AND_RATE_BOOKS = 'comment_and_rate_books';
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
        return $this->hasMany(Grade::class, 'user_id', 'id');
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'user_id', 'id');
    }

    public function actions()
    {
        return $this->hasMany(Actions::class, 'user_id', 'id');
    }
}
