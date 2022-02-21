<?php
/**
 * @package pro
 */
?>
<section class="no-results-pro not-found-pro">
	
	<div class="page-content-pro">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'vayvo-progression' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			
			<div id="no-results-pro"><?php get_search_form(); ?></div>
			
			
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vayvo-progression' ); ?></p>

		<?php else : ?>
			
			<div id="no-results-pro"><?php get_search_form(); ?></div>
			
			
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'vayvo-progression' ); ?></p>
			
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->