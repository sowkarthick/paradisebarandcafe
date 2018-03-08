<?php
/**
 * The sidebar.
 */
?>

<?php
    $show_menu_sidebar = get_theme_mod( 'navbar-show-menu-sidebar', delicio_get_default( 'navbar-show-menu-sidebar' ) );
?>

<div id="pageslide">
    <div id="slideNav" class="side-panel">

        <a href="javascript:jQuery.pageslide.close()" class="closeBtn"></a>

        <?php if ( $show_menu_sidebar ) : ?>

            <nav id="side-nav" class="side-nav">

                <?php
                if ( has_nav_menu( 'secondary' ) ) :
                    wp_nav_menu( array(
                        'menu_class'     => 'nav navbar-nav',
                        'theme_location' => 'secondary',
                        'container'      => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . delicio_wc_menu_cartitem() . '</ul>'
                    ) );
                endif;
                ?>

            </nav>

        <?php endif; ?>

        <?php dynamic_sidebar( 'sidebar' ); ?>

    </div>
</div>