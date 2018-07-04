( function( $ ) {
	/**
	 * Run function when customizer is ready.
	 */
	wp.customize.bind('ready', function () {
		wp.customize.control('magazil_breaking_news_type', function (control) {
			/**
			 * Run function on setting change of control.
			 */
			control.setting.bind(function (value) {
				switch (value) {
					/**
					 * The select was switched to the hide option.
					 */
					case 'post':
						/**
						 * Deactivate the conditional control.
						 */

						wp.customize.control('magazil_breaking_news_page').activate();
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						break;
					/**
					 * The select was switched to »show«.
					 */
					case 'page':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_page').activate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						wp.customize.control('magazil_breaking_news_limit').deactivate();
						break;

					case 'category':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').activate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						break;

					case 'tag':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').activate();
						break;
				}
			});
		});
	});
} )( jQuery );
