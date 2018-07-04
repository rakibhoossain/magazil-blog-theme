(function($) {
    'use strict';
    $(document).ready(function($) {

    	$('.chosen-select').chosen({
		    disable_search_threshold: 10,
		    no_results_text: "Oops, nothing found!",
		    width: "100%"
		 });
    	$('.chosen-select-deselect').chosen({ allow_single_deselect: true });


    });
}(jQuery));
