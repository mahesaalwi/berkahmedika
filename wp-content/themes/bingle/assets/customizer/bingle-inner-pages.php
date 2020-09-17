<?php
/*Add New Panel for Inner Page Setups */
$wp_customize->add_panel( 'bingle_inner_panel', array (
	'priority' => '20',
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Inner Pages Panel', 'bingle' ),
	'description' => __( 'Setup general options of the site.', 'bingle' )
) );

/* Blog / Archive Section */
$wp_customize->add_section( 'bingle_inner_blog_section', array(
	'title' => __('Blog / Archive Settings', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_inner_panel',
	'priority' => 20,
) );

$wp_customize->add_setting( 'bingle_inner_blog_content_wrap', array( 
	'default' 			=> 'bingle-wrapper',
	'sanitize_callback' => 'bingle_sanitize_wrapper' 
) );

$wp_customize->add_control( 'bingle_inner_blog_content_wrap', array(
	'label'    => __( 'Archive Container Wrapper Style','bingle'),
	'section' => 'bingle_inner_blog_section',
	'type'    => 'select',
	'choices' => array(
		'bingle-wrapper' => esc_html__( 'Wrapped', 'bingle' ),
		'bingle-fullwidth' => esc_html__( 'Fullwidth', 'bingle' ),
	),
) );
$wp_customize->add_setting( 'bingle_inner_blog_content_maxwidth', array( 
	'default' 			=> '1200',
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_inner_blog_content_maxwidth', array(
	'type'     => 'slider_control',
	'section'  => 'bingle_inner_blog_section',
	'label'    => __( 'Blog Container Width','bingle'),
	'input_attrs' => array(
		'min'    => 0,
		'max'    => 1920,
		'step'   => 1,
		'suffix' => 'px',
	),
	'active_callback' => 'bingle_inner_blog_content_wrapper'
) ) );

$wp_customize->add_setting( 'bingle_inner_blog_sidebar', array( 
	'default' 			=> 'sidebar-right',
	'sanitize_callback' => 'bingle_sanitize_sidebar' 
) );

$wp_customize->add_control( new Image_Radio_Buttons( $wp_customize, 'bingle_inner_blog_sidebar', array(
	'label'    => __( 'Blog / Archive Sidebar Style','bingle'),
	'section' => 'bingle_inner_blog_section',
	'type'    => 'select',
	'choices' => array(
		'sidebar-left' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-left.png',
			'name'=>__('Left Sidebar', 'bingle')
		),
		'sidebar-right' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-right.png',
			'name'=>__('Right Sidebar', 'bingle')
		),
		'sidebar-none' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-none.png',
			'name'=>__('No Sidebar', 'bingle')
		),
	)
) ) );

$wp_customize->add_setting( 'bingle_inner_blog_content_width', array( 
	'default' 			=> '70',
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_inner_blog_content_width', array(
	'type'     => 'slider_control',
	'section'  => 'bingle_inner_blog_section',
	'label'    => __( 'Blog Content Width(Primary)','bingle'),
	'input_attrs' => array(
		'min'    => 50,
		'max'    => 100,
		'step'   => 1,
		'suffix' => '%',
	),
) ) );


$wp_customize->add_setting( 'bingle_inner_blog_layout', array( 
	'default' 			=> 'list',
	'sanitize_callback' => 'bingle_sanitize_gridlist' 
) );

$wp_customize->add_control( new Image_Radio_Buttons( $wp_customize, 'bingle_inner_blog_layout', array(
	'label'    => __( 'Blog / Archive Post Style','bingle'),
	'section' => 'bingle_inner_blog_section',
	'type'    => 'select',
	'choices' => array(
		'list' => array(
			'image'=> get_template_directory_uri().'/assets/images/list.jpg',
			'name'=>__('List View', 'bingle')
		),
		'grid' => array(
			'image'=> get_template_directory_uri().'/assets/images/grid.jpg',
			'name'=>__('Grid View', 'bingle')
		),
	)
) ) );

