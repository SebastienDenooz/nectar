<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
     protected $fillable = array('name');

    public function links()
    {
        return $this->belongsToMany('App\Link', 'link_tag');
    }
}
