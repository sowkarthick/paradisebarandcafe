<?php
/**
 * The template for displaying the footer
 *
 */

$widgets_areas = (int) get_theme_mod( 'footer-widget-areas', delicio_get_default( 'footer-widget-areas' ) );

$has_active_sidebar = false;
if ( $widgets_areas > 0 ) {
    $i = 1;

    while ( $i <= $widgets_areas ) {
        if ( is_active_sidebar( 'footer_' . $i ) ) {
            $has_active_sidebar = true;
            break;
        }

        $i++;
    }
}

?>

    <footer class="site-footer" role="contentinfo">

        <div class="wrapper wrapper-footer">

            <?php if ( $has_active_sidebar ) : ?>

                <div class="footer-widgets widgets widget-columns-<?php echo esc_attr( $widgets_areas ); ?>">
                    <?php for ( $i = 1; $i <= $widgets_areas; $i ++ ) : ?>

                        <div class="column">
                            <?php dynamic_sidebar( 'footer_' . $i ); ?>
                        </div><!-- .column -->

                    <?php endfor; ?>

                    <div class="clear"></div>
                </div><!-- .footer-widgets -->


            <?php endif; ?>


            <div class="site-info">

                <p class="copyright"><?php echo get_theme_mod( 'footer-text', delicio_get_default( 'footer-text' ) ); ?></p>

                <p class="designed-by"><?php printf( __( 'Designed by %s', 'wpzoom' ), '<a href="https://www.wpzoom.com/" target="_blank" rel="designer">WPZOOM</a>' ); ?></p>

            </div><!-- #footer-copy -->

        </div><!-- .wrapper .wrapper-footer -->

    </footer><!-- .site-footer -->

</div><!-- end #container -->

</div><!-- end .page-wrap -->


<?php wp_footer(); ?>

</body>
</html>