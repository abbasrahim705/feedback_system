<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;
    /**
     * function to return user with the post
     */
    /**
     * Relation between posts and user
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /*
    * Relation between posts and user
    */
   public function comment() : MorphOne
   {
       return $this->morphOne(Comment::class,'commentable');
   }
}
