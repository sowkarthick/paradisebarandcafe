<?php

function delicio_customizer_define_slider_sections( $sections ) {
	$panel           = WPZOOM::$theme_raw_name . '_home-slider';
	$slider_sections = array();

	$theme_prefix = WPZOOM::$theme_raw_name . '_';

	$slider_sections['slider-general-options'] = array(
		'title'   => __( 'General Options', 'wpzoom' ),
		'panel'   => $panel,
		'options' => array(
			'home-slider-show'     => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label' => __( 'Show on Homepage', 'wpzoom' ),
					'type'  => 'checkbox'
				)
			),

			'home-slider-slides-count' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label'       => __( 'Number of slides displayed', 'wpzoom' ),
					'description' => __( 'How many posts to display in slider.', 'wpzoom' ),
					'type'        => 'number'
				)
			),
			'home-slider-autoplay' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label'       => __( 'Autoplay slideshow', 'wpzoom' ),
					'description' => __( 'Enables automatic slider scrolling. When mouse is hovering the slider autoplay will pause.', 'wpzoom' ),
					'type'        => 'checkbox'
				)
			),
			'home-slider-autoplay-interval' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'label'       => __( 'Autoplay interval', 'wpzoom' ),
					'description' => __( 'Select the interval (in miliseconds) at which the Slider should change posts (<strong>if autoplay is enabled</strong>).', 'wpzoom' ),
					'type'        => 'number'
				)
			),
		)
	);

	$slider_sections['slider-look'] = array(
		'title'   => __( 'Look and Feel ', 'wpzoom' ),
		'panel'   => $panel,
		'options' => array(
			'home-slider-look-height-type' => array(
				'setting' => array(
					'sanitize_callback' => 'delicio_sanitize_text',
				),
				'control' => array(
					'type' => 'select',
					'label'        => __( 'Height Behaviour', 'wpzoom' ),
					'choices'      => array(
						'auto'   => __( 'Auto Height', 'wpzoom' ),
						'static' => __( 'Static Height', 'wpzoom' )
					)
				)
			),
			'home-slider-look-height-value' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'control_type' => 'WPZOOM_Theme_Customize_Range_Control',
					'label'        => __( 'Slider Height in %', 'wpzoom' ),
					'description'  => __( 'Slider height in regard to browser height.', 'wpzoom' ),
					'input_attrs'  => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 5,
					),
				)
			),
			'home-slider-look-max-height' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'control_type' => 'WPZOOM_Theme_Customize_Range_Control',
					'label'        => __( 'Slider maximum height in px', 'wpzoom' ),
					'description'  => __( 'Maximum height slider is allowed to grow. However if the contents of some slides will be taller this limit will not apply.', 'wpzoom' ),
					'input_attrs'  => array(
						'min'  => 100,
						'max'  => 2000,
						'step' => 10,
					),
				)
			),
			'home-slider-look-fade-color' => array(
				'setting' => array(
					'sanitize_callback' => 'maybe_hash_hex_color',
				),
				'control' => array(
					'control_type' => 'WP_Customize_Color_Control',
					'label'        => __( 'Fade Color', 'wpzoom' ),
					'description'  => __( 'In order to improve readability of light text on light images it is needed to make them darker.', 'wpzoom' )
				),
			),
			'home-slider-look-fade-amount' => array(
				'setting' => array(
					'sanitize_callback' => 'absint',
				),
				'control' => array(
					'control_type' => 'WPZOOM_Theme_Customize_Range_Control',
					'label'        => __( 'Fade amount %', 'wpzoom' ),
					'input_attrs'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		)
	);

	return array_merge( $sections, $slider_sections );
}

add_filter( 'zoom_customizer_sections', 'delicio_customizer_define_slider_sections' );
