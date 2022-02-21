<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pro
 */

get_header(); ?>
	


	
		<div id="content-pro" class="site-content">
			<div class="width-container-pro">
				
				<?php
					if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1;}
					
					
					if(isset($_GET['search_keyword'])) {
						if($_GET['search_keyword']) {
							$keyword = $_GET['search_keyword'];
						} else {
							$keyword = "";
						}
					}
					
					$args = array(
						'post_type' => 'video_skrn',
						'paged' => $paged,
						's' => $keyword
					);
					
					
					
					$vtype_expanded = (array) $_GET['vtype'];
					if(isset($_GET['vtype'])) {
					if($_GET['vtype']) {
						$args['tax_query'][] = array(
							'taxonomy' => 'video-type',
							'field' => 'slug',
							'terms' => $vtype_expanded,
							'operator' => 'IN',
						);
					}
					}

                if( 0 ) {
                    $vplatform_expanded = (array) $_GET['vplatform'];
                } else {
                    $vplatform_expanded = $_GET['vplatform'];
                }

                if(isset($_GET['vplatform'])) {
                    if($_GET['vplatform']) {
                        /*
                        foreach ($vplatform_expanded as $key=>$value) {
                            $args['meta_query'][] = array(
                                'key' => 'progression_studios_video_platform',
                                'value' => $value,
                            );
                        }
                        */

                        if ($vplatform_expanded === 'zeremtv') {
                            $args['meta_query'][] = array(
                                'key' => 'progression_studios_video_display',
                                'value' => 'embed',
                            );
                        } else {

                            $args['meta_query'][] = array(
                                'key' => 'progression_studios_video_platform',
                                'value' => $vplatform_expanded,
                            );

                        }
                    }
                }
					
					if( get_theme_mod( 'progression_studios_video_search_multiple_genre') == 'multiple' ) {
						$vgenre_expanded = (array) $_GET['vgenre'];
					} else {
						$vgenre_expanded = $_GET['vgenre'];
					}

					if(isset($_GET['vgenre'])) {
					if($_GET['vgenre']) {
						$args['tax_query'][] = array(
							'taxonomy' => 'video-genres',
							'field' => 'slug',
							'terms' => $vgenre_expanded
						);
					}
					}
					
					if(isset($_GET['vduration'])) {
					if($_GET['vduration']) {
						$args['meta_query'][] = array(
							'key' => 'progression_studios_media_duration',
							'value' => $_GET['vduration'],
						);
					}
					}
					
					if(isset($_GET['vrating'])) {
					if($_GET['vrating']) {
						$vrating = explode( ',', $_GET['vrating'] );
						$args['meta_query'][] = array(
							// I know it isn't a key but can't figure it out 'key' => skrn_pro_comment_rating_get_average_ratings( $post->ID ),
							'key' => '_average_ratings',
							'value' => array( floatval( $vrating[0] ), floatval ( $vrating[1] ) ),
							'type' => 'DECIMAL',
							'compare' => 'BETWEEN'
						);
					}
					}
					
					
					if( get_theme_mod( 'progression_studios_video_search_multiple_cat') == 'multiple' ) {
						$vcategory_expanded = (array) $_GET['vcategory'];
					} else {
						$vcategory_expanded = $_GET['vcategory'];
					}
					
					
					if(isset($_GET['vcategory'])) {
					if($_GET['vcategory']) {
						$args['tax_query'][] = array(
							'taxonomy' => 'video-category',
							'field' => 'slug',
							'terms' => $vcategory_expanded,
							'operator' => 'IN',
						);
					}
					}
					
					
					if( get_theme_mod( 'progression_studios_video_search_multiple_director') == 'multiple' ) {
						$vdirector_expanded = (array) $_GET['vdirector'];
					} else {
						$vdirector_expanded = $_GET['vdirector'];
					}
					
					if(isset($_GET['vdirector'])) {
					if($_GET['vdirector']) {
						$args['tax_query'][] = array(
							'taxonomy' => 'video-director',
							'field' => 'slug',
							'terms' => $vdirector_expanded,
							'operator' => 'IN',
						);
					}
					}
		
					
				query_posts($args); if(have_posts()):
				?>
					
					<div id="progression-studios-search-results-videos">
						<span><?php vayvo_progression_studios_search_video_counter(); ?></span> <?php echo esc_html__( 'Videos Found', 'vayvo-progression' ); ?>
					</div>
					
					<div class="progression-masonry-margins" style="margin-top:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px; margin-left:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px; margin-right:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px;">
						<div class="progression-studios-video-index-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr(get_theme_mod( 'progression_studios_blog_columns', '3')); ?>">
									<div class="progression-masonry-padding-blog" style="padding:<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '3')); ?>px;">
										<div class="progression-studios-isotope-animation">
											<?php get_template_part( 'template-parts/content', 'skrn_video' ); ?>
										</div><!-- close .studios-isotope-animation -->
									</div><!-- close .progression-masonry-padding-blog -->
								</div><!-- cl ose .progression-masonry-item -->
							<?php endwhile; ?>
							<div class="clearfix-pro"></div>
							
						</div><!-- close .progression-studios-video-index-list -->
						
						</div><!-- close .progression-masonry-margins -->
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination' ) == 'default') : ?>
						<?php progression_studios_show_pagination_links_pro(); ?>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination', 'load-more') == 'load-more') : ?>
						<div id="progression-load-more-manual"><?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?></div>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'infinite-scroll') : ?>
						<?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?>
					<?php endif; ?>

					<div class="clearfix-pro"></div>
				<?php else : ?>
			
					<div class="progression-studios-video-index-none">
						<section class="no-results-pro not-found-pro">
	
							<h2 class="page-title-pro"><?php esc_html_e( 'No Videos Found', 'vayvo-progression' ); ?></h2>

							<div class="page-content-pro">
								<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'vayvo-progression' ); ?></p>
							</div><!-- .page-content -->
						</section><!-- .no-results -->
					</div><!-- close .progression-video-index -->
			
				<?php endif; ?>
				
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>