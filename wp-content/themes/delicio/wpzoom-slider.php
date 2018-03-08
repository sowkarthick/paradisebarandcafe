<?php
$featured = new WP_Query( array(
    'post_type'      => 'slider',
    'posts_per_page' => get_theme_mod( 'home-slider-slides-count', delicio_get_default( 'home-slider-slides-count' ) )
) );

$slide_number = 0;
?>

<div id="slider" class="site-slider">

	<?php if ( $featured->have_posts() ) : ?>

		<ul class="slides clearfix">

			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

                <?php
                $slide_url = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_url', true ) );
                $btn_title = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_button_title', true ) );
                $btn_url = trim( get_post_meta( get_the_ID(), 'wpzoom_slide_button_url', true ) );
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured');
                $small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-small');

                $slide_number++;

                $style = ' data-smallimg="' . $small_image_url[0] . '" data-bigimg="' . $large_image_url[0] . '"';

                if ($slide_number === 1) {
                    $style .= ' style="background-image:url(\'' . $small_image_url[0] . '\')"';
                }

                ?>

                <li class="slide" <?php echo $style; ?>>
                    <div class="slide-background-overlay"></div>

                        <div class="slide-content wrapper">

                            <?php if ( empty( $slide_url ) ) : ?>

                                <?php the_title( '<h2>', '</h2>' ); ?>

                            <?php else: ?>

                                <?php the_title( sprintf( '<h2><a href="%s">', esc_url( $slide_url ) ), '</a></h2>' ); ?>

                            <?php endif; ?>


                            <div class="slide-excerpt"><?php the_content(); ?></div>

                            <?php if ( ! empty( $btn_title ) && ! empty( $btn_url ) ) : ?>

                                <a class="button" href="<?php echo esc_url( $btn_url ); ?>"><?php echo esc_html( $btn_title ); ?></a>

                            <?php endif; ?>

                        </div><!-- .slide-content -->

                </li>
            <?php endwhile; ?>

		</ul>

        <div id="scroll-to-content" title="<?php esc_attr_e( 'Scroll to Content', 'wpzoom' ); ?>">
            <?php _e( 'Scroll to Content', 'wpzoom' ); ?>
        </div>

	<?php else: ?>

		<div class="empty-slider">
			<p><strong><?php _e( 'You are now ready to set-up your Slideshow content.', 'wpzoom' ); ?></strong></p>

			<p>
				<?php
				printf(
					__( 'For more information about adding posts to the slider, please <a href="%1$s">read the documentation</a>', 'wpzoom' ),
					'http://www.wpzoom.com/documentation/delicio/'
				);
				?>
			</p>
		</div>

	<?php endif; ?>

</div>