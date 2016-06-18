<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=[
        'post_id',
        'email',
        'name',
        'is_active',
        'body',
    ];

    public function replies(){
        return $this->hasMany('App\Reply');
    }
}
