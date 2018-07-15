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
			'primary' => esc_html__( 'Primary Menu', 'magazil' ),
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
 * Footer widget size implement.
 * Return []
 */
function magazil_footer_widget_size() {
	$widget_size = get_theme_mod( 'magazil_footer_widget_size', '3,4,5');
	if (empty($widget_size)) return;
	$widget_size_array = explode(',', $widget_size);
	if (empty($widget_size_array)) return;
	return $widget_size_array;
}

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
		'before_widget' => '<div id="%1$s" class="single-post-wrap %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="title widget_title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'magazil' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to sidebar.', 'magazil' ),
		'before_widget' => '<div id="%1$s" class="single-sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="title widget_title">',
		'after_title'   => '</h6>',
	) );
	
	$footer_widget = magazil_footer_widget_size();
	if (is_array($footer_widget) && !empty($footer_widget)) {

		foreach ($footer_widget as $key => $value) {
			register_sidebar( array(
				'name'          => esc_attr__( 'Footer '.($key+1), 'magazil' ),
				'id'            => 'footer-'.($key+1),
				'description'   => esc_attr__( 'Add widgets here to appear in your footer.', 'magazil' ),
				'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );
		}
	}

}
add_action( 'widgets_init', 'magazil_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function magazil_scripts() {

	$enable_sticky_sidebar			= get_theme_mod( 'magazil_enable_sticky_sidebar', true );
	$active_adsense 				= get_theme_mod( 'magazil_banner_adsense_code', false );
	$active_breaking_news			= get_theme_mod( 'magazil_show_breaking_news', true );
	$active_smooth_mousewheel		= get_theme_mod( 'magazil_enable_smooth_mousewheel', true );

	wp_enqueue_style( 'magazil-linearicons', get_stylesheet_directory_uri() . '/assets/css/linearicons.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-googleFonts', "https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" );

	wp_enqueue_style( 'magazil-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css', array(), '4.0.0' );
	wp_enqueue_style( 'magazil-animate', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', array(), '3.5.1' );
	wp_enqueue_style( 'magazil-owl-carousel', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css', array(), '2.2.0' );
	wp_enqueue_style( 'magazil-jquery-ui', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.12.1' );
	
	
	wp_enqueue_style( 'magazil-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'magazil-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
	wp_enqueue_script( 'magazil-easing', get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), '1.3.0', true);

	// navigation menu
	wp_enqueue_script( 'magazil-hoverIntent', get_template_directory_uri() . '/assets/js/hoverIntent.js', array('jquery'), '1.8.1', true);
	wp_enqueue_script( 'magazil-superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array('jquery'), '1.7.9', true);

	wp_enqueue_script( 'magazil-jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '1.12.1', true);

	wp_enqueue_script( 'magazil-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.0', true);
	wp_enqueue_script( 'magazil-to-top', get_template_directory_uri() . '/assets/js/move-top.js', array('jquery'), '1.2.0', true);

	// Sticky Sidebar
	if ($enable_sticky_sidebar) {
		wp_enqueue_script( 'magazil-ResizeSensor', get_template_directory_uri() . '/assets/js/ResizeSensor.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script( 'magazil-theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.min.js', array('jquery', 'magazil-ResizeSensor'), '1.0.0', true);
		wp_enqueue_script( 'magazil-sticky-sidebar', get_template_directory_uri() . '/assets/js/sticky-sidebar.js', array('jquery', 'magazil-theia-sticky-sidebar'), '1.0.0', true);
	}

	// Enable smooth mousewheel
	if ($active_smooth_mousewheel) {
		wp_enqueue_script( 'magazil-smooth-mousewheel', get_template_directory_uri() . '/assets/js/smooth-mousewheel.js', array('jquery'), '1.0.0', true);
	}

	// Breaking news
	if ($active_breaking_news) {
		wp_enqueue_script( 'magazil-innerfade', get_template_directory_uri() . '/assets/js/jquery.innerfade.min.js', array('jquery'), '1.0.0', true);
	}

	// adsence lazy loader
	if ($active_adsense) {
		wp_enqueue_script( 'magazil-adsenseloader', get_template_directory_uri() . '/assets/js/jquery.adsenseloader.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script( 'magazil-adsense-loader', get_template_directory_uri() . '/assets/js/adsense-loader.js', array('jquery', 'magazil-adsenseloader'), '1.0.0', true);
	}

	wp_enqueue_script( 'magazil-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

	wp_enqueue_script( 'magazil-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

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
* Register scripts
*/
function magazil_register_scripts() {
    wp_register_style( 'magazil-widget-range', get_stylesheet_directory_uri() . '/inc/components/widgets/assets/range-slider.css', array(), '1.0.0' );
	wp_register_script( 'magazil-widget-range', get_template_directory_uri() . '/inc/components/widgets/assets/range-slider.js', array('jquery' ), '1.0.0', true);
}
add_action( 'wp_loaded', 'magazil_register_scripts' );

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

/**
 * Widgets
 */
require get_template_directory() . '/inc/components/widgets/widgets.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Welcome additions.
 */
require_once get_template_directory() . '/inc/components/welcome.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}