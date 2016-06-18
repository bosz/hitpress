<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $fillable=[
        'comment_id',
        'author',
        'email',
        'is_active',
        'body',
    ];

    public function comment(){
        $this->belongsTo('App\Comment');
    }
}
