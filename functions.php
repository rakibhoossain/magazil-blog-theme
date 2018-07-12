<?php
/**
 * magazil functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package magazil
 */

if ( ! function_exists( 'magazil_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function magazil_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on magazil, use a find and replace
		 * to change 'magazil' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'magazil', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'magazil-large-top', 750, 439, true );
		add_image_size( 'magazil-small-top', 380, 220, true );

		add_image_size( 'magazil-large-feature', 690, 300, true );
		add_image_size( 'magazil-small-feature', 335, 180, true );

		add_image_size( 'magazil-feature-image', 263, 180, true );
		add_image_size( 'magazil-small-icon', 100, 80, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'magazil' ),
			'social' => esc_html__( 'Social Links Menu', 'magazil' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

			/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			) );

		//Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'magazil_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
		add_editor_style( array( 'assets/css/editor-style.css') );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 30,
			'width'       => 150,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'magazil_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magazil_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'magazil_content_width', 640 );
}
add_action( 'after_setup_theme', 'magazil_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magazil_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Content Area', 'magazil' ),
		'id'            => 'content-area',
		'description'   => esc_html__( 'Add widgets to front page.', 'magazil' ),
		'before_widget' => '<div id="%1$s" class="post-area-wrapper %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Top Area', 'magazil' ),
		'id'            => 'top-area',
		'description'   => esc_html__( 'Add widgets to front page top area.', 'magazil' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'magazil' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to sidebar.', 'magazil' ),
		'before_widget' => '<div id="%1$s" class="single-sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_attr__( 'Footer 1', 'magazil' ),
		'id'            => 'footer-1',
		'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Footer 2', 'magazil' ),
		'id'            => 'footer-2',
		'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_attr__( 'Footer 3', 'magazil' ),
		'id'            => 'footer-3',
		'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_attr__( 'Footer 4', 'magazil' ),
		'id'            => 'footer-4',
		'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_attr__( 'Footer 5', 'magazil' ),
		'id'            => 'footer-5',
		'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'magazil_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function magazil_scripts() {

	wp_enqueue_style( 'magazil-linearicons', get_stylesheet_directory_uri() . '/assets/css/linearicons.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-googleFonts', "https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" );

	wp_enqueue_style( 'magazil-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-animate', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-owl-carousel', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-jquery-ui', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.0' );
	
	
	wp_enqueue_style( 'magazil-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'magazil-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-easing', get_template_directory_uri() . '/assets/js/easing.min.js', array('jquery'), '1.0.0', true);

	// navigation menu
	wp_enqueue_script( 'magazil-hoverIntent', get_template_directory_uri() . '/assets/js/hoverIntent.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array('jquery'), '1.0.0', true);

	wp_enqueue_script( 'magazil-jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '1.0.0', true);

	wp_enqueue_script( 'magazil-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '1.0.0', true);

	// Sticky Sidebar
	wp_enqueue_script( 'magazil-ResizeSensor', get_template_directory_uri() . '/assets/js/ResizeSensor.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.min.js', array('jquery', 'magazil-ResizeSensor'), '1.0.0', true);

	$active_adsense = get_theme_mod( 'magazil_banner_adsense_code', false );
	$active_breaking_news			= get_theme_mod( 'magazil_show_breaking_news', true );

	if ($active_breaking_news) {
		wp_enqueue_script( 'magazil-innerfade', get_template_directory_uri() . '/assets/js/jquery.innerfade.min.js', array('jquery'), '1.0.0', true);
	}

	if ($active_adsense) {
		wp_enqueue_script( 'magazil-adsenseloader', get_template_directory_uri() . '/assets/js/jquery.adsenseloader.min.js', array('jquery'), '1.0.0', true);
	}

	wp_enqueue_script( 'magazil-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

	//wp_enqueue_script( 'magazil-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magazil_scripts' );

/**
* Admin enqueues
*/
function magazil_admin_scripts() {
	wp_enqueue_style( 'magazil-googleFonts', "https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" );
}
add_action( 'admin_enqueue_scripts', 'magazil_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement related post feature.
 */
require get_template_directory() . '/inc/components/class-magazil-related-posts.php';


require get_template_directory() . '/inc/components/widgets/widgets.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}










		// Welcome screen
		if ( is_admin() ) {
			global $magazil_required_actions, $magazil_recommended_plugins;
			require_once get_template_directory() . '/inc/libraries/notify/class-magazil-notify-system.php';

			$magazil_recommended_plugins = array(
				'enlighter'        => array( 'file' => 'Enlighter', 'recommended' => false ),
				'gmap-embed' => array( 'file' => 'srm_gmap_embed', 'recommended' => true ),
				'contact-form-7' => array( 'file' => 'wp-contact-form-7', 'recommended' => true ),
			);

			/*
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$magazil_required_actions = array(
				array(
					"id"          => 'magazil-wp-import-plugin',
					"title"       => Magazil_Notify_System::wordpress_importer_title(),
					"description" => Magazil_Notify_System::wordpress_importer_description(),
					"check"       => Magazil_Notify_System::has_import_plugin( 'wordpress-importer' ),
					"plugin_slug" => 'wordpress-importer'
				),
				array(
					"id"          => 'magazil-wp-import-widget-plugin',
					"title"       => Magazil_Notify_System::widget_importer_exporter_title(),
					'description' => Magazil_Notify_System::widget_importer_exporter_description(),
					"check"       => Magazil_Notify_System::has_import_plugin( 'widget-importer-exporter' ),
					"plugin_slug" => 'widget-importer-exporter'
				),
				array(
					"id"          => 'magazil-req-ac-download-data',
					"title"       => esc_html__( 'Download theme sample data', 'magazil' ),
					"description" => esc_html__( 'Head over to our website and download the sample content data.', 'magazil' ),
					"help"        => '<a target="_blank"  href="https://raw.githubusercontent.com/WPTRT/theme-unit-test/master/themeunittestdata.wordpress.xml">' . __( 'Posts', 'magazil' ) . '</a>, 
									   <a target="_blank"  href="https://github.com/WPTRT/theme-unit-test">' . __( 'Widgets', 'magazil' ) . '</a>',
					"check"       => Magazil_Notify_System::has_content(),
				),
				array(
					"id"    => 'magazil-req-ac-install-data',
					"title" => esc_html__( 'Import Sample Data', 'magazil' ),
					"help"  => '<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'admin.php?import=wordpress' ) . '">' . __( 'Import Posts', 'magazil' ) . '</a> 
									   <a class="button button-primary" target="_blank"  href="' . self_admin_url( 'tools.php?page=widget-importer-exporter' ) . '">' . __( 'Import Widgets', 'magazil' ) . '</a>',
					"check" => Magazil_Notify_System::has_import_plugins(),
				),
				array(
					"id"          => 'magazil-req-ac-static-latest-news',
					"title"       => esc_html__( 'Set front page to static', 'magazil' ),
					"description" => esc_html__( 'If you just installed Magazil, and are not able to see the front-page demo, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'magazil' ),
					"help"        => 'If you need more help understanding how this works, check out the following <a target="_blank"  href="https://codex.wordpress.org/Creating_a_Static_Front_Page#WordPress_Static_Front_Page_Process">link</a>. <br/><br/> <a class="button button-secondary" target="_blank"  href="' . self_admin_url( 'options-reading.php' ) . '">' . __( 'Set manually', 'magazil' ) . '</a> <a class="button button-primary"  href="' . wp_nonce_url( self_admin_url( 'themes.php?page=magazil-welcome&tab=recommended_actions&action=set_page_automatic' ), 'set_page_automatic' ) . '">' . __( 'Set automatically', 'magazil' ) . '</a>',
					"check"       => Magazil_Notify_System::is_not_static_page()
				)
			);

			require_once get_template_directory() . '/inc/libraries/welcome-screen/class-magazil-welcome-screen.php';
			new Magazil_Welcome_Screen();
		}