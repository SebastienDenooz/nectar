@include('layout.modals')
<script src="/js/all.js"></script>
<script>
    $(function() {
        $('#link_tags').selectize({
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    });
</script>
