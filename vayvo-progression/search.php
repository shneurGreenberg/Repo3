<?php
/**
 * The template for displaying search results pages.
 *
 * @package pro
 */

get_header(); ?>
	
	
	<div id="page-title-pro">
		<div id="progression-studios-page-title-container">
			<div class="width-container-pro">
				<h1 class="page-title"><?php printf( esc_html__( 'Search for: %s', 'vayvo-progression' ), '<span>' . get_search_query() . '</span>' ); ?>
				<?php if ( !have_posts() ) : ?><h4 class="progression-sub-title"><?php esc_html_e( 'No Results Found', 'vayvo-progression' ); ?></h4><?php endif; ?>
			</div><!-- #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
		<div id="page-title-overlay-image"></div>
	</div><!-- #page-title-pro -->
	

		<div id="content-pro" class="site-content">
			<div class="width-container-pro <?php if ( get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' ) : ?> left-sidebar-pro<?php endif; ?>">
				
					<?php if(get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' || get_theme_mod( 'progression_studios_blog_cat_sidebar', 'right-sidebar' ) == 'right-sidebar' ) : ?><div id="main-container-pro"><?php endif; ?>
				
				
						<?php if ( have_posts() ) : ?>
							<div class="progression-studios-blog-index">
								<?php while ( have_posts() ) : the_post(); ?>
									<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
								<?php endwhile; ?>
							</div><!-- close .progression-studios-blog-index -->
				
						<div class="clearfix-pro"></div>
				
							<?php progression_studios_show_pagination_links_pro(); ?>
				
				
							<div class="clearfix-pro"></div>
				
						<?php else : ?>
				
							<div class="progression-studios-blog-index">
								<?php get_template_part( 'template-parts/content', 'none' ); ?>
							</div><!-- close .progression-masonry-margins -->
				
						<?php endif; ?>
					
				
					<?php if(get_theme_mod( 'progression_studios_blog_cat_sidebar' ) == 'left-sidebar' || get_theme_mod( 'progression_studios_blog_cat_sidebar', 'right-sidebar' ) == 'right-sidebar' ) : ?></div><!-- close #main-container-pro --><?php get_sidebar(); ?><?php endif; ?>
				
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>