<?php
$classes = array(
        'entry',
        'clearfix'
    );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <?php if ( option::is_on('display_thumb') ) {

        if ( has_post_thumbnail() ) : ?>
            <div class="post-thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail('loop'); ?>
            </a></div>
        <?php endif;

    } ?>


    <header class="entry-header">

        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <div class="entry-meta">

            <?php if ( option::is_on( 'display_date' ) )  printf( '<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
            <?php if ( option::is_on( 'display_author' ) ) { printf( '<span class="entry-author">%s ', __( 'by', 'wpzoom' ) ); the_author_posts_link(); print('</span>'); } ?>
            <?php if ( option::is_on( 'display_category' ) ) { printf( '<span class="cat-links">%s ', __( 'in', 'wpzoom' ) ); echo get_the_category_list( ', ' ); echo('</span>'); } ?>
            <?php if ( option::is_on( 'display_comments' ) ) { ?><span class="comments-link"><?php comments_popup_link( __('0 comments', 'wpzoom'), __('1 comment', 'wpzoom'), __('% comments', 'wpzoom'), '', __('Comments are Disabled', 'wpzoom')); ?></span><?php } ?>

            <?php edit_post_link( __( 'Edit', 'wpzoom' ), '<span class="edit-link">', '</span>' ); ?>
        </div>

    </header><!-- .entry-header -->

    <section class="entry-body">

        <div class="entry-content">
            <?php if (option::get('display_content') == 'Full Content') {
                the_content(''.__('Read More &raquo;', 'wpzoom').'');
            }
            if (option::get('display_content') == 'Excerpt')  {
                the_excerpt();
            } ?>

            <?php if ( option::is_on('display_more')  ) { ?>
                <div class="readmore_button">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpzoom' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Read More &raquo;', 'wpzoom'); ?></a>
                </div>
            <?php } ?>

        </div><!-- .entry-content -->

    </section><!-- .entry-body -->

</article><!-- #post-<?php the_ID(); ?> -->