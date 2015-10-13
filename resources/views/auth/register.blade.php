{!! csrf_field() !!}

<div class="form-group">
    <label for="register_name">Name</label>
    <input class="form-control" id="register_name" type="text" name="name" value="{{ old('name') }}">
</div>

<div class="form-group">
    <label for="register_name">Email</label>
    <input class="form-control" id="register_email" type="email" name="email" value="{{ old('email') }}">
</div>

<div class="form-group">
    <label for="register_name">Password</label>
    <input class="form-control" id="register_password" type="password" name="password">
</div>

<div class="form-group">
    <label for="register_name">Confirm password</label>
    <input class="form-control" id="register_password_confirmation" type="password" name="password_confirmation">
</div>
