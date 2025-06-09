<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Channel extends Model
{
     use Authorizable, HasFactory;
    protected $fillable = ['user_id','name','description','logo'];




    public function user() {
    return $this->belongsTo(User::class);
    }

    public function contents() {
        return $this->hasMany(Content::class);
    }
}
