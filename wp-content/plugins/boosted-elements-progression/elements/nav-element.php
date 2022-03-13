<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsNavi extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-navi';
	}

	public function get_title() {
		return esc_html__( 'Navigation - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-nav-menu boosted-elements-progression-icon';
	}

    public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
    
	public function get_script_depends() { 
		return [ 'boosted_elements_prgoression_navigation'];
	}
    
	public function get_style_depends() { 
		return [ 'elementor-icons-fa-solid'];
	}
    
	public function grab_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
	}

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Navigation Element', 'boosted-elements-progression' )
  			]
  		);
		
	    
        $menus = $this->grab_available_menus();
		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu_select',
				[
					'label' => esc_html__( 'Menu Select', 'boosted-elements-progression' ),
					'type' => Controls_Manager::SELECT,
					'options'   => $this->grab_available_menus(),
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( __( 'Go to <a href="%s" target="_blank">Appearance Menus</a> to edit your menus', 'boosted-elements-progression' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu_select',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no navigation menus available.', 'boosted-elements-progression' ) . '</strong><br>' . sprintf( __( 'Please create one in your <a href="%s" target="_blank">Menus screen</a>', 'boosted-elements-progression' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
        
        
		$this->add_control(
			'menu_align_elements',
			[
				'label' => esc_html__( 'Menu Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Stretch', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
                'default' => 'center',
                'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-menu-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'display:flex; justify-content: left;',
					'center' => 'display:flex; justify-content: center;',
					'right' => 'display:flex; justify-content:flex-end;',
                    'justify' => '',
				],
			]
		);
        
        
		$this->add_control(
			'sub_menu_indicator',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Dropdown Icon', 'boosted-elements-progression' ),
				'options' => [
					'fas fa-angle-down' => esc_html__( 'Angle', 'boosted-elements-progression' ),
                    'fas fa-chevron-down' => esc_html__( 'Chevron', 'boosted-elements-progression' ),
					'fas fa-caret-down' => esc_html__( 'Triangle', 'boosted-elements-progression' ),
					'fas fa-plus' => esc_html__( 'Plus', 'boosted-elements-progression' ),
                    'fas fa-angle-double-down' => esc_html__( 'Double Down', 'boosted-elements-progression' ),
                    'fas fa-long-arrow-alt-down' => esc_html__( 'Long Arrow', 'boosted-elements-progression' ),
				],
                'default' => 'fas fa-angle-down',
			]
		);
        
		$this->add_control(
			'sub_menu_indicator_size',
			[
				'label' => esc_html__( 'Dropdown Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-item-has-children .drop-down-icon-boosted' => 'font-size: {{SIZE}}px;',
				],
			]
		);
        
		$this->add_control(
			'sub_menu_indicator_size_submenu',
			[
				'label' => esc_html__( 'Submenu Dropdown Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sub-menu .menu-item-has-children .drop-down-icon-boosted' => 'font-size: {{SIZE}}px;',
				],
			]
		);
        
        
        
		
        
        
        $this->add_control(
        			'mobile_heading_icon',
        			[
        				'label' => __( 'Mobile Menu Settings', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		
        
        
		$this->add_control(
			'break_point_menu',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Breakpoint', 'boosted-elements-progression' ),
				'options' => [
                    'mobile' => esc_html__( 'Mobile (< 768px)', 'boosted-elements-progression' ),
					'tablet' => esc_html__( 'Tablet (< 1025px)', 'boosted-elements-progression' ),
                    'always' => esc_html__( 'Always Display Mobile Menu', 'boosted-elements-progression' ),
					'none' => esc_html__( 'No Mobile Menu', 'boosted-elements-progression' ),
				],
                'default' => 'tablet',
			]
		);

                
                
		$this->add_control(
			'mobile_menu_icon',
			[
				'label' => esc_html__( 'Mobile Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
                'default' => [
	                    'value' => 'fas fa-bars',
	                     'library' => 'solid',
                    ],
    				'condition' => [
    					'break_point_menu!' => 'none',
    				],
			]
		);
        
		$this->add_control(
			'mobile_menu_align',
			[
				'label' => esc_html__( 'Mobile Icon Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-icon-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'center' => 'text-align:center;',
					'right' => 'text-align:right;',
                    'justify' => '',
				],
				'condition' => [
					'break_point_menu!' => 'none',
				],
			]
		);
		
		$this->add_control(
			'custom_mobile_menu',
			[
				'label' => esc_html__( 'Custom Mobile Menu', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'condition' => [
					'break_point_menu!' => 'none',
				],
			]
		);
        
		$this->add_control(
			'mobile_menu_select',
			[
				'label' => esc_html__( 'Menu Select', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options'   => $this->grab_available_menus(),
				'description' => esc_html__( 'Optional Mobile Menu. Leave blank to use same menu on mobile and desktop', 'boosted-elements-progression' ),
                'default' => 'tablet',
				'condition' => [
					'custom_mobile_menu' => 'yes',
				],
			]
		);
        
        
		
		$this->end_controls_section();
        
        
        
  		$this->start_controls_section(
  			'section_nav_main_styles',
  			[
  				'label' => esc_html__( 'Menu Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_title_boosted_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def',
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
					'{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_nav_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        
		$this->add_control(
			'menu_underline_option',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Underline', 'boosted-elements-progression' ),
				'options' => [
					'none' => esc_html__( 'Hide', 'boosted-elements-progression' ),
                    'hover' => esc_html__( 'Display on Hover', 'boosted-elements-progression' ),
                    'always' => esc_html__( 'Always Display', 'boosted-elements-progression' ),
				],
                'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .item-underline-nav-boosted:before' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'none' => 'display:none;',
					'hover' => 'display:block;',
                    'always' => 'width:100%; left:0; opacity:1;',
				],
                
                
                
			]
		);
		
        
		$this->add_control(
			'boosted_elements_underline_color',
			[
				'label' => esc_html__( 'Underline Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def .item-underline-nav-boosted:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'menu_underline_option' => 'always',
				],
			]
		);
        
        

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_nav_border',
				'selector' => '{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def',
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
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item a.boosted-nav-link-def:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item a.boosted-nav-link-def:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_nav_underline_hover',
			[
				'label' => esc_html__( 'Hover Underline Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def .item-underline-nav-boosted:before, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted a.boosted-nav-link-def .item-underline-nav-boosted:before, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item a.boosted-nav-link-def:hover .item-underline-nav-boosted:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'menu_underline_option!' => 'none',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item a.boosted-nav-link-def:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
        $this->start_controls_tab( 'boosted_elements_active', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_nav_color_active',
			[
				'label' => esc_html__( 'Active Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_nav_background_active',
			[
				'label' => esc_html__( 'Active Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_nav_underline_active',
			[
				'label' => esc_html__( 'Active Underline Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def .item-underline-nav-boosted:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'menu_underline_option!' => 'none',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_border_active',
			[
				'label' => esc_html__( 'Active Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .current-menu-item a.boosted-nav-link-def' => 'border-color: {{VALUE}};',
				],
			]
		);
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        $this->add_control(
        			'heading_divider',
        			[
        				'label' => __( 'Menu Spacing', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
        
        
		$this->add_responsive_control(
			'boosted_elements_nav_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements.sf-arrows .sf-with-ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_nav_margins',
			[
				'label' => esc_html__( 'Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements li.menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sf-menu-boosted-elements a.boosted-nav-link-def' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_control(
        			'underline_hover',
        			[
        				'label' => __( 'Underline Settings', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        				'condition' => [
        					'menu_underline_option!' => 'none',
        				],
        			]
        );
  		
		$this->add_control(
			'underline_height_control',
			[
				'label' => esc_html__( 'Underline Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 15,
					],
				],
				'condition' => [
					'menu_underline_option!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .item-underline-nav-boosted:before' => 'height: {{SIZE}}px;',
				],
			]
		);
        
		$this->add_control(
			'underline_position',
			[
				'label' => esc_html__( 'Underline Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -60,
						'max' => 60,
					],
				],
				'condition' => [
					'menu_underline_option!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .item-underline-nav-boosted:before' => 'bottom: {{SIZE}}px;',
				],
			]
		);
        
        
		$this->add_control(
			'top_levelmain_sub_menu_drop_down_arrow_size',
			[
				'label' => esc_html__( 'Dropdown Icon Font Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .drop-down-icon-boosted' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_sub_menu_main_styles',
  			[
  				'label' => esc_html__( 'Dropdown Container', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        

        
		$this->add_responsive_control(
			'sub_menu_container_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'sub_menu_container_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
		$this->add_control(
			'sub_menu_main_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .sub-menu' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .sf-menu-boosted-elements .sub-menu:after' => 'border-bottom-color: {{VALUE}};',
				],
                'default' => '#232323',
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sub_menu_drop_border',
				'selector' => '{{WRAPPER}} .sf-menu-boosted-elements .sub-menu',
			]
		);
        
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sub_menu_drop_shadow',
				'selector' => '{{WRAPPER}} .sf-menu-boosted-elements .sub-menu',
			]
		);
        
		$this->add_control(
			'drop_down_menu_min_width',
			[
				'label' => esc_html__( 'Dropdown Minimum Width (px)', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
                'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_control(
			'drop_down_menu_offset',
			[
				'label' => esc_html__( 'Dropdown Menu Offset(px)', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
                    '{{WRAPPER}} .sf-menu-boosted-elements ul.narrow-fix-boosted' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sf-menu-boosted-elements ul.sub-menu ul.sub-menu' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        $this->end_controls_section();
        
        
        
  		$this->start_controls_section(
  			'section_sub_menu_font_styles',
  			[
  				'label' => esc_html__( 'Dropdown Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'sub_menu_link_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li:last-child li a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item a.boosted-nav-link-def, {{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def',
			]
		);
        
        
        
        
		$this->start_controls_tabs( 'sub_menu_typography_tabs' );

		$this->start_controls_tab( 'sub_menu_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'sub_menu_font_nav_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted .sub-menu a.boosted-nav-link-def, {{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def' => 'color: {{VALUE}};',
				],
                'default' => '#777777',
			]
		);
		

		$this->add_control(
			'sub_menu_font_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted .sub-menu a.boosted-nav-link-def, {{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def' => 'background-color: {{VALUE}};',
				],
                'default' => '#f4f4f4',
			]
		);
        
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'bsub_menu_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'sub_menu_font_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_menu_font_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item li .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover,
{{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted li.sfHover-boosted a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements li.menu-item.sfHover-boosted .sub-menu a.boosted-nav-link-def:hover' => 'background-color: {{VALUE}};',
				],
                'default' => '#ebebeb',
			]
		);
        

		$this->end_controls_tab();
        
     
		
		$this->end_controls_tabs();
        
        
        
        
		$this->add_control(
			'sub_menu_item_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li:last-child li:last-child li:last-child li:last-child li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li:last-child li:last-child li:last-child li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li:last-child li:last-child li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li:last-child li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item:last-child li a.boosted-nav-link-def, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item a.boosted-nav-link-def' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted:after' => 'background: {{VALUE}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'sub_menu_link_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .sub-menu a.boosted-nav-link-def' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'sub_menu_item_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements.sf-arrows .sub-menu .sf-with-ul, {{WRAPPER}} .sf-menu-boosted-elements .sub-menu a.boosted-nav-link-def' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'sub_menu_item_margins',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-menu-boosted-elements .sub-menu li.menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_control(
			'main_sub_menu_drop_down_arrow_size',
			[
				'label' => esc_html__( 'Dropdown Toggle Font Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'size_units' => [ 'px' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sub-menu .menu-item-has-children .drop-down-icon-boosted' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        

        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_font_awesome_main',
  			[
  				'label' => esc_html__( 'FontAwesome Icon Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);

        
		$this->start_controls_tabs( 'fontawesome_icon_tabs' );

		$this->start_controls_tab( 'fontawesome_icon_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'fontaweosme_color_normal',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-fa-icon-custom' => 'color: {{VALUE}}; transition-duration:200ms; transition-property: color;transition-timing-function: ease-in-out;',
				],
			]
		);
		

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'fontawesome_icon_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'fontawesome_color_hover',
			[
				'label' => esc_html__( 'Active/Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a:hover .boosted-elements-fa-icon-custom, {{WRAPPER}} .current-menu-item a .boosted-elements-fa-icon-custom' => 'color: {{VALUE}};',
				],
			]
		);

		
        

		$this->end_controls_tab();
        
     
		
		$this->end_controls_tabs();
        
        
        
		$this->add_responsive_control(
			'font_awesome_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-fa-icon-custom' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'fontwwesome_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-fa-icon-custom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'fontawesome_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-fa-icon-custom' => 'top: {{SIZE}}{{UNIT}}; position:relative;',
				],
			]
		);
        
        $this->add_control(
        			'font_awesome_drop_down_heading',
        			[
        				'label' => __( 'Icon in Dropdown', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
        
		$this->start_controls_tabs( 'dropdown_fontawesome_icon_tabs' );

		$this->start_controls_tab( 'dropdown_fontawesome_icon_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'dropdown_fontaweosme_color_normal',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub-menu .boosted-elements-fa-icon-custom' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'dropdown_fontawesome_icon_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'dropdown_fontawesome_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub-menu a:hover .boosted-elements-fa-icon-custom' => 'color: {{VALUE}};',
				],
			]
		);

		
        

		$this->end_controls_tab();
        
     
		
		$this->end_controls_tabs();
        
        
        
        
		$this->add_responsive_control(
			'dropdown_font_awesome_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sub-menu .boosted-elements-fa-icon-custom' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'dropdown_fontwwesome_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sub-menu .boosted-elements-fa-icon-custom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'drop_down_fontawesome_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sub-menu .boosted-elements-fa-icon-custom' => 'top: {{SIZE}}{{UNIT}}; position:relative;',
				],
			]
		);
        
        

        $this->end_controls_section();
        
        
        
        
  		$this->start_controls_section(
  			'section_mobile_menu_menu_container',
  			[
  				'label' => esc_html__( 'Mobile Menu Container', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
		$this->add_control(
			'boosted_elements_mobile_container_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-menu-list-container' => 'background-color: {{VALUE}};',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_mobile_container_border',
				'selector' => '{{WRAPPER}} .boosted-elements-mobile-menu-list-container',
			]
		);
        
		$this->add_responsive_control(
			'mobile_container_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-menu-list-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        

		$this->add_responsive_control(
			'boosted_elements_mobile_container_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-menu-list-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'mobile_menu-container',
				'selector' => '{{WRAPPER}} .boosted-elements-mobile-menu-list-container',
			]
		);
        
	
		$this->end_controls_section();
        
  		$this->start_controls_section(
  			'section_mobile_menu_icon_styles',
  			[
  				'label' => esc_html__( 'Mobile Toggle Icon', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        
        
        
        
		$this->start_controls_tabs( 'boosted_mobile_icon_tabs' );

		$this->start_controls_tab( 'mobile_icon_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_mobile_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_mobile_icon_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_mobile_icon_border',
				'selector' => '{{WRAPPER}} .boosted-elements-mobile-i',
			]
		);
		
		
		$this->end_controls_tab();
        
        $this->start_controls_tab( 'mobile_icon_active', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_mobile_icon_color_active',
			[
				'label' => esc_html__( 'Active Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icon-active .boosted-elements-mobile-i' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_mobile_icon_background_active',
			[
				'label' => esc_html__( 'Active Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icon-active .boosted-elements-mobile-i' => 'background-color: {{VALUE}};',
				],
			]
		);
        

		$this->add_control(
			'boosted_elements_mobile_icon_border_active',
			[
				'label' => esc_html__( 'Active Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icon-active .boosted-elements-mobile-i' => 'border-color: {{VALUE}};',
				],
			]
		);
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
        
		$this->add_responsive_control(
			'nav_toggle-size',
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
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'nav_toggle_width',
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
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'nav_toggle_height',
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
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'mobile_icon_margins',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-mobile-i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        
        
        $this->end_controls_section();
        
        
  		$this->start_controls_section(
  			'section_mobile_menu_menu_styles',
  			[
  				'label' => esc_html__( 'Mobile Menu Links', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
        

        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_title_mobile_menu_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def',
			]
		);
        
		
		$this->add_control(
			'boosted_elements_mobile_menu_color',
			[
				'label' => esc_html__( 'Link Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_mobile_menu_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_mobile_menu_border',
				'selector' => '{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def',
			]
		);
        
		$this->add_responsive_control(
			'sub_menu_mobile_list_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item a.boosted-nav-link-def,
{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
        			'mobile_sub_menu_heading',
        			[
        				'label' => __( 'Sub-Menu Styles', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
        
		$this->add_control(
			'boosted_elements_sub_menu_mobile_menu_color',
			[
				'label' => esc_html__( 'Sub-menu Link Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item li a.boosted-nav-link-def' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_mobile_menu_sub_menu_darken',
			[
				'label' => esc_html__( 'Sub-menu Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item li a.boosted-nav-link-def' => 'background-color: {{VALUE}};',
				],
			]
		);
        
        
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_mobile_sub_menu_border',
				'selector' => '{{WRAPPER}} ul.boosted-elements-mobile-menu-list li.menu-item li a.boosted-nav-link-def',
			]
		);
        
        
        $this->add_control(
        			'sub_menu_toggle_heading',
        			[
        				'label' => __( 'Toggle Styles', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        		);
        
        
		$this->add_control(
			'sub_menu_drop_down_arrow_size',
			[
				'label' => esc_html__( 'Sub-Menu Toggle Font Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_control(
			'sub_menu_drop_down_toggle_width',
			[
				'label' => esc_html__( 'Sub-Menu Toggle Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
					],
				],
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted:after' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_control(
			'boosted_elements_sub_menu_toggle_mobile_menu_color',
			[
				'label' => esc_html__( 'Sub-Menu Toggle Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_sub_menu_toggle_mobile_menu_border_color',
			[
				'label' => esc_html__( 'Sub-Menu Toggle Border', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-item-has-children .mobile-drop-down-icon-boosted:after' => 'background: {{VALUE}};',
				],
			]
		);
        

        
		
        $this->end_controls_section();
        
        
        
	}


	protected function render( ) {
        $settings = $this->get_settings();
	?>
    
    <div class="boosted-elements-breakpoint-container<?php if ( $settings['break_point_menu'] == 'mobile' ) : ?> boosted-menu-mobile-break<?php endif; ?><?php if ( $settings['break_point_menu'] == 'tablet' ) : ?> boosted-menu-tablet-break<?php endif; ?><?php if ( $settings['break_point_menu'] == 'always' ) : ?> boosted-menu-awlays-break<?php endif; ?>">
	<div id="boosted-elements-menu-<?php echo esc_attr($this->get_id()); ?>">
		<div class="boosted-elements-main-menu-container">
            <div class="boosted-elements-menu-align<?php if ( $settings['menu_align_elements'] == 'justify' ) : ?> justified-boosted-nav<?php endif; ?>">
    		    <?php 
                wp_nav_menu( array(
                    'menu' => $settings['menu_select'], 
                    'menu_class' => 'sf-menu-boosted-elements', 
                    'link_before' => '<div class="item-underline-nav-boosted"><span class="boosted-elements-arrow-on-hover-menu"><i class="fas fa-circle"></i></span><span class="boosted-elements-menu-hover-text">', 
                    'link_after' => '</span><span class="drop-down-icon-boosted"><i class="' . $settings['sub_menu_indicator'] . '"></i></span></div>', 
                    'fallback_cb' => false,
                    'walker'  => new \Boosted_Elements_Mega_Walker
                ) ); 
                ?>
    		</div><!-- close. .boosted-elements-menu-align -->
        </div><!-- close .boosted-elements-main-menu-container -->
	</div><!-- close #boosted-elements-menu-<?php echo esc_attr($this->get_id()); ?> -->
    
    
    <?php if ( ! empty( $settings['mobile_menu_icon'] ) ) : ?>
    <div id="boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?>">
        <div class="boosted-elements-mobile-menu-container">
            <div class="boosted-elements-mobile-icon-align"><div class="boosted-elements-mobile-i"><?php \Elementor\Icons_Manager::render_icon( $settings['mobile_menu_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw boosted-elements-mobile-default-icon'] ); ?><i class="fas fa-times fa-fw"></i></div></div>
            
            <div class="boosted-elements-mobile-menu-list-container">
                <?php if ( $settings['custom_mobile_menu'] == 'yes' ) : ?>
                        <?php 
                        wp_nav_menu( array(
                            'menu' => $settings['mobile_menu_select'], 
                            'menu_class' => 'boosted-elements-mobile-menu-list', 
                            'before' => '<div class="mobile-item-nav-boosted">', 
                            'link_before' => '<span class="boosted-elements-sub-menu-padding">', 
                            'link_after' => '</span>', 
                            'after' => '<span class="mobile-drop-down-icon-boosted"><i class="' . $settings['sub_menu_indicator'] . '"></i></span></div>', 
                            'fallback_cb' => false,
                            'walker'  => new \Boosted_Elements_Mega_Walker
                        )); 
                        ?>
                    <?php else: ?>
                        <?php 
                        wp_nav_menu( array(
                            'menu' => $settings['menu_select'], 
                            'menu_class' => 'boosted-elements-mobile-menu-list', 
                            'before' => '<div class="mobile-item-nav-boosted">', 
                            'link_before' => '<span class="boosted-elements-sub-menu-padding">', 
                            'link_after' => '</span>', 
                            'after' => '<span class="mobile-drop-down-icon-boosted"><i class="' . $settings['sub_menu_indicator'] . '"></i></span></div>', 
                            'fallback_cb' => false,
                            'walker'  => new \Boosted_Elements_Mega_Walker
                        ));
                        ?>
                <?php endif; ?>
            </div><!-- close .boosted-elements-mobile-menu-list-container -->
        </div><!-- close .boosted-elements-mobile-menu-container -->
    </div><!-- close #boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?> -->
    <?php endif; ?>
    </div><!-- close .boosted-elements-breakpoint-container-->

    	<script type="text/javascript"> 
    	jQuery(document).ready(function($) {
    		'use strict';
            
          	jQuery('#boosted-elements-menu-<?php echo esc_attr($this->get_id()); ?> ul.sf-menu-boosted-elements').superfish({
                 popUpSelector: 'ul.sub-menu', 	// within menu context
                 hoverClass:    'sfHover-boosted',
                 delay:      	200,                	// one second delay on mouseout
                 speed:      	0,               		// faster \ speed
                 speedOut:    	200,             		// speed of the closing animation
                 animation: 		{opacity: 'show'},		// animation out
                 animationOut: 	{opacity: 'hide'},		// adnimation in
                 cssArrows:     	true,              		// set to false
                 autoArrows:  	true,                    // disable generation of arrow mark-up
                 disableHI:      true,
        		 onBeforeShow: function() {
        			 //Fix for overflowing menu items + CSS
        			 //https://stackoverflow.com/questions/13980122/superfish-menu-display-subitems-left-if-there-is-not-enough-screenspace-on-the/47286812#47286812
        		    if($(this).parents("ul").length > 1){
        		       var w = $(window).width();  
        		       var ul_offset = $(this).parents("ul").offset();
        		       var ul_width = $(this).parents("ul").outerWidth();

        		       // Shouldn't be necessary, but just doing the straight math
        		       // on dimensions can still allow the menu to float off screen
        		       // by a little bit.
        		       ul_width = ul_width + 50;

        		       if((ul_offset.left+ul_width > w-(ul_width/2)) && (ul_offset.left-ul_width > 0)) {
        		          $(this).addClass('narrow-fix-boosted');
        		       }
        		       else {
        		          $(this).removeClass('narrow-fix-boosted');
        		       }
        		    };
        		 }
                 
          	 });
            

         	$('#boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?> .boosted-elements-mobile-i').on('click', function(e){
         		e.preventDefault();
         		$('#boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?> .boosted-elements-mobile-menu-list-container').slideToggle(350);
         		$("#boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?> .boosted-elements-mobile-icon-align").toggleClass("boosted-elements-icon-active");
         	});
            
         	$('#boosted-elements-mobile-menu-<?php echo esc_attr($this->get_id()); ?> .boosted-elements-mobile-menu-list .menu-item-has-children .mobile-drop-down-icon-boosted').on('click', function(e){
         		e.preventDefault();
                $(this).toggleClass('boosted-elements-show-sub-menu');
                $(this).parent().closest('.menu-item-has-children').find('.sub-menu:first').slideToggle(350);
         	});
            
         
            
            
    	});
    	</script>
    
    
	
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsNavi() );