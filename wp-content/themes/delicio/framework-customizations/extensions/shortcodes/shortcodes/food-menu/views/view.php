<?php if (!defined('FW')) die( 'Forbidden' ); ?>
<?php $tabs_id = uniqid('fw-tabs-'); ?>

<div class="fw-food-menu-container">

    <div class="fw-heading">
        <?php $heading = "<h3 class='fw-food-section-title'>{$atts['title']}</h3>"; ?>
        <?php echo $heading; ?>
    </div>


	<?php foreach ($atts['tabs'] as $key => $tab) : ?>

        <div class="fw-food-entry">

            <span class="entry-price"><?php echo do_shortcode( $tab['tab_price'] ) ?></span>

            <h4><?php echo $tab['tab_title']; ?></h4>

     		<div class="fw-food-content">

                <p><?php echo do_shortcode( $tab['tab_content'] ) ?></p>

            </div>

        </div>

    <?php endforeach; ?>


    <a href="<?php echo esc_attr($atts['link']) ?>" target="<?php echo esc_attr($atts['target']) ?>" class="fw-btn-food">
        <span><?php echo $atts['label']; ?></span>
    </a>

</div>