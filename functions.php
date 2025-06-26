// prende in ingresso una url, un ID o un array immagine
// pensato per lavorare con i custom field di ACF

function accessibility_custom_alt_image( $image ) {
	if ( empty( $image ) ) {
		return '';
	}
	if ( is_string( $image ) ) {
		$image = attachment_url_to_postid( $image );
	} else if ( is_array( $image ) && isset( $image['ID'] ) ) {
		$image = $image['ID'];
	} else {
		return '';
	}

	$alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
	$title = get_post_field( 'post-title', $image );

	if ( !empty( $alt ) ) {
		return $alt;
	} else {
		$image = get_attached_file( $image );
		$filename = basename( $image );
		$alt = str_replace( array( '-', '_' ), ' ', $filename );
		$alt = str_replace( '.jpg', '', $alt );
		$alt = str_replace( '.jpeg', '', $alt );
		$alt = str_replace( '.png', '', $alt );
		$alt = str_replace( '.gif', '', $alt );
		$alt = str_replace( '.webp', '', $alt );
		return $alt;
	}
}