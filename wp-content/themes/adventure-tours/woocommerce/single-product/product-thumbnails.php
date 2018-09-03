<?php
/**
 * Single Product Thumbnails
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$attachment_ids = $product->get_gallery_attachment_ids();
if ( ! $attachment_ids ) {
	return;
}

$loop = 0;
$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
?><div class="row product-thumbnails <?php echo 'columns-' . $columns; ?>"><?php

	foreach ( $attachment_ids as $attachment_id ) {

		$classes = array( 'swipebox' );

		if ( $loop == 0 || $loop % $columns == 0 ) {
			$classes[] = 'first';
		}

		if ( ( $loop + 1 ) % $columns == 0 ) {
			$classes[] = 'last';
		}

		$props = wc_get_product_attachment_props( $attachment_id, $post );

		if ( ! $props['url'] ) {
			continue;
		}

		$image_class = esc_attr( implode( ' ', $classes ) );
		$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail', 0, $props ) );

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',
			sprintf(
				'<div class="col-sm-3 col-xs-4 product-thumbnails__item"><a href="%s" class="%s" title="%s">%s</a></div>',
				esc_url( $props['url'] ),
				$image_class,
				esc_attr( $props['caption'] ),
				$image
			), 
			$attachment_id,
			$post->ID,
			$image_class
		);

		$loop++;
	}

?></div><?php

wp_enqueue_style('swipebox');
wp_enqueue_script('swipebox');
TdJsClientScript::addScript( 'initProductSwipebox', "jQuery('.woocommerce-main-image.swipebox,.product-thumbnails .swipebox').swipebox({useSVG : true, hideBarsDelay : 0});");
