<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package pro
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div id="progression-studios-comments-background">
			<div class="width-container-pro">
				<div class="progression-single-width-container">
			<h3 class="comments-title">
				<?php
				$comment_count = get_comments_number();
				if ( 1 === $comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html_e( 'One comment', 'vayvo-progression' ),
						'<span>' . get_the_title() . '</span>'
					);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s comment', '%1$s comments', $comment_count, 'comments title', 'vayvo-progression' ) ),
						number_format_i18n( $comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
				?>
			</h4>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'vayvo-progression' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'vayvo-progression' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'vayvo-progression' ) ); ?></div>
				
					<div class="clearfix-pro"></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
			<?php endif; // check for comment navigation ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size' => 80,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Csomment navigation', 'vayvo-progression' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'vayvo-progression' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'vayvo-progression' ) ); ?></div>
				
					<div class="clearfix-pro"></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php endif; // check for comment navigation ?>
			
				</div><!-- close .progression-single-width-container -->
			</div><!-- close .width-container-pro -->
		</div><!-- close #progression-studios-comments-background -->

	<?php endif; // have_comments() ?>
	
	<div class="width-container-pro">
		<div class="progression-single-width-container">
			<?php comment_form(); ?>
		</div><!-- close .progression-single-width-container -->
	</div><!-- close .width-container-pro -->

</div><!-- #comments -->
