<?php

function delicio_option_defaults() {
    $defaults = array(
        /**
         * General
         */
        // Site Title & Tagline
        'hide-tagline'                        => 1,
        // Navbar
        'navbar-show-menu'                    => 1,
        'navbar-show-hamburger'               => 1,
        'navbar-show-menu-sidebar'            => 1,
        // Logo
        'logo'                                => '',
        'logo-retina-ready'                   => 0,
        'logo-favicon'                        => 0,

        /**
         * Typography
         */
        // Body
        'font-family-site-body'               => 'Lato',
        'font-size-site-body'                 => 18,
        'font-weight-site-body'               => 'normal',
        'font-style-site-body'                => 'normal',

        // Site Title & Tag Line
        'font-family-site-title'              => 'Playfair Display',
        'font-size-site-title'                => 40,
        'font-weight-site-title'              => 'bold',
        'font-style-site-title'               => 'italic',
        'font-transform-site-title'           => 'none',

        'font-family-site-tagline'            => 'Lato',
        'font-size-site-tagline'              => 16,
        'font-weight-site-tagline'            => 'normal',
        'font-style-site-tagline'             => 'italic',
        'font-transform-site-tagline'         => 'none',

        // Main Navigation
        'font-family-nav'                     => 'Lato',
        'font-size-nav'                       => 16,
        'font-weight-nav'                     => 'normal',
        'font-style-nav'                      => 'normal',
        'font-transform-nav'                  => 'none',

        // Slider Title
        'font-family-slider-title'            => 'Playfair Display',
        'font-size-slider-title'              => 80,
        'font-weight-slider-title'            => 'normal',
        'font-style-slider-title'             => 'normal',
        'font-transform-slider-title'         => 'none',

        // Slider Excerpt
        'font-family-slider-excerpt'            => 'Lato',
        'font-size-slider-excerpt'              => 20,
        'font-weight-slider-excerpt'            => 'normal',
        'font-style-slider-excerpt'             => 'normal',
        'font-transform-slider-excerpt'         => 'none',

        // Widgets
        'font-family-widgets'                 => 'Lato',
        'font-size-widgets'                   => 14,
        'font-weight-widgets'                 => 'bold',
        'font-style-widgets'                  => 'normal',
        'font-transform-widgets'              => 'uppercase',

        // Post Title
        'font-family-post-title'              => 'Playfair Display',
        'font-size-post-title'                => 50,
        'font-weight-post-title'              => 'bold',
        'font-style-post-title'               => 'normal',
        'font-transform-post-title'           => 'none',

        // Single Post Title
        'font-family-single-post-title'       => 'Playfair Display',
        'font-size-single-post-title'         => 50,
        'font-weight-single-post-title'       => 'bold',
        'font-style-single-post-title'        => 'normal',
        'font-transform-single-post-title'    => 'none',

        // Page Title
        'font-family-page-title'              => 'Playfair Display',
        'font-size-page-title'                => 50,
        'font-weight-page-title'              => 'bold',
        'font-style-page-title'               => 'normal',
        'font-transform-page-title'           => 'none',


        /**
         * Color Scheme
         */
        // General
        'color-body-text'                     => '#444444',
        'color-logo'                          => '#3d1f16',
        'color-logo-hover'                    => '#c16f2d',
        'color-tagline'                       => '#444444',
        'color-link'                          => '#c16f2d',
        'color-link-hover'                    => '#121212',

        // Menu
        'color-menu-link'                     => '#2e2e2e',
        'color-menu-link-hover'               => '#c16f2d',
        'color-menu-link-current'             => '#c16f2d',

        //Slider
        'color-slider-post-title'             => '#ffffff',
        'color-slider-post-title-hover'       => '#ffffff',
        'color-slider-post-excerpt'           => '#ffffff',

        'color-slider-button-color'           => '#ffffff',
        'color-slider-button-background'      => '#c16f2d',
        'color-slider-button-color-hover'     => '#111111',
        'color-slider-button-background-hover'    => '#ffffff',

        // Post
        'color-post-title'                    => '#121212',
        'color-post-title-hover'              => '#c16f2d',
        'color-post-meta'                     => '#b1b1b1',
        'color-post-meta-link'                => '#121212',
        'color-post-meta-link-hover'          => '#c16f2d',
        'color-post-button-color'             => '#121212',
        'color-post-button-color-hover'       => '#121212',
        'color-post-button-border'            => '#c7c9cf',
        'color-post-button-border-hover'      => '#c16f2d',

        // Single Post
        'color-single-title'                   => '#121212',
        'color-single-meta'                    => '#b1b1b1',
        'color-single-meta-link'               => '#121212',
        'color-single-meta-link-hover'         => '#c16f2d',
        'color-single-content'                 => '#444444',

        // Buttons
        'color-button-background'             => '#ffffff',
        'color-button-border'                 => '#c16f2d',
        'color-button-color'                  => '#c16f2d',
        'color-button-background-hover'       => '#c16f2d',
        'color-button-border-hover'           => '#c16f2d',
        'color-button-color-hover'            => '#ffffff',

        // Widgets
        'color-widget-title'                  => '#ffffff',
        'color-sidebar-background'            => '#222222',
        'color-sidebar-text'                  => '#888888',

        // Footer
        'color-footer-link'                   => '#c16f2d',
        'color-footer-link-hover'             => '#ffffff',
        'footer-background-color'             => '#222222',
        'footer-text-color'                   => '#888888',

        // Widget Areas
        'footer-widget-areas'                 => 4,

        // Copyright
        'footer-text'                         => sprintf( __( 'Copyright &copy; %1$s %2$s', 'wpzoom' ), date( 'Y' ), get_bloginfo( 'name' ) ),


        /**
         * Slider
         */
        // General Options
        'home-slider-show'                    => true,
        'home-slider-autoplay'                => false,
        'home-slider-autoplay-interval'       => 3000,
        'home-slider-slides-count'            => 5,

        // Look and Feel
        'home-slider-look-height-type'             => 'auto',
        'home-slider-look-height-value'            => '100',
        'home-slider-look-max-height'              => '800',
        'home-slider-look-fade-color'              => '#220a02',
        'home-slider-look-fade-amount'             => '40',

     );

    return $defaults;
}

function delicio_get_default( $option ) {
    $defaults = delicio_option_defaults();
    $default  = ( isset( $defaults[ $option ] ) ) ? $defaults[ $option ] : false;

    return $default;
}
