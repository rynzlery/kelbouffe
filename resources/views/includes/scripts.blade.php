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
            type: 'POST',
            data: {id: id},
            dataType: 'JSON',
            beforeSend: function(){
                debugger;
            },
            success: function (data) {
                debugger;
                console.log(data);
            },
            complete: function(){
                debugger;
            }
        });
    };
</script>