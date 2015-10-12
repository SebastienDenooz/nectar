<!DOCTYPE html>
<html>
    <head>
        <title>Nectar</title>
        <link href="/css/all.css" rel="stylesheet" crossorigin="anonymous">
        <link href="/css/app.css" rel="stylesheet" crossorigin="anonymous">
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
                    <h4 class="list-group-item-heading"><a href="/links/{{$link->source}}">{{$link->title}}</a></h4>
                    <p><em>By <a href="#">{{$link->user->name}}</a> at <a href="/link/{{$link->id}}">{{$link->created_at}}</a></em></p>
                    <p class="list-group-item-text">{{$link->description}}</p>
                    <!-- <p><a href="#"><span class="label label-default">Tools</span></a>&nbsp;<a href="#"><span class="label label-default">Open source</span></a></p> -->
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            @include('layout.add_link_form')
        </div>
    </div>
</div>
@include('layout.end_page')
</body>
</html>