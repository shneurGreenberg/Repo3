<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="progression-studios-video-index-container">
		<?php progression_studios_blog_link(); ?>
		
			<?php if(has_post_thumbnail()): ?>
				<div class="progression-studios-video-feaured-image"><?php the_post_thumbnail('progression-studios-video-index'); ?></div><!-- close .progression-studios-feaured-image -->
			<?php endif; ?><!-- close featured thumbnail -->
		
			<div class="progression-video-index-content">
		
				<div class="progression-video-index-table">
					<div class="progression-video-index-vertical-align">
						<h2 class="progression-video-title"><?php the_title(); ?></h2>
						

						
						<?php if ( $settings['progression_elements_post_display_genres'] == 'yes') : ?>
						<?php 
							$terms = get_the_terms( $post->ID , 'video-genres' ); 
							if ( !empty( $terms ) ) :
								echo '<ul class="video-index-meta-taxonomy">';
							foreach ( $terms as $term ) {
								$term_link = get_term_link( $term, 'video-genres' );
								if( is_wp_error( $term_link ) )
									continue;
								echo '<li>' . $term->name . '</li>';
							} 
							echo '</ul>';
						endif;
						?>
						<?php endif; ?>
						
						<?php if ( $settings['progression_elements_post_display_categories'] == 'yes') : ?>
						<?php 
							$terms = get_the_terms( $post->ID , 'video-category' ); 
							if ( !empty( $terms ) ) :
								echo '<ul class="video-index-meta-taxonomy">';
							foreach ( $terms as $term ) {
								$term_link = get_term_link( $term, 'video-category' );
								if( is_wp_error( $term_link ) )
									continue;
								echo '<li>' . $term->name . '</li>';
							} 
							echo '</ul>';
						endif;
						?>
						<?php endif; ?>
						
						<?php if ( $settings['progression_elements_post_display_types'] == 'yes') : ?>
						<?php 
							$terms = get_the_terms( $post->ID , 'video-type' ); 
							if ( !empty( $terms ) ) :
								echo '<ul class="video-index-meta-taxonomy">';
							foreach ( $terms as $term ) {
								$term_link = get_term_link( $term, 'video-type' );
								if( is_wp_error( $term_link ) )
									continue;
								echo '<li>' . $term->name . '</li>';
							} 
							echo '</ul>';
						endif;
						?>
						<?php endif; ?>

					    <div class="clearfix-pro"></div>
                        <?php if ( $settings['progression_elements_post_show_rating'] == 'yes') : ?>
                            <?php if ( skrn_pro_comment_rating_get_average_ratings( $post->ID ) ) : ?>
                                <?php $rating_edit_format = skrn_pro_comment_rating_get_average_ratings( $post->ID );  ?>
                                <div class="average-rating-video-post">
                                    <div class="average-rating-video-empty">
                                        <span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span>
                                    </div>
                                    <div class="average-rating-overflow-width" style="width:<?php echo (esc_attr($rating_edit_format) / 5 * 100) ;	?>%;">
                                        <div class="average-rating-video-filled">
                                            <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>
                                            <div class="clearfix-pro"></div>
                                        </div><!-- close .average-rating-video-filled -->
                                    </div><!-- close .average-rating-overflow-width -->
                                </div>
                                <div class="clearfix"></div>
                            <?php endif; ?>
                        <?php endif; ?>
					</div><!-- close .progression-video-index-vertical-align -->
				</div><!-- close .progression-video-index-table -->
			</div><!-- close .progression-video-index-content -->
			
			<div class="video-index-border-hover"></div>
		</a>
	</div><!-- close .progression-studios-video-index-container -->
</div><!-- #post-## -->