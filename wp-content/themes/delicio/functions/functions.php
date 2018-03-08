<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 */

if ( ! function_exists( 'delicio_setup' ) ) :
/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
function delicio_setup() {
    // This theme styles the visual editor to resemble the theme style.
    add_editor_style( array( 'css/editor-style.css' ) );

    /* Homepage Slider */
    add_image_size( 'featured', 2000 );
    add_image_size( 'featured-small', 1000 );

    add_image_size( 'loop', 970, 400, true );

    add_image_size( 'entry-cover', 2000, 500, true );


    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    // Register Simple Food Menus custom post types (Jetpack)
	add_theme_support( 'nova_menu_item' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    // Register nav menus
    register_nav_menus( array(
        'primary' => __( 'Main Menu', 'wpzoom' ),
        'secondary' => __( 'Sidebar Menu', 'wpzoom' )
    ) );
}
endif;
add_action( 'after_setup_theme', 'delicio_setup' );


/*  Recommended Plugins
========================================== */

function zoom_register_theme_required_plugins_callback($plugins){

    $plugins =  array_merge(array(

        array(
            'name'         => 'Jetpack',
            'slug'         => 'jetpack',
            'required'     => true,
        ),

        array(
            'name'         => 'Unyson',
            'slug'         => 'unyson',
            'required'     => true,
        ),

        array(
            'name'         => 'Instagram Widget by WPZOOM',
            'slug'         => 'instagram-widget-by-wpzoom',
            'required'     => false,
        ),

        array(
            'name'         => 'Restaurant Reservations',
            'slug'         => 'restaurant-reservations',
            'required'     => false,
        )

    ), $plugins);

    return $plugins;
}

add_filter('zoom_register_theme_required_plugins', 'zoom_register_theme_required_plugins_callback');

/* This theme uses a Static Page as front page */
add_theme_support('zoom-front-page-type', array(
   'type' => 'static_page'
));


/*  Add support for Custom Background
==================================== */

add_theme_support( 'custom-background' );


/*  Add Support for Shortcodes in Excerpt
========================================== */

add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );

add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


/*  Custom Excerpt Length
==================================== */

function new_excerpt_length( $length ) {
    return (int) option::get( "excerpt_length" ) ? (int)option::get( "excerpt_length" ) : 50;
}

add_filter( 'excerpt_length', 'new_excerpt_length' );



/*  Maximum width for images in posts
=========================================== */

if ( ! isset( $content_width ) ) $content_width = 970;



if ( ! function_exists( 'delicio_get_the_archive_title' ) ) :
/* Custom Archives titles.
=================================== */
function delicio_get_the_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }

    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'delicio_get_the_archive_title' );



/*  Remove images from <p> in posts
=========================================== */

function filter_ptags_on_images( $content ){
    return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content' , 'filter_ptags_on_images' );



/* Disable Unyson shortcodes with the same name as in ZOOM Framework
====================================================================== */

function _filter_theme_disable_default_shortcodes($to_disable) {
    $to_disable[] = 'tabs';
    $to_disable[] = 'button';

    return $to_disable;
}
add_filter('fw_ext_shortcodes_disable_shortcodes', '_filter_theme_disable_default_shortcodes');


if ( ! function_exists( 'fw_get_category_blog_list' ) ) :
    /**
     * Function that return an array of categories for latest post shortcode
     * @return array - array of available categories
     */
    function fw_get_category_blog_list() {
        $taxonomy = 'category';
        $args     = array(
            'hide_empty' => true,
        );

        $terms     = get_terms( $taxonomy, $args );
        $result    = array();
        $result[0] = esc_html__( 'All Categories', 'fw' );

        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $result[ $term->term_id ] = $term->name;
            }
        }

        return $result;
    }
endif;



/* Food Menu page
=========================================== */

function delicio_get_menu_sections( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'hide_empty' => false,
    ) );

    $terms = get_terms( 'nova_menu', $args );
    if ( !$terms || is_wp_error( $terms ) ) {
        return array();
    }

    $terms_by_id = array();
    foreach ( $terms as $term ) {
        $terms_by_id["{$term->term_id}"] = $term;
    }

    $term_order = get_option( 'nova_menu_order', array() );

    $return = array();
    foreach ( $term_order as $term_id ) {
        if ( isset( $terms_by_id["$term_id"] ) ) {
            $return[] = $terms_by_id["$term_id"];
            unset( $terms_by_id["$term_id"] );
        }
    }

    foreach ( $terms_by_id as $term_id => $term ) {
        $return[] = $term;
    }

    return $return;
}


function wpzoom_timebreak_remove_nova_markup() {
    if ( class_exists( 'Nova_Restaurant' )) {
        remove_filter( 'template_include', array( Nova_Restaurant::init(), 'setup_menu_item_loop_markup__in_filter' ) );
    }
}
add_action( 'wp', 'wpzoom_timebreak_remove_nova_markup' );



/* Enqueue scripts and styles for the front end.
=========================================== */

function delicio_scripts() {
    if ( '' !== $google_request = delicio_get_google_font_uri() ) {
        wp_enqueue_style( 'delicio-google-fonts', $google_request, WPZOOM::$themeVersion );
    }

    // Load our main stylesheet.
    wp_enqueue_style( 'delicio-style', get_stylesheet_uri(), array(), WPZOOM::$themeVersion );

    wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/css/media-queries.css', array(), WPZOOM::$themeVersion );

    wp_enqueue_style( 'delicio-google-font-default', '//fonts.googleapis.com/css?family=Lato:700,700italic,400,400italic|Playfair+Display:400,700,900,400italic,700italic,900italic|Work+Sans:400,300,500,600&subset=latin,latin-ext,cyrillic,greek' );

    wp_enqueue_style( 'dashicons' );

    wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'pageslide', get_template_directory_uri() . '/js/jquery.pageslide.min.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.min.js', array( 'jquery' ), WPZOOM::$themeVersion, true );

    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), WPZOOM::$themeVersion, true );


    $themeJsOptions = array_merge( option::getJsOptions(), array(
        'home_slider_autoplay'          => get_theme_mod( 'home-slider-autoplay', delicio_get_default( 'home-slider-autoplay' ) ),
        'home_slider_autoplay_interval' => get_theme_mod( 'home-slider-autoplay-interval', delicio_get_default( 'home-slider-autoplay-interval' ) ),
        'home_slider_look_height_type'  => get_theme_mod( 'home-slider-look-height-type', delicio_get_default( 'home-slider-look-height-type' ) ),
        'home_slider_look_height_value' => get_theme_mod( 'home-slider-look-height-value', delicio_get_default( 'home-slider-look-height-value' ) ),
        'home_slider_look_max_height'   => get_theme_mod( 'home-slider-look-max-height', delicio_get_default( 'home-slider-look-max-height' ) ),
    ) );

    wp_enqueue_script( 'delicio-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), WPZOOM::$themeVersion, true );
    wp_localize_script( 'delicio-script', 'zoomOptions', $themeJsOptions );
}

add_action( 'wp_enqueue_scripts', 'delicio_scripts' );