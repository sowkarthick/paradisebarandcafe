<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_url           = admin_url();

$options = array(
    'title'    => array(
        'type'  => 'text',
        'label' => __( 'Heading Title', 'fw' ),
        'desc'  => __( 'Write the heading title content', 'fw' ),
    ),
	'tabs' => array(
		'type'          => 'addable-popup',
		'label'         => __( 'Food Menu', 'fw' ),
		'popup-title'   => __( 'Add/Edit Menu Entry', 'fw' ),
		'desc'          => __( 'Create your menu', 'fw' ),
		'template'      => '{{=tab_title}}',
		'popup-options' => array(
			'tab_title' => array(
				'type'  => 'text',
				'label' => __('Title', 'fw')
			),
			'tab_content' => array(
				'type'  => 'textarea',
				'label' => __('Description', 'fw')
			),
            'tab_price' => array(
                'type'  => 'text',
                'label' => __('Price', 'fw')
            ),
		),
	),
    'label'  => array(
        'label' => __( 'Button Label', 'fw' ),
        'desc'  => __( 'This is the text that appears on your button', 'fw' ),
        'type'  => 'text',
        'value' => 'View Full Menu'
    ),
    'link'   => array(
        'label' => __( 'Button Link', 'fw' ),
        'desc'  => __( 'Where should your button link to', 'fw' ),
        'type'  => 'text',
        'value' => '#'
    ),
    'target' => array(
        'type'  => 'switch',
        'label'   => __( 'Open Link in New Window', 'fw' ),
        'desc'    => __( 'Select here if you want to open the linked page in a new window', 'fw' ),
        'right-choice' => array(
            'value' => '_blank',
            'label' => __('Yes', 'fw'),
        ),
        'left-choice' => array(
            'value' => '_self',
            'label' => __('No', 'fw'),
        ),
    ),

);