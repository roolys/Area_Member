<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $with=['user'];

    //We have comment it belongsTo user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //We have post it hasMany comment

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
