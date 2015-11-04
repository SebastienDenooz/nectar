@include('layout.modals')
<script src="/js/all.js"></script>
<script>
    hljs.initHighlightingOnLoad();
    $(function() {

        function selectizSelects(){
            $('#link_tags').selectize({
                valueField: 'name',
                labelField: 'name',
                searchField: 'name',
                create: true,
                preload: true,
                load: function(query, callback) {
                    if (!query.length) return callback();
                    $.ajax({
                        url: '{{env('SITE_BASE_URL','http://nectar.app')}}/api/tags/?search=' + encodeURIComponent(query),
                        type: 'GET',
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res.slice(0, 10));
                        }
                    });
                }
            });
        }
        $('[data-toggle="tooltip"]').tooltip();
        selectizSelects();

        function buildDataForNewLink(form){
            return {
                _token: $('input[name="_token"]', form).val(),
                source: $('input#link_url', form).val(),
                title: $('input#title', form).val(),
                description: $('textarea#description', form).val(),
                is_private: $('input#is_private:checked').length ? 1 : 0,
                tags: $('input#link_tags', form).val()
            };
        }

        $('.list-group-item').on('click', '.delete_link', function () {

            if (!confirm('Realy delete?')) {
                return;
            }

            var link = $(this).closest('.list-group-item'), request = $.ajax({
                'url' : '/api/links/' + link.data('link_id'),
                'method' : 'DELETE',
                'data' : { _token : link.data('delete_token') }
            });

            $.when( request ).done(function () {
                link.slideUp();
            }).fail( function(e) {
                console.log(e);
                link.prepend('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Something went wrong...</div>');
            }).always( function (e) {
                console.log(e);
            });

        });

        $('.list-group-item').on('click', '.edit_link', function () {

            var link = $(this).closest('.list-group-item'),
                request = $.ajax({
                    'url' : '/api/links/' + link.data('link_id'),
                    'method' : 'GET'
                }),
                form_template = $('#link_edit_form_template').html(),
                modal_template = $('#edit_link_modal');

            $.when( request ).done(function (e) {
                e.is_private == 1 ? e.make_private = 1 : e;
                e._token = link.data('edit_token');
                modal_template.find('.modal-body').html(
                    Mustache.render(form_template, e)
                );
                modal_template.modal();
                selectizSelects();
            }).fail( function(e) {
                console.log(e);
                link.prepend('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Something went wrong...</div>');
            }).always( function (e) {
                console.log(e);
            });

        });

        $('#edit_link_modal').on('submit', 'form', function () {
            "use strict";

            event.preventDefault();

            var self = this,
                request = $.ajax({
                    url: '/api/links/' + $(self).find('input[name="link_id"]').val(),
                    type: 'PUT',
                    data: buildDataForNewLink(self)
                });

            $.when( request ).done( function (data) {
                $(self).before('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Link well update</div>');
            }).always(function(e){
                console.log('always', e);
            }).fail(function(e){
                $(self).before('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Something went wrong...</div>');
            });

        });

        $('form#add_link').on('submit', function(){
            "use strict";

            event.preventDefault();

            var self = this,
                request = $.ajax({
                    url: '/api/links',
                    type: 'POST',
                    data: buildDataForNewLink(self)
                });

            $.when( request ).done( function (data) {
                $(self).slideUp();
                $.when(
                    $(self).before('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Link well saved</div>')
                ).done( window.close() );

            }).always(function(e){
                console.log('always', e);
            }).fail(function(e){
                $(self).before('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Something went wrong...</div>');
            });
        });

        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });

</script>
