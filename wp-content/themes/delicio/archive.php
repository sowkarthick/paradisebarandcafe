<?php get_header(); ?>

<main id="content" class="clearfix" role="main">

    <div class="wrapper wrapper-page-intro clearfix">

        <div class="page-meta page-archive">

            <?php the_archive_title( '<h1 class="section-title">', '</h1>' ); ?>

        </div><!-- .page-meta .page-archive -->

    </div><!-- .wrapper .wrapper-page-intro .clearfix -->

    <div class="wrapper clearfix">
	
		<section class="recent-posts">
	
	        <?php if ( have_posts() ) : ?>
	
	            <ul class="wpzoom-posts posts-blog">
	
	            <?php while ( have_posts() ) : the_post(); ?>
	
	                <li class="wpzoom-post post-blog">
	
	                <?php get_template_part( 'content', get_post_format() ); ?>
	
	                </li><!-- .wpzoom-posts .post-blog -->
	
	            <?php endwhile; ?>
	
	            </ul><!-- .wpzoom-posts .posts-blog -->
	
	            <?php get_template_part( 'pagination' ); ?>
	
	        <?php else: ?>
	
	            <?php get_template_part( 'content', 'none' ); ?>
	
	        <?php endif; ?>
	
	    </section><!-- .recent-posts -->
    
    </div><!-- .wrapper .clearfix -->

</main><!-- #content -->

<?php
get_footer();
