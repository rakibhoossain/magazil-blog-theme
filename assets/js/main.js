(function($) {
    'use strict';


$(document).ready(function($) {
    "use strict";

    var window_width = $(window).width(),
        window_height = window.innerHeight,
        header_height = $(".default-header").height(),
        header_height_static = $(".site-header.static").outerHeight(),
        fitscreen = window_height - header_height;

    $(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

    //------- Niceselect  js --------//  

    if (document.getElementById("default-select")) {
        $('select').niceSelect();
    };
    if (document.getElementById("default-select2")) {
        $('select').niceSelect();
    };

    //------- Lightbox  js --------//  

    $('.img-gal').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    $('.play-btn').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    //------- Datepicker  js --------//  

      $( function() {
        $( "#datepicker" ).datepicker();
        $( "#datepicker2" ).datepicker();
      } );

    //---------------News Ticker--------//
    // $('#js-news').tickerme();

    //------- Superfist nav menu  js --------//  

    $('.nav-menu').superfish({
        animation: {
            opacity: 'show'
        },
        speed: 400
    });

    //------- Accordion  js --------//  

    jQuery(document).ready(function($) {

        if (document.getElementById("accordion")) {

            var accordion_1 = new Accordion(document.getElementById("accordion"), {
                collapsible: false,
                slideDuration: 500
            });
        }
    });

    //------- Owl Carusel  js --------//  

    $('.active-gallery-carusel').owlCarousel({
        items:1,
        loop:true,
        nav:true,
        navText: ["<span class='lnr lnr-arrow-left'></span>",
        "<span class='lnr lnr-arrow-right'></span>"],  
        smartSpeed:650,           
    });

    $('.active-testimonial').owlCarousel({
        items: 2,
        loop: true,
        margin: 30,
        autoplayHoverPause: true,
        dots: true,
        autoplay: true,
        nav: true,
        navText: ["<span class='lnr lnr-arrow-up'></span>", "<span class='lnr lnr-arrow-down'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            }
        }
    });

    $('.active-brand-carusel').owlCarousel({
        items: 4,
        loop: true,
        margin: 30,
        autoplayHoverPause: true,
        smartSpeed:650,         
        autoplay:true, 
        responsive: {
            0: {
                items: 2
            },
            480: {
                items: 2,
            },
            768: {
                items: 4,
            }
        }
    });

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

    //------- Google Map  js --------//  

    // if (document.getElementById("map")) {
    //     google.maps.event.addDomListener(window, 'load', init);

    //     function init() {
    //         var mapOptions = {
    //             zoom: 11,
    //             center: new google.maps.LatLng(40.6700, -73.9400), // New York
    //             styles: [{
    //                 "featureType": "water",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#e9e9e9"
    //                 }, {
    //                     "lightness": 17
    //                 }]
    //             }, {
    //                 "featureType": "landscape",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#f5f5f5"
    //                 }, {
    //                     "lightness": 20
    //                 }]
    //             }, {
    //                 "featureType": "road.highway",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [{
    //                     "color": "#ffffff"
    //                 }, {
    //                     "lightness": 17
    //                 }]
    //             }, {
    //                 "featureType": "road.highway",
    //                 "elementType": "geometry.stroke",
    //                 "stylers": [{
    //                     "color": "#ffffff"
    //                 }, {
    //                     "lightness": 29
    //                 }, {
    //                     "weight": 0.2
    //                 }]
    //             }, {
    //                 "featureType": "road.arterial",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#ffffff"
    //                 }, {
    //                     "lightness": 18
    //                 }]
    //             }, {
    //                 "featureType": "road.local",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#ffffff"
    //                 }, {
    //                     "lightness": 16
    //                 }]
    //             }, {
    //                 "featureType": "poi",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#f5f5f5"
    //                 }, {
    //                     "lightness": 21
    //                 }]
    //             }, {
    //                 "featureType": "poi.park",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#dedede"
    //                 }, {
    //                     "lightness": 21
    //                 }]
    //             }, {
    //                 "elementType": "labels.text.stroke",
    //                 "stylers": [{
    //                     "visibility": "on"
    //                 }, {
    //                     "color": "#ffffff"
    //                 }, {
    //                     "lightness": 16
    //                 }]
    //             }, {
    //                 "elementType": "labels.text.fill",
    //                 "stylers": [{
    //                     "saturation": 36
    //                 }, {
    //                     "color": "#333333"
    //                 }, {
    //                     "lightness": 40
    //                 }]
    //             }, {
    //                 "elementType": "labels.icon",
    //                 "stylers": [{
    //                     "visibility": "off"
    //                 }]
    //             }, {
    //                 "featureType": "transit",
    //                 "elementType": "geometry",
    //                 "stylers": [{
    //                     "color": "#f2f2f2"
    //                 }, {
    //                     "lightness": 19
    //                 }]
    //             }, {
    //                 "featureType": "administrative",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [{
    //                     "color": "#fefefe"
    //                 }, {
    //                     "lightness": 20
    //                 }]
    //             }, {
    //                 "featureType": "administrative",
    //                 "elementType": "geometry.stroke",
    //                 "stylers": [{
    //                     "color": "#fefefe"
    //                 }, {
    //                     "lightness": 17
    //                 }, {
    //                     "weight": 1.2
    //                 }]
    //             }]
    //         };
    //         var mapElement = document.getElementById('map');
    //         var map = new google.maps.Map(mapElement, mapOptions);
    //         var marker = new google.maps.Marker({
    //             position: new google.maps.LatLng(40.6700, -73.9400),
    //             map: map,
    //             title: 'Snazzy!'
    //         });
    //     }
    // }

    //------- Mailchimp js --------//  

    // $(document).ready(function() {
    //     $('#mc_embed_signup').find('form').ajaxChimp();
    // });




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







// youtube custom play button and thumbail script


/*    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    var onYouTubeIframeAPIReady = function () {
        player = new YT.Player('player', {
            height: '244',
            width: '434',
            videoId: 'VZ9MBYfu_0A',  // youtube video id
            playerVars: {
                'autoplay': 0,
                'rel': 0,
                'showinfo': 0
            },
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    var p = document.getElementById ("player");
    $(p).hide();

    var t = document.getElementById ("thumbnail");
    //t.src = "img/video/play-btn.png";

    var onPlayerStateChange = function (event) {
        if (event.data == YT.PlayerState.ENDED) {
            $('.start-video').fadeIn('normal');
        }
    }

    $(document).on('click', '.start-video', function () {
        $(this).hide();
        $("#player").show();
        $("#thumbnail_container").hide();
        player.playVideo();
    });

    */

//innerfade
(function($){var default_options={animationType:"fade",animate:true,first_slide:0,easing:"linear",speed:"normal",type:"sequence",timeout:2e3,startDelay:0,loop:true,containerHeight:"auto",runningClass:"innerFade",children:null,cancelLink:null,pauseLink:null,prevLink:null,nextLink:null,indexContainer:null,currentItemContainer:null,totalItemsContainer:null,callback_index_update:null};$(function(){window.isActive=true;$(window).focus(function(){this.isActive=true});$(window).blur(function(){this.isActive=false})});$.fn.innerFade=function(options){return this.each(function(){$fade_object=new Object;$fade_object.container=this;$fade_object.settings=$.extend({},default_options,options);$fade_object.elements=$fade_object.settings.children===null?$($fade_object.container).children():$($fade_object.container).children($fade_object.settings.children);$fade_object.count=0;$($fade_object.container).data("object",$fade_object);if($fade_object.elements.length>1){if($fade_object.settings.nextLink||$fade_object.settings.prevLink){$.bindControls($fade_object)}if($fade_object.settings.cancelLink){$.bindCancel($fade_object)}$($fade_object.container).css({position:"relative"}).addClass($fade_object.settings.runningClass);if($fade_object.settings.containerHeight=="auto"){height=$($fade_object.elements).filter(":first").height();$($fade_object.container).css({height:height+"px"})}else{$($fade_object.container).css({height:$fade_object.settings.containerHeight})}if($fade_object.settings.indexContainer){$.innerFadeIndex($fade_object)}for(var i=0;i<$fade_object.elements.length;i++){$($fade_object.elements[i]).hide(0).css("z-index",String($fade_object.elements.length-i)).css("position","absolute")}var toShow="";var toHide="";if($fade_object.settings.type=="random"){toShow=Math.floor(Math.random()*$fade_object.elements.length);do{toHide=Math.floor(Math.random()*$fade_object.elements.length)}while(toHide==toShow)}else if($fade_object.settings.type=="random_start"){$fade_object.settings.type="sequence";toHide=Math.floor(Math.random()*$fade_object.elements.length);toShow=(toHide+1)%$fade_object.elements.length}else{toShow=$fade_object.settings.first_slide;toHide=$fade_object.settings.first_slide==0?$fade_object.elements.length-1:$fade_object.settings.first_slide-1}if($fade_object.settings.animate){$.fadeTimeout($fade_object,toShow,toHide,true)}else{$($fade_object.elements[toShow]).show();$($fade_object.elements[toHide]).hide();$.updateIndexes($fade_object,toShow)}$.updateIndexes($fade_object,toShow);$($fade_object.elements[toShow]).show();if($fade_object.settings.currentItemContainer){$.currentItem($fade_object,toShow)}if($fade_object.settings.totalItemsContainer){$.totalItems($fade_object)}if($fade_object.settings.pauseLink){$.bind_pause($fade_object)}}})};$.fn.innerFadeTo=function(slide_number){return this.each(function(index){var $fade_object=$(this).data("object");var $currentVisibleItem=$($fade_object.elements).filter(":visible");var currentItemIndex=$($fade_object.elements).index($currentVisibleItem);$.stopSlideshow($fade_object);if(slide_number!=currentItemIndex){$.fadeToItem($fade_object,slide_number,currentItemIndex)}})};$.fadeToItem=function($fade_object,toShow,toHide){var speed=$fade_object.settings.speed;switch($fade_object.settings.animationType){case"slide":$($fade_object.elements[toHide]).slideUp(speed);$($fade_object.elements[toShow]).slideDown(speed);break;case"slideOver":var itemWidth=$($fade_object.elements[0]).width(),to_hide_css={},to_show_css={},to_hide_animation={},to_show_animation={};$($fade_object.container).css({overflow:"hidden"});to_hide_css={position:"absolute",top:"0px"};to_show_css=$.extend({},to_hide_css);if(toShow>toHide){to_hide_css.left="0px";to_hide_css.right="auto";to_show_css.left="auto";to_show_css.right="-"+itemWidth+"px";to_hide_animation.left="-"+itemWidth+"px";to_show_animation.right="0px";console.log(to_hide_css)}else{to_hide_css.left="auto";to_hide_css.right="0px";to_show_css.left="-"+itemWidth+"px";to_show_css.right="auto";to_hide_animation.right="-"+itemWidth+"px";to_show_animation.left="0px"};$($fade_object.elements[toHide]).css(to_hide_css);$($fade_object.elements[toShow]).css(to_show_css).show();$($fade_object.elements[toHide]).animate(to_hide_animation,speed,$fade_object.settings.easing,function(){$(this).hide()});$($fade_object.elements[toShow]).animate(to_show_animation,speed,$fade_object.settings.easing);break;case"fadeEmpty":$($fade_object.elements[toHide]).fadeOut(speed,function(){$($fade_object.elements[toShow]).fadeIn(speed)});break;case"slideEmpty":$($fade_object.elements[toHide]).slideUp(speed,function(){$($fade_object.elements[toShow]).slideDown(speed)});break;default:$($fade_object.elements[toHide]).fadeOut(speed);$($fade_object.elements[toShow]).fadeIn(speed);break}if($fade_object.settings.currentItemContainer){$.currentItem($fade_object,toShow)}if($fade_object.settings.indexContainer||$fade_object.settings.callback_index_update){$.updateIndexes($fade_object,toShow)}};$.fadeTimeout=function($fade_object,toShow,toHide,firstRun){if(window.isActive){if(firstRun!=true){$.fadeToItem($fade_object,toShow,toHide)}$fade_object.count++;if($fade_object.settings.loop==false&&$fade_object.count>=$fade_object.elements.length){$.stopSlideshow($fade_object);return}if($fade_object.settings.type=="random"){toHide=toShow;while(toShow==toHide){toShow=Math.floor(Math.random()*$fade_object.elements.length)}}else{toHide=toHide>toShow?0:toShow;toShow=toShow+1>=$fade_object.elements.length?0:toShow+1}}var timeout=firstRun&&$fade_object.settings.startDelay?$fade_object.settings.startDelay:$fade_object.settings.timeout;$($fade_object.container).data("current_timeout",setTimeout(function(){$.fadeTimeout($fade_object,toShow,toHide,false)},timeout))};$.fn.innerFadeUnbind=function(){return this.each(function(index){var $fade_object=$(this).data("object");$.stopSlideshow($fade_object)})};$.stopSlideshow=function($fade_object){clearTimeout($($fade_object.container).data("current_timeout"));$($fade_object.container).data("current_timeout",null)};$.bindControls=function($fade_object){$($fade_object.settings.nextLink).on("click",function(event){event.preventDefault();$.stopSlideshow($fade_object);var $currentElement=$($fade_object.elements).filter(":visible");var currentElementIndex=$($fade_object.elements).index($currentElement);var $nextElement=$currentElement.next().length>0?$currentElement.next():$($fade_object.elements).filter(":first");var nextElementIndex=$($fade_object.elements).index($nextElement);$.fadeToItem($fade_object,nextElementIndex,currentElementIndex)});$($fade_object.settings.prevLink).on("click",function(event){event.preventDefault();$.stopSlideshow($fade_object);var $currentElement=$($fade_object.elements).filter(":visible");var currentElementIndex=$($fade_object.elements).index($currentElement);var $previousElement=$currentElement.prev().length>0?$currentElement.prev():$($fade_object.elements).filter(":last");var previousElementIndex=$($fade_object.elements).index($previousElement);$.fadeToItem($fade_object,previousElementIndex,currentElementIndex)})};$.bind_pause=function($fade_object){$($fade_object.settings.pauseLink).unbind().click(function(event){event.preventDefault();if($($fade_object.container).data("current_timeout")!=null){$.stopSlideshow($fade_object)}else{var tag=$($fade_object.container).children(":first").prop("tagName").toLowerCase();var nextItem="";var previousItem="";if($fade_object.settings.type=="random"){previousItem=Math.floor(Math.random()*$fade_object.elements.length);do{nextItem=Math.floor(Math.random()*$fade_object.elements.length)}while(previousItem==nextItem)}else if($fade_object.settings.type=="random_start"){previousItem=Math.floor(Math.random()*$fade_object.elements.length);nextItem=(previousItem+1)%$fade_object.elements.length}else{previousItem=$(tag,$($fade_object.container)).index($(tag+":visible",$($fade_object.container)));nextItem=previousItem+1==$fade_object.elements.length?0:previousItem+1}$.fadeTimeout($fade_object,nextItem,previousItem,false)}})};$.bindCancel=function($fade_object){$($fade_object.settings.cancelLink).unbind().click(function(event){event.preventDefault();$.stopSlideshow($fade_object)})};$.updateIndexes=function($fade_object,toShow){$($fade_object.settings.indexContainer).children().removeClass("active");$("> :eq("+toShow+")",$($fade_object.settings.indexContainer)).addClass("active");if(typeof $fade_object.settings.callback_index_update=="function"){$fade_object.settings.callback_index_update.call(this,toShow)}};$.createIndexHandler=function($fade_object,count,link){$(link).click(function(event){event.preventDefault();var $currentVisibleItem=$($fade_object.elements).filter(":visible");var currentItemIndex=$($fade_object.elements).index($currentVisibleItem);$.stopSlideshow($fade_object);if($currentVisibleItem.size()<=1&&count!=currentItemIndex){$.fadeToItem($fade_object,count,currentItemIndex)}})};$.createIndexes=function($fade_object){var $indexContainer=$($fade_object.settings.indexContainer);for(var i=0;i<$fade_object.elements.length;i++){var $link=$('<li><a href="#">'+(i+1)+"</a></li>");$.createIndexHandler($fade_object,i,$link);$indexContainer.append($link)}};$.linkIndexes=function($fade_object){var $indexContainer=$($fade_object.settings.indexContainer);var $indexContainerChildren=$("> :visible",$indexContainer);if($indexContainerChildren.size()==$fade_object.elements.length){var count=$fade_object.elements.length;for(var i=0;i<count;i++){$("a",$indexContainer).click(function(event){event.preventDefault()});$.createIndexHandler($fade_object,i,$indexContainerChildren[i])}}else{alert("There is a different number of items in the menu and slides. There needs to be the same number in both.\nThere are "+$indexContainerChildren.size()+" in the indexContainer.\nThere are "+$fade_object.elements.length+" in the slides container.")}};$.innerFadeIndex=function($fade_object){var $indexContainer=$($fade_object.settings.indexContainer);if($(":visible",$indexContainer).size()<=0){$.createIndexes($fade_object)}else{$.linkIndexes($fade_object)}};$.currentItem=function($fade_object,current){var $container=$($fade_object.settings.currentItemContainer);$container.text(current+1)};$.totalItems=function($fade_object){var $container=$($fade_object.settings.totalItemsContainer);$container.text($fade_object.elements.length)}})(jQuery);
//Sticky Sidebars
//!function(i){i.fn.theiaStickySidebar=function(t){var o={containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0};t=i.extend(o,t),t.additionalMarginTop=parseInt(t.additionalMarginTop)||0,t.additionalMarginBottom=parseInt(t.additionalMarginBottom)||0,this.each(function(){function o(){e.fixedScrollTop=0,e.sidebar.css({"min-height":"1px"}),e.stickySidebar.css({position:"static",width:""})}function a(t){var o=t.height();return t.children().each(function(){o=Math.max(o,i(this).height())}),o}var e={};e.sidebar=i(this),e.options=t||{},e.container=i(e.options.containerSelector),0==e.container.size()&&(e.container=e.sidebar.parent()),e.sidebar.css({position:"relative",overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),e.stickySidebar=e.sidebar.find(".theiaStickySidebar"),0==e.stickySidebar.length&&(e.sidebar.find("script").remove(),e.stickySidebar=i("<div>").addClass("theiaStickySidebar").append(e.sidebar.children()),e.sidebar.append(e.stickySidebar)),e.marginTop=parseInt(e.sidebar.css("margin-top")),e.marginBottom=parseInt(e.sidebar.css("margin-bottom")),e.paddingTop=parseInt(e.sidebar.css("padding-top")),e.paddingBottom=parseInt(e.sidebar.css("padding-bottom"));var d=e.stickySidebar.offset().top,r=e.stickySidebar.outerHeight();e.stickySidebar.css("padding-top",1),e.stickySidebar.css("padding-bottom",1),d-=e.stickySidebar.offset().top,r=e.stickySidebar.outerHeight()-r-d,0==d?(e.stickySidebar.css("padding-top",0),e.stickySidebarPaddingTop=0):e.stickySidebarPaddingTop=1,0==r?(e.stickySidebar.css("padding-bottom",0),e.stickySidebarPaddingBottom=0):e.stickySidebarPaddingBottom=1,e.previousScrollTop=null,e.fixedScrollTop=0,o(),e.onScroll=function(e){if(e.stickySidebar.is(":visible")){if(i("body").width()<e.options.minWidth)return void o();if(e.sidebar.outerWidth(!0)+50>e.container.width())return void o();var d=i(document).scrollTop(),r="static";if(d>=e.container.offset().top+(e.paddingTop+e.marginTop-e.options.additionalMarginTop)){var n,s=e.paddingTop+e.marginTop+t.additionalMarginTop,c=e.paddingBottom+e.marginBottom+t.additionalMarginBottom,p=e.container.offset().top,b=e.container.offset().top+a(e.container),g=0+t.additionalMarginTop,l=e.stickySidebar.outerHeight()+s+c<i(window).height();n=l?g+e.stickySidebar.outerHeight():i(window).height()-e.marginBottom-e.paddingBottom-t.additionalMarginBottom;var f=p-d+e.paddingTop+e.marginTop,S=b-d-e.paddingBottom-e.marginBottom,h=e.stickySidebar.offset().top-d,m=e.previousScrollTop-d;"fixed"==e.stickySidebar.css("position")&&(h+=m),h=m>0?Math.min(h,g):Math.max(h,n-e.stickySidebar.outerHeight()),h=Math.max(h,f),h=Math.min(h,S-e.stickySidebar.outerHeight());var u=e.container.height()==e.stickySidebar.outerHeight();r=(u||h!=g)&&(u||h!=n-e.stickySidebar.outerHeight())?d+h-e.sidebar.offset().top-e.paddingTop<=t.additionalMarginTop?"static":"absolute":"fixed"}if("fixed"==r)e.stickySidebar.css({position:"fixed",width:e.sidebar.width(),top:h,left:e.sidebar.offset().left+parseInt(e.sidebar.css("padding-left"))});else if("absolute"==r){var y={};"absolute"!=e.stickySidebar.css("position")&&(y.position="absolute",y.top=d+h-e.sidebar.offset().top-e.stickySidebarPaddingTop-e.stickySidebarPaddingBottom),y.width=e.sidebar.width(),y.left="",e.stickySidebar.css(y)}else"static"==r&&o();"static"!=r&&1==e.options.updateSidebarHeight&&e.sidebar.css({"min-height":e.stickySidebar.outerHeight()+e.stickySidebar.offset().top-e.sidebar.offset().top+e.paddingBottom}),e.previousScrollTop=d}},e.onScroll(e),i(document).scroll(function(i){return function(){i.onScroll(i)}}(e)),i(window).resize(function(i){return function(){i.stickySidebar.css({position:"static"}),i.onScroll(i)}}(e))})}}(jQuery);

/*
 Adsense loader
 */
!function(a,b,c,d){var e=a(b),f=function(a,b){var c,d;return function(){var e=this,f=arguments,g=+new Date;c&&g<c+a?(clearTimeout(d),d=setTimeout(function(){c=g,b.apply(e,f)},a)):(c=g,b.apply(e,f))}},g="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js",h=!1,i=250,j=a([]),k=a([]),l=a([]),m=function(a){(adsbygoogle=b.adsbygoogle||[]).push({});var c=a.data("alOptions").onLoad;"function"==typeof c&&a.find("iframe").one("load",function(){c(a)})},n=function(a){return parseInt(b.getComputedStyle(a,":before").getPropertyValue("content").slice(1,-1)||9999)},o=function(){if(!k.length)return!0;var b=e.scrollTop(),c=e.height();k.each(function(){var d=a(this),e=d.data("alOptions"),f=e.laziness+1,i=d.offset().top;return i-b>c*f||b-i-d.outerHeight()-c*f>0||(k=k.not(d),j=j.add(d),d.data("alOriginalHTML",d.html()).data("alWidth",n(this)).children(":first").addClass("adsbygoogle"),"undefined"!=typeof adsbygoogle?m(d):l=l.add(d),void(h||(h=!0,a.ajax({url:g,async:!0,cache:!0,dataType:"script",success:function(){l.each(function(){m(a(this))}),l=a([])}}))))})},p=function(){if(!j.length)return!0;var b=!1;j.each(function(){var c=a(this);c.data("alWidth")!=n(this)&&(j=j.not(c),c.html(c.data("alOriginalHTML")),k=k.add(c),b=!0)}),b&&o()};e.on("scroll resize",f(i,o)).on("resize",f(i,p)),a.fn.adsenseLoader=function(b){return"string"!=typeof b&&(b=a.extend({},{laziness:1,onLoad:!1},b)),this.each(function(){var c=a(this);"destroy"===b?(c.html(c.data("alOriginalHTML")),k=k.not(c),j=j.not(c),l=l.not(c)):(c.data("alOptions",b),k=k.add(c))}),"destroy"!==b&&o(),this},a.adsenseLoaderConfig=function(a){"undefined"!=typeof a.scriptUrl&&(g=a.scriptUrl),"undefined"!=typeof a.throttle&&(i=a.throttle)}}(jQuery,window,document);