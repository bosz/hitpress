<?php

namespace hitpress;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable =['title','body','photo_id','category_id'];

    public function user()
    {
        return $this->belongsTo('hitpress\User');
    }

    public function photo()
    {
        return $this->belongsTo('hitpress\Photo');
    }

    public function category()
    {
        return $this->belongsTo('hitpress\Category');
    }

    public function comments(){
        return $this->hasMany('hitpress\Comment');
    }
}