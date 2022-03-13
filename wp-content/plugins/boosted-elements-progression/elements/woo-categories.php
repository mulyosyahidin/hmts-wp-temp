<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsWooCategories extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-woo-categories';
	}

	public function get_title() {
		return esc_html__( 'Categories - Boosted', 'boosted-elements-progression' );
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
				'default' => '12',
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
			'boosted_woo_cat_hide_empty',
			[
				'label' => esc_html__( 'Hide Empty Categories', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_woo_cat_parents',
			[
				'label' => esc_html__( 'Display Top Level Categories Only', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_post_type_categories',
			[
				'label' => esc_html__( 'Display Child Categories Underneath', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_elements_post_type_product_categories_by_id(),
				'condition' => [
					'boosted_woo_cat_parents!' => 'yes',
				],
			]
		);
		
		
		
		
		$this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>
	
	
	
	
	

	<div class="boosted-elements-progression-woo-categories-container">			
		<?php 
			$boosted_cols = esc_attr($settings['boosted_woo_columns'] );
			$boosted_post_count = esc_attr($settings['boosted_woo_post_count'] );
			$boosted_orderby = esc_attr($settings['boosted_woo_order_by'] );
			$boosted_order_asc_desc = esc_attr($settings['boosted_woo_order_asc_desc'] );
			if ( ! empty( $settings['boosted_woo_cat_hide_empty'] ) ){
				$hide_empty = '1';
			} else{
				$hide_empty = '0';
			}
			
			if ($settings['boosted_woo_cat_parents'] == 'yes' ){
				$productcatids = '0';
			} else{
				
				$productcatarray = $settings['boosted_post_type_categories']; // get custom field value
				if($productcatarray >= 1 ) { 
					$productcatids = implode(', ', $productcatarray); 
				} else {
					$productcatids = '';
				}
				
			}
			

			echo do_shortcode('[product_categories number="' . $boosted_post_count . '" columns="' . $boosted_cols . '" orderby="' . $boosted_orderby . '" order="' . $boosted_order_asc_desc . '" hide_empty="' . $hide_empty . '" parent="' . $productcatids . '" ]');
		
		?>
		

	</div><!-- close .boosted-elements-progression-woo-categories-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsWooCategories() );