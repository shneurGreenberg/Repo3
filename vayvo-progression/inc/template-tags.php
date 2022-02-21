<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pro
 */



if ( class_exists( 'ARM_access_rules' ) ) {

	function progression_arm_get_plan_from_post_id( $post_id = '' ){
	    if( empty($post_id) ){
	        return;
	    }

	    global $wpdb, $ARMember;

	    $planId = $wpdb->get_row( $wpdb->prepare( "SELECT arm_subscription_plan_id FROM `" . $ARMember->tbl_arm_subscription_plans . "` WHERE arm_subscription_plan_post_id = %d AND arm_subscription_plan_is_delete = %d", $post_id, 0 ) );

	    if( isset( $planId->arm_subscription_plan_id ) ){
	        return $planId->arm_subscription_plan_id;
	    } else {
	        return '';
	    }

	}
	
}

//Jetpack Lazy  Loading Support
add_filter( 'jetpack_lazy_images_blacklisted_classes', 'progression_studios_exclude_lazy_load', 999, 1 );    
function progression_studios_exclude_lazy_load( $classes ) {
    $classes[] = 'attachment-progression-studios-blog-index';
    $classes[] = 'size-progression-studios-video-index';
	 $classes[] = 'boosted-elements-progression-image';
	 $classes[] = 'skip-lazy-loading';
    return $classes;
} 

/* Edit Profile Link */
function progression_studios_profile_link() {
	global $current_user; wp_get_current_user(); echo get_author_posts_url($current_user->ID); 
}




/* custom archive/taxonomy video posts per page */
function progression_studios_video_post_count( $query ) {
	$skrn_video_count = get_theme_mod('progression_studios_media_posts_page', '12');
	
	if ($query->is_main_query()){
	
	if( is_tax( 'video-type') || is_tax( 'video-genres') || is_tax( 'video-category') || is_tax( 'video-director') || is_tax( 'video-cast') ){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $skrn_video_count);
    }
	}

	if( is_post_type_archive( 'video_skrn' ) && !is_admin() ){
      $query->set('posts_per_page', $skrn_video_count);
    }
	 
	
  }
add_action( 'pre_get_posts', 'progression_studios_video_post_count' );


function vayvo_progression_studios_search_video_counter() {
	$count = $GLOBALS['wp_query']->found_posts; echo esc_attr($count);
}

/* Filters for Video Embeds */
add_filter( 'progression_studios_video_content_filter', array( $wp_embed, 'autoembed' ), 8 );
add_filter( 'progression_studios_video_content_filter', 'wptexturize'       );
add_filter( 'progression_studios_video_content_filter', 'convert_smilies'   );
add_filter( 'progression_studios_video_content_filter', 'convert_chars'     );
add_filter( 'progression_studios_video_content_filter', 'wpautop'           );
add_filter( 'progression_studios_video_content_filter', 'shortcode_unautop' );
add_filter( 'progression_studios_video_content_filter', 'do_shortcode'      );


function is_progression_studios_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_tag() || is_search() );
}


/* Logo */
function progression_studios_logo() {
	global $post;
?>
	<?php if ( get_theme_mod( 'progression_studios_logo_link_override') ) : ?><a href="<?php echo esc_url( get_theme_mod( 'progression_studios_logo_link_override') ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php else: ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php endif ?>
		
	<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true)): ?>
		<img src="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_custom_page_logo', true) );?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-default-logo <?php if ( get_theme_mod( 'progression_studios_mobile_custom_logo_per_page', 'hide') == 'hide') : ?>progression-studios-hide-mobile-custom-logo<?php else: ?> progresion-studios-still-hide-onsticky<?php endif; ?><?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?> progression-studios-default-logo-hide<?php endif; ?>">
	<?php endif; ?>	

	<?php if ( get_theme_mod( 'progression_studios_theme_logo', get_template_directory_uri() . '/images/logo.png' ) ) : ?>
		<img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_theme_logo', get_template_directory_uri() . '/images/logo.png' ) ); ?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-default-logo<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true)): ?> progression-studios-custom-logo-per-page-hide-default<?php endif; ?>	<?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?> progression-studios-default-logo-hide<?php endif; ?> <?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true) && get_theme_mod( 'progression_studios_mobile_custom_logo_per_page') == 'display'): ?> progression-studios-hide-custom-logo-mobile<?php endif; ?>">
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?>
		<img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_sticky_logo') ); ?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-sticky-logo">
	<?php endif; ?>
	</a>
