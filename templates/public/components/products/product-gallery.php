<?php
/**
 * Product Single Gallery
 *
 * @package BigCommerce
 *
 * @var Product $product
 * @var int[]   $image_ids
 * @var string  $fallback_image
 * @var string  $image_size     The image size to use for the gallery image
 * @var string  $thumbnail_size The image size to use for thumbnail images
 */

use BigCommerce\Post_Types\Product\Product;

$gallery_classes = count( $image_ids ) > 1 ? 'swiper-container bc-product-gallery--has-carousel' : 'swiper-container';
?>
<div class="bc-product__gallery">

	<!-- data-js="bc-product-gallery" is required -->
	<div class="bc-product-gallery__images" data-js="bc-product-gallery">
		<?php if ( $product->on_sale() ) { ?>
			<span class="bc-product-flag--sale"><?php esc_html_e( 'SALE', 'bigcommerce' ); ?></span>
		<?php } ?>

		<!-- data-js="bc-gallery-container" is required -->
		<div class="<?php echo esc_attr( $gallery_classes ); ?>" data-js="bc-gallery-container">

			<!-- class="swiper-wrapper" is required -->
			<div class="swiper-wrapper">
				<?php if ( $image_ids ) {
					foreach ( $image_ids as $image_id ) { ?>
						<!-- class="swiper-slide" is required -->
						<div class="swiper-slide bc-product-gallery__image-slide">
							<img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, $image_size ) ); ?>"
									 alt="<?php echo esc_attr( trim( strip_tags( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) ) ); ?>">
						</div>
					<?php }
				} else { ?>
					<div class="swiper-slide bc-product-gallery__image-slide">
						<?php echo $fallback_image; ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if ( count( $image_ids ) > 1 ) { ?>
			<div class="swiper-container" data-js="bc-gallery-thumbs">

				<!-- class="swiper-wrapper" is required -->
				<div class="swiper-wrapper bc-product-gallery__thumbs">
					<?php foreach ( $image_ids as $index => $image_id ) { ?>
						<!-- class="swiper-slide" and data-js="bc-gallery-thumb-trigger" are required -->
						<a class="swiper-slide bc-product-gallery__thumb-slide" data-js="bc-gallery-thumb-trigger"
						   data-index="<?php echo (int) $index; ?>">
							<img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, $thumbnail_size ) ); ?>"
							     alt="<?php echo esc_attr( trim( strip_tags( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) ) ); ?>">
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<!-- If you've made changes to the gallery slide markup above, you should change it to match here as well. -->
		<!-- data-js="bc-product-variant-image" is required	-->
		<div data-js="bc-product-variant-image" class="bc-product-variant-image">
			<!-- class="swiper-slide" is required -->
			<div class="swiper-slide bc-product-gallery__image-slide">
				<!-- data-js="bc-variant-image" is required -->
				<img src="" alt="" class="bc-variant-image" data-js="bc-variant-image">
			</div>
		</div>
	</div>
</div>