<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package pro
 * @since pro 1.0
 */
?>

	<?php if ( is_page() && is_page_template('page-landing.php') ) : ?>
	<?php else: ?>
	<?php if (get_theme_mod( 'progression_studios_footer_elementor_library') && !is_singular( 'elementor_library') ) : ?>
		<div id="progression-studios-footer-page-builder">
			<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_disable_footer_per_page', true)): ?><?php else: ?>
			<?php
			if( function_exists( 'elementor_load_plugin_textdomain' ) ) {
			$progression_studios_elementor_footer_instance = Elementor\Plugin::instance();
			echo $progression_studios_elementor_footer_instance->frontend->get_builder_content_for_display( get_theme_mod( 'progression_studios_footer_elementor_library') );
			}
			?><?php endif; ?>
		</div>
	<?php else: ?>
		<footer id="site-footer" class="progression-studios-footer-normal-width <?php echo esc_attr( get_theme_mod('progression_studios_footer_copyright_location', 'footer-copyright-align-center') ); ?>">
			<div id="progression-studios-copyright">
				<div id="copyright-divider-top"></div>
					<div class="width-container-pro">
						<div id="copyright-text">
								<?php echo wp_kses(get_theme_mod( 'progression_studios_footer_copyright', ' 1 All Rights Reserved. Developed by <strong>Progression Studios</strong>' ), true); ?>
						</div>
					</div> <!-- close .width-container-pro -->
				<div class="clearfix-pro"></div>
			</div><!-- close #progression-studios-copyright -->
		</footer>
	<?php endif; ?>
	<?php endif; ?>

	</div><!-- close #boxed-layout-pro -->
	<div id="pro-scroll-top"><?php esc_html_e( 'Scroll to top', 'vayvo-progression' ); ?></div>


<?php wp_footer(); ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(69715279, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/69715279" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
