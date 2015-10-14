@if (Auth::check())
    <form id="add_link">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="link_url">Url address</label>
            <input type="text" class="form-control" name="link_url" id="link_url" placeholder="Url">
        </div>
        <div class="form-group">
            <label for="link_url">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" rows="3" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="link_tags">Tags</label>
            <input type="text" class="form-control" id="link_tags" name="link_tags" placeholder="Tags">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="is_private" name="is_private"> Private link
            </label>
        </div>
        <br/>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </form>
@else
    <form action="/auth/login" method="POST">
        @include('auth.login')
        <input type="hidden" name="redirect" value="/api/links/create">
        <div class="form-group">
            <button type="submit" class="btn btn-default">Login</button>
        </div>
    </form>
@endif