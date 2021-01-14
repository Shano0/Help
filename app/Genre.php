<?php

namespace App;
use Movie;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
    	"genre"
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
