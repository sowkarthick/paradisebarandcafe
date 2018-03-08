<?php
/*
Template Name: Full-width (Unyson Builder)
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


            <div class="builder-wrap">

        		<?php

                $classes = array(
                        'post-blog',
                        'entry'
                    );

                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

                    <div class="builder-wrap full-width">

                        <?php the_content(); ?>

                    </div><!-- .full-width -->

                </article><!-- #post-## -->

            </div>

        <?php endwhile; // end of the loop. ?>

    </main><!-- #content -->

<?php
get_footer();
