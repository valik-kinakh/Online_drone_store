<?php
/**
 * drone functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Drone
 * @since Drone 1.27
 */

define( 'DRONE_THEME_VERSION', '1.27' );
define( 'DRONE_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! function_exists( 'drone_apus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Drone 1.0
 */
function drone_apus_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on drone, use a find and replace
	 * to change 'drone' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'drone', get_template_directory() . '/languages' );
	
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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu',      'drone' ),
		'topmenu'  => esc_html__( 'Top Menu', 'drone' ),
		'social'  => esc_html__( 'Social Links Menu', 'drone' ),
		'footer-menu'  => esc_html__( 'Footer Menu', 'drone' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = drone_apus_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'drone_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', drone_fonts_url() ) );
	
	drone_apus_get_load_plugins();
}
endif; // drone_apus_setup
add_action( 'after_setup_theme', 'drone_apus_setup' );


/**
 * Load Google Front
 */
function drone_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'drone' );
    $poppins    = _x( 'on', 'Poppins font: on or off', 'drone' );
 
    if ( 'off' !== $roboto || 'off' !== $poppins ) {
        $font_families = array();
 
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto:400,100,300,500,700,900';
        }
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:400,500,600,700,300';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function drone_apus_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'drone-theme-fonts', drone_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'drone_apus_fonts_url');


function drone_apus_include_files($path) {
    $files = glob( $path );
    if ( ! empty( $files ) ) {
        foreach ( $files as $file ) {
            include $file;
        }
    }
}

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Drone 1.1
 */
function drone_apus_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'drone_apus_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Drone 1.0
 */
function drone_apus_scripts() {
	// Load our main stylesheet.
	
	$css_path =  get_template_directory_uri() . '/css/template.css';
	wp_enqueue_style( 'drone-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'drone-style', get_template_directory_uri() . '/style.css', array(), '3.2' );
	//load font awesome
	wp_enqueue_style( 'drone-font-awesome-style', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.5.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'drone-animate-style', get_template_directory_uri() . '/css/animate.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap-rtl.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.2.0' );
	}
	wp_enqueue_style( 'fancybox-style', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), '3.2.0' );
	
	wp_enqueue_script( 'drone-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'drone-owl-carousel-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'drone-woocommerce-script', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'countdown-timer', get_template_directory_uri() . '/js/jquery.countdownTimer.min.js', array( 'jquery' ), '20150315', true );
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/js/jquery.fancybox.js', array( 'jquery' ), '20150315', true );

	wp_register_script( 'drone-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'drone-script', 'drone_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'drone-script' );

	if ( drone_apus_get_config('header_js') != "" ) {
		wp_add_inline_script( 'drone-typekit', drone_apus_get_config('header_js') );
	}
}
add_action( 'wp_enqueue_scripts', 'drone_apus_scripts', 100 );

/**
 * Display descriptions in main navigation.
 *
 * @since Drone 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function drone_apus_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'drone_apus_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Drone 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function drone_apus_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'drone_apus_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function drone_apus_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'drone_apus_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function drone_apus_get_opt_name() {
	return 'drone_apus_theme_options';
}
add_filter( 'apus_framework_get_opt_name', 'drone_apus_get_opt_name' );

function drone_register_demo_mode() {
	if ( defined('DRONE_DEMO_MODE') && DRONE_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_framework_register_demo_mode', 'drone_register_demo_mode' );

function drone_get_demo_preset() {
	$preset = '';
    if ( defined('DRONE_DEMO_MODE') && DRONE_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_framework_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_framework_preset_default' );
        }
    }
    return $preset;
}

function drone_apus_get_config($name, $default = '') {
	global $apus_options;
    if ( isset($apus_options[$name]) ) {
        return $apus_options[$name];
    }
    return $default;
}

function drone_apus_get_global_config($name, $default = '') {
	$options = get_option( 'drone_apus_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function drone_apus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'drone' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Currency Switcher', 'drone' ),
		'id'            => 'currency-switcher',
		'description'   => esc_html__( 'Add widgets here to appear in your Header.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Information Topbar', 'drone' ),
		'id'            => 'info-topbar',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Social Topbar', 'drone' ),
		'id'            => 'social-topbar',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'drone' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'drone' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product left sidebar', 'drone' ),
		'id'            => 'product-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product right sidebar', 'drone' ),
		'id'            => 'product-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'drone' ),
		'id'            => 'footer1',
		'description'   => esc_html__( 'Add widgets here to appear in your Footer.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'drone' ),
		'id'            => 'footer2',
		'description'   => esc_html__( 'Add widgets here to appear in your Footer.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'drone' ),
		'id'            => 'footer3',
		'description'   => esc_html__( 'Add widgets here to appear in your Footer.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'drone' ),
		'id'            => 'footer4',
		'description'   => esc_html__( 'Add widgets here to appear in your Footer.', 'drone' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'drone_apus_widgets_init' );

function drone_apus_get_load_plugins() {

	$plugins[] =(array(
		'name'                     => 'Cmb2',
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => 'WooCommerce',
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => 'MailChimp for WordPress',
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => 'Contact Form 7',
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => 'WPBakery Visual Composer',
	    'slug'                     => 'js_composer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/js_composer.zip'
	));

	$plugins[] =(array(
		'name'                     => 'Revolution Slider',
        'slug'                     => 'revslider',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	));

	$plugins[] =(array(
		'name'                     => 'Apus Framework For Themes',
        'slug'                     => 'apus-framework',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/apus-framework.zip'
	));	

	$plugins[] =(array(
		'name'                     => 'YITH WooCommerce Wishlist',
	    'slug'                     => 'yith-woocommerce-wishlist',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => 'YITH Woocommerce Compare',
        'slug'                     => 'yith-woocommerce-compare',
        'required'                 => true
	));

	$plugins[] =(array(
		'name'                     => 'WooCommerce Currency Switcher',
        'slug'                     => 'woocommerce-currency-switcher',
        'required'                 => false ,
	));

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_FRAMEWORK_REDUX_ACTIVED' ) ) {
	drone_apus_include_files( get_template_directory() . '/inc/vendors/redux-framework/*.php' );
	define( 'DRONE_REDUX_FRAMEWORK_ACTIVED', true );
}
if ( is_plugin_active( 'cmb2/init.php' ) ) {
	drone_apus_include_files( get_template_directory() . '/inc/vendors/cmb2/*.php' );
	define( 'DRONE_CMB2_ACTIVED', true );
}
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	drone_apus_include_files( get_template_directory() . '/inc/vendors/woocommerce/*.php' );
	define( 'DRONE_WOOCOMMERCE_ACTIVED', true );
}
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
	require get_template_directory() . '/inc/vendors/visualcomposer/functions.php';
	if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts2.php';
	} else {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts.php';
	}
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-theme.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-woocommerce.php';
	define( 'DRONE_VISUALCOMPOSER_ACTIVED', true );
}
if ( is_plugin_active( 'apus-framework/apus-framework.php' ) ) {
	drone_apus_include_files( get_template_directory() . '/inc/widgets/*.php' );
	define( 'DRONE_APUS_FRAMEWORK_ACTIVED', true );
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';