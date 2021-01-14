<?php

namespace App;
use Genre;
use Comment;
use Actor;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
    	"title_geo",
    	"title_eng",
    	"imdb",
    	"release_date",
        "movie_img",
    	"directed_by",
    	"duration",
    	"country",
    	"description"
    ];

    public function genre()
    {
        return $this->hasMany(Genre::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function actor()
    {
        return $this->belongsToMany(Actor::class, 'actor_in_movies');
    }
}
