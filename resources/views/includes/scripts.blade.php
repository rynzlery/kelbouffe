<script src="{{ URL::asset('public/bower/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/materialize/dist/js/materialize.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/vue/dist/vue.min.js') }}" async></script>
<script src="{{ URL::asset('public/bower/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ URL::asset('public/js/main.js') }}"></script>
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->

<script>
    function NewNote(id) {
        $.ajax({
            url: '{{ URL::to('AddNote') }}',
            type: 'GET',
            data: {id: id},
            dataType: 'JSON',
            beforeSend: function(){
            },
            success: function (data) {
                console.log(data);
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function(){
            }
        });
    };
</script>