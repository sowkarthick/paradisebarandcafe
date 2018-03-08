<?php

function tempo_customizer_define_header_sections( $sections ) {
    $panel           = WPZOOM::$theme_raw_name . '_nav';
    $header_sections = array();

    $theme_prefix = WPZOOM::$theme_raw_name . '_';

    /**
     * Navbar
     */
    $header_sections['navbar'] = array(
        'title'   => __( 'Header Layout', 'wpzoom' ),
        'priority' => 50,
        'options' => array(

            'navbar-show-menu' => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Show Menu in the Header', 'wpzoom' ),
                    'description' => __('Select if you want to show the main menu in the header on desktop computers', 'wpzoom'),
                    'type'  => 'checkbox'
                )
            ),

            'navbar-show-hamburger' => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Show Hamburger Icon', 'wpzoom' ),
                    'description' => __('Select if you want to display a sliding sidebar panel with widgets and a menu in it', 'wpzoom'),
                    'type'  => 'checkbox'
                )
            ),

            'navbar-show-menu-sidebar' => array(
                'setting' => array(
                    'sanitize_callback' => 'absint',
                ),
                'control' => array(
                    'label' => __( 'Show Menu in Sidebar', 'wpzoom' ),
                    'description' => __('You can assign a menu to the menu location Sidebar Menu and it will appear in the Sidebar', 'wpzoom'),
                    'type'  => 'checkbox'
                )
            )
        )
    );

    return array_merge( $sections, $header_sections );
}

add_filter( 'zoom_customizer_sections', 'tempo_customizer_define_header_sections' );
