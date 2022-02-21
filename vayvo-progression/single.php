<?php
/**
 * The template for displaying all single posts.
 *
 * @package pro
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	

		<div id="page-title-pro">
			<div id="progression-studios-page-title-container">
				<div class="width-container-pro">

					<h1 class="page-title"><?php the_title(); ?></h1>						

					<?php if ( 'post' == get_post_type() ) : ?>
						<ul class="progression-single-post-meta">
							<?php if (get_theme_mod( 'progression_studios_blog_post_meta_author_display', 'true') == 'true') : ?><li class="blog-meta-author-display"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php the_author(); ?></a></li><?php endif; ?>
						
							<?php if ( get_theme_mod( 'progression_studios_blog_post_meta_date_display', 'true') == 'true' && 'post' == get_post_type() ) : ?><li class="blog-category-date-list"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time(get_option('date_format')); ?></a></li><?php endif; ?>

							<?php if (get_theme_mod( 'progression_studios_blog_post_index_meta_category_display', 'true') == 'true') : ?><li class="blog-single-category-display"><i class="fa fa-folder-open" aria-hidden="true"></i> <?php the_category(', '); ?></li><?php endif; ?>
								
							<?php if (get_theme_mod( 'progression_studios_blog_post_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><li class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> 0 comments', 'vayvo-progression' ), true ) . '', wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> 1 comment', 'vayvo-progression' ), true), wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> % comments', 'vayvo-progression' ), true ) ); ?></li><?php endif; ?><?php endif; ?>
						</ul>
						<div class="clearfix-pro"></div>
					<?php endif; ?>
					
				</div><!-- #progression-studios-page-title-container -->
				<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
			<div id="page-title-overlay-image" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-post-title'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?>></div>
		</div><!-- #page-title-pro -->
	
	<div id="content-pro" class="site-content-blog-post <?php if ( get_theme_mod( 'progression_studios_blog_post_sidebar', 'none') == 'none') : ?> disable-sidebar-post-progression<?php endif; ?>">

		<div class="width-container-pro <?php if ( get_theme_mod( 'progression_studios_blog_post_sidebar') == 'left') : ?>left-sidebar-pro<?php endif; ?>">
				
				<div id="main-container-pro">

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

				</div><!-- close #main-container-pro -->
				
				<?php get_sidebar(); ?>

				
		<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
		
		
		
		<?php get_template_part( 'template-parts/content', 'navigation' ); ?>
		
		
		<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?><div class="clearfix-pro"></div>
		
		
		
	</div><!-- #content-pro -->
		
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>