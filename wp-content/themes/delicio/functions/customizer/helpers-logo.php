<?php

function delicio_logo() {
    $info = delicio_get_logo_information();

    if ( ! delicio_has_logo() ) {
        return;
    }

    $url    = esc_url_raw( $info['image'] );
    $width  = absint( $info['width'] );
    $height = absint( $info['height'] );

    if ( get_theme_mod( 'logo-retina-ready', delicio_get_default( 'logo-retina-ready' ) ) ) {
        $width /= 2;
        $height /= 2;
    }

    $alt = esc_attr( get_bloginfo( 'name' ) );

    printf( '<img src="%s" alt="%s" width="%d" height="%d">', $url, $alt, $width, $height );
}

/**
 * Determine if necessary information is available to show a particular logo.
 *
 * @return bool True if all information is available. False is something is missing.
 */
function delicio_has_logo() {
    $information = delicio_get_logo_information();

    // Set the default return value
    $return = false;

    // Verify that the logo type exists in the array
    if ( $information ) {

        // Verify that the image is set and has a value
        if ( isset( $information['image'] ) && ! empty( $information['image'] ) ) {

            // Verify that the width is set and has a value
            if ( isset( $information['width'] ) && ! empty( $information['width'] ) ) {

                // Verify that the height is set and has a value
                if ( isset( $information['height'] ) && ! empty( $information['height'] ) ) {
                    $return = true;
                }
            }
        }
    }

    return $return;
}

/**
 * Utility function for getting information about the theme logos.
 *
 * @param  bool $force Update the dimension cache.
 *
 * @return array Array containing image file, width, and height for each logo.
 */
function delicio_get_logo_information( $force = false ) {
    $logo_information = array();

    $logo_information['image'] = get_theme_mod( 'logo', delicio_get_default( 'logo' ) );

    if ( ! empty( $logo_information['image'] ) ) {
        $dimensions = delicio_get_logo_dimensions( $logo_information['image'], $force );

        // Set the dimensions to the array if all information is present
        if ( ! empty( $dimensions ) && isset( $dimensions['width'] ) && isset( $dimensions['height'] ) ) {
            $logo_information['width']  = $dimensions['width'];
            $logo_information['height'] = $dimensions['height'];
        }
    }

    return $logo_information;
}

/**
 * Get the dimensions of a logo image from cache or regenerate the values.
 *
 * @param  string $url The URL of the image in question.
 * @param  bool $force Cause a cache refresh.
 *
 * @return array The dimensions array on success, and a blank array on failure.
 */

function delicio_get_logo_dimensions( $url, $force = false ) {
    // Build the cache key
    $key = 'delicio-' . md5( 'logo-dimensions-' . $url . WPZOOM::$themeVersion );

    // Pull from cache
    $dimensions = get_transient( $key );

    // If the value is not found in cache, regenerate
    if ( false === $dimensions || is_preview() || true === $force ) {
        $dimensions = array();

        // Get the ID of the attachment
        $attachment_id = delicio_get_attachment_id_from_url( $url );

        // Get the dimensions
        $info = wp_get_attachment_image_src( $attachment_id, 'full' );

        if ( false !== $info && isset( $info[0] ) && isset( $info[1] ) && isset( $info[2] ) ) {
            // Detect JetPack altered src
            if ( false === $info[1] && false === $info[2] ) {
                // Parse the URL for the dimensions
                $pieces = parse_url( urldecode( $info[0] ) );

                // Pull apart the query string
                if ( isset( $pieces['query'] ) ) {
                    parse_str( $pieces['query'], $query_pieces );

                    // Get the values from "resize"
                    if ( isset( $query_pieces['resize'] ) || isset( $query_pieces['fit'] ) ) {
                        if ( isset( $query_pieces['resize'] ) ) {
                            $jp_dimensions = explode( ',', $query_pieces['resize'] );
                        } elseif ( $query_pieces['fit'] ) {
                            $jp_dimensions = explode( ',', $query_pieces['fit'] );
                        }

                        if ( isset( $jp_dimensions[0] ) && isset( $jp_dimensions[1] ) ) {
                            // Package the data
                            $dimensions = array(
                                'width'  => $jp_dimensions[0],
                                'height' => $jp_dimensions[1],
                            );
                        }
                    }
                }
            } else {
                // Package the data
                $dimensions = array(
                    'width'  => $info[1],
                    'height' => $info[2],
                );
            }
        } else {
            // Get the image path from the URL
            $wp_upload_dir = wp_upload_dir();
            $path          = trailingslashit( $wp_upload_dir['basedir'] ) . get_post_meta( $attachment_id, '_wp_attached_file', true );

            // Sometimes, WordPress just doesn't have the metadata available. If not, get the image size
            if ( file_exists( $path ) ) {
                $getimagesize = getimagesize( $path );

                if ( false !== $getimagesize && isset( $getimagesize[0] ) && isset( $getimagesize[1] ) ) {
                    $dimensions = array(
                        'width'  => $getimagesize[0],
                        'height' => $getimagesize[1],
                    );
                }
            }
        }

        // Store the transient
        if ( ! is_preview() ) {
            set_transient( $key, $dimensions, 86400 );
        }
    }

    return $dimensions;
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
function delicio_get_attachment_id_from_url( $url = '' ) {
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

/**
 * Write the favicons to the head to implement the options.
 *
 * @return void
 */
function delicio_display_favicons() {
    $logo_favicon = get_theme_mod( 'logo-favicon', delicio_get_default( 'logo-favicon' ) );
    if ( ! empty( $logo_favicon ) ) : ?>
        <link rel="icon" href="<?php echo esc_url( $logo_favicon ); ?>"/>
    <?php endif;
}

add_action( 'wp_head', 'delicio_display_favicons' );

// Remove obsolete favicon added via theme options in case it is still there from a previous theme.
remove_action( 'wp_head', array( 'WPZOOM_Theme', 'favicon' ) );
