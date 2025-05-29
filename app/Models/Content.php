<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    
    protected $fillable = ['channel_id','title','description','file_path','cover_image','published_at','contentable'];

    // app/Models/Content.php
    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function contentable() {
        return $this->morphTo(); 
    }
}
