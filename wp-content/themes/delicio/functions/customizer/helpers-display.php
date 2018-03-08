<?php

/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * This function reads in the options from theme mods and determines whether a CSS rule is needed to implement an
 * option. CSS is only written for choices that are non-default in order to avoid adding unnecessary CSS. All options
 * are also filterable allowing for more precise control via a child theme or plugin.
 *
 * Note that all CSS for options is present in this function except for the CSS for fonts and the logo, which require
 * a lot more code to implement.
 *
 * @return void
 */
function delicio_css_add_rules() {
    /**
     * Colors section
     */
    delicio_css_add_simple_color_rule( 'color-body-text', 'body', 'color' );

    delicio_css_add_simple_color_rule( 'color-logo', '.navbar-brand a', 'color' );
    delicio_css_add_simple_color_rule( 'color-logo-hover', '.navbar-brand a:hover', 'color' );
    delicio_css_add_simple_color_rule( 'color-tagline', '.navbar-brand .tagline', 'color' );
    delicio_css_add_simple_color_rule( 'color-link', 'a', 'color' );
    delicio_css_add_simple_color_rule( 'color-link-hover', 'a:hover', 'color' );

    // Buttons
    delicio_css_add_simple_color_rule( 'color-button-background', 'button[type=submit], input[type=button], input[type=reset], input[type=submit]', 'background' );
    delicio_css_add_simple_color_rule( 'color-button-border', 'button[type=submit], input[type=button], input[type=reset], input[type=submit]', 'border-color' );
    delicio_css_add_simple_color_rule( 'color-button-color', 'button[type=submit], input[type=button], input[type=reset], input[type=submit]', 'color' );
    delicio_css_add_simple_color_rule( 'color-button-background-hover', 'button[type=submit]:hover, input[type=button]:hover, input[type=button]:focus, input[type=reset]:hover, input[type=reset]:focus, input[type=submit]:hover, input[type=submit]:focus', 'background' );
    delicio_css_add_simple_color_rule( 'color-button-border-hover', 'button[type=submit]:hover, input[type=button]:hover, input[type=button]:focus, input[type=reset]:hover, input[type=reset]:focus, input[type=submit]:hover, input[type=submit]:focus', 'border-color' );
    delicio_css_add_simple_color_rule( 'color-button-color-hover', 'button[type=submit]:hover, input[type=button]:hover, input[type=button]:focus, input[type=reset]:hover, input[type=reset]:focus, input[type=submit]:hover, input[type=submit]:focus', 'color' );

    // Menu
    delicio_css_add_simple_color_rule( 'color-menu-link', '.navbar-nav a', 'color' );
    delicio_css_add_simple_color_rule( 'color-menu-link-hover', '.navbar-nav  a:hover', 'color' );
    delicio_css_add_simple_color_rule( 'color-menu-link-current', '.navbar-nav .current-menu-item > a, .navbar-nav .current_page_item > a, .navbar-nav .current-menu-parent > a, .navbar-nav .current_page_parent > a', 'color' );

    // Slider
    delicio_css_add_simple_color_rule( 'color-slider-post-title', '.site-slider h2 a', 'color' );
    delicio_css_add_simple_color_rule( 'color-slider-post-title-hover', '.site-slider h2 a:hover', 'color' );
    delicio_css_add_simple_color_rule( 'color-slider-post-excerpt', '.site-slider .slide-excerpt', 'color' );

    delicio_css_add_simple_color_rule( 'color-slider-button-color', '.site-slider .button', 'color' );
    delicio_css_add_simple_color_rule( 'color-slider-button-color-hover', '.site-slider .button:hover', 'color' );
    delicio_css_add_simple_color_rule( 'color-slider-button-background', '.site-slider .button', 'background' );
    delicio_css_add_simple_color_rule( 'color-slider-button-border', '.site-slider .button', 'border-color' );
    delicio_css_add_simple_color_rule( 'color-slider-button-background-hover', '.site-slider .button:hover', 'background' );
    delicio_css_add_simple_color_rule( 'color-slider-button-border-hover', '.site-slider .button:hover', 'border-color' );


    // Post
    delicio_css_add_simple_color_rule( 'color-post-title', '.post-blog .entry-title a', 'color' );
    delicio_css_add_simple_color_rule( 'color-post-title-hover', '.post-blog .entry-title a:hover', 'color' );

    delicio_css_add_simple_color_rule( 'color-post-meta', '.post-blog .entry-meta', 'color' );
    delicio_css_add_simple_color_rule( 'color-post-meta-link', '.entry-meta a', 'color' );
    delicio_css_add_simple_color_rule( 'color-post-meta-link-hover', '.entry-meta a:hover', 'color' );

    delicio_css_add_simple_color_rule( 'color-post-button-color', '.readmore_button a', 'color' );
    delicio_css_add_simple_color_rule( 'color-post-button-color-hover', '.readmore_button a:hover, .readmore_button a:active', 'color' );
    delicio_css_add_simple_color_rule( 'color-post-button-border', '.readmore_button a', 'border-color' );
    delicio_css_add_simple_color_rule( 'color-post-button-border-hover', '.readmore_button a:hover, .readmore_button a:active', 'border-color' );

    // Single Post
    delicio_css_add_simple_color_rule( 'color-single-title', '.woocommerce h2.entry-title, .page h1.entry-title, .single h1.entry-title', 'color' );
    delicio_css_add_simple_color_rule( 'color-single-meta', '.single .entry-meta', 'color' );
    delicio_css_add_simple_color_rule( 'color-single-meta-link', '.single .entry-meta a', 'color' );
    delicio_css_add_simple_color_rule( 'color-single-meta-link-hover', '.single .entry-meta a:hover', 'color' );
    delicio_css_add_simple_color_rule( 'color-single-content', '.entry-content', 'color' );


    // Widgets
    delicio_css_add_simple_color_rule( 'color-widget-title', '.widget h3.title', 'color' );
    delicio_css_add_simple_color_rule( 'color-sidebar-background', '#pageslide', 'background' );
    delicio_css_add_simple_color_rule( 'color-sidebar-text', '#pageslide', 'color' );

    // Footer
    delicio_css_add_simple_color_rule( 'color-footer-link', '.site-footer a', 'color' );
    delicio_css_add_simple_color_rule( 'color-footer-link-hover', '.site-footer a:hover', 'color' );
    delicio_css_add_simple_color_rule( 'footer-background-color', '.site-footer', 'background-color' );
    delicio_css_add_simple_color_rule( 'footer-text-color', '.site-footer', 'color' );


    // Font Styles
    delicio_css_add_simple_font_rule( 'font-weight-site-body', 'body', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-site-body', 'body', 'font-style' );

    delicio_css_add_simple_font_rule( 'font-weight-site-title', '.navbar-brand h1 a', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-site-title', '.navbar-brand h1 a', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-site-title', '.navbar-brand h1 a', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-site-tagline', '.navbar-brand .tagline', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-site-tagline', '.navbar-brand .tagline', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-site-tagline', '.navbar-brand .tagline', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-nav', '.navbar-nav a', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-nav', '.navbar-nav a', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-nav', '.navbar-nav a', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-slider-title', '.site-slider h2, .site-slider h2 a', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-slider-title', '.site-slider h2, .site-slider h2 a', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-slider-title', '.site-slider h2, .site-slider h2 a', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-slider-excerpt', '.site-slider .slide-excerpt', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-slider-excerpt', '.site-slider .slide-excerpt', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-slider-excerpt', '.site-slider .slide-excerpt', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-widgets', '.widget h3.title, .section-title', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-widgets', '.widget h3.title, .section-title', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-widgets', '.widget h3.title, .section-title', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-post-title', '.post-blog .entry-title', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-post-title', '.post-blog .entry-title', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-post-title', '.post-blog .entry-title', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-single-post-title', '.woocommerce h2.entry-title, .single h1.entry-title', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-single-post-title', '.woocommerce h2.entry-title, .single h1.entry-title', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-single-post-title', '.woocommerce h2.entry-title, .single h1.entry-title', 'text-transform' );

    delicio_css_add_simple_font_rule( 'font-weight-page-title', '.page h1.entry-title', 'font-weight' );
    delicio_css_add_simple_font_rule( 'font-style-page-title', '.page h1.entry-title', 'font-style' );
    delicio_css_add_simple_font_rule( 'font-transform-page-title', '.page h1.entry-title', 'text-transform' );


    // Slider
    delicio_css_add_simple_color_rule( 'home-slider-look-fade-color', '.site-slider .slide-background-overlay', 'background-color' );

    $slider_fade_amount = get_theme_mod( 'home-slider-look-fade-amount', delicio_get_default( 'home-slider-look-fade-amount' ) );

    if ( ! empty( $slider_fade_amount ) && $slider_fade_amount != delicio_get_default( 'home-slider-look-fade-amount' ) ) {
        delicio_get_css()->add( array(
            'selectors' => array( '.site-slider .slide-background-overlay' ),
            'declarations' => array(
                'opacity' => min( max( 0, intval( $slider_fade_amount ) / 100 ), 100 )
            )
        ) );
    }

}

add_action( 'delicio_css', 'delicio_css_add_rules' );

function delicio_css_add_simple_color_rule( $setting_id, $selectors, $declarations ) {
    $value = maybe_hash_hex_color( get_theme_mod( $setting_id, delicio_get_default( $setting_id ) ) );

    if ( $value === delicio_get_default( $setting_id ) ) {
        return;
    }

    if ( strtolower( $value ) === strtolower( delicio_get_default( $setting_id ) ) ) {
        return;
    }

    if ( is_string( $selectors ) ) {
        $selectors = array( $selectors );
    }

    if ( is_string( $declarations ) ) {
        $declarations = array(
            $declarations => $value
        );
    }

    delicio_get_css()->add( array(
        'selectors'    => $selectors,
        'declarations' => $declarations
    ) );
}



function delicio_css_add_simple_font_rule( $setting_id, $selectors, $declarations ) {
    $value =  get_theme_mod( $setting_id, delicio_get_default( $setting_id ) );

    if ( $value === delicio_get_default( $setting_id ) ) {
        return;
    }

    if ( strtolower( $value ) === strtolower( delicio_get_default( $setting_id ) ) ) {
        return;
    }

    if ( is_string( $selectors ) ) {
        $selectors = array( $selectors );
    }

    if ( is_string( $declarations ) ) {
        $declarations = array(
            $declarations => $value
        );
    }

    delicio_get_css()->add( array(
        'selectors'    => $selectors,
        'declarations' => $declarations
    ) );
}
