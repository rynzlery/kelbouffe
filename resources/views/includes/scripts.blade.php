<script src="{{ URL::asset('public/bower/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/materialize/dist/js/materialize.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/vue/dist/vue.min.js') }}" async></script>
<script src="{{ URL::asset('public/bower/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('public/bower/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ URL::asset('public/js/main.js') }}"></script>
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<script type="text/javascript">
	$(".button-collapse").sideNav();

	$(document).ready(function() {
		$('select').material_select();

        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();

        $('.tooltipped').tooltip({delay: 50});
    });
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.js-scrollTo').on('click', function() {
			var page = $(this).attr('href');
			var speed = 1000;
			$('html, body').animate( { scrollTop: $(page).offset().top }, speed );
			return false;
		});
	});
</script>