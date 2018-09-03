<?php
/**
 * Cross-sells
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'wc_query'            => 'tours',
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => WC()->query->get_meta_query(),
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">
		<?php
			$columns = apply_filters( 'woocommerce_cross_sells_columns', $columns );

			// will use less columns in case if there is not enough items in cross sell option
			$columns = min( $products->post_count, $columns );
			if ( $columns < 1 ) {
				$columns = 1;
			} elseif ( $columns > 4 ) {
				$columns = 4;
			}

			$woocommerce_loop['columns'] = $columns;

			$column_class = 'col-md-' . ( 12 / $columns );
		?>

		<h2><?php esc_html_e( 'You may be interested in', 'adventure-tours' ) . '&hellip;'; ?></h2>

		<?php woocommerce_product_loop_start(); ?>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<div class="cross-sells__item <?php echo $column_class; ?>"><?php wc_get_template_part( 'content', 'product' ); ?></div>

			<?php endwhile; // end of the loop. ?>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_query();
