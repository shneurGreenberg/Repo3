
		<div id="main-nav-mobile"><div class="main-nav-mobile">
	
			<?php if ( has_nav_menu( 'progression-studios-mobile-menu' ) ):  ?>
				<?php wp_nav_menu( array('theme_location' => 'progression-studios-mobile-menu', 'menu_class' => 'mobile-menu-pro', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?>
			<?php else: ?>
				<?php wp_nav_menu( array('theme_location' => 'progression-studios-primary', 'menu_class' => 'mobile-menu-pro', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?>
			<?php endif; ?>
			
			<?php if (  is_user_logged_in() ) :  
				$current_user = wp_get_current_user(); 
				$user_id = get_current_user_id();  
			?>
			<?php else: ?>
				<?php if(function_exists('arm_check_for_wp_rename')  ): ?>
				<div id="vayvo-landing-mobile-login-logout-header">
					<?php 
					$login_text = esc_html__('Log In' , 'vayvo-progression');
					echo do_shortcode('[arm_form id="102" assign_default_plan="0" popup="true" link_type="link" link_title="' . $login_text . '" overlay="0.85" modal_bgcolor="#ffffff" popup_height="auto" popup_width="700" link_css="" link_hover_css="" form_position="center" assign_default_plan="0" logged_in_message="You are already logged in."]'); ?>
				</div><!-- close #vayvo-landing-mobile-login-logout-header -->
				<?php endif; ?>
			<?php endif; ?>
			
			<?php get_template_part( 'header/search', 'mobile' ); ?>

            </div>
			<!--<div class="clearfix-pro"></div>-->
		</div><!-- close #mobile-menu-container -->