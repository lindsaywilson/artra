<?php
/**
 * artra functions and definitions
 *
 * @package artra
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'artra_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function artra_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on artra, use a find and replace
	 * to change 'artra' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'artra', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'artra' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'artra_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // artra_setup
add_action( 'after_setup_theme', 'artra_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function artra_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'artra' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'artra' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'artra_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function artra_scripts() {
	wp_enqueue_script('retina', get_template_directory_uri() . '/libraries/retina-1.1.0.min.js', array('jquery'));
	wp_enqueue_script('mobile-scroll', get_template_directory_uri() . '/js/mobile-scroll.js', array('jquery'));
	wp_enqueue_script('gmap', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '', true );
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/libraries/jquery.flexslider-min.js', array('jquery'));
	wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/libraries/flexslider.css');
	wp_enqueue_script('slimmenu', get_template_directory_uri() . '/libraries/jquery.slimmenu.js', array('jquery'));
	wp_enqueue_script('artra-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_style('theme-main', get_stylesheet_directory_uri().'/style.css');
	wp_enqueue_script('artra-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'artra_scripts' );



/**
 * Include custom post types
 */
//require_once('home-slider-image-type.php');


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Add less
 */

function less_setup() {
	add_theme_support( 'less', array( 'enable' => true ) );
}
add_action( 'after_setup_theme', 'less_setup' );


/**
 * Text editor font formats
 */
function wpa_45815($arr){
    $arr['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'wpa_45815');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';


