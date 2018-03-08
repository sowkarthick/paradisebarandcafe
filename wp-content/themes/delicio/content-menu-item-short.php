<?php

$classes = array(
        'post-menu',
        'entry'
    );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <span class="entry-price"><?php echo get_post_meta($post->ID, 'nova_price', true); ?></span>

    <h3 class="entry-title"><?php the_title(); ?></h3>

    <?php the_content(); ?>

</article><!-- #post-## -->