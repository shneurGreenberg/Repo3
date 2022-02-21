<?php
/**
 * The template for displaying all single posts.
 *
 * @package pro
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div id="video-page-title-pro" <?php if( get_post_meta($post->ID, 'progression_studios_header_image', true) ): ?>

        style="background-image:url('<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_header_image', true)); ?>');"
    <?php else: ?><?php if(has_post_thumbnail()): ?>

        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-video-header'); ?>
        style="background-image:url('<?php echo esc_attr($image[0]);?>');"<?php endif; ?><?php endif; ?>

       >


		<?php if( get_post_meta($post->ID, 'arm_is_paid_post', true) && !current_user_can('administrator') ): ?>

			<?php if( is_user_logged_in() ): ?>

				<?php
					$plan_id = progression_arm_get_plan_from_post_id( $post->ID );
			        $current_user_id = get_current_user_id();
			        $arm_user_plan = get_user_meta($current_user_id, 'arm_user_plan_ids', true);
			        $arm_user_plan = !empty($arm_user_plan) ? $arm_user_plan : array();
			        if(!empty($arm_user_plan)){
			            if(in_array($plan_id, $arm_user_plan)) {
				?>

			  		<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true) || get_post_meta($post->ID, 'progression_studios_youtube_video', true) || get_post_meta($post->ID, 'progression_studios_vimeo_video', true) ): ?>
			  		<a class="video-page-title-play-button afterglow" href="#Video-Vayvo-Single"><i class="fa fa-play"></i></a>
			        <div style="display:none;">
			           <video id="Video-Vayvo-Single"  <?php if( get_post_meta($post->ID, 'progression_studios_video_embed_poster', true) ): ?>poster="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_video_embed_poster', true)); ?>"<?php endif; ?> width="960" height="540" <?php if( get_post_meta($post->ID, 'progression_studios_youtube_video', true)): ?>data-youtube-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_youtube_video', true)); ?>"<?php endif; ?> <?php if( get_post_meta($post->ID, 'progression_studios_vimeo_video', true)): ?>data-vimeo-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_vimeo_video', true)); ?>"<?php endif; ?>>
			  				 <?php if( get_post_meta($post->ID, 'progression_studios_video_post', true)): ?><source src="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_video_post', true)); ?>" type="video/mp4"><?php endif; ?>
			           </video>
			        </div>
			  		<?php else: ?>
			  			<?php if( get_post_meta($post->ID, 'progression_studios_video_embed', true)  ): ?>
			  				<div id="vayvo-single-video-embed"><?php echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_embed', true)); ?></div>
			  			<?php endif; ?>

			  		<?php endif; ?>


				<?php }  } ?>

			<?php endif; ?>

		<?php else: ?>

            <?php if( get_post_meta($post->ID, 'progression_studios_video_embed', true)  ): ?>

            <!--                    <a  class="arm_form_popup_link arm_form_popup_link_102 arm_form_popup_link_102_J96YrkuzeE arm_form_popup_ahref" href="javascript:void(0)"-->
            <!--                        data-form_id="arm_form_popup_link_102_J96YrkuzeE" data-toggle="armmodal" data-modal_bg="#ffffff"-->
            <!--                        data-overlay="0.85"><i class="fa fa-play"></i></a>-->
            <!---->
            <!--                    <a href="javascript:void(0)" id="arm_form_popup_link_102" class="arm_form_popup_link arm_form_popup_link_102 arm_form_popup_link_102_cc26xSbPMS arm_form_popup_ahref" data-form_id="102_cc26xSbPMS" data-toggle="armmodal" data-modal_bg="#ffffff" data-overlay="0.85">Войти</a>-->
            <!--                    <div style="display:none;">-->
            <!---->
            <!--                    </div>-->
            <!---->
            <!---->
            <!--                    <div class="arm_add_new_drip_rule_wrapper popup_wrapper arm_form_popup_link_popup" id="arm_form_popup_link_popup" style="width: 650px;margin-top: 40px;">-->
            <!--                        --><?php //echo apply_filters('progression_studios_video_content_filter', get_post_meta($post->ID, 'progression_studios_video_embed', true)); ?>
            <!--                    </div>-->
            <!---->


            <a class="video-page-title-play-button x-afterglow zerem-video-popup" id="myBtn" href="#"><i class="fa fa-play"></i></a>
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <?php if (is_user_logged_in()):?>
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                        <span class="ru">
                        <?php echo get_post_meta($post->ID, 'progression_studios_video_embed', true); ?>
                        </span>
                    <span class="notru">
                        Sorry, zerem.tv is not available in your region
                    </span>

                </div>
                <?php else:?>
                    <div class="login-required-notice" style="animation: none;"><div class="login-notify-text"><p><i class="fa fa-exclamation-circle"></i>
                                <span class="ru">
                                <?php echo wp_kses( __('Please login to add videos to your list', 'vayvo-progression' ) , TRUE); ?>
                            </p></div></div>



                <?php endif;?>

            </div>

            <script>
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
/*
                // When the user clicks on the button, open the modal
                btn.onclick = function() {
                    modal.style.display = "block";
                }
*/
                var elementSelector = '.zerem-video-popup';
                document.addEventListener('click', function(e) {
                    // loop parent nodes from the target to the delegation node
                    for (var target = e.target; target && target != this; target = target.parentNode) {
                        if (target.matches(elementSelector)) {
                            //handler.call(target, e);
                            e.preventDefault();
                            modal.style.display = "block";
                            break;
                        }
                    }
                }, false);

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                    jQuery('iframe').attr('src', jQuery('iframe').attr('src'));
                }

                // When the user clicks anywhere outside of the modal, close it
                // window.onclick = function(event) {
                //     if (event.target == modal) {
                //         modal.style.display = "none";
                //     }
                // }

            </script>








            <?php else: ?>

        <?php if( get_post_meta($post->ID, 'progression_studios_video_post', true) || get_post_meta($post->ID, 'progression_studios_youtube_video', true) || get_post_meta($post->ID, 'progression_studios_vimeo_video', true) ): ?>
	  		<a class="video-page-title-play-button afterglow" href="#Video-Vayvo-Single"><i class="fa fa-play"></i></a>
	        <div style="display:none;">
	           <video id="Video-Vayvo-Single"  <?php if( get_post_meta($post->ID, 'progression_studios_video_embed_poster', true) ): ?>poster="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_video_embed_poster', true)); ?>"<?php endif; ?> width="960" height="540" <?php if( get_post_meta($post->ID, 'progression_studios_youtube_video', true)): ?>data-youtube-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_youtube_video', true)); ?>"<?php endif; ?> <?php if( get_post_meta($post->ID, 'progression_studios_vimeo_video', true)): ?>data-vimeo-id="<?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_vimeo_video', true)); ?>"<?php endif; ?>>
	  				 <?php if( get_post_meta($post->ID, 'progression_studios_video_post', true)): ?><source src="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_video_post', true)); ?>" type="video/mp4"><?php endif; ?>
	           </video>
	        </div>
        <?php endif; ?>

	  		<?php endif; ?>


		<?php endif; ?>



		<div id="video-page-title-gradient-base"></div>
		<?php do_action( 'skrn_notices', '<div class="login-required-notice"><div class="login-notify-text">%s</div></div>' ) ?>
	</div><!-- #video-page-title-pro -->
	<div class="clearfix-pro"></div>

	<div id="content-pro" class="site-content-video-post<?php if (get_theme_mod( 'progression_studios_media_post_sidebar') == 'false') : ?> hide-sidebar-video-post<?php endif; ?>">
		<div class="width-container-pro">
			<?php get_template_part( 'template-parts/content', 'single-skrn_video' ); ?>

		<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
	</div><!-- close #content-pro -->

<?php if (function_exists( 'progression_studios_elements_social_sharing') )  : ?><?php progression_studios_elements_social_sharing(); ?><?php endif; ?>

</div><!-- close #id="post-<?php the_ID(); ?>" -->
    <script>
        function domReady(fn) {
            if (document.readyState != 'loading'){
                fn();
            } else {
                document.addEventListener('DOMContentLoaded', fn);
            }
        }
        domReady(function (){
         iFrameResize({ log: true }, '#myIframe');
        });
    </script>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
