<?php
/**
 * Single Product Image
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">
	<?php
		if ( has_post_thumbnail() ) {
			$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image 	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $props['title'],
					'alt' => $props['alt']
				)
			);

			echo '<meta itemprop="image" content="' . esc_url( $props['url'] ) . '">';
			echo apply_filters( 'woocommerce_single_product_image_html',
				sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image swipebox" title="%s">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$image
				),
				$post->ID
			);

			wp_enqueue_style( 'swipebox' );
			wp_enqueue_script( 'swipebox' );
			TdJsClientScript::addScript( 'initProductSwipebox', "jQuery('.woocommerce-main-image.swipebox').swipebox({useSVG : true, hideBarsDelay : 0});");

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'adventure-tours' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
