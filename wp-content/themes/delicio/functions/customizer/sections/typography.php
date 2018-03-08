<?php

function delicio_customizer_define_typography_sections( $sections ) {
    $panel           = WPZOOM::$theme_raw_name . '_typography';
    $typography_sections = array();


    $font_weight = array(
        'normal' => 'Normal',
        'bold' => 'Bold'
    );

    $font_style = array(
        'normal' => 'Normal',
        'italic' => 'Italic'
    );

    $text_transform = array(
        'none' => 'None',
        'uppercase' => 'Uppercase',
        'lowercase' => 'Lowercase'
    );


    /**
     * Body
     */
    $typography_sections['font-site-body'] = array(
        'panel'   => $panel,
        'title'   => __( 'Body', 'wpzoom' ),
        'options' => array(
            'font-family-site-body'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-site-body'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-site-body'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-site-body'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

        )
    );

    /**
     * Site Title & Tagline
     */
    $typography_sections['font-site-title'] = array(
        'panel'   => $panel,
        'title'   => __( 'Site Title', 'wpzoom' ),
        'options' => array(
            'font-family-site-title'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-site-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-site-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-site-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-site-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),


        )
    );


    $typography_sections['font-site-tagline'] = array(
        'panel'   => $panel,
        'title'   => __( 'Site Description', 'wpzoom' ),
        'options' => array(

            'font-family-site-tagline'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-site-tagline'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-site-tagline'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-site-tagline'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-site-tagline'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),


        )
    );


    /**
     * Navigation
     */
    $typography_sections['font-nav'] = array(
        'panel'   => $panel,
        'title'   => __( 'Main Menu', 'wpzoom' ),
        'options' => array(
            'font-family-nav'   => array(
                'setting' => array(
                   'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),

            'font-size-nav'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-nav'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-nav'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-nav'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),
        )
    );

    /**
     * Slider Title
     */
    $typography_sections['font-slider'] = array(
        'panel'   => $panel,
        'title'   => __( 'Homepage Slideshow', 'wpzoom' ),
        'options' => array(
            'font-family-slider-title'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Slide Title Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-slider-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-slider-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-slider-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-slider-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),

            'font-family-slider-excerpt'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Slide Content Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-slider-excerpt'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),

            'font-weight-slider-excerpt'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-slider-excerpt'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-slider-excerpt'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),

        )
    );

    /**
     * Widgets
     */
    $typography_sections['font-widgets'] = array(
        'panel'   => $panel,
        'title'   => __( 'Widget Title', 'wpzoom' ),
        'options' => array(
            'font-family-widgets'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Widgets Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-widgets'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Widgets Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),
            'font-weight-widgets'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-widgets'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-widgets'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),
        )
    );

    /**
     * Post Title
     */
    $typography_sections['font-post-title'] = array(
        'panel'   => $panel,
        'title'   => __( 'Blog Posts Title', 'wpzoom' ),
        'options' => array(
            'font-family-post-title'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),
            'font-weight-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),
        )
    );



    /**
     * Single Post Title
     */
    $typography_sections['font-single-post-title'] = array(
        'panel'   => $panel,
        'title'   => __( 'Single Post Title', 'wpzoom' ),
        'options' => array(
            'font-family-single-post-title'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-single-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),
            'font-weight-single-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-single-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-single-post-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),
        )
    );

    /**
     * Page Title
     */
    $typography_sections['font-page-title'] = array(
        'panel'   => $panel,
        'title'   => __( 'Page Title', 'wpzoom' ),
        'options' => array(
            'font-family-page-title'   => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_font_choice',
                ),
                'control' => array(
                    'label'   => __( 'Font Family', 'wpzoom' ),
                    'type'    => 'select',
                    'choices' => delicio_all_font_choices()
                ),
            ),
            'font-size-page-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Font Size (in px)', 'wpzoom' ),
                    'type'  => 'number'
                ),
            ),
            'font-weight-page-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Weight', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_weight
                ),
            ),

            'font-style-page-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Font Style', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $font_style
                ),
            ),

            'font-transform-page-title'     => array(
                'setting' => array(
                    'sanitize_callback' => 'delicio_sanitize_text',
                ),
                'control' => array(
                    'label' => __( 'Text Transform', 'wpzoom' ),
                    'type'  => 'select',
                    'choices' => $text_transform
                ),
            ),
        )
    );



    return array_merge( $sections, $typography_sections );
}

add_filter( 'zoom_customizer_sections', 'delicio_customizer_define_typography_sections' );
