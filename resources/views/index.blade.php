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
                    <h4 class="list-group-item-heading"><a href="{{$link->source}}">{{$link->title}}</a></h4>
                    <p class="list-group-item-text">{{$link->description}}</p>
                    <p><em>By <a href="/users/{{$link->user->id}}">{{$link->user->name}}</a> at <a href="/link/{{$link->id}}">{{$link->created_at}}</a></em></p>
                    <p>@foreach($link->tags as $tag)<a href="/tags/{{$tag->id}}"><span class="label label-default">{{$tag->name}}</span></a>&nbsp;@endforeach</p>

                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            @include('layout.add_bookmarklet_box')
        </div>
    </div>
</div>
@include('layout.end_page')
</body>
</html>