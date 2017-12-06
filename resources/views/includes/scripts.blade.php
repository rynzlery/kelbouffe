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
                $('#modal-add-note').modal('open');
                $('#titre-modale-add-note').html("Ajouter une note à " + data.name);
                $('#hidden-plat_id').val(data.id);
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function(){
            }
        });
    };

    function EditPlat(id) {
        $.ajax({
            url: '{{ URL::to('EditPlat') }}',
            type: 'GET',
            data: {id: id},
            dataType: 'JSON',
            beforeSend: function(){
            },
            success: function (data) {
                console.log(data);
                $('#modal-add').modal('open');
                $('#title-modal-plat').html("Modifier le plat " + data.name);
                $('.hidden-plat_id').val(data.id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                //$('#mark').val(data.mark);
                //$('#fat').val(data.fat);
                $('#url').val(data.url);
                $('label').addClass('active');
                $('#form-bottom').attr('action', 'UpdatePlat');
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            },
            complete: function(){
            }
        });
    }

    function ModaleDeletePlat(id, name) {
        $('#modal-delete').modal('open');
        $('#titre-modale-delete-plat').html("Supprimer le plat : " + name + " ?");
        $('#hidden-delete-plat_id').val(id);
    };

    function DisplayTuto() {
        $('#tuto-target-1').tapTarget('open');
    }

    function EmptyModal() {
        $('#title-modal-plat').html('Ajouter un nouveau plat ?');
        $('#name').val("");
        $('#price').val("");
        $('#mark').val("");
        $('#fat').val("");
        $('#url').val("");
        $('label').removeClass('active');
        $('#form-bottom').attr('action', 'Create');
    }

    @if(!isset($cookieFirstVisit))
        DisplayTuto();
    @endif

</script>