<?php

/* Demo Content Import */
function progression_studios_demo_import_files() {
   return array(
     array(
       'import_file_name'           => 'Vayvo',
       'local_import_file'            => trailingslashit( get_template_directory() ) . '/inc/demo/content.xml',
       'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/inc/demo/widgets.wie',
       'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/inc/demo/theme_options.dat',
       'preview_url'                => 'https://vayvo.progressionstudios.com/',
     )
   );
}
add_filter( 'pt-ocdi/import_files', 'progression_studios_demo_import_files' );


/* Set Menu's and Blog Pages */
function progression_studios_demo_after_import_setup() {
	

	// Assign menus to their locations.
	$progession_studios_main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	$progession_studios_additional_menu = get_term_by( 'name', 'Additional Profile Menu Items', 'nav_menu' );
	$progession_studios_landing_page_menu = get_term_by( 'name', 'Landing Page Menu', 'nav_menu' );
	
	

	set_theme_mod( 'nav_menu_locations', array(
			'progression-studios-primary' => $progession_studios_main_menu->term_id,
			'progression-studios-profile-menu' => $progession_studios_additional_menu->term_id,
			'progression-studios-landing-page' => $progession_studios_landing_page_menu->term_id,
		)
	);

	//Sliders

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );


}
add_action( 'pt-ocdi/after_import', 'progression_studios_demo_after_import_setup' );


/* Disable Branding */
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );