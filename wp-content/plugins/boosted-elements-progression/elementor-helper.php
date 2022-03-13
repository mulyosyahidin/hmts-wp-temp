<?php
namespace BoostedElements;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class BoostedElementsPlugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->boosted_elements_add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function boosted_elements_add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'boosted_elements_on_widgets_registered' ] );
      add_action('elementor/init', array($this, 'boosted_elements_progression_register_widgets'));
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function boosted_elements_on_widgets_registered() {
		$this->boosted_elements_progression_includes();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function boosted_elements_progression_includes() {
		require __DIR__ . '/elements/advanced-button.php';
		require __DIR__ . '/elements/advanced-text.php';
		require __DIR__ . '/elements/animated-text-element.php';
		require __DIR__ . '/elements/button-floating-element.php';
		require __DIR__ . '/elements/countdown-element.php';
		if ( function_exists( 'wpcf7' ) ) {
			require __DIR__ . '/elements/contact-element.php';
		}
		require __DIR__ . '/elements/flip-box-element.php';
		require __DIR__ . '/elements/image-comparison.php';
		require __DIR__ . '/elements/image-element.php';
		require __DIR__ . '/elements/image-slideshow.php';
        require __DIR__ . '/elements/logo-element.php';
		require __DIR__ . '/elements/map-element.php';
        require __DIR__ . '/elements/nav-element.php';
		require __DIR__ . '/elements/popup-element.php';
		require __DIR__ . '/elements/post-list-element.php';
		require __DIR__ . '/elements/pricing-element.php';
		require __DIR__ . '/elements/pricing-table-element.php';
		require __DIR__ . '/elements/scroll-nav-element.php';
        require __DIR__ . '/elements/search-element.php';
		require __DIR__ . '/elements/slider-element.php';
		require __DIR__ . '/elements/tabs-element.php';
		require __DIR__ . '/elements/team-element.php';
        require __DIR__ . '/elements/template-element.php';
		if ( function_exists( 'WC' ) ) {
            require __DIR__ . '/elements/woo-cart.php';
			require __DIR__ . '/elements/woo-products.php';
			require __DIR__ . '/elements/woo-categories.php';
			require __DIR__ . '/elements/woo-add-to-cart.php';
		}
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function boosted_elements_progression_register_widgets() {
		\Elementor\Plugin::instance()->elements_manager->add_category(
        'boosted-elements-progression',
        [
            'title'  => esc_html__( 'Boosted Elements Addons', 'boosted-elements-progression' ),
            'icon' => 'fa fa-cog'
        ],
        1
    );
	}
    

    
	
}





new BoostedElementsPlugin();
