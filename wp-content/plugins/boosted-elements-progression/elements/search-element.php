<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsSearch extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-search';
	}

	public function get_title() {
		return esc_html__( 'Search - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-search-bold boosted-elements-progression-icon';
	}
    
    
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_search_js'];
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Search Element', 'boosted-elements-progression' )
  			]
  		);
        
        
		$this->add_control(
			'search_form_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Layout', 'boosted-elements-progression' ),
				'options' => [
					'icon' => esc_html__( 'Icon Toggle', 'boosted-elements-progression' ),
                    'input' => esc_html__( 'Input Field', 'boosted-elements-progression' ),
				],
                'default' => 'icon',
			]
		);
        
        
		$this->add_control(
			'sub_menu_indicator',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Search Icon', 'boosted-elements-progression' ),
				'options' => [
					'eicon-search' => esc_html__( 'Search', 'boosted-elements-progression' ),
                    'eicon-search-bold' => esc_html__( 'Search Bold', 'boosted-elements-progression' ),
                    'fas fa-search' => esc_html__( 'Search Font Awesome', 'boosted-elements-progression' ),
                    'fas fa-search-plus' => esc_html__( 'Search Plus Font Awesome', 'boosted-elements-progression' ),
				],
                'default' => 'eicon-search-bold',
				'condition' => [
					'search_form_layout' => 'icon',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Icon Alignment', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-search-icon-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'text-align:left;',
					'center' => 'text-align:center;',
					'right' => 'text-align:right;',
				],
				'condition' => [
					'search_form_layout' => 'icon',
				],
			]
		);
        
        $this->add_control(
        			'header_form',
        			[
        				'label' => __( 'Search Form', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
        
        
		$this->add_control(
			'boosted_elements_placeholder_textarea',
			[
				'placeholder' => esc_html__( 'Placeholder Text', 'boosted-elements-progression' ),
                'label' => esc_html__( 'Placeholder', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Search for...', 'boosted-elements-progression' ),
			]
		);
        
        
		$this->add_control(
			'search_woo_option',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Sitewide Search', 'boosted-elements-progression' ),
				'options' => [
					'sitewide' => esc_html__( 'Default Search', 'boosted-elements-progression' ),
                    'woo' => esc_html__( 'WooCommerce Product Search', 'boosted-elements-progression' ),
				],
                'default' => 'sitewide',
			]
		);
        
        
        
        
        
        $this->add_control(
        			'header_form_button',
        			[
        				'label' => __( 'Button', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
        
        
        
        
		$this->add_control(
			'search_form_btn_text',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Button Type', 'boosted-elements-progression' ),
				'options' => [
					'icon' => esc_html__( 'Icon', 'boosted-elements-progression' ),
                    'text' => esc_html__( 'Text', 'boosted-elements-progression' ),
                    'none' => esc_html__( 'No Button', 'boosted-elements-progression' ),
				],
                'default' => 'text',
			]
		);
        
        
		$this->add_control(
			'search_form_icon_choice',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Button Icon', 'boosted-elements-progression' ),
				'options' => [
					'eicon-search' => esc_html__( 'Search', 'boosted-elements-progression' ),
                    'eicon-search-bold' => esc_html__( 'Search Bold', 'boosted-elements-progression' ),
                    'fas fa-search' => esc_html__( 'Search Font Awesome', 'boosted-elements-progression' ),
                    'fas fa-search-plus' => esc_html__( 'Search Plus Font Awesome', 'boosted-elements-progression' ),
				],
                'default' => 'eicon-search-bold',
				'condition' => [
					'search_form_btn_text' => 'icon',
				],
			]
		);
        

        
		$this->add_control(
			'boosted_elements_submit_button_text_submit',
			[
                'label' => esc_html__( 'Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Submit',
				'condition' => [
					'search_form_btn_text' => 'text',
				],
			]
		);
        
        $this->end_controls_section();
        
  		$this->start_controls_section(
  			'section_search_form_inputss',
  			[
  				'label' => esc_html__( 'Input Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'search_button_stylesinput_type',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]',
			]
		);
        
        
        
		$this->start_controls_tabs( 'boosted_inptu_style_tabs' );

		$this->start_controls_tab( 'normal_input_tab', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_input_main_styles_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_input_main_styles_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_input_main_styles_border',
				'selector' => '{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]',
			]
		);
		
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover_input_tab', [ 'label' => esc_html__( 'Focus', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_input_main_styles_color_hover',
			[
				'label' => esc_html__( 'Focus Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_input_main_styles_background_hover',
			[
				'label' => esc_html__( 'Focus Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		

		$this->add_control(
			'boosted_elements_input_main_styles_border_hover',
			[
				'label' => esc_html__( 'Focus Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
		
		$this->end_controls_tabs();
        
        
		$this->add_control(
			'boosted_elements_input_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
        

		$this->add_responsive_control(
			'boosted_elements_cinput_main_padding',
			[
				'label' => esc_html__( 'Input Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_control(
			'boosted_elements_input_main_border',
			[
				'label' => esc_html__( ' Input Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boosted_elements_input_main_box_shadow',
                
				'selector' => '{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form input.boosted-elements-search-field[type=search]',
			]
		);
        

        
        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_search_form_buttons',
  			[
  				'label' => esc_html__( 'Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'search_button_styles_btn_top',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit',
			]
		);
		
        
        
		$this->start_controls_tabs( 'boosted_checkoutbutn_tabs' );

		$this->start_controls_tab( 'normal_checkout_btn', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_search_button_styles_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_search_button_styles_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_search_button_styles_border',
				'selector' => '{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit',
			]
		);
		
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover_search_button_styles', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_search_button_styles_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_search_button_styles_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		

		$this->add_control(
			'boosted_elements_search_button_styles_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
		
		$this->end_controls_tabs();
        
        
        
		$this->add_responsive_control(
			'boosted_elements_search_button_styles_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_search_button_styles_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-input-field .boosted-elements-search-form button.boosted-elements-search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
        
        
        $this->end_controls_section();
        
        
        
  		$this->start_controls_section(
  			'section_button_boosted',
  			[
  				'label' => esc_html__( 'Toggle Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_nav_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_nav_border',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-search-ico',
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
					'{{WRAPPER}} .boosted-elements-progression-search-ico:hover, {{WRAPPER}} .boosted-elements-progression-search-container.boosted-elements-active-search-icon-pro .boosted-elements-progression-search-ico' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico:hover, {{WRAPPER}} .boosted-elements-progression-search-container.boosted-elements-active-search-icon-pro .boosted-elements-progression-search-ico' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		

		$this->add_control(
			'boosted_elements_nav_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico:hover, {{WRAPPER}} .boosted-elements-progression-search-container.boosted-elements-active-search-icon-pro .boosted-elements-progression-search-ico' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
		
		$this->end_controls_tabs();
        
        
        
		$this->add_responsive_control(
			'search_toggle-size',
			[
				'label' => esc_html__( 'Toggle Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'separator' => 'before',
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'search_toggle_width',
			[
				'label' => esc_html__( 'Toggle Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'search_toggle_height',
			[
				'label' => esc_html__( 'Toggle Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        
		$this->add_responsive_control(
			'boosted_elements_nav_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,                
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-search-ico' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        

        
		$this->end_controls_section();
        
        
        
        
  		$this->start_controls_section(
  			'section_search_container',
  			[
  				'label' => esc_html__( 'Container Styles (Toggle)', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
  			]
  		);
        
        
        
        
		$this->add_control(
			'boosted_elements_cart_mini_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-panel' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .boosted-elements-search-panel:before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_cart_container_border',
				'selector' => '{{WRAPPER}} .boosted-elements-search-panel',
			]
		);
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boosted_elements_cart_container_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-search-panel',
			]
		);
        

        
		$this->add_responsive_control(
			'boosted_elements_cart_mini_padding',
			[
				'label' => esc_html__( 'Container Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_control(
			'boosted_elements_cart_mini_border',
			[
				'label' => esc_html__( ' Container Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-search-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
        $this->add_control(
        			'header_search_container_width',
        			[
        				'label' => __( 'Container Width', 'plugin-domain' ),
        				'type' => Controls_Manager::SLIDER,
        				'size_units' => [ 'px', '%' ],
        				'range' => [
        					'px' => [
        						'min' => 100,
        						'max' => 1000,
        						'step' => 1,
        					],
        					'%' => [
        						'min' => 0,
        						'max' => 100,
        					],
        				],
        				'default' => [
        					'unit' => 'px',
        					'size' => 400,
        				],
        				'selectors' => [
        					'{{WRAPPER}} .boosted-elements-search-panel' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-search-panel' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'right:auto; left:0px;',
					'right' => 'left:auto; right:0px;',
				],
			]
		);
        
        $this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();

	?>
    
    
    <?php if ( $settings['search_form_layout'] == 'icon' ) : ?>
        <div class="boosted-elements-search-icon-align">

    	<div class="boosted-elements-progression-search-container">			
    		<div class="boosted-elements-progression-search-ico"><i class="<?php echo esc_attr( $settings['sub_menu_indicator'] ); ?>"></i><i class="fas fa-times"></i></div>
    		<div class="boosted-elements-search-panel">

               <div class="boosted-elements-search-input-field<?php if ( $settings['search_form_btn_text'] == 'none' ) : ?> boosted-elements-search-no-button<?php endif ?>">
                   <?php if ( $settings['search_woo_option'] == 'sitewide' ) : ?>
                       <form method="get" class="boosted-elements-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                       	<label>
                       		<span class="boosted-elements-screen-reader-text"><?php echo esc_attr( 'Search for:', 'boosted-elements-progression' ); ?></span>
                       	</label>
                           <input type="search" class="boosted-elements-search-field" placeholder="<?php echo esc_attr( $settings['boosted_elements_placeholder_textarea'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s"><button type="submit" class="boosted-elements-search-submit" value="<?php echo esc_html__( 'Search', 'boosted-elements-progression' ); ?>"><?php if ( $settings['search_form_btn_text'] == 'icon' ) : ?><i class="<?php echo esc_attr( $settings['search_form_icon_choice'] ); ?> fa-fw"></i><?php else: ?><?php echo esc_attr( $settings['boosted_elements_submit_button_text_submit'] ); ?><?php endif ?></button>
                       	<div class="clearfix-boosted-element"></div>
                       </form>
       			<?php else: ?>
                       <form role="search" method="get" class="boosted-elements-search-form woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                       	<label class="boosted-elements-screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'boosted-elements-progression' ); ?></label>
                       	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="boosted-elements-search-field" placeholder="<?php echo esc_attr( $settings['boosted_elements_placeholder_textarea'] ); ?>" value="<?php echo get_search_query(); ?>" name="s" /><button class="boosted-elements-search-submit" type="submit" value="<?php echo esc_html__( 'Search', 'boosted-elements-progression' ); ?>"><?php if ( $settings['search_form_btn_text'] == 'icon' ) : ?><i class="<?php echo esc_attr( $settings['search_form_icon_choice'] ); ?> fa-fw"></i><?php else: ?><?php echo esc_attr( $settings['boosted_elements_submit_button_text_submit'] ); ?><?php endif ?></button>
                       	<input type="hidden" name="post_type" value="product" />
                       </form>
       			<?php endif ?>
               </div><!-- close .boosted-elements-search-input-field -->
               <div class="clearfix-boosted-element"></div>
               
    		</div><!-- close .boosted-elements-search-panel -->
    	</div><!-- close .boosted-elements-progression-search-container -->
    	</div><!-- close .boosted-elements-search-icon-align -->
        
        <?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode()) : ?>
            <script>
                jQuery(document).ready(function($) {
                	 'use strict';
     
                    var hidesearch = false;
                 	var clickOrTouch = (('ontouchend' in window)) ? 'touchend' : 'click';
	
                  	$(".boosted-elements-progression-search-container .boosted-elements-progression-search-ico").on(clickOrTouch, function(e) {
                 		var clicks = $(this).data('clicks');
                 		  if (clicks) {
                 		     $(".boosted-elements-progression-search-container").removeClass("boosted-elements-active-search-icon-pro");
                 		     $(".boosted-elements-progression-search-container").addClass("boosted-elements-hide-search-icon-pro");
			 
                 		  } else {
                 		     $(".boosted-elements-progression-search-container").addClass("boosted-elements-active-search-icon-pro");
                 			  $(".boosted-elements-progression-search-container").removeClass("boosted-elements-hide-search-icon-pro");
                 		  }
                 		  $(this).data("clicks", !clicks);
                  	});
     
     
                });
            </script>
        <?php endif ?>
        
    <?php else: ?>
        
        <div class="boosted-elements-search-input-field<?php if ( $settings['search_form_btn_text'] == 'none' ) : ?> boosted-elements-search-no-button<?php endif ?>">
            <?php if ( $settings['search_woo_option'] == 'sitewide' ) : ?>
                <form method="get" class="boosted-elements-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                	<label>
                		<span class="boosted-elements-screen-reader-text"><?php echo esc_attr( 'Search for:', 'boosted-elements-progression' ); ?></span>
                	</label>
                    <input type="search" class="boosted-elements-search-field" placeholder="<?php echo esc_attr( $settings['boosted_elements_placeholder_textarea'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s"><button type="submit" class="boosted-elements-search-submit" value="<?php echo esc_html__( 'Search', 'boosted-elements-progression' ); ?>"><?php if ( $settings['search_form_btn_text'] == 'icon' ) : ?><i class="<?php echo esc_attr( $settings['search_form_icon_choice'] ); ?> fa-fw"></i><?php else: ?><?php echo esc_attr( $settings['boosted_elements_submit_button_text_submit'] ); ?><?php endif ?></button>
                	<div class="clearfix-boosted-element"></div>
                </form>
			<?php else: ?>
                <form role="search" method="get" class="boosted-elements-search-form woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                	<label class="boosted-elements-screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'boosted-elements-progression' ); ?></label>
                	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="boosted-elements-search-field" placeholder="<?php echo esc_attr( $settings['boosted_elements_placeholder_textarea'] ); ?>" value="<?php echo get_search_query(); ?>" name="s" /><button class="boosted-elements-search-submit" type="submit" value="<?php echo esc_html__( 'Search', 'boosted-elements-progression' ); ?>"><?php if ( $settings['search_form_btn_text'] == 'icon' ) : ?><i class="<?php echo esc_attr( $settings['search_form_icon_choice'] ); ?> fa-fw"></i><?php else: ?><?php echo esc_attr( $settings['boosted_elements_submit_button_text_submit'] ); ?><?php endif ?></button>
                	<input type="hidden" name="post_type" value="product" />
                </form>
			<?php endif ?>
        </div><!-- close .boosted-elements-search-input-field -->
        <div class="clearfix-boosted-element"></div>
        
    <?php endif ?>
    
   
    
    
   
    
	
    
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsSearch() );