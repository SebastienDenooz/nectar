@include('layout.modals')
<script src="/js/all.js"></script>
<script>
    $(function() {
        $('#link_tags').selectize({
            valueField: 'name',
            labelField: 'name',
            searchField: 'name',
            create: false,
            render: {
                option: function(item, escape) {
                    return '<div>' +
                            '<span class="title">' +
                            '<span class="name">' + escape(item.name) + '</span>' +
                            '</span>' +
                            '</div>';
                }
            },
            score: function(search) {
                var score = this.getScoreFunction(search);
                return function(item) {
                    return score(item) * (1 + Math.min(item.watchers / 100, 1));
                };
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/api/tags/?search=' + encodeURIComponent(query),
                    type: 'GET',
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        console.log(res);
                        callback(res.slice(0, 10));
                    }
                });
            }
        });

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
                $(self).before('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Link well saved</div>');
            }).always(function(e){
                console.log('always', e);
            }).fail(function(e){
                $(self).before('<div class="alert alert-error" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Something went wrong...</div>');
            });
        });
    });
    
</script>
