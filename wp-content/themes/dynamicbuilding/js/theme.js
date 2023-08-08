jQuery(function($) {
    var $ = jQuery;
    setTimeout(function () {
        $(".project-gallery-wrapper").addClass('ani-show');
    }, 500);
    if($(window).width() > 991) {
        var waypoint = new Waypoint({
            element: document.getElementById('header'),
            handler: function () {
                setTimeout(function() {
                    $("#header").addClass('fixed');
                    $(".wrapper").addClass('marginTop');
                }, 500);
            },
            offset: -80
        });
    }
    if($(window).width() <= 767) {
        $('.top').click(function(event){
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
        var waypoint = new Waypoint({
            element: document.getElementById('header'),
            handler: function() {
                $(".top").toggleClass('show');
            },
            offset: -500
        });
    }
    if($(".page-id-5").length)
    {
        setTimeout(function () {
            $(".logo-overlay").addClass('ani-show');
        }, 500);
        setTimeout(function () {
            $(".slogan-overlay .s1").addClass('ani-show');
        }, 800);
        setTimeout(function () {
            $(".slogan-overlay .s2").addClass('ani-show');
        }, 1500);
        setTimeout(function () {
            $(".slogan-overlay .s3").addClass('ani-show');
        }, 2000);
    }
    var $container = $(".grid");
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.grid-item'
        });
    });
});