$wp_customize->add_setting( 'bingle_inner_blog_excerpt', array( 
	'default' 			=> '50',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( 'bingle_inner_blog_excerpt', array(
	'type'    => 'number',
	'label'    => __( 'Blog / Archive Excerpt Length','bingle'),
	'description'    => __( 'Number of Words, will affect the "excerpt_length" hook and overall excerpts.','bingle'),
	'section' => 'bingle_inner_blog_section',
) );

$wp_customize->add_setting( 'bingle_inner_blog_elements', array( 
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control( new Bingle_Sortable_Elements( $wp_customize, 'bingle_inner_blog_elements', array(
	'label'    => __( 'Post Elements Order','bingle'),
	'description'    => __( 'Drag Elements to sort','bingle'),
	'section' => 'bingle_inner_blog_section',
	'choices' => array(
		'0' => array(
			'id'=> 'bingle_titlemeta',
			'name'=>__('Title & Meta', 'bingle'),
			'enable' => '1'
		),
		'1' => array(
			'id'=> 'bingle_thumbnail',
			'name'=>__('Thumbnail', 'bingle'),
			'enable' => '1'
		),
		'2' => array(
			'id'=> 'bingle_excerpt',
			'name'=>__('Excerpt & Read More', 'bingle'),
			'enable' => '1'
		)
	)
) ) );

$wp_customize->add_setting( 'bingle_inner_blog_meta_elements', array( 
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control( new Bingle_Sortable_Elements( $wp_customize, 'bingle_inner_blog_meta_elements', array(
	'label'    => __( 'Meta Elements Order','bingle'),
	'section' => 'bingle_inner_blog_section',
	'choices' => array(
		'0' => array(
			'id'=> 'bingle_author',
			'name'=>__('Author', 'bingle'),
			'enable' => '1'
		),
		'1' => array(
			'id'=> 'bingle_date',
			'name'=>__('Date', 'bingle'),
			'enable' => '1'
		),		
	)
) ) );

/* Single Post/Page Section */
$wp_customize->add_section( 'bingle_inner_single_section', array(
	'title' => __('Single Page / Post Settings', 'bingle' ),
	'capability' => 'edit_theme_options',
	'panel' => 'bingle_inner_panel',
	'priority' => 20,
) );

$wp_customize->add_setting( 'bingle_inner_single_content_wrap', array( 
	'default' 			=> 'bingle-wrapper',
	'sanitize_callback' => 'bingle_sanitize_wrapper' 
) );

$wp_customize->add_control( 'bingle_inner_single_content_wrap', array(
	'label'    => __( 'Single Container Wrapper Style','bingle'),
	'section' => 'bingle_inner_single_section',
	'type'    => 'select',
	'choices' => array(
		'bingle-wrapper' => esc_html__( 'Wrapped', 'bingle' ),
		'bingle-fullwidth' => esc_html__( 'Fullwidth', 'bingle' ),
	),
) );
$wp_customize->add_setting( 'bingle_inner_single_content_maxwidth', array( 
	'default' 			=> '1200',
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_inner_single_content_maxwidth', array(
	'type'     => 'slider_control',
	'section'  => 'bingle_inner_single_section',
	'label'    => __( 'Single Page / Post Container Width','bingle'),
	'input_attrs' => array(
		'min'    => 0,
		'max'    => 1920,
		'step'   => 1,
		'suffix' => 'px',
	),
	'active_callback' => 'bingle_inner_single_content_wrapper'
) ) );

$wp_customize->add_setting( 'bingle_inner_single_sidebar', array( 
	'default' 			=> 'sidebar-right',
	'sanitize_callback' => 'bingle_sanitize_sidebar' 
) );

$wp_customize->add_control( new Image_Radio_Buttons( $wp_customize, 'bingle_inner_single_sidebar', array(
	'label'    => __( 'Single Page / Post Sidebar Style','bingle'),
	'section' => 'bingle_inner_single_section',
	'type'    => 'select',
	'choices' => array(
		'sidebar-left' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-left.png',
			'name'=>__('Left Sidebar', 'bingle')
		),
		'sidebar-right' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-right.png',
			'name'=>__('Right Sidebar', 'bingle')
		),
		'sidebar-none' => array(
			'image'=> get_template_directory_uri().'/assets/images/sidebar-none.png',
			'name'=>__('No Sidebar', 'bingle')
		),
	)
) ) );

$wp_customize->add_setting( 'bingle_inner_single_content_width', array( 
	'default' 			=> '70',
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'bingle_sanitize_integer' 
) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'bingle_inner_single_content_width', array(
	'type'     => 'slider_control',
	'section'  => 'bingle_inner_single_section',
	'label'    => __( 'Single Page / Post Content Width (Primary)','bingle'),
	'input_attrs' => array(
		'min'    => 50,
		'max'    => 100,
		'step'   => 1,
		'suffix' => '%',
	),
) ) );

$wp_customize->add_setting( 'bingle_inner_single_meta_elements', array( 
	'sanitize_callback' => 'bingle_sanitize_text' 
) );

$wp_customize->add_control( new Bingle_Sortable_Elements( $wp_customize, 'bingle_inner_single_meta_elements', array(
	'label'    => __( 'Singel Post Elements Order','bingle'),
	'section' => 'bingle_inner_single_section',
	'choices' => array(
		'0' => array(
			'id'=> 'bingle_titlemeta',
			'name'=>__('Title & Meta', 'bingle'),
			'enable' => '1'
		),
		'1' => array(
			'id'=> 'bingle_thumbnail',
			'name'=>__('Thumbnail', 'bingle'),
			'enable' => '1'
		),
		'2' => array(
			'id'=> 'bingle_content',
			'name'=>__('Content', 'bingle'),
			'enable' => '1'
		),
		'3' => array(
			'id'=> 'bingle_tags',
			'name'=>__('Tags', 'bingle'),
			'enable' => '1'
		),
		'4' => array(
			'id'=> 'bingle_postnav',
			'name'=>__('Post Navigation', 'bingle'),
			'enable' => '1'
		),
		'5' => array(
			'id'=> 'bingle_comments',
			'name'=>__('Comments', 'bingle'),
			'enable' => '1'
		),
	)
) ) );