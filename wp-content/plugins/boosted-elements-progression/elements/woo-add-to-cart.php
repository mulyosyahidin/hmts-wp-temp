<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsWooAddToCart extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-woo-add-to-cart';
	}

	public function get_title() {
		return esc_html__( 'Add to Cart - Boosted', 'boosted-elements-progression' );
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
			'boosted_add_to_cart_product_id',
			[
				'label' => esc_html__( 'Select a Product', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => boosted_elements_get_product_by_id(),
			]
		);
		
		$this->add_control(
			'boosted_add_to_cart_price',
			[
				'label' => esc_html__( 'Display Price?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		
		$this->add_control(
			'boosted_add_to_cart_text',
			[
				'label' => esc_html__( 'Add to Cart Label', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Add to Cart',
			]
		);
		
		$this->add_control(
			'boosted_add_to_cart_icon',
			[
				'type' => Controls_Manager::ICON,
				'label' => esc_html__( 'Icon', 'progression-elements-viseo' ),
			]
		);
		
		$this->add_control(
			'boosted_add_to_cart_icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_add_to_cart_icon!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_add_to_cart_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-woocommerce-button i' => 'padding-left: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-add-to-cart-left-icon .boosted-woocommerce-button i.boosted-add-cart-icon-left' => 'padding-right: {{SIZE}}px; padding-left:0px;',
				],
				'condition' => [
					'boosted_add_to_cart_icon!' => '',
				],
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_add_to_cart_icon_align',
			[
				'label' => esc_html__( 'Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		
		
		$this->start_controls_section(
			'section_main_container_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_add_cart_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button',
			]
		);
		
		
		$this->start_controls_tabs( 'boosted_elements_load_more_btn_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_load_more_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button' => 'color: {{VALUE}};',
				],

			]
		);
		

		
		$this->add_control(
			'boosted_elements_load_more_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button' => 'background-color: {{VALUE}};',
				],

			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_add_cart_button_border_main_control',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button',
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' )] );

		$this->add_control(
			'boosted_elements_load_more_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button:hover' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'boosted_elements_load_more_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button:hover' => 'background-color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'boosted_elements_load_more_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button:hover' => 'border-color: {{VALUE}};',
				],

			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		
		
		
		$this->add_responsive_control(
			'boosted_add_cart_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_add_cart_button_border_radius',
			[
				'label' => esc_html__( 'Button Border Radius', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container p.product.woocommerce.add_to_cart_inline a.button.boosted-woocommerce-button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_price_styles',
			[
				'label' => esc_html__( 'Price Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_add_to_cart_price' => 'yes',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_price_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text span.amount',
			]
		);
		
		$this->add_control(
			'boosted_price_typography_color',
			[
				'label' => esc_html__( 'Price Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text span.amount' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_price_typography_sale_color',
			[
				'label' => esc_html__( 'Sale Price Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text del' => 'color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text del span.amount' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_add_to_cart_icon_display_block',
			[
				'label' => esc_html__( 'Price Display', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline-block',
				'options' => [
					'inline-block' => esc_html__( 'Inline', 'boosted-elements-progression' ),
					'block' => esc_html__( 'Block', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text' => 'display: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_price_spacing',
			[
				'label' => esc_html__( 'Price Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-woo-add-to-cart-container span.boosted-add-cart-price-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
		if ( empty( $settings['boosted_add_to_cart_product_id'] ) ) {
			return;
		}

		$product_data = get_post( $settings['boosted_add_to_cart_product_id']);
		$product = is_object( $product_data ) && in_array( $product_data->post_type, array( 'product', 'product_variation' ) ) ? wc_setup_product_data( $product_data ) : false;

	?>



	<div class="boosted-elements-progression-woo-add-to-cart-container <?php if($settings['boosted_add_to_cart_icon_position'] == 'left'): ?>boosted-add-to-cart-left-icon<?php endif; ?>">			
			
			<p class="product woocommerce add_to_cart_inline">
				<?php if($settings['boosted_add_to_cart_price'] == 'yes'): ?><span class="boosted-add-cart-price-text"><?php echo $product->get_price_html(); ?></span><?php endif; ?>
				<?php
				
				$class = implode( ' ', array_filter( [
					'button boosted-woocommerce-button',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
				] ) );
				
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa %s boosted-add-cart-icon-left"></i>%s<i class="fa %s boosted-add-cart-icon-right"></i></a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $quantity ) ? $quantity : 1 ),
						esc_attr( $product->get_id() ),
						esc_attr( $product->get_sku() ),
						esc_attr( isset( $class ) ? $class : 'button' ),
						esc_html( $settings['boosted_add_to_cart_icon'] ),
						esc_html( $settings['boosted_add_to_cart_text'] ),
						esc_html( $settings['boosted_add_to_cart_icon'] )
					), $product);
				

				
				?>
			</p>
		
	</div><!-- close .boosted-elements-progression-woo-add-to-cart-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsWooAddToCart() );