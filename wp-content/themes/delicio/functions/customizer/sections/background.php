<?php

/**
 * @param WP_Customize_Manager $wp_customize
 */
function delicio_customizer_background( $wp_customize ) {
    $section_id = 'background_image';
    $section    = $wp_customize->get_section( $section_id );

    $section->title = __( 'Site Background', 'wpzoom' );

    // $section->panel = WPZOOM::$theme_raw_name . '_general';

    // Move and rename Background Color control to General section of Color Scheme panel
    $wp_customize->get_control( 'background_color' )->section = 'background_image';
    $wp_customize->get_control( 'background_color' )->label = __( 'Background Color', 'wpzoom' );
}

add_action( 'customize_register', 'delicio_customizer_background', 20 );
