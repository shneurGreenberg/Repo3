<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="progression-single-width-container">
		<div id="progression-blog-single-content">

			<?php the_content(); ?>
			
			<div class="clearfix-pro"></div>
			
			<div id="progression-studios-sharing-and-tags-container">
				<?php the_tags(  '<div class="tags-progression-studios"><span><i class="fa fa-tags"></i></span>', ', ', '</div>' ); ?>
				<div class="clearfix-pro"></div>
			</div><!-- close #progression-studios-sharing-and-tags-container -->
			

			<?php wp_link_pages( array(
				'before' => '<div class="progression-page-nav">' . esc_html__( 'Pages:', 'vayvo-progression' ),
				'after'  => '</div><div class="clearfix-pro"></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			

		</div><!-- close #progression-blog-content -->
	</div><!-- close .progression-single-width-container -->
</div><!-- #post-## -->