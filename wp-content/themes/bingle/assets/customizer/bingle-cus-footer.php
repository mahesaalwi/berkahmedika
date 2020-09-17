<?php
/*Add New Panel for footer Setups */
$wp_customize->add_panel( 'bingle_footer_panel', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Footer Settings', 'bingle' ),
	'description' => __( 'Setup footer of the site.', 'bingle' )
) );

/* footer Section */
$wp_customize->add_section( 'bingle_footer_section', array(
	'title' => __('Footer Layouts', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_footer_panel',
	'priority' => 10,
) );

$wp_customize->add_setting( 'bingle_footer_layout_setting', array( 
	'default' 			=> 'lay2',
	'sanitize_callback' => 'bingle_sanitize_layout' 
) );

$bingle_footer_layouts = array();
for($i=1;$i<=3;$i++){
	$bingle_footer_layouts['lay'.$i] = array(
		'image'=> get_template_directory_uri().'/assets/images/bingle-footer'.$i.'.png',
		'name'=>__('Layout ', 'bingle').$i,
	);
}

$wp_customize->add_control( new Image_Radio_Buttons( $wp_customize, 'bingle_footer_layout_setting', array(
	'type' => 'image_radio_buttons',
	'label' => __( 'Footer Layouts', 'bingle' ),
	'section' => 'bingle_footer_section',
	'choices' => $bingle_footer_layouts,
	'changednd' => 'change-layout',
) ) );


/** Footer Individual Section designs */
$footer_sections = array(
	'top_footer'=>__('Top Footer','bingle'),
	'main_footer'=>__('Main Footer','bingle')
);

foreach ($footer_sections as $fsec => $ftitle) {

	$wp_customize->add_section( 'bingle_'.$fsec.'_section_designs', array(
		'title' => $ftitle.' '.__('Designs', 'bingle' ),
		'capability' => 'edit_theme_options',
		'panel' => 'bingle_footer_panel',
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'bingle_footer_style_'.$fsec, array( 
		'default' 			=> 'bingle-wrapper',
		'sanitize_callback' => 'bingle_sanitize_wrapper' 
	) );

	$wp_customize->add_control( 'bingle_footer_style_'.$fsec, array(
		'label'    => $ftitle.' '.__( 'Wrapper Style','bingle'),
		'section' => 'bingle_'.$fsec.'_section_designs',
		'type'    => 'select',
		'choices' => array(
			'bingle-wrapper' => esc_html__( 'Wrapped', 'bingle' ),
			'bingle-fullwidth' => esc_html__( 'Fullwidth', 'bingle' ),
		),
	) );

	/* footer */
	$wp_customize->add_setting( 'bingle_footer_width_'.$fsec, array( 
		'default' 			=> '1200',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_integer' 
	) );

	$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_footer_width_'.$fsec, array(
		'type'     => 'slider_control',
		'section'  => 'bingle_'.$fsec.'_section_designs',
		'label'    => $ftitle.' '.__( 'Wrapper Width','bingle'),
		'input_attrs' => array(
			'min'    => 800,
			'max'    => 1920,
			'step'   => 1,
			'suffix' => 'px',
		),
		'active_callback' => 'wrap_bingle_footer_style_'.$fsec
	) ) );

	$wp_customize->add_setting( 'bingle_footer_bkgcolor_'.$fsec, array( 
		'default' 			=> '',
		'transport' 	=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_text' 
	) );

	$wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, 'bingle_footer_bkgcolor_'.$fsec, array(
		'label'    => $ftitle.' '.__( 'Background Color','bingle'),
		'section'  => 'bingle_'.$fsec.'_section_designs',
		'show_opacity'  => true,
		'palette'	=> array(
			'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
			'rgba(50,50,50,0.8)',
			'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
			'#00CC99' // Mix of color types = no problem
		)
	) ) );

	$wp_customize->add_setting( 'bingle_footer_marginpadding_'.$fsec, array(
		'default'           => '0, -, 0, -, 0, 0, 0, 0',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_text',
	) );

	$wp_customize->add_control( new Box_Model( $wp_customize, 'bingle_footer_marginpadding_'.$fsec, array(
		'label'       => $ftitle.' '.esc_html__( 'Margin and Padding', 'bingle' ),
		'description' => esc_html__( 'Set the default margin and padding.', 'bingle' ),
		'choices'    => array(
			'margin' => array(
				'margin-top'     => '',
				'margin-right'   => '',
				'margin-bottom'  => '',
				'margin-left'    => '',
			),
			'padding' => array(
				'padding-top'    => '',
				'padding-right'  => '',
				'padding-bottom' => '',
				'padding-left'   => '',
			),
		),
		'section'     => 'bingle_'.$fsec.'_section_designs',
	) ) );
}


/* Footer Elements */
$wp_customize->add_panel( 'bingle_footer_elements', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Footer Elements', 'bingle' ),
	'description' => __( 'Setup Footer Elements of the site.', 'bingle' )
) );

$wp_customize->add_section( 'bingle_footer_menu_section', array(
	'title' => __('Footer Menu', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_footer_elements',
	'priority' => bingle_get_section_position( 'bingle_footer_menu_section','footer' ),
) );

$wp_customize->add_setting( 'bingle_footer_menu', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Info_Custom_Control( $wp_customize, 'bingle_footer_menu', array(
	'type'     => 'info',
	'section'  => 'bingle_footer_menu_section',
	'label'    => __( 'Footer Menu','bingle'),
	'description' => __( 'Click to setup footer menu.','bingle'),
	'linkto' 	=> array(
		'type'=>'panel',
		'value'=>'nav_menus'
	)
) ) );
$wp_customize->selective_refresh->add_partial( 'bingle_footer_menu', array(
	'selector'            => '.footermenu',
	'container_inclusive' => true,
) );

$wp_customize->add_section( 'bingle_footer_copyright_section', array(
	'title' => __('Footer Copyright', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_footer_elements',
	'priority' => bingle_get_section_position( 'bingle_footer_copyright_section','footer' ),
) );

$wp_customize->add_setting( 'bingle_footer_copyright_text', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control('bingle_footer_copyright_text', array(
	'type'     => 'textarea',
	'section'  => 'bingle_footer_copyright_section',
	'label'    => __( 'Footer Copyright Text','bingle'),	
) );
$wp_customize->selective_refresh->add_partial( 'bingle_footer_copyright_text', array(
	'selector'            => '.site-info',
	'container_inclusive' => true,
) );


/* social Section */
$wp_customize->add_section( 'bingle_footer_social', array(
	'title' => __('Footer Social', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_footer_elements',
	'priority' => bingle_get_section_position( 'bingle_footer_social','footer'),
) );
$wp_customize->add_setting( 'bingle_footer_social_info', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Info_Custom_Control( $wp_customize, 'bingle_footer_social_info', array(
	'type'     => 'info',
	'section'  => 'bingle_footer_social',
	'label'    => __( 'Footer Social','bingle'),
	'description' => __( 'Go to Header Social to setup footer social icons.','bingle'),
	'linkto' 	=> array(
		'type'=>'section',
		'value'=>'bingle_headersocial_section'
	)
) ) );

$footer_elements_sections_width = array(
	'bingle_footer_menu_section'=>array('footermenu','100'),
	'bingle_footer_copyright_section'=>array('site-info','100'),
	'bingle_footer_social'=>array('site-footer .social-links','100')
);
foreach ($footer_elements_sections_width as $section => $class) {
	$wp_customize->add_setting( $section.'_width', array( 
		'default' 			=> $class[1],
		'transport' => 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_integer' 
	) );
	$wp_customize->add_control( $section.'_width', array(
		'type'     => 'number',
		'section'  => $section,
		'priority' => '5',
		'label'    => __( 'Section Width (%)','bingle'),	
		'description' => __( 'Enter width of the section in percentage.','bingle'),
	) );
}