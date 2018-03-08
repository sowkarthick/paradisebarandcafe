<?php

function delicio_customizer_define_color_scheme_sections( $sections ) {
    $panel           = WPZOOM::$theme_raw_name . '_color-scheme';
    $colors_sections = array();

    $colors_sections['color'] = array(
        'panel'   => $panel,
        'title'   => __( 'General', 'wpzoom' ),
        'options' => array(

            'color-body-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Body Text', 'wpzoom' ),
                ),
            ),

            'color-logo' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Logo Color', 'wpzoom' ),
                ),
            ),


            'color-logo-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Logo Color on Hover', 'wpzoom' ),
                ),
            ),

            'color-tagline' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Site Description', 'wpzoom' ),
                ),
            ),


            'color-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Link Color', 'wpzoom' ),
                ),
            ),

            'color-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Link Color on Hover', 'wpzoom' ),
                ),
            ),

            'color-button-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Background', 'wpzoom' ),
                ),
            ),

            'color-button-border' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Border Color', 'wpzoom' ),
                ),
            ),


            'color-button-color' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Text Color', 'wpzoom' ),
                ),
            ),

            'color-button-background-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Background on Hover', 'wpzoom' ),
                ),
            ),

            'color-button-color-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Text Color on Hover', 'wpzoom' ),
                ),
            ),

            'color-button-border-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Buttons Border Color on Hover', 'wpzoom' ),
                ),
            ),



        )
    );

    $colors_sections['color-main-menu'] = array(
        'panel'   => $panel,
        'title'   => __( 'Main Menu', 'wpzoom' ),
        'options' => array(

            'color-menu-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Menu Item', 'wpzoom' ),
                ),
            ),

            'color-menu-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Menu Item Hover', 'wpzoom' ),
                ),
            ),

            'color-menu-link-current' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Menu Current Item', 'wpzoom' ),
                ),
            ),


        )
    );

    $colors_sections['color-slider'] = array(
        'panel'   => $panel,
        'title'   => __( 'Homepage Slideshow', 'wpzoom' ),
        'options' => array(

            'color-slider-post-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Slide Title', 'wpzoom' ),
                ),
            ),

            'color-slider-post-title-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Slide Title Hover', 'wpzoom' ),
                ),
            ),

            'color-slider-post-excerpt' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Slide Content', 'wpzoom' ),
                ),
            ),

            'color-slider-button-color' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Button Text', 'wpzoom' ),
                ),
            ),

            'color-slider-button-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Button Background', 'wpzoom' ),
                ),
            ),

            'color-slider-button-color-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Button Text on Hover', 'wpzoom' ),
                ),
            ),

            'color-slider-button-background-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Button Background on Hover', 'wpzoom' ),
                ),
            ),

        )
    );

    $colors_sections['color-posts'] = array(
        'panel'   => $panel,
        'title'   => __( 'Blog Posts', 'wpzoom' ),
        'options' => array(

            'color-post-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Title', 'wpzoom' ),
                ),
            ),

            'color-post-title-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Title Hover', 'wpzoom' ),
                ),
            ),

            'color-post-meta' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta', 'wpzoom' ),
                ),
            ),

            'color-post-meta-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta Link', 'wpzoom' ),
                ),
            ),

            'color-post-meta-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta Link Hover', 'wpzoom' ),
                ),
            ),

            'color-post-button-color' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Read More Button Text', 'wpzoom' ),
                ),
            ),

            'color-post-button-color-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Read More Button Text Hover', 'wpzoom' ),
                ),
            ),

            'color-post-button-border' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Read More Button Border', 'wpzoom' ),
                ),
            ),

            'color-post-button-border-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Read More Button Border Hover', 'wpzoom' ),
                ),
            ),


        )
    );


    $colors_sections['color-single'] = array(
        'panel'   => $panel,
        'title'   => __( 'Individual Posts and Pages', 'wpzoom' ),
        'options' => array(

            'color-single-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post/Page Title', 'wpzoom' ),
                ),
            ),

            'color-single-meta' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta', 'wpzoom' ),
                ),
            ),

            'color-single-meta-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta Link', 'wpzoom' ),
                ),
            ),

            'color-single-meta-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post Meta Link Hover', 'wpzoom' ),
                ),
            ),

            'color-single-content' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Post/Page Text Color', 'wpzoom' ),
                ),
            ),

        )
    );


    $colors_sections['color-widgets'] = array(
        'panel'   => $panel,
        'title'   => __( 'Widgets', 'wpzoom' ),
        'options' => array(

            'color-widget-title' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer & Sidebar Widget Title', 'wpzoom' ),
                ),
            ),


        )
    );

    $colors_sections['color-sidebar'] = array(
        'panel'   => $panel,
        'title'   => __( 'Sidebar', 'wpzoom' ),
        'options' => array(

            'color-sidebar-background' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Background Color', 'wpzoom' ),
                ),
            ),

            'color-sidebar-text' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Text Color', 'wpzoom' ),
                ),
            ),


        )
    );

    $colors_sections['color-footer'] = array(
        'panel'   => $panel,
        'title'   => __( 'Footer', 'wpzoom' ),
        'options' => array(


            'footer-background-color' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer Background Color', 'wpzoom' ),
                ),
            ),

            'footer-text-color' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer Text Color', 'wpzoom' ),
                ),
            ),


            'color-footer-link' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer Link Color', 'wpzoom' ),
                ),
            ),

            'color-footer-link-hover' => array(
                'setting' => array(
                    'sanitize_callback' => 'maybe_hash_hex_color',
                ),
                'control' => array(
                    'control_type' => 'WP_Customize_Color_Control',
                    'label'        => __( 'Footer Link Color on Hover', 'wpzoom' ),
                ),
            ),

        )
    );

    return array_merge( $sections, $colors_sections );
}

add_filter( 'zoom_customizer_sections', 'delicio_customizer_define_color_scheme_sections' );
