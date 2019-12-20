<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['content'];
    protected $hidden = ['author_id'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function mentions(){
        return $this->belongsToMany(User::class, 'mentions', 'tweet_id', 'user_id');
    }

    public function hashtags(){
        return $this->belongsToMany(Hashtag::class);
    }
}


