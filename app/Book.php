<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //Protect against mass assignment
    protected $fillable = ['title', 'author', 'description'];

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
