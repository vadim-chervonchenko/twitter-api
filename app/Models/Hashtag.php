<?php

namespace App;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    public function hashtags(){
        return $this->belongsToMany(Tweet::class);
    }
}
