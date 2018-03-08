<?php return array(


/* Theme Admin Menu */
"menu" => array(
    array("id"    => "1",
          "name"  => "General"),

),

/* Theme Admin Options */
"id1" => array(
    array("type"  => "preheader",
          "name"  => "Theme Settings"),

    array("name"  => "Custom Feed URL",
          "desc"  => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
          "id"    => "misc_feedburner",
          "std"   => "",
          "type"  => "text"),

	array("name"  => "Enable comments for static pages",
          "id"    => "comments_page",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "Display WooCommerce Cart Button in the Header?",
          "id"    => "cart_icon",
          "std"   => "on",
          "type"  => "checkbox"),

    array(
        "type" => "preheader",
        "name" => "Global Posts Options"
    ),

    array(
        "name" => "Content",
        "desc" => "Number of posts displayed on homepage can be changed <a href=\"options-reading.php\" target=\"_blank\">here</a>.",
        "id" => "display_content",
        "options" => array(
            'Excerpt',
            'Full Content',
            'None'
        ),
        "std" => "Excerpt",
        "type" => "select"
    ),

    array(
        "name" => "Excerpt length",
        "desc" => "Default: <strong>50</strong> (words)",
        "id" => "excerpt_length",
        "std" => "50",
        "type" => "text"
    ),

    array(
        "name" => "Display Featured Image at the Top",
        "id" => "display_thumb",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Date/Time",
        "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
        "id" => "display_date",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Author",
        "id" => "display_author",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Category",
        "id" => "display_category",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Comments Count",
        "id" => "display_comments",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Read More Button",
        "id" => "display_more",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "type" => "preheader",
        "name" => "Single Post Options"
    ),

    array(
        "name" => "Display Category",
        "id" => "post_category",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Author Name at the Top",
        "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
        "id" => "post_author",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Date/Time",
        "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
        "id" => "post_date",
        "std" => "on",
        "type" => "checkbox"
    ),


    array(
        "type" => "startsub",
        "name" => "Post Footer Details",
    ),

        array(
            "name" => "Display Author Profile",
            "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
            "id" => "post_author_box",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "name" => "Display Tags",
            "id" => "post_tags",
            "std" => "on",
            "type" => "checkbox"
        ),

    array(
        "type" => "endsub"
    ),

    array(
        "name" => "Display Comments",
        "id" => "post_comments",
        "std" => "on",
        "type" => "checkbox"
    ),

)
/* end return */);