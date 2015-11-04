<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource in rss format.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $full_links = [];
        $links = Link::where('is_private', '<', '1')->get();

        foreach ($links as $link) {
            $full_links[] = [
                'link' => $link->toArray(),
                'tags' => $link->tags()->get()
            ];

        }

        return response()->json($full_links);
    }

}
