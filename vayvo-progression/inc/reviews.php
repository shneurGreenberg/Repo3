<?php



//Rating Calculation
add_action( 'comment_post', 'skrn_progression_studios_update_average_ratings', 999 );
function skrn_progression_studios_update_average_ratings( $comment_id ) {
	$comment = get_comment( $comment_id );
	$comment_post_id = $comment->comment_post_ID ;
	$rating = skrn_pro_comment_rating_get_average_ratings( $comment_post_id );
	update_post_meta( $comment_post_id, '_average_ratings', $rating );
}

add_action( 'init', 'skrn_progression_studios_update_average_ratings_update', 10 );
function skrn_progression_studios_update_average_ratings_update() {
	if( isset( $_GET['giang'] ) ) {
		$posts = get_posts(array(
			'post_type'	=> 'video_skrn',
			'posts_per_page'	=> -1
		));
		foreach( $posts as $post ) {
			$rating = skrn_pro_comment_rating_get_average_ratings( $post->ID );
			update_post_meta( $post->ID, '_average_ratings', $rating );
		}
	}
}

add_action('wp_head', 'skrn_progression_studios_update_average_ratings_post');
function skrn_progression_studios_update_average_ratings_post(){
	global $post;
	if( is_singular("video_skrn") ){
		$rating = skrn_pro_comment_rating_get_average_ratings( $post->ID );
		update_post_meta( $post->ID, '_average_ratings', $rating );
	}
}




function skrn_custom_count_post_by_author($reiew_count_args){
	$comments_query = new WP_Comment_Query;
	$comments = $comments_query->query( $reiew_count_args );

	$count = 0;
	if ( $comments ) {
	foreach ( $comments as $comment ) {
		$count++;
	}
	}
   return $count;
}





add_filter( 'comment_author', 'custom_comment_author', 10, 2 );
function custom_comment_author( $author, $commentID ) {

    $comment = get_comment( $commentID );
    $user = get_user_by( 'email', $comment->comment_author_email );

    if( !$user ):

        return $author;

    else:

        $firstname = get_user_meta( $user->ID, 'first_name', true );
        $lastname = get_user_meta( $user->ID, 'last_name', true );

        if( empty( $firstname ) OR empty( $lastname ) ):

            return $author;

        else:

            return $firstname . ' ' . $lastname;

        endif;

    endif;

}

function progression_studios_moderation( $comment, $args, $depth )
{
    ?>


	<?php if (0 == $comment->comment_approved) { ?>
	<div id="review-awaiting-moderation"><?php echo esc_html_e( 'Your review is currently awaiting moderation.', 'vayvo-progression' ); ?></div>
	<?php } ?>


    <?php
}



function progression_studios_review_fullscreen( $comment, $args, $depth )
{
    ?>

  	<li>
 		<div class="progression-studios-sidebar-review-container">
 			<?php $rating_formatted_edit = get_comment_meta( get_comment_ID(), 'rating', true );?>

 			<!--div id="sidebar-review-number"><?php echo number_format((float)$rating_formatted_edit, 0, '.', '');	?></div-->
 			<div id="sidebar-review-rating-container">
 				<div class="average-rating-video-post">
 					<div class="average-rating-video-empty">
 						<span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span>
 					</div>
 					<div class="average-rating-overflow-width" style="width:<?php echo (esc_attr($rating_formatted_edit) / 5 * 100) ;	?>%;">
 						<div class="average-rating-video-filled">
 							<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>
 						<div class="clearfix-pro"></div>
 						</div><!-- close .average-rating-video-filled -->
 					</div><!-- close .average-rating-overflow-width -->
 				</div>
 			</div>


			<div class="skrn-review-full-avatar"><?php echo get_avatar( $comment, 30 ); ?></div>
 	 		<h5 id="sidebar-review-author"><?php printf( get_comment_author_link() ); ?></h5>
 	 		<h6 id="sidebar-review-date"><?php echo esc_html( get_comment_date( get_option('date_format'), $comment->comment_ID ) ); ?></h6>
            <?php $notUse = false; ?>
            <?php if($notUse):?>
                <?php
                $spoiler = get_comment_meta( $comment->comment_ID, 'spoiler', true );
                if ( $spoiler == 'on' || $spoiler == '1'  ) : ?><div class="spoiler-review"><?php esc_html_e( 'Contains Spoiler', 'vayvo-progression' ); ?></div><?php endif; ?>

                <?php
                    $comment_text_count = strip_tags( get_comment_text() );
                    $comment_text_number = explode(' ', $comment_text_count);
                ?>


                <div class="sidebar-comment-exerpt<?php if (count($comment_text_number)  > 20 ) : ?> sidebar-excerpt-more-click<?php endif; ?>">
                    <div class="sidebar-comment-exerpt-text"><?php echo get_comment_excerpt(); ?></div>
                    <?php if (count($comment_text_number)  > 20 ) : ?>
                        <div class="read-more-comment-sidebar"><?php echo esc_html__( 'Read more', 'vayvo-progression' )?></div>
                        <div class="sidebar-comment-full"><?php echo get_comment_text(); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

 		</div><!-- close .progression-studios-sidebar-review-container -->
  	</li>


    <?php
}



/**
 * Display comment in home & archive page
 * https://deluxeblogtips.com/display-comments-in-homepage/
 *
 * @return void
 */
function progression_studios_review_sidebar( $comment, $args, $depth )
{
    ?>

 	<li>
		<div class="progression-studios-sidebar-review-container">
			<?php $rating_formatted_edit = get_comment_meta( get_comment_ID(), 'rating', true );?>

			<!--div id="sidebar-review-number"><?php echo number_format((float)$rating_formatted_edit, 0, '.', '');	?></div-->
			<div id="sidebar-review-rating-container">
				<div class="average-rating-video-post">
					<div class="average-rating-video-empty">
						<span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span>
					</div>
					<div class="average-rating-overflow-width" style="width:<?php echo (esc_attr($rating_formatted_edit) / 5 * 100) ;	?>%;">
						<div class="average-rating-video-filled">
							<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>
						<div class="clearfix-pro"></div>
						</div><!-- close .average-rating-video-filled -->
					</div><!-- close .average-rating-overflow-width -->
				</div>
			</div>


	 		<h5 id="sidebar-review-author"><?php printf( get_comment_author_link() ); ?></h5>
	 		<h6 id="sidebar-review-date"><?php echo esc_html( get_comment_date( get_option('date_format'), $comment->comment_ID ) ); ?></h6>

			<?php
			$spoiler = get_comment_meta( $comment->comment_ID, 'spoiler', true );
			if ( $spoiler == 'on' || $spoiler == '1'  ) : ?><div class="spoiler-review"><?php esc_html_e( 'Contains Spoiler', 'vayvo-progression' ); ?></div><?php endif; ?>

			<?php
				$comment_text_count = strip_tags( get_comment_text() );
				$comment_text_number = explode(' ', $comment_text_count);
			?>


	 		<div class="sidebar-comment-exerpt<?php if (count($comment_text_number)  > 20 ) : ?> sidebar-excerpt-more-click<?php endif; ?>">
				<div class="sidebar-comment-exerpt-text"><?php echo get_comment_excerpt(); ?></div>
		 		<?php if (count($comment_text_number)  > 20 ) : ?>
					<div class="read-more-comment-sidebar"><?php echo esc_html__( 'Read more', 'vayvo-progression' )?></div>
					<div class="sidebar-comment-full"><?php echo get_comment_text(); ?></div>
				<?php endif; ?>
			</div>


		</div><!-- close .progression-studios-sidebar-review-container -->
 	</li>


    <?php
}
