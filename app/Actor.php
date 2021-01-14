<?php

namespace App;
use Movie;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
    	"name_geo",
    	"name_eng",
    	"birth_date",
    	"birth_place",
    	"actor_img"
    ];

    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'actor_in_movies');
    }
}
