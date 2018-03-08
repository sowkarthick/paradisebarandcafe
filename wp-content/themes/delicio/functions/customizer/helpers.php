<?php

function delicio_sanitize_choice( $value, $setting ) {
    return $value;
}

if ( ! function_exists( 'maybe_hash_hex_color' ) ) :
    /**
     * Ensures that any hex color is properly hashed.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string $color The proposed color.
     *
     * @return string|null The sanitized color.
     */
    function maybe_hash_hex_color( $color ) {
        if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
            return '#' . $unhashed;
        }

        return $color;
    }
endif;


if ( ! function_exists( 'sanitize_hex_color' ) ) :
    /**
     * Sanitizes a hex color.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function sanitize_hex_color( $color ) {
        if ( '' === $color ) {
            return '';
        }

        // 3 or 6 hex digits, or the empty string.
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }

        return null;
    }
endif;

if ( ! function_exists( 'sanitize_hex_color_no_hash' ) ) :
    /**
     * Sanitizes a hex color without a hash. Use sanitize_hex_color() when possible.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function sanitize_hex_color_no_hash( $color ) {
        $color = ltrim( $color, '#' );

        if ( '' === $color ) {
            return '';
        }

        return sanitize_hex_color( '#' . $color ) ? $color : null;
    }
endif;

if ( ! function_exists( 'maybe_hash_hex_color' ) ) :
    /**
     * Ensures that any hex color is properly hashed.
     *
     * This is a copy of the core function for use when the customizer is not being shown.
     *
     * @param  string         $color    The proposed color.
     * @return string|null              The sanitized color.
     */
    function maybe_hash_hex_color( $color ) {
        if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
            return '#' . $unhashed;
        }

        return $color;
    }
endif;

/**
 * Allow only certain tags and attributes in a string.
 *
 * @param  string    $string    The unsanitized string.
 * @return string               The sanitized string.
 */
function delicio_sanitize_text( $string ) {
    global $allowedtags;
    $expandedtags = $allowedtags;

    // span
    $expandedtags['span'] = array();

    // Enable id, class, and style attributes for each tag
    foreach ( $expandedtags as $tag => $attributes ) {
        $expandedtags[$tag]['id']    = true;
        $expandedtags[$tag]['class'] = true;
        $expandedtags[$tag]['style'] = true;
    }

    // br (doesn't need attributes)
    $expandedtags['br'] = array();

    /**
     * Customize the tags and attributes that are allows during text sanitization.
     *
     * @param array     $expandedtags    The list of allowed tags and attributes.
     * @param string    $string          The text string being sanitized.
     */
    apply_filters( 'delicio_sanitize_text_allowed_tags', $expandedtags, $string );

    return wp_kses( $string, $expandedtags );
}