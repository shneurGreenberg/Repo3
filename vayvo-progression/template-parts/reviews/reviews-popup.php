<?php
/**
 * @package pro
 */

$comment_count_pro = get_comments_number();
?>

<div id="comment-review-pop-up-fullscreen">
	<div id="close-pop-up-full-review-skrn"><span></span></div>
	<div id="comment-review-pop-up-container">
		<div id="comment-review-pop-up-padding">

			<div id="comment-review-popup-heading">
				<div class="grid2column-progression">
					<h2><?php esc_html_e( 'Reviews for', 'vayvo-progression' ); ?> <?php the_title(); ?></h2>
				</div>
				<div class="grid2column-progression lastcolumn-progression">
					<?php if ( skrn_pro_comment_rating_get_average_ratings( $post->ID ) ) : ?>
						<?php $rating_edit_format = skrn_pro_comment_rating_get_average_ratings( $post->ID );  ?>
						<!--div id="average-rating-number-form"><?php echo number_format((float)$rating_edit_format, 1, '.', '');	?></div-->
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

							<!--h6><?php echo number_format((float)$rating_edit_format, 1, '.', '');	?> <?php esc_html_e( 'out of 5', 'vayvo-progression' ); ?></h6-->
							<h6><?php comments_number( esc_html__('No Reviews', 'vayvo-progression') , esc_html__('1 Review','vayvo-progression'), esc_html__('% Reviews','vayvo-progression')); ?></h6>
						</div>

						<div class="clearfix"></div>
					<?php endif; ?>
				</div>
				<div class="clearfix-pro"></div>
			</div><!-- close #comment-review-popup-heading -->


			<?php
			global $current_user;

			$usercomment = get_comments( array (
			            'user_id' => $current_user->ID,
			            'post_id' => $post->ID,
			    ) );;

			if( is_user_logged_in() && !$usercomment ):
			?>


			<div id="comment-review-form-container">

				<button href="#" class="button">
					<?php esc_html_e( 'Write a Review ', 'vayvo-progression' ); ?>
				</button>

				<div id="comment-review-form-submit">
					<?php

					$comment_args = array(
						'title_reply'=> '',
						'label_submit'=> esc_html__( 'Submit Review', 'vayvo-progression' ),


					'comment_field' => '<p>' .


//					'<textarea id="comment" name="comment" cols="45" rows="4" required="required" placeholder="' . esc_html__( "Write your review here...", 'vayvo-progression' ) . ' "></textarea>' .

					'</p>',

					'comment_notes_after' => "",

					);


					comment_form($comment_args);
					?>
				</div>
			</div><!-- close #comment-review-form-container -->
			<?php endif; ?>



		<?php
		//https://deluxeblogtips.com/display-comments-in-homepage/
		$comments = get_comments( array(
			'user_id' => $current_user->ID,
		    'post_id' => get_the_ID(),
		) );

    	wp_list_comments( array(
			'per_page'          => '1',
			'callback' => 'progression_studios_moderation',
			'type'     => 'comment',
		), $comments );
		?>



			<?php if( $comment_count_pro >= 1  ): ?>

			<?php else: ?>
				<div id="no-review-skrn-pro"><?php echo esc_html_e( 'There are currently no reviews for ', 'vayvo-progression' ); ?> <?php the_title(); ?></div>
			<?php endif; ?>

				<?php

				if( $comment_count_pro >= 1  ): ?>
					<ul class="fullscreen-reviews-pro">
						<?php
						//https://deluxeblogtips.com/display-comments-in-homepage/
						$comments = get_comments( array(
						    'post_id' => get_the_ID(),
						    'status' => 'approve',
						) );

				    	wp_list_comments( array(
							'per_page'          => '999',
							'callback' => 'progression_studios_review_fullscreen',
							'type'     => 'comment',
						), $comments );


						?>
					</ul>
				<?php endif; ?>

			<div class="clearfix-pro"></div>
		</div><!-- close #comment-review-pop-up-padding -->
	</div><!-- close #comment-review-pop-up-container -->
</div><!-- close #comment-review-pop-up-fullscreen -->
