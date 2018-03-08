<?php
/*
Template Name: Homepage (Unyson Builder)
*/

get_header(); ?>

	<?php if ( ! get_theme_mod( 'home-slider-show', delicio_get_default( 'home-slider-show' ) ) ) { ?>

       <main id="content" class="clearfix" role="main">

    <?php } ?>

        <div class="builder-wrap">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; // end of the loop. ?>

        </div>

	<?php if ( ! get_theme_mod( 'home-slider-show', delicio_get_default( 'home-slider-show' ) ) ) { ?>

       </main><!-- #content -->

   <?php } ?>

<?php
get_footer();