<?php
}



/* Header/Page Title Options */
function progression_studios_page_title() {
	global $post;
?>
	class="
		<?php if ( is_page() && is_page_template('page-landing.php') ) : ?><?php if ( get_theme_mod( 'progression_studios_landing_absolute', 'true') == 'true') : ?> progression-studios-overlay-header-landing<?php endif; ?><?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_header_force_transparent', 'false') == 'true') : ?> progression-studios-overlay-header<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_header_box_shadow', 'false') == 'true') : ?> progression-studios-header-shadow<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_sticky_header_box_shadow', 'true') == 'true') : ?> progression-studios-sticky-header-shadow<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_mobile_header_transparent') == 'transparent') : ?> progression-studios-mobile-transparent-header<?php endif; ?>
		<?php echo esc_attr( get_theme_mod( 'progression_studios_header_width', 'progression-studios-header-full-width-no-gap') ); ?> 
		<?php if ( get_theme_mod( 'progression_studios_post_page_title_align', 'center') == 'center') : ?> progression-studios-blog-post-title-center<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_nav_search', 'on') == 'off') : ?> progression-studios-search-icon-off<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_nav_cart') == 'off') : ?> progression-studios-nav-cart-icon-off<?php endif; ?>
		<?php echo esc_attr( get_theme_mod( 'progression_studios_logo_position', 'progression-studios-logo-position-left') ); ?> 
		<?php echo esc_attr( get_theme_mod('progression_studios_page_title_width') ); ?> 
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_header_disabled', true)): ?> progression-disable-header-per-page<?php endif; ?>
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_disable_footer_per_page', true)): ?> progression-disable-footer-per-page<?php endif; ?>		
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_disable_logo_page_title', true)): ?> progression-disable-logo-below-per-page<?php endif; ?>
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_header_transparent_float', true)): ?> progression-studios-transparent-header<?php endif; ?>
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_nav_color', true)): ?> <?php echo esc_html( get_post_meta($post->ID, 'progression_studios_custom_page_nav_color', true) );?><?php endif; ?>
		<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_header_transparent', true)): ?> progression-studios-transparent-header<?php endif; ?>
		<?php if ( get_theme_mod( 'progression_studios_one_page_nav') == 'on') : ?> progression-studios-one-page-nav<?php else: ?>	progression-studios-one-page-nav-off<?php endif; ?>
		<?php if (get_theme_mod( 'progression_studios_page_transition', 'transition-off-pro') == "transition-on-pro") : ?> progression-studios-preloader<?php endif; ?>
			
		<?php if ( get_theme_mod( 'progression_studios_sub_nav_bullet_effect') == 'false') : ?> progression-studios-sub-menu-hover-off<?php endif; ?>
	"
<?php
}


