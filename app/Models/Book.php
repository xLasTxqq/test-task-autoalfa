<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
        'genre_id',
        'publisher_id'
    ];

    public function authors(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function genres(){
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function publishers(){
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }

    public function grades(){
        return $this->hasMany(Grade::class, 'book_id', 'id');
    }

    public function action(){
        return $this->hasMany(Action::class, 'book_id', 'id');
    }

    public function subscribers(){
        return $this->hasMany(Subscriber::class, 'book_id', 'id');
    }

    public function countSubscribers($query){
        return $query->with(['subscribers'=>fn($query)=>$query->count()]);
    }

    public function avgGrade($query){
        return $query->with(['grades'=>fn($query)=>$query->avg('stars')]);
    }
}
