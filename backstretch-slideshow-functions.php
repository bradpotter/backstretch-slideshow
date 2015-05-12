<?php
/**
 * Backstretch Slideshow
 *
 * @package   Backstretch_Slideshow
 * @author    Brad Potter
 * @license   GPL-2.0+
 * @link      http://www.bradpotter.com/plugins/backstretch-slideshow
 * @copyright Copyright (c) 2015, Brad Potter
 */

add_action( 'wp_enqueue_scripts', 'backstretch_slideshow_enqueue_scripts' );
/**
 * Enqueue scripts for Backstretch Slideshow
 *
 */
function backstretch_slideshow_enqueue_scripts() {
	
	$image1 = get_option( 'backstretch-slideshow-home-image-one', sprintf( '%s/images/blank1.jpg', BSS_URL ) );
	$image2 = get_option( 'backstretch-slideshow-home-image-two', sprintf( '%s/images/blank2.jpg', BSS_URL ) );
	$image3 = get_option( 'backstretch-slideshow-home-image-three', sprintf( '%s/images/blank3.jpg', BSS_URL ) );
	$container = get_option( 'backstretch_slideshow_container', sprintf( '.home-featured' ) );
	$slide_duration = get_option( 'backstretch_slideshow_slide_duration', sprintf( '5000' ) );
	$fade_duration = get_option( 'backstretch_slideshow_fade_duration', sprintf( 'normal' ) );

	
	//* Load scripts only if custom backstretch image is being used
	if ( ! empty( $image1 ) ) {

	//* Enqueue Backstretch scripts
	wp_enqueue_script( 'backstretch', BSS_URL . '/js/backstretch.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'backstretch-slideshow-set', BSS_URL . '/js/backstretch-slideshow-set.js' , array( 'jquery', 'backstretch' ), '1.0.0' );
	wp_enqueue_style( 'backstretch-slideshow-css', BSS_URL . '/css/backstretch-slideshow.css', array(), '1.0.0' );

	wp_localize_script(
		'backstretch-slideshow-set',
		'BackStretchVar',
		array(
			'src1'		=> $image1,
			'src2'		=> $image2,
			'src3'		=> $image3,
			'container'	=> $container,
			'duration'	=> $slide_duration,
			'fade'		=> $fade_duration,
			)
		);
	}
}

add_action( 'wp_head', 'backstretch_slideshow_customizer_css' );
/**
 * Add custom CSS styles to the Head
 *
 */
function backstretch_slideshow_customizer_css() {
?>
<style type="text/css">
	<?php

	$bss_overlay_color = get_theme_mod( 'backstretch_slideshow_overlay_color' );
	if ( $bss_overlay_color ) { printf( '.backstretch::after { background-color: %s; } ', $bss_overlay_color ); }
	$bss_overlay_opacity = get_theme_mod( 'backstretch_slideshow_overlay_opacity' );
	if ( $bss_overlay_opacity ) { printf( '.backstretch::after { opacity: %s; } ', $bss_overlay_opacity ); }
	printf( "\n" );

	?>
</style>
<?php
}