function progression_studios_navigation() {
?>
	
	<?php if (get_theme_mod( 'progression_studios_header_sticky', 'none-sticky-pro' ) == 'sticky-pro' && get_theme_mod( 'progression_studios_logo_position', 'progression-studios-logo-position-left' ) == 'progression-studios-logo-position-center' ) : ?><div id="progression-sticky-header"><?php endif; ?>
	
	<div class="optional-centered-area-on-mobile">

		
		<?php if ( get_theme_mod( 'progression_studios_icon_position') == 'default' ) : ?><?php if (function_exists( 'progression_studios_elements_social') )  : ?><div id="progression-header-icons-inline-display"><?php progression_studios_elements_social(); ?></div><?php endif; ?><?php endif; ?>
	
		<div class="mobile-menu-icon-pro noselect"><i class="fa fa-bars"></i><?php if (get_theme_mod( 'progression_studios_mobile_menu_text') == 'on' ) : ?><span class="progression-mobile-menu-text"><?php echo esc_html__( 'Menu', 'vayvo-progression' )?></span><?php endif; ?></div>
		
		<?php get_template_part( 'header/profile', 'menu' ); ?>
		
		<div id="progression-studios-header-search-icon" class="noselect">
			<div class="progression-icon-search"></div>
		</div>
		

		
		<div id="progression-nav-container">
			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( array('theme_location' => 'progression-studios-primary', 'menu_class' => 'sf-menu', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?><div class="clearfix-pro"></div>
			</nav>
			<div class="clearfix-pro"></div>
		</div><!-- close #progression-nav-container -->
		
		

		
		<div class="clearfix-pro"></div>
	</div><!-- close .width-container-pro -->
	
	<?php if (get_theme_mod( 'progression_studios_header_sticky', 'none-sticky-pro' ) == 'sticky-pro' && get_theme_mod( 'progression_studios_logo_position', 'progression-studios-logo-position-left' ) == 'progression-studios-logo-position-center' ) : ?></div><?php endif; ?>
		
<?php
}




function progression_studios_blog_link() {
	global $post;
?>

	<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url'): ?>
		
		<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>">
			
		<?php else: ?>
			
		<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url_new_window'): ?>
			
			<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>" target="_blank">
			
			<?php else: ?>
				
				<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_lightbox'): ?>
					
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
					<a href="<?php echo esc_attr($image[0]);?>" <?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt; if(!empty($get_description)){ echo 'title="' . $get_description . '"'; } ?>>
						
					<?php else: ?>

						<a href="<?php the_permalink(); ?>">
					
					<?php endif; ?>
						
		<?php endif; ?>
		
	<?php endif; ?>
	
<?php
}


function progression_studios_blog_title_link() {
	global $post;
?>

	<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url'): ?>
		
		<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>">
			
		<?php else: ?>
			
		<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url_new_window'): ?>
			
			<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>" target="_blank">
			
			<?php else: ?>
				

						<a href="<?php the_permalink(); ?>">
					
				
		<?php endif; ?>
		
	<?php endif; ?>
	
<?php
}


function progression_studios_blog_overlay_link() {
	global $post;
?>

	<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url'): ?>
		
		<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-overlay'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?> class="progression-studios-overlay-blog-index">
			
		<?php else: ?>
			
		<?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url_new_window'): ?>
			
			<a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>" target="_blank" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-overlay'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?> class="progression-studios-overlay-blog-index">
			
			<?php else: ?>

				<a href="<?php the_permalink(); ?>" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-overlay'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?> class="progression-studios-overlay-blog-index">
						
		<?php endif; ?>
		
	<?php endif; ?>
	
<?php
}

// retrieves the attachment ID from the file URL
function progression_studios_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

/* remove more link jump */
function progression_studios_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'progression_studios_remove_more_link_scroll' );




if ( ! function_exists( 'progression_studios_show_pagination_links_pro' ) ) :
function progression_studios_show_pagination_links_pro()
{
    global $wp_query;

    $page_tot   = $wp_query->max_num_pages;
    $page_cur   = get_query_var( 'paged' );
    $big        = 999999999;

    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $page_cur ),
            'total'     => $page_tot,
            'prev_next' => true,
				'prev_text'    => '<span>' . esc_html__('&lsaquo; Previous', 'vayvo-progression') . '</span>',
				'next_text'    => '<span>' . esc_html__('Next &rsaquo;', 'vayvo-progression'). '</span>',
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}
endif;



if ( ! function_exists( 'progression_studios_show_pagination_links_blog' ) ) :
function progression_studios_show_pagination_links_blog()
{	
    global $blogloop;

    $page_tot   = $blogloop->max_num_pages;
	 if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {   $paged = get_query_var('page'); } else {  $paged = 1; }
    $big        = 999999999;

    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $paged ),
            'total'     => $page_tot,
            'prev_next' => true,
				'prev_text'    => '<span>' . esc_html__('&lsaquo; Previous', 'vayvo-progression') . '</span>',
				'next_text'    => '<span>' . esc_html__('Next &rsaquo;', 'vayvo-progression'). '</span>',
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}
endif;




if ( ! function_exists( 'progression_studios_infinite_content_nav_pro' ) ) :
function progression_studios_infinite_content_nav_pro( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="infinite-nav-pro-default" class="infinite-nav-pro">
			<div class="nav-previous"><?php next_posts_link( wp_kses( __('Load More <span><i class="fa fa-arrow-circle-down"></i></span>', 'vayvo-progression' ) , TRUE) ); ?></div>
		</div>
	<?php endif;
}
endif;






function progression_studios_category_title( $title ) {
   if ( is_category() ) {

           $title = single_cat_title( '', false );

       } elseif ( is_tag() ) {

           $title = single_tag_title( '', false );

       }

   return $title;
}
add_filter( 'get_the_archive_title', 'progression_studios_category_title' );



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function progression_studios_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'progression_studios_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'progression_studios_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so progression_studios_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so progression_studios_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in progression_studios_categorized_blog.
 */
function progression_studios_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'progression_studios_categories' );
}
add_action( 'edit_category', 'progression_studios_category_transient_flusher' );
add_action( 'save_post',     'progression_studios_category_transient_flusher' );
