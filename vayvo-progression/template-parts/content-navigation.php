<?php if ( get_theme_mod( 'progression_studios_blog_post_navigation', 'on') =='on') : ?>
		<div id="progression-studios-next-previous-post">
			
			<?php $prevPost = get_previous_post(false);//True will only next/prev posts from same category
			        if($prevPost) {
			            $args = array(
			                'posts_per_page' => 1,
			                'include' => $prevPost->ID
			            );
			            $prevPost = get_posts($args);
			            foreach ($prevPost as $post) {
			           	 setup_postdata($post);
			    ?>
			        <a href="<?php the_permalink(); ?>" id="progression-studios-previous-post" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-index'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?>>
						  <div class="progression-studios-next-center">
 			          	 <h5><i class="fa fa-long-arrow-left" aria-hidden="true"></i><?php echo esc_html__( 'Previous Post', 'vayvo-progression' ) ?></h5>
 						  	<h3><?php the_title(); ?></h3>
						  </div><!-- close .progression-studios-next-center -->
			        </a>
			    <?php
			                wp_reset_postdata();
			            } //end foreach
			        } // end if
         
			        $nextPost = get_next_post(false);//True will only next/prev posts from same category
			        if($nextPost) {
			            $args = array(
			                'posts_per_page' => 1,
			                'include' => $nextPost->ID
			            );
			            $nextPost = get_posts($args);
			            foreach ($nextPost as $post) {
			                setup_postdata($post);
			    ?>
			        <a href="<?php the_permalink(); ?>" id="progression-studios-next-post" <?php if(has_post_thumbnail()): ?><?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-studios-blog-index'); ?>style="background-image:url('<?php echo esc_attr($image[0]);?>')"<?php endif; ?>>
			           <div class="progression-studios-next-center">
							  <h5><?php echo esc_html__( 'Next Post', 'vayvo-progression' ) ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></h5>
							  <h3><?php the_title(); ?></h3>
			           </div><!-- close .progression-studios-next-center -->
			        </a>
			    <?php
			                wp_reset_postdata();
			            } //end foreach
			        }// end if
			    ?>
			
			<div class="clearfix-pro"></div>
		</div><!-- close #progression-studios-next-previous-post -->
<?php endif; ?>