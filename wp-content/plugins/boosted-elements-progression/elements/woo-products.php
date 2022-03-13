<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsWooProducts extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-woo-product-list';
	}

	public function get_title() {
		return esc_html__( 'Products - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-woocommerce boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Product', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_woo_product_filter',
			[
				'label' => esc_html__( 'Display', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'recent_products',
				'options' => [
					'recent_products' => esc_html__( 'Products', 'boosted-elements-progression' ),
					'featured_products' => esc_html__( 'Feaured Products', 'boosted-elements-progression' ),
					'sale_products' => esc_html__( 'On Sale Products', 'boosted-elements-progression' ),
					'best_selling_products' => esc_html__( 'Best Selling Products', 'boosted-elements-progression' ),
					'top_rated_products' => esc_html__( 'Top Rated Products', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_woo_columns',
			[
				'label' => esc_html__( 'Columns', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => esc_html__( '1 Column', 'boosted-elements-progression' ),
					'2' => esc_html__( '2 Columns', 'boosted-elements-progression' ),
					'3' => esc_html__( '3 Columns', 'boosted-elements-progression' ),
					'4' => esc_html__( '4 Columns', 'boosted-elements-progression' ),
					'5' => esc_html__( '5 Columns', 'boosted-elements-progression' ),
					'6' => esc_html__( '6 Columns', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_woo_post_count',
			[
				'label' => esc_html__( 'Product Count', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
			]
		);
		
		
		
		$this->add_control(
			'boosted_woo_order_by',
			[
				'label' => esc_html__( 'Order By', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'separator' => 'before',
				'options' => [
					'date' => esc_html__( 'Default - Date', 'boosted-elements-progression' ),
					'title' => esc_html__( 'Post Title', 'boosted-elements-progression' ),
					'menu_order' => esc_html__( 'Menu Order', 'boosted-elements-progression' ),
					'rand' => esc_html__( 'Random', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_woo_order_asc_desc',
			[
				'label' => esc_html__( 'Order', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'Ascending', 'boosted-elements-progression' ),
					'DESC' => esc_html__( 'Descending', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_post_type_categories',
			[
				'label' => esc_html__( 'Product Categories', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_elements_post_type_product_categories(),
			]
		);
		
		$this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
		$productcatarray = $settings['boosted_post_type_categories']; // get custom field value
		if($productcatarray >= 1 ) { 
			$productcatids = implode(', ', $productcatarray); 
		} else {
			$productcatids = '';
		}

	?>
	



	<div class="boosted-elements-progression-woo-product-list-container">			
		<?php 
			$boosted_filter = esc_attr($settings['boosted_woo_product_filter'] );
			$boosted_cols = esc_attr($settings['boosted_woo_columns'] );
			$boosted_post_count = esc_attr($settings['boosted_woo_post_count'] );
			$boosted_orderby = esc_attr($settings['boosted_woo_order_by'] );
			$boosted_order_asc_desc = esc_attr($settings['boosted_woo_order_asc_desc'] );

			echo do_shortcode('[' . $boosted_filter . ' per_page="' . $boosted_post_count . '" columns="' . $boosted_cols . '" orderby="' . $boosted_orderby . '" order="' . $boosted_order_asc_desc . '" category="' . $productcatids . '"]');
		
		?>
	</div><!-- close .boosted-elements-progression-woo-product-list-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsWooProducts() );