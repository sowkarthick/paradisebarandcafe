<?php
/**
 * General WP and WPZOOM functions.
 *
 * @package WPZOOM
 */

define("WPZOOM_INC_URI", get_template_directory_uri() . "/wpzoom");

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json' ) ) {
    /**
     * Send a JSON response back to an Ajax request.
     *
     * @since WP 3.5.0
     *
     * @param mixed $response Variable (usually an array or object) to encode as JSON, then print and die.
     */
    function wp_send_json( $response ) {
        @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
        echo json_encode( $response );
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
            wp_die();
        else
            die;
    }
}

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json_success' ) ) {
    /**
     * Send a JSON response back to an Ajax request, indicating success.
     *
     * @since WP 3.5.0
     *
     * @param mixed $data Data to encode as JSON, then print and die.
     */
    function wp_send_json_success( $data = null ) {
        $response = array( 'success' => true );

        if ( isset( $data ) )
            $response['data'] = $data;

        wp_send_json( $response );
    }
}

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json_error' ) ) {
    /**
     * Send a JSON response back to an Ajax request, indicating failure.
     *
     * @since WP 3.5.0
     *
     * @param mixed $data Data to encode as JSON, then print and die.
     */
    function wp_send_json_error( $data = null ) {
        $response = array( 'success' => false );

        if ( isset( $data ) )
            $response['data'] = $data;

        wp_send_json( $response );
    }
}

if( ! function_exists('get_deprecated_themes')) {

    function get_deprecated_themes(){
        return array(
            'artistica',
            'bizpress',
            'bonpress',
            'business-bite',
            'cadabrapress',
            'convention',
            'delicious',
            'domestica',
            'edupress',
            'elegance',
            'eventina',
            'evertis',
            'gallery',
            'graphix',
            'horizon',
            'hotelia',
            'impulse',
            'magnet',
            'magnific',
            'manifesto',
            'monograph',
            'newsley',
            'photoblog',
            'photoland',
            'photoria',
            'polaris',
            'prime',
            'professional',
            'proudfolio',
            'pulse',
            'sensor',
            'splendid',
            'sportpress',
            'techcompass',
            'technologic',
            'telegraph',
            'virtuoso',
            'voyage',
            'yamidoo-pro',
            'zenko',
            'elastik',
            'momentum',
            'insider',
            'magazine_explorer',
            'onplay',
            'daily_headlines',
            'litepress',
            'morning',
            'digital',
            'photoframe'
        );
    }
}

if(! function_exists('get_demo_xml_data')) {
    function get_demo_xml_data()
    {

        $xml_data = array(
            'remote' => array(
                'url' => '',
                'response' => false
            ),
            'local' => array(
                'url' => '',
                'response' => false
            ),
        );

        $demos = get_demos_details();

        $url        = 'https://www.wpzoom.com/downloads/xml/' . $demos['selected'] . '.xml';
        $local_url  = get_template_directory() . '/theme-includes/demo-content/' . $demos['selected'] . '.xml';

        // Check for local file
        if ( is_file($local_url) ) {
            $xml_data['local']['url'] = $local_url;
            $xml_data['local']['response'] = true;

        }
        // Check for remote file
        else {

            $response   = wp_remote_get( esc_url_raw( $url ) );
            $response_code = wp_remote_retrieve_response_code( $response );

            $xml_data['remote']['url'] = $url;
            $xml_data['remote']['response'] = (! is_wp_error( $response ) && $response_code == '200' );
        }

        return $xml_data;;
    }
}

if ( ! function_exists('get_demos_details') ) {
    function get_demos_details()
    {
        $data = array(
            'demos'         => array(),
            'selected'      => str_replace(array('_', ' '), '-', strtolower(WPZOOM::$themeName)),
            'default'       => str_replace(array('_', ' '), '-', strtolower(WPZOOM::$themeName)),
            'imported'      => get_theme_mod('wpz_demo_imported'),
            'imported_date' => get_theme_mod('wpz_demo_imported_timestamp'),
            'multiple-demo' => false,
        );

        $arr_keys = array('name', 'id', 'thumbnail');

        if ( current_theme_supports('wpz-multiple-demo-importer') ) {
            $wrapped_demos = get_theme_support('wpz-multiple-demo-importer');
            $demos = array_pop($wrapped_demos);
            $selected = get_theme_mod('wpz_multiple_demo_importer');

            // Check if demos array has needed keys
            // If not, we need to change array by pushing keys into new demos array
            foreach ($demos['demos'] as $key => $demo) {
                if ( ! is_array($demo) ) {
                    unset($demos['demos'][$key]);

                    $demos['demos'][$key][$arr_keys[0]] = $demo; // name
                    $demos['demos'][$key][$arr_keys[1]] = strtolower(WPZOOM::$themeName) .'-'. $demo; // id
                    $demos['demos'][$key][$arr_keys[2]] = ''; // thumbnail
                }
            }

            if ( empty($selected) && isset($demos['default']) ) {
                $selected = $demos['default'];
                $data['default'] = $demos['default'];
            }

            $data['demos']          = $demos['demos'];
            $data['multiple-demo']  = true;
            $data['selected']       = str_replace(array('_', ' '), '-', strtolower(WPZOOM::$themeName)) . '-' . $selected;
        }

        return $data;
    }
}


