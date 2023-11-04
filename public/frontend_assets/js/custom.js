$(function($) {

    //Preloader Start
    $(window).load(function() {
        $('.preloader').fadeOut('slow', function() {
            $(this).remove();
        });
    });
    //Preloader End

    //test_img slider
    $('.test_slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        centerMode: true,
        centerPadding: '0px',
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true,
                    centerMode: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                }
            }
        ]
    });

    //Testimonial Slider start

    $('.testimonial_slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 1500,
        // centerMode: true,
        // centerPadding: '40px',
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    //Testimonial Slider End

    //Counter Js Start
    $('.counter').counterUp({
        delay: 30,
        time: 1500
    });
    //Counter Js End


    //wow js start
    new WOW().init();
    //wow js end


    //Menu Fixed start
    $('.top_btn').click(function() {


        $('html,body').animate({

            scrollTop: 0

        }, 1000);


    });

    var $nav = $('.header').offset().top;

    $(window).scroll(function() {

        $scrolling = $(this).scrollTop();

        if ($scrolling >= $nav) {

            $('.header').addClass('fixedmenu');


        } else {

            $('.header').removeClass('fixedmenu');


        }

        //Top Button
        if ($scrolling >= 500) {

            $('.top_btn').fadeIn();

        } else {

            $('.top_btn').fadeOut();

        }

    });
    //Menu Fixed End


    //Smooth Scroll start
    $('.header a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1500, function() {
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) {
                            return false;
                        } else {
                            $target.attr('tabindex', '-1');
                            $target.focus();
                        };
                    });
                }
            }
        });
    //Smooth SCroll End




    //Our Service Start
    $('.service_slider').slick({
        infinite: true,
        speed: 900,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        vertical: true,
        verticalSwiping: true,
        prevArrow: '<i class="fas fa-arrow-up slide_up"></i>',
        nextArrow: '<i class="fas fa-arrow-down slide_down"></i>',
        centerMode: true,
        centerPadding: '0px',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                }
            }
        ]
    });

    //Our Service End



    //Portfolio Slider start

    $('.port_slider').slick({
        infinite: true,
        speed: 900,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    // $('.port_veno').venobox({
    //     framewidth: '500px',
    //     frameheight: '400px',
    //     titleattr: 'data-title',
    //     numeratio: true,
    //     infinigall: true,
    //     spinner: 'wandering-cubes',
    // });

    //Portfolio slider End

});