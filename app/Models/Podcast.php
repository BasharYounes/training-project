<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    
    protected $fillable = ['episode_number','duration'];

    public function content() 
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function comments() 
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');    
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
