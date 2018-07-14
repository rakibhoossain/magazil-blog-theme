(function($) {
    'use strict';
    $(document).ready(function($) {

    	var selector = $('.magazil-adsense');
        if ( selector.length ) {
            // jQuery
            selector.adsenseLoader({
                onLoad: function ($ad) {
                    $ad.addClass('adsense--loaded');
                }
            });
        }

    });
}(jQuery));