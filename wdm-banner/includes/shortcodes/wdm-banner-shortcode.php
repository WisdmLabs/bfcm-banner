<?php
/**
 * 'wdm_wisdm_banner' Shortcode
 * 
 * @package Wisdm Banner
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wdm_wisdm_banner_shortcode( $atts, $content = null ) {

	// Shortcode Parameter
	$atts = shortcode_atts(array(
		'banner_text' => esc_html__( 'Black Friday, Cyber Monday sale!!', 'wdm-banner' ),
	), $atts, 'wdm_wisdm_banner');

	// Taking some variables
	$atts['banner_text'] = isset( $atts['banner_text'] ) ? $atts['banner_text'] : '';

	extract( $atts );

	ob_start();

	$wdm_banner = new Wdm_Banner( $settings );

	$wdm_banner->wdm_render_banner( $banner_text );

	$content .= ob_get_clean();
	return $content;
}

// Banner Shortcode
add_shortcode( 'wdm_wisdm_banner', 'wdm_wisdm_banner_shortcode' );