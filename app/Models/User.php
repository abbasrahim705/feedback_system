<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship between user and posts
     *
     */
    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relationship between user and videos
     *
     */
    public function videos() : HasMany
    {
        return $this->hasMany(Post::class);
    }

        /**
     * Relationship between user and feedbacks
     *
     */
    public function feedbacks() : HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
