<?php
/*
Template Name: Food Menu (Jetpack)
*/
?>
<?php get_header(); ?>

<?php $entryCoverBackground = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'entry-cover'); ?>

    <main id="content" class="clearfix" role="main">

        <header class="entry-header">

            <?php if (has_post_thumbnail()) { ?>

                <div class="entry-cover" style="background-image: url('<?php echo $entryCoverBackground[0]; ?>')">

            <?php } ?>

                <div class="wrapper wrapper-page-intro clearfix">

                    <div class="page-meta page-archive">

                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    </div><!-- .page-meta .page-archive -->

                </div><!-- .wrapper .wrapper-page-intro .clearfix -->

            <?php if (has_post_thumbnail()) { ?>

                </div><!-- .entry-cover -->

            <?php } ?>

        </header><!-- .entry-header -->


        <section class="menu-section">

            <?php

            $menu_sections = delicio_get_menu_sections();

            if(!empty($menu_sections)) { ?>

            <div class="nova-menu-filter">
                <div class="wrapper clearfix">

                    <ul>
                        <li data-filter="*" class="active"><?php _e('All', 'wpzoom'); ?></li>
                        <?php foreach ($menu_sections as $menu_section) : ?>
                            <li data-filter=".<?php echo $menu_section->slug ?>">
                                <?php echo $menu_section->name; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>


                <div class="nova-menu-wrapper">
                    <?php
                    foreach ($menu_sections as $menu_section) {

                        query_posts(array(
                            'post_type' => 'nova_menu_item',
                            'posts_per_page' => 99,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'nova_menu',
                                    'field' => 'id',
                                    'terms' => $menu_section->term_id
                                )
                            )
                        ));

                        ?>
                        <div class="nova-menu-grid-item <?php echo $menu_section->slug ?>">

                            <div class="wrapper wrapper-normal clearfix">

                                <h2 class="section-title"><?php echo $menu_section->name; ?></h2>

                                <div class="posts-menu clearfix">

                                    <?php while (have_posts()) : the_post(); ?>

                                        <div class="post-menu-item">

                                            <?php get_template_part('content', 'menu-item-short'); ?>

                                        </div>

                                    <?php endwhile;
                                    wp_reset_query(); ?>

                                </div><!-- .wpzoom-posts .posts-blog -->

                                <div class="cleaner">&nbsp;</div>

                            </div><!-- .wrapper .wrapper-normal .clearfix -->

                        </div>
                        <?php

                    }

                    }
                    ?>
                </div>

        </section><!-- .menu-section -->

    </main><!-- #content -->

<?php
get_footer();