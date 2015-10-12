<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div  class="form-group">
        <label for="auth_email">Email</label>
        <input  class="form-control" id="auth_email" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div  class="form-group">
        <label for="auth_password">Password</label>
        <input  class="form-control" id="auth_password"  type="password" name="password">
    </div>

    <div  class="checkbox">
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <div  class="form-group">
        <button type="submit" class="btn btn-default">Login</button>
    </div>
</form>