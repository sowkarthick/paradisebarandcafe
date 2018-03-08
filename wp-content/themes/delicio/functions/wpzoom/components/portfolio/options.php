<?php return array(

/* Framework Admin Menu */
'menu' => array(
    'portfolio' => array(
        'name' => __('Portfolio Options', 'wpzoom')
    )
),

/* Framework Admin Options */
'portfolio' => array(
    array("type"  => "preheader",
          "name"  => __("Permalinks", 'wpzoom'),
          "desc"  => array(
              __('Here you can edit URLs for Portfolio post type. Don\'t forget to flush rules after changing them.', 'wpzoom'),
              sprintf(__('Just open the <a href="%s">Permalinks</a> page and hit <b>Save Options</b>.', 'wpzoom'), admin_url( 'options-permalink.php' ))
          )),

    array("name"  => __("Portfolio item slug", 'wpzoom'),
          "id"    => "portfolio_root",
          "std"   => "project",
          "desc"  => sprintf( '<strong>%s</strong>', home_url( option::get( 'portfolio_root' ) ) ),
          "type"  => "text"),

    array("name"  => __("Portfolio taxonomy slug", 'wpzoom'),
          "id"    => "portfolio_base",
          "std"   => "",
          "desc"  => sprintf( '<strong>%s%s</strong>', home_url( trailingslashit( option::get( 'portfolio_root' ) . '/' . option::get( 'portfolio_base' ) ) ), '%portfolio%' ),
          "type"  => "text"),

)

);