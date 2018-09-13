$(document).ready(function(){

    $('.fancybox').fancybox();

    $('.ico-menu').click(function () {
        $('.menu-mobile').slideToggle('fast');
        $(this).toggleClass('open-menu');
    });

    $('.menu-mobile a').click(function () {
        $('.ico-menu').removeClass('open-menu');
    });

    $('nav .menu a, nav .logo, .menu-mobile a, .btn-scroll').click(function (e) {
        e.preventDefault();
        var elem = $(this).attr('href');
        var sectionPos = $(elem).offset().top - 62;

        $('html, body').animate({'scrollTop': sectionPos}, 1000);
        $('.menu-mobile').hide();
    });
});



