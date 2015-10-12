<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['source', 'md5_source', 'title', 'description', 'is_private', 'user_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
