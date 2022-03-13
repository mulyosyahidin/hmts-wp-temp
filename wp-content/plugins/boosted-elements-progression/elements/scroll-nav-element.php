<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsScrollNav extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-scroll-nav';
	}

	public function get_title() {
		return esc_html__( 'Scroll Navigation - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-navigation-vertical boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_scrollnav_js' ]; 
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_navigation_fields',
  			[
  				'label' => esc_html__( 'Navigation Items', 'boosted-elements-progression' )
  			]
  		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_text_field',
			[
				'label' => esc_html__( 'Section Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Scroll to Section', 'boosted-elements-progression' ),
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_content_id',
			[
				'label' => esc_html__( 'Section ID', 'boosted-elements-progression' ),
				'description' => esc_html__( 'The ID of the corresponding section on the page', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( '#section-id', 'boosted-elements-progression' ),
			]
		);
		
		
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_icon',
			[
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_icon_before_after',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'label_block' => true,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_nav_repeater_icon!' => '',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_content_external_link',
			[
				'label' => esc_html__( 'Optional Page Link', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Use this to link to a different page.', 'boosted-elements-progression' ),
				'placeholder' => 'http://progressionstudios.com',
				'type' => Controls_Manager::URL,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_nav_repeater_bullet_icon',
			[
				'label' => esc_html__( 'Navigation Bullet', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'regular',
				],
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'boosted_elements_nav_repeater',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'boosted_elements_nav_repeater_text_field' => esc_html__( 'Scroll to Section 1', 'boosted-elements-progression' ),
						'boosted_elements_nav_repeater_content_id' => esc_html__( '#section-1', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_nav_repeater_text_field' => esc_html__( 'Scroll to Section 2', 'boosted-elements-progression' ),
						'boosted_elements_nav_repeater_content_id' => esc_html__( '#section-2', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_nav_repeater_text_field' => esc_html__( 'Scroll to Section 3', 'boosted-elements-progression' ),
						'boosted_elements_nav_repeater_content_id' => esc_html__( '#section-3', 'boosted-elements-progression' ),
					],
				],
				'title_field' => '{{{ boosted_elements_nav_repeater_text_field }}}',
			]
		);

		$this->end_controls_section();

		
  		$this->start_controls_section(
  			'section_title_boosted_navigation_settings',
  			[
  				'label' => esc_html__( 'Settings', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_hover_always_selected',
			[
				'label' => esc_html__( 'Text on Hover Only', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => esc_html__( 'Display text on hover only. Hides automatically.', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_control(
			'boosted_elements_first_item_selection',
			[
				'label' => esc_html__( 'First Item Selected', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => esc_html__( 'Set first item as selected automatically.', 'boosted-elements-progression' ),
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_scroll_nav_transition',
			[
				'label' => esc_html__( 'Transition Speed', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '500',
			]
		);
		
		$this->add_control(
			'boosted_elements_scroll_nav_scrollthreshold',
			[
				'label' => esc_html__( 'Scroll Threshold', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Percentage of screen at which the next section should become current', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.5,
				],
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0,
						'max' => 1,
					],
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_scroll_nav_offset',
			[
				'label' => esc_html__( 'Offset on Scroll', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);
		
		$this->add_control(
			'boosted_elements_scroll_nav_hash',
			[
				'label' => esc_html__( 'URL Hash', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'On', 'boosted-elements-progression' ),
					'false' => esc_html__( 'Off', 'boosted-elements-progression' ),
				],
				'default' => 'false',
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_main_container_styles',
			[
				'label' => esc_html__( 'Main Container Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_scroll_nav_vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top:0px' => esc_html__( 'Top', 'boosted-elements-progression' ),
					'top:50%' => esc_html__( 'Middle', 'boosted-elements-progression' ),
					'bottom:0px' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
				],
				'default' => 'top:50%',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => '{{SIZE}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_scroll_nav_horizontal_align',
			[
				'label' => esc_html__( 'Horizontal Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left:0px' => esc_html__( 'Left', 'boosted-elements-progression' ),
					'right:0px' => esc_html__( 'Right', 'boosted-elements-progression' ),
				],
				'default' => 'right:0px',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => '{{SIZE}};',
				],
				'render_type' => 'template',
			]
		);
	
		
		$this->add_control(
			'boosted_elements_main_container_background',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-scroll-nav-container, {{WRAPPER}} .boosted-elements-scroll-nav-hover-content span',
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_elements_main_container_margin',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_main_container_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_main_container_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-nav-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_main_bullet_styles',
			[
				'label' => esc_html__( 'Bullet Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_bullet_font_size',
			[
				'label' => esc_html__( 'Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'font-size: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_bullet_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_bullet_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_bullet_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		

		$this->start_controls_tabs( 'boosted_elements_bullet_content_tabs' );

		$this->start_controls_tab( 'normal_bullet_content_style', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_bullet_btn_text_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_bullet_btn_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_popup_content_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-scroll-nav-item',
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_bullet_content_style', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_bullet_btn_hover_text_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-single-nav-link:hover .boosted-elements-scroll-nav-item' => 'color: {{VALUE}};',
					'{{WRAPPER}} .boosted-scroll-current-item .boosted-single-nav-link .boosted-elements-scroll-nav-item' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_bullet_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-single-nav-link:hover .boosted-elements-scroll-nav-item' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .boosted-scroll-current-item .boosted-single-nav-link .boosted-elements-scroll-nav-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_bullet_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-single-nav-link:hover .boosted-elements-scroll-nav-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .boosted-scroll-current-item .boosted-single-nav-link .boosted-elements-scroll-nav-item' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_main_title_styles',
			[
				'label' => esc_html__( 'Title Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_title_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -70,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content' => 'top: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_title_horizontal_position_hover',
			[
				'label' => esc_html__( 'Horizontal Position Hover', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 125,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-single-nav-link:hover .boosted-elements-scroll-nav-hover-content' => 'padding-right: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-title-on-hovere-only .boosted-scroll-current-item .boosted-single-nav-link .boosted-elements-scroll-nav-hover-content' => 'padding-right: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-scroll-left-layout .boosted-single-nav-link:hover .boosted-elements-scroll-nav-hover-content' => 'padding-left: {{SIZE}}px; padding-right:0px;',
					'{{WRAPPER}} .boosted-elements-progression-scroll-left-layout.boosted-elements-title-on-hovere-only .boosted-scroll-current-item .boosted-single-nav-link .boosted-elements-scroll-nav-hover-content' => 'padding-left: {{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_scroll_nav_horizontal_align!' => 'right:50%',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_title_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position Default', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 125,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content' => 'padding-right: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-scroll-left-layout .boosted-elements-scroll-nav-hover-content' => 'padding-left: {{SIZE}}px; padding-right:0px;',
				],
				'condition' => [
					'boosted_elements_scroll_nav_horizontal_align!' => 'right:50%',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_title_horizontal_position_center_only',
			[
				'label' => esc_html__( 'Horizontal Position Center', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-scroll-middle-layout .boosted-elements-scroll-nav-hover-content' => 'margin-right: {{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_scroll_nav_horizontal_align' => 'right:50%',
				],
			]
		);
		
		
		
		
		$this->add_responsive_control(
			'boosted_elements_title_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_title_arrow',
			[
				'label' => esc_html__( 'Display Arrow?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_title_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_title_background',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-progression-scroll-left-layout .boosted-elements-scroll-nav-hover-content span:after' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-progression-scroll-middle-layout .boosted-elements-scroll-nav-hover-content span:after' => 'border-top-color: {{VALUE}}; border-right-color:transparent; border-left-color:transparent;',
					'{{WRAPPER}} a .boosted-elements-scroll-nav-hover-content span' => 'background: {{VALUE}};',
					'{{WRAPPER}} a .boosted-elements-scroll-nav-hover-content span:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} a .boosted-elements-progression-scroll-left-layout .boosted-elements-scroll-nav-hover-content span:after' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} a .boosted-elements-progression-scroll-middle-layout .boosted-elements-scroll-nav-hover-content span:after' => 'border-top-color: {{VALUE}}; border-right-color:transparent; border-left-color:transparent;',
				],
			]
		);
		
		
		
		
		
		
		
		

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_title_border_options',
				'selector' => '{{WRAPPER}} .boosted-elements-scroll-nav-hover-content span',
			]
		);
		
		
		
		$this->end_controls_section();
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();

	?>

	<div class="boosted-elements-progression-scroll-nav-container <?php if ( ($settings['boosted_elements_scroll_nav_horizontal_align'] == 'right:50%' )) : ?> boosted-elements-progression-scroll-middle-layout<?php endif; ?><?php if ( ($settings['boosted_elements_scroll_nav_horizontal_align'] == 'left:0px' )) : ?> boosted-elements-progression-scroll-left-layout<?php endif; ?><?php if ( ($settings['boosted_elements_title_arrow'] != 'yes' )) : ?> boosted-elements-hide-arrow-title<?php endif; ?><?php if ( ($settings['boosted_elements_hover_always_selected'] != 'yes' )) : ?> boosted-elements-title-on-hovere-only<?php endif; ?>">			
		<ul id="boosted-elements-progression-scrolling-nav-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-scroll-nav-menu">
		<?php 
			$i = 0;
			foreach ( $settings['boosted_elements_nav_repeater'] as $item ) : 
		
		?>
				<li class="elementor-repeater-item-<?php echo $item['_id'] ?><?php if ( $i == 0 && ($settings['boosted_elements_first_item_selection'] == 'yes' ) )  : ?> boosted-scroll-current-item<?php endif; ?>">
					<?php if ( ! empty( $item['boosted_elements_nav_repeater_content_external_link']['url'] ) ) : ?><a href="<?php echo esc_attr($item['boosted_elements_nav_repeater_content_external_link']['url'] ); ?>" <?php if ( ! empty( $item['boosted_elements_nav_repeater_content_external_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?>
					<div class="boosted-single-nav-link" <?php if ( empty( $item['boosted_elements_nav_repeater_content_external_link']['url'] ) ) : ?>data-link="<?php echo esc_attr($item['boosted_elements_nav_repeater_content_id'] ); ?>"<?php endif; ?>
						
						<?php if ( ! empty( $item['boosted_elements_nav_repeater_content_external_link']['url'] ) ) : ?>data-link="<?php echo esc_attr($item['boosted_elements_nav_repeater_content_external_link']['url'] ); ?>"<?php endif; ?>>
						
						<?php if ( ! empty( $item['boosted_elements_nav_repeater_text_field'] ) ) : ?>
						<div class="boosted-elements-scroll-nav-hover-content">
							<span>
								<?php if ( ! empty( $item['boosted_elements_nav_repeater_icon']) && $item['boosted_elements_nav_repeater_icon_before_after'] == 'left' ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_nav_repeater_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-scroll-nav-icon-left' ] ); ?>
								<?php endif; ?>
						
								<?php echo esc_attr($item['boosted_elements_nav_repeater_text_field'] ); ?>
							
								<?php if ( ! empty( $item['boosted_elements_nav_repeater_icon']) && $item['boosted_elements_nav_repeater_icon_before_after'] == 'right' ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_nav_repeater_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-scroll-nav-icon-right' ] ); ?>
								<?php endif; ?>
							</span>
						</div><!-- close .boosted-elements-scroll-nav-hover-content -->
						<?php endif; ?>
						
						<div class="boosted-elements-scroll-nav-item"><?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_nav_repeater_bullet_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
						
						<div class="clearfix-boosted-element"></div>
					</div>
					<?php if ( ! empty( $item['boosted_elements_nav_repeater_content_external_link']['url'] ) ) : ?></a><?php endif; ?>
				</li>
		<?php $i++; endforeach; ?>
		</ul>
	</div><!-- close .boosted-elements-progression-scroll-nav-container -->
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			 'use strict';
	 		$("#boosted-elements-progression-scrolling-nav-<?php echo esc_attr($this->get_id()); ?>").BoostedonePageNav({
	 			currentClass: 'boosted-scroll-current-item',
				navItems: '.boosted-single-nav-link',
				scrollOffset:<?php echo esc_attr($settings['boosted_elements_scroll_nav_offset'] ); ?>,
				changeHash:<?php echo esc_attr($settings['boosted_elements_scroll_nav_hash'] ); ?>,
	 			scrollSpeed: <?php echo esc_attr($settings['boosted_elements_scroll_nav_transition'] ); ?>,
	 			scrollThreshold:<?php echo esc_attr($settings['boosted_elements_scroll_nav_scrollthreshold']['size'] ); ?>,
	 			filter: ':not(.boosted-scroll-external)',
	 			easing: 'swing',
	 		});
		});
	</script>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsScrollNav() );