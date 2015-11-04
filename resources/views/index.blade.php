@extends('layout.master')
@section('content')
    <header>
        @include('layout.nav')
    </header>
    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($links as $link)
                <div class="list-group-item" data-edit_token="{{ csrf_token() }}" data-delete_token="{{ csrf_token() }}" data-link_id="{{ $link->id }}">
                    <!-- <img class="pull-left img-responsive" src="http://fakeimg.pl/100x100/" alt="#" style="margin-right: 15px;"> -->
                    @if (Auth::check() && Auth::user()->id == $link->user_id)
                        <div class="btn-group pull-right" role="group" aria-label="...">
                            <button type="button" class="btn btn-xs btn-default edit_link"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-xs btn-default delete_link"><i class="fa fa-trash"></i></button>
                        </div>
                    @endif
                    <h4 class="list-group-item-heading"><a href="{{$link->source}}">{{$link->title}}</a></h4>
                    <div class="list-group-item-text">{!!Parsedown::instance()->text($link->description) !!}</div>
                    <p><em>By <a href="/users/{{$link->user->id}}">{{$link->user->name}}</a> at <a href="/link/{{$link->id}}">{{$link->created_at}}</a></em></p>
                    <p>@foreach($link->tags as $tag)<a href="/tag/{{$tag->id}}"><span class="label label-default">{{$tag->name}}</span></a>&nbsp;@endforeach</p>

                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <p class="tag_cloud text-center">
                @foreach($tags as $tag)<a style="margin: 5px; font-size: {{0.5+($tag->links()->get()->count()/5)}}em" class="btn btn-default {{ $tag->active == 1 ? 'active' : '' }}" href="/tag/{{$tag->id}}">{{$tag->name}}&nbsp;&nbsp;<span class="badge">{{$tag->links()->get()->count()}}</span></a>&nbsp;@endforeach
            </p>
        </div>
    </div>
@endsection