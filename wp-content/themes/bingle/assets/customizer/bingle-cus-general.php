<?php
/*Add New Panel for general Setups */
$wp_customize->add_panel( 'bingle_general_panel', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'General Panel', 'bingle' ),
	'description' => __( 'Setup general options of the site.', 'bingle' )
) );

//Add Default Sections to General Panel
$wp_customize->get_section('colors')->panel = 'bingle_general_panel';
$wp_customize->get_section('background_image')->panel = 'bingle_general_panel';
$wp_customize->get_section('static_front_page')->panel = 'bingle_general_panel';