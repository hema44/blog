<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'Title',
        'body',
        'user_id'
    ];
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
