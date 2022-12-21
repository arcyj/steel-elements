<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset ( $input_id ) ) {
	$input_id = uniqid( 'quantity_' );
}

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="mkdf-quantity-buttons quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$labelledby = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'wilmer' ), strip_tags( $args['product_name'] ) ) : '';
	?>
	<div class="mkdf-quantity-buttons quantity">
		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity', 'wilmer' ); ?></label>
		<span class="mkdf-quantity-minus icon_minus-06"></span>
		<input
                type="text"
                id="<?php echo esc_attr( $input_id ); ?>"
                class="input-text qty text mkdf-quantity-input"
                data-step="<?php echo esc_attr( $step ); ?>"
                data-min="<?php echo esc_attr( $min_value ); ?>"
                data-max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
                name="<?php echo esc_attr( $input_name ); ?>"
                value="<?php echo esc_attr( $input_value ); ?>"
                title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'wilmer' ) ?>"
                size="4" pattern="<?php echo esc_attr( $pattern ); ?>"
                placeholder="<?php echo esc_attr( $placeholder ); ?>"
                inputmode="<?php echo esc_attr( $inputmode ); ?>"
                aria-labelledby="<?php echo esc_attr( $labelledby ); ?>" />
		<span class="mkdf-quantity-plus icon_plus"></span>
	</div>
	<?php
}
