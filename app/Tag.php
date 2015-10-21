<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{
     protected $fillable = array('name');

    public function links()
    {
        return $this->belongsToMany('App\Link', 'link_tag');
    }

    public static function getUsetDashboard($id)
    {
        return Tag::find($id)->links()
                ->where('is_private', '=', 0)
                ->orWhere(
                function ($query) {
                    $query->where('user_id', '=', Auth::user()->id)
                    ->where('is_private', '=', 1);
                }
            )->take(env('DEFAULT_NUMBER_OF_LINK_ITEM'))->orderBy('updated_at', 'DESC')->get();

    }

    public static function getAnonymousDashboard($id)
    {
        $tag = Tag::find($id);

        return $tag->links()->where('is_private', '<', '1')
            ->take(env('DEFAULT_NUMBER_OF_LINK_ITEM'))
            ->orderBy('updated_at', 'DESC')
            ->get();
    }
}
