<?php get_header(); ?>

<?php
$taxonomy_obj = $wp_query->get_queried_object();
$taxonomy_nice_name = $taxonomy_obj->name;
?>

<main id="content" class="clearfix" role="main">

    <header class="entry-header">

        <div class="wrapper wrapper-page-intro clearfix">

            <div class="page-meta page-archive">

                <h1 class="entry-title"><?php echo $taxonomy_nice_name; ?></h1>


            </div><!-- .page-meta .page-archive -->

        </div><!-- .wrapper .wrapper-page-intro .clearfix -->

    </header><!-- .entry-header -->

    <section class="menu-section">

		<div class="wrapper wrapper-normal clearfix">

            <div class="posts-menu clearfix">

                <?php while (have_posts()) : the_post(); ?>

                    <div class="post-menu-item">

                        <?php get_template_part('content', 'menu-item-short'); ?>

                    </div>

                <?php endwhile;
                wp_reset_query(); ?>

            </div><!-- .wpzoom-posts .posts-blog -->

        </div><!-- .wrapper .wrapper-normal .clearfix -->

    </section><!-- .menu-section -->

</main><!-- #content -->

<?php
get_footer();
