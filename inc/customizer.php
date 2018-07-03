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
            'title' => __('Banner Settings', 'violet'),
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
