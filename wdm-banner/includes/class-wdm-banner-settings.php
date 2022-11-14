<?php

/**
 * Banner settings class
 *
 * @package Wdm_Banner
 */

/**
 * Wdm_Banner
 */
class Wdm_Banner {
	/**
	 * Class Instance
	 *
	 * @var mixed
	 */
	public static $instance;

		
	/**
	 * Banner settings
	 *
	 * @var array
	 */
	public $settings;

	/**
	 * Banner settings
	 *
	 * @var array
	 */
	public $banner_text;

	/**
	 * Class Constructor
	 *
	 * @return void
	 */
	public function __construct( $settings ) {
		$defaults = array(
			'locations'	=> array(
							'before_main_content'		=> true,
							'after_main_content'		=> false,
							'before_shop_loop'			=> false,
							'after_shop_loop'			=> false,
							'before_product_summary'	=> false,
							'after_product_summary'		=> false,
							'before_title'				=> false,
							'before_price'				=> false,
							'before_excerpt'			=> false,
							'before_single_meta'		=> false,
							'after_single_meta'			=> false,
							'before_checkout_form'		=> true,
							'after_coupon'				=> false,
							'before_cart'				=> true,
							'cart_collaterals'			=> false,
						),
			'text'		=> esc_html__( 'Black Friday, Cyber Monday sale!!', 'wdm-banner' ),
		);

		$this->settings = wp_parse_args( $settings, $defaults );

		// Display offer banner before main content on archive or single product page
		if( $this->settings['locations']['before_main_content'] ) {
			add_action( 'woocommerce_before_main_content', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner after main content on archive or single product page
		if( $this->settings['locations']['after_main_content'] ) {
			add_action( 'woocommerce_after_main_content', array( $this, 'wdm_render_banner' ), 20 );
		}

		// Display offer banner before shop loop on shop page
		if( $this->settings['locations']['before_shop_loop'] ) {
			add_action( 'woocommerce_before_shop_loop', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner after shop loop on shop page
		if( $this->settings['locations']['after_shop_loop'] ) {
			add_action( 'woocommerce_after_shop_loop', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner before single product summary on product single page
		if( $this->settings['locations']['before_product_summary'] ) {
			add_action( 'woocommerce_before_single_product_summary', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner after single product summary on product single page
		if( $this->settings['locations']['after_product_summary'] ) {
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'wdm_render_banner' ), 20 );
		}

		// Display offer banner before product title on product single page
		if( $this->settings['locations']['before_title'] ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'wdm_render_banner' ), 5 );
		}

		// Display offer banner before product price on product single page
		if( $this->settings['locations']['before_price'] ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner before product excerpt on product single page
		if( $this->settings['locations']['before_excerpt'] ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'wdm_render_banner' ), 20 );
		}

		// Display offer banner before product single meta on product single page
		if( $this->settings['locations']['before_single_meta'] ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'wdm_render_banner' ), 40 );
		}

		// Display offer banner after product single meta on product single page
		if( $this->settings['locations']['after_single_meta'] ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'wdm_render_banner' ), 50 );
		}

		// Display offer banner before checkout form on checkout page
		if( $this->settings['locations']['before_checkout_form'] ) {
			add_action( 'woocommerce_before_checkout_form', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner after coupon on checkout page
		if( $this->settings['locations']['after_coupon'] ) {
			add_action( 'woocommerce_before_checkout_form', array( $this, 'wdm_render_banner' ), 20 );
		}

		// Display offer banner before cart items on cart page
		if( $this->settings['locations']['before_cart'] ) {
			add_action( 'woocommerce_before_cart', array( $this, 'wdm_render_banner' ), 10 );
		}

		// Display offer banner after cart items on cart page
		if( $this->settings['locations']['cart_collaterals'] ) {
			add_action( 'woocommerce_cart_collaterals', array( $this, 'wdm_render_banner' ) );
		}

		wp_enqueue_style('wdm-banner-style', WDM_URL . 'assets/css/wdm-banner.css', array(), filemtime( WDM_PATH . 'assets/css/wdm-banner.css' ), 'all');
	}

	/**
	 * Get instance of a class
	 */
	public static function wdm_get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * Function to render the Banner HTML
	 *
	 * @return void
	 */
	public function wdm_render_banner( $banner_text ) {

		$banner_text = ! empty( $banner_text ) ? $banner_text : $this->settings['text'];

		ob_start();
		require WDM_PATH . 'templates/banner.php';
		ob_end_flush();
	}
}