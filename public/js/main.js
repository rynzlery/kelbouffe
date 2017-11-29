
$(".button-collapse").sideNav();

$(document).ready( function() {
    $('select').material_select();

    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();

    $('.tooltipped').tooltip({delay: 50});
});

$(document).ready( function() {
    $('.js-scrollTo').on('click', function() {
        var page = $(this).attr('href');
        var speed = 1000;
        $('html, body').animate( { scrollTop: $(page).offset().top }, speed );
        return false;
    });
});

$(document).ready(function() {
    $('.card-image').hover( function(){
        $(this).children("div").show();
        $(this).children("span").stop(true, true).fadeIn();
        $(this).children("span").fadeOut();
        $(this).children("div").removeClass('fadeOut');
        $(this).children("div").addClass('fadeIn');
    }, function(){
        $(this).children("span").stop(true, true).fadeOut();
        $(this).children("span").fadeIn();
        $(this).children("div").removeClass('fadeIn');
        $(this).children("div").addClass('fadeOut');
    });
});