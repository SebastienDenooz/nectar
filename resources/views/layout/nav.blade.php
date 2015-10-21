
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Nectar</a>
        </div>
        <form class="navbar-form navbar-left" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
        </form>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (!Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#login_modal">Login</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#register_modal">Register</a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/users/{{Auth::user()->id}}">{{Auth::user()->name}}</a></li>
                    <li><a href="/auth/logout"><i class="fa fa-sign-out"></i></a></li>
                </ul>
                <a data-toggle="tooltip" data-placement="left" title="Bookmark this and use it during browsing to save links!" href="javascript:(function()%7Bvar%20link%20%3D%20encodeURIComponent(location.href)%2Ctitle%20%3D%20document.title%20%7C%7C%20location.href%3Bwindow.open('{{env('SITE_BASE_URL','http://nectar.app')}}%2Fapi%2Flinks%2Fcreate%3Flink%3D'%20%2B%20link%20%2B%20'%26title%3D'%20%2B%20title%2C'targetWindow'%2C%20'toolbar%3Dno%2Clocation%3Dno%2Cstatus%3Dno%2Cmenubar%3Dno%2Cscrollbars%3Dyes%2Cresizable%3Dyes%2Cwidth%3D600%2Cheight%3D250')%7D)()" class="btn btn-default navbar-btn pull-right">Add link</a>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>