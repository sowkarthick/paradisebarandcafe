<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>

    <script>
        var reJS = new RegExp('(^|\\s)no-js(\\s|$)');
        document.documentElement.className = document.documentElement.className.replace(reJS, '$1js$2');
    </script>
</head>
<body <?php body_class( 'zoom-preloader' ); ?>>

<div class="page-wrap">

<?php
    $show_menu = get_theme_mod( 'navbar-show-menu', delicio_get_default( 'navbar-show-menu' ) );
    $show_hamburger_icon = get_theme_mod( 'navbar-show-hamburger', delicio_get_default( 'navbar-show-hamburger' ) );
?>

    <div id="container">

        <?php get_sidebar(); ?>

        <header class="site-header">

            <div class="wrapper clearfix">

                <div class="wrapper-inner">

                    <div class="navbar-brand">
                        <?php if ( ! delicio_has_logo() ) echo '<h1>'; ?>

                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>">

                          <?php
                          if ( delicio_has_logo() ) {
                              delicio_logo();
                          } else {
                              bloginfo( 'name' );
                          }
                          ?>

                        </a>

                        <?php if ( ! delicio_has_logo() ) echo '</h1>'; ?>

                        <?php
                        $hide_tagline = (int) get_theme_mod( 'hide-tagline', delicio_get_default( 'hide-tagline' ) );
                        ?>
                        <?php if ( ! get_theme_mod( 'hide-tagline' ) ) : ?>
                            <p class="tagline"><?php bloginfo( 'description' ); ?></p>
                        <?php endif; ?>

                    </div><!-- #logo .navbar-brand -->


                    <nav class="main-navbar" role="navigation">

                        <?php if ( $show_menu ) : ?>

                            <div id="navbar-main">

                                <?php if (has_nav_menu( 'primary' )) {
                                    wp_nav_menu( array(
                                        'menu_class'     => 'nav navbar-nav dropdown sf-menu',
                                        'theme_location' => 'primary',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s' . delicio_wc_menu_cartitem() . '</ul>'
                                    ) );
                                } else {
                                    wp_nav_menu( array(
                                       'menu_class'     => 'nav navbar-nav dropdown sf-menu',
                                       'menu' => 'main'
                                    ) );
                                } ?>


                            </div><!-- #navbar-main -->

                        <?php endif; ?>

                   </nav><!-- .navbar -->

                   <?php if ( $show_hamburger_icon ) : ?>

                       <div class="side-panel-btn">

                           <a class="navbar-toggle" href="#slideNav">
                               <span class="sr-only"><?php _e( 'Toggle sidebar &amp; navigation', 'wpzoom' ); ?></span>
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                               <span class="icon-bar"></span>
                           </a>

                       </div>

                   <?php endif; ?>

                </div><!-- .wrapper-inner -->

            </div><!-- .wrapper .wrapper-header -->

        </header><!-- .header-site -->

        <!-- <div class="zoom-page-overlay"></div> -->

        <?php if ( ( get_theme_mod( 'home-slider-show', delicio_get_default( 'home-slider-show' ) ) && is_front_page() && $paged < 2)  ||  ( get_theme_mod( 'home-slider-show', delicio_get_default( 'home-slider-show' ) ) && is_page_template('page-templates/homepage-builder.php') )  ): ?>

            <?php get_template_part( 'wpzoom-slider' ); ?>

        <?php endif; ?>