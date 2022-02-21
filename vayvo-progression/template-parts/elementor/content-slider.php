<?php
/**
 * @package pro
 */
?>
<li class="<?php echo esc_attr($settings['progression_elements_slider_css3_animation'] ); ?>">
	
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="progression-studios-skrn-slider-background" <?php if( get_post_meta($post->ID, 'progression_studios_slider_header_image', true) ): ?>style="background-image:url('<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_slider_header_image', true)); ?>')"<?php else: ?><?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-video-header'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?><?php endif; ?>>
		
	
			<div class="progression-skrn-slider-elements-display-table">
				
				
				<div class="progression-skrn-slider-text-floating-container">
					<div class="progression-skrn-slider-container-max-width">
					<div class="progression-skrn-slider-content-floating-container">
					<div class="progression-skrn-slider-content-max-width">
						
						<div class="progression-skrn-slider-content-margins">
								<div class="progression-skrn-slider-content-alignment">
								<div class="progression-skrn-slider-progression-crowd-index-content">

									<h2 class="progression-vayvo-progression-slider-title"><?php progression_studios_blog_link(); ?><?php echo the_title(); ?></a></h2>
									
									<?php if ( $settings['progression_elements_video_meta'] == 'yes') : ?>
									<ul class="slider-video-post-meta-list">
										

										<?php if ( $settings['progression_elements_post_genre'] == 'yes') : ?>
										<?php 
											$terms = get_the_terms( $post->ID , 'video-genres' ); 
											if ( !empty( $terms ) ) :
												echo '<li class="slider-video-post-meta-cat"><ul>';
											foreach ( $terms as $term ) {
												$term_link = get_term_link( $term, 'video-genres' );
												if( is_wp_error( $term_link ) )
													continue;
												echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
											} 
											echo '</ul></li>';
										endif;
										?>
										<?php endif; ?>
										
										<?php if ( $settings['progression_elements_post_cat'] == 'yes') : ?>
										<?php 
											$terms = get_the_terms( $post->ID , 'video-category' ); 
											if ( !empty( $terms ) ) :
												echo '<li class="slider-video-post-meta-cat"><ul>';
											foreach ( $terms as $term ) {
												$term_link = get_term_link( $term, 'video-category' );
												if( is_wp_error( $term_link ) )
													continue;
												echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
											} 
											echo '</ul></li>';
										endif;
										?>
										<?php endif; ?>
										
										<?php if ( $settings['progression_elements_post_types'] == 'yes') : ?>
										<?php 
											$terms = get_the_terms( $post->ID , 'video-type' ); 
											if ( !empty( $terms ) ) :
												echo '<li class="slider-video-post-meta-cat"><ul>';
											foreach ( $terms as $term ) {
												$term_link = get_term_link( $term, 'video-type' );
												if( is_wp_error( $term_link ) )
													continue;
												echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
											} 
											echo '</ul></li>';
										endif;
										?>
										<?php endif; ?>
										
										<?php if ( $settings['progression_elements_post_rating'] == 'yes') : ?>
										<?php if( comments_open() ): ?>	
										<?php if ( skrn_pro_comment_rating_get_average_ratings( $post->ID ) ) : ?>
										<li class="slider-video-post-meta-reviews">
			
											
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
											

										</li>
										<?php endif; ?>
										<?php endif; ?>
										<?php endif; ?>
										
										
										<?php if ( $settings['progression_elements_post_release_date'] == 'yes') : ?>
										<?php if (get_theme_mod( 'progression_studios_media_releases_date_sidebar', 'true') == 'true') : ?>
										<?php if( get_post_meta($post->ID, 'progression_studios_release_date', true) ): ?>
											<li class="slider-video-post-meta-year"><?php 
													$video_release_date = get_post_meta($post->ID, 'progression_studios_release_date', true);
													echo esc_attr(date_i18n('Y',strtotime($video_release_date) )); ?></li>
										<?php endif; ?>
										<?php endif; ?>
										
										<?php if ( $settings['progression_elements_post_film_rating'] == 'yes') : ?>
										<?php if( get_post_meta($post->ID, 'progression_studios_film_rating', true)): ?>
											<li class="slider-video-post-meta-rating"><span><?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_film_rating', true)); ?></span></li>
										<?php endif; ?>
										<?php endif; ?>
									</ul>
									<?php endif; ?>
									<?php endif; ?>
									
									<div class="clearfix-pro"></div>
									<?php if ( $settings['progression_elements_post_excerpt'] == 'yes') : ?><?php if(has_excerpt() ): ?><div class="progression-studios-video-slider-excerpt"><?php the_excerpt(); ?></div><?php endif; ?><?php endif; ?>
									
									
									<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_text', true) ): ?>
										
										<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "link" ): ?>
										<a href="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?>" class="vayvo-progression-slider-button">
										<?php endif; ?>
										<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "external" ): ?>
											<a href="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?>" class="vayvo-progression-slider-button" target="_blank">
										<?php endif; ?>
										<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "youtube_video" ||  get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "vimeo_video" || get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "mp4_video" ) : ?>
											<a href="#SkrnLightbox-<?php the_ID(); ?>" class="vayvo-progression-slider-button afterglow" target="_blank">
										<?php endif; ?>

											<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_icon', true) ): ?><i class="fa fa-<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_icon', true)); ?>"></i><?php endif; ?><?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_text', true)); ?>
										</a>
						
									<?php endif; ?>
									
									<div class="clearfix-pro"></div>
								</div><!-- close .progression-skrn-slider-progression-crowd-index-content -->
								</div><!-- close .progression-skrn-slider-content-alignment -->
				
							<div class="clearfix-pro"></div>
						</div>
					</div><!-- close .progression-skrn-slider-content-max-width -->
					</div><!-- close .progression-skrn-slider-content-floating-container -->
					</div><!-- close .progression-skrn-slider-container-max-width -->
				</div><!-- close .progression-skrn-slider-text-floating-container -->


			</div><!-- close .progression-skrn-slider-elements-display-table -->
		
		
		
		
		
		
		
		<div style="display:none;">
			<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "youtube_video" ): ?>
         <video id="SkrnLightbox-<?php the_ID(); ?>"  <?php if( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true) ): ?>poster="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true)); ?>"<?php endif; ?> width="960" height="540" data-youtube-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?>">
         </video>
			<?php endif; ?>
			
			<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "vimeo_video" ): ?>
         <video id="SkrnLightbox-<?php the_ID(); ?>"  <?php if( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true) ): ?>poster="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true)); ?>"<?php endif; ?> width="960" height="540" data-vimeo-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?>">
         </video>
			<?php endif; ?>
			
			<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "mp4_video" ): ?>
         <video id="SkrnLightbox-<?php the_ID(); ?>"  <?php if( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true) ): ?>poster="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_optional_locally_hosted_mp4_button', true)); ?>"<?php endif; ?> width="960" height="540">
				<source src="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?>" type="video/mp4">
         </video>
			<?php endif; ?>
			
		</div>
		
		
		
		<div class="slider-background-overlay-color"></div>
		<a href="<?php the_permalink(); ?>" class="vayvo-slider-background-link"></a>
	
		
		
		<?php if ( $settings['progression_elements_slider_reflection'] == 'yes') : ?><div class="progression-studios-skrn-slider-upside-down" <?php if( get_post_meta($post->ID, 'progression_studios_slider_header_image', true) ): ?>style="background-image:url('<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_slider_header_image', true)); ?>')"<?php else: ?><?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-video-header'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?><?php endif; ?>></div><?php endif; ?>
		
		
		
		<?php if ( $settings['progression_elements_slider_play_button'] == 'yes') : ?>
		<a href="<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) != "no-button" ): ?><?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "youtube_video" ||  get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "vimeo_video" || get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "mp4_video" ) : ?>#SkrnLightbox-<?php the_ID(); ?><?php else: ?><?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_slider_btn_link', true)); ?><?php endif; ?><?php else: ?><?php the_permalink(); ?><?php endif; ?>" class="slider-video-page-title-play-button<?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "youtube_video" ||  get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "vimeo_video" || get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "mp4_video" ) : ?> afterglow<?php endif; ?>" <?php if( get_post_meta($post->ID, 'progression_studios_slider_btn_target', true) == "external" ): ?>target="_blank"<?php endif; ?>><i class="fa fa-play"></i></a>
		<?php endif; ?>
		
	<div class="clearfix-pro"></div>
	</div><!-- close .progression-studios-skrn-slider-background -->
</div><!-- #post-## -->

</li>