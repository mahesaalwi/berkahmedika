<?php
/**
* Welcome Page Initiation
*/

include get_template_directory() . '/assets/welcome/welcome.php';

/** Plugins **/
$plugins_args = array(
	/* Companion Plugins */
	'companion_plugins' => array(
	),

	/* Displays on Required Plugins tab */
	'req_plugins' => array(
		'free_plug' => array(
			'ap-companion' => array(
				'slug'      => 'ap-companion',
				'filename' 	=> 'ap-companion.php',
				'class' 	=> 'Ap_Companion',
			),
			'contact-form-7' => array(
				'slug'      => 'contact-form-7',
				'filename' 	=> 'wp-contact-form-7.php',
				'class' 	=> 'WPCF7',
			),
			'elementor' => array(
				'slug'      => 'elementor',
				'filename' 	=> 'elementor.php',
				'function' 	=> 'elementor_load_plugin_textdomain',
			),
		),
		'pro_plug' => array()
	),

	/* Displays on Import Demo section */
	'required_plugins' => array(
		'access-demo-importer' => array(
			'slug' 		=> 'access-demo-importer',
			'name' 		=> esc_html__('Access Demo Importer', 'bingle'),
			'filename' 	=>'access-demo-importer.php',
			'host_type' => 'wordpress',
			'class' 	=> 'Access_Demo_Importer',
			'info' 		=> esc_html__('Access Demo Importer adds the feature to Import the Demo Conent with a single click.', 'bingle'),
		),
	),
);
$strings = array(
// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( "Bingle Setup", 'bingle' ),
	'theme_short_description' => esc_html__( 'Bingle is a responsive multipurpose WordPress theme suitable for almost any type of website. It is lightweight, super fast and highly customizable theme perfect for small business, web agencies and developers. It is a customizer and Elementor based WordPress theme. This free yet versatile theme is suitable for building any kind of niche-based or multipurpose website. If you are looking to create a website for a business, single app, minimal, event, law, dental, WooCommerce, education, resume, blog, gym or any such website – Bingle is a go-to WordPress theme. It comes with 11 creative starter websites - full demos. Choose any unique starter website built with Elementor and customize it fully as per your preference. 
It is a highly flexible theme with lots of customization options. It features 10 preset header layouts, custom footer builder, multiple page layouts and much more to let you create an elegant website that stands out. Checkout demos: https://demo.accesspressthemes.com/bingle', 'bingle' ),

// Plugin Action Texts
	'install_n_activate' 	=> esc_html__('Install and Activate', 'bingle'),
	'deactivate' 			=> esc_html__('Deactivate', 'bingle'),
	'activate' 				=> esc_html__('Activate', 'bingle'),

// Getting Started Section
	'doc_heading' 		=> esc_html__('Step 1 - Documentation', 'bingle'),
	'doc_description' 	=> esc_html__('Read the Documentation and follow the instructions to manage the site , it helps you to set up the theme more easily and quickly. The Documentation is very easy with its pictorial  and well managed listed instructions. ', 'bingle'),
	'doc_read_now' 		=> esc_html__( 'Read Now', 'bingle' ),
	'cus_heading' 		=> esc_html__('Step 2 - Customizer Panel', 'bingle'),
	'cus_description' 	=> esc_html__('Using the customizer panel you can easily customize every aspect of the theme.', 'bingle'),
	'cus_read_now' 		=> esc_html__( 'Go to Customizer Panels', 'bingle' ),

// Recommended Plugins Section
	'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'bingle' ),
	'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'bingle' ),



// Demo Actions
	'activate_btn' 		=> esc_html__('Activate', 'bingle'),
	'installed_btn' 	=> esc_html__('Activated', 'bingle'),
	'demo_installing' 	=> esc_html__('Installing Demo', 'bingle'),
	'demo_installed' 	=> esc_html__('Demo Installed', 'bingle'),
	'demo_confirm' 		=> esc_html__('Are you sure to import demo content ?', 'bingle'),

// Actions Required
	'req_plugin_info' => esc_html__('All these required plugins will be installed and activated while importing demo. Or you can choose to install and activate them manually. If you\'re not importing any of the demos, you must install and activate these plugins manually.', 'bingle' ),
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'bingle' ),
	'customize_theme_btn' 	=> esc_html__( 'Customize Theme', 'bingle' ),
	'pro_plugin_title' 			=> esc_html__( 'Premium Plugins', 'bingle' ),
	'free_plugin_title' 		=> esc_html__( 'Free Plugins', 'bingle' ),
);

/**
* Initiating Welcome Page
*/
$my_theme_wc_page = new Bingle_Demo_Welcome( $plugins_args, $strings );