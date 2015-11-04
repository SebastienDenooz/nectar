<!DOCTYPE html>
<html>
<head>
    <title>Nectar</title>
    @include('layout.head')
</head>
<body>
<div class="container">
    @yield('content')
    @show
</div>
@include('layout.end_page')
</body>
</html>