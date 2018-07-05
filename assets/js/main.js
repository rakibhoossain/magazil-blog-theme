(function($) {
    'use strict';

$(document).ready(function($) {

    var window_width = $(window).width(),
        window_height = window.innerHeight,
        header_height = $(".default-header").height(),
        header_height_static = $(".site-header.static").outerHeight(),
        fitscreen = window_height - header_height;

    $(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

    //------- Superfist nav menu  js --------//  

    $('.nav-menu').superfish({
        animation: {
            opacity: 'show'
        },
        speed: 400
    });

    //-------Related Post carosul--------//
    $('#related_posts').owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        autoplayHoverPause: true,
        smartSpeed:650,
        nav: true,
        navText: ["<span class='lnr lnr-arrow-left'></span>", "<span class='lnr lnr-arrow-right'></span>"],       
        autoplay:true, 
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            }
        }
    });

    //------- Search Form  js --------//  

    $(document).ready(function(){

        var prev_search = '',
        typingTimer,
        search_container = false,
        datafetc = $('#datafetch');

        datafetc.html( '' );

        // Event on open
        $('#search-open').on("click",(function(e){

            $('#search').on("keyup", (function(ev){
                var value = '';
                if ($('#search').val()) {
                    value = $('#search').val();
                }
                    value = $.trim(value);

                if ( value.length >= 1 && value != prev_search ) {
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(fetch(value), 750);
                    search_container = true;
                    datafetc.slideDown().html( '<div class="fa loading fa-spinner fa-spin"></div>' );
                    prev_search = value;
                }
                if ( value.length < 1 ) {
                    datafetc.slideUp();
                    datafetc.html( '' );
                }

            }));

            $('#search').addClass("search-active").focus();
            e.stopPropagation()

        }));

        $('body').on("click",(function(e){
            if (search_container) {
                search_container = false;
                datafetc.slideUp();
                $('#search').removeClass("search-active");
            }
            e.stopPropagation()
        }));

        // Event on close
        $('#search-close').on("click",(function(e){
            search_container = false;
            datafetc.slideUp();
            $('#search').removeClass("search-active");
            e.stopPropagation()
        }));
    })

    //------- Mobile Nav  js --------//  

    if ($('#nav-menu-container').length) {
        var $mobile_nav = $('#nav-menu-container').clone().prop({
            id: 'mobile-nav'
        });
        $mobile_nav.find('> ul').attr({
            'class': '',
            'id': ''
        });
        $('body .main-menu').append($mobile_nav);
        $('body .main-menu').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i><span class="menu-title">Menu</span> </button>');
        $('body .main-menu').append('<div id="mobile-body-overly"></div>');
        $('#mobile-nav').find('.menu-item-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');

        $(document).on('click', '.menu-item-has-children i', function(e) {
            $(this).next().toggleClass('menu-item-active');
            $(this).nextAll('ul').eq(0).slideToggle();
            $(this).toggleClass("lnr-chevron-up lnr-chevron-down");
        });

        $(document).on('click', '#mobile-nav-toggle', function(e) {
            $('body').toggleClass('mobile-nav-active');
            $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
            $('#mobile-body-overly').toggle();
        });

            $(document).on('click', function(e) {
            var container = $("#mobile-nav, #mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
                    $('#mobile-body-overly').fadeOut();
                }
            }
        });
    } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
        $("#mobile-nav, #mobile-nav-toggle").hide();
    }


    //------- Sticky Main Menu js --------//  


    window.onscroll = function() {stickFunction()};

    var navbar = document.getElementById("main-menu");
    var sticky = navbar.offsetTop;
    function stickFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("fixed")
      } else {
        navbar.classList.remove("fixed");
      }
    }


    //------- Sidebar Nav  js --------//  

    if ($('#side-menu').length) {

        $('#side-menu.min-list').find('.page_item_has_children').prepend('<i class="lnr side-menu-i"></i>');
        $('.current_page_item').parents('ul').slideDown();

        $(document).on('click', '#side-menu.min-list .page_item_has_children i', function(e) {
            $(this).next().toggleClass('menu-item-active');
            $(this).nextAll('ul').slideToggle();
            $(this).toggleClass("rotate-180");
        });
    }

    //------- Smooth Scroll  js --------//  

    $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            if (target.length) {
                var top_space = 0;

                if ($('#header').length) {
                    top_space = $('#header').outerHeight();

                    if (!$('#header').hasClass('header-fixed')) {
                        top_space = top_space;
                    }
                }

                $('html, body').animate({
                    scrollTop: target.offset().top - top_space
                }, 1500, 'easeInOutExpo');

                if ($(this).parents('.nav-menu').length) {
                    $('.nav-menu .menu-active').removeClass('menu-active');
                    $(this).closest('li').addClass('menu-active');
                }

                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('lnr-times lnr-bars');
                    $('#mobile-body-overly').fadeOut();
                }
                return false;
            }
        }
    });

    $(document).ready(function() {

        $('html, body').hide();

        if (window.location.hash) {

            setTimeout(function() {

                $('html, body').scrollTop(0).show();

                $('html, body').animate({

                    scrollTop: $(window.location.hash).offset().top - 108

                }, 1000)

            }, 0);

        } else {

            $('html, body').show();

        }

    });

    // Sticky sidebar
    $(document).ready(function() {
        $('.row .magazil__sticky_sidebar').theiaStickySidebar();
    });

    // Adsense loader
    $(document).ready(function() {
        
    var selector = $('.newsmag-adsense');
        if ( selector.length ) {
            // jQuery
            selector.adsenseLoader({
                onLoad: function ($ad) {
                    $ad.addClass('adsense--loaded');
                }
            });
        }

    });


    // smooth mousewheel
    $(document).ready(function() {
        if (window.addEventListener) window.addEventListener('DOMMouseScroll', wheel, false);
        window.onmousewheel = document.onmousewheel = wheel;

        function wheel(event) {
            var delta = 0;
            if (event.wheelDelta) delta = event.wheelDelta / 120;
            else if (event.detail) delta = -event.detail / 3;

            handle(delta);
            if (event.preventDefault) event.preventDefault();
            event.returnValue = false;
        }

        var goUp = true;
        var end = null;
        var interval = null;

        function handle(delta) {
            var animationInterval = 20; //lower is faster
          var scrollSpeed = 20; //lower is faster

            if (end == null) {
            end = $(window).scrollTop();
          }
          end -= 20 * delta;
          goUp = delta > 0;

          if (interval == null) {
            interval = setInterval(function () {
              var scrollTop = $(window).scrollTop();
              var step = Math.round((end - scrollTop) / scrollSpeed);
              if (scrollTop <= 0 || 
                  scrollTop >= $(window).prop("scrollHeight") - $(window).height() ||
                  goUp && step > -1 || 
                  !goUp && step < 1 ) {
                clearInterval(interval);
                interval = null;
                end = null;
              }
              $(window).scrollTop(scrollTop + step );
            }, animationInterval);
          }
        }

    });   
});

}(jQuery));


// Breaking News
function createTicker(){
    var tickerLIs   = jQuery("#breaking-news ul").children();
    tickerItems     = new Array();
    tickerLIs.each(function(el) {
        tickerItems.push( jQuery(this).html() );
    });
    i = 0  ;
    rotateTicker();
}
var isInTag = false;
function typetext() {
    var $breaking_news = jQuery('#breaking-news ul');
    if( $breaking_news.length > 0 ){
        var thisChar = tickerText.substr(c, 1);
        if( thisChar == '<' ){ isInTag = true; }
        if( thisChar == '>' ){ isInTag = false; }
        $breaking_news.html(tickerText.substr(0, c++));
        if(c < tickerText.length+1)
            if( isInTag ){
                typetext();
            }else{
                setTimeout("typetext()", 35);
            }
        else {
            c = 1;
            tickerText = "";
        }
    }
}