<?php
/**
 * Progression Theme Customizer
 *
 * @package pro
 */

get_template_part('inc/customizer/new', 'controls');
get_template_part('inc/customizer/typography', 'controls');
get_template_part('inc/customizer/alpha', 'control');// New Alpha Control



/* Remove Default Theme Customizer Panels that aren't useful */
function progression_studios_change_default_customizer_panels ( $wp_customize ) {
	$wp_customize->remove_section("themes"); //Remove Active Theme + Theme Changer
   $wp_customize->remove_section("static_front_page"); // Remove Front Page Section
}
add_action( "customize_register", "progression_studios_change_default_customizer_panels" );



function progression_studios_customizer( $wp_customize ) {


	/* Panel - General */
	$wp_customize->add_panel( 'progression_studios_general_panel', array(
		'priority'    => 3,
		'title'       => esc_html__( 'General', 'vayvo-progression' ),
		 )
 	);


	/* Section - General - General Layout */
	$wp_customize->add_section( 'progression_studios_section_general_layout', array(
		'title'          => esc_html__( 'General Options', 'vayvo-progression' ),
		'panel'          => 'progression_studios_general_panel', // Not typically needed.
		'priority'       => 10,
		)
	);



	/* Setting - General - General Layout */
	$wp_customize->add_setting('progression_studios_site_width',array(
		'default' => '1200',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_site_width', array(
		'label'    => esc_html__( 'Site Width(px)', 'vayvo-progression' ),
		'section' => 'progression_studios_section_general_layout',
		'priority'   => 15,
		'choices'     => array(
			'min'  => 961,
			'max'  => 4500,
			'step' => 1
		), ) )
	);


	/* Setting - Footer Elementor
	https://gist.github.com/ajskelton/27369df4a529ac38ec83980f244a7227
	*/
	$progression_studios_elementor_error_library_list =  array(
		'' => 'Choose a template',
	);
	$progression_studios_elementor_404_args = array('post_type' => 'elementor_library', 'posts_per_page' => 99);
	$progression_studios_elementor_404_posts = get_posts( $progression_studios_elementor_404_args );
	foreach($progression_studios_elementor_404_posts as $progression_studios_elementor_404_post) {
	    $progression_studios_elementor_error_library_list[$progression_studios_elementor_404_post->ID] = $progression_studios_elementor_404_post->post_title;
	}

	$wp_customize->add_setting( 'progression_studios_error_elementor_library' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_error_elementor_library', array(
	  'type' => 'select',
	'section' => 'progression_studios_section_general_layout',
	  'priority'   => 16,
	  'label'    => esc_html__( '404 Page Elementor Template', 'vayvo-progression' ),
	  'description'    => esc_html__( 'You can add/edit your 404 page under ', 'vayvo-progression') . '<a href="' . admin_url() . 'edit.php?post_type=elementor_library">Elementor > Templates</a>',
	  'choices'  => 	   $progression_studios_elementor_error_library_list,
	) );



	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_select_color', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_select_color', array(
		'label'    => esc_html__( 'Mouse Selection Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_general_layout',
		'priority'   => 20,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_select_bg', array(
		'default'	=> '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_select_bg', array(
		'default'	=> '#22b2ee',
		'label'    => esc_html__( 'Mouse Selection Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_general_layout',
		'priority'   => 25,
		))
	);









	/* Setting - General - General Layout */
	$wp_customize->add_setting( 'progression_studios_lightbox_caption' ,array(
		'default' => 'on',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_lightbox_caption', array(
		'label'    => esc_html__( 'Lightbox Captions', 'vayvo-progression' ),
		'section' => 'progression_studios_section_general_layout',
		'priority'   => 100,
		'choices'     => array(
			'on' => esc_html__( 'On', 'vayvo-progression' ),
			'off' => esc_html__( 'Off', 'vayvo-progression' ),
		),
		))
	);

	/* Setting - General - General Layout */
	$wp_customize->add_setting( 'progression_studios_lightbox_play' ,array(
		'default' => 'on',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_lightbox_play', array(
		'label'    => esc_html__( 'Lightbox Gallery Play/Pause', 'vayvo-progression' ),
		'section' => 'progression_studios_section_general_layout',
		'priority'   => 110,
		'choices'     => array(
			'on' => esc_html__( 'On', 'vayvo-progression' ),
			'off' => esc_html__( 'Off', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - General - General Layout */
	$wp_customize->add_setting( 'progression_studios_lightbox_count' ,array(
		'default' => 'on',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_lightbox_count', array(
		'label'    => esc_html__( 'Lightbox Gallery Count', 'vayvo-progression' ),
		'section' => 'progression_studios_section_general_layout',
		'priority'   => 150,
		'choices'     => array(
			'on' => esc_html__( 'On', 'vayvo-progression' ),
			'off' => esc_html__( 'Off', 'vayvo-progression' ),
		),
		))
	);








	/* Section - General - Page Loader */
	$wp_customize->add_section( 'progression_studios_section_page_transition', array(
		'title'          => esc_html__( 'Page Loader', 'vayvo-progression' ),
		'panel'          => 'progression_studios_general_panel', // Not typically needed.
		'priority'       => 26,
		)
	);

	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_page_transition' ,array(
		'default' => 'transition-off-pro',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_page_transition', array(
		'label'    => esc_html__( 'Display Page Loader?', 'vayvo-progression' ),
		'section' => 'progression_studios_section_page_transition',
		'priority'   => 10,
		'choices'     => array(
			'transition-on-pro' => esc_html__( 'On', 'vayvo-progression' ),
			'transition-off-pro' => esc_html__( 'Off', 'vayvo-progression' ),
		),
		))
	);

	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_transition_loader' ,array(
		'default' => 'circle-loader-pro',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_transition_loader', array(
		'label'    => esc_html__( 'Page Loader Animation', 'vayvo-progression' ),
		'section' => 'progression_studios_section_page_transition',
		'type' => 'select',
		'priority'   => 15,
		'choices' => array(
			'circle-loader-pro' => esc_html__( 'Circle Loader Animation', 'vayvo-progression' ),
	        'cube-grid-pro' => esc_html__( 'Cube Grid Animation', 'vayvo-progression' ),
	        'rotating-plane-pro' => esc_html__( 'Rotating Plane Animation', 'vayvo-progression' ),
	        'double-bounce-pro' => esc_html__( 'Doube Bounce Animation', 'vayvo-progression' ),
	        'sk-rectangle-pro' => esc_html__( 'Rectangle Animation', 'vayvo-progression' ),
			'sk-cube-pro' => esc_html__( 'Wandering Cube Animation', 'vayvo-progression' ),
			'sk-chasing-dots-pro' => esc_html__( 'Chasing Dots Animation', 'vayvo-progression' ),
			'sk-circle-child-pro' => esc_html__( 'Circle Animation', 'vayvo-progression' ),
			'sk-folding-cube' => esc_html__( 'Folding Cube Animation', 'vayvo-progression' ),

		 ),
		)
	);





	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_page_loader_text', array(
		'default' => '#cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_page_loader_text', array(
		'label'    => esc_html__( 'Page Loader Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_page_transition',
		'priority'   => 30,
	) )
	);

	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_page_loader_secondary_color', array(
		'default' => '#ededed',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_page_loader_secondary_color', array(
		'label'    => esc_html__( 'Page Loader Secondary (Circle Loader)', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_page_transition',
		'priority'   => 31,
	) )
	);


	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_page_loader_bg', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_page_loader_bg', array(
		'label'    => esc_html__( 'Page Loader Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_page_transition',
		'priority'   => 35,
	) )
	);









	/* Section - Footer - Scroll To Top */
	$wp_customize->add_section( 'progression_studios_section_scroll', array(
		'title'          => esc_html__( 'Scroll To Top Button', 'vayvo-progression' ),
		'panel'          => 'progression_studios_general_panel', // Not typically needed.
		'priority'       => 100,
	) );

	/* Setting - Footer - Scroll To Top */
	$wp_customize->add_setting( 'progression_studios_pro_scroll_top', array(
		'default' => 'scroll-on-pro',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_pro_scroll_top', array(
		'label'    => esc_html__( 'Scroll To Top Button', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_scroll',
		'priority'   => 10,
		'choices'     => array(
			'scroll-on-pro' => esc_html__( 'On', 'vayvo-progression' ),
			'scroll-off-pro' => esc_html__( 'Off', 'vayvo-progression' ),
		),
	) ) );

	/* Setting - Footer - Scroll To Top */
	$wp_customize->add_setting( 'progression_studios_scroll_color', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_scroll_color', array(
		'label'    => esc_html__( 'Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_scroll',
		'priority'   => 15,
		) )
	);


	/* Setting - Footer - Scroll To Top */
	$wp_customize->add_setting( 'progression_studios_scroll_bg_color', array(
		'default' => 'rgba(100,100,100,  0.65)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
		)
	);
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_scroll_bg_color', array(
		'default' => 'rgba(100,100,100,  0.65)',
		'label'    => esc_html__( 'Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_scroll',
		'priority'   => 20,
		) )
	);



	/* Setting - Footer - Scroll To Top */
	$wp_customize->add_setting( 'progression_studios_scroll_hvr_color', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_scroll_hvr_color', array(
		'label'    => esc_html__( 'Hover Arrow Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_scroll',
		'priority'   => 30,
		) )
	);

	/* Setting - Footer - Scroll To Top */
	$wp_customize->add_setting( 'progression_studios_scroll_hvr_bg_color', array(
		'default' => '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_scroll_hvr_bg_color', array(
		'default' => '#22b2ee',
		'label'    => esc_html__( 'Hover Arrow Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_scroll',
		'priority'   => 40,
		) )
	);









	/* Panel - Header */
	$wp_customize->add_panel( 'progression_studios_header_panel', array(
		'priority'    => 5,
		'title'       => esc_html__( 'Header', 'vayvo-progression' ),
		)
	);


	/* Section - General - Site Logo */
	$wp_customize->add_section( 'progression_studios_section_logo', array(
		'title'          => esc_html__( 'Logo', 'vayvo-progression' ),
		'panel'          => 'progression_studios_header_panel', // Not typically needed.
		'priority'       => 10,
		)
	);

	/* Setting - General - Site Logo */
	$wp_customize->add_setting( 'progression_studios_theme_logo' ,array(
		'default' => get_template_directory_uri().'/images/logo.png',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_theme_logo', array(
		'section' => 'progression_studios_section_logo',
		'priority'   => 10,
		))
	);


	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_logo_link_override' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_logo_link_override', array(
		'label'    => esc_html__( 'Logo Link Override', 'vayvo-progression' ),
		'description'    => esc_html__( 'Use this to override link when landing page is set as homepage.', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_logo',
		'type' => 'text',
		'priority'   => 12,
		)
	);



	/* Setting - General - Site Logo */
	$wp_customize->add_setting('progression_studios_theme_logo_width',array(
		'default' => '190',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_theme_logo_width', array(
		'label'    => esc_html__( 'Logo Width (px)', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_logo',
		'priority'   => 15,
		'choices'     => array(
			'min'  => 0,
			'max'  => 1200,
			'step' => 1
		), ) )
	);

	/* Setting - General - Site Logo */
	$wp_customize->add_setting('progression_studios_theme_logo_margin_top',array(
		'default' => '24',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_theme_logo_margin_top', array(
		'label'    => esc_html__( 'Logo Margin Top (px)', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_logo',
		'priority'   => 20,
		'choices'     => array(
			'min'  => 0,
			'max'  => 250,
			'step' => 1
		), ) )
	);

	/* Setting - General - Site Logo */
	$wp_customize->add_setting('progression_studios_theme_logo_margin_bottom',array(
		'default' => '25',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_theme_logo_margin_bottom', array(
		'label'    => esc_html__( 'Logo Margin Bottom (px)', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_logo',
		'priority'   => 25,
		'choices'     => array(
			'min'  => 0,
			'max'  => 250,
			'step' => 1
		), ) )
	);



	/* Setting - General - Site Logo */
	$wp_customize->add_setting( 'progression_studios_logo_position' ,array(
		'default' => 'progression-studios-logo-position-left',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_logo_position', array(
		'label'    => esc_html__( 'Logo Position', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_logo',
		'priority'   => 50,
		'choices'     => array(
			'progression-studios-logo-position-left' => esc_html__( 'Left', 'vayvo-progression' ),
			'progression-studios-logo-position-center' => esc_html__( 'Center (Block)', 'vayvo-progression' ),
			'progression-studios-logo-position-right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);



	/* Section - Header - Header Options */
	$wp_customize->add_section( 'progression_studios_section_header_bg', array(
		'title'          => esc_html__( 'Header Options', 'vayvo-progression' ),
		'panel'          => 'progression_studios_header_panel', // Not typically needed.
		'priority'       => 20,
		)
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_width' ,array(
		'default' => 'progression-studios-header-full-width-no-gap',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_header_width', array(
		'label'    => esc_html__( 'Header Layout', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_bg',
		'priority'   => 10,
		'choices'     => array(
			'progression-studios-header-full-width' => esc_html__( 'Full Width', 'vayvo-progression' ),
			'progression-studios-header-full-width-no-gap' => esc_html__( 'No Gap', 'vayvo-progression' ),
			'progression-studios-header-normal-width' => esc_html__( 'Boxed Header', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_force_transparent' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_header_force_transparent', array(
		'label'    => esc_html__( 'Header Overlay', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_bg',
		'priority'   => 12,
		'choices'     => array(
			'true' => esc_html__( 'Overlay', 'vayvo-progression' ),
			'false' => esc_html__( 'Block', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_background_color', array(
		'default' => '#2e0de1',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_header_background_color', array(
		'default' => '#2e0de1',
		'label'    => esc_html__( 'Header Gradient Top Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_header_bg',
		'priority'   => 15,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_background_bottom_color', array(
		'default' => '#6a1eef',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_header_background_bottom_color', array(
		'default' => '#6a1eef',
		'label'    => esc_html__( 'Header Gradient Bottom Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_header_bg',
		'priority'   => 16,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_divider_color', array(
		'default' => 'rgba(255,255,255, 0.1)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_header_divider_color', array(
		'default' => 'rgba(255,255,255, 0.1)',
		'label'    => esc_html__( 'Header Divider Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_header_bg',
		'priority'   => 17,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_box_shadow' ,array(
		'default' => 'block',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_header_box_shadow', array(
		'label'    => esc_html__( 'Header Shadow', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_bg',
		'priority'   => 22,
		'choices'     => array(
			'block' => esc_html__( 'Shadow', 'vayvo-progression' ),
			'none' => esc_html__( 'No Shadow', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_border_color', array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_header_border_color', array(
		'label'    => esc_html__( 'Header Border Bottom', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_header_bg',
		'priority'   => 30,
		))
	);




	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'progression_studios_header_bg_image' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_header_bg_image', array(
		'label'    => esc_html__( 'Header Background Image', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_bg',
		'priority'   => 40,
		))
	);



	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_header_bg_image_image_position' ,array(
		'default' => 'cover',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_header_bg_image_image_position', array(
		'label'    => esc_html__( 'Image Cover', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_bg',
		'priority'   => 50,
		'choices'     => array(
			'cover' => esc_html__( 'Image Cover', 'vayvo-progression' ),
			'repeat-all' => esc_html__( 'Image Pattern', 'vayvo-progression' ),
		),
		))
	);







	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_section( 'progression_studios_section_mobile_header', array(
		'title'          => esc_html__( 'Tablet/Mobile Header Options', 'vayvo-progression' ),
		'panel'          => 'progression_studios_header_panel', // Not typically needed.
		'priority'       => 23,
		)
	);




	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_header_transparent' ,array(
		'default' => 'default',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_mobile_header_transparent', array(
		'label'    => esc_html__( 'Tablet/Mobile Header Transparent', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 9,
		'choices'     => array(
			'transparent' => esc_html__( 'Transparent', 'vayvo-progression' ),
			'default' => esc_html__( 'Default', 'vayvo-progression' ),
		),
		))
	);


	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_header_bg', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_mobile_header_bg', array(
		'label'    => esc_html__( 'Tablet/Mobile Header Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 10,
		))
	);


	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_menu_text' ,array(
		'default' => 'off',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_mobile_menu_text', array(
		'label'    => esc_html__( 'Display "Menu" text for Menu', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 11,
		'choices'     => array(
			'on' => esc_html__( 'Display', 'vayvo-progression' ),
			'off' => esc_html__( 'Hide', 'vayvo-progression' ),
		),
		))
	);



	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_top_bar_left' ,array(
		'default' => 'progression_studios_hide_top_left_bar',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_mobile_top_bar_left', array(
		'label'    => esc_html__( 'Tablet/Mobile Header Top Left', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 12,
		'choices'     => array(
			'on-pro' => esc_html__( 'Display', 'vayvo-progression' ),
			'progression_studios_hide_top_left_bar' => esc_html__( 'Hide', 'vayvo-progression' ),
		),
		))
	);

	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_top_bar_right' ,array(
		'default' => 'progression_studios_hide_top_left_right',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_mobile_top_bar_right', array(
		'label'    => esc_html__( 'Tablet/Mobile Header Top Right', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 13,
		'choices'     => array(
			'on-pro' => esc_html__( 'Display', 'vayvo-progression' ),
			'progression_studios_hide_top_left_right' => esc_html__( 'Hide', 'vayvo-progression' ),
		),
		))
	);




	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_custom_logo_per_page' ,array(
		'default' => 'hide',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_mobile_custom_logo_per_page', array(
		'label'    => esc_html__( 'Override Custom Logo Per Page', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_mobile_header',
		'priority'   => 24,
		'choices'     => array(
			'hide' => esc_html__( 'Hide', 'vayvo-progression' ),
			'display' => esc_html__( 'Display', 'vayvo-progression' ),
		),
		))
	);



	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_header_nav_padding' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_mobile_header_nav_padding', array(
		'label'    => esc_html__( 'Tablet/Mobile Nav Padding', 'vayvo-progression' ),
		'description'    => esc_html__( 'Optional padding above/below the Navigation. Example: 20', 'vayvo-progression' ),
		'section' => 'progression_studios_section_mobile_header',
		'type' => 'text',
		'priority'   => 25,
		)
	);


	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_header_logo_width' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_mobile_header_logo_width', array(
		'label'    => esc_html__( 'Tablet/Mobile Logo Width', 'vayvo-progression' ),
		'description'    => esc_html__( 'Optional logo width. Example: 180', 'vayvo-progression' ),
		'section' => 'progression_studios_section_mobile_header',
		'type' => 'text',
		'priority'   => 30,
		)
	);



	/* Section - Header - Tablet/Mobile Header Options */
	$wp_customize->add_setting( 'progression_studios_mobile_header_logo_margin' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_mobile_header_logo_margin', array(
		'label'    => esc_html__( 'Tablet/Mobile Logo Margin Top/Bottom', 'vayvo-progression' ),
		'description'    => esc_html__( 'Optional logo margin. Example: 25', 'vayvo-progression' ),
		'section' => 'progression_studios_section_mobile_header',
		'type' => 'text',
		'priority'   => 35,
		)
	);






	/* Section - Header - Sticky Header */
	$wp_customize->add_section( 'progression_studios_section_sticky_header', array(
		'title'          => esc_html__( 'Sticky Header Options', 'vayvo-progression' ),
		'panel'          => 'progression_studios_header_panel', // Not typically needed.
		'priority'       => 25,
		)
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_header_sticky' ,array(
		'default' => 'sticky-pro',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_header_sticky', array(
		'section' => 'progression_studios_section_sticky_header',
		'priority'   => 10,
		'choices'     => array(
			'sticky-pro' => esc_html__( 'Sticky Header', 'vayvo-progression' ),
			'none-sticky-pro' => esc_html__( 'Disable Sticky Header', 'vayvo-progression' ),
		),
		))
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_header_background_color', array(
		'default' =>  '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sticky_header_background_color', array(
		'default' =>  '#ffffff',
		'label'    => esc_html__( 'Trasparent Sticky Header Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 15,
		))
	);








	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_logo' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_sticky_logo', array(
		'label'    => esc_html__( 'Sticky Logo', 'vayvo-progression' ),
		'section' => 'progression_studios_section_sticky_header',
		'priority'   => 20,
		))
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting('progression_studios_sticky_logo_width',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sticky_logo_width', array(
		'label'    => esc_html__( 'Sticky Logo Width (px)', 'vayvo-progression' ),
		'description'    => esc_html__( 'Set option to 0 to ignore this field.', 'vayvo-progression' ),

		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 30,
		'choices'     => array(
			'min'  => 0,
			'max'  => 1200,
			'step' => 1
		), ) )
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting('progression_studios_sticky_logo_margin_top',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sticky_logo_margin_top', array(
		'label'    => esc_html__( 'Sticky Logo Margin Top (px)', 'vayvo-progression' ),
		'description'    => esc_html__( 'Set option to 0 to ignore this field.', 'vayvo-progression' ),

		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 40,
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting('progression_studios_sticky_logo_margin_bottom',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sticky_logo_margin_bottom', array(
		'label'    => esc_html__( 'Sticky Logo Margin Bottom (px)', 'vayvo-progression' ),
		'description'    => esc_html__( 'Set option to 0 to ignore this field.', 'vayvo-progression' ),

		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 50,
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);


	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting('progression_studios_sticky_nav_padding',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sticky_nav_padding', array(
		'label'    => esc_html__( 'Sticky Nav Padding Top/Bottom', 'vayvo-progression' ),
		'description'    => esc_html__( 'Set option to 0 to ignore this field.', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 60,
		'choices'     => array(
			'min'  => 0,
			'max'  => 80,
			'step' => 1
		), ) )
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_sticky_header_box_shadow' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_sticky_header_box_shadow', array(
		'label'    => esc_html__( 'Header Shadow', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 65,
		'choices'     => array(
			'true' => esc_html__( 'Shadow', 'vayvo-progression' ),
			'false' => esc_html__( 'No Shadow', 'vayvo-progression' ),
		),
		))
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_nav_font_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sticky_nav_font_color', array(
		'label'    => esc_html__( 'Sticky Nav Font Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 70,
		))
	);


	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_nav_font_color_hover', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sticky_nav_font_color_hover', array(
		'label'    => esc_html__( 'Sticky Nav Font Hover Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 80,
		))
	);


	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_nav_underline', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sticky_nav_underline', array(
		'label'    => esc_html__( 'Sticky Nav Dot', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 95,
		))
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_nav_font_bg', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sticky_nav_font_bg', array(
		'label'    => esc_html__( 'Sticky Nav Background Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 100,
		))
	);

	/* Setting - Header - Sticky Header */
	$wp_customize->add_setting( 'progression_studios_sticky_nav_font_hover_bg', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sticky_nav_font_hover_bg', array(
		'label'    => esc_html__( 'Sticky Nav Hover Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_section_sticky_header',
		'priority'   => 105,
		))
	);




   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_filters_mobile' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_filters_mobile', array(
		'label'    => esc_html__( 'Search Filters on Tablet/Mobile', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 10,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_header_search_columns',array(
		'default' => '4',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_header_search_columns', array(
		'label'    => esc_html__( 'Search Columns', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 20,
		'choices'     => array(
			'min'  => 1,
			'max'  => 5,
			'step' => 1
		), ) )
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_field_genre' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_field_genre', array(
		'label'    => esc_html__( 'Display Genre Field', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 25,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_field_duration' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_field_duration', array(
		'label'    => esc_html__( 'Display Duration Field', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 30,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_field_category' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_field_category', array(
		'label'    => esc_html__( 'Display Category Field', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 35,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_field_director' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_field_director', array(
		'label'    => esc_html__( 'Display Director Field', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 40,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_field_rating' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_field_rating', array(
		'label'    => esc_html__( 'Display Average Rating Field', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 45,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_multiple_genre' ,array(
		'default' => 'single',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_multiple_genre', array(
		'label'    => esc_html__( 'Multiple Genre Choices', 'vayvo-progression' ),
		'description'    => esc_html__( 'Choose if you want to allow single or multiple choices', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 900,
		'choices' => array(
			'single' => esc_html__( 'Single', 'vayvo-progression' ),
			'multiple' => esc_html__( 'Multiple', 'vayvo-progression' ),

		 ),
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_multiple_cat' ,array(
		'default' => 'single',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_multiple_cat', array(
		'label'    => esc_html__( 'Multiple Category Choices', 'vayvo-progression' ),
		'description'    => esc_html__( 'Choose if you want to allow single or multiple choices', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 905,
		'choices' => array(
			'single' => esc_html__( 'Single', 'vayvo-progression' ),
			'multiple' => esc_html__( 'Multiple', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_search_multiple_director' ,array(
		'default' => 'single',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_search_multiple_director', array(
		'label'    => esc_html__( 'Multiple Director Choices', 'vayvo-progression' ),
		'description'    => esc_html__( 'Choose if you want to allow single or multiple choices', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-dashboard-search',
		'priority'   => 905,
		'choices' => array(
			'single' => esc_html__( 'Single', 'vayvo-progression' ),
			'multiple' => esc_html__( 'Multiple', 'vayvo-progression' ),

		 ),
		))
	);






	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_icon_moon' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_icon_moon', array(
		'label'    => esc_html__( 'Enable Iconmoon Icons', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-navigation-font',
		'priority'   => 5,
		'choices'     => array(
			'true' => esc_html__( 'Enable', 'vayvo-progression' ),
			'false' => esc_html__( 'Disable', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_align' ,array(
		'default' => 'progression-studios-nav-left',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_nav_align', array(
		'label'    => esc_html__( 'Navigation Alignment', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-navigation-font',
		'priority'   => 10,
		'choices'     => array(
			'progression-studios-nav-left' => esc_html__( 'Left', 'vayvo-progression' ),
			'progression-studios-nav-center' => esc_html__( 'Center', 'vayvo-progression' ),
			'progression-studios-nav-right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_nav_font_size',array(
		'default' => '15',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_nav_font_size', array(
		'label'    => esc_html__( 'Navigation Font Size', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 500,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_nav_padding',array(
		'default' => '30',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_nav_padding', array(
		'label'    => esc_html__( 'Navigation Padding Top/Bottom', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 505,
		'choices'     => array(
			'min'  => 5,
			'max'  => 100,
			'step' => 1
		), ) )
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_nav_left_right',array(
		'default' => '28',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_nav_left_right', array(
		'label'    => esc_html__( 'Navigation Padding Left/Right', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 510,
		'choices'     => array(
			'min'  => 8,
			'max'  => 80,
			'step' => 1
		), ) )
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_font_color', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_font_color', array(
		'default'	=> '#ffffff',
		'label'    => esc_html__( 'Navigation Font Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 520,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_font_color_hover', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_font_color_hover', array(
		'default'	=> '#ffffff',
		'label'    => esc_html__( 'Navigation Font Hover Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 530,
		))
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_underline', array(
		'default'	=> '#22bfe6',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_underline', array(
		'default'	=> '#22bfe6',
		'label'    => esc_html__( 'Navigation Highlight Top', 'vayvo-progression' ),
		'description'    => esc_html__( 'Remove highlight by clearing the color.', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 535,
		))
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_bg', array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_bg', array(
		'label'    => esc_html__( 'Navigation Item Background', 'vayvo-progression' ),
		'description'    => esc_html__( 'Remove background by clearing the color.', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 536,
		))
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_bg_hover', array(
		'default'	=> 'rgba(14,44,77, 0.25)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_bg_hover', array(
		'default'	=> 'rgba(14,44,77, 0.25)',
		'label'    => esc_html__( 'Navigation Item Background Hover', 'vayvo-progression' ),
		'description'    => esc_html__( 'Remove background by clearing the color.', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 536,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_nav_letterspacing',array(
		'default' => '0.02',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_nav_letterspacing', array(
		'label'          => esc_html__( 'Navigation Letter-Spacing', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-navigation-font',
		'priority'   => 540,
		'choices'     => array(
			'min'  => -1,
			'max'  => 1,
			'step' => 0.01
		), ) )
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_search' ,array(
		'default' => 'on',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_nav_search', array(
		'label'    => esc_html__( 'Search Icon in Navigation', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-navigation-font',
		'priority'   => 600,
		'choices'     => array(
			'on' => esc_html__( 'On', 'vayvo-progression' ),
			'off' => esc_html__( 'Off', 'vayvo-progression' ),
		),
		))
	);





	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_login_font_color', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_login_font_color', array(
		'default'	=> '#ffffff',
		'label'    => esc_html__( 'Login Button Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 660,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_login_brder', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_login_brder', array(
		'default'	=> '#ffffff',
		'label'    => esc_html__( 'Login Button Border', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 665,
		))
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_login_hover_color', array(
		'default'	=> '#22bfe6',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_login_hover_color', array(
		'default'	=> '#22bfe6',
		'label'    => esc_html__( 'Login Button Color Hover', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 690,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_nav_login_hover_border', array(
		'default'	=> '#22bfe6',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_nav_login_hover_border', array(
		'default'	=> '#22bfe6',
		'label'    => esc_html__( 'Login Button Border Hover', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-navigation-font',
		'priority'   => 700,
		))
	);











	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_border_top', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sub_nav_border_top', array(
		'label'    => esc_html__( 'Sub-Navigation Border Top Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 6,
		))
	);




	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_bg', array(
		'default' => '#171425',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sub_nav_bg', array(
		'default' => '#171425',
		'label'    => esc_html__( 'Sub-Navigation Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 10,
		))
	);





	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_sub_nav_font_size',array(
		'default' => '14',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sub_nav_font_size', array(
		'label'    => esc_html__( 'Sub-Navigation Font Size', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 510,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_letterspacing' ,array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_sub_nav_letterspacing', array(
		'label'          => esc_html__( 'Sub-Navigation Letter-Spacing', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 515,
		'choices'     => array(
			'min'  => -1,
			'max'  => 1,
			'step' => 0.01
		), ) )
	);



	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_font_color', array(
		'default'	=> 'rgba(181,187,212,  0.75)',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sub_nav_font_color', array(
		'default'	=> 'rgba(181,187,212,  0.75)',
		'label'    => esc_html__( 'Sub-Navigation Font Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 520,
		))
	);


	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_hover_font_color', array(
		'default'	=> '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sub_nav_hover_font_color', array(
		'default'	=> '#22b2ee',
		'label'    => esc_html__( 'Sub-Navigation Font Hover Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 530,
		))
	);

	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_border_color', array(
		'default' => 'rgba(49,50,61,  0.4)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sub_nav_border_color', array(
		'default' => 'rgba(49,50,61,  0.4)',
		'label'    => esc_html__( 'Sub-Navigation Divider Hover', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 52,
		))
	);


	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_sub_nav_hover_bullet', array(
		'default'	=> '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sub_nav_hover_bullet', array(
		'default'	=> '#22b2ee',
		'label'    => esc_html__( 'Sub-Navigation Hover Bullet', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 550,
		))
	);





	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_sub_nav_bullet_effect' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_sub_nav_bullet_effect', array(
		'label'    => esc_html__( 'Sub-Navigation Hover Effect', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sub-navigation-font',
		'priority'   => 560,
		'choices'     => array(
			'true' => esc_html__( 'Animate', 'vayvo-progression' ),
			'false' => esc_html__( 'No Animation', 'vayvo-progression' ),
		),
		))
	);




	/* Section - General - Site Logo */
	$wp_customize->add_section( 'progression_studios_landing_page', array(
		'title'          => esc_html__( 'Landing Page Options', 'vayvo-progression' ),
		'panel'          => 'progression_studios_header_panel', // Not typically needed.
		'priority'       => 200,
		)
	);



	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_header_bg', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_header_bg', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'label'    => esc_html__( 'Header Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 4,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_align' ,array(
		'default' => 'progression-studios-nav-left',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_landing_nav_align', array(
		'label'    => esc_html__( 'Navigation Alignment', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 6,
		'choices'     => array(
			'progression-studios-nav-left' => esc_html__( 'Left', 'vayvo-progression' ),
			'progression-studios-nav-center' => esc_html__( 'Center', 'vayvo-progression' ),
			'progression-studios-nav-right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_landing_absolute' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_landing_absolute', array(
		'label'    => esc_html__( 'Header Overlay', 'vayvo-progression' ),
		'section' => 'progression_studios_landing_page',
		'priority'   => 9,
		'choices'     => array(
			'true' => esc_html__( 'Overlay', 'vayvo-progression' ),
			'false' => esc_html__( 'Block', 'vayvo-progression' ),
		),
		))
	);



	/* Setting - Header - Sub-Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_header_divider', array(
		'default'	=> 'rgba(255,255,255, 0.12)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_header_divider', array(
		'default'	=> 'rgba(255,255,255, 0.12)',
		'label'    => esc_html__( 'Header Divider Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 15,
		))
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_font_color', array(
		'default'	=> 'rgba(255,255,255, 0.8)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_nav_font_color', array(
		'default'	=> 'rgba(255,255,255, 0.8)',
		'label'    => esc_html__( 'Navigation Font Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 520,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_font_color_hover', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_nav_font_color_hover', array(
		'default'	=> '#ffffff',
		'label'    => esc_html__( 'Navigation Font Hover Color', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 530,
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_underline', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_nav_underline', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'label'    => esc_html__( 'Navigation Highlight Top', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 535,
		))
	);

	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_bg', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_nav_bg', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'label'    => esc_html__( 'Navigation Item Background', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 536,
		))
	);



	/* Setting - Header - Navigation */
	$wp_customize->add_setting( 'progression_studios_landing_nav_bg_hover', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_landing_nav_bg_hover', array(
		'default'	=> 'rgba(255,255,255, 0)',
		'label'    => esc_html__( 'Navigation Item Background Hover', 'vayvo-progression' ),
		'section'  => 'progression_studios_landing_page',
		'priority'   => 536,
		))
	);








	/* Panel - Body */
	$wp_customize->add_panel( 'progression_studios_body_panel', array(
		'priority'    => 8,
        'title'       => esc_html__( 'Body', 'vayvo-progression' ),
    ) );



 	/* Setting - Body - Body Main */
 	$wp_customize->add_setting( 'progression_studios_default_link_color', array(
 		'default'	=> '#22b2ee',
 		'sanitize_callback' => 'sanitize_hex_color',
 	) );
 	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_default_link_color', array(
 		'label'    => esc_html__( 'Default Link Color', 'vayvo-progression' ),
 		'section'  => 'tt_font_progression-studios-body-font',
 		'priority'   => 500,
 		))
 	);


 	/* Setting - Body - Body Main */
 	$wp_customize->add_setting( 'progression_studios_default_link_hover_color', array(
 		'default'	=> '#74d6ff',
 		'sanitize_callback' => 'sanitize_hex_color',
 	) );
 	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_default_link_hover_color', array(
 		'label'    => esc_html__( 'Default Hover Link Color', 'vayvo-progression' ),
 		'section'  => 'tt_font_progression-studios-body-font',
 		'priority'   => 510,
 		))
 	);



	/* Setting - Body - Body Main */
	$wp_customize->add_setting( 'progression_studios_background_color', array(
		'default'	=> '#08070e',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_background_color', array(
		'label'    => esc_html__( 'Body Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-body-font',
		'priority'   => 513,
		))
	);

	/* Setting - Body - Body Main */
	$wp_customize->add_setting( 'progression_studios_body_bg_image' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_body_bg_image', array(
		'label'    => esc_html__( 'Body Background Image', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-body-font',
		'priority'   => 525,
		))
	);

	/* Setting - Body - Body Main */
	$wp_customize->add_setting( 'progression_studios_body_bg_image_image_position' ,array(
		'default' => 'cover',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_body_bg_image_image_position', array(
		'label'    => esc_html__( 'Image Cover', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-body-font',
		'priority'   => 530,
		'choices'     => array(
			'cover' => esc_html__( 'Image Cover', 'vayvo-progression' ),
			'repeat-all' => esc_html__( 'Image Pattern', 'vayvo-progression' ),
		),
		))
	);





	/* Setting - Body - Page Title */
	$wp_customize->add_setting('progression_studios_page_title_padding_top',array(
		'default' => '150',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_page_title_padding_top', array(
		'label'    => esc_html__( 'Page Title Top Padding', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 501,
		'choices'     => array(
			'min'  => 0,
			'max'  => 450,
			'step' => 1
		), ) )
	);

	/* Setting - Body - Page Title */
	$wp_customize->add_setting('progression_studios_page_title_padding_bottom',array(
		'default' => '150',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_page_title_padding_bottom', array(
		'label'    => esc_html__( 'Page Title Bottom Padding', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 515,
		'choices'     => array(
			'min'  => 0,
			'max'  => 450,
			'step' => 1
		), ) )
	);



	/* Setting - General - General Layout */
	$wp_customize->add_setting( 'progression_studios_page_title_align' ,array(
		'default' => 'center',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_page_title_align', array(
		'label'    => esc_html__( 'Page Title Alignment', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 518,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'vayvo-progression' ),
			'center' => esc_html__( 'Center', 'vayvo-progression' ),
			'right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'progression_studios_page_title_bg_image' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_page_title_bg_image', array(
		'label'    => esc_html__( 'Page Title Background Image', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-page-title',
		'priority'   => 535,
		))
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'progression_studios_page_title_image_position' ,array(
		'default' => 'cover',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_page_title_image_position', array(
		'section' => 'tt_font_progression-studios-page-title',
		'priority'   => 536,
		'choices'     => array(
			'cover' => esc_html__( 'Image Cover', 'vayvo-progression' ),
			'repeat-all' => esc_html__( 'Image Pattern', 'vayvo-progression' ),
		),
		))
	);



	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_page_title_bg_color', array(
		'default' => '#303030',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_page_title_bg_color', array(
		'label'    => esc_html__( 'Page Title Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 580,
		))
	);



	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_page_title_overlay_color_top', array(
		'default' => 'rgba(8,7,14,0)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_page_title_overlay_color_top', array(
		'default' => 'rgba(8,7,14,0)',
		'label'    => esc_html__( 'Page Title Gradient Overlay Top', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 600,
		))
	);


	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_page_title_overlay_color', array(
		'default' => '#08070e',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_page_title_overlay_color', array(
		'default' => '#08070e',
		'label'    => esc_html__( 'Page Title Gradient Overlay Bottom', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-page-title',
		'priority'   => 600,
		))
	);




	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_sidebar_header_border', array(
		'default'	=> '#15c562',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_sidebar_header_border', array(
		'default'	=> '#15c562',
		'label'    => esc_html__( 'Sidebar Heading Border Bottom', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-sidebar-headings',
		'priority'   => 628,
		))
	);





	/* Section - Blog - Blog Index Post Options */
   $wp_customize->add_section( 'progression_studios_section_blog_index', array(
   	'title'          => esc_html__( 'Blog Archive Options', 'vayvo-progression' ),
   	'panel'          => 'progression_studios_blog_panel', // Not typically needed.
   	'priority'       => 20,
   )
	);





   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_cat_sidebar' ,array(
		'default' => 'right-sidebar',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_cat_sidebar', array(
		'label'    => esc_html__( 'Archive/Category Sidebar', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 100,
		'choices' => array(
			'left-sidebar' => esc_html__( 'Left', 'vayvo-progression' ),
			'right-sidebar' => esc_html__( 'Right', 'vayvo-progression' ),
			'no-sidebar' => esc_html__( 'Hidden', 'vayvo-progression' ),

		 ),
		))
	);







   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_excerpt_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_excerpt_display', array(
		'label'    => esc_html__( 'Excerpt Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 333,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_meta_hide' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_meta_hide', array(
		'label'    => esc_html__( 'Display Post Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 334,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);





   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_meta_author_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_meta_author_display', array(
		'label'    => esc_html__( 'Author Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 335,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_meta_date_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_meta_date_display', array(
		'label'    => esc_html__( 'Date Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 340,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_index_meta_category_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_index_meta_category_display', array(
		'label'    => esc_html__( 'Category Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 350,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_meta_comment_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_meta_comment_display', array(
		'label'    => esc_html__( 'Comment Count Meta', 'vayvo-progression' ),
		'section' => 'progression_studios_section_blog_index',
		'priority'   => 355,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);





	/* Setting - General - General Layout */
	$wp_customize->add_setting( 'progression_studios_post_page_title_align' ,array(
		'default' => 'center',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_post_page_title_align', array(
		'label'    => esc_html__( 'Post Title Alignment', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 518,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'vayvo-progression' ),
			'center' => esc_html__( 'Center', 'vayvo-progression' ),
			'right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);



	/* Setting - Body - Page Title */
	$wp_customize->add_setting('progression_studios_post_title_padding_top',array(
		'default' => '350',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_post_title_padding_top', array(
		'label'    => esc_html__( 'Post Title Top Padding', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 520,
		'choices'     => array(
			'min'  => 0,
			'max'  => 450,
			'step' => 1
		), ) )
	);

	/* Setting - Body - Page Title */
	$wp_customize->add_setting('progression_studios_post_title_padding_bottom',array(
		'default' => '80',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_post_title_padding_bottom', array(
		'label'    => esc_html__( 'Post Title Bottom Padding', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 530,
		'choices'     => array(
			'min'  => 0,
			'max'  => 450,
			'step' => 1
		), ) )
	);



	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_post_title_overlay_color_top', array(
		'default' => 'rgba(0,0,0,0.1)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_post_title_overlay_color_top', array(
		'default' => 'rgba(0,0,0,0.1)',
		'label'    => esc_html__( 'Post Title Gradient Overlay Top', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 600,
		))
	);


	/* Setting - Body - Page Title */
	$wp_customize->add_setting( 'progression_studios_post_title_overlay_color', array(
		'default' => '#08070e',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_post_title_overlay_color', array(
		'default' => '#08070e',
		'label'    => esc_html__( 'Post Title Gradient Overlay Bottom', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 600,
		))
	);



	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'progression_studios_post_title_bg_image' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_post_title_bg_image', array(
		'label'    => esc_html__( 'Post Title Background Image', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-blog-post-title',
		'priority'   => 665,
		))
	);





   /* Section - Blog - Blog Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_post_sidebar' ,array(
		'default' => 'none',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_sidebar', array(
		'label'    => esc_html__( 'Blog Post Sidebar', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
		'priority'   => 10,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'vayvo-progression' ),
			'right' => esc_html__( 'Right', 'vayvo-progression' ),
			'none' => esc_html__( 'No Sidebar', 'vayvo-progression' ),
		),
		))
	);




   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_post_index_meta_category_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_index_meta_category_display', array(
		'label'    => esc_html__( 'Category Meta', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
		'priority'   => 20,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_post_meta_author_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_meta_author_display', array(
		'label'    => esc_html__( 'Author Meta', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
		'priority'   => 25,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_post_meta_date_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_meta_date_display', array(
		'label'    => esc_html__( 'Date Meta', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
		'priority'   => 30,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_post_meta_comment_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_meta_comment_display', array(
		'label'    => esc_html__( 'Comment Count Meta', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
		'priority'   => 35,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);




   /* Section - Blog - Blog Post Options */
 	$wp_customize->add_setting( 'progression_studios_blog_post_navigation' ,array(
 		'default' => 'on',
 		'sanitize_callback' => 'progression_studios_sanitize_choices',
 	) );
 	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_navigation', array(
 		'label'    => esc_html__( 'Post Next/Previous Navigation', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-post-options',
 		'priority'   => 60,
 		'choices'     => array(
 			'on' => esc_html__( 'Display', 'vayvo-progression' ),
 			'off' => esc_html__( 'Hide', 'vayvo-progression' ),
 		),
 		))
 	);




   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_armember_input_styles' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_armember_input_styles', array(
		'label'    => esc_html__( 'Button/Input Styling', 'vayvo-progression' ),
		'description'    => esc_html__( 'If you would like to use ARMember to control the styles of your forms, check that box.', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 5,
		'choices' => array(
			'true' => esc_html__( 'Default Styles', 'vayvo-progression' ),
			'false' => esc_html__( 'Custom Armember Styling', 'vayvo-progression' ),

		 ),
		))
	);


	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_button_font', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_button_font', array(
		'label'    => esc_html__( 'Button Font Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1635,
		))
	);

	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_button_background', array(
		'default'	=> '#22b2ee',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_button_background', array(
		'label'    => esc_html__( 'Button Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1640,
		))
	);




	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_button_font_hover', array(
		'default'	=> '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_button_font_hover', array(
		'label'    => esc_html__( 'Button Hover Font Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1650,
		))
	);

	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_button_background_hover', array(
		'default'	=> '#0b78a2',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_button_background_hover', array(
		'label'    => esc_html__( 'Button Hover Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1680,
		))
	);



	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_secondary_button_color', array(
		'default'	=> '#4d4d54',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_secondary_button_color', array(
		'label'    => esc_html__( 'Secondary Button Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1685,
		))
	);



	/* Setting - Body - Button Styles */
	$wp_customize->add_setting('progression_studios_button_font_size',array(
		'default' => '14',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_button_font_size', array(
		'label'    => esc_html__( 'Button Font Size', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1700,
		'choices'     => array(
			'min'  => 4,
			'max'  => 30,
			'step' => 1
		), ) )
	);

	/* Setting - Body - Button Styles */
	$wp_customize->add_setting('progression_studios_button_letter_spacing',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_button_letter_spacing', array(
		'label'    => esc_html__( 'Button Letter Spacing', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1710,
		'choices'     => array(
			'min'  => -2,
			'max'  => 2,
			'step' => 0.01
		), ) )
	);


	/* Setting - Body - Button Styles */
	$wp_customize->add_setting('progression_studios_button_bordr_radius',array(
		'default' => '60',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_button_bordr_radius', array(
		'label'    => esc_html__( 'Button Border Radius', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1750,
		'choices'     => array(
			'min'  => 0,
			'max'  => 60,
			'step' => 1
		), ) )
	);

	/* Setting - Body - Button Styles */
	$wp_customize->add_setting('progression_studios_ionput_bordr_radius',array(
		'default' => '0',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_ionput_bordr_radius', array(
		'label'    => esc_html__( 'Input Border Radius', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1750,
		'choices'     => array(
			'min'  => 0,
			'max'  => 30,
			'step' => 1
		), ) )
	);



	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_input_background', array(
		'default'	=> 'rgba(255, 255, 255, 0.07)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_input_background', array(
		'default'	=> 'rgba(255, 255, 255, 0.07)',
		'label'    => esc_html__( 'Form Input Background Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1790,
		))
	);


	/* Setting - Body - Button Styles */
	$wp_customize->add_setting( 'progression_studios_input_border', array(
		'default'	=> 'rgba(255, 255, 255, 0.09)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_input_border', array(
		'default'	=> 'rgba(255, 255, 255, 0.09)',
		'label'    => esc_html__( 'Form Input Border Color', 'vayvo-progression' ),
		'section'  => 'tt_font_progression-studios-button-typography',
		'priority'   => 1790,
		))
	);




	/* Panel - Footer Top LEvel
	$wp_customize->add_panel( 'progression_studios_footer_panel', array(
		'priority'    => 11,
        'title'       => esc_html__( 'Footer', 'vayvo-progression' ),
    )
 	);
	*/


	/* Section - General - General Layout */
	$wp_customize->add_section( 'progression_studios_section_footer_section', array(
		'title'          => esc_html__( 'Footer', 'vayvo-progression' ),
		/* 'panel'          => 'progression_studios_footer_panel',*/  // Not typically needed.
		'priority'       => 11,
		)
	);

	/* Setting - Footer Elementor
	https://gist.github.com/ajskelton/27369df4a529ac38ec83980f244a7227
	*/
	$progression_studios_elementor_library_list =  array(
		'' => 'Choose a template',
	);
	$progression_studios_elementor_args = array('post_type' => 'elementor_library', 'posts_per_page' => 99);
	$progression_studios_elementor_posts = get_posts( $progression_studios_elementor_args );
	foreach($progression_studios_elementor_posts as $progression_studios_elementor_post) {
	    $progression_studios_elementor_library_list[$progression_studios_elementor_post->ID] = $progression_studios_elementor_post->post_title;
	}

	$wp_customize->add_setting( 'progression_studios_footer_elementor_library' ,array(
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( 'progression_studios_footer_elementor_library', array(
	  'type' => 'select',
	  'section' => 'progression_studios_section_footer_section',
	  'priority'   => 5,
	  'label'    => esc_html__( 'Footer Elementor Template', 'vayvo-progression' ),
	  'description'    => esc_html__( 'You can add/edit your footer under ', 'vayvo-progression') . '<a href="' . admin_url() . 'edit.php?post_type=elementor_library">Elementor > Templates</a>',
	  'choices'  => 	   $progression_studios_elementor_library_list,
	) );





	/* Setting - Footer - Footer Main */
 	$wp_customize->add_setting( 'progression_studios_footer_background', array(
 		'default'	=> '#08070e',
 		'sanitize_callback' => 'sanitize_hex_color',
 	) );
 	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_footer_background', array(
 		'label'    => esc_html__( 'Copyright Background', 'vayvo-progression' ),
 		'section' => 'progression_studios_section_footer_section',
 		'priority'   => 501,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
 		))
 	);



	/* Setting - Footer - Copyright */
	$wp_customize->add_setting( 'progression_studios_footer_copyright' ,array(
		'default' =>  'All Rights Reserved. Developed by <strong>Progression Studios</strong>',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control( 'progression_studios_footer_copyright', array(
		'label'          => esc_html__( 'Copyright Text', 'vayvo-progression' ),
 	  'description'    => esc_html__( 'This default text will be replaced if you use a template above.', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'type' => 'textarea',
		'priority'   => 10,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		)
	);

	/* Setting - Footer - Copyright */
	$wp_customize->add_setting( 'progression_studios_copyright_text_color', array(
		'default' => '#8e9099',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_copyright_text_color', array(
		'default' => '#8e9099',
		'label'    => esc_html__( 'Copyright Text Color', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 525,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		))
	);

	/* Setting - Footer - Copyright */
	$wp_customize->add_setting( 'progression_studios_copyright_link', array(
		'default' => '#8e9099',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_copyright_link', array(
		'default' => '#8e9099',
		'label'    => esc_html__( 'Copyright Link Color', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 530,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		))
	);

	/* Setting - Footer - Copyright */
	$wp_customize->add_setting( 'progression_studios_copyright_link_hover', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_copyright_link_hover', array(
		'default' => '#ffffff',
		'label'    => esc_html__( 'Copyright Link Hover Color', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 540,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		))
	);







	/* Setting - Footer - Footer Icons */
	$wp_customize->add_setting( 'progression_studios_footer_copyright_location' ,array(
		'default' => 'footer-copyright-align-center',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_footer_copyright_location', array(
		'label'    => esc_html__( 'Copyright Text Alignment', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 19,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		'choices'     => array(
			'footer-copyright-align-left' => esc_html__( 'Left', 'vayvo-progression' ),
			'footer-copyright-align-center' => esc_html__( 'Center', 'vayvo-progression' ),
			'footer-copyright-align-right' => esc_html__( 'Right', 'vayvo-progression' ),
		),
		))
	);



 	/* Setting - Footer - Footer Widgets */
	$wp_customize->add_setting('progression_studios_copyright_margin_top',array(
		'default' => '40',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_copyright_margin_top', array(
		'label'    => esc_html__( 'Copyright Padding Top', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 20,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);


 	/* Setting - Footer - Footer Widgets */
	$wp_customize->add_setting('progression_studios_copyright_margin_bottom',array(
		'default' => '40',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_copyright_margin_bottom', array(
		'label'    => esc_html__( 'Copyright Padding Bottom', 'vayvo-progression' ),
		'section' => 'progression_studios_section_footer_section',
		'priority'   => 22,
		'active_callback' => function() use ( $wp_customize ) {
		        return '' === $wp_customize->get_setting( 'progression_studios_footer_elementor_library' )->value();
		    },
		'choices'     => array(
			'min'  => 0,
			'max'  => 150,
			'step' => 1
		), ) )
	);






	/* Panel - Video */
	$wp_customize->add_panel( 'progression_studios_videos_panel', array(
		'priority'    => 9,
        'title'       => esc_html__( 'Videos', 'vayvo-progression' ),
    ) );



    /* Section - Blog - Blog Index Post Options */
 	$wp_customize->add_setting( 'progression_studios_blog_pagination' ,array(
 		'default' => 'load-more',
 		'sanitize_callback' => 'progression_studios_sanitize_choices',
 	) );
 	$wp_customize->add_control( 'progression_studios_blog_pagination', array(
 		'label'    => esc_html__( 'Archive Pagination', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
 		'type' => 'select',
 		'priority'   => 3,
 		'choices' => array(
 			'default' => esc_html__( 'Default', 'vayvo-progression' ),
 			'infinite-scroll' => esc_html__( 'Infinite Scroll', 'vayvo-progression' ),
 			'load-more' => esc_html__( 'Load More Button', 'vayvo-progression' ),

 		 ),
 		)
 	);

    /* Section - Blog - Blog Index Post Options */
 	$wp_customize->add_setting('progression_studios_media_posts_page',array(
 		'default' => '12',
 		'sanitize_callback' => 'progression_studios_sanitize_choices',
 	) );
 	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_media_posts_page', array(
 		'label'    => esc_html__( 'Archive Posts Per Page', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
 		'priority'   => 4,
 		'choices'     => array(
 			'min'  => 1,
 			'max'  => 100,
 			'step' => 1
 		), ) )
 	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting('progression_studios_blog_columns',array(
		'default' => '3',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_blog_columns', array(
		'label'    => esc_html__( 'Archive Columns', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 5,
		'choices'     => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1
		), ) )
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting('progression_studios_blog_index_gap',array(
		'default' => '3',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_blog_index_gap', array(
		'label'    => esc_html__( 'Archive Margins', 'vayvo-progression' ),
	'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 8,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1
		), ) )
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_border_hover', array(
		'default' => '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_video_border_hover', array(
		'default' => '#22b2ee',
		'label'    => esc_html__( 'Border Hover Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 800,
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_rating_color', array(
		'default' => 'rgba(255,255,255,0.8)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_video_rating_color', array(
		'default' => 'rgba(255,255,255,0.8)',
		'label'    => esc_html__( 'Rating Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 804,
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_rating_fill_color', array(
		'default' => '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_video_rating_fill_color', array(
		'default' => '#22b2ee',
		'label'    => esc_html__( 'Rating Fill Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 805,
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_overlay_top', array(
		'default' => 'rgba(0,0,0,0)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_video_overlay_top', array(
		'default' => 'rgba(0,0,0,0)',
		'label'    => esc_html__( 'Overlay Top Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 830,
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_overlay_bottom', array(
		'default' => 'rgba(0,0,0,0.95)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_video_overlay_bottom', array(
		'default' => 'rgba(0,0,0,0.95)',
		'label'    => esc_html__( 'Overlay Bottom Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 835,
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_rating_index_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_rating_index_display', array(
		'label'    => esc_html__( 'Rating', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 900,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_genre_index_display' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_genre_index_display', array(
		'label'    => esc_html__( 'Video Genres', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 910,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_category_index_display' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_category_index_display', array(
		'label'    => esc_html__( 'Video Categories', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 910,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_video_type_index_display' ,array(
		'default' => 'false',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_video_type_index_display', array(
		'label'    => esc_html__( 'Video Types', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-index-options',
		'priority'   => 915,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);




   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting('progression_studios_media_header_height',array(
		'default' => '75',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_media_header_height', array(
		'label'    => esc_html__( 'Video Header Height (%)', 'vayvo-progression' ),
	'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 5,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1
		), ) )
	);


   /* Section - Body - Blog Typography */
	$wp_customize->add_setting( 'progression_studios_media_header_color', array(
		'default' => '#303030',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_media_header_color', array(
		'label'    => esc_html__( 'Video Header Background', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 10,
		))
	);


	/* Setting - General - Page Title */
	$wp_customize->add_setting( 'progression_studios_media_header_image' ,array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'progression_studios_media_header_image', array(
		'label'    => esc_html__( 'Video Header Background Image', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 15,
		))
	);



   /* Section - Body - Blog Typography */
	$wp_customize->add_setting( 'progression_studios_sidebar_meta_background', array(
		'default' => '#1e1d26',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_sidebar_meta_background', array(
		'label'    => esc_html__( 'Sidebar Meta Background', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 20,
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_post_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_post_sidebar', array(
		'label'    => esc_html__( 'Sidebar Content', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 800,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_grenre_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_grenre_sidebar', array(
		'label'    => esc_html__( '"Genre" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 802,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);

   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_releases_date_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_releases_date_sidebar', array(
		'label'    => esc_html__( '"Release Date" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 805,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_duration_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_duration_sidebar', array(
		'label'    => esc_html__( '"Duration" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 808,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_director_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_director_sidebar', array(
		'label'    => esc_html__( '"Director" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 808,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_recent_reviews_sidebar' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_recent_reviews_sidebar', array(
		'label'    => esc_html__( '"Recent Reviews" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 810,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_lead_cast' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_lead_cast', array(
		'label'    => esc_html__( '"Lead Cast" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 810,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);



   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_media_more_like_this' ,array(
		'default' => 'true',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_media_more_like_this', array(
		'label'    => esc_html__( '"More Like This" Section', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-video-post-options',
		'priority'   => 825,
		'choices' => array(
			'true' => esc_html__( 'Display', 'vayvo-progression' ),
			'false' => esc_html__( 'Hide', 'vayvo-progression' ),

		 ),
		))
	);









   /* Section - Blog - Blog Post Options */
 	$wp_customize->add_setting( 'progression_studios_blog_post_sharing' ,array(
 		'default' => 'on',
 		'sanitize_callback' => 'progression_studios_sanitize_choices',
 	) );
 	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_blog_post_sharing', array(
 		'label'    => esc_html__( 'Post Sharing', 'vayvo-progression' ),
 		'section' => 'progression_studios_section_blog_post_sharing',
 		'priority'   => 5,
 		'choices'     => array(
 			'on' => esc_html__( 'Display', 'vayvo-progression' ),
 			'off' => esc_html__( 'Hide', 'vayvo-progression' ),
 		),
 		))
 	);



	/* Panel - Body */
	$wp_customize->add_panel( 'progression_studios_blog_panel', array(
		'priority'    => 10,
        'title'       => esc_html__( 'Blog', 'vayvo-progression' ),
    ) );






   /* Section - Body - Blog Typography */
	$wp_customize->add_setting( 'progression_studios_blog_title_link', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_blog_title_link', array(
		'label'    => esc_html__( 'Default Title Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-headings',
		'priority'   => 5,
		))
	);


   /* Section - Body - Blog Typography */
	$wp_customize->add_setting( 'progression_studios_blog_title_link_hover', array(
		'default' => '#22b2ee',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'progression_studios_blog_title_link_hover', array(
		'label'    => esc_html__( 'Default Title Hover Color', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-headings',
		'priority'   => 10,
		))
	);





   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_content_bg', array(
		'default' => 'rgba(255,255,255, 0.06)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_blog_content_bg', array(
		'default' => 'rgba(255,255,255, 0.06)',
		'label'    => esc_html__( 'Content Background', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-headings',
		'priority'   => 15,
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_content_border', array(
		'default' => 'rgba(255,255,255, 0.09)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_blog_content_border', array(
		'default' => 'rgba(255,255,255, 0.09)',
		'label'    => esc_html__( 'Content Border', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-headings',
		'priority'   => 15,
		))
	);


   /* Section - Blog - Blog Index Post Options */
	$wp_customize->add_setting( 'progression_studios_blog_meta_border', array(
		'default' => 'rgba(255,255,255, 0.09)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_blog_meta_border', array(
		'default' => 'rgba(255,255,255, 0.09)',
		'label'    => esc_html__( 'Meta Border Top', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-blog-headings',
		'priority'   => 15,
		))
	);










	/* Setting - General - Page Loader */
	$wp_customize->add_setting( 'progression_studios_icon_position' ,array(
		'default' => 'header-top-hidden',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_icon_position', array(
		'label'    => esc_html__( 'Display Social Icons?', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 2,
		'choices'     => array(
			'default' => esc_html__( 'Nav', 'vayvo-progression' ),
			'header-top-left' => esc_html__( 'Top Left', 'vayvo-progression' ),
			'header-top-right' => esc_html__( 'Top Right', 'vayvo-progression' ),
			'header-top-hidden' => esc_html__( 'Hidden', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_social_icons_margintop',array(
		'default' => '34',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_social_icons_margintop', array(
		'label'    => esc_html__( 'Icon Margin Top', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 3,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1
		), ) )
	);


	/* Setting - Header - Navigation */
	$wp_customize->add_setting('progression_studios_social_icons_font_size',array(
		'default' => '18',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control( new progression_studios_Controls_Slider_Control($wp_customize, 'progression_studios_social_icons_font_size', array(
		'label'    => esc_html__( 'Icon Font Size', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 4,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1
		), ) )
	);



	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_social_icons_color', array(
		'default'	=> '#6c718b',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_social_icons_color', array(
		'default'	=> '#6c718b',
		'label'    => esc_html__( 'Icon Color', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 5,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_social_icons_bg', array(
		'default'	=> 'rgba(255,255,255,  0)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_social_icons_bg', array(
		'default'	=> 'rgba(255,255,255,  0)',
		'label'    => esc_html__( 'Icon Background', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 7,
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_social_icons_hover_color', array(
		'default'	=> '#1b1b1b',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_social_icons_hover_color', array(
		'default'	=> '#1b1b1b',
		'label'    => esc_html__( 'Icon Hover Color', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 8,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_social_icons_hover_bg', array(
		'default'	=> 'rgba(255,255,255,  0)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_social_icons_hover_bg', array(
		'default'	=> 'rgba(255,255,255,  0)',
		'label'    => esc_html__( 'Icon Hover Background', 'vayvo-progression' ),
		'section' => 'progression_studios_section_header_icons_section',
		'priority'   => 9,
		))
	);





	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_related_products' ,array(
		'default' => 'none',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_related_products', array(
		'label'    => esc_html__( 'Related Products', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-shop-styles',
		'priority'   => 10,
		'choices'     => array(
			'block' => esc_html__( 'Show', 'vayvo-progression' ),
			'none' => esc_html__( 'Hide', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_category_count' ,array(
		'default' => 'none',
		'sanitize_callback' => 'progression_studios_sanitize_choices',
	) );
	$wp_customize->add_control(new progression_studios_Controls_Radio_Buttonset_Control($wp_customize, 'progression_studios_category_count', array(
		'label'    => esc_html__( 'Category Index Count', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-shop-styles',
		'priority'   => 10,
		'choices'     => array(
			'block' => esc_html__( 'Show', 'vayvo-progression' ),
			'none' => esc_html__( 'Hide', 'vayvo-progression' ),
		),
		))
	);


	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_shop_post_tab_highlight', array(
		'default'	=> '#22b2ee',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_shop_post_tab_highlight', array(
		'default'	=> '#22b2ee',
		'label'    => esc_html__( 'Shop Post Tab Highlight', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-shop-styles',
		'priority'   => 2500,
		))
	);

	/* Setting - Header - Header Options */
	$wp_customize->add_setting( 'progression_studios_shop_post_base_background', array(
		'default'	=> 'rgba(255,255,255,0.1)',
		'sanitize_callback' => 'progression_studios_sanitize_customizer',
	) );
	$wp_customize->add_control(new Progression_Studios_Revised_Alpha_Color_Control($wp_customize, 'progression_studios_shop_post_base_background', array(
		'default'	=> 'rgba(255,255,255,0.1)',
		'label'    => esc_html__( 'Shop Post Tab Background', 'vayvo-progression' ),
		'section' => 'tt_font_progression-studios-shop-styles',
		'priority'   => 2550,
		))
	);





}
add_action( 'customize_register', 'progression_studios_customizer' );

//HTML Text
function progression_studios_sanitize_customizer( $input ) {
    return wp_kses( $input, TRUE);
}

//no-HTML text
function progression_studios_sanitize_choices( $input ) {
	return wp_filter_nohtml_kses( $input );
}

function progression_studios_customizer_styles() {
	global $post;

	//https://codex.wordpress.org/Function_Reference/wp_add_inline_style
	wp_enqueue_style( 'progression-studios-custom-style', get_template_directory_uri() . '/css/progression_studios_custom_styles.css?_t=70' );

   if ( get_theme_mod( 'progression_studios_header_bg_image')  ) {
      $progression_studios_header_bg_image = "background-image:url(" . esc_attr( get_theme_mod( 'progression_studios_header_bg_image' ) ) . ");";
	}	else {
		$progression_studios_header_bg_image = "";
	}


   if ( get_theme_mod( 'progression_studios_media_header_image')  ) {
      $progression_studios_header_media_bg_image = "background-image:url(" . esc_attr( get_theme_mod( 'progression_studios_media_header_image' ) ) . ");";
	}	else {
		$progression_studios_header_media_bg_image = "";
	}

   if ( get_theme_mod( 'progression_studios_top_header_bg_image')  ) {
      $progression_studios_top_header_bg_image = "background-image:url(" . esc_attr( get_theme_mod( 'progression_studios_top_header_bg_image' ) ) . ");";
	}	else {
		$progression_studios_top_header_bg_image = "";
	}

   if ( get_theme_mod( 'progression_studios_header_bg_image_image_position', 'cover') == 'cover' ) {
      $progression_studios_top_header_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$progression_studios_top_header_bg_cover = "background-repeat:repeat-all; ";
	}


   if ( get_theme_mod( 'progression_studios_sub_nav_border_top') ) {
      $progression_studios_sub_nav_brder_top = "ul#progression-studios-panel-login, #progression-checkout-basket, #panel-search-progression, .sf-menu ul {border-top:3px solid " .  esc_attr( get_theme_mod('progression_studios_sub_nav_border_top') ) . "; }";
	}	else {
		$progression_studios_sub_nav_brder_top = "";
	}

   if ( get_theme_mod( 'progression_studios_top_header_sub_border_top', '#179ef4') ) {
      $progression_studios_top_header_sub_nav_brder_top = "#vayvo-progression-header-top .sf-menu ul {border-top:3px solid " .  esc_attr( get_theme_mod('progression_studios_top_header_sub_border_top', '#00da97') ) . "; }";
	}	else {
		$progression_studios_top_header_sub_nav_brder_top = "";
	}

   if ( get_theme_mod( 'progression_studios_header_bg_image_image_position', 'cover') == 'cover' ) {
      $progression_studios_header_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$progression_studios_header_bg_cover = "background-repeat:repeat-all; ";
	}

   if ( get_theme_mod( 'progression_studios_body_bg_image') ) {
      $progression_studios_body_bg = "background-image:url(" .   esc_attr( get_theme_mod( 'progression_studios_body_bg_image') ). ");";
	}	else {
		$progression_studios_body_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_page_title_bg_image') ) {
      $progression_studios_page_title_bg = "background-image:url(" .   esc_attr( get_theme_mod( 'progression_studios_page_title_bg_image') ). ");";
	}	else {
		$progression_studios_page_title_bg = "";
	}



   if ( get_theme_mod( 'progression_studios_post_title_bg_image') ) {
      $progression_studios_post_title_bg = "background-image:url(" .   esc_attr( get_theme_mod( 'progression_studios_post_title_bg_image') ). ");";
	}	else {
		$progression_studios_post_title_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_body_bg_image_image_position', 'cover') == 'cover') {
      $progression_studios_body_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover; background-attachment: fixed;";
	}	else {
		$progression_studios_body_bg_cover = "background-repeat:repeat-all;";
	}

   if ( get_theme_mod( 'progression_studios_page_title_image_position', 'cover') == 'cover' ) {
      $progression_studios_page_tite_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$progression_studios_page_tite_bg_cover = "background-repeat:repeat-all;";
	}

	if ( get_theme_mod( 'progression_studios_page_title_vertical_height') ) {
      $progression_studios_page_tite_vertical_height = "height:" .   esc_attr( get_theme_mod('progression_studios_page_title_vertical_height', '80') ). "vh;";
	}	else {
		$progression_studios_page_tite_vertical_height = "";
	}


   if ( get_theme_mod( 'progression_studios_post_title_bg_color')  ) {
      $progression_studios_post_tite_bg_color = "background-color: " . esc_attr( get_theme_mod('progression_studios_post_title_bg_color', '#000000') ) . ";";
	}	else {
		$progression_studios_post_tite_bg_color = "";
	}

   if ( get_theme_mod( 'progression_studios_post_page_title_bg_image')  ) {
      $progression_studios_post_tite_bg_image_post = "background-image:url(" .   esc_attr( get_theme_mod( 'progression_studios_post_page_title_bg_image',  get_template_directory_uri().'/images/page-title.jpg' ) ). ");";
	}	else {
		$progression_studios_post_tite_bg_image_post = "";
	}


   if ( get_theme_mod( 'progression_studios_page_post_title_image_position', 'cover') == 'cover' ) {
      $progression_studios_post_tite_bg_cover = "background-repeat: no-repeat; background-position:center center; background-size: cover;";
	}	else {
		$progression_studios_post_tite_bg_cover = "background-repeat:repeat-all;";
	}

   if ( get_theme_mod( 'progression_studios_page_title_overlay_color', '#08070e') ) {
      $progression_studios_page_tite_overlay_image_cover = "#progression-studios-post-page-title:before, #page-title-pro:before {
			background: -moz-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color_top', 'rgba(8,7,14,0)') ) . " 0%, " .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color', '#08070e') ) . " 100%);
			background: -webkit-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color_top', 'rgba(8,7,14,0)') ) . " 0%," .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color', '#08070e') ) . " 100%);
			background: linear-gradient(to bottom, " .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color_top', 'rgba(8,7,14,0)') ) . " 0%, " .  esc_attr( get_theme_mod('progression_studios_page_title_overlay_color', '#08070e') ) . " 100%);
		}";
	}	else {
		$progression_studios_page_tite_overlay_image_cover = "";
	}

   if ( get_theme_mod( 'progression_studios_post_title_overlay_color', '#08070e') ) {
      $progression_studios_post_tite_overlay_image_cover = "body.single-post #page-title-pro:before {
			background: -moz-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color_top', 'rgba(0,0,0,0.1)') ) . " 5%, " .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color', '#08070e') ) . " 100%);
			background: -webkit-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color_top', 'rgba(0,0,0,0.1)') ) . " 5%," .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color', '#08070e') ) . " 100%);
			background: linear-gradient(to bottom, " .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color_top', 'rgba(0,0,0,0.1)') ) . " 5%, " .  esc_attr( get_theme_mod('progression_studios_post_title_overlay_color', '#08070e') ) . " 100%);
		}";
	}	else {
		$progression_studios_post_tite_overlay_image_cover = "";
	}




   if ( get_theme_mod( 'progression_studios_sticky_logo_width', '0') != '0' ) {
      $progression_studios_sticky_logo_width = "width:" .  esc_attr( get_theme_mod('progression_studios_sticky_logo_width', '70') ) . "px;";
	}	else {
		$progression_studios_sticky_logo_width = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_logo_margin_top', '0') != '0' ) {
      $progression_studios_sticky_logo_top = "padding-top:" .  esc_attr( get_theme_mod('progression_studios_sticky_logo_margin_top', '31') ) . "px;";
	}	else {
		$progression_studios_sticky_logo_top = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_logo_margin_bottom', '0') != '0' ) {
      $progression_studios_sticky_logo_bottom = "padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_sticky_logo_margin_bottom', '31') ) . "px;";
	}	else {
		$progression_studios_sticky_logo_bottom = "";
	}


   if ( get_theme_mod( 'progression_studios_sticky_nav_padding', '0') != '0' ) {
      $progression_studios_sticky_nav_padding = "
		.progression-sticky-scrolled .progression-mini-banner-icon {
			top:" . esc_attr( (get_theme_mod('progression_studios_sticky_nav_padding') - get_theme_mod('progression_studios_nav_font_size', '15')) - 4 ). "px;
		}
		#vayvo-landing-login-logout-header,
		#vayvo-header-user-profile-login {
			height:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') + get_theme_mod('progression_studios_sticky_nav_padding') +  get_theme_mod('progression_studios_nav_font_size', '15') ). "px;
		}
		#vayvo-landing-login-logout-header a,
		#vayvo-header-user-profile-login a.arm_form_popup_link {
			margin-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 13 ). "px;
			margin-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 13 ). "px;
		}
		.progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a {
			margin-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 7 ). "px;
			margin-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 8 ). "px;
		}
		.progression-sticky-scrolled #progression-shopping-cart-count span.progression-cart-count { top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') ). "px; }
		.progression-sticky-scrolled #progression-studios-header-login-container a.progresion-studios-login-icon {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 4  ). "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 4 ). "px;
		}
		.progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 4  ). "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 4 ). "px;
		}
		.progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon {
					padding-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 5  ). "px;
					padding-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') - 5 ). "px;
		}
		.progression-sticky-scrolled .sf-menu a {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') ). "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') ). "px;
		}
		#header-user-profile-click {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') ). "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') ). "px;
		}
		#avatar-small-header-vayvo-progression {
			margin-top:-" . esc_attr( get_theme_mod('progression_studios_sticky_nav_padding') -  get_theme_mod('progression_studios_nav_font_size', '15') - 2   ). "px;
		}
		
			";
	}	else {
		$progression_studios_sticky_nav_padding = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_underline') ) {
      $progression_studios_sticky_nav_underline = "
		.progression-sticky-scrolled .sf-menu a:before {
			background:". esc_attr( get_theme_mod('progression_studios_sticky_nav_underline') ). ";
		}
		.progression-sticky-scrolled .sf-menu a:hover:before, .progression-sticky-scrolled .sf-menu li.sfHover a:before, .progression-sticky-scrolled .sf-menu li.current-menu-item a:before {
			opacity:1;
			background:". esc_attr( get_theme_mod('progression_studios_sticky_nav_underline') ). ";
		}
			";
	}	else {
		$progression_studios_sticky_nav_underline = "";
	}

   if (  get_theme_mod( 'progression_studios_sticky_nav_font_color') ) {
      $progression_studios_sticky_nav_option_font_color = "
			body .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a, 
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a, 
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a,
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon, 
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon,
			.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			.progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			.progression-sticky-scrolled .active-mobile-icon-pro .mobile-menu-icon-pro, .progression-sticky-scrolled .mobile-menu-icon-pro,  .progression-sticky-scrolled .mobile-menu-icon-pro:hover,
			.progression-sticky-scrolled  #progression-studios-header-login-container a.progresion-studios-login-icon,
	.progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search,
	.progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a, .progression-sticky-scrolled .sf-menu a {
		color:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_font_color') ) . ";
	}";
	}	else {
		$progression_studios_sticky_nav_option_font_color = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_font_color_hover') ) {
      $progression_studios_optional_sticky_nav_font_hover = "
			body .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a:hover,
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a:hover, 
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a:hover,
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover,
			body .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon:hover,
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover,
			body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon:hover,
			.progression_studios_force_light_navigation_color .progression-sticky-scrolled  #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover,
			.progression_studios_force_light_navigation_color .progression-sticky-scrolled  .activated-class #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
			.progression_studios_force_dark_navigation_color .progression-sticky-scrolled  #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover,
			.progression_studios_force_dark_navigation_color .progression-sticky-scrolled  .activated-class #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
		.progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover,
		.progression-sticky-scrolled .activated-class #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon,
		.progression-sticky-scrolled #progression-studios-header-search-icon:hover .progression-icon-search, .progression-sticky-scrolled #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a:hover, .progression-sticky-scrolled .sf-menu a:hover, .progression-sticky-scrolled .sf-menu li.sfHover a, .progression-sticky-scrolled .sf-menu li.current-menu-item a {
		color:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_font_color_hover') ) . ";
	}";
	}	else {
		$progression_studios_optional_sticky_nav_font_hover = "";
	}

   if ( get_theme_mod( 'progression_studios_nav_bg') ) {
      $progression_studios_optional_nav_bg = "background:" . esc_attr( get_theme_mod('progression_studios_nav_bg') ). ";";
	}	else {
		$progression_studios_optional_nav_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_nav_underline', '#22bfe6') ) {
      $progression_studios_sticky_nav_underline_default = "
		.sf-menu a:before {
			background:" . esc_attr( get_theme_mod('progression_studios_nav_underline', '#22bfe6') ). ";
		}
		.sf-menu a:hover:before, .sf-menu li.sfHover a:before, .sf-menu li.current-menu-item a:before {
			opacity:1;
			background:" . esc_attr( get_theme_mod('progression_studios_nav_underline', '#22bfe6') ). ";
		}
		.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a:before, 
		.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a:hover:before, 
		.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a:before, 
		.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a:before,
	
		.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a:before, 
		.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a:hover:before, 
		.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a:before, 
		.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a:before {
			background:" . esc_attr( get_theme_mod('progression_studios_nav_underline', '#22bfe6') ). ";
		}
			";
	}	else {
		$progression_studios_sticky_nav_underline_default = "";
	}

   if ( get_theme_mod( 'progression_studios_top_header_onoff', 'off-pro') == 'off-pro' ) {
      $progression_studios_top_header_off_on_display = "display:none;";
	}	else {
		$progression_studios_top_header_off_on_display = "";
	}

   if ( get_theme_mod( 'progression_studios_pro_scroll_top', 'scroll-on-pro') == "scroll-off-pro" ) {
      $progression_studios_scroll_top_disable = "display:none !important;";
	}	else {
		$progression_studios_scroll_top_disable = "";
	}


   if ( get_theme_mod( 'progression_studios_nav_bg_hover', 'rgba(14,44,77, 0.25)') ) {
      $progression_studios_optiona_nav_bg_hover = ".sf-menu a:hover, .sf-menu li.sfHover a, .sf-menu li.current-menu-item a { background:".  esc_attr( get_theme_mod('progression_studios_nav_bg_hover', 'rgba(14,44,77, 0.25)') ). "; }";
	}	else {
		$progression_studios_optiona_nav_bg_hover = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_font_bg') ) {
      $progression_studios_optiona_sticky_nav_font_bg = ".progression-sticky-scrolled .sf-menu a { background:".  esc_attr( get_theme_mod('progression_studios_sticky_nav_font_bg') ). "; }";
	}	else {
		$progression_studios_optiona_sticky_nav_font_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_font_hover_bg') ) {
      $progression_studios_optiona_sticky_nav_hover_bg = ".progression-sticky-scrolled .sf-menu a:hover, .progression-sticky-scrolled .sf-menu li.sfHover a, .progression-sticky-scrolled .sf-menu li.current-menu-item a { background:".  esc_attr( get_theme_mod('progression_studios_sticky_nav_font_hover_bg') ). "; }";
	}	else {
		$progression_studios_optiona_sticky_nav_hover_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_font_color') ) {
      $progression_studios_option_sticky_nav_font_color = ".progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container a.progresion-studios-login-icon, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container a.progresion-studios-login-icon, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a {
		color:". esc_attr( get_theme_mod('progression_studios_sticky_nav_font_color') ). ";
	}";
	}	else {
		$progression_studios_option_sticky_nav_font_color = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_font_color_hover') ) {
      $progression_studios_option_stickY_nav_font_hover_color = ".progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon:hover .progression-icon-search, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a:hover,  .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a,
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon:hover .progression-icon-search, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a:hover,  .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a {
		color:" . esc_attr( get_theme_mod('progression_studios_sticky_nav_font_color_hover') ) . ";
	}";
	}	else {
		$progression_studios_option_stickY_nav_font_hover_color = "";
	}




   if ( get_theme_mod( 'progression_studios_sticky_nav_highlight_font') ) {
      $progression_studios_option_sticky_hightlight_font_color = "body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before, body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before, .progression-sticky-scrolled .sf-menu li.sfHover.highlight-button a, .progression-sticky-scrolled .sf-menu li.current-menu-item.highlight-button a, .progression-sticky-scrolled .sf-menu li.highlight-button a, .progression-sticky-scrolled .sf-menu li.highlight-button a:hover { color:".  esc_attr( get_theme_mod('progression_studios_sticky_nav_highlight_font') ). "; }";
	}	else {
		$progression_studios_option_sticky_hightlight_font_color = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_highlight_button') ) {
      $progression_studios_option_sticky_hightlight_bg_color = "body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover, body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover, body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before, body  .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before, .progression-sticky-scrolled .sf-menu li.current-menu-item.highlight-button a:before, .progression-sticky-scrolled .sf-menu li.highlight-button a:before { background:".  esc_attr( get_theme_mod('progression_studios_sticky_nav_highlight_button') ). "; }";
	}	else {
		$progression_studios_option_sticky_hightlight_bg_color = "";
	}

   if ( get_theme_mod( 'progression_studios_sticky_nav_highlight_button_hover') ) {
      $progression_studios_option_sticky_hightlight_bg_color_hover = "body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before,  body .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before,
	body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item.highlight-button a:hover:before, body .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before, .progression-sticky-scrolled .sf-menu li.current-menu-item.highlight-button a:hover:before, .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before { background:".  esc_attr( get_theme_mod('progression_studios_sticky_nav_highlight_button_hover') ). "; }";
	}	else {
		$progression_studios_option_sticky_hightlight_bg_color_hover = "";
	}

   if ( get_theme_mod( 'progression_studios_mobile_header_bg') ) {
      $progression_studios_mobile_header_bg_color = ".progression-studios-transparent-header header#masthead-pro, header#masthead-pro {background:". esc_attr( get_theme_mod('progression_studios_mobile_header_bg') ) . ";  }";
	}	else {
		$progression_studios_mobile_header_bg_color = "";
	}

   if ( get_theme_mod( 'progression_studios_mobile_header_logo_width') ) {
      $progression_studios_mobile_header_logo_width = "body #logo-pro img { width:" . esc_attr( get_theme_mod('progression_studios_mobile_header_logo_width') ). "px; } ";
	}	else {
		$progression_studios_mobile_header_logo_width = "";
	}

   if ( get_theme_mod( 'progression_studios_mobile_header_logo_margin') ) {
      $progression_studios_mobile_header_logo_margin_top = " body #logo-pro img { padding-top:". esc_attr( get_theme_mod('progression_studios_mobile_header_logo_margin') ). "px; padding-bottom:". esc_attr( get_theme_mod('progression_studios_mobile_header_logo_margin') ). "px; }";
	}	else {
		$progression_studios_mobile_header_logo_margin_top = "";
	}


   if ( get_theme_mod( 'progression_studios_header_background_color', '#2e0de1') ) {
      $progression_studios_header_bg_optional = "
		 header#masthead-pro { 
		background: -moz-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_header_background_color', '#2e0de1') ) . " 0%, " .  esc_attr( get_theme_mod('progression_studios_header_background_bottom_color', '#6a1eef') ) . " 100%);
		background: -webkit-linear-gradient(top, " .  esc_attr( get_theme_mod('progression_studios_header_background_color', '#2e0de1') ) . " 0%," .  esc_attr( get_theme_mod('progression_studios_header_background_bottom_color', '#6a1eef') ) . " 100%);
		background: linear-gradient(to bottom, " .  esc_attr( get_theme_mod('progression_studios_header_background_color', '#2e0de1') ) . " 0%, " .  esc_attr( get_theme_mod('progression_studios_header_background_bottom_color', '#6a1eef') ) . " 100%);
		}
		";
	}	else {
		$progression_studios_header_bg_optional = "";
	}



   if ( get_theme_mod( 'progression_studios_header_border_color') ) {
      $progression_studios_header_border_optional = "
		 header#masthead-pro:after { display:block; background-color:" . esc_attr( get_theme_mod('progression_studios_header_border_color') ) . ";
	}";
	}	else {
		$progression_studios_header_border_optional = "";
	}


   if ( get_theme_mod( 'progression_studios_mobile_header_nav_padding') ) {
      $progression_studios_mobile_header_nav_padding_top = "		body header#masthead-pro #progression-shopping-cart-count span.progression-cart-count {top:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding')  ) . "px;}
		body header#masthead-pro .mobile-menu-icon-pro {padding-top:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') - 3 ) . "px; padding-bottom:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') - 5 ) . "px; }
		#header-user-profile-click {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') ). "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') ). "px;
		}
		#avatar-small-header-vayvo-progression {
			margin-top:-" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') -  get_theme_mod('progression_studios_nav_font_size', '15') - 2   ). "px;
		}
		body header#masthead-pro #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') - 5 ) . "px;
			padding-bottom:" . esc_attr( get_theme_mod('progression_studios_mobile_header_nav_padding') - 5 ) . "px;
		}";
	}	else {
		$progression_studios_mobile_header_nav_padding_top = "";
	}


   if (  function_exists('z_taxonomy_image_url') && z_taxonomy_image_url() ) {
      $progression_studios_custom_tax_page_title_img = "body #page-title-overlay-image {background-image:url('" . esc_url( z_taxonomy_image_url() ) . "'); }";
	}	else {
		$progression_studios_custom_tax_page_title_img = "";
	}



   if ( is_page() && get_post_meta($post->ID, 'progression_studios_header_image', true ) ) {
      $progression_studios_custom_page_title_img = "body #page-title-overlay-image {background-image:url('" . esc_url( get_post_meta($post->ID, 'progression_studios_header_image', true)) . "'); }";
	}	else {
		$progression_studios_custom_page_title_img = "";
	}
   if ( class_exists('Woocommerce') ) {
		global $woocommerce;
		$your_shop_page = get_post( wc_get_page_id( 'shop' ) );
		if (

		is_shop() && $your_shop_page || is_singular( 'product') && $your_shop_page  || is_tax( 'product_cat') && $your_shop_page  || is_tax( 'product_tag') && $your_shop_page ) {

			if ( get_post_meta($your_shop_page->ID, 'progression_studios_header_image', true ) ) {
				$progression_studios_woo_page_title = "body #page-title-overlay-image {background-image:url('" .  esc_url( get_post_meta($your_shop_page->ID, 'progression_studios_header_image', true) ). "'); }";
			} else {
		$progression_studios_woo_page_title = "";
		}
		} else {
		$progression_studios_woo_page_title = "";
	}
	}	else {
		$progression_studios_woo_page_title = "";
	}
   if ( get_option( 'page_for_posts' ) ) {
		$cover_page = get_page( get_option( 'page_for_posts' ));
		 if ( is_home() && get_post_meta($cover_page->ID, 'progression_studios_header_image', true) || is_singular( 'post') && get_post_meta($cover_page->ID, 'progression_studios_header_image', true)|| is_category( ) && get_post_meta($cover_page->ID, 'progression_studios_header_image', true) ) {
			$progression_studios_blog_header_img = "body #page-title-overlay-image {background-image:url('" .  esc_url( get_post_meta($cover_page->ID, 'progression_studios_header_image', true) ). "'); }";
		} else {
		$progression_studios_blog_header_img = ""; }
	}	else {
		$progression_studios_blog_header_img = "";
	}


   if ( get_theme_mod( 'progression_studios_header_icon_bg_color') ) {
      $progression_studios_top_header_icon_bg = "background:" . esc_attr( get_theme_mod('progression_studios_header_icon_bg_color') )  . ";";
	}	else {
		$progression_studios_top_header_icon_bg = "";
	}

   if ( get_theme_mod( 'progression_studios_top_header_background', '#666666') ) {
      $progression_studios_top_header_background_option = "background-color:" . esc_attr( get_theme_mod('progression_studios_top_header_background', '#666666') )  . ";";
	}	else {
		$progression_studios_top_header_background_option = "";
	}

   if ( get_theme_mod( 'progression_studios_top_header_border_bottom') ) {
      $progression_studios_top_header_border_bottom_option = "border-bottom:1px solid " . esc_attr( get_theme_mod('progression_studios_top_header_border_bottom', 'rgba(255,255,255, 0.10)') )  . ";";
	}	else {
		$progression_studios_top_header_border_bottom_option = "";
	}




 if ( get_theme_mod( 'progression_studios_site_boxed') == 'boxed-pro' ) {
	 $progression_studios_boxed_layout = "
	 	@media only screen and (min-width: 959px) {
		
		#boxed-layout-pro.progression-studios-preloader {margin-top:90px;}
		#boxed-layout-pro.progression-studios-preloader.progression-preloader-completed {animation-name: ProMoveUpPageLoaderBoxed; animation-delay:200ms;}
 	 	#boxed-layout-pro { margin-top:50px; margin-bottom:50px;}
	 	}
		#boxed-layout-pro #content-pro {
			overflow:hidden;
		}
	 	#boxed-layout-pro {
	 		position:relative;
	 		width:". esc_attr( get_theme_mod('progression_studios_site_width', '1200') ) . "px;
	 		margin-left:auto; margin-right:auto; 
	 		background-color:". esc_attr( get_theme_mod('progression_studios_boxed_background_color', '#ffffff') ) . ";
	 		box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.15);
	 	}
 	#boxed-layout-pro .width-container-pro { width:90%; }
 	
 	@media only screen and (min-width: 960px) and (max-width: ". esc_attr( get_theme_mod('progression_studios_site_width', '1200') + 100 ) . "px) {
		body #boxed-layout-pro{width:92%;}
	}
	
	";
 }	else {
		$progression_studios_boxed_layout = "";
	}

   if ( get_theme_mod( 'progression_studios_armember_input_styles', 'true') == 'true'  ) {
      $progression_studios_armember_form_styles = "
			/* Popup Styles */
			.b-modal {
				background:rgba(0, 0, 0,  0.85) !important;
			}
			.arm_form_inner_container {
				background:transparent !important;
			}
			.arm_setup_form_inner_container .arm_form_wrapper_container .arm_form_heading_container,
			.arm_membership_setup_form h3.arm_setup_form_title,
			.arm_form.arm_form_edit_profile .arm_form_heading_container,
			.arm_form.arm_form_layout_writer .arm_form_heading_container,
			body.page-id-257 .arm_form.arm_form_101 .arm_form_heading_container {
				display:none;
			}
			body .popup_wrapper { border-radius:20px; }
			body .popup_wrapper_inner {
				background:".  esc_attr( get_theme_mod('progression_studios_sub_nav_bg', '#171425') ). ";
				border-color:".  esc_attr( get_theme_mod('progression_studios_sub_nav_bg', '#171425') ). ";
			}
			body .popup_header {	
				border-color:rgba(255,255,255,  0.12);
			}
			.arm_setup_submit_btn_wrapper, .arm_setup_form_container {
			background:transparent !important;
			}
			body .arm_popup_member_form_103 .arm_form_heading_container,
			body .arm_form_103 .arm_form_heading_container,
			body .arm_form_103 .arm_form_heading_container .arm_form_field_label_wrapper_text,
			body .arm_popup_member_form_102 .arm_form_heading_container,
			body .arm_form_102 .arm_form_heading_container,
			body .arm_form_102 .arm_form_heading_container .arm_form_field_label_wrapper_text,
			body .arm_popup_member_form_101 .arm_form_heading_container,
			body .arm_form_101 .arm_form_heading_container,
			body .arm_form_101 .arm_form_heading_container .arm_form_field_label_wrapper_text{
				color: #ffffff;
				font-family: 'Fira Sans Condensed', sans-serif;
				font-size: 24px;
				font-weight: bold;font-style: normal;text-decoration: none;
			}

			body .arm_form_103 .arm_registration_link,
			body .arm_form_103 .arm_forgotpassword_link,
			body body .arm_form_102 .arm_registration_link,
			body .arm_form_102 .arm_forgotpassword_link,
			body .arm_form_101 .arm_registration_link,
			body .arm_form_101 .arm_forgotpassword_link{
				color:#c4c4c5;
				font-family: 'Lato', sans-serif;
				font-size: 15px;
				font-weight: normal;font-style: normal;text-decoration: none;
			}


			body .arm_form_103 .arm_pass_strength_meter,
			body .arm_form_102 .arm_pass_strength_meter,
			body .arm_form_101 .arm_pass_strength_meter{
			    color:#c4c4c5;
				font-family: 'Fira Sans Condensed', sans-serif;
			}

			body .arm_form_103 .arm_registration_link a,
			body .arm_form_103 .arm_forgotpassword_link a{
				color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;
			}
			body .arm_form_102 .arm_registration_link a,
			body .arm_form_102 .arm_forgotpassword_link a,
			body .arm_form_101 .arm_registration_link a,
			body .arm_form_101 .arm_forgotpassword_link a{
				color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;
			}

			body .arm_form_101 .arm_form_field_container .arm_registration_link,
			body .arm_form_101 .arm_form_field_container.arm_registration_link,
			body .arm_form_101 .arm_registration_link{
			    margin: 0px 0px 0px 0px !important;
			}
			body .arm_form_101 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_101 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_101 .arm_forgotpassword_link{
			    margin: 0px 0px 0px 0px !important;                     
			}body .arm_form_101 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_101 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_101 .arm_forgotpassword_link{
			    z-index:2;
			}
			body .arm_form_101 .arm_close_account_message,
			body .arm_form_101 .arm_forgot_password_description {
				color:#c4c4c5;
				font-family: 'Fira Sans Condensed', sans-serif;
				font-size: 16px;
			}
			body .arm_form_101 .arm_form_field_container{
				margin-bottom: 15px !important;
			}
			body .arm_form_101 .arm_form_input_wrapper{
				max-width: 100%;
				width: 62%;
				width: 100%;
			}
			body .arm_form_message_container.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper,
			    body .arm_form_message_container1.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper {
			    border: none !important;
			} 

			body .arm_form_103 .arm_form_field_container .arm_registration_link,
			body .arm_form_103 .arm_form_field_container.arm_registration_link,
			body .arm_form_103 .arm_registration_link,
			body .arm_form_102 .arm_form_field_container .arm_registration_link,
			body .arm_form_102 .arm_form_field_container.arm_registration_link,
			body .arm_form_102 .arm_registration_link{
			    margin: 20px 0px 0px 0px !important;
			}

			body .arm_form_103 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_103 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_103 .arm_forgotpassword_link,
			body .arm_form_102 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_102 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_102 .arm_forgotpassword_link{
			    /*margin: -132px 0px 0px 315px !important;*/
			    margin:0 !important;                     
			}

			body .arm_form_103 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_103 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_103 .arm_forgotpassword_link,
			body .arm_form_102 .arm_form_field_container .arm_forgotpassword_link,
			body .arm_form_102 .arm_form_field_container.arm_forgotpassword_link,
			body .arm_form_102 .arm_forgotpassword_link{
			    z-index:2;
			}

			body .arm_form_103 .arm_close_account_message,
			body .arm_form_103 .arm_forgot_password_description,
			body .arm_form_102 .arm_close_account_message,
			body .arm_form_102 .arm_forgot_password_description {
				color:#c4c4c5;
				font-family: 'Lato', sans-serif;
				font-size: 16px;
			}


			body .arm_form_103 .arm_form_field_container,
			body .arm_form_102 .arm_form_field_container{
				margin-bottom: 15px !important;
			}

			body .arm_form_103 .arm_form_input_wrapper,
			body .arm_form_102 .arm_form_input_wrapper{
				max-width: 100%;
				width: 62%;
				width: 100%;
			}

			body .arm_form_message_container.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper,
			    body .arm_form_message_container1.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper,
			body .arm_form_message_container.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper,
			    .arm_form_message_container1.arm_editor_form_fileds_container.arm_editor_form_fileds_wrapper {
			    border: none !important;
			} 

			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_103,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_102{
				background:  #ffffff !important;
				background-repeat: no-repeat;
				background-position: top left;
			}
					

			body .arm_module_forms_container .arm_form_103,
			body .arm_member_form_container .arm_form_103, body .arm_editor_form_fileds_wrapper,
			body .arm_module_forms_container .arm_form_102,
			body .arm_member_form_container .arm_form_102, body .arm_editor_form_fileds_wrapper{
				background:  #ffffff;
				background-repeat: no-repeat;
				background-position: top left;
				border: 0px solid #dddddd;
				border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px;
				-webkit-border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px;
				-moz-border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px;
				-o-border-radius:" . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px;
			}
			
			
			body .arm_module_forms_container .arm_form_101,
			body .arm_member_form_container .arm_form_101, .arm_editor_form_fileds_wrapper{
				background:  transparent;
				background-repeat: no-repeat;
				background-position: top left;
				border: 0px solid #cccccc;
			}
			
			.page-content-pro .arm_form_103,
			.page-content-pro .arm_form_102,
			.page-content-pro .arm_form_104 {
			background:None !important;
			}
			
	
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_103 .arm_module_forms_container .arm_form_103,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_103 .arm_member_form_container .arm_form_103,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_102 .arm_module_forms_container .arm_form_102,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_102 .arm_member_form_container .arm_form_102,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_101 .arm_module_forms_container .arm_form_101,
			body .popup_wrapper.arm_popup_wrapper.arm_popup_member_form.arm_popup_member_form_101 .arm_member_form_container .arm_form_101{
				background: none !important;
			}


			 body .arm_form_103 md-input-container.md-input-invalid.md-input-focused label,
			body .arm_form_103 md-input-container.md-default-theme:not(.md-input-invalid).md-input-focused label,
			 body .arm_form_103 md-input-container.md-default-theme.md-input-invalid.md-input-focused label,
			body .arm_form_103 md-input-container:not(.md-input-invalid).md-input-focused label,
			body .arm_form_103 .arm_form_field_label_text,
			body .arm_form_103 .arm_member_form_field_label .arm_form_field_label_text,
			                        body  .arm_form_103 .arm_member_form_field_description .arm_form_field_description_text,
			body .arm_form_103 .arm_form_label_wrapper .required_tag,
			body .arm_form_103 .arm_form_input_container label,
			body  .arm_form_103 md-input-container:not(.md-input-invalid) md-select .md-select-value.md-select-placeholder,
			body .arm_form_103 md-input-container:not(.md-input-invalid).md-input-has-value label,
			body .arm_form_102 md-input-container.md-input-invalid.md-input-focused label,
			body .arm_form_102 md-input-container.md-default-theme:not(.md-input-invalid).md-input-focused label,
			body .arm_form_102 md-input-container.md-default-theme.md-input-invalid.md-input-focused label,
			body .arm_form_102 md-input-container:not(.md-input-invalid).md-input-focused label,
			body .arm_form_102 .arm_form_field_label_text,
			body .arm_form_102 .arm_member_form_field_label .arm_form_field_label_text,
			body .arm_form_102 .arm_member_form_field_description .arm_form_field_description_text,
			body .arm_form_102 .arm_form_label_wrapper .required_tag,
			body .arm_form_102 .arm_form_input_container label,
			body .arm_form_102 md-input-container:not(.md-input-invalid) md-select .md-select-value.md-select-placeholder,
			body .arm_form_102 md-input-container:not(.md-input-invalid).md-input-has-value label,
			body  .arm_form_101 md-input-container.md-input-invalid.md-input-focused label,
			body .arm_form_101 md-input-container.md-default-theme:not(.md-input-invalid).md-input-focused label,
			body .arm_form_101 md-input-container.md-default-theme.md-input-invalid.md-input-focused label,
			body .arm_form_101 md-input-container:not(.md-input-invalid).md-input-focused label,
			body .arm_form_101 .arm_form_field_label_text,
			body .arm_form_101 .arm_member_form_field_label .arm_form_field_label_text,
			body .arm_form_101 .arm_member_form_field_description .arm_form_field_description_text,
			body .arm_form_101 .arm_form_label_wrapper .required_tag,
			body .arm_form_101 .arm_form_input_container label,
			body .arm_form_101 md-input-container:not(.md-input-invalid) md-select .md-select-value.md-select-placeholder,
			body .arm_form_101 md-input-container:not(.md-input-invalid).md-input-has-value label
			                         {
				color:#c4c4c5;
				font-family: 'Lato', sans-serif;
				font-size: 15px;
				cursor: pointer;
				margin: 0px !important;
				line-height : 27px;
				font-weight: normal;font-style: normal;text-decoration: none;
			}

			body  .arm_form_103 .arm_member_form_field_description .arm_form_field_description_text,
			body .arm_form_102 .arm_member_form_field_description .arm_form_field_description_text,
			body .arm_form_101 .arm_member_form_field_description .arm_form_field_description_text
			    { 
					font-size: 15px; 
			        line-height: 15px; 
			}

			body md-select-menu.md-default-theme md-content md-option:not([disabled]):focus, body md-select-menu md-content md-option:not([disabled]):focus, body md-select-menu.md-default-theme md-content md-option:not([disabled]):hover, body md-select-menu md-content md-option:not([disabled]):hover,
			body md-select-menu.md-default-theme md-content md-option:not([disabled]):focus, body md-select-menu md-content md-option:not([disabled]):focus, body md-select-menu.md-default-theme md-content md-option:not([disabled]):hover, body md-select-menu md-content md-option:not([disabled]):hover,
			body md-select-menu.md-default-theme md-content md-option:not([disabled]):focus, body md-select-menu md-content md-option:not([disabled]):focus, body md-select-menu.md-default-theme md-content md-option:not([disabled]):hover, body md-select-menu md-content md-option:not([disabled]):hover {
			    background-color :" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " ;
			    color : " . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . ";
			}

			body  .armSelectOption103,
			body .armSelectOption102,
			body .armSelectOption101{
				font-family: 'Fira Sans Condensed', sans-serif;
				font-size: 15px;
				font-weight: normal;font-style: normal;text-decoration: none;
			}


			body .arm_form_102 .arm_form_input_container.arm_form_input_container_section,
			body .arm_form_101 .arm_form_input_container.arm_form_input_container_section{
				color:#c4c4c5;
			    font-family: 'Fira Sans Condensed', sans-serif;
			}

			body .arm_form_103 .arm_form_input_container.arm_form_input_container_section,
			body .arm_form_102 md-radio-button, .arm_form_102 md-checkbox,
			body .arm_form_101 md-radio-button, .arm_form_101 md-checkbox{
				color:#919191;
				font-family: 'Lato', sans-serif;
				font-size: 15px;
				cursor: pointer;
				font-weight: normal;font-style: normal;text-decoration: none;
			}
			body .arm_form_103 md-radio-button, body .arm_form_103 md-checkbox{
				color:#919191;
				font-family: 'Lato', sans-serif;
				font-size: 15px;
				cursor: pointer;
				font-weight: normal;font-style: normal;text-decoration: none;
			}

			body md-select-menu.md-default-theme md-option.armSelectOption103[selected],
			body md-select-menu md-option.armSelectOption103[selected],
			body md-select-menu.md-default-theme md-option.armSelectOption102[selected],
			body md-select-menu md-option.armSelectOption102[selected],
			body md-select-menu.md-default-theme md-option.armSelectOption101[selected],
			body md-select-menu md-option.armSelectOption101[selected]{
				font-weight: bold;
				color:#242424;
			}

			body  .arm_form_103 .arm_form_input_container input,
			body .arm_form_102 .arm_apply_coupon_container .arm_coupon_submit_wrapper .arm_apply_coupon_btn,
			body .arm_form_102 .arm_form_input_container input,
			body .arm_form_101 .arm_form_input_container input{
			    height: 36px;
			}

			body  .arm_form_103 .arm_apply_coupon_container .arm_coupon_submit_wrapper .arm_apply_coupon_btn,
			body .arm_form_101 .arm_apply_coupon_container .arm_coupon_submit_wrapper .arm_apply_coupon_btn{
			    min-height: 38px;
			    margin: 0;
			}


			body .arm_form_104 .arm_form_input_container input,
			body .arm_form_104 .arm_form_input_container textarea,
			body .arm_form_103 .arm_form_input_container input,
			body .arm_form_103 .arm_form_input_container textarea,
			body .arm_form_103 .arm_form_input_container select,
			body .arm_form_103 .arm_form_input_container md-select md-select-value,
			body .arm_form_102 .arm_form_input_container input,
			body .arm_form_102 .arm_form_input_container textarea,
			body .arm_form_102 .arm_form_input_container select,
			body .arm_form_102 .arm_form_input_container md-select md-select-value,
			body .arm_form_101 .arm_form_input_container input,
			body .arm_form_101 .arm_form_input_container textarea,
			body .arm_form_101 .arm_form_input_container select,
			body .arm_form_101 .arm_form_input_container md-select md-select-value{
			    background-color: " . esc_attr( get_theme_mod('progression_studios_input_background', 'rgba(255, 255, 255, 0.07)') ) . " !important;
				border: 1px solid " . esc_attr( get_theme_mod('progression_studios_input_border', 'rgba(255, 255, 255, 0.09)') ) . ";
				border-color: " . esc_attr( get_theme_mod('progression_studios_input_border', 'rgba(255, 255, 255, 0.09)') ) . ";
				border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px !important;
				-webkit-border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px !important;
				-moz-border-radius:" . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px !important;
				-o-border-radius: " . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px !important;
				color:#ffffff !important;
				font-family: 'Lato', sans-serif;
				font-size: 15px;
				font-weight: normal;font-style: normal;text-decoration: none;
				height: 36px;
			}




			body .arm_form_103 .armFileUploadWrapper .armFileDragArea,
			body .arm_form_102 .armFileUploadWrapper .armFileDragArea,
			body .arm_form_101 .armFileUploadWrapper .armFileDragArea{
				border-color: #dddddd;
			}

			body .arm_form_103 .armFileUploadWrapper .armFileDragArea.arm_dragover,
			body .arm_form_102 .armFileUploadWrapper .armFileDragArea.arm_dragover,
			body .arm_form_101 .armFileUploadWrapper .armFileDragArea.arm_dragover{
				border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
			}

			body .arm_form_103 md-checkbox.md-default-theme.md-checked .md-ink-ripple,
			body .arm_form_103 md-checkbox.md-checked .md-ink-ripple,
			body .arm_form_102 md-checkbox.md-default-theme.md-checked .md-ink-ripple,
			body .arm_form_102 md-checkbox.md-checked .md-ink-ripple,
			body .arm_form_101 md-checkbox.md-default-theme.md-checked .md-ink-ripple,
			body .arm_form_101 md-checkbox.md-checked .md-ink-ripple{
				color: rgba(199, 199, 199, 0.87);
			}

			body .arm_form_103 md-radio-button.md-default-theme.md-checked .md-off,
			body .arm_form_103 md-radio-button.md-default-theme .md-off,
			body .arm_form_103 md-radio-button.md-checked .md-off,
			body .arm_form_103 md-radio-button .md-off,
			body .arm_form_103 md-checkbox.md-default-theme .md-icon, 
			body .arm_form_103 md-checkbox .md-icon,
			body .arm_form_102 md-radio-button.md-default-theme.md-checked .md-off,
			body .arm_form_102 md-radio-button.md-default-theme .md-off,
			body .arm_form_102 md-radio-button.md-checked .md-off,
			body .arm_form_102 md-radio-button .md-off,
			body .arm_form_102 md-checkbox.md-default-theme .md-icon, 
			body .arm_form_102 md-checkbox .md-icon,
			body .arm_form_101 md-radio-button.md-default-theme.md-checked .md-off,
			body .arm_form_101 md-radio-button.md-default-theme .md-off,
			body .arm_form_101 md-radio-button.md-checked .md-off,
			body .arm_form_101 md-radio-button .md-off,
			body .arm_form_101 md-checkbox.md-default-theme .md-icon, 
			body .arm_form_101 md-checkbox .md-icon{
				border-color: #dddddd;
			}

			body .arm_form_103 md-radio-button.md-default-theme .md-on,
			body .arm_form_103 md-radio-button .md-on,
			body .arm_form_103 md-checkbox.md-default-theme.md-checked .md-icon,
			body .arm_form_103 md-checkbox.md-checked .md-icon,
			body .arm_form_102 md-radio-button.md-default-theme .md-on,
			body .arm_form_102 md-radio-button .md-on,
			body .arm_form_102 md-checkbox.md-default-theme.md-checked .md-icon,
			body .arm_form_102 md-checkbox.md-checked .md-icon,
			body .arm_form_101 md-radio-button.md-default-theme .md-on,
			body .arm_form_101 md-radio-button .md-on,
			body .arm_form_101 md-checkbox.md-default-theme.md-checked .md-icon,
			body .arm_form_101 md-checkbox.md-checked .md-icon{
				background-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
			}

			body md-option.armSelectOption103 .md-ripple.md-ripple-placed,
			body md-option.armSelectOption103 .md-ripple.md-ripple-scaled,
			body .arm_form_103 .md-ripple.md-ripple-placed,
			body .arm_form_103 .md-ripple.md-ripple-scaled,
			body md-option.armSelectOption102 .md-ripple.md-ripple-placed,
			body md-option.armSelectOption102 .md-ripple.md-ripple-scaled,
			body .arm_form_102 .md-ripple.md-ripple-placed,
			body .arm_form_102 .md-ripple.md-ripple-scaled
			body md-option.armSelectOption101 .md-ripple.md-ripple-placed,
			body md-option.armSelectOption101 .md-ripple.md-ripple-scaled,
			body .arm_form_101 .md-ripple.md-ripple-placed,
			body .arm_form_101 .md-ripple.md-ripple-scaled{
				background-color: rgba(67, 175, 67, 0.87) !important;
			}

			body body .arm_form_103 .md-button .md-ripple.md-ripple-placed,
			body .arm_form_103 .md-button .md-ripple.md-ripple-scaled,
			body .arm_form_102 .md-button .md-ripple.md-ripple-placed,
			body .arm_form_102 .md-button .md-ripple.md-ripple-scaled,
			body .arm_form_101 .md-button .md-ripple.md-ripple-placed,
			body .arm_form_101 .md-button .md-ripple.md-ripple-scaled{
				background-color: rgb(255, 255, 255) !important;
			}

			body .arm_form_103 md-checkbox.md-focused:not([disabled]):not(.md-checked) .md-container:before,
			body .arm_form_102 md-checkbox.md-focused:not([disabled]):not(.md-checked) .md-container:before,
			body .arm_form_101 md-checkbox.md-focused:not([disabled]):not(.md-checked) .md-container:before{
				background-color: rgba(67, 175, 67, 0.12) !important;
			}

			body .arm_form_103 md-radio-group.md-default-theme.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_103 md-radio-group.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_103 md-checkbox.md-default-theme.md-checked.md-focused .md-container:before,
			body body .arm_form_103 md-checkbox.md-checked.md-focused .md-container:before,
			body .arm_form_102 md-radio-group.md-default-theme.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_102 md-radio-group.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_102 md-checkbox.md-default-theme.md-checked.md-focused .md-container:before,
			body .arm_form_102 md-checkbox.md-checked.md-focused .md-container:before,
			body .arm_form_101 md-radio-group.md-default-theme.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_101 md-radio-group.md-focused:not(:empty) .md-checked .md-container:before,
			body .arm_form_101 md-checkbox.md-default-theme.md-checked.md-focused .md-container:before,
			body .arm_form_101 md-checkbox.md-checked.md-focused .md-container:before{
				background-color: rgba(67, 175, 67, 0.26) !important;
			}

			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .select-wrapper input.select-dropdown,
			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .file-field input.file-path,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .select-wrapper input.select-dropdown,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .file-field input.file-path,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .select-wrapper input.select-dropdown,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .file-field input.file-path{
				border-color: #dddddd;
				border-width: 0 0 1px 0 !important;
			}



			body .arm_form_103 .arm_form_message_container .arm_success_msg,
			body .arm_form_103 .arm_form_message_container .arm_error_msg,
			                        body body .arm_form_103 .arm_form_message_container1 .arm_success_msg,
			                        body .arm_form_103 .arm_form_message_container1 .arm_success_msg1,
			body .arm_form_103 .arm_form_message_container1 .arm_error_msg,
			                            body .arm_form_103 .arm_form_message_container .arm_success_msg a,
			body .arm_form_102 .arm_form_message_container .arm_success_msg,
			body .arm_form_102 .arm_form_message_container .arm_error_msg,
			                        body .arm_form_102 .arm_form_message_container1 .arm_success_msg,
			                        body .arm_form_102 .arm_form_message_container1 .arm_success_msg1,
			body .arm_form_102 .arm_form_message_container1 .arm_error_msg,
			                            body .arm_form_102 .arm_form_message_container .arm_success_msg a,
			body .arm_form_101 .arm_form_message_container .arm_success_msg,
			body .arm_form_101 .arm_form_message_container .arm_error_msg,
			                        body .arm_form_101 .arm_form_message_container1 .arm_success_msg,
			                       body  .arm_form_101 .arm_form_message_container1 .arm_success_msg1,
			body .arm_form_101 .arm_form_message_container1 .arm_error_msg,
			                            body .arm_form_101 .arm_form_message_container .arm_success_msg a{
									 				font-family: 'Lato', sans-serif;
				
			    text-decoration: none !important;
			}

			body .arm_form_103 .arm_coupon_field_wrapper .success.notify_msg,
			body .arm_form_102 .arm_coupon_field_wrapper .success.notify_msg,
			body .arm_form_101 .arm_coupon_field_wrapper .success.notify_msg{
			    font-family: Lato, sans-serif,'Trebuchet asf';
			    text-decoration: none !important;
			}

			body .arm_form_103 md-select.md-default-theme.ng-invalid.ng-dirty .md-select-value,
			body .arm_form_103 md-select.ng-invalid.ng-dirty .md-select-value,
			body .arm_form_102 md-select.md-default-theme.ng-invalid.ng-dirty .md-select-value,
			body .arm_form_102 md-select.ng-invalid.ng-dirty .md-select-value,
			body .arm_form_101 md-select.md-default-theme.ng-invalid.ng-dirty .md-select-value,
			body .arm_form_101 md-select.ng-invalid.ng-dirty .md-select-value{
				color: #242424 !important;
				border-color: #f05050 !important;
			}

			body .arm_form_103 .arm_uploaded_file_info .armbar,
			body .arm_form_102 .arm_uploaded_file_info .armbar,
			body .arm_form_101 .arm_uploaded_file_info .armbar{
				background-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
			}
			
			body .arm_form_104 .arm_form_input_container input:focus,
			body .arm_form_104 .arm_form_input_container textarea:focus,
			body .arm_form_103 .arm_form_input_container input:focus,
			body .arm_form_103 .arm_form_input_container textarea:focus,
			body .arm_form_103 .arm_form_input_container select:focus,
			body .arm_form_103 .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_103 .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_102 .arm_form_input_container input:focus,
			body .arm_form_102 .arm_form_input_container textarea:focus,
			body .arm_form_102 .arm_form_input_container select:focus,
			body .arm_form_102 .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_102 .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_101 .arm_form_input_container input:focus,
			body .arm_form_101 .arm_form_input_container textarea:focus,
			body .arm_form_101 .arm_form_input_container select:focus,
			body .arm_form_101 .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_101 .arm_form_input_container md-select[aria-expanded='true'] + md-select-value{
			    color: #242424;
				border: 1px solid " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
				border-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
			}

			body .arm_form_103 .arm_form_input_box.arm_error_msg,
			body .arm_form_103 .arm_form_input_box.arm_invalid,
			body .arm_form_103 .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_103 md-input-container .md-input.ng-invalid:not(.ng-untouched),
			body .arm_form_102 .arm_form_input_box.arm_error_msg,
			body .arm_form_102 .arm_form_input_box.arm_invalid,
			body .arm_form_102 .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_102 md-input-container .md-input.ng-invalid:not(.ng-untouched),
			body .arm_form_101 .arm_form_input_box.arm_error_msg,
			body .arm_form_101 .arm_form_input_box.arm_invalid,
			body .arm_form_101 .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_101 md-input-container .md-input.ng-invalid:not(.ng-untouched){
				border: 1px solid #f05050;
				border-color: #f05050 !important;
			}

			body .arm_form_103.arm_form_layout_writer .arm_form_input_container textarea,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container textarea,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container textarea{
			    -webkit-transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
			    -moz-transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
				transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
				background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 99.1%, #c7c7c7 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 99.1%, #c7c7c7 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 0 100%;
				max-height:150px;
			}

			body .arm_form_103.arm_form_layout_writer .arm_form_input_container input,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container select,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container md-select md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container input,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container select,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container md-select md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container input,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container select,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container md-select md-select-value{
				-webkit-transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
				transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
				background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, #c7c7c7 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #c7c7c7 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 0 100%;
			}

			body .arm_form_103.arm_form_layout_writer .arm_form_input_container input:focus,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container select:focus,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container input:focus,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container select:focus,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container input:focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container select:focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container md-select[aria-expanded='true'] + md-select-value{
				background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 100% 100%;
			}

			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_103 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched),
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_102 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched),
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched) md-select-value,
			body .arm_form_101 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched){
				border: 1px solid #dddddd;
				border-color: #dddddd !important;
			}

			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_103 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_container textarea:focus,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_103 .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_102 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_container textarea:focus,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_102 .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_101 .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_container textarea:focus,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_101 .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value{
				border: 1px solid " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
				border-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;
			}

			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid:focus,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_103.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid:focus,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.arm_invalid:focus,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container input:focus,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container select:focus,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select:focus md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_editor_form_fileds_container .arm_form_input_container md-select[aria-expanded='true'] + md-select-value{
			    background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 100% 100%;
			    border-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;
			}

			body .arm_form_103.arm_form_layout_writer textarea.arm_form_input_box.arm_error_msg:focus,
			body .arm_form_103.arm_form_layout_writer textarea.arm_form_input_box.arm_invalid:focus,
			body .arm_form_103.arm_form_layout_writer textarea.arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container_textarea md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_container textarea:focus,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container textarea:focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container textarea:focus{
			    background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 99.1%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 99.1%, " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 100% 100%;
			}

			body .arm_form_103.arm_form_layout_writer .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_box.arm_invalid:focus,
			body .arm_form_103.arm_form_layout_writer .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_103.arm_form_layout_writer md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_102.arm_form_layout_writer textarea.arm_form_input_box.arm_error_msg:focus,
			body .arm_form_102.arm_form_layout_writer textarea.arm_form_input_box.arm_invalid:focus,
			body .arm_form_102.arm_form_layout_writer textarea.arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_container_textarea md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_101.arm_form_layout_writer textarea.arm_form_input_box.arm_error_msg:focus,
			body .arm_form_101.arm_form_layout_writer textarea.arm_form_input_box.arm_invalid:focus,
			body .arm_form_101.arm_form_layout_writer textarea.arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_container_textarea md-input-container .md-input.ng-invalid:not(.ng-untouched):focus{
			    background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 99.1%, #f05050 4%);
			    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 99.1%, #f05050 4%);
			    background-repeat: no-repeat;
			    background-position: 0 0;
			    background-size: 100% 100%;
			}

			body .arm_form_102.arm_form_layout_writer .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_box.arm_invalid:focus,
			body .arm_form_102.arm_form_layout_writer .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_102.arm_form_layout_writer md-input-container .md-input.ng-invalid:not(.ng-untouched):focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_box.arm_error_msg:focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_box.arm_invalid:focus,
			body .arm_form_101.arm_form_layout_writer .arm_form_input_box.ng-invalid:not(.ng-untouched):focus md-select-value,
			body .arm_form_101.arm_form_layout_writer md-input-container .md-input.ng-invalid:not(.ng-untouched):focus{
				background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 96%, #f05050 4%);
				background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #f05050 4%);
				background-repeat: no-repeat;
				background-position: 0 0;
				background-size: 100% 100%;
			}

			body .arm_form_103.arm_form_layout_iconic .arm_error_msg_box .arm_error_msg,
			body .arm_form_103.arm_form_layout_rounded .arm_error_msg_box .arm_error_msg,
			body .arm_form_103 .arm_error_msg_box .arm_error_msg,
			body .arm_form_102.arm_form_layout_iconic .arm_error_msg_box .arm_error_msg,
			body .arm_form_102.arm_form_layout_rounded .arm_error_msg_box .arm_error_msg,
			body .arm_form_102 .arm_error_msg_box .arm_error_msg,
			body .arm_form_101.arm_form_layout_iconic .arm_error_msg_box .arm_error_msg,
			body .arm_form_101.arm_form_layout_rounded .arm_error_msg_box .arm_error_msg,
			body .arm_form_101 .arm_error_msg_box .arm_error_msg{
				color: #ffffff;
				background: #e6594d;
			    font-family: 'Lato', sans-serif;
			    font-size: 15px;
				padding-left: 5px;
				padding-right: 5px;
			    text-decoration: none !important;
			}

			body .arm_form_103 .arm_msg_pos_right .arm_error_msg_box .arm_error_box_arrow:after{border-right-color: #e6594d !important;} 
			body .arm_form_103 .arm_msg_pos_left .arm_error_msg_box .arm_error_box_arrow:after{border-left-color: #e6594d !important;}
			body .arm_form_103 .arm_msg_pos_top .arm_error_msg_box .arm_error_box_arrow:after{border-top-color: #e6594d !important;}
			body .arm_form_103 .arm_msg_pos_bottom .arm_error_msg_box .arm_error_box_arrow:after{border-bottom-color: #e6594d !important;}
			body .arm_form_103 .arm_writer_error_msg_box{
				color: #ffffff;
				font-size: 15px;
				font-size: " . esc_attr( get_theme_mod('progression_studios_button_font_size', '13') + 1 ) . "px;
			}

			body .arm_form_102 .arm_msg_pos_right .arm_error_msg_box .arm_error_box_arrow:after{border-right-color: #e6594d !important;} 
			body .arm_form_102 .arm_msg_pos_left .arm_error_msg_box .arm_error_box_arrow:after{border-left-color: #e6594d !important;}
			body .arm_form_102 .arm_msg_pos_top .arm_error_msg_box .arm_error_box_arrow:after{border-top-color: #e6594d !important;}
			body .arm_form_102 .arm_msg_pos_bottom .arm_error_msg_box .arm_error_box_arrow:after{border-bottom-color: #e6594d !important;}
			body .arm_form_102 .arm_writer_error_msg_box,
			body .arm_form_101 .arm_msg_pos_right .arm_error_msg_box .arm_error_box_arrow:after{border-right-color: #e6594d !important;} 
			body .arm_form_101 .arm_msg_pos_left .arm_error_msg_box .arm_error_box_arrow:after{border-left-color: #e6594d !important;}
			body .arm_form_101 .arm_msg_pos_top .arm_error_msg_box .arm_error_box_arrow:after{border-top-color: #e6594d !important;}
			body .arm_form_101 .arm_msg_pos_bottom .arm_error_msg_box .arm_error_box_arrow:after{border-bottom-color: #e6594d !important;}
			body .arm_form_101 .arm_writer_error_msg_box{
				color: #ffffff;
				font-size: " . esc_attr( get_theme_mod('progression_studios_button_font_size', '13') + 1 ) . "px;
			}

			body .arm_form_103 .arm_form_field_submit_button.md-button .md-ripple-container,
			body .arm_form_102 .arm_form_field_submit_button.md-button .md-ripple-container,
			body .arm_form_101 .arm_form_field_submit_button.md-button .md-ripple-container{
				border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-webkit-border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-moz-border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-o-border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
			}

			/* Button */
			body .arm_form_103 .arm_form_field_submit_button.md-button,
			body .arm_form_103 .arm_form_field_submit_button,
			body .arm_form_102 .arm_form_field_submit_button.md-button,
			body .arm_form_102 .arm_form_field_submit_button,
			body .arm_form_101 .arm_form_field_submit_button.md-button,
			body .arm_form_101 .arm_form_field_submit_button {
				border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-webkit-border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-moz-border-radius:" . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				-o-border-radius: " . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
				width: auto;
				max-width: 100%;
				width: 250px;
				min-height: 35px;
				min-height: 45px;
				padding: 0 10px;
				font-family: 'Fira Sans Condensed', sans-serif;
				font-size: " . esc_attr( get_theme_mod('progression_studios_button_font_size', '13') + 1 ) . "px;
				margin: 10px 0px 0px 0px;
				font-weight: normal;font-style: normal;text-decoration: none;
				text-transform: none;
			    background: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;border:none !important;color: " . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . " !important;
			}

			body .arm_form_field_submit_button.arm_form_field_container_button.arm_editable_input_button,
			body .arm_form_field_submit_button.arm_form_field_container_button.arm_editable_input_button,
			body .arm_form_field_submit_button.arm_form_field_container_button.arm_editable_input_button {
			    height: 45px;
			}

			body .arm_form_103 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button.md-button,
			body .arm_form_103 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button,
			body .arm_form_102 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button.md-button,
			body .arm_form_102 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button,
			body .arm_form_101 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button.md-button,
			body .arm_form_101 .arm_setup_submit_btn_wrapper .arm_form_field_submit_button {
			    background: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . " !important;border: none !important; color: " . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . " !important;
			}

			body .arm_form_103 .arm_form_field_submit_button.md-button #arm_form_loader,
			body .arm_form_103 .arm_form_field_submit_button #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button.md-button #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button.md-button #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button #arm_form_loader {
			    fill:#ffffff;
			}

			/*.arm_form_101 button:hover,*/
			body .arm_form_103 .arm_form_field_submit_button:hover,
			body .arm_form_103 .arm_form_field_submit_button.md-button:hover,
			body .arm_form_103 .arm_form_field_submit_button.md-button:not([disabled]):hover,
			body .arm_form_103 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover,
			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover,
			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover,
			body .arm_form_102 .arm_form_field_submit_button:hover,
			body .arm_form_102 .arm_form_field_submit_button.md-button:hover,
			body .arm_form_102 .arm_form_field_submit_button.md-button:not([disabled]):hover,
			body .arm_form_102 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover,
			body .arm_form_101 .arm_form_field_submit_button:hover,
			body .arm_form_101 .arm_form_field_submit_button.md-button:hover,
			body .arm_form_101 .arm_form_field_submit_button.md-button:not([disabled]):hover,
			body .arm_form_101 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover{
				background-color: " . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . " !important; border: 1px solid " . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . " !important;color: " . esc_attr( get_theme_mod('progression_studios_button_font_hover', '#ffffff') ) . " !important;
			}

			body .arm_form_103 .arm_form_field_submit_button:hover #arm_form_loader,
			body .arm_form_103 .arm_form_field_submit_button.md-button:hover #arm_form_loader,
			body .arm_form_103 .arm_form_field_submit_button.md-button:not([disabled]):hover #arm_form_loader,
			body .arm_form_103 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover #arm_form_loader,
			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover #arm_form_loader,
			body .arm_form_103.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button:hover #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button.md-button:hover #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button.md-button:not([disabled]):hover #arm_form_loader,
			body .arm_form_102 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover #arm_form_loader,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover #arm_form_loader,
			body .arm_form_102.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button:hover #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button.md-button:hover #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button.md-button:not([disabled]):hover #arm_form_loader,
			body .arm_form_101 .arm_form_field_submit_button.md-button.md-default-theme:not([disabled]):hover #arm_form_loader,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn:hover #arm_form_loader,
			body .arm_form_101.arm_form_layout_writer .arm_form_wrapper_container .arm_form_field_submit_button.btn-large:hover #arm_form_loader{
			    fill:#ffffff;
			}

			body .arm_form_103 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn,
			body .arm_form_103 .arm_form_wrapper_container .armFileUploadContainer,
			body .arm_form_102 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn,
			body .arm_form_102 .arm_form_wrapper_container .armFileUploadContainer,
			body .arm_form_101 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn,
			body .arm_form_101 .arm_form_wrapper_container .armFileUploadContainer{
				border: 1px solid " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
				background-color: " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
				color: " . esc_attr( get_theme_mod('progression_studios_button_font_hover', '#ffffff') ) . ";
			}


			body .arm_form_103 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn:hover,
			body .arm_form_103 .arm_form_wrapper_container .armFileUploadContainer:hover,
			body .arm_form_102 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn:hover,
			body .arm_form_102 .arm_form_wrapper_container .armFileUploadContainer:hover,
			body .arm_form_101 .arm_form_wrapper_container .armFileUploadWrapper .armFileBtn:hover,
			body .arm_form_101 .arm_form_wrapper_container .armFileUploadContainer:hover{
			    background-color: " . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . " !important;
				border-color: " . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . " !important;
				color: " . esc_attr( get_theme_mod('progression_studios_button_font_hover', '#ffffff') ) . " !important;
			}

			body .arm_form_102 .arm_field_fa_icons,
			body .arm_form_101 .arm_field_fa_icons{color: #bababa;}

			body .arm_form_103 .arm_field_fa_icons,
			body .arm_form_102 stop.arm_social_connect_svg,
			body .arm_form_101 stop.arm_social_connect_svg { stop-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . "; }
	
		";
	}	else {
		$progression_studios_armember_form_styles = "";
	}

	$progression_studios_custom_css = "
		
	$progression_studios_armember_form_styles
	$progression_studios_custom_page_title_img
	$progression_studios_woo_page_title
	$progression_studios_custom_tax_page_title_img
	$progression_studios_blog_header_img
	body #logo-pro img {
		width:" .  esc_attr( get_theme_mod('progression_studios_theme_logo_width', '190') ) . "px;
		padding-top:" .  esc_attr( get_theme_mod('progression_studios_theme_logo_margin_top', '24') ) . "px;
		padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_theme_logo_margin_bottom', '25') ) . "px;
	}
	ul.vayvo-video-cast-list li a:hover h6,
	#progression-studios-woocommerce-single-top .product_meta a:hover,
	#content-pro ul.products a:hover h2.woocommerce-loop-product__title,
	a, ul.progression-post-meta a:hover {
		color:" .  esc_attr( get_theme_mod('progression_studios_default_link_color', '#22b2ee') ) . ";
	}
	a:hover {
		color:" .  esc_attr( get_theme_mod('progression_studios_default_link_hover_color', '#74d6ff') ). ";
	}
	#vayvo-progression-header-top .sf-mega, header ul .sf-mega {margin-left:-" .  esc_attr( get_theme_mod('progression_studios_site_width', '1200') / 2 ) . "px; width:" .  esc_attr( get_theme_mod('progression_studios_site_width', '1200') ) . "px;}
	body .elementor-section.elementor-section-boxed > .elementor-container {max-width:" .  esc_attr( get_theme_mod('progression_studios_site_width', '1200') ) . "px;}
	.width-container-pro {  width:" .  esc_attr( get_theme_mod('progression_studios_site_width', '1200') ) . "px; }
	$progression_studios_header_bg_optional
	$progression_studios_header_border_optional
	header#masthead-pro h1#logo-pro {
		border-right:1px solid " .  esc_attr( get_theme_mod('progression_studios_header_divider_color', 'rgba(255,255,255, 0.1)') ) . ";
	}
	#vayvo-header-user-profile-login,
	#header-user-profile-click {
		border-color:" .  esc_attr( get_theme_mod('progression_studios_header_divider_color', 'rgba(255,255,255, 0.1)') ) . ";
	}
	#progression-studios-header-base-overlay {
		display:" .  esc_attr( get_theme_mod('progression_studios_header_box_shadow', 'block') ) . ";
	}
	body.progression-studios-header-sidebar-before #progression-inline-icons .progression-studios-social-icons, body.progression-studios-header-sidebar-before:before, header#masthead-pro {
		$progression_studios_header_bg_image
		$progression_studios_header_bg_cover
	}
	body {
		background-color:" .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). ";
		$progression_studios_body_bg
		$progression_studios_body_bg_cover
	}
	.progression-studios-skrn-slider-upside-down:after {
		background: -moz-linear-gradient(top, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 80% , rgba(8,7,14,0) 100% );
		background: -webkit-linear-gradient(top,  " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 80%, rgba(8,7,14,0) 100% );
		background: linear-gradient(to bottom, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 80%, rgba(8,7,14,0) 100% );
	}
	#profile-sidebar-gradient,
	.slider-background-overlay-color,
	#video-page-title-gradient-base {
		background: -moz-linear-gradient(top, rgba(8,7,14,0) 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 100%);
		background: -webkit-linear-gradient(top, rgba(8,7,14,0) 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 100%);
		background: linear-gradient(to bottom, rgba(8,7,14,0) 0%, " .   esc_attr( get_theme_mod('progression_studios_background_color', '#08070e') ). " 100%);
	}
	#page-title-pro {
		background-color:" .   esc_attr( get_theme_mod('progression_studios_page_title_bg_color', '#303030') ). ";
		$progression_studios_page_tite_vertical_height
	}
	#page-title-overlay-image {
		$progression_studios_page_title_bg
		$progression_studios_page_tite_bg_cover
	}
	body.single-post #page-title-overlay-image { 
		$progression_studios_post_title_bg 
		$progression_studios_page_tite_bg_cover
	}
	#progression-studios-page-title-container {
		padding-top:" . esc_attr( get_theme_mod('progression_studios_page_title_padding_top', '150') ). "px;
		padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_page_title_padding_bottom', '150') ). "px;
		text-align:" .  esc_attr( get_theme_mod('progression_studios_page_title_align', 'center') ). ";
	}
	body.page-template-page-landing #progression-studios-page-title-container {
		padding-top:" . esc_attr( get_theme_mod('progression_studios_page_title_padding_top', '150') + 40 ). "px;
	}
	body.single-post #progression-studios-page-title-container {
		padding-top:" . esc_attr( get_theme_mod('progression_studios_post_title_padding_top', '350') ). "px;
		padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_post_title_padding_bottom', '80') ). "px;
		text-align:" .  esc_attr( get_theme_mod('progression_studios_post_page_title_align', 'center') ). ";
	}
	#progression-studios-post-page-title {
		background-color:" .   esc_attr( get_theme_mod('progression_studios_page_title_bg_color', '#303030') ). ";
		$progression_studios_page_title_bg
		$progression_studios_page_tite_bg_cover
		padding-top:" . esc_attr( get_theme_mod('progression_studios_page_title__postpadding_top', '130') ). "px;
		padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_page_title_post_padding_bottom', '125') ). "px;
	}
	$progression_studios_page_tite_overlay_image_cover
	$progression_studios_post_tite_overlay_image_cover
	.sidebar h4.widget-title:after { background-color:" .   esc_attr( get_theme_mod('progression_studios_sidebar_header_border', '#15c562') ). "; }
	ul.progression-studios-header-social-icons li a {
		font-size:". esc_attr( get_theme_mod('progression_studios_social_icons_font_size', '18') ) . "px;
		margin-top:". esc_attr( get_theme_mod('progression_studios_social_icons_margintop', '34') ) . "px;
		margin-bottom:". esc_attr( get_theme_mod('progression_studios_social_icons_margintop', '34') - 4 ) . "px;
		background:". esc_attr( get_theme_mod('progression_studios_social_icons_bg', 'rgba(255,255,255,  0)') ) . ";
		color:". esc_attr( get_theme_mod('progression_studios_social_icons_color', '#6c718b') ) . ";
		width:". esc_attr( get_theme_mod('progression_studios_social_icons_font_size', '18') + 10 ) . "px;
		height:". esc_attr( get_theme_mod('progression_studios_social_icons_font_size', '18') + 10 ) . "px;
		line-height:". esc_attr( get_theme_mod('progression_studios_social_icons_font_size', '18') + 10 ) . "px;
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a {
		color:". esc_attr( get_theme_mod('progression_studios_social_icons_color', '#6c718b') ) . ";
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a:hover, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-header-icons-inline-display ul.progression-studios-header-social-icons li a:hover {
		color:". esc_attr( get_theme_mod('progression_studios_social_icons_hover_color', '#1b1b1b') ) . ";
	}
	#vayvo-progression-header-top ul.progression-studios-header-social-icons li a {
		background:". esc_attr( get_theme_mod('progression_studios_social_icons_bg', 'rgba(255,255,255,  0)') ) . ";
		color:". esc_attr( get_theme_mod('progression_studios_social_icons_color', '#6c718b') ) . ";
	}
	#vayvo-progression-header-top ul.progression-studios-header-social-icons li a:hover,
	ul.progression-studios-header-social-icons li a:hover {
		background:". esc_attr( get_theme_mod('progression_studios_social_icons_hover_bg', 'rgba(255,255,255,  0)') ) . ";
		color:". esc_attr( get_theme_mod('progression_studios_social_icons_hover_color', '#1b1b1b') ) . ";
	}
	#vayvo-landing-login-logout-header a,
	#vayvo-landing-mobile-login-logout-header a.arm_form_popup_link,
	#vayvo-header-user-profile-login a.arm_form_popup_link {
		color:". esc_attr( get_theme_mod('progression_studios_nav_login_font_color', '#ffffff') ) . " !important;
		border-color:". esc_attr( get_theme_mod('progression_studios_nav_login_brder', '#ffffff') ) . " !important;
	}
	#vayvo-landing-login-logout-header a:hover,
	#vayvo-landing-mobile-login-logout-header a.arm_form_popup_link:hover,
	#vayvo-header-user-profile-login a.arm_form_popup_link:hover {
		color:". esc_attr( get_theme_mod('progression_studios_nav_login_hover_color', '#22bfe6') ) . " !important;
		border-color:". esc_attr( get_theme_mod('progression_studios_nav_login_hover_border', '#22bfe6') ) . " !important;
	}
	/* START VIDEO STYLES */	
	.progression-studios-video-index-container:hover .video-index-border-hover {
		border-color:" . esc_attr( get_theme_mod('progression_studios_video_border_hover', '#22b2ee') ) . ";
	}
	.comment-form .rating-container > input + label:before,
	.average-rating-video-empty {
		color:" . esc_attr( get_theme_mod('progression_studios_video_rating_color', 'rgba(255,255,255,0.8)') ) . ";
		
	}
	.comment-form .rating-container > input:checked ~ label:before,
	.comment-form .rating-container > input + label:hover ~ label:before,
	.comment-form .rating-container > input + label:hover:before,
	.comment-form .rating-container:hover > input + label:hover ~ label:before,
	.comment-form .rating-container:hover > input + label:hover:before,
	.average-rating-video-filled {
		color:" . esc_attr( get_theme_mod('progression_studios_video_rating_fill_color', '#22b2ee') ) . ";
	}
	.progression-video-index-content {
		background: -moz-linear-gradient(top, 	" . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 0%, 	" . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 40%, 		" . esc_attr( get_theme_mod('progression_studios_video_overlay_bottom', 'rgba(0,0,0,0.95)') ) . " 100%);
		background: -webkit-linear-gradient(top," . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 0%,	" . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 40%,		" . esc_attr( get_theme_mod('progression_studios_video_overlay_bottom', 'rgba(0,0,0,0.95)') ) . " 100%);
		background: linear-gradient(to bottom, 	" . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 0%,	" . esc_attr( get_theme_mod('progression_studios_video_overlay_top', 'rgba(0,0,0,0)') ) . " 40%,		" . esc_attr( get_theme_mod('progression_studios_video_overlay_bottom', 'rgba(0,0,0,0.95)') ) . " 100%);
	}
	#video-page-title-pro {
		height:" . esc_attr( get_theme_mod('progression_studios_media_header_height', '75') ) . "vh;
		background-color:" . esc_attr( get_theme_mod('progression_studios_media_header_color', '#303030') ) . ";
		$progression_studios_header_media_bg_image
	}
	#comment-review-pop-up-container,
	#vayvo-profile-sidebar-name, .content-sidebar-section {background:" . esc_attr( get_theme_mod('progression_studios_sidebar_meta_background', '#1e1d26') ) . ";}
	/* END VIDEO STYLES */	
	/* START BLOG STYLES */	
	#page-title-pro.page-title-pro-post-page {
		$progression_studios_post_tite_bg_color
		$progression_studios_post_tite_bg_image_post
		$progression_studios_post_tite_bg_cover
	}
	.progression-blog-content {
		background:" . esc_attr( get_theme_mod('progression_studios_blog_content_bg', 'rgba(255,255,255, 0.06)') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_blog_content_border', 'rgba(255,255,255, 0.09)') ) . ";
	}
	ul.progression-post-meta {
		border-color:" . esc_attr( get_theme_mod('progression_studios_blog_meta_border', 'rgba(255,255,255, 0.09)') ) . ";
	}
	h2.progression-blog-title a {color:" . esc_attr( get_theme_mod('progression_studios_blog_title_link', '#ffffff') ) . ";}
	h2.progression-blog-title a:hover {color:" . esc_attr( get_theme_mod('progression_studios_blog_title_link_hover', '#22b2ee') ) . ";}
	.progression-portfolio-post-content {background:" . esc_attr( get_theme_mod('progression_studios_portfolio_post_bg', '#ffffff') ) . ";}
	#progression-studios-sharing-and-tags-container {
		border-color:" . esc_attr( get_theme_mod('progression_studios_post_sharing_divider', '#e7e7e7') ) . ";
	}
	a.progression-studios-overlay-blog-index:before {
		background:" . esc_attr( get_theme_mod('progression_studios_blog_overlay_image_color', 'rgba(0,0,0, 0.5)') ) . ";
	}
	a.progression-studios-overlay-blog-index:hover:before {
		background:" . esc_attr( get_theme_mod('progression_studios_blog_overlay_image_color_hover', 'rgba(32,217,153, 0.95)') ) . ";
	}
	a.progression-studios-overlay-blog-index ul.progression-post-meta {
		border-color:" . esc_attr( get_theme_mod('progression_studios_blog_overlay_meta_divider', 'rgba(255,255,255,0.25)') ) . ";
	}
	.progression-overlay-centering {
		vertical-align:" . esc_attr( get_theme_mod('progression_studios_blog_index_vertical', 'bottom') ) . ";
	}
	.progression-overlay-container {
		height:" . esc_attr( get_theme_mod('progression_studios_blog_overlay_height', '360') ) . "px;
	}

	/* END BLOG STYLES */
	/* START SHOP STYLES */
	#progression-studios-woocommerce-single-bottom .related.products {
			display:" .  esc_attr( get_theme_mod('progression_studios_related_products', 'none') ) . ";
	}
	#content-pro ul.products h2.woocommerce-loop-category__title mark {
			display:" .  esc_attr( get_theme_mod('progression_studios_category_count', 'none') ) . ";
	}
	#progression-studios-woocommerce-single-bottom .woocommerce-tabs ul.wc-tabs li.active a {
			color:" .  esc_attr( get_theme_mod('progression_studios_shop_post_tab_highlight', '#22b2ee') ) . ";
	}
	#progression-studios-woocommerce-single-bottom .woocommerce-tabs ul.wc-tabs li.active {
		border-top-color:" .  esc_attr( get_theme_mod('progression_studios_shop_post_tab_highlight', '#22b2ee') ) . ";
	}
	#progression-studios-woocommerce-single-bottom .woocommerce-tabs ul.wc-tabs li.active,
	#progression-studios-woocommerce-single-bottom {
		background:" .  esc_attr( get_theme_mod('progression_studios_shop_post_base_background', 'rgba(255,255,255,0.1)') ) . ";
	}
	/* END SHOP STYLES */
	/* START LANDING PAGE STYLE */
	header#masthead-pro.vayvo-landing-page-header:after { 
		background-color: " .  esc_attr( get_theme_mod('progression_studios_landing_header_divider', 'rgba(255,255,255,0.12)') ) . ";
	}
	header#masthead-pro.vayvo-landing-page-header h1#logo-pro,
	header#masthead-pro.vayvo-landing-page-header #vayvo-header-user-profile-login {
		border-color:" .  esc_attr( get_theme_mod('progression_studios_landing_header_divider', 'rgba(255,255,255,0.12)') ) . ";
	}
	header#masthead-pro.vayvo-landing-page-header {
		background-color:" .  esc_attr( get_theme_mod('progression_studios_landing_header_bg', 'rgba(255,255,255,0)') ) . ";
	}
	.page-template-page-landing .sf-menu a:before,
	.page-template-page-landing .sf-menu a:hover:before, .page-template-page-landing .sf-menu li.sfHover a:before, .page-template-page-landing .sf-menu li.current-menu-item a:before {
		background:" . esc_attr( get_theme_mod('progression_studios_landing_nav_underline', 'rgba(255,255,255, 0)') ). ";
	}
	.page-template-page-landing .sf-menu a {
		background:" . esc_attr( get_theme_mod('progression_studios_landing_nav_bg', 'rgba(255,255,255, 0)') ). ";
	}
	.page-template-page-landing .sf-menu a:hover, .page-template-page-landing .sf-menu li.sfHover a, .page-template-page-landing .sf-menu li.current-menu-item a { background:".  esc_attr( get_theme_mod('progression_studios_landing_nav_bg_hover', 'rgba(255,255,255, 0)') ). "; }
	
	.page-template-page-landing .sf-menu a {
		color:" . esc_attr( get_theme_mod('progression_studios_landing_nav_font_color', 'rgba(255,255,255, 0.8)') ). ";
	}
	.page-template-page-landing .sf-menu a:hover, .page-template-page-landing .sf-menu li.sfHover a, .page-template-page-landing .sf-menu li.current-menu-item a {
		color:". esc_attr( get_theme_mod('progression_studios_landing_nav_font_color_hover', '#ffffff') ) . ";
	}
	
	/* END LANDING PAGE STYLES */
	/* START BUTTON STYLES */
	#mobile-video-search-header input.search-field-progression,
	#video-search-header input.search-field-progression,
	body #content-pro .width-container-pro .woocommerce textarea,
	body #content-pro .width-container-pro .woocommerce .shop_table input#coupon_code[type=text],
	body #content-pro .width-container-pro .woocommerce input[type=text],
	body #content-pro .width-container-pro .woocommerce input[type=password],
	body #content-pro .width-container-pro .woocommerce input[type=url],
	body #content-pro .width-container-pro .woocommerce input[type=tel],
	body #content-pro .width-container-pro .woocommerce input[type=number],
	body #content-pro .width-container-pro .woocommerce input[type=color],
	body #content-pro .width-container-pro .woocommerce input[type=email],
	#content-pro .woocommerce table.shop_table .coupon input#coupon_code, #content-pro .woocommerce table.shop_table input, form.checkout.woocommerce-checkout textarea.input-text, form.checkout.woocommerce-checkout input.input-text,#respond select,
	.post-password-form input, .search-form input.search-field, .wpcf7 select, #respond textarea, #respond input, .wpcf7-form input, .wpcf7-form textarea {
		background-color:" . esc_attr( get_theme_mod('progression_studios_input_background', 'rgba(255, 255, 255, 0.07)') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_input_border', 'rgba(255, 255, 255, 0.09)') ) . ";
	}
	#progression-studios-woocommerce-single-top .quantity input {
		background-color:" . esc_attr( get_theme_mod('progression_studios_input_background', 'rgba(255, 255, 255, 0.07)') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_input_border', 'rgba(255, 255, 255, 0.09)') ) . ";
	}
	.progression-studios-shop-overlay-buttons a.added_to_cart, .wp-block-button a.wp-block-button__link, .post-password-form input[type=submit], #respond input.submit, .wpcf7-form input.wpcf7-submit,
	.infinite-nav-pro a, #boxed-layout-pro .woocommerce .shop_table input.button, #boxed-layout-pro .form-submit input#submit, #boxed-layout-pro #customer_login input.button, #boxed-layout-pro .woocommerce-checkout-payment input.button, #boxed-layout-pro button.button, #boxed-layout-pro a.button  {
		font-size:" . esc_attr( get_theme_mod('progression_studios_button_font_size', '14') ) . "px;
	}
	.search-form input.search-field,
	.wp-block-button a.wp-block-button__link,
	#respond select, .wpcf7 select, .post-password-form input, #respond textarea, #respond input, .wpcf7-form input, .wpcf7-form textarea {
		border-radius:" . esc_attr( get_theme_mod('progression_studios_ionput_bordr_radius', '0') ) . "px;
	}
	#helpmeeout-login-form:before {
		border-bottom: 8px solid " . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	ul.dashboard-sub-menu li a.current,
	.select_vayvo_season_5 ul.vayvo-progression-video-season-navigation li.progression-video-season-title:nth-child(5) a,
	.select_vayvo_season_4 ul.vayvo-progression-video-season-navigation li.progression-video-season-title:nth-child(4) a,
	.select_vayvo_season_3 ul.vayvo-progression-video-season-navigation li.progression-video-season-title:nth-child(3) a,
	.select_vayvo_season_2 ul.vayvo-progression-video-season-navigation li.progression-video-season-title:nth-child(2) a,
	ul.vayvo-progression-video-season-navigation li.progression-video-season-title.current a {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";;
	}
	.progression-page-nav a:hover, .progression-page-nav span, #content-pro ul.page-numbers li a:hover, #content-pro ul.page-numbers li span.current {
		color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.progression-page-nav a:hover span {
		color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.column-search-header .asRange .asRange-pointer:before,
	.column-search-header .asRange .asRange-selected,
	.checkbox-pro-container .checkmark-pro:after,
	.flex-direction-nav a:hover, #boxed-layout-pro .woocommerce-shop-single .summary button.button,
	#boxed-layout-pro .woocommerce-shop-single .summary a.button {
		color:" . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . ";
		background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.progression-own-theme .owl-dots .owl-dot.active span {
	background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	ul.skrn-video-search-columns .select2.select2-container--open .select2-selection,
	.checkbox-pro-container input:checked ~ .checkmark-pro {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.video-search-header-buttons input,
	a#video-post-play-text-btn,
	.progression-sticky-scrolled header#masthead-pro #progression-checkout-basket a.cart-button-header-cart, #progression-checkout-basket a.cart-button-header-cart, .progression-studios-shop-overlay-buttons a.added_to_cart, .wp-block-button a.wp-block-button__link, .woocommerce form input.button, .woocommerce form input.woocommerce-Button, button.wpneo_donate_button, .sidebar ul.progression-studios-social-widget li a, footer#site-footer .tagcloud a, .tagcloud a, body .woocommerce nav.woocommerce-MyAccount-navigation li.is-active a, .post-password-form input[type=submit], #respond input.submit, .wpcf7-form input.wpcf7-submit, #boxed-layout-pro .woocommerce .shop_table input.button, #boxed-layout-pro .form-submit input#submit, #boxed-layout-pro #customer_login input.button, #boxed-layout-pro .woocommerce-checkout-payment input.button, #boxed-layout-pro button.button, #boxed-layout-pro a.button {
		color:" . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . ";
		background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		border-radius:" . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
		letter-spacing:" . esc_attr( get_theme_mod('progression_studios_button_letter_spacing', '0') ) . "em;
	}
	
	.progression-studios-post-slider-main .flex-control-paging li a.flex-active {
	  background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	  border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.infinite-nav-pro a,
	#video-social-sharing-button, button.wishlist-button-pro {
		border-radius:" . esc_attr( get_theme_mod('progression_studios_button_bordr_radius', '60') ) . "px;
	}
	.video-search-header-buttons input,
	a#video-post-play-text-btn {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.mobile-menu-icon-pro span.progression-mobile-menu-text,
	#boxed-layout-pro .woocommerce-shop-single .summary button.button,
	#boxed-layout-pro .woocommerce-shop-single .summary a.button {
		letter-spacing:" . esc_attr( get_theme_mod('progression_studios_button_letter_spacing', '0') ) . "em;
	}
	body .woocommerce nav.woocommerce-MyAccount-navigation li.is-active a { border-radius:0px; }
	a.edit-profile-sidebar,
	body .select2-container--default .select2-results__option[aria-selected=true],
	body .select2-container--default .select2-results__option--highlighted[aria-selected],
	body .mc4wp-form input[type='submit'] {
		color:" . esc_attr( get_theme_mod('progression_studios_button_font', '#ffffff') ) . ";
		background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.infinite-nav-pro a:hover {
		color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	body .mc4wp-form input[type='submit']:hover {
		color:" . esc_attr( get_theme_mod('progression_studios_button_font_hover', '#ffffff') ) . ";
		background:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
	}
	#mobile-video-search-header input.search-field-progression:focus,
	#video-search-header input.search-field-progression:focus,
	body #content-pro .width-container-pro .woocommerce textarea:focus, body #content-pro .width-container-pro .woocommerce .shop_table input#coupon_code:focus[type=text], body #content-pro .width-container-pro .woocommerce input:focus[type=text], body #content-pro .width-container-pro .woocommerce input:focus[type=password], body #content-pro .width-container-pro .woocommerce input:focus[type=url], body #content-pro .width-container-pro .woocommerce input:focus[type=tel],body #content-pro .width-container-pro .woocommerce input:focus[type=number], 	body #content-pro .width-container-pro .woocommerce input:focus[type=color], body #content-pro .width-container-pro .woocommerce input:focus[type=email],
	#progression-studios-woocommerce-single-top table.variations td.value select:focus,
	.woocommerce-page form.woocommerce-ordering select:focus, #respond select:focus,
	#panel-search-progression .search-form input.search-field:focus, body .woocommerce-shop-single table.variations td.value select:focus,  form#mc-embedded-subscribe-form  .mc-field-group input:focus, .wpcf7-form select:focus, .post-password-form input:focus, .search-form input.search-field:focus, #respond textarea:focus, #respond input:focus, .wpcf7-form input:focus, .wpcf7-form textarea:focus,
	.widget.widget_price_filter form .price_slider_wrapper .price_slider .ui-slider-handle {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		outline:none;
	}
	#progression-studios-woocommerce-single-top .quantity input:focus, .mc4wp-form input:focus, .widget select:focus {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
		outline:none;
	}
	.rtl blockquote, blockquote, blockquote.alignleft, blockquote.alignright {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	body .woocommerce .woocommerce-MyAccount-content {
		border-left-color:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.widget.widget_price_filter form .price_slider_wrapper .price_slider .ui-slider-range {
		background:" . esc_attr( get_theme_mod('progression_studios_button_background', '#22b2ee') ) . ";
	}
	.video-search-header-buttons input:hover,
	a#video-post-play-text-btn:hover,
	.progression-studios-shop-overlay-buttons a.added_to_cart:hover, .wp-block-button a.wp-block-button__link:hover, .woocommerce form input.button:hover, .woocommerce form input.woocommerce-Button:hover, .progression-sticky-scrolled header#masthead-pro #progression-checkout-basket a.cart-button-header-cart:hover, body #progression-checkout-basket a.cart-button-header-cart:hover, #boxed-layout-pro .woocommerce-shop-single .summary button.button:hover, #boxed-layout-pro .woocommerce-shop-single .summary a.button:hover, .progression-studios-blog-cat-overlay a, .progression-studios-blog-cat-overlay a:hover, .sidebar ul.progression-studios-social-widget li a:hover, .tagcloud a:hover, #boxed-layout-pro .woocommerce .shop_table input.button:hover, #boxed-layout-pro .form-submit input#submit:hover, #boxed-layout-pro #customer_login input.button:hover, #boxed-layout-pro .woocommerce-checkout-payment input.button:hover, #boxed-layout-pro button.button:hover, #boxed-layout-pro a.button:hover, .post-password-form input[type=submit]:hover, #respond input.submit:hover, .wpcf7-form input.wpcf7-submit:hover {
		color:" . esc_attr( get_theme_mod('progression_studios_button_font_hover', '#ffffff') ) . ";
		background:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
	}
	.video-search-header-buttons input:hover,
	a#video-post-play-text-btn:hover {
		border-color:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
	}
	.sidebar .star-rating, .sidebar .star-rating:before, .comment-form-rating .stars a, .comment-form-rating .stars a:before, .commentlist .star-rating, .commentlist .star-rating:before, #progression-studios-woocommerce-single-top .star-rating, #progression-studios-woocommerce-single-top .star-rating:before, #content-pro ul.products .star-rating, #content-pro ul.products .star-rating:before {
		color:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
	}
	.highlight-pro:before {
		background:" . esc_attr( get_theme_mod('progression_studios_button_background_hover', '#0b78a2') ) . ";
	}
	#all-reviews-button-progression,
	#video-social-sharing-button,
	button.wishlist-button-pro,
	.video-search-header-buttons input#configreset {
		border-color:" . esc_attr( get_theme_mod('progression_studios_secondary_button_color', '#4d4d54') ) . ";
	}
	#all-reviews-button-progression:hover,	
	#video-social-sharing-button:hover,
	button.wishlist-button-pro:hover,
	.video-search-header-buttons input#configreset:hover {
		background-color:" . esc_attr( get_theme_mod('progression_studios_secondary_button_color', '#4d4d54') ) . ";
		border-color:" . esc_attr( get_theme_mod('progression_studios_secondary_button_color', '#4d4d54') ) . ";
	}	
	/* END BUTTON STYLES */
	/* START Sticky Nav Styles */
	body.single-post .progression-sticky-scrolled header#masthead-pro, .progression-sticky-scrolled header#masthead-pro, .progression-studios-transparent-header .progression-sticky-scrolled header#masthead-pro { background-color:" .   esc_attr( get_theme_mod('progression_studios_sticky_header_background_color', '#ffffff') ) ."; }
	body .progression-sticky-scrolled #logo-pro img {
		$progression_studios_sticky_logo_width
		$progression_studios_sticky_logo_top
		$progression_studios_sticky_logo_bottom
	}
	$progression_studios_sticky_nav_padding
	$progression_studios_sticky_nav_option_font_color	
	$progression_studios_optional_sticky_nav_font_hover
	$progression_studios_sticky_nav_underline
	/* END Sticky Nav Styles */
	/* START Main Navigation Customizer Styles */
	#progression-shopping-cart-count a.progression-count-icon-nav, nav#site-navigation { letter-spacing: ". esc_attr( get_theme_mod('progression_studios_nav_letterspacing', '0.02') ). "em; }
	#progression-inline-icons .progression-studios-social-icons a {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 3 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 3 ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 3 ). "px;
	}
	#vayvo-landing-login-logout-header a,
	#vayvo-header-user-profile-login a.arm_form_popup_link {
		margin-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 13 ). "px;
		margin-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 12 ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') - 1 ). "px;
	}
	#vayvo-landing-login-logout-header,
	#vayvo-header-user-profile-login {
		height:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') + get_theme_mod('progression_studios_nav_padding', '30') +  get_theme_mod('progression_studios_nav_font_size', '15') ). "px;
	}
	.sf-menu li .text-menu-icon span {
		line-height:1;
		display:block;
		float:left;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 10 ). "px;
		margin-right:11px;
		position:relative;
		top:-6px;
	}
	.sf-menu ul li .text-menu-icon span {
		font-size:".  esc_attr( get_theme_mod('progression_studios_sub_nav_font_size', '14') ). "px;
		margin-right:7px;
		top:0px;
	}

	.mobile-menu-icon-pro {
		min-width:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 6 ). "px;
		color:". esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . ";
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 3 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 5 ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 6 ). "px;
	}
	.mobile-menu-icon-pro:hover, .active-mobile-icon-pro .mobile-menu-icon-pro {
		color:". esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . ";
	}
	.mobile-menu-icon-pro span.progression-mobile-menu-text {
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') ). "px;
	}
	#progression-shopping-cart-count span.progression-cart-count {
		top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 1). "px;
	}
	#progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 5 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 5 ). "px;
		height:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 10 ). "px;
		line-height:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 10 ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 10 ). "px;
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon,  .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-toggle.activated-class a .shopping-cart-header-icon:hover, .activated-class #progression-shopping-cart-count a.progression-count-icon-nav .shopping-cart-header-icon, #progression-shopping-cart-count a.progression-count-icon-nav:hover .shopping-cart-header-icon {
		color:". esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . ";
	}
	#progression-studios-header-search-icon .progression-icon-search {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30')  - 4 ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') - 4 ). "px;
		height:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 8 ). "px;
		line-height:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 8 ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') + 8 ). "px;
	}
	nav#site-navigation {
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30')  ). "px;
	}
	.sf-menu a {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
		margin-top:-" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30')  ). "px;
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30')   ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') ). "px;
		$progression_studios_optional_nav_bg
	}
	#header-user-profile-click {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
		padding-top:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30')   ). "px;
		padding-bottom:" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') ). "px;
		font-size:" . esc_attr( get_theme_mod('progression_studios_nav_font_size', '15') - 1 ). "px;
	}
	#avatar-small-header-vayvo-progression {
		margin-top:-" . esc_attr( get_theme_mod('progression_studios_nav_padding', '30') -  get_theme_mod('progression_studios_nav_font_size', '15') - 4   ). "px;
		margin-bottom:-10px;
	}
	#header-user-profile.active #header-user-profile-click, #header-user-profile-click:hover {
		color:". esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . ";
	}
	.sf-menu li li a {
		margin-top:auto;
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled  #progression-inline-icons .progression-studios-social-icons a,
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled  #progression-inline-icons .progression-studios-social-icons a,
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container a.progresion-studios-login-icon, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a,
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon .progression-icon-search,
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container a.progresion-studios-login-icon, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a  {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color', '#ffffff') ). ";
	}
	$progression_studios_sticky_nav_underline_default
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled  #progression-inline-icons .progression-studios-social-icons a:hover,
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled  #progression-inline-icons .progression-studios-social-icons a:hover,
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon:hover .progression-icon-search, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container:hover a.progresion-studios-login-icon, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container.helpmeout-activated-class a.progresion-studios-login-icon, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a:hover, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav:hover, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu a:hover, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a, 
	.progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a,
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon:hover .progression-icon-search, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container:hover a.progresion-studios-login-icon, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-studios-header-login-container.helpmeout-activated-class a.progresion-studios-login-icon, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-inline-icons .progression-studios-social-icons a:hover, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled #progression-shopping-cart-count a.progression-count-icon-nav:hover, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu a:hover, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover a, 
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item a,
	#progression-studios-header-login-container:hover a.progresion-studios-login-icon, #progression-studios-header-login-container.helpmeout-activated-class a.progresion-studios-login-icon,
	#progression-studios-header-search-icon:hover .progression-icon-search, #progression-studios-header-search-icon.active-search-icon-pro .progression-icon-search, #progression-inline-icons .progression-studios-social-icons a:hover, #progression-shopping-cart-count a.progression-count-icon-nav:hover, .sf-menu a:hover, .sf-menu li.sfHover a, .sf-menu li.current-menu-item a {
		color:". esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . ";
	}
	#header-user-profile-menu,
	ul#progression-studios-panel-login, #progression-checkout-basket, #panel-search-progression, .sf-menu ul {
		background:".  esc_attr( get_theme_mod('progression_studios_sub_nav_bg', '#171425') ). ";
	}
	$progression_studios_top_header_sub_nav_brder_top
	$progression_studios_sub_nav_brder_top
	#main-nav-mobile { background:".  esc_attr( get_theme_mod('progression_studios_sub_nav_bg', '#171425') ). "; }
	body #progression-sticky-header header ul.mobile-menu-pro h2.mega-menu-heading a, ul.mobile-menu-pro .sf-mega h2.mega-menu-heading a, ul.mobile-menu-pro .sf-mega h2.mega-menu-heading, body #progression-sticky-header header ul.mobile-menu-pro h2.mega-menu-heading a, body header ul.mobile-menu-pro .sf-mega h2.mega-menu-heading a , ul.mobile-menu-pro .sf-mega h2.mega-menu-heading, ul.mobile-menu-pro li a { 
		color:" . esc_attr( get_theme_mod('progression_studios_nav_font_color_hover', '#ffffff') ) . "; 
		letter-spacing:0em;
	}
	
	#header-user-profile-menu ul li a,
	ul#progression-studios-panel-login li a, .sf-menu li li a { 
		letter-spacing:".  esc_attr( get_theme_mod('progression_studios_sub_nav_letterspacing', '0') ). "em;
		font-size:".  esc_attr( get_theme_mod('progression_studios_sub_nav_font_size', '14') - 1 ). "px;
	}
	#panel-search-progression input, #progression-checkout-basket ul#progression-cart-small li.empty { 
		font-size:".  esc_attr( get_theme_mod('progression_studios_sub_nav_font_size', '14' ) ). "px;
	}
	.page-template-page-landing .sf-menu li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a,
	#header-user-profile-menu ul li a,
	ul#progression-studios-panel-login a,
	.progression-sticky-scrolled #progression-checkout-basket, .progression-sticky-scrolled #progression-checkout-basket a, .progression-sticky-scrolled .sf-menu li.sfHover li a, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li a, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li a, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a, #panel-search-progression .search-form input.search-field, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover.highlight-button li a, .sf-menu li.current-menu-item.highlight-button li a, .progression-sticky-scrolled #progression-checkout-basket a.checkout-button-header-cart:hover, #progression-checkout-basket a.checkout-button-header-cart:hover, #progression-checkout-basket, #progression-checkout-basket a, .sf-menu li.sfHover li a, .sf-menu li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a {
		color:" . esc_attr( get_theme_mod('progression_studios_sub_nav_font_color', 'rgba(181,187,212,  0.75)') ) . ";
	}
	#header-user-profile-menu ul li .progression-studios-menu-title:before, .sf-menu li li .progression-studios-menu-title:before { background:" . esc_attr( get_theme_mod('progression_studios_sub_nav_hover_bullet', '#22b2ee') ) . "; }
	.page-template-page-landing .sf-menu li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .page-template-page-landing .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li,
	.progression-sticky-scrolled ul#progression-studios-panel-login li a:hover, .progression-sticky-scrolled .sf-menu li li a:hover,  .progression-sticky-scrolled .sf-menu li.sfHover li a, .progression-sticky-scrolled .sf-menu li.current-menu-item li a, .sf-menu li.sfHover li a, .sf-menu li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li a, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li a { 
		background:none;
	}
	
	#header-user-profile-menu ul li a:hover,
	.progression-sticky-scrolled #progression-checkout-basket a:hover, .progression-sticky-scrolled #progression-checkout-basket ul#progression-cart-small li h6, .progression-sticky-scrolled #progression-checkout-basket .progression-sub-total span.total-number-add, .progression-sticky-scrolled .sf-menu li.sfHover li a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover a, .progression-sticky-scrolled .sf-menu li.sfHover li li a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a, .progression-sticky-scrolled .sf-menu li.sfHover li li li a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .progression-sticky-scrolled .sf-menu li.sfHover li li li li a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression-sticky-scrolled .sf-menu li.sfHover li li li li li a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li li a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li li li a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li li a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li li li a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li li li li a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li li li li li a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_dark_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li li a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li li li li li a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li li a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li li li a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li li li li a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li li li li li a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .progression_studios_force_light_navigation_color .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .sf-menu li.sfHover.highlight-button li a:hover, .sf-menu li.current-menu-item.highlight-button li a:hover, #progression-checkout-basket a.checkout-button-header-cart, #progression-checkout-basket a:hover, #progression-checkout-basket ul#progression-cart-small li h6, #progression-checkout-basket .progression-sub-total span.total-number-add, .sf-menu li.sfHover li a:hover, .sf-menu li.sfHover li.sfHover a, .sf-menu li.sfHover li li a:hover, .sf-menu li.sfHover li.sfHover li.sfHover a, .sf-menu li.sfHover li li li a:hover, .sf-menu li.sfHover li.sfHover li.sfHover a:hover, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a, .sf-menu li.sfHover li li li li a:hover, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a, .sf-menu li.sfHover li li li li li a:hover, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a:hover, .sf-menu li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover li.sfHover a { 
		color:". esc_attr( get_theme_mod('progression_studios_sub_nav_hover_font_color', '#22b2ee') ) . ";
	}
	
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before,  .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before {
		background:" . esc_attr( get_theme_mod('progression_studios_nav_highlight_hover_background', '#00b77f') ) . "; 
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover, .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover, .sf-menu li.sfHover.highlight-button a, .sf-menu li.current-menu-item.highlight-button a, .sf-menu li.highlight-button a, .sf-menu li.highlight-button a:hover {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_highlight_font_color', '#ffffff') ). "; 
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before,  .progression_studios_force_dark_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:before, .sf-menu li.current-menu-item.highlight-button a:before, .sf-menu li.highlight-button a:before {
		color:" . esc_attr( get_theme_mod('progression_studios_nav_highlight_font_color', '#ffffff') ). "; 
		background:" . esc_attr( get_theme_mod('progression_studios_nav_highlight_background', '#00da97') ). ";  opacity:1; width:100%;
	}
	.progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.current-menu-item.highlight-button a:hover:before, .progression_studios_force_light_navigation_color .progression-sticky-scrolled .sf-menu li.highlight-button a:hover:before, .sf-menu li.current-menu-item.highlight-button a:hover:before, .sf-menu li.highlight-button a:hover:before {
		background:" . esc_attr( get_theme_mod('progression_studios_nav_highlight_hover_background', '#00b77f') ). "; 
		width:100%;
	}
	#header-user-profile-menu ul.skrn-additional-profile-items li:last-child a,
	#header-user-profile-menu ul li a,
	ul.mobile-menu-pro .sf-mega .sf-mega-section li a, ul.mobile-menu-pro .sf-mega .sf-mega-section, ul.mobile-menu-pro.collapsed li a,
	ul#progression-studios-panel-login li a, #progression-checkout-basket ul#progression-cart-small li, #progression-checkout-basket .progression-sub-total, #panel-search-progression .search-form input.search-field, .sf-mega li:last-child li a, body header .sf-mega li:last-child li a, .sf-menu li li a, .sf-mega h2.mega-menu-heading, .sf-mega ul, body .sf-mega ul, #progression-checkout-basket .progression-sub-total, #progression-checkout-basket ul#progression-cart-small li { 
		border-color:" . esc_attr( get_theme_mod('progression_studios_sub_nav_border_color', 'rgba(49,50,61,  0.4)') ) . ";
	}
	.sf-menu ul {
		/* margin-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') / 2 ) . "px;*/
	}
	#progression-inline-icons .progression-studios-social-icons a {
		padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') -  7 ). "px;
		padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ). "px;
	}
	#progression-inline-icons .progression-studios-social-icons {
		padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ). "px;
	}
	.sf-menu a {
		padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') ). "px;
		padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') ). "px;
	}
	.sf-menu li.highlight-button { 
		margin-right:". esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ) . "px;
		margin-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ) . "px;
	}
	.sf-menu li.highlight-button a {
		padding-right:". esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ) . "px;
		padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 7 ) . "px;
	}
	.sf-arrows .sf-with-ul {
		padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 15 ) . "px;
	}
	.sf-arrows .sf-with-ul:after { 
		right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 9 ) . "px;
	}
	.rtl .sf-arrows .sf-with-ul {
		padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28')  ) . "px;
		padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 15 ) . "px;
	}
	.rtl  .sf-arrows ul .sf-with-ul {
		padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28')  ) . "px;
		padding-right:0px;
	}
	.rtl  .sf-arrows .sf-with-ul:after { 
		right:auto;
		left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28')  ) . "px;
	}
	.rtl  .sf-arrows ul .sf-with-ul:after { 
		right:auto;
		left:8px;
	}
	@media only screen and (min-width: 960px) and (max-width: 1300px) {
		#video-search-header {
			width:94%;
		}
		#progression-studios-header-search-icon .progression-icon-search {
			padding-left:4px;
			padding-right:15px;
		}
		#vayvo-landing-login-logout-header,
		#vayvo-header-user-profile-login {
			padding-left:10px;
		}
		#header-user-profile-click {
			padding-left:15px;
			padding-right:0px;
		}
		#avatar-small-header-vayvo-progression {
			margin-right:8px;
		}
		body #boxed-layout-pro .width-container-pro,
		.width-container-pro  { 
			width:94%; 
			padding-left:0px;
			padding-right:0px;
		}
		.sf-menu li .text-menu-icon span {
			margin-right:9px;
		}
		.sf-menu ul {
			/* margin-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 4 ) . "px; */
		}
		.sf-menu a {
			padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 4 ). "px;
			padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 4 ). "px;
		}
		.sf-menu li.highlight-button { 
			margin-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ). "px;
			margin-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ). "px;
		}
		.sf-menu li.highlight-button a {
			padding-right:". esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ) . "px;
			padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ) . "px;
		}
		.sf-arrows .sf-with-ul {
			padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 13 ). "px;
		}
		.sf-arrows .sf-with-ul:after { 
			right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 7 ). "px;
		}
		.rtl  .sf-arrows .sf-with-ul:after { 
			right:auto;
			left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 7  ) . "px;
		}
		.rtl .sf-arrows .sf-with-ul {
			padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28')  ). "px;
			padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 13 ). "px;
		}
		.rtl .sf-arrows .sf-with-ul:after { 
			right:auto;
			left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') + 7 ). "px;
		}
		#progression-inline-icons .progression-studios-social-icons a {
			padding-left:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') -  12 ). "px;
			padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ). "px;
		}
		#progression-inline-icons .progression-studios-social-icons {
			padding-right:" . esc_attr( get_theme_mod('progression_studios_nav_left_right', '28') - 12 ). "px;
		}
	}
	$progression_studios_optiona_nav_bg_hover
	$progression_studios_optiona_sticky_nav_font_bg	
	$progression_studios_optiona_sticky_nav_hover_bg
	$progression_studios_option_sticky_nav_font_color	
	$progression_studios_option_stickY_nav_font_hover_color
	$progression_studios_option_sticky_hightlight_bg_color
	$progression_studios_option_sticky_hightlight_font_color
	$progression_studios_option_sticky_hightlight_bg_color_hover
	/* END Main Navigation Customizer Styles */
	/* START FOOTER STYLES */
	footer#site-footer {
		background: " . esc_attr(get_theme_mod('progression_studios_footer_background', '#08070e')) . ";
	}
	#pro-scroll-top:hover {   color: " . esc_attr(get_theme_mod('progression_studios_scroll_hvr_color', '#ffffff')) . ";    background: " . esc_attr(get_theme_mod('progression_studios_scroll_hvr_bg_color', '#22b2ee')) . ";  }
	#copyright-text strong, footer#site-footer #copyright-text {  color: " . esc_attr(get_theme_mod('progression_studios_copyright_text_color', '#8e9099')) . ";}
	footer#site-footer #progression-studios-copyright a {  color: " . esc_attr(get_theme_mod('progression_studios_copyright_link', '#8e9099')) . ";}
	footer#site-footer #progression-studios-copyright a:hover { color: " . esc_attr(get_theme_mod('progression_studios_copyright_link_hover', '#ffffff')) . "; }
	#pro-scroll-top { $progression_studios_scroll_top_disable color:" . esc_attr(get_theme_mod('progression_studios_scroll_color', '#ffffff')) . ";  background: " . esc_attr(get_theme_mod('progression_studios_scroll_bg_color', 'rgba(100,100,100,  0.65)')) . ";  }
	#copyright-text { padding:" . esc_attr(get_theme_mod('progression_studios_copyright_margin_top', '40')) . "px 0px " . esc_attr(get_theme_mod('progression_studios_copyright_margin_bottom', '40')) . "px 0px; }
	#progression-studios-footer-logo { max-width:" . esc_attr( get_theme_mod('progression_studios_footer_logo_width', '250') ) . "px; padding-top:" . esc_attr( get_theme_mod('progression_studios_footer_logo_margin_top', '45') ) . "px; padding-bottom:" . esc_attr( get_theme_mod('progression_studios_footer_logo_margin_bottom', '0') ) . "px; padding-right:" . esc_attr( get_theme_mod('progression_studios_footer_logo_margin_right', '0') ) . "px; padding-left:" . esc_attr( get_theme_mod('progression_studios_footer_logo_margin_left', '0') ) . "px; }
	/* END FOOTER STYLES */
	@media only screen and (max-width: 959px) { 
		#progression-studios-page-title-container {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_page_title_padding_top', '150') - 40 ). "px;
			padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_page_title_padding_bottom', '150') - 40 ). "px;
		}
		body.page-template-page-landing #progression-studios-page-title-container {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_page_title_padding_top', '150')  ). "px;
		}
		body.single-post #progression-studios-page-title-container {
			padding-top:" . esc_attr( get_theme_mod('progression_studios_post_title_padding_top', '350')- 40 ). "px;
			padding-bottom:" .  esc_attr( get_theme_mod('progression_studios_post_title_padding_bottom', '80')- 20 ). "px;
		}
		$progression_studios_header_bg_optional
		.progression-studios-transparent-header header#masthead-pro {
			$progression_studios_header_bg_image
			$progression_studios_header_bg_cover
		}
		$progression_studios_mobile_header_bg_color
		$progression_studios_mobile_header_logo_width
		$progression_studios_mobile_header_logo_margin_top
		$progression_studios_mobile_header_nav_padding_top
	}
	@media only screen and (min-width: 960px) and (max-width: ". esc_attr( get_theme_mod('progression_studios_site_width', '1200') + 100 ) . "px) {
		#progression-shopping-cart-count a.progression-count-icon-nav {
			margin-left:4px;
		}
		#video-search-header {
		width:94%;}
		.width-container-pro {
			width:94%;
			position:relative;
			padding:0px;
		}
		.progression-studios-header-full-width #progression-studios-header-width header#masthead-pro .width-container-pro,
		.progression-studios-header-full-width-no-gap #vayvo-progression-header-top .width-container-pro,
		footer#site-footer.progression-studios-footer-full-width .width-container-pro,
		.progression-studios-page-title-full-width #page-title-pro .width-container-pro,
		.progression-studios-header-full-width #vayvo-progression-header-top .width-container-pro {
			width:94%; 
			position:relative;
			padding:0px;
		}
		.progression-studios-header-full-width-no-gap.progression-studios-header-cart-width-adjustment header#masthead-pro .width-container-pro,
		.progression-studios-header-full-width.progression-studios-header-cart-width-adjustment header#masthead-pro .width-container-pro {
			width:98%;
			margin-left:2%;
			padding-right:0;
		}
		#vayvo-progression-header-top ul .sf-mega,
		header ul .sf-mega {
			margin-right:2%;
			width:98%; 
			left:0px;
			margin-left:auto;
		}
	}
	.progression-studios-spinner { border-left-color:" . esc_attr(get_theme_mod('progression_studios_page_loader_secondary_color', '#ededed')). ";  border-right-color:" . esc_attr(get_theme_mod('progression_studios_page_loader_secondary_color', '#ededed')). "; border-bottom-color: " . esc_attr(get_theme_mod('progression_studios_page_loader_secondary_color', '#ededed')). ";  border-top-color: " . esc_attr(get_theme_mod('progression_studios_page_loader_text', '#cccccc')). "; }
	.sk-folding-cube .sk-cube:before, .sk-circle .sk-child:before, .sk-rotating-plane, .sk-double-bounce .sk-child, .sk-wave .sk-rect, .sk-wandering-cubes .sk-cube, .sk-spinner-pulse, .sk-chasing-dots .sk-child, .sk-three-bounce .sk-child, .sk-fading-circle .sk-circle:before, .sk-cube-grid .sk-cube{ 
		background-color:" . esc_attr(get_theme_mod('progression_studios_page_loader_text', '#cccccc')). ";
	}
	#page-loader-pro {
		background:" . esc_attr(get_theme_mod('progression_studios_page_loader_bg', '#ffffff')). ";
		color:" . esc_attr(get_theme_mod('progression_studios_page_loader_text', '#cccccc')). "; 
	}
	$progression_studios_boxed_layout
	::-moz-selection {color:" . esc_attr( get_theme_mod('progression_studios_select_color', '#ffffff') ) . ";background:" . esc_attr( get_theme_mod('progression_studios_select_bg', '#22b2ee') ) . ";}
	::selection {color:" . esc_attr( get_theme_mod('progression_studios_select_color', '#ffffff') ) . ";background:" . esc_attr( get_theme_mod('progression_studios_select_bg', '#22b2ee') ) . ";}
	";
        wp_add_inline_style( 'progression-studios-custom-style', $progression_studios_custom_css );
}
add_action( 'wp_enqueue_scripts', 'progression_studios_customizer_styles' );
