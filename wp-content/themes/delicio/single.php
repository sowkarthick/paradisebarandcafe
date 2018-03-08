<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<main id="content" class="clearfix" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="wrapper wrapper-page-intro clearfix">

            <?php if ( option::is_on( 'post_category' ) ) : ?>

                <div class="page-meta page-singular">

                    <p class="singular-category"><?php the_category( ', ' ); ?></p>

                </div><!-- .page-meta .page-singular -->

            <?php endif; ?>


            <?php get_template_part( 'content', 'single' ); ?>

        </div><!-- .wrapper .wrapper-page-intro .clearfix -->


        <footer class="entry-footer">

            <div class="entry-meta">

                <?php if ( option::is_on( 'post_author_box' ) ) : ?>

                    <div class="post_author">

                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 70 ); ?>

                        <span><?php _e( 'Written by', 'wpzoom' ); ?></span>

                        <?php the_author_posts_link(); ?>

                    </div>

                <?php endif; ?>

                <div class="clear"></div>

            </div>
        </footer><!-- .entry-footer -->

        <?php if (option::is_on('post_comments') ) : ?>

            <?php comments_template(); ?>

        <?php endif; ?>

    <?php endwhile; // end of the loop. ?>

</main><!-- #content -->

<?php get_footer(); ?>