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
use Symfony\Component\HttpFoundation\Response;

class LinkController extends Controller
{
    function __construct()
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::all();

        return Auth::check() ? view('index', [
            'links' => Link::getUserDashboard(),
            'tags' => $tags
        ]) : view('index', [
            'links' => Link::getAnonymousDashboard(),
            'tags' => $tags
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'link' => $request->has('link') ? $request->input('link') : '',
            'title' => $request->has('title') ? $request->input('title') : '',
        ];
        return view('Link/create', $data);
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
        $link = Link::find($id);
        return response()->json([
            'link' => Link::find($id)->toArray(),
            'tags' => $link->tags()->get()
        ]);
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

        $link = Link::find($id);

        if (!$link->user_id == Auth::user()->id){
            return new \Illuminate\Http\Response('No link or no permission to delete', 403);
        }

        $link->source = $request->has('source') ? $request->input('source') : $link->source ;
        $link->md5_source = $request->has('md5_source') ? md5($request->input('source')) : $link->md5_source ;
        $link->title = $request->has('title') ? $request->input('title') : $link->title ;
        $link->description = $request->has('description') ? $request->input('description') : $link->description ;
        $link->is_private = $request->has('is_private') ? $request->input('is_private') : $link->is_private ;

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tag) {
                $_tag = Tag::firstOrNew(['name' => $tag]);
                $_tag->save();

                if (!$link->tags->contains($_tag->id)) {
                    $link->tags()->attach($_tag);
                }

            }
        }

        $link->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Link::where([
            'user_id' => Auth::user()->id,
            'id' => $id]
        )->delete()) {
            return new \Illuminate\Http\Response('', 202);
        }

        return new \Illuminate\Http\Response('No link or no permission to delete', 403);
    }
}
