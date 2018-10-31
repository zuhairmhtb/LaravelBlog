<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    //Model Relationship: A single user can have many post and one post beongs to a single user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
