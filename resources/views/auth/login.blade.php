@extends('layout.master')

@section('content')
    <form method="POST" action="/auth/login">
        @include('forms.login')
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Login"/>
        </div>
    </form>
@endsection