<?php

if ( ! class_exists( 'ZOOM_Customizer' ) ) :
    class ZOOM_Customizer {
        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'init' ) );
            add_action( 'customize_register', array( $this, 'panels' ) );
            add_action( 'customize_register', array( $this, 'sections' ) );
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts' ) );

            add_action( 'wp_head', array( $this, 'display_customization' ) );
        }

        public function init() {
            require_once get_template_directory() . '/functions/customizer/controls.php';
            require_once get_template_directory() . '/functions/customizer/helpers.php';
            require_once get_template_directory() . '/functions/customizer/helpers-defaults.php';
            require_once get_template_directory() . '/functions/customizer/helpers-css.php';
            require_once get_template_directory() . '/functions/customizer/helpers-display.php';
            require_once get_template_directory() . '/functions/customizer/helpers-fonts.php';
            require_once get_template_directory() . '/functions/customizer/helpers-logo.php';
        }

        /**
         * Register Customizer panels.
         *
         * @param  WP_Customize_Manager $wp_customize
         *
         * @return void
         */
        public function panels( $wp_customize ) {
            $priority = 1000;
            foreach ( $this->get_panels() as $panel => $data ) {
                if (!isset($data['priority'])) {
                    $data['priority'] = $priority += 100;
                }

                $wp_customize->add_panel( $this->get_prefix() . $panel, $data );
            }

            // Re-prioritize and rename the Widgets panel
            if ( ! isset( $wp_customize->get_panel( 'widgets' )->priority ) ) {
                $wp_customize->add_panel( 'widgets' );
            }
            $wp_customize->get_panel( 'widgets' )->priority = $priority += 100;
        }

        /**
         * Add sections and controls to the customizer.
         *
         * @param  WP_Customize_Manager $wp_customize
         *
         * @return void
         */
        public function sections( $wp_customize ) {
            $default_path = get_template_directory() . '/functions/customizer/sections';

            // Load built-in section mods
            $builtin_mods = array(
                'background',
                'navigation',
                'site-title-tagline',
                'static-front-page',
            );

            foreach ( $builtin_mods as $slug ) {
                $file = trailingslashit( $default_path ) . $slug . '.php';

                if ( file_exists( $file ) ) {
                    require_once( $file );
                }
            }

            foreach ( $this->get_panels() as $panel => $data ) {
                $file = trailingslashit( $default_path ) . $panel . '.php';

                if ( file_exists( $file ) ) {
                    require_once( $file );
                }
            }

            $sections = $this->get_sections();

            $priority = array();
            foreach ( $sections as $section => $data ) {
                $options = null;

                if ( isset( $data['options'] ) ) {
                    $options = $data['options'];
                    unset( $data['options'] );
                }

                if ( ! isset( $data['priority'] ) ) {
                    $panel_priority = ( 'none' !== $panel && isset( $panels[ $panel ]['priority'] ) ) ? $panels[ $panel ]['priority'] : 1000;

                    if ( ! isset( $priority[ $panel ] ) ) {
                        $priority[ $panel ] = $panel_priority;
                    }

                    $data['priority'] = $priority[ $panel ] += 10;
                }

                $wp_customize->add_section( $this->get_prefix() . $section, $data );

                // Add options to the section
                $this->add_sections_options( $wp_customize, $this->get_prefix() . $section, $options );
            }
        }

        /**
         * Register settings and controls for a section.
         *
         * @param WP_Customize_Manager $wp_customize
         * @param string $section
         * @param array $args
         */
        private function add_sections_options( $wp_customize, $section, $args ) {
            foreach ( $args as $setting_id => $option ) {
                // Add setting
                if ( isset( $option['setting'] ) ) {
                    $defaults = array(
                        'type'                 => 'theme_mod',
                        'capability'           => 'edit_theme_options',
                        'theme_supports'       => '',
                        'default'              => delicio_get_default( $setting_id ),
                        'transport'            => 'refresh',
                        'sanitize_callback'    => '',
                        'sanitize_js_callback' => '',
                    );

                    $setting = wp_parse_args( $option['setting'], $defaults );

                    // Add the setting arguments inline so Theme Check can verify the presence of sanitize_callback
                    $wp_customize->add_setting( $setting_id, array(
                        'type'                 => $setting['type'],
                        'capability'           => $setting['capability'],
                        'theme_supports'       => $setting['theme_supports'],
                        'default'              => $setting['default'],
                        'transport'            => $setting['transport'],
                        'sanitize_callback'    => $setting['sanitize_callback'],
                        'sanitize_js_callback' => $setting['sanitize_js_callback'],
                    ) );
                }

                // Add control
                if ( isset( $option['control'] ) ) {
                    $control_id = $this->get_prefix() . $setting_id;

                    $defaults = array(
                        'settings' => $setting_id,
                        'section'  => $section,
                    );

                    if ( ! isset( $option['setting'] ) ) {
                        unset( $defaults['settings'] );
                    }

                    $control = wp_parse_args( $option['control'], $defaults );

                    // Check for a specialized control class
                    if ( isset( $control['control_type'] ) ) {
                        $class = $control['control_type'];

                        if ( class_exists( $class ) ) {
                            unset( $control['control_type'] );

                            // Dynamically generate a new class instance
                            $reflection     = new ReflectionClass( $class );
                            $class_instance = $reflection->newInstanceArgs( array(
                                $wp_customize,
                                $control_id,
                                $control
                            ) );

                            $wp_customize->add_control( $class_instance );
                        }
                    } else {
                        $wp_customize->add_control( $control_id, $control );
                    }
                }
            }
        }

        private function get_panels() {
            return apply_filters( 'zoom_customizer_panels', array(
                'general'      => array( 'title' => __( 'General', 'wpzoom' ) ),
                'header'       => array( 'title' => __( 'Header', 'wpzoom' ) ),
                'home-slider'  => array( 'title' => __( 'Homepage Slider', 'wpzoom' ) ),
                'footer'       => array( 'title' => __( 'Footer', 'wpzoom' ) ),
                'typography'   => array( 'title' => __( 'Typography', 'wpzoom' ) ),
                'color-scheme' => array( 'title' => __( 'Color Scheme', 'wpzoom' ) ),
            ) );
        }

        /**
         * @return array Customizer sections
         */
        private function get_sections() {
            return apply_filters( 'zoom_customizer_sections', array() );
        }

        /**
         * @return string Theme prefix
         */
        private function get_prefix() {
            return WPZOOM::$theme_raw_name . '_';
        }

        public function display_customization() {
            do_action( 'delicio_css' );

            $css = delicio_get_css()->build();

            if ( ! empty( $css ) ) {
                echo "\n<!-- Begin Theme Custom CSS -->\n<style type=\"text/css\" id=\"delicio-custom-css\">\n";
                echo $css;
                echo "\n</style>\n<!-- End Theme Custom CSS -->\n";
            }
        }

        public function scripts() {
            wp_enqueue_style(
                'wpzoom-theme-customizer-jquery-ui',
                get_template_directory_uri() . '/functions/customizer/css/jquery-ui/jquery-ui-1.10.4.custom.css',
                array(),
                '1.10.4'
            );

            wp_enqueue_style(
                'wpzoom-theme-customizer-sections',
                get_template_directory_uri() . '/functions/customizer/css/customizer-sections.css',
                array( 'wpzoom-theme-customizer-jquery-ui' ),
                WPZOOM::$themeVersion
            );

            wp_enqueue_script(
                'wpzoom-theme-customizer-sections',
                get_template_directory_uri() . '/functions/customizer/js/customizer-sections.js',
                array( 'jquery', 'customize-controls' ),
                WPZOOM::$themeVersion,
                true
            );
        }
    }
endif;

new ZOOM_Customizer();
