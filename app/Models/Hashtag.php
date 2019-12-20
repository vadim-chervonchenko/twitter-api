<?php

namespace App\Models;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = ['name'];

    public function tweets(){
        return $this->belongsToMany(Tweet::class);
    }
}
