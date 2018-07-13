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
						wp.customize.control('magazil_breaking_news_limit').activate();
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						wp.customize.control('magazil_breaking_news_custom').deactivate();
						break;
					/**
					 * The select was switched to »show«.
					 */
					case 'page':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').activate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						wp.customize.control('magazil_breaking_news_limit').deactivate();
						wp.customize.control('magazil_breaking_news_custom').deactivate();
						break;

					case 'category':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').activate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						wp.customize.control('magazil_breaking_news_custom').deactivate();
						wp.customize.control('magazil_breaking_news_limit').activate();
						break;

					case 'tag':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').activate();
						wp.customize.control('magazil_breaking_news_custom').deactivate();
						wp.customize.control('magazil_breaking_news_limit').activate();
						break;
					case 'custom':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_breaking_news_page').deactivate();
						wp.customize.control('magazil_breaking_news_category').deactivate();
						wp.customize.control('magazil_breaking_news_tags').deactivate();
						wp.customize.control('magazil_breaking_news_limit').deactivate();
						wp.customize.control('magazil_breaking_news_custom').activate();
						break;
				}
			});
		});


		wp.customize.control('magazil_banner_type', function (control) {
			/**
			 * Run function on setting change of control.
			 */
			control.setting.bind(function (value) {
				switch (value) {
					/**
					 * The select was switched to the hide option.
					 */
					case 'image':
						/**
						 * Deactivate the conditional control.
						 */

						wp.customize.control('magazil_banner_image').activate();
						wp.customize.control('magazil_banner_link').activate();
						wp.customize.control('magazil_banner_adsense_code').deactivate();
						break;
					/**
					 * The select was switched to »show«.
					 */
					case 'adsense':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_banner_adsense_code').activate();
						wp.customize.control('magazil_banner_image').deactivate();
						wp.customize.control('magazil_banner_link').deactivate();
						break;
				}
			});
		});
		wp.customize.control('magazil_top_post_type', function (control) {
			/**
			 * Run function on setting change of control.
			 */
			control.setting.bind(function (value) {
				switch (value) {
					/**
					 * The select was switched to the hide option.
					 */
					case 'popular':
						/**
						 * Deactivate the conditional control.
						 */
						wp.customize.control('magazil_top_post_page').deactivate();
						break;
					/**
					 * The select was switched to »show«.
					 */
					case 'page':
						/**
						 * Activate the conditional control.
						 */
						wp.customize.control('magazil_top_post_page').activate();
						break;
				}
			});
		});


	});
} )( jQuery );
