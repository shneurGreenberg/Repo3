<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="progression-studios-default-blog-index">

		<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true)  ): ?>
			<div class="progression-studios-feaured-image video-progression-studios-format">
				<?php echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_post', true)); ?>
			</div>
		<?php else: ?>
	
			<?php if(has_post_thumbnail()): ?>
				<div class="progression-studios-feaured-image">
					<?php progression_studios_blog_link(); ?>
						<?php the_post_thumbnail('progression-studios-blog-index'); ?>
					</a>
				</div><!-- close .progression-studios-feaured-image -->
			<?php endif; ?><!-- close featured thumbnail -->
				
			
		<?php endif; ?><!-- close video -->
		
		<div class="progression-blog-content">
		
			<h2 class="progression-blog-title"><?php progression_studios_blog_title_link(); ?><?php the_title(); ?></a></h2>
			
			<?php if (get_theme_mod( 'progression_studios_blog_excerpt_display', 'true') == 'true') : ?>
			<div class="progression-studios-blog-excerpt">
				<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?>
					<?php if ( 'post' == get_post_type() ) : ?>
				<?php the_content( sprintf( wp_kses( __( 'Continue Reading <i class="fa fa-angle-right" aria-hidden="true"></i>', 'vayvo-progression' ), array(  'i' => array( 'id' => array(),  'class' => array(),  'style' => array(),  ), 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) ); ?>
				<?php endif; ?>
				<?php endif; ?>
			</div><!-- close .progression-studios-blog-excerpt -->
			<?php endif; ?>
			
			<div class="clearfix-pro"></div>
			
			
			<?php wp_link_pages( array(
				'before' => '<div class="progression-page-nav">' . esc_html__( 'Pages:', 'vayvo-progression' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			
			<div class="clearfix-pro"></div>
			
			
			<?php if ( 'post' == get_post_type() &&  get_theme_mod( 'progression_studios_blog_meta_hide', 'true') == 'true') : ?>
				<ul class="progression-post-meta">
					<?php if (get_theme_mod( 'progression_studios_blog_meta_author_display', 'true') == 'true') : ?><li class="blog-meta-author-display"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php the_author(); ?></a></li><?php endif; ?>
					
					<?php if ( get_theme_mod( 'progression_studios_blog_meta_date_display', 'true') == 'true' && 'post' == get_post_type() ) : ?>	
						<li class="blog-meta-date-list"><a href="<?php the_permalink(); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time(get_option('date_format')); ?></a></li>
					<?php endif; ?>
					
					
					<?php if (get_theme_mod( 'progression_studios_blog_index_meta_category_display', 'true') == 'true') : ?>
						<li class="blog-meta-category-list"><i class="fa fa-folder-open" aria-hidden="true"></i> <?php the_category(', '); ?></li>
					<?php endif; ?>


					<?php if (get_theme_mod( 'progression_studios_blog_meta_comment_display', 'true') == 'true') : ?><?php if ( comments_open() ) : ?><li class="blog-meta-comments"><?php comments_popup_link( '' . wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> 0 Comments', 'vayvo-progression' ), true ) . '', wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> 1 Comment', 'vayvo-progression' ), true), wp_kses( __( '<i class="fa fa-comments" aria-hidden="true"></i> % Comments', 'vayvo-progression' ), true ) ); ?></li><?php endif; ?><?php endif; ?>
				</ul>
				<div class="clearfix-pro"></div>
			<?php endif; ?>
			
			

			
			<?php if ( is_sticky() && is_home() && ! is_paged() ) { printf( '<div class="progression-studios-sticky-post">%s</div>', esc_html__( 'FEATURED', 'vayvo-progression' ) ); } ?>
			
			
		</div><!-- close .progression-blog-content -->
	
	
	<div class="clearfix-pro"></div>
	</div><!-- close .progression-studios-default-blog-index -->
</div><!-- #post-## -->