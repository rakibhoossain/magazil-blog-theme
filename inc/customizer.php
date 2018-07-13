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

    /** International phone picker additions **/
    require_once get_template_directory() . '/inc/customizer/class/calss-customizer-phone-control.php';
    
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

		// Header top
		$wp_customize->selective_refresh->add_partial( 'magazil_phone', array(
		            'selector' => '.header-top-right .site-phone'
		));$wp_customize->selective_refresh->add_partial( 'magazil_email', array(
		            'selector' => '.header-top-right .site-email'
		));

		// Banner ads
		$wp_customize->selective_refresh->add_partial( 'magazil_banner_type', array(
		            'selector' => '.header-banner.ads-banner'
		));$wp_customize->selective_refresh->add_partial( 'magazil_show_banner_on_homepage', array(
		            'selector' => '.header-banner.ads-banner'
		));$wp_customize->selective_refresh->add_partial( 'magazil_banner_image', array(
		            'selector' => '.header-banner.ads-banner a img'
		));$wp_customize->selective_refresh->add_partial( 'magazil_banner_link', array(
		            'selector' => '.header-banner.ads-banner a'
		));$wp_customize->selective_refresh->add_partial( 'magazil_banner_adsense_code', array(
		            'selector' => '.header-banner.ads-banner .magazil-adsense'
		));

		// Top post limit
		$wp_customize->selective_refresh->add_partial( 'magazil_top_post_limit', array(
		            'selector' => '.top-post-area .post-top-popular'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_top_post_type', array(
		            'selector' => '.top-post-area .post-top-popular'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_top_post_page', array(
		            'selector' => '.top-post-area .post-top-popular'
		));




		// Top post Breaking news
		$wp_customize->selective_refresh->add_partial( 'magazil_show_breaking_news', array(
		            'selector' => '#breaking-news'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_type', array(
		            'selector' => '#breaking-news'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_page', array(
		            'selector' => '#breaking-news ul'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_category', array(
		            'selector' => '#breaking-news ul'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_tags', array(
		            'selector' => '#breaking-news ul'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_effect', array(
		            'selector' => '#breaking-news ul'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_speed', array(
		            'selector' => '#breaking-news ul'
		));
		$wp_customize->selective_refresh->add_partial( 'magazil_breaking_news_timeout', array(
		            'selector' => '#breaking-news ul'
		));

		// Copyright
		$wp_customize->selective_refresh->add_partial( 'magazil_copyright_text', array(
		            'selector' => '.copyright-text-area .copyright-text'
		));




	}



    if (class_exists('WP_Customize_Panel')):
        $wp_customize->add_panel('magazil_panel', array(
            'priority' => 7,
            'capability' => 'edit_theme_options',
            'title' => __('Theme Settings', 'magazil'),
        	'description' => __( 'Magazil Theme settings', 'magazil' )
        ));


		//  ===================================
        //  ====     Header      ====
        //  ===================================
        $wp_customize->add_section('magazil_header_controls', array(
            'title' => __('Header settings', 'magazil'),
            'panel' => 'magazil_panel',
            'priority' => 5,
        ));
        
        $wp_customize->add_setting('magazil_phone', array(
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'magazil_sanitize_textarea',
            'default' => '+8801776217594'
        ));

		$wp_customize->add_control( new WP_Customize_Phome_Control( $wp_customize, 'magazil_phone', array(
            'label' => __('Phone Number: ', 'magazil'),
            'settings' => 'magazil_phone',
            'section' => 'magazil_header_controls',
            'settings'   => 'magazil_phone',
            'type' => 'phone',
        ) ) );

        $wp_customize->add_setting('magazil_email', array(
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_email',
            'default' => 'serakib@gmail.com'
        ));
        $wp_customize->add_control('magazil_email', array(
            'label' => __('Email: ', 'magazil'),
            'settings' => 'magazil_email',
            'section' => 'magazil_header_controls',
            'type' => 'text',
        ));


		//  ===================================
        //  ====      Banner Settings      ====
        //  ===================================
        $wp_customize->add_section('magazil_banners_controls', array(
            'title' => __('Banner settings', 'magazil'),
            'panel' => 'magazil_panel',
            'priority' => 5,
        ));
        
        $wp_customize->add_setting( 'magazil_banner_type', array(
        	'sanitize_callback' =>  'magazil_sanitize_radio_buttons',
        	'default'           => 'image',
        	'transport'  => 'postMessage'
        ));

		/**
		 * Display banner on homepage
		 */
		$wp_customize->add_setting( 'magazil_show_banner_on_homepage',array(
			'sanitize_callback' => 'magazil_sanitize_checkbox',
			'default'           => true,
			'transport'  => 'postMessage'
		));


		/**
		 * Customize the banner image
		 */
		$wp_customize->add_setting( 'magazil_banner_image', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => get_template_directory_uri() . '/img/banner-ad.jpg',
			'transport'  => 'postMessage'
		));
		/**
		 * Add a url to your banner URL
		 */
		$wp_customize->add_setting( 'magazil_banner_link', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => esc_url( 'https://rakib.ooo/' ),
			'transport'  => 'postMessage'
		));

		/**
		 * Add an AdSense code
		 */
		$wp_customize->add_setting( 'magazil_banner_adsense_code', array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
			'transport'  => 'postMessage'
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
            'panel' => 'magazil_panel',
            'priority' => 6,
        ));
        
		/**
		 * Top post limit
		 */
		$wp_customize->add_setting( 'magazil_top_post_limit', array(
			'sanitize_callback' => 'magazil_sanitize_radio_buttons',
			'default'           => absint(3),
			'transport'  => 'postMessage'
		));

		/**
		 * Top post type
		 */
		$wp_customize->add_setting( 'magazil_top_post_type', array(
			'sanitize_callback' => 'magazil_sanitize_radio_buttons',
			'default'           => 'popular',
			'transport'  => 'postMessage'
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
		
		/**
		 * Top post type
		 */
		$wp_customize->add_control(
			'magazil_top_post_type',
			array(
				'type'        => 'radio',
				'choices'     => array(
					'popular'   => esc_html__( 'Popular Post', 'magazil' ),
					'page'   => esc_html__( 'Page', 'magazil' )
				),
				'label'       => esc_html__( 'Top post type', 'magazil' ),
				'description' => esc_html__( 'What do you want to show in top post area at front page.', 'magazil' ),
				'section'     => 'magazil_home_page_controls',
			)
		);
		
		/**
		 * Display top post page
		 */
		$wp_customize->add_setting( 'magazil_top_post_page', array(
        	'sanitize_callback' =>  'magazil_sanitize_single_page',
        	// 'default'           => '',
        	'transport'  => 'postMessage'
        ));

		/**
		 * Display top post page
		 */
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_top_post_page', array(
            'label'   => __('Front page top area page', 'magazil'),
            'section' => 'magazil_home_page_controls',
            'settings'   => 'magazil_top_post_page',
            'type'     => 'single',
            'choices'  => magazil_page_list(),
            'active_callback' => 'top_post_page_callback',
        ) ) );

		//  ===================================
        //  ====      Breaking news Settings      ====
        //  ===================================
        $wp_customize->add_section('magazil_breaking_news_controls', array(
            'title' => __('Breaking news settings', 'magazil'),
            'panel' => 'magazil_panel',
            'priority' => 7,
        ));
        

		/**
		 * Display Breaking news
		 */
		$wp_customize->add_setting( 'magazil_show_breaking_news',array(
			'sanitize_callback' => 'magazil_sanitize_checkbox',
			'default'           => true,
			'transport'  => 'postMessage'
		));
		
		/**
		 * Display Breaking type
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_type', array(
        	'sanitize_callback' => 'magazil_sanitize_array_breaking_type',
        	'default'           => 'post',
        	'transport'  => 'postMessage'
        ));
		
		/**
		 * Display Breaking tags
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_page', array(
        	'sanitize_callback' =>  'magazil_sanitize_array_page',
        	// 'default'           => '',
        	'transport'  => 'postMessage'
        ));

        /**
		 * Display Breaking tags
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_tags', array(
        	'sanitize_callback' =>  'magazil_sanitize_array_tags',
        	// 'default'           => '',
        	'transport'  => 'postMessage'
        ));

		/**
		 * Display Breaking category
		 */
        $wp_customize->add_setting( 'magazil_breaking_news_category', array(
        	'sanitize_callback' => 'magazil_sanitize_array_catagory',
            // 'default'        => 0,
            'transport'  => 'postMessage'
        ) );

        /**
		 * Display Breaking custom
		 */
        $wp_customize->add_setting( 'magazil_breaking_news_custom', array(
        	'sanitize_callback' => 'esc_html',
            // 'default'        => 0,
            'transport'  => 'postMessage'
        ) );


		/**
		 * Breaking news limit
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_limit', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint(5),
			'transport'  => 'postMessage'
		));

		/**
		 * Breaking news effect
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_effect', array(
        	'sanitize_callback' =>  'magazil_sanitize_array_effects',
        	'default'           => 'fade',
        	'transport'  => 'postMessage'
        ));

		/**
		 * Breaking news speed
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_speed', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint(750),
			'transport'  => 'postMessage'
		));

		/**
		 * Breaking news timeout
		 */
		$wp_customize->add_setting( 'magazil_breaking_news_timeout', array(
			'sanitize_callback' => 'magazil_sanitize_int',
			'default'           => absint( 3500 ),
			'transport'  => 'postMessage'
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
		$wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_type', array(
            'label'       => esc_html__( 'Type of breaking news', 'magazil' ),
			'description' => esc_html__( 'Select what type of post you want to use', 'magazil' ),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_type',
            'type'     => 'single',
            'choices'  => magazil_breaking_news_type()
        ) ) );

		/**
		 * Breaking news page
		 */
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_page', array(
            'label'   => __('Breaking news pages', 'magazil'),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_page',
            'type'     => 'multiple',
            'choices'  => magazil_page_list(),
            'active_callback' => 'breaking_page_callback',
        ) ) );

		/**
		 * Breaking news category
		 */
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_category', array(
            'label'   => __('Breaking news category', 'magazil'),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_category',
            'type'     => 'multiple',
            'choices'  => magazil_cat_list(),
            'active_callback' => 'breaking_cat_callback',
        ) ) );

		/**
		 * Breaking news tags
		 */
        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_tags', array(
            'label'   => esc_html__( 'Breaking News Tags:', 'magazil' ),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_tags',
            'type'     => 'multiple',
            'choices'  => magazil_tag_list(),
            'active_callback' => 'breaking_tag_callback',
        ) ) );

        /**
		 * Breaking news custom
		 */
		$wp_customize->add_control(
			'magazil_breaking_news_custom',
			array(
				'label'           => esc_html__( 'Custom text', 'magazil' ),
				'description'     => esc_html__( 'Custom text to display as breaking news. Must use <li><a> tag to display properly.', 'magazil' ),
				'section'         => 'magazil_breaking_news_controls',
				'settings'        => 'magazil_breaking_news_custom',
				'type'            => 'textarea',
				'active_callback' => 'breaking_custom_callback'
			)
		);

		/**
		 * Breaking news limit
		 */
        $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize, 'magazil_breaking_news_limit', array(
			'label'           => esc_html__( 'Breaking news limit:', 'magazil' ),
			'description'     => esc_html__( 'How much post do you want to show.', 'magazil' ),
			'section'         => 'magazil_breaking_news_controls',
			'settings'        => 'magazil_breaking_news_limit',
			'type'        => 'magazil_range',
			'input_attrs' => array(
                'min' => 1,
                'max' => 50,
            ),
            'active_callback' => 'breaking_limit_callback',
        ) ) );

		/**
		 * Breaking news effect
		 */

        $wp_customize->add_control( new Customizer_Select_Dropdown_Control( $wp_customize, 'magazil_breaking_news_effect', array(
            'label'       => esc_html__( 'The effect of breaking news', 'magazil' ),
			'description' => esc_html__( 'Select what type of effect you want to use', 'magazil' ),
            'section' => 'magazil_breaking_news_controls',
            'settings'   => 'magazil_breaking_news_effect',
            'type'     => 'single',
            'choices'  => magazil_jquery_effects(),
        ) ) );

		/**
		 * Breaking news speed
		 */
        $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize, 'magazil_breaking_news_speed', array(
            'label'           => esc_html__( 'Breaking news speed:', 'magazil' ),
			'description'     => esc_html__( 'Select breaking news speed.', 'magazil' ),
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
        $wp_customize->add_control( new WP_Customize_Range_Control( $wp_customize, 'magazil_breaking_news_timeout', array(
			'label'           => esc_html__( 'Breaking news timeout:', 'magazil' ),
			'description'     => esc_html__( 'Select breaking news timeout.', 'magazil' ),
			'section'         => 'magazil_breaking_news_controls',
			'settings'        => 'magazil_breaking_news_timeout',
			'type'        => 'magazil_range',
			'input_attrs' => array(
                'min' => 100,
                'max' => 4000,
            ),
        ) ) );


        //  ===================================
        //  ====        Copyright          ====
        //  ===================================
        $wp_customize->add_section('magazil_copyright_controls', array(
            'title' => __('Copyright', 'magazil'),
            'panel' => 'magazil_panel',
            'priority' => 8,
        ));

        /**
		 * Copyright text
		 */
		$wp_customize->add_setting( 'magazil_copyright_text', array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
			'transport'  => 'postMessage'
		));

		/**
		 * Copyright text
		 */
		$wp_customize->add_control(
			'magazil_copyright_text',
			array(
				'label'           => esc_html__( 'Copyright text:', 'magazil' ),
				'description'     => esc_html__( 'Add your copyright information on footer area', 'magazil' ),
				'section'         => 'magazil_copyright_controls',
				'settings'        => 'magazil_copyright_text',
				'type'            => 'textarea'
			)
		);


    else:
        $wp_customize->add_section('oh_shit', array(
            'priority' => 6,
            'title' => __('Oh Shit!', 'magazil'),
            'description' => __('WP_Customize_Panel class not exist. Contact with your admin', 'magazil')
        ));
    endif;




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



/**
 * Enqueue script for custom customize control.
 */
function magazil_customize_enqueue() {
	wp_enqueue_script( 'magazil-custom-customize', get_template_directory_uri() . '/inc/customizer/js/magazil-customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'magazil_customize_enqueue' );