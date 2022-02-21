<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pro
 */

get_header(); ?>
	<?php
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$tax_term_breadcrumb_taxonomy_slug = $term->taxonomy;
	$term_photo = get_term_meta( $term->term_id, 'progression_studios_cast_Photo', true);
	$term_background = get_term_meta( $term->term_id, 'progression_studios_background_image', true);
	?>

	<div id="page-title-pro">
		<div id="progression-studios-page-title-container">
			<div class="width-container-pro">
				<h1 class="page-title"><?php if ( !empty( $term_photo ) ) : echo '<div id="skrn-video-cast-photo-taxonomy" style="background-image:url(' . $term_photo . ')"></div>'; endif; ?><?php echo esc_attr('' . $term->name . '');?></h1>
				<?php the_archive_description( '<h4 class="progression-sub-title">', '</h4>' ); ?>
			</div><!-- #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
		<div id="page-title-overlay-image" <?php if ( !empty( $term_background ) ) : echo ' style="background-image:url(' . $term_background . ')"'; endif; ?>></div>
	</div><!-- #page-title-pro -->
	
		<div id="content-pro" class="site-content">
			<div class="width-container-pro">
				
				<?php if ( have_posts() ) : ?>
					
					<div id="progression-studios-search-results-videos">
						<span><?php vayvo_progression_studios_search_video_counter(); ?></span> <?php echo esc_html__( 'Videos Found', 'vayvo-progression' ); ?>
					</div>
					
					<div class="progression-masonry-margins" style="margin-top:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px; margin-left:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px; margin-right:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px;">
						<div class="progression-studios-video-index-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr(get_theme_mod( 'progression_studios_blog_columns', '3')); ?>">
									<div class="progression-masonry-padding-blog" style="padding:<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px;">
										<div class="progression-studios-isotope-animation">
											<?php get_template_part( 'template-parts/content', 'skrn_video' ); ?>
										</div><!-- close .studios-isotope-animation -->
									</div><!-- close .progression-masonry-padding-blog -->
								</div><!-- cl ose .progression-masonry-item -->
							<?php endwhile; ?>
							<div class="clearfix-pro"></div>
							
						</div><!-- close .progression-studios-video-index-list -->
						
						</div><!-- close .progression-masonry-margins -->
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination' ) == 'default') : ?>
						<?php progression_studios_show_pagination_links_pro(); ?>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination', 'load-more') == 'load-more') : ?>
						<div id="progression-load-more-manual"><?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?></div>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'infinite-scroll') : ?>
						<?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?>
					<?php endif; ?>

					<div class="clearfix-pro"></div>
				<?php else : ?>
			
					<div class="progression-studios-video-index-none">
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					</div><!-- close .progression-video-index -->
			
				<?php endif; ?>
				
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>