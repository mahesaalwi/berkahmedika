<?php
/*Add New Panel for header Setups */
$wp_customize->add_panel( 'bingle_header_panel', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Header Settings', 'bingle' ),
	'description' => __( 'Setup header of the site.', 'bingle' )
) );

/* Header Section */
$wp_customize->get_section('header_image')->panel = 'bingle_header_panel';
$wp_customize->get_section('header_image')->title = __('Header Background Image','bingle');

$wp_customize->add_section( 'bingle_header_section', array(
	'title' => __('Header Layouts', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_panel',
	'priority' => 10,
) );

$wp_customize->add_setting( 'bingle_header_layout_setting', array( 
	'default' 			=> 'lay0',
	'sanitize_callback' => 'bingle_sanitize_layout' 
) );

$bingle_header_layouts = array('lay0'=>array(
	'image'=> get_template_directory_uri().'/assets/images/bingle-header0.png',
	'name'=>__('Default Layout', 'bingle'),
));
for($i=1;$i<=11;$i++){
	$bingle_header_layouts['lay'.$i] = array(
		'image'=> get_template_directory_uri().'/assets/images/bingle-header'.$i.'.png',
		'name'=>__('Layout ', 'bingle').$i,
	);
}

$wp_customize->add_control( new Image_Radio_Buttons( $wp_customize, 'bingle_header_layout_setting', array(
	'type' => 'image_radio_buttons',
	'label' => __( 'Header Layouts', 'bingle' ),
	'section' => 'bingle_header_section',
	'choices' => $bingle_header_layouts,
	'changednd' => 'change-layout'
) ) );


/** Header Individual Section designs */
$header_sections = array(
	'top_header'=>__('Top Header','bingle'),
	'main_header'=>__('Main Header','bingle'),
	'bottom_header'=>__('Bottom Header','bingle')
);

foreach ($header_sections as $hsec => $htitle) {

	$wp_customize->add_section( 'bingle_'.$hsec.'_section_designs', array(
		'title' => $htitle.' '.__('Designs', 'bingle' ),
		'capability' => 'edit_theme_options',
		'panel' => 'bingle_header_panel',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'bingle_header_style_'.$hsec, array( 
		'default' 			=> 'bingle-wrapper',
		'sanitize_callback' => 'bingle_sanitize_wrapper' 
	) );

	$wp_customize->add_control( 'bingle_header_style_'.$hsec, array(
		'label'    => $htitle.' '.__( 'Wrapper Style','bingle'),
		'section' => 'bingle_'.$hsec.'_section_designs',
		'type'    => 'select',
		'choices' => array(
			'bingle-wrapper' => esc_html__( 'Wrapped', 'bingle' ),
			'bingle-fullwidth' => esc_html__( 'Fullwidth', 'bingle' ),
		),
	) );

	/* Header */
	$wp_customize->add_setting( 'bingle_header_width_'.$hsec, array( 
		'default' 			=> '1200',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_integer' 
	) );

	$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_header_width_'.$hsec, array(
		'type'     => 'slider_control',
		'section'  => 'bingle_'.$hsec.'_section_designs',
		'label'    => $htitle.' '.__( 'Wrapper Width','bingle'),
		'input_attrs' => array(
			'min'    => 800,
			'max'    => 1920,
			'step'   => 1,
			'suffix' => 'px',
		),
		'active_callback' => 'wrap_bingle_header_style_'.$hsec
	) ) );

	$wp_customize->add_setting( 'bingle_header_bkgcolor_'.$hsec, array( 
		'default' 			=> '',
		'transport' 	=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_text' 
	) );

	$wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, 'bingle_header_bkgcolor_'.$hsec, array(
		'label'    => $htitle.' '.__( 'Background Color','bingle'),
		'section'  => 'bingle_'.$hsec.'_section_designs',
		'show_opacity'  => true,
		'palette'	=> array(
			'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
			'rgba(50,50,50,0.8)',
			'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
			'#00CC99' // Mix of color types = no problem
		)
	) ) );

	$wp_customize->add_setting( 'bingle_header_marginpadding_'.$hsec, array(
		'default'           => '0, -, 0, -, 0, 0, 0, 0',
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'bingle_sanitize_text',
	) );

	$wp_customize->add_control( new Box_Model( $wp_customize, 'bingle_header_marginpadding_'.$hsec, array(
		'label'       => $htitle.' '.esc_html__( 'Margin and Padding', 'bingle' ),
		'description' => esc_html__( 'Set the default margin and padding.', 'bingle' ),
		'choices'    => array(
			'margin' => array(
				'margin-top'     => '',
				'margin-right'   => '',
				'margin-bottom'  => '',
				'margin-left'    => '',
			),
			'padding' => array(
				'padding-top'    => '20',
				'padding-right'  => '',
				'padding-bottom' => '20',
				'padding-left'   => '',
			),
		),
		'section'     => 'bingle_'.$hsec.'_section_designs',
	) ) );
}

