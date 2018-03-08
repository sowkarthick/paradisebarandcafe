<?php
$classes = array(
        'post-blog',
        'entry'
    );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <div class="post_wrap">

        <header class="entry-header">

            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <div class="entry-meta">
                <?php if ( option::is_on( 'post_author' ) )   { printf( '<span class="entry-author">%s ', __( 'by', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>

                <?php if ( option::is_on( 'post_date' ) )     : ?><span class="entry-date"><?php printf( '<time class="entry-date" datetime="%1$s">%2$s</time> ', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?></span> <?php endif; ?>

                <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
            </div>

        </header><!-- .entry-header -->


        <div class="entry-content">

            <?php the_content(); ?>

            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'wpzoom' ),
                    'after'  => '</div>',
                ) );
            ?>

            <?php if ( option::is_on( 'post_tags' ) ) {

                the_tags(
                    '<div class="meta-field"><span>' . __( 'Tags:', 'wpzoom' ). '</span> ',
                    ', ',
                    '</div>'

                );

            } ?>

        </div><!-- .entry-content -->

    </div>

</article><!-- #post-## -->