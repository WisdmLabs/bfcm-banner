<?php
/**
* Banner HTML
*
* @package Wisdm Banner
* @since 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
} ?>

<div class="wdm-banner-conntainer">
    <div class="wdm-banner">
        <span class="banner-text"><?php echo do_shortcode( $banner_text ); ?></span>
    </div>
</div>