/* Header Elements */

$wp_customize->add_panel( 'bingle_header_elements', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Header Elements', 'bingle' ),
	'description' => __( 'Setup Header Elements of the site.', 'bingle' )
) );

/* Add Default Sections to General Panel */
$wp_customize->get_section('title_tagline')->panel = 'bingle_header_elements';
$wp_customize->get_section('title_tagline')->priority = bingle_get_section_position( 'title_tagline' );

$wp_customize->add_section( 'bingle_headermenu_section', array(
	'title' => __('Primary Menu', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headermenu_section' ),
) );

$wp_customize->add_setting( 'bingle_header_menu', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control( new Info_Custom_Control( $wp_customize, 'bingle_header_menu', array(
	'type'     => 'info',
	'section'  => 'bingle_headermenu_section',
	'label'    => __( 'Primary Menu','bingle'),
	'description' => __( 'Click to setup primary menu.','bingle'),
	'linkto' 	=> array(
		'type'=>'panel',
		'value'=>'nav_menus'
	)
) ) );

$wp_customize->add_section( 'bingle_headersearch_section', array(
	'title' => __('Search', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headersearch_section' ),
) );
$wp_customize->add_setting( 'bingle_header_search_text', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control('bingle_header_search_text', array(
	'type'     => 'text',
	'section'  => 'bingle_headersearch_section',
	'label'    => __( 'Search Label','bingle'),	
) );
$wp_customize->selective_refresh->add_partial( 'bingle_header_search_text', array(
	'selector'            => '.search-wrapper',
	'container_inclusive' => true,
) );

if(class_exists('woocommerce')){
	$wp_customize->add_section( 'bingle_headercart_section', array(
		'title' => __('Cart Icon', 'bingle' ),
		'capability' => 'edit_theme_options',
		'panel' => 'bingle_header_elements',
		'priority' => bingle_get_section_position( 'bingle_headercart_section' ),
	) );
	$wp_customize->add_setting( 'bingle_header_cart_icon', array( 
		'default' 			=> 'lnr lnr-cart',
		'sanitize_callback' => 'bingle_sanitize_text' 
	) );
	$wp_customize->add_control( 'bingle_header_cart_icon', array(
		'type'     => 'text',
		'section'  => 'bingle_headercart_section',
		'label'    => __( 'Cart Icon Class','bingle'),
		'description'    => __( 'Enter Class of icon like: "fab fa-opencart"','bingle'),
	) );

	$wp_customize->add_setting( 'bingle_header_cart_dropdown', array( 
		'default' 			=> 'yes',
		'sanitize_callback' => 'bingle_sanitize_yesno' 
	) );
	$wp_customize->add_control( 'bingle_header_cart_dropdown', array(
		'type'     => 'radio',
		'section'  => 'bingle_headercart_section',
		'label'    => __( 'Show Header Cart Dropdown','bingle'),
		'description'    => __( 'Show the header cart details dropdown on hover.','bingle'),
		'choices' => array(
			'yes' => __('Yes','bingle'),
			'no' => __('No','bingle')
		)
	) );
	
	$wp_customize->selective_refresh->add_partial( 'bingle_header_cart_icon', array(
		'selector'            => '.cart-wrapper',
		'container_inclusive' => true,
	) );
}

$wp_customize->add_section( 'bingle_headersidemenu_section', array(
	'title' => __('Side Menu Icon', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headersidemenu_section' ),
) );
$wp_customize->add_setting( 'bingle_headersidemenu_widget', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control( new Info_Custom_Control( $wp_customize, 'bingle_headersidemenu_widget', array(
	'type'     => 'info',
	'section'  => 'bingle_headersidemenu_section',
	'label'    => __( 'Sidemenu Widgets','bingle'),
	'description' => __( 'Click to setup Sidemenu Contents.','bingle'),
	'linkto' 	=> array(
		'type'=>'section',
		'value'=>'sidebar-widgets-bingle-sidemenuwidget'
	)
) ) );

$wp_customize->selective_refresh->add_partial( 'bingle_headersidemenu_widget', array(
	'selector'            => '.sidewidget-wrapper',
	'container_inclusive' => true,
) );

/* Header Address Sectuion */
$wp_customize->add_section( 'bingle_headeraddress_section', array(
	'title' => __('Header Address', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headeraddress_section' ),
) );

$wp_customize->add_setting( 'bingle_header_address_icon', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_address_icon', array(
	'type'     => 'text',
	'section'  => 'bingle_headeraddress_section',
	'label'    => __( 'Address Icon Class','bingle'),
	'description'    => __( 'Enter Class of icon like: "fa fa-location"','bingle'),
) );
$wp_customize->add_setting( 'bingle_header_address', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_address', array(
	'type'     => 'textarea',
	'section'  => 'bingle_headeraddress_section',
	'label'    => __( 'Address Text','bingle'),	
	'description' => __( 'This field supports HTML','bingle'),
) );
$wp_customize->selective_refresh->add_partial( 'bingle_header_address_icon', array(
	'selector'            => '.site-address',
	'container_inclusive' => true,
) );

/* Email Section */
$wp_customize->add_section( 'bingle_headeremail_section', array(
	'title' => __('Header Email', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headeremail_section' ),
) );
$wp_customize->add_setting( 'bingle_header_email_icon', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_email_icon', array(
	'type'     => 'text',
	'section'  => 'bingle_headeremail_section',
	'label'    => __( 'Email Icon Class','bingle'),
	'description'    => __( 'Enter Class of icon like: "fa fa-envelope"','bingle'),
) );
$wp_customize->add_setting( 'bingle_header_email', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_email', array(
	'type'     => 'textarea',
	'section'  => 'bingle_headeremail_section',
	'label'    => __( 'Email Address','bingle'),
) );
$wp_customize->selective_refresh->add_partial( 'bingle_header_email_icon', array(
	'selector'            => '.site-email',
	'container_inclusive' => true,
) );

/* Phone Section */
$wp_customize->add_section( 'bingle_headerphone_section', array(
	'title' => __('Header Phone', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headerphone_section' ),
) );
$wp_customize->add_setting( 'bingle_header_phone_icon', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_phone_icon', array(
	'type'     => 'text',
	'section'  => 'bingle_headerphone_section',
	'label'    => __( 'Phone Icon Class','bingle'),
	'description'    => __( 'Enter Class of icon like: "fa fa-phone"','bingle'),
) );
$wp_customize->add_setting( 'bingle_header_phone', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_phone', array(
	'type'     => 'textarea',
	'section'  => 'bingle_headerphone_section',
	'label'    => __( 'Phone','bingle'),
) );
$wp_customize->selective_refresh->add_partial( 'bingle_header_phone_icon', array(
	'selector'            => '.site-phone',
	'container_inclusive' => true,
) );

/* social Section */
$wp_customize->add_section( 'bingle_headersocial_section', array(
	'title' => __('Header Social', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headersocial_section' ),
) );


$socials = bingle_social_icons_group();

foreach ($socials as $soc_key=>$soc_label) {	
	$wp_customize->add_setting( 'bingle_header_social_icon_'.$soc_key, array( 
		'default' 			=> '',
		'sanitize_callback' => 'bingle_sanitize_text' 
	) );

	$wp_customize->add_control( 'bingle_header_social_icon_'.$soc_key, array(
		'type'     => 'text',
		'section'  => 'bingle_headersocial_section',
		'label'    => $soc_label.' '.__('Icon' ,'bingle'),	
	) );

	$wp_customize->add_setting( 'bingle_header_social_'.$soc_key, array( 
		'default' 			=> '',
		'sanitize_callback' => 'bingle_sanitize_text' 
	) );

	$wp_customize->add_control( 'bingle_header_social_'.$soc_key, array(
		'type'     => 'text',
		'section'  => 'bingle_headersocial_section',
		'label'    => $soc_label.' '.__('Link' ,'bingle'),	
	) );
}
$wp_customize->selective_refresh->add_partial( 'bingle_header_social_icon_facebook', array(
	'selector'            => '.social-links',
	'container_inclusive' => true,
) );

/* Button Section */
$wp_customize->add_section( 'bingle_headerbutton_section', array(
	'title' => __('Header Button', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headerbutton_section' ),
) );

$wp_customize->add_setting( 'bingle_header_button_text', array( 
	'default' 			=> __('Contact','bingle'),
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_button_text', array(
	'type'     => 'text',
	'section'  => 'bingle_headerbutton_section',
	'label'    => __( 'Header Button Text','bingle'),	
) );
$wp_customize->add_setting( 'bingle_header_button_link', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_header_button_link', array(
	'type'     => 'text',
	'section'  => 'bingle_headerbutton_section',
	'label'    => __( 'Header Button Link','bingle'),	
) );
$wp_customize->selective_refresh->add_partial( 'bingle_header_button_text', array(
	'selector'            => '.site-button',
	'container_inclusive' => true,
) );
$wp_customize->add_setting( 'bingle_headerbutton_color', array( 
	'default'     => '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, 'bingle_headerbutton_color', array(
	'label'    => __('Button Background Color','bingle'),
	'section'  => 'bingle_headerbutton_section',	
	'show_opacity'  => true, // Optional.
	'palette'	=> array(
		'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
		'rgba(50,50,50,0.8)',
		'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
		'#00CC99' // Mix of color types = no problem
	)
) ) );
$wp_customize->add_setting( 'bingle_headerbutton_hover_color', array( 
	'default'     => '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( new Customize_Alpha_Color_Control($wp_customize, 'bingle_headerbutton_hover_color', array(
	'label'    => __( 'Button Hover Background Color','bingle'),
	'section'  => 'bingle_headerbutton_section',
	'show_opacity'  => true, // Optional.
	'palette'	=> array(
		'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
		'rgba(50,50,50,0.8)',
		'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
		'#00CC99' // Mix of color types = no problem
	)
) ) );

/* Header Custom Html Sectuion */
$wp_customize->add_section( 'bingle_headercustom_section', array(
	'title' => __('Custom Html Or Shortcode', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_header_elements',
	'priority' => bingle_get_section_position( 'bingle_headercustom_section' ),
) );

$wp_customize->add_setting( 'bingle_headercustom_icon', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_headercustom_icon', array(
	'type'     => 'text',
	'section'  => 'bingle_headercustom_section',
	'label'    => __( 'Custom Html Icon Class','bingle'),
	'description'    => __( 'Enter Class of icon like: "fa fa-location"','bingle'),
) );
$wp_customize->add_setting( 'bingle_headercustom', array( 
	'default' 			=> '',
	'sanitize_callback' => 'bingle_sanitize_text' 
) );
$wp_customize->add_control( 'bingle_headercustom', array(
	'type'     => 'textarea',
	'section'  => 'bingle_headercustom_section',
	'label'    => __( 'Custom Html or Shortcode','bingle'),	
	'description' => __( 'This field supports HTML or shortocde like: Language: [POLYLANG dropdown=1]','bingle'),
) );

$wp_customize->selective_refresh->add_partial( 'bingle_headercustom_icon', array(
	'selector'            => '.site-customhtml',
	'container_inclusive' => true,
) );

$header_elements_sections_width = array(
	'bingle_headercustom_section'=>array('site-customhtml','10'),
	'bingle_headersocial_section'=>array('social-links','10'),
	'title_tagline'=>array('site-branding','30'),
	'bingle_headeraddress_section'=>array('site-address','10'),
	'bingle_headerphone_section'=>array('site-phone','10'),
	'bingle_headeremail_section'=>array('site-email','10'),
	'bingle_headercart_section'=>array('cart-wrapper','5'),
	'bingle_headersidemenu_section'=>array('sidewidget-wrapper','5'),
	'bingle_headermenu_section'=>array('header-main-menu','70'),
	'bingle_headersearch_section'=>array('search-wrapper','5'),
	'bingle_headerbutton_section'=>array('site-button','10'),
);
foreach ($header_elements_sections_width as $section => $class) {
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