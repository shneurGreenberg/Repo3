<?php
/**
 * @package pro
 */
?>

		<?php 
			$terms = get_the_terms( $post->ID , 'video-cast' ); 
			if ( !empty( $terms ) ) :
				echo '<div id="video-cast-display-post-section"><h3>';
				echo  esc_html_e( 'Lead Cast', 'vayvo-progression');
				echo '</h3><ul class="vayvo-video-cast-list">';
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term, 'video-cast' );
				$term_photo = get_term_meta( $term->term_id, 'progression_studios_cast_Photo', true);
				
				if( is_wp_error( $term_link ) )
					continue;
				echo '<li><a href="' . $term_link . '">';
				
				//if ( !empty( $term_photo ) ) :
					echo '<div class="vayvo-video-cast-photo" style="background-image:url(' . $term_photo . ')"></div>';
				//endif;
				
				echo '<h6>' . $term->name . '</h6><div class="clearfix-pro"></div></a></li>';
			} 
			echo '</ul><div class="clearfix-pro"></div></div>';
		endif;
		?>