<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>

<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper max_h_gallery">

		
		<?php
		if ( $post_thumbnail_id ) {
			$attachment_ids = $product->get_gallery_image_ids();
			if(sizeof($attachment_ids) == 0){
				$html = "<div><img src='";
				// get the image URL
				$html .= get_the_post_thumbnail_url( );
				$html .= " ' onclick=";
				$html .= '"';
				$html .= "document.getElementById('modalHeader').style.display = 'block';";
				$html .= '"';
				$html .= "></div>";
				echo $html;

				$html = "<div class='modal' id = 'modalHeader' onclick=";
				$html .= '"';
				$html .= "document.getElementById('modalHeader').style.display = 'none';";
				$html .= '">';
				$html .= "<div class='modal-content'>";
				$html .= "<img class='modal-image' src='";
				$html .= get_the_post_thumbnail_url( );
				$html .= "'></div></div> ";
				echo $html;
			}
			else{
				echo '<div class="high_overlay_gallery"> ᐱ </div>';
				echo '<div class="low_overlay_gallery"> ᐯ </div>';


				$html = "<div><img src='";
				// get the image URL
				$html .= get_the_post_thumbnail_url( );
				$html .= " ' onclick=";
				$html .= '"';
				$html .= "document.getElementById('modalHeader').style.display = 'block';";
				$html .= '"';
				$html .= "></div>";
				echo $html;

				$html = "<div class='modal' id = 'modalHeader' onclick=";
				$html .= '"';
				$html .= "document.getElementById('modalHeader').style.display = 'none';";
				$html .= '">';
				$html .= "<div class='modal-content'>";
				$html .= "<img class='modal-image' src='";
				$html .= get_the_post_thumbnail_url( );
				$html .= "'></div></div> ";
				echo $html;

				foreach( $attachment_ids as $attachment_id ) 
				{
					$html = "<div><img src='";
					// get the image URL
					$html .= wp_get_attachment_url( $attachment_id );
					$html .= " ' onclick=";
					$html .= '"';
					$html .= "document.getElementById('modal";
					$html .= $attachment_id;
					$html .= "').style.display = 'block';";
					$html .= '"';
					$html .= "'></div>";
					echo $html;

					$html = "<div class='modal' id = 'modal" ;
					$html .= $attachment_id;
					$html .= "' onclick=";
					$html .= '"';
					$html .= "document.getElementById('modal";
					$html .= $attachment_id;
					$html .= "').style.display = 'none';";
					$html .= '">';
					$html .= "<div class='modal-content'>";
					$html .= "<img class='modal-image' src='";
					$html .= wp_get_attachment_url( $attachment_id );
					$html .= "'></div></div> ";
					echo $html;
					
				}
			}

			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
		 	$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
		 	$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
		 	$html .= '</div>';
		}
		
		// echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		// do_action( 'woocommerce_product_thumbnails' );
		?>

	</figure>
</div>
