<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsTabs extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-tabs';
	}

	public function get_title() {
		return esc_html__( 'Tabs - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-tabs boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
    
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_tabs'];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Tab Content', 'boosted-elements-progression' )
  			]
  		);
		
		$repeater = new Repeater();
		
        
		$repeater->add_control(
			'boosted_elements_tab_repeater_title_field',
			[
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Tab Title', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'boosted_elements_tab_repeater_sub_title',
			[
				'label' => esc_html__( 'Sub-title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
        
		$repeater->add_control(
			'boosted_elements_tab_repeater_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
			]
		);
        
        $repeater->add_control(
        			'hr',
        			[
        				'type' => \Elementor\Controls_Manager::DIVIDER,
        			]
        );
        
        
		$repeater->add_control(
			'tab_repeat_template_or_text',
			[
				'label' => esc_html__( 'Content Type', 'boosted-elements-progression' ),
                'label_block' => true,
				'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                					'default'  => esc_html__( 'Default Text', 'boosted-elements-progression' ),
                					'template' => esc_html__( 'Template', 'boosted-elements-progression' ),
                				],
			]
		);
        
		$repeater->add_control(
			'template_choice',
			[
				'label' => esc_html__( 'Choose a Template', 'boosted-elements-progression' ),
                'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => boosted_template_list(),
				'condition' => [
					'tab_repeat_template_or_text' => 'template',
				],
			]
		);

		
        
        $repeater->add_control(
        			'hr_second',
        			[
        				'type' => \Elementor\Controls_Manager::DIVIDER,
        			]
        );
        
        
		$repeater->add_control(
			'boosted_elements_tab_repeater_main_text_field',
			[
				'label' => esc_html__( 'Main Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
				'condition' => [
					'tab_repeat_template_or_text' => 'default',
				],
			]
		);
        

	
		$this->add_control(
			'boosted_elements_tab_repeater',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'boosted_elements_tab_repeater_title_field' => esc_html__( 'Tab 1', 'boosted-elements-progression' ),
						'boosted_elements_tab_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_tab_repeater_title_field' => esc_html__( 'Tab 2', 'boosted-elements-progression' ),
						'boosted_elements_tab_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_tab_repeater_title_field' => esc_html__( 'Tab 3', 'boosted-elements-progression' ),
						'boosted_elements_tab_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
				],
				'title_field' => '{{{ boosted_elements_tab_repeater_title_field }}}',
			]
		);
		

		
		$this->end_controls_section();

		
  		$this->start_controls_section(
  			'section_title_boosted_tab_options',
  			[
  				'label' => esc_html__( 'Options', 'boosted-elements-progression' )
  			]
  		);
        
        
		$this->add_control(
			'tabs_align',
			[
				'label' => esc_html__( 'Tab Align', 'boosted-elements-progression' ),
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
                'default' => 'justify',
                'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} .st > .boosted-tabs-nav.nav ' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => '',
					'center' => 'justify-content: center;',
					'right' => 'justify-content:flex-end;',
                    'justify' => '',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'tabs_text_align',
			[
				'label' => esc_html__( 'Text Align', 'boosted-elements-progression' ),
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
				'selectors' => [
					'{{WRAPPER}} .st > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'text-align:left;',
					'center' => 'text-align: center;',
					'right' => 'text-align:right;',
				],
			]
		);
        
		$this->add_control(
			'tabs_orientation',
			[
				'label' => esc_html__( 'Orientation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'boosted-elements-progression' ),
					'vertical' => esc_html__( 'Vertical', 'boosted-elements-progression' ),
				],
				'default' => 'horizontal',
			]
		);
        
        
		$this->add_responsive_control(
			'tabs_vvertical_width',
			[
				'label' => esc_html__( 'Vertical Tab Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .st.st-vertical > .boosted-tabs-nav.nav' => 'width: {{SIZE}}px;',
				],
				'condition' => [
					'tabs_orientation' => 'vertical',
				],
			]
		);
        
        
        
		$this->add_control(
			'tabs_transitions',
			[
				'label' => esc_html__( 'Tab Transitions', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'boosted-elements-progression' ),
					'fade' => esc_html__( 'Fade', 'boosted-elements-progression' ),
					'slide-horizontal' => esc_html__( 'Slide Horizontal', 'boosted-elements-progression' ),
                    'slide-vertical' => esc_html__( 'Slide Vertical', 'boosted-elements-progression' ),
                    'slide-swing' => esc_html__( 'Slide Swing', 'boosted-elements-progression' ),
				],
				'default' => 'fade',
			]
		);
        
        
		$this->add_control(
			'tabs_presected_tab',
			[
				'label' => esc_html__( 'Preselected Tab', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'0' => esc_html__( 'Default (1)', 'boosted-elements-progression' ),
					'1' => esc_html__( '2', 'boosted-elements-progression' ),
					'2' => esc_html__( '3', 'boosted-elements-progression' ),
                    '3' => esc_html__( '4', 'boosted-elements-progression' ),
                    '4' => esc_html__( '5', 'boosted-elements-progression' ),
                    '5' => esc_html__( '6', 'boosted-elements-progression' ),
                    '6' => esc_html__( '7', 'boosted-elements-progression' ),
				],
				'default' => '0',
			]
		);
        
		$this->add_control(
			'tabs_url',
			[
				'label' => esc_html__( 'URL Hash?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
        
		$this->add_control(
			'tabs_back_button',
			[
				'label' => esc_html__( 'Back Button Support', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
        
        
		$this->end_controls_section();
        
        
        
		$this->start_controls_section(
			'section_tab_main_styles',
			[
				'label' => esc_html__( 'Navigation Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        

        
		$this->add_responsive_control(
			'boosted_elements_tab_container_padding',
			[
				'label' => esc_html__( 'Navigation Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'boosted_elements_tab_right',
			[
				'label' => esc_html__( 'Navigation Spacing Right', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav li' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_tab_bottom_margin',
			[
				'label' => esc_html__( 'Navigation Spacing Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav li' => 'margin-bottom: {{SIZE}}px;',
				],
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
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_nav_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_nav_border',
				'selector' => '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link',
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
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_background_hover',
			[
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'boosted_elements_nav_border_hover',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active' => 'color: {{VALUE}};',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_nav_background_active',
			[
				'label' => esc_html__( 'Active Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_nav_border_active',
			[
				'label' => esc_html__( 'Active Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active' => 'border-color: {{VALUE}};',
				],
			]
		);
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
		$this->add_responsive_control(
			'boosted_elements_tab_nav_tab_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
        			'tabs_border_divider',
        			[
        				'label' => __( 'Divider', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_responsive_control(
			'tabs_border_divider_width',
			[
				'label' => esc_html__( 'Divider Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'border-right-width:{{SIZE}}px;',
                    '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav li:last-child .boosted-elements-nav-link.nav-link' => 'border-right-width:0px;',
				],
			]
		);
        
		$this->add_control(
			'boosted_elements_divider_color',
			[
				'label' => esc_html__( 'Divider Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link' => 'border-color: {{VALUE}};',
				],
			]
		);
        
        
        $this->add_control(
        			'tabs_border_bottom',
        			[
        				'label' => __( 'Border Bottom', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_responsive_control(
			'tabs_border_border_bottom_testing',
			[
				'label' => esc_html__( 'Border Bottom Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link::after' => 'height:{{SIZE}}px;',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'tabs_border_border_bottom_vert',
			[
				'label' => esc_html__( 'Border Bottom Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -20,
						'max' => 20,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link::after' => 'bottom:{{SIZE}}px;',
				],
			]
		);
        
        
        
		$this->start_controls_tabs( 'boosted_border_bottom_tabs' );

		$this->start_controls_tab( 'border_bottom_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );



		$this->add_control(
			'boosted_elements_nav_border_bottom',
			[
				'label' => esc_html__( 'Border Bottom Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link::after' => 'background: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'border_bottom_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );


		$this->add_control(
			'boosted_elements_nav_border_bottom_hover',
			[
				'label' => esc_html__( 'Hover Border Bottom Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover::after' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
        $this->start_controls_tab( 'border_bottom_active', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_nav_border_bottom_active',
			[
				'label' => esc_html__( 'Active Border Bottom Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active::after' => 'background: {{VALUE}};',
				],
			]
		);
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
        
        
        
        $this->add_control(
        			'tabs_border_top',
        			[
        				'label' => __( 'Border Top', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_responsive_control(
			'tabs_border_border_top_testing',
			[
				'label' => esc_html__( 'Border Top Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link::before' => 'height:{{SIZE}}px;',
				],
			]
		);
    
        
        
		$this->start_controls_tabs( 'boosted_border_top_tabs' );

		$this->start_controls_tab( 'border_top_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );



		$this->add_control(
			'boosted_elements_nav_border_top',
			[
				'label' => esc_html__( 'Border Top Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link::before' => 'background: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'border_top_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );


		$this->add_control(
			'boosted_elements_nav_border_before_hover',
			[
				'label' => esc_html__( 'Hover Border Top Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover::before' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
        
        $this->start_controls_tab( 'border_top_active', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_nav_border_top_active',
			[
				'label' => esc_html__( 'Active Border Top Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active::before' => 'background: {{VALUE}};',
				],
			]
		);
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
        
        $this->add_control(
        			'tabs_nav_container',
        			[
        				'label' => __( 'Nav Container', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_control(
			'tabs_nav_container_background',
			[
				'label' => esc_html__( 'Nav Container Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav' => 'background: {{VALUE}};',
				],
			]
		);
        
        
		$this->add_responsive_control(
			'tabs_nav_container_padding',
			[
				'label' => esc_html__( 'Nav Container Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_nav_container_border',
				'selector' => '{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav',
			]
		);
        
        
        

		
		$this->end_controls_section();
        
        
		$this->start_controls_section(
			'section_tab_typgoraphy_styles',
			[
				'label' => esc_html__( 'Typography Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        
        $this->add_control(
        			'tabs_text_heading',
        			[
        				'label' => __( 'Title Typography', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_tabs_nav_title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-tabs-nav-title',
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_tab_title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-tabs-nav-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        
        $this->add_control(
        			'tabs_sub_title_heading',
        			[
        				'label' => __( 'Sub-Title', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_tabs_nav_sub_title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-tabs-nav-subtitle',
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_tab_sib_title_margin',
			[
				'label' => esc_html__( 'Sub-Title Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-tabs-nav-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->start_controls_tabs( 'boosted_sub_title_tabs' );

		$this->start_controls_tab( 'normal_subtitle', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_sub_title_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link .boosted-tabs-nav-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_sub_title', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_sub_title_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover .boosted-tabs-nav-subtitle' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();
        
        $this->start_controls_tab( 'active_sub_title', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_sub_title_color_active',
			[
				'label' => esc_html__( 'Active Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active .boosted-tabs-nav-subtitle' => 'color: {{VALUE}};',
				],
			]
		);
        
	
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
        
        $this->add_control(
        			'tabs_icon_heading',
        			[
        				'label' => __( 'Icon', 'plugin-name' ),
        				'type' => \Elementor\Controls_Manager::HEADING,
        				'separator' => 'before',
        			]
        );
        
		$this->add_control(
			'icon_display',
			[
				'label' => esc_html__( 'Icon Display', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'block' => esc_html__( 'Block', 'boosted-elements-progression' ),
					'inline-block' => esc_html__( 'Inline', 'boosted-elements-progression' ),
				],
				'default' => 'block',
				'selectors' => [
					'{{WRAPPER}} .boosted-tabs-nav-icon, {{WRAPPER}} .boosted-tabs-nav-title' => 'display:{{VALUE}}',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_tabs_nav_icon',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-tabs-nav-icon',
			]
		);
        
        
        
		$this->add_responsive_control(
			'boosted_elements_tab_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-tabs-nav-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
		$this->start_controls_tabs( 'boosted_icon_tabs' );

		$this->start_controls_tab( 'normal_icon', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_icon_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link .boosted-tabs-nav-icon' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_icon', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_icon_color_hover',
			[
				'label' => esc_html__( 'Hover Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link:hover .boosted-tabs-nav-icon' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();
        
        $this->start_controls_tab( 'active_icon', [ 'label' => esc_html__( 'Active', 'boosted-elements-progression' ) ] );
        
		$this->add_control(
			'boosted_elements_icon_color_active',
			[
				'label' => esc_html__( 'Active Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-tabs-nav.nav .boosted-elements-nav-link.nav-link.active .boosted-tabs-nav-icon' => 'color: {{VALUE}};',
				],
			]
		);
        
	
        
        
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
        
        
        
        $this->end_controls_section();
        
        
		$this->start_controls_section(
			'section_tab_content_styles',
			[
				'label' => esc_html__( 'Content Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_tabs_content_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content',
			]
		);
        
		
		$this->add_control(
			'boosted_elements_tab_main_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => "#ffffff",
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_tab_margin',
			[
				'label' => esc_html__( 'Content Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_tab_padding',
			[
				'label' => esc_html__( 'Content Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_content_border',
				'selector' => '{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content',
			]
		);
		
        
		$this->add_control(
			'boosted_elements_tab_content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .st-theme-boosted-default > .boosted-elements-tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		
		
        
        
        $this->end_controls_section();
        
        
	}


	protected function render( ) {
		
    $settings = $this->get_settings();
	
	?>
    
    <div id="booosted-tabs-<?php echo esc_attr($this->get_id()); ?>" class="boosted-tabs-container">
        
        <ul class="boosted-tabs-nav nav">
            <?php $i = 0; foreach ( $settings['boosted_elements_tab_repeater'] as $item ) :  ?>
                <li>
                    <a class="boosted-elements-nav-link nav-link" href="#boosted-tab-<?php echo esc_attr($i) ?>">
                        <?php if ( $item['boosted_elements_tab_repeater_icon'] ) : ?>
                            <div class="boosted-tabs-nav-icon"><?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_tab_repeater_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-elements-tabs-icon'] ); ?></div>
                        <?php endif; ?>
                            <div class="boosted-tabs-nav-title"><?php echo esc_attr($item['boosted_elements_tab_repeater_title_field'] ); ?></div>
                        <?php if ( $item['boosted_elements_tab_repeater_sub_title'] ) : ?>
                            <div class="boosted-tabs-nav-subtitle"><?php echo esc_attr($item['boosted_elements_tab_repeater_sub_title'] ); ?></div>
                        <?php endif; ?>
                        
                    </a>
                </li>
            <?php $i++; endforeach; ?>
        </ul><!-- close .boosted-tabs-nav -->
    
        <div class="boosted-elements-tab-content tab-content">
            <?php $i = 0; foreach ( $settings['boosted_elements_tab_repeater'] as $item ) :  ?>
                <div id="boosted-tab-<?php echo esc_attr($i) ?>" class="boosted-eleements-tab-pane tab-pane" role="tabpanel">
                    
                    <?php if ( $item['tab_repeat_template_or_text'] == 'default' ) : ?>  
                        <?php echo wp_kses(($item['boosted_elements_tab_repeater_main_text_field'] ), true ); ?>
                    <?php else: ?>
                			<?php
			
                			if ( !empty($item['template_choice']) ) {
                	            $frontend = new \Elementor\Frontend;
                	            echo $frontend->get_builder_content_for_display($item['template_choice'], true);
                	        }else {
                            echo "<h5>" . esc_attr('Please choose a template', 'boosted-elements-progression') ."</h5>";
                            }
            
                			?>
                    <?php endif; ?>
                    
                    <div class="clearfix-boosted-element"></div>
                </div><!-- close #boosted-tab-<?php echo esc_attr($i) ?> -->
            <?php $i++; endforeach; ?>

        </div><!-- close .tab-content -->
        
	</div><!-- close #booosted-tabs-<?php echo esc_attr($this->get_id()); ?> -->
    
    
    
    
    

    
	<script type="text/javascript"> 
	jQuery(document).ready(function($) {
		'use strict';
        
        $('#booosted-tabs-<?php echo esc_attr($this->get_id()); ?>').smartTab({
            selected: <?php echo esc_attr( $settings['tabs_presected_tab'] ); ?>, // Initial selected tab, 0 = first tab
            theme: 'boosted-default',
            orientation: '<?php echo esc_attr( $settings['tabs_orientation'] ); ?>', // Nav menu orientation. horizontal/vertical
            justified: <?php if ( $settings['tabs_align'] == 'justify' ) : ?>true<?php else: ?>false<?php endif; ?>, // Nav menu justification. true/false
            autoAdjustHeight: false, // Automatically adjust content height. Breaks responsive layout heights when resizing. Leave Flase
            backButtonSupport: <?php if ( ! empty( $settings['tabs_back_button'] ) ) : ?>true<?php else: ?>false<?php endif; ?>, // Enable the back button support
            enableURLhash: <?php if ( ! empty( $settings['tabs_url'] ) ) : ?>true<?php else: ?>false<?php endif; ?>, // Enable selection of the tab based on url hash
            transition: {
                animation: '<?php echo esc_attr( $settings['tabs_transitions'] ); ?>', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                speed: '400', // Transion animation speed
            },
        });

        
	});
	</script>
    
	
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsTabs() );