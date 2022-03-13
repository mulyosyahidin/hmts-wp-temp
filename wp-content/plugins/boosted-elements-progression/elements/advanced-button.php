<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsAdvanced_Button extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-advanced-button';
	}

	public function get_title() {
		return esc_html__( 'Advanced Button - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-button boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Button Text', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_btn_text',
			[
				'label' => esc_html__( 'Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click me', 'boosted-elements-progression' ),
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_btn_text', 'none' );
			
		$this->add_control(
			'boosted_elements_btn_url',
			[
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#!',
				],
				'placeholder' => 'http://progressionstudios.com',
				'label_block' => true,
			]
		);

		
		$this->add_responsive_control(
			'boosted_elements_btn_align',
			[
				'label' => esc_html__( 'Button Align', 'boosted-elements-progression' ),
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		
		$this->add_control(
			'boosted_elements_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_btn_icon!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'boosted_elements_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icon-animate-default i' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-icon-animate-on-hover:hover i' => 'width: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_advanced_icon_animation',
			[
				'label' => esc_html__( 'Icon Animation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'boosted-elements-icon-animate-default',
				'options' => [
					'boosted-elements-icon-animate-default' => esc_html__( 'Always Display Icon', 'boosted-elements-progression' ),
					'boosted-elements-icon-animate-on-hover' => esc_html__( 'Display Icon on Hover', 'boosted-elements-progression' ),
					'boosted-elements-icon-animate-replace-from-left' => esc_html__( 'Replace Text from Left', 'boosted-elements-progression' ),
					'boosted-elements-icon-animate-replace-from-right' => esc_html__( 'Replace Text from Right', 'boosted-elements-progression' ),
					'boosted-elements-icon-animate-replace-from-top' => esc_html__( 'Replace Text from Transparency', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_btn_icon!' => '',
				],
			]
		);

		
		$this->end_controls_section();
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_button_styles',
  			[
  				'label' => esc_html__( 'Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_title_boosted_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_btn_background',
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-btn-background',
			]
		);
		
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_btn_border',
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button',
			]
		);
		
		
		$this->add_responsive_control(
			'section_title_boosted_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_button_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button',
			]
		);
		
		
		
		
		$this->add_responsive_control(
			'section_title_boosted_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'btn_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button',
			]
		);
		
		
		$this->end_controls_section();
		
  		$this->start_controls_section(
  			'section_title_boosted_button_animation_styles',
  			[
  				'label' => esc_html__( 'Animation Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		
		
		$this->add_control(
			'boosted_elements_advanced_bg_transition',
			[
				'label' => esc_html__( 'Background Transition', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'boosted-elements-btn-animate-opacity',
				'options' => [
					'boosted-elements-btn-animate-opacity' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-transparent' => esc_html__( 'Transparent Background', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-slide-down' => esc_html__( 'Slide Down', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-slide-up' => esc_html__( 'Slide Up', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-slide-left' => esc_html__( 'Slide Left', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-slide-right' => esc_html__( 'Slide Right', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-center-horizontal' => esc_html__( 'Fill Center Horizontally', 'boosted-elements-progression' ),
					'boosted-elements-btn-animate-center-vertical' => esc_html__( 'Fill Center Vertically', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Animation', 'elementor' ),
				'separator' => 'before',
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_button_hover_styles',
  			[
  				'label' => esc_html__( 'Button Hover Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_button_hover_text_color',
			[
				'label' => esc_html__( 'Hover Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button:hover .boosted-elements-advanced-btn-text-inline, {{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button:hover i' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_btn_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-btn-background-hover',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'section_title_boosted_btn_hover_border_radius',
			[
				'label' => esc_html__( 'Hover Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-advanced-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'advanced_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-button-container .boosted-elements-advanced-button:hover',
			]
		);
		

		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

		

	<div class="boosted-elements-progression-advanced-button-container">		
		<a href="<?php echo esc_url($settings['boosted_elements_btn_url']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_btn_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_btn_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?> class="boosted-elements-advanced-button elementor-animation-<?php echo esc_attr($settings['hover_animation']); ?> <?php echo esc_attr($settings['boosted_elements_advanced_bg_transition']); ?> <?php echo esc_attr($settings['boosted_elements_advanced_icon_animation']); ?>">
			
			<div class="boosted-elements-advanced-btn-text"><?php if ( ! empty( $settings['boosted_elements_btn_icon'] ) && $settings['boosted_elements_btn_icon_align'] == 'left' ) : ?><?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'advanced-btn-icon-spacing-icon-left' ] ); ?><?php endif; ?><span class="boosted-elements-advanced-btn-text-inline"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_btn_text' ) . '>' . $this->get_settings( 'boosted_elements_btn_text' ) . '</div>';?></span><?php if ( ! empty( $settings['boosted_elements_btn_icon'] ) && $settings['boosted_elements_btn_icon_align'] == 'right' ) : ?><?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'advanced-btn-icon-spacing-icon-right' ] ); ?><?php endif; ?></div>
			
			<span class="boosted-elements-advanced-btn-background"></span>
			<span class="boosted-elements-advanced-btn-background-hover"></span>
		</a>
	</div><!-- close .boosted-elements-progression-advanced-button-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsAdvanced_Button() );