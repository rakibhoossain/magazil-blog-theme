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

		add_image_size( 'top-post-large', 750, 439, true );
		add_image_size( 'top-post-small', 380, 220, true );
		add_image_size( 'feature-post-large', 690, 300, true );
		add_image_size( 'feature-post-small', 335, 180, true );
		add_image_size( 'feature-image', 263, 180, true );
		

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

		// Set up the WordPress core custom background feature.
		// add_theme_support( 'custom-background', apply_filters( 'magazil_custom_background_args', array(
		// 	'default-color' => 'ffffff',
		// 	'default-image' => '',
		// ) ) );

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
		'name'          => esc_html__( 'Sidebar', 'magazil' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'magazil' ),
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
	wp_enqueue_style( 'magazil-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-magnific-popup', get_stylesheet_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-nice-select', get_stylesheet_directory_uri() . '/assets/css/nice-select.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-animate', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-owl-carousel', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css', array(), '1.0' );
	wp_enqueue_style( 'magazil-jquery-ui', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.0' );
	// wp_enqueue_style( 'magazil-ticker-style', get_stylesheet_directory_uri() . '/assets/js/Ticker/styles/ticker-style.css', array(), '1.0' );

	
	
	wp_enqueue_style( 'magazil-style', get_stylesheet_uri() );
// wp_enqueue_style( 'magazil-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '1.0' );
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'magazil-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-easing', get_template_directory_uri() . '/assets/js/easing.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-hoverIntent', get_template_directory_uri() . '/assets/js/hoverIntent.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array('jquery'), '1.0.0', true);
	// wp_enqueue_script( 'magazil-ticker', get_template_directory_uri() . '/assets/js/jquery.ticker.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-mn-accordion', get_template_directory_uri() . '/assets/js/mn-accordion.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'magazil-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

	// wp_enqueue_script( 'magazil-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	// wp_enqueue_script( 'magazil-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magazil_scripts' );

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



require get_template_directory() . '/inc/components/class-magazil-widget-recent-posts.php';
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

