<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //We have post and it belongsTo  user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //We have Post and it hasMany comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
        
    }
    //

}
