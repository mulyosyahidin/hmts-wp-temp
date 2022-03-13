<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsCart extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-cart';
	}

	public function get_title() {
		return esc_html__( 'Cart - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-cart boosted-elements-progression-icon';
	}
    
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_cart_js'];
	}
    
   public function get_categories() {
		return [ 'boosted-elements-progression' ];
    }

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Cart General', 'boosted-elements-progression' )
  			]
  		);
        
		$this->add_control(
			'cart_icon',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Dropdown Icon', 'boosted-elements-progression' ),
				'options' => [
					'cart-light' => esc_html__( 'Cart Light', 'boosted-elements-progression' ),  
					'cart-medium' => esc_html__( 'Cart Medium', 'boosted-elements-progression' ),
					'cart-solid' => esc_html__( 'Cart Solid', 'boosted-elements-progression' ),  
					'basket-light' => esc_html__( 'Basket', 'boosted-elements-progression' ),
					'basket-medium' => esc_html__( 'Basket Medium', 'boosted-elements-progression' ),
					'basket-solid' => esc_html__( 'Basket Solid', 'boosted-elements-progression' ),
					'bag-light' => esc_html__( 'Bag Light', 'boosted-elements-progression' ),
                    'bag-medium' => esc_html__( 'Bag Medium', 'boosted-elements-progression' ),
                    'bag-solid' => esc_html__( 'Bad Solid', 'boosted-elements-progression' ),
				],
				'default' => 'cart-medium',
				'prefix_class' => 'toggle-icon--',
			]
		);
        
		$this->add_control(
			'sub_total_display',
			[
				'label' => esc_html__( 'Subtotal', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'boosted-elements-progression' ),
				'label_off' => esc_html__( 'No', 'boosted-elements-progression' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'boosted-menu-sub-total-default-',
			]
		);
   

        
		$this->add_control(
			'count_icon',
			[
				'label' => esc_html__( 'Count Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'boosted-elements-progression' ),
				'label_off' => esc_html__( 'No', 'boosted-elements-progression' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'prefix_class' => 'boosted-menu-cart-count-display-',
			]
		);
        
		$this->add_control(
			'count_icon_empty',
			[
				'label' => esc_html__( 'Hide Icon When Empty', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'boosted-elements-progression' ),
				'label_off' => esc_html__( 'No', 'boosted-elements-progression' ),
				'return_value' => 'yes',
				'prefix_class' => 'boosted-menu-count-empty-',
				'condition' => [
					'count_icon' => 'yes',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'boosted-elements-progression' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'eicon-text-align-right',
                    ]
				],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'text-align:left;',
					'center' => 'text-align:center;',
					'right' => 'text-align:right;',
				],
			]
		);
        
        
		$this->add_control(
			'mini_cart_optional_button',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Cart Button', 'boosted-elements-progression' ),
				'options' => [
					'cart' => esc_html__( 'View Cart Button', 'boosted-elements-progression' ),  
					'checkout' => esc_html__( 'Checkout Button', 'boosted-elements-progression' ),
				],
				'default' => 'cart',
			]
		);
        
		

		$this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_button_boosted',
  			[
  				'label' => esc_html__( 'General Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'cart_button_top',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link',
			]
		);
        
        
		$this->start_controls_tabs( 'boosted_main_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_nav_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_nav_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_nav_border',
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link',
			]
		);
		
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_nav_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		

		$this->add_control(
			'boosted_elements_nav_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
		
		$this->end_controls_tabs();
        
        

        
		$this->add_responsive_control(
			'boosted_elements_nav_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_nav_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-cart-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_control(
        			'header_icon_cart',
        			[
        				'label' => __( 'Icon Cart', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_responsive_control(
			'header_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-cart-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-cart-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
        			'header_count_cart',
        			[
        				'label' => __( 'Counter', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_control(
			'boosted_elements_count_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_count_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_count_size',
			[
				'label' => esc_html__( 'Count Font Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_count_container_size',
			[
				'label' => esc_html__( 'Count Counter Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_count_position_top',
			[
				'label' => esc_html__( 'Count Position Top', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'header_count_position',
			[
				'label' => esc_html__( 'Count Position Right', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count span.boosted-elements-cart-count' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_cart_general',
  			[
  				'label' => esc_html__( 'Cart Container', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'cart_default_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart',
			]
		);
        
		$this->add_control(
			'boosted_elements_cart_mini_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart:before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_cart_container_border',
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart',
			]
		);
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boosted_elements_cart_container_box_shadow',
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart',
			]
		);
        

        
		$this->add_responsive_control(
			'boosted_elements_cart_mini_padding',
			[
				'label' => esc_html__( 'Cart Container Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'boosted_elements_cart_mini_border',
			[
				'label' => esc_html__( 'Cart Container Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'header_cart_mini_width_size',
			[
				'label' => esc_html__( 'Cart Container Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
               'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart' => 'width: {{SIZE}}{{UNIT}}; ',
				],
			]
		);
        
		$this->add_responsive_control(
			'cart_mini_alignment_position',
			[
				'label' => esc_html__( 'Alignment', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-right',
                    ]
				],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count .boosted-elements-mini-cart' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'right:auto; left:0px;',
					'right' => 'left:auto; right:0px;',
				],
			]
		);

        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_product_list',
  			[
  				'label' => esc_html__( 'Product List', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
        $this->add_control(
        			'header_product_list_list',
        			[
        				'label' => __( 'List', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_control(
			'boosted_elements_product_divider_color',
			[
				'label' => esc_html__( 'Divider Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li' => 'border-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_cart_listdivider_padding',
			[
				'label' => esc_html__( 'List Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_cart_listdivider_margins',
			[
				'label' => esc_html__( 'List Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_control(
        			'header_product_list_title',
        			[
        				'label' => __( 'Title', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_product_list_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text h6',
			]
		);
        
		$this->add_control(
			'boosted_elements_product_list_title',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text h6' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_cart_listd_title_margins',
			[
				'label' => esc_html__( 'Title Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_control(
        			'header_product_list_price',
        			[
        				'label' => __( 'Meta', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_product_list_price_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text dt, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text dd, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-mini-cart-quantity',
			]
		);
        
		$this->add_control(
			'boosted_elements_product_list_price',
			[
				'label' => esc_html__( 'Meta Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text dt, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text dd, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-cart-mini-text, {{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li .boosted-elements-mini-cart-quantity' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
        			'header_product_list_close_button',
        			[
        				'label' => __( 'Remove Button', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_control(
			'boosted_elements_product_close_button_color',
			[
				'label' => esc_html__( 'Remove Button Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li a.boosted-elements-min-cart-remove' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_product_close_button_border',
			[
				'label' => esc_html__( 'Remove Button Border', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} #boosted-elements-shopping-cart-count ul#boosted-elements-cart-product-list li a.boosted-elements-min-cart-remove' => 'border-color: {{VALUE}};',
				],
			]
		);
        
        $this->add_control(
        			'header_product_list_subtotal',
        			[
        				'label' => __( 'Subtotal', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
        
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_product_list_subtotal_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count #boosted-elements-mini-cart-subtotal',
			]
		);
        
		$this->add_control(
			'boosted_elements_product_lsubtotal_price',
			[
				'label' => esc_html__( 'Subtotal Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count #boosted-elements-mini-cart-subtotal' => 'color: {{VALUE}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'boosted_elements_list_subtotal_margin',
			[
				'label' => esc_html__( 'Subtotal Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count #boosted-elements-mini-cart-subtotal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_cart_buttons',
  			[
  				'label' => esc_html__( 'View Cart Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);

        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'cart_view_cart_btn_top',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button',
			]
		);
        
        
		$this->start_controls_tabs( 'boosted_checkoutbutn_tabs' );

		$this->start_controls_tab( 'normal_checkout_btn', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_view_cart_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_view_cart_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_view_cart_border',
				'selector' => '{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button',
			]
		);
		
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover_view_cart', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_view_cart_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_view_cart_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		

		$this->add_control(
			'boosted_elements_view_cart_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button:hover, {{WRAPPER}} #boosted-elements-shopping-cart-count.boosted-cart-activated-class a.boosted-elements-cart-link' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
		
		$this->end_controls_tabs();
        
        
        
		$this->add_responsive_control(
			'boosted_elements_view_cart_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_view_cart_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #boosted-elements-shopping-cart-count a.boosted-elements-mini-cart-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
        
        
        $this->end_controls_section();
        
        
		
	}


	protected function render( ) {
        
		if ( null === WC()->cart ) {
			return;
		}
		
      $settings = $this->get_settings();
		
      global $woocommerce;
	?>
    

    <div id="boosted-elements-shopping-cart-align">
        
	<div id="boosted-elements-shopping-cart-count">			
        <div id="boosted-elements-cart-subtotal-button"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="boosted-elements-cart-link<?php if ( WC()->cart->get_cart_contents_count() == 0 ) : ?> boosted-cart-empty-hide<?php endif ?>"><div id="boosted-elements-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></div><div class="boosted-elements-cart-icon"><i class="eicon-cart-medium"></i><span class="boosted-elements-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></div> </a></div>
        
        <div class="boosted-elements-mini-cart">
            <ul id="boosted-elements-cart-product-list">
                <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
                    
					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
						$_product = $cart_item['data'];
						// Only display if allowed
						if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
							continue;
						// Get price
						$product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
						$product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
						?>
					<li>
						<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

							<?php echo wp_kses($_product->get_image() , true); ?>

							<div class="boosted-elements-cart-mini-text">
								<h6><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></h6>
								<?php echo wp_kses( wc_get_formatted_cart_item_data( $cart_item ), true ); ?>
								<span class="boosted-elements-mini-cart-quantity"><?php printf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></span>
							</div>
							<div class="clearfix-boosted-element"></div>
						</a>
					
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="boosted-elements-min-cart-remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'boosted-elements-progression' ),
								esc_attr( $cart_item['product_id'] ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					
						<div class="clearfix-boosted-element"></div>
					</li>
					<?php endforeach; ?>
                    
                    
				<?php else : ?>
					<li><div class="boosted-elements-mini-cart-empty"><?php esc_html_e('No products in the cart.', 'boosted-elements-progression'); ?></div></li>
				<?php endif; ?>
                
            </ul>
            
            <div class="clearfix-boosted-element"></div>
            
            <?php if ( $settings['mini_cart_optional_button'] == 'cart' ) : ?>
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="boosted-elements-mini-cart-button"><?php esc_html_e('View Cart','boosted-elements-progression'); ?></a>
            <?php else : ?>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="boosted-elements-mini-cart-button"><?php esc_html_e('Checkout','boosted-elements-progression'); ?></a>
            <?php endif; ?>
            
            <div id="boosted-elements-mini-cart-subtotal"><?php esc_html_e('Subtotal:', 'boosted-elements-progression'); ?> <span class="boosted-elements-total-number-add"><?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), true ); ?></span> </div>
            
            <div class="clearfix-boosted-element"></div>
        </div><!-- close .boosted-elements-mini-car -->
	</div><!-- close #boosted-elements-shopping-cart-count -->
	</div><!-- close #boosted-elements-shopping-cart-align -->
	
    
    <?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode()) : ?>
        <script>
            jQuery(document).ready(function($) {
            	 'use strict';
     
                 var hidecart = false;
                 $("#boosted-elements-shopping-cart-count").hover(function(){
                     if (hidecart) clearTimeout(hidecart);
             		$("#boosted-elements-shopping-cart-count").addClass("boosted-cart-activated-class").removeClass("boosted-cart-hover-out-class");
                 }, function() {
                     hidecart = setTimeout(function() { 
             			$("#boosted-elements-shopping-cart-count").removeClass("boosted-cart-activated-class").addClass("boosted-cart-hover-out-class");
             		}, 100);
                 });
     

            });
        </script>
    <?php endif ?>
    
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsCart() );