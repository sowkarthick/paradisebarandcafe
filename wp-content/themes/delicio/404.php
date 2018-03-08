<?php get_header(); ?>

<main id="content" class="clearfix" role="main">

    <div class="wrapper wrapper-page-intro clearfix">

        <div class="page-meta page-archive">

            <h1 class="section-title"><?php _e( 'Error 404', 'wpzoom' ); ?></h1>

        </div><!-- .page-meta .page-archive -->

    </div><!-- .wrapper .wrapper-page-intro .clearfix -->

    <?php get_template_part( 'content', 'none' ); ?>

</main><!-- #content -->

<?php
get_footer();
