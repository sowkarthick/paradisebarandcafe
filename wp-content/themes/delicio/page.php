<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<main id="content" class="clearfix" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

    <?php $entryCoverBackground = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'entry-cover' ); ?>

    <header class="entry-header">

        <?php if ( has_post_thumbnail() ) { ?>

            <div class="entry-cover" style="background-image: url('<?php echo $entryCoverBackground[0]; ?>')">

        <?php } ?>

            <div class="wrapper wrapper-page-intro clearfix">

                <div class="page-meta page-archive">

                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                </div><!-- .page-meta .page-archive -->

            </div><!-- .wrapper .wrapper-page-intro .clearfix -->

        <?php if (has_post_thumbnail() ) { ?>

            </div><!-- .entry-cover -->

        <?php } ?>

    </header><!-- .entry-header -->



    <div class="wrapper wrapper-content clearfix">

        <?php get_template_part( 'content', 'page' ); ?>

        <?php if (option::get('comments_page') == 'on') : ?>

            <?php comments_template(); ?>

        <?php endif; ?>

    </div><!-- .wrapper .wrapper-content .clearfix -->

    <?php endwhile; // end of the loop. ?>

</main><!-- #content -->

<?php get_footer(); ?>