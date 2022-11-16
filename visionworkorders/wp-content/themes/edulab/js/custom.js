jQuery(document).ready(function($){
    // responsive menu
    $('#bar').click(function(){
        $('.nav-desktop').css({'display':'flex'});
        $('#bar').css({'display':'none'});
        $('#close').css({'display':'flex'});
    });


    $('#close').click(function(){
        $('.nav-desktop').css({'display':'none'});
        $('#bar').css({'display':'flex'});
        $('#close').css({'display':'none'});
    });

    // courses
    $('.owl-one').owlCarousel({
        loop:true,
        margin:30,
        mouseDrag: false,
        responsiveClass:true,
        // nav: true,
        navText: ["<",">"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:2,
                nav:true,
                loop:false,
                margin:10
            },
            1024:{
                items:2,
                nav:true,
                loop:false,
                margin:30
            },
            1200:{
                items:3,
                nav:true,
                loop:false
            }
        }
    });

    $('.owl-two').owlCarousel({
        loop:true,
        margin:30,
        responsiveClass:true,
        // nav: true,
        navText: ["<",">"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:2,
                nav:true,
                loop:true,
                margin:10
            },
            1024:{
                items:2,
                nav:true,
                loop:false
            }
        }
    });

    $('.owl-three').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        // nav: true,
        navText: ["<",">"],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:true
            }
        }
    });

    // For Banner Slider Home Page
    $('.owl-four').owlCarousel({
        loop:true,
        responsiveClass:true,
        nav: true,
        dots: false,
        navText: ["<",">"],
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true
            },
            600:{
                items:1,
                nav:true,
                loop:true
            },
            1000:{
                items:1,
                nav:true,
                loop:true
            }
        }
    });

    // Owl Carousel For Video
    $('.owl-five').owlCarousel({
        items:1,
        loop:true,
        margin:0,
        video:true,
        autoHeight:true,
        lazyLoad:true,
        center:true,
        nav:true,
        responsive:{
            480:{
                items:1
            },
            600:{
                items:1
            }
        }
    });

    $('.three').owlCarousel({
        loop:false,
        responsiveClass:true,
        nav: true,
        dots: false,
        responsive:{
            0:{
                items:1,
                nav: false,
                dots: true
            },
            768:{
                items:1,
                nav:true,
                loop:true,
                margin:10
            },
            1024:{
                items:1,
                nav:true,
                loop:true,
                margin:30
            },
            1200:{
                items:1,
                nav:true,
                loop:false
            }
        }
    });
});