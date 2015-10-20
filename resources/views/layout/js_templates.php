<script type="html/template" id="link_edit_form_template">
    <input type="hidden" name="_token" value="{{_token}}">
    <input type="hidden" name="link_id" value="{{link.id}}">
    <div class="form-group">
        <label for="link_url">Url address</label>
        <input type="text" class="form-control" name="link_url" id="link_url" placeholder="Url" value="{{link.source}}">
    </div>
    <div class="form-group">
        <label for="link_url">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{link.title}}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" class="form-control" rows="3" placeholder="Description">{{link.description}}</textarea>
    </div>
    <div class="form-group">
        <label for="link_tags">Tags</label>
        <input type="text" class="form-control" id="link_tags" name="link_tags" placeholder="Tags" value="{{#tags}}{{name}},{{/tags}}">
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" id="is_private" name="is_private" {{#make_private}}checked="checked"{{/make_private}}> Private link
        </label>
    </div>
</script>