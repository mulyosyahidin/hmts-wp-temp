<?php
/**
 * Blog entry gallery format media
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if Ocean Extra is not active
if ( ! OCEAN_EXTRA_ACTIVE ) {
	return;
}

// Get attachments
$attachments = oceanwp_get_gallery_ids( get_the_ID() );

// Return standard entry style if password protected or there aren't any attachments
if ( post_password_required() || empty( $attachments ) ) {
	get_template_part( 'partials/entry/media/blog-entry' );
	return;
}

// Add images size if blog grid
if ( 'grid-entry' == oceanwp_blog_entry_style() ) {
	$size = oceanwp_blog_entry_images_size();
} else {
	$size = 'full';
} ?>

<div class="thumbnail">

	<div class="gallery-format clr">

		<?php
		// Loop through each attachment ID
		foreach ( $attachments as $attachment ) :

			// Get attachment data
			$attachment_title   = get_the_title( $attachment );
			$attachment_alt     = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
			$attachment_alt     = $attachment_alt ? $attachment_alt : $attachment_title;

			// Get image output
			$attachment_html = wp_get_attachment_image( $attachment, $size, '', array(
				'alt'           => $attachment_alt,
				'itemprop'      => 'image',
			) );

			// Display with lightbox
			if ( oceanwp_gallery_is_lightbox_enabled() == 'on' ) : ?>

				<a href="<?php echo esc_url( wp_get_attachment_url( $attachment ) ); ?>" title="<?php echo esc_attr( $attachment_alt ); ?>" class="gallery-lightbox">
					<?php echo wp_kses_post( $attachment_html ); ?>
				</a>

				<?php
				// Display single image
			else : ?>

				<a href="<?php the_permalink(); ?>" class="thumbnail-link">
					<?php echo wp_kses_post( $attachment_html ); ?>
				</a>

			<?php endif;

		endforeach; ?>

	</div>

</div>
