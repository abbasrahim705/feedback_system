<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    /**
     * Relationship between user and video
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
