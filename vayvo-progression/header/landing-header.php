					<header id="masthead-pro" class="vayvo-landing-page-header progression-studios-site-header <?php echo esc_attr( get_theme_mod('progression_studios_landing_nav_align', 'progression-studios-nav-left') ); ?> <?php if ( ! has_nav_menu( 'progression-studios-landing-page' ) ):  ?> vayvo-display-login-on-mobile<?php endif; ?>">
							<div id="logo-nav-pro">
						
								<div class="width-container-pro progression-studios-logo-container">
									<h1 id="logo-pro" class="logo-inside-nav-pro noselect"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		
	<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true)): ?>
		<img src="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_custom_page_logo', true) );?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-default-logo <?php if ( get_theme_mod( 'progression_studios_mobile_custom_logo_per_page', 'hide') == 'hide') : ?>progression-studios-hide-mobile-custom-logo<?php else: ?> progresion-studios-still-hide-onsticky<?php endif; ?><?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?> progression-studios-default-logo-hide<?php endif; ?>">
	<?php endif; ?>	

	<?php if ( get_theme_mod( 'progression_studios_theme_logo', get_template_directory_uri() . '/images/logo.png' ) ) : ?>
		<img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_theme_logo', get_template_directory_uri() . '/images/logo.png' ) ); ?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-default-logo<?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true)): ?> progression-studios-custom-logo-per-page-hide-default<?php endif; ?>	<?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?> progression-studios-default-logo-hide<?php endif; ?> <?php if(is_page() && get_post_meta($post->ID, 'progression_studios_custom_page_logo', true) && get_theme_mod( 'progression_studios_mobile_custom_logo_per_page') == 'display'): ?> progression-studios-hide-custom-logo-mobile<?php endif; ?>">
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'progression_studios_sticky_logo' ) ) : ?>
		<img src="<?php echo esc_attr( get_theme_mod( 'progression_studios_sticky_logo') ); ?>" alt="<?php bloginfo('name'); ?>" class="progression-studios-sticky-logo">
	<?php endif; ?>
	</a></h1>
										
										<div class="optional-centered-area-on-mobile">
											
											<?php if ( has_nav_menu( 'progression-studios-landing-page' ) ):  ?>
											<div class="mobile-menu-icon-pro noselect"><i class="fa fa-bars"></i><?php if (get_theme_mod( 'progression_studios_mobile_menu_text') == 'on' ) : ?><span class="progression-mobile-menu-text"><?php echo esc_html__( 'Menu', 'vayvo-progression' )?></span><?php endif; ?></div>
											<?php endif; ?>
												
											<?php if (  is_user_logged_in() ) :  
												$current_user = wp_get_current_user(); 
												$user_id = get_current_user_id();  
											?>
												<div id="vayvo-landing-login-logout-header">
													<a href="<?php echo esc_url(wp_logout_url( home_url()) )?>"><?php esc_html_e( 'Log Out', 'vayvo-progression' ); ?></a>
												</div><!-- close #vayvo-landing-login-logout-header -->
											<?php else: ?>
												<?php if(function_exists('arm_check_for_wp_rename')  ): ?>
												<div id="vayvo-header-user-profile-login">
													<?php 
													$login_text = esc_html__('Log In' , 'vayvo-progression');
													echo do_shortcode('[arm_form id="102" assign_default_plan="0" popup="true" link_type="link" link_title="' . $login_text . '" overlay="0.85" modal_bgcolor="#ffffff" popup_height="auto" popup_width="700" link_css="" link_hover_css="" form_position="center" assign_default_plan="0" logged_in_message="You are already logged in."]'); ?>
												</div>
												<?php endif; ?>
											<?php endif; ?>
											
											<div id="progression-nav-container">
												<nav id="site-navigation" class="main-navigation">
													<?php wp_nav_menu( array('theme_location' => 'progression-studios-landing-page', 'menu_class' => 'sf-menu', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?><div class="clearfix-pro"></div>
												</nav>
												<div class="clearfix-pro"></div>
											</div><!-- close #progression-nav-container -->
											
		
											<div class="clearfix-pro"></div>
										</div><!-- close .optional-centered-mobile -->
										
								</div><!-- close .width-container-pro -->
							</div><!-- close #logo-nav-pro -->
							
							<?php if ( has_nav_menu( 'progression-studios-landing-page' ) ):  ?>
							<div id="main-nav-mobile">
								
								<?php wp_nav_menu( array('theme_location' => 'progression-studios-landing-page', 'menu_class' => 'mobile-menu-pro', 'fallback_cb' => false, 'walker'  => new ProgressionFrontendWalker ) ); ?>
								
								<?php if (  is_user_logged_in() ) :  
									$current_user = wp_get_current_user(); 
									$user_id = get_current_user_id();  
								?>
									<div id="vayvo-landing-login-logout-header">
										<a href="<?php echo esc_url(wp_logout_url( home_url()) )?>"><?php esc_html_e( 'Log Out', 'vayvo-progression' ); ?></a>
									</div><!-- close #vayvo-landing-login-logout-header -->
								<?php else: ?>
									<?php if(function_exists('arm_check_for_wp_rename')  ): ?>
									<div id="vayvo-landing-mobile-login-logout-header">
										<?php 
										$login_text = esc_html__('Log In' , 'vayvo-progression');
										echo do_shortcode('[arm_form id="102" assign_default_plan="0" popup="true" link_type="link" link_title="' . $login_text . '" overlay="0.85" modal_bgcolor="#ffffff" popup_height="auto" popup_width="700" link_css="" link_hover_css="" form_position="center" assign_default_plan="0" logged_in_message="You are already logged in."]'); ?>
									</div><!-- close #vayvo-landing-mobile-login-logout-header -->
									<?php endif; ?>
								<?php endif; ?>
								<div class="clearfix-pro"></div>
							</div><!-- close #mobile-menu-container -->
							<?php endif; ?>
							
					</header>