<?php
/**
 * @package pro
 */
?>


			<?php  $terms = get_the_terms( $post->ID , 'video-genres' );  if ( !empty( $terms ) ) :?>
			<?php
			global $post;
			$current_post_type = get_post_type( $post );

			$terms = get_the_terms( $post->ID , 'video-genres' );
			$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
			$post_count_skrn = get_theme_mod('progression_studios_media_more_like_post_count', '2');

			$args=array(
			'post_type' => $current_post_type,
			'posts_per_page'=> $post_count_skrn, // Number of related posts that will be displayed.
			'orderby'=>'rand', // Randomize the posts
			'post__not_in' => array( $post->ID ),
			'tax_query' => array(
			        array(
			            'taxonomy'  => 'video-genres',
			            'terms'     => $term_ids,
						'field' => 'id',
			            'operator'  => 'IN'
			        )
			    ),
			);

			$rel_query = new WP_Query( $args ); if( $rel_query->have_posts() ) :
			?>
			<div id="video-more-like-this-details-section">
				<h3 id="more-videos-heading"><?php esc_html_e( 'More Like This', 'vayvo-progression' ); ?></h3>

				<div class="progression-masonry-margins" style="margin-top:-3px; margin-left:-3px; margin-right:-3px;">
					<div class="progression-studios-video-index-list">
						<?php  while ( $rel_query->have_posts() ) : $rel_query->the_post(); ?>

							<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr( get_theme_mod('progression_studios_media_more_like_columns', '2') ); ?>">
								<div class="progression-masonry-padding-blog" style="padding:3px;">
									<div class="progression-studios-isotope-animation">
										<?php get_template_part( 'template-parts/content', 'skrn_video'); ?>
									</div><!-- close .studios-isotope-animation -->
								</div><!-- close .progression-masonry-padding-blog -->
							</div><!-- cl ose .progression-masonry-item -->
						<?php endwhile; ?>
					</div><!-- close .progression-blog-index-masonry -->
				</div><!-- close .progression-masonry-margins -->

				<div class="clearfix-pro"></div>


			</div><!-- close #video-more-like-this-details-section -->
			<?php endif;			wp_reset_postdata();  ?>
			<?php endif; ?>
