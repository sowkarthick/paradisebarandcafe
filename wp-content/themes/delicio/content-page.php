<?php
/**
 * The template used for displaying page content in page.php
 */

$classes = array(
        'post-blog',
        'entry'
    );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <div class="post_wrap">

        <div class="entry-content">

            <?php the_content(); ?>

            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'wpzoom' ),
                    'after'  => '</div>',
                ) );
            ?>

            <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>

        </div><!-- .entry-content -->

    </div><!-- /.post_wrap -->

</article><!-- #post-## -->