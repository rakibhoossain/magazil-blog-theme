<?php
/**
 * magazil Theme Customizer
 *
 * @package magazil
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function magazil_customize_register( $wp_customize ) {

    /** Custom-Customizer additions **/
    require_once get_template_directory() . '/inc/customizer/sanitize.php';

    /** Toggle additions **/
    require_once get_template_directory() . '/inc/customizer/class/class-customizer-toggle-control.php';

    /** Dropdown additions **/
    require_once get_template_directory() . '/inc/customizer/class/class-customizer-select-dropdown-control.php';

    /** Range slider additions **/
    require_once get_template_directory() . '/inc/customizer/class/class-customizer-range-control.php';
    
    // Load customize callback.
    require_once get_template_directory() . '/inc/customizer/callback.php';
	


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'magazil_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'magazil_customize_partial_blogdescription',
		) );
	}





		//  ===================================
        //  ====      Banner Settings      ====
        //  ===================================
        $wp_customize->add_section('magazil_banners_controls', array(
            'title' => __('Banner settings', 'magazil'),
            'priority' => 5,
        ));
        
        $wp_customize->add_setting( 'magazil_banner_type', array(
        	'sanitize_callback' =>  'magazil_sanitize_radio_buttons',
        	'default'           => 'image'
        ));

		/**
		 * Display banner on homepage
		 */
		$wp_customize->add_setting( 'magazil_show_banner_on_homepage',array(
			'sanitize_callback' => 'magazil_sanitize_checkbox',
			'default'           => true
		));


		/**
		 * Customize the banner image
		 */
		$wp_customize->add_setting( 'magazil_banner_image', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => get_template_directory_uri() . '/img/banner-ad.jpg',
		));
		/**
		 * Add a url to your banner URL
		 */
		$wp_customize->add_setting( 'magazil_banner_link', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => esc_url( 'https://rakib.ooo/' ),
		));

		/**
		 * Add an AdSense code
		 */
		$wp_customize->add_setting( 'magazil_banner_adsense_code', array(
			'default'           => '',
			'sanitize_callback' => 'esc_html'
		));


		/**
		 * Display banner on homepage
		 */
		$wp_customize->add_control( new Customizer_Toggle_Control(
			$wp_customize,
			'magazil_show_banner_on_homepage',
			array(
				'type'    => 'ios',
				'label'   => esc_html__( 'Enable banner', 'magazil' ),
				'section' => 'magazil_banners_controls',
			)
		));

		/**
		 * Type of banners
		 */
		$wp_customize->add_control(
			'magazil_banner_type',
			array(
				'type'        => 'radio',
				'choices'     => array(
					'image'   => esc_html__( 'Image', 'magazil' ),
					'adsense' => esc_html__( 'AdSense', 'magazil' )
				),
				'label'       => esc_html__( 'The type of the banner', 'magazil' ),
				'description' => esc_html__( 'Select what type of banner you want to use: normal image or adsense script',
					'magazil' ),
				'section'     => 'magazil_banners_controls',
			)
		);

		/**
		 * Image upload field for the top-right banner
		 */
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'magazil_banner_image',
				array(
					'label'           => esc_html__( 'Banner Image:', 'magazil' ),
					'description'     => esc_html__( 'Recommended size: 728 x 90', 'magazil' ),
					'section'         => 'magazil_banners_controls',
					'active_callback' => 'banners_type_callback',
				)
			)
		);

		/**
		 * Banner url
		 */
		$wp_customize->add_control(
			'magazil_banner_link',
			array(
				'label'           => esc_html__( 'Banner Link:', 'magazil' ),
				'description'     => esc_html__( 'Add the link for banner image.', 'magazil' ),
				'section'         => 'magazil_banners_controls',
				'settings'        => 'magazil_banner_link',
				'active_callback' => 'banners_type_callback',
			)
		);

		/**
		 * AdSense code
		 */
		$wp_customize->add_control(
			'magazil_banner_adsense_code',
			array(
				'label'           => esc_html__( 'AdSense Code:', 'magazil' ),
				'description'     => esc_html__( 'Add the code you retrieved from your AdSense account. You only need to insert the <ins> tag.', 'magazil' ),
				'section'         => 'magazil_banners_controls',
				'settings'        => 'magazil_banner_adsense_code',
				'type'            => 'textarea',
				'active_callback' => 'banners_type_false_callback',
			)
		);


		//  ===================================
        //  ====     Home page      ====
        //  ===================================
        $wp_customize->add_section('magazil_home_page_controls', array(
            'title' => __('Home page settings', 'magazil'),
            'priority' => 6,
        ));
        
		/**
		 * Top post limit
		 */
		$wp_customize->add_setting( 'magazil_top_post_limit', array(
			'sanitize_callback' => 'magazil_sanitize_radio_buttons',
			'default'           => absint(3),
		));

		/**
		 * Top post limit
		 */
		$wp_customize->add_control(
			'magazil_top_post_limit',
			array(
				'type'        => 'radio',
				'choices'     => array(
					'3'   => esc_html__( 'Three', 'magazil' ),
					'5'   => esc_html__( 'Five', 'magazil' )
				),
				'label'       => esc_html__( 'Top post limit', 'magazil' ),
				'description' => esc_html__( 'Select either three or five', 'magazil' ),
				'section'     => 'magazil_home_page_controls',
			)
		);

		//  ===================================
        //  ====      Breaking news Settings      ====
        //  ===================================
        $wp_customize->add_section('magazil_breaking_news_controls', array(
            'title' => __('Breaking news settings', 'magazil'),
            'priority' => 7,
        ));
        

		/**
		 * Display Breaking news
		 */
		$wp_customize->add_setting( 'magazil_show_breaking_news',array(
			'sanitize_callback' => 'magazil_sanitize_checkbox',
			'default'           => true
		));
		
		/**
		 * Display Breaking type
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_type', array(
        	'sanitize_callback' =>  'magazil_sanitize_radio_buttons',
        	'default'           => 'post'
        ));

        /**
		 * Display Breaking tags
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_tags', array(
        	'sanitize_callback' =>  'magazil_sanitize_array_tags',
        	// 'default'           => ''
        ));

        $wp_customize->add_setting( 'magazil_breaking_news_category', array(
        	'sanitize_callback' => 'magazil_sanitize_array_catagory',
            // 'default'        => 0
        ) );
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_category', array(
            'label'   => __('Breaking news category', 'magazil'),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_category',
            'type'     => 'multiple-select',
            'choices'  => magazil_cat_list()
        ) ) );


		/**
		 * Breaking news limit
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_limit', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint(5),
		));

		/**
		 * Breaking news effect
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_effect', array(
        	'sanitize_callback' =>  'magazil_sanitize_radio_buttons',
        	'default'           => 'fade'
        ));

		/**
		 * Breaking news speed
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_speed', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint(750),
		));

		/**
		 * Breaking news timeout
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_timeout', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint( 3500 ),
		));



		/**
		 * Display Breaking news
		 */
		$wp_customize->add_control( new Customizer_Toggle_Control(
			$wp_customize,
			'magazil_show_breaking_news',
			array(
				'type'    => 'ios',
				'label'   => esc_html__( 'Enable breaking news', 'magazil' ),
				'section' => 'magazil_breaking_news_controls',
			)
		));

		/**
		 * Breaking news type
		 */
		$wp_customize->add_control(
			'magazil_breaking_news_type',
			array(
				'type'        => 'radio',
				'choices'     => array(
					'post'   => esc_html__( 'Post', 'magazil' ),
					'category'   => esc_html__( 'Categories', 'magazil' ),
					'tag' => esc_html__( 'Tags', 'magazil' ),
					'custom' => esc_html__( 'Custom Text', 'magazil' )
				),
				'label'       => esc_html__( 'Type of breaking news', 'magazil' ),
				'description' => esc_html__( 'Select what type of post you want to use',
					'magazil' ),
				'section'     => 'magazil_breaking_news_controls',
			)
		);

		/**
		 * Breaking news tags
		 */
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_tags', array(
            'label'   => esc_html__( 'Breaking News Tags:', 'magazil' ),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_tags',
            'type'     => 'multiple-select',
            'choices'  => magazil_tag_list()
        ) ) );




		/**
		 * Breaking news limit
		 */
		$wp_customize->add_control(
			'magazil_breaking_news_limit',
			array(
				'label'           => esc_html__( 'Breaking news limit:', 'magazil' ),
				'description'     => esc_html__( 'How much post do you want to show.', 'magazil' ),
				'section'         => 'magazil_breaking_news_controls',
				'settings'        => 'magazil_breaking_news_limit',
			)
		);

		/**
		 * Breaking news effect
		 */
		$wp_customize->add_control(
			'magazil_breaking_news_effect',
			array(
				'type'        => 'radio',
				'choices'     => array(
					'fade'   => esc_html__( 'Fade', 'magazil' ),
					'ticker' => esc_html__( 'Ticker', 'magazil' ),
					'slide' => esc_html__( 'Slide', 'magazil' )
				),
				'label'       => esc_html__( 'The effect of breaking news', 'magazil' ),
				'description' => esc_html__( 'Select what type of effect you want to use',
					'magazil' ),
				'section'     => 'magazil_breaking_news_controls',
			)
		);

		/**
		 * Breaking news speed
		 */
		// $wp_customize->add_control(
		// 	'magazil_breaking_news_speed',
		// 	array(
		// 		'label'           => esc_html__( 'Breaking news speed:', 'magazil' ),
		// 		'description'     => esc_html__( 'Enter breaking news speed.', 'magazil' ),
		// 		'section'         => 'magazil_breaking_news_controls',
		// 		'settings'        => 'magazil_breaking_news_speed',
		// 	)
		// );



        $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize, 'magazil_breaking_news_speed', array(
            'label'           => esc_html__( 'Breaking news speed:', 'magazil' ),
			'description'     => esc_html__( 'Enter breaking news speed.', 'magazil' ),
			'section'         => 'magazil_breaking_news_controls',
			'settings'        => 'magazil_breaking_news_speed',
			'type'        => 'magazil_range',
			'input_attrs' => array(
                'min' => 100,
                'max' => 4000,
            ),
        ) ) );








		/**
		 * Breaking news timeout
		 */
		$wp_customize->add_control(
			'magazil_breaking_news_timeout',
			array(
				'label'           => esc_html__( 'Breaking news timeout:', 'magazil' ),
				'description'     => esc_html__( 'Enter breaking news timeout.', 'magazil' ),
				'section'         => 'magazil_breaking_news_controls',
				'settings'        => 'magazil_breaking_news_timeout',
			)
		);













}
add_action( 'customize_register', 'magazil_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function magazil_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function magazil_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function magazil_customize_preview_js() {
	wp_enqueue_script( 'magazil-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'magazil_customize_preview_js' );