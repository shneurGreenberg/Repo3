<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */


if ( ! function_exists( 'progression_studios_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */

function progression_studios_setup() {

	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	add_image_size('progression-studios-blog-index', 900, 500, true);
	add_image_size('progression-studios-post-title', 1400, 500, true);
	add_image_size('progression-studios-video-index', 700, 480, true);
	add_image_size('progression-studios-video-header', 1700, 900, true);
	add_image_size('progression-studios-video-poster', 400, 600, true);

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on pro, use a find and replace
	 * to change 'vayvo-progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vayvo-progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */


	register_nav_menus( array(
		'progression-studios-primary' => esc_html__( 'Primary Main Menu', 'vayvo-progression' ),
		'progression-studios-landing-page' => esc_html__( 'Landing Page Menu', 'vayvo-progression' ),
		'progression-studios-mobile-menu' => esc_html__( 'Mobile Primary Menu', 'vayvo-progression' ),
		'progression-studios-profile-menu' => esc_html__( 'Additional Profile Menu Items', 'vayvo-progression' ),
	) );



}
endif; // progression_studios_setup
add_action( 'after_setup_theme', 'progression_studios_setup' );



/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since pro 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = esc_attr( get_theme_mod('progression_studios_site_width', '1200') ); /* pixels */


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since pro 1.0
 */
function progression_studios_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'vayvo-progression' ),
		'description'   => esc_html__('Default sidebar', 'vayvo-progression'),
		'id' => 'progression-studios-sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-pro"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'vayvo-progression' ),
		'description'   => esc_html__('Sidebar on shop pages', 'vayvo-progression'),
		'id' => 'progression-studios-sidebar-shop',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider-pro"></div></div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );


}
add_action( 'widgets_init', 'progression_studios_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function progression_studios_scripts() {
	wp_enqueue_style(  'vayvo-progression-style', get_stylesheet_uri());
	wp_enqueue_style(  'vayvo-progression-google-fonts', progression_studios_fonts_url(), array( 'vayvo-progression-style' ), '1.0.0' );
	wp_enqueue_style(  'font-awesome', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css', array( 'vayvo-progression-style' ), '1.0.0' );
	if ( get_theme_mod( 'progression_studios_icon_moon' ) == 'true' ) { wp_enqueue_style(  'iconmoon', get_template_directory_uri() . '/inc/fonts/Iconsmind__Ultimate_Pack/Line icons/styles.min.css', array( 'vayvo-progression-style' ), '1.0.0' ); }
	if ( is_singular( 'video_skrn' )) { wp_enqueue_script( 'afterglow', get_template_directory_uri() . '/js/afterglow.min.js', array( 'jquery' ), '20120206', true );}
	if ( get_theme_mod( 'progression_studios_page_transition' ) == 'transition-on-pro' ) { wp_enqueue_style(  'vayvo-progression-preloader', get_template_directory_uri() . '/css/preloader.css', array( 'vayvo-progression-style' ), '1.0.0' );}
	wp_enqueue_script( 'vayvo-progression-superfish', get_template_directory_uri() . '/js/navigation-superfish.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vayvo-progression-hover-intent', get_template_directory_uri() . '/js/navigation-hoverintent.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vayvo-progression-slim-menu', get_template_directory_uri() . '/js/navigation-slimmenu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'vayvo-progression-easing', get_template_directory_uri() . '/js/navigation-easing.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'select2', get_template_directory_uri() . '/js/select2.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'jquery-asRange', get_template_directory_uri() . '/js/jquery-asRange.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scrolltofixed', get_template_directory_uri() . '/js/scrolltofixed.js', array( 'jquery' ), '20120206', true );
	if ( is_author() ||is_post_type_archive( 'video_skrn' ) || is_tax( 'video-genres' ) || is_tax( 'video-type' ) || is_tax( 'video-category' ) || is_tax( 'video-director' ) || is_tax( 'video-cast' ) || is_singular( 'video_skrn' )) {
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '20120206', true );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'vayvo-progression-infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array( 'jquery' ), '20120206', true );
	}
	wp_enqueue_script( 'vayvo-progression-scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206.8', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	wp_enqueue_style( 'dashicons' ); // Icons for Comment Rating
}
add_action( 'wp_enqueue_scripts', 'progression_studios_scripts' );


/**
 * Enqueue google fonts
 */
function progression_studios_fonts_url() {
    $progression_studios_font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'vayvo-progression' ) ) {
        $progression_studios_font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700|Fira Sans Condensed:300,400,500,700|&subset=latin' ), "//fonts.googleapis.com/css" );
    }

    return $progression_studios_font_url;
}





/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/default-customizer.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/mega-menu/mega-menu-framework.php';

/**
 * Masonry JS
 */
require get_template_directory() . '/inc/js-customizer.php';

/**
 * Elementor Page Builder Functions
 */
require get_template_directory() . '/inc/elementor-functions.php';

/**
 * WooCommerce Functions
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Load Plugin Activation
 */
require get_template_directory() . '/inc/tgm-plugin-activation/plugin-activation.php';


/**
 * Wishlist Functions
 */
require get_template_directory() . '/inc/video-watchlist.php';


/**
 * Custom Comment/Review Displays
 */
require get_template_directory() . '/inc/reviews.php';


/**
 * Demo Importer
 */
require get_template_directory() . '/inc/demo/demo-import.php';

add_filter('show_admin_bar', '__return_false');
