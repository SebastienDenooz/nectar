<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Link extends Model
{
    protected $fillable = ['source', 'md5_source', 'title', 'description', 'is_private', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'link_tag');
    }

    static function getUserDashboard () {
        return Link::where(
            function($query) {
                $query->where('is_private', '=', 0);
            }
        )->orWhere(
            function ($query) {
                $query->where('user_id', '=', Auth::user()->id)->where('is_private', '=', 1);
            }
        )->orderBy('updated_at', 'DESC')->simplePaginate(env('DEFAULT_NUMBER_OF_LINK_ITEM'));
    }

    static function getAnonymousDashboard () {
        return Link::where('is_private', '<', '1')
            ->orderBy('updated_at', 'DESC')
            ->simplePaginate(env('DEFAULT_NUMBER_OF_LINK_ITEM'));
    }
}
