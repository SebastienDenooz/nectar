<!DOCTYPE html>
<html>
    <head>
        <title>Nectar</title>
        @include('layout.head')
    </head>
<body>
<div class="container">
    <header>
        @include('layout.nav')
    </header>
    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($links as $link)
                <div class="list-group-item">
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
                    <p>@foreach($link->tags as $tag)<a href="/tags/{{$tag->id}}"><span class="label label-default">{{$tag->name}}</span></a>&nbsp;@endforeach</p>

                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@include('layout.end_page')
</body>
</html>