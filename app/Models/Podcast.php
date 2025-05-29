<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    
    protected $fillable = ['episode_number','duration'];

    public function content() 
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function comments() 
    {
        return $this->morphMany(Comment::class, 'commentable');    
    }
}
