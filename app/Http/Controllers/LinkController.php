<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Use_;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Auth::check() ? view('index', [
            'links' => Link::getUsetDashboard()
        ]) : view('index', [
            'links' => Link::getAnonymousDashboard()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()){

            $link = [
                'source' => $request->input('source'),
                'md5_source' => md5($request->input('source')),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id,
                'is_private' => $request->input('is_private'),
            ];


            $link = Link::firstOrNew($link);
            $link->save();

            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tag) {
                $_tag = Tag::firstOrNew(['name' => $tag]);
                $_tag->save();
                $link->tags()->attach($_tag);
            }

            return response()->json(['link' => $link, 'tags' => $link->tags()->get()]);

        } else {

            return redirect('auth/login');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