if ( ! function_exists('zoom_array_key_exists') ) {
    function zoom_array_key_exists($keys, $search_arr)
    {
        foreach( $keys as $key ) {
            if( !array_key_exists($key, $search_arr) )
                return false;
        }

        return true;
    }
}

/**
 *
 * Hook function called after the erase demo content process has finished.
 *
 */
if ( ! function_exists('zoom_after_erase_demo') ) {
    function zoom_after_erase_demo()
    {
        $demos = get_demos_details();

        remove_theme_mod('wpz_demo_imported');
        remove_theme_mod('wpz_demo_imported_timestamp');
        delete_option('wpzoom_'. $demos['imported'] .'_theme_setup_complete');
    }

    add_action('erase_demo_end', 'zoom_after_erase_demo');
}

/**
 *
 * Hook function called before add partial to the customizer.
 *
 */
if ( ! function_exists('zoom_before_add_partial') ) {
    function zoom_before_add_partial( $wp, $setting_id )
    {
        if ( ! is_object($wp) )
            return false;

        $remove_partial = array('custom_logo');

        if ( in_array( $setting_id, $remove_partial ) ) {
            $wp->selective_refresh->remove_partial( $setting_id );
        }
    }

    add_action('wpzoom_remove_partial', 'zoom_before_add_partial', 10, 2);
}

function zoom_get_beauty_demo_title($name)
{
    return ucwords(str_replace(array('-', '_'),' ', $name));
}

/**
 * Get the ID of an attachment from its image URL.
 *
 * @author  Taken from reverted change to WordPress core http://core.trac.wordpress.org/ticket/23831
 *
 * @param   string $url The path to an image.
 *
 * @return  int|bool            ID of the attachment or 0 on failure.
 */

if(! function_exists('zoom_get_attachment_id_from_url')){
    function zoom_get_attachment_id_from_url( $url = '' ) {
        // If there is no url, return.
        if ( '' === $url ) {
            return false;
        }

        global $wpdb;
        $attachment_id = 0;

        // Function introduced in 4.0
        if ( function_exists( 'attachment_url_to_postid' ) ) {
            $attachment_id = absint( attachment_url_to_postid( $url ) );
            if ( 0 !== $attachment_id ) {
                return $attachment_id;
            }
        }

        // First try this
        if ( preg_match( '#\.[a-zA-Z0-9]+$#', $url ) ) {
            $sql = $wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid = %s",
                esc_url_raw( $url )
            );
            $attachment_id = absint( $wpdb->get_var( $sql ) );

            if ( 0 !== $attachment_id ) {
                return $attachment_id;
            }
        }

        // Then try this
        $upload_dir_paths = wp_upload_dir();
        if ( false !== strpos( $url, $upload_dir_paths['baseurl'] ) ) {
            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $url );

            // Remove the upload path base directory from the attachment URL
            $url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $sql = $wpdb->prepare(
                "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'",
                esc_url_raw( $url )
            );
            $attachment_id = absint( $wpdb->get_var( $sql ) );
        }

        return $attachment_id;
    }

}

if ( ! function_exists( 'inject_wpzoom_plugins' ) ):
    function inject_wpzoom_plugins( $res, $action, $args ) {

        //remove filter to avoid infinite loop.
        remove_filter( 'plugins_api_result', 'inject_wpzoom_plugins', 10, 3 );

        foreach (
            array(
                'social-icons-widget-by-wpzoom',
                'instagram-widget-by-wpzoom',
                'customizer-reset-by-wpzoom'
            ) as $plugin_slug
        ) {
            $api = plugins_api( 'plugin_information', array(
                'slug'   => $plugin_slug,
                'is_ssl' => is_ssl(),
                'fields' => array(
                    'banners'           => true,
                    'reviews'           => true,
                    'downloaded'        => true,
                    'active_installs'   => true,
                    'icons'             => true,
                    'short_description' => true,
                )
            ) );

            if ( ! is_wp_error( $api ) ) {
                $res->plugins[] = $api;
            }
        }

        return $res;
    }
endif;

if ( ! function_exists( 'zoom_callback_for_featured_plugins_tab' ) ):
    function zoom_callback_for_featured_plugins_tab( $args ) {
        add_filter( 'plugins_api_result', 'inject_wpzoom_plugins', 10, 3 );

        return $args;
    }
endif;