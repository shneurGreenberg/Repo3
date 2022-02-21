<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
		
		<div class="progression-studios-store-product-image-container">
			<a href="<?php the_permalink(); ?>" class="progression-studios-store-image-index">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?><!-- image -->
			</a>
			<div class="progression-studios-shop-overlay-buttons">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?><!--  add to cart -->
			</div><!-- close .progression-studios-shop-overlay-buttons -->
		</div><!-- close .progression-studios-store-product-image-container -->
	
		<div class="progression-studios-shop-index-text">
			<a href="<?php the_permalink(); ?>" class="progression-studios-view-permalink">
				<?php do_action( 'woocommerce_shop_loop_item_title' ); ?><!-- title -->
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?><!-- rating and price -->
				<div class="clearfix-pro"></div>
			</a>
		</div>

</li>
