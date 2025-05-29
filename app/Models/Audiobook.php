<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audiobook extends Model
{
    
    protected $fillable = ['author','duration'];
    
    public function content() {
        return $this->morphOne(Content::class, 'contentable');
    }
}
