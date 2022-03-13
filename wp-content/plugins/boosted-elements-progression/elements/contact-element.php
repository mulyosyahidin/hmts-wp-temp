<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsContact_Form extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-contact-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form 7 - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-envelope boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Contact Form Selection', 'boosted-elements-progression' )
  			]
  		);
		
	
		
		$this->add_control(
			'boosted_elements_contact_form_list',
			[
				'label' => esc_html__( 'Select your contact form', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => boosted_contact_form_selection(),
			]
		);

		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_contact_form_styles',
			[
				'label' => esc_html__( 'Form General Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_input_background',
			[
				'label' => esc_html__( 'Field Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea' => 'background: {{VALUE}};',
				],
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_elements_input_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_elements_input_width',
  			[
  				'label' => esc_html__( 'Input Width', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);
		
  		$this->add_responsive_control(
  			'boosted_elements_textarea_width',
  			[
  				'label' => esc_html__( 'TextArea Width', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1200,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_input_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_input_border',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea',
			]
		);
		
		$this->add_control(
			'boosted_elements_input_focus',
			[
				'label' => esc_html__( 'Focus Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body {{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text:focus, body {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_button_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_contact_form_typography',
			[
				'label' => esc_html__( 'Typography Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_elements_contact_form_color',
			[
				'label' => esc_html__( 'Default Font Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_contact_form_field_color',
			[
				'label' => esc_html__( 'Field Font Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_contact_form_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Font Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container ::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container ::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_heading_default',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Default Typography', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_contact_form_default_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_heading_input',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Input Typography', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_contact_form_field_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-text, {{WRAPPER}} .boosted-elements-progression-contact-form-container textarea.wpcf7-textarea',
			]
		);
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_contact_form_submit_button_styles',
			[
				'label' => esc_html__( 'Submit Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_title_boosted_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit',
			]
		);
		
		$this->add_responsive_control(
			'section_title_boosted_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->start_controls_tabs( 'boosted_elements_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit',
			]
		);
		
		$this->add_control(
			'boosted_elements_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-contact-form-container input.wpcf7-submit',
			]
		);
		
		
		$this->end_controls_section();
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>
	
	
	<?php if ( ! empty( $settings['boosted_elements_contact_form_list'] ) ) : ?>
		<div class="boosted-elements-progression-contact-form-container">		
			<?php echo do_shortcode( '[contact-form-7 id="' . $settings['boosted_elements_contact_form_list'] . '" ]' ); ?>
		</div><!-- close .boosted-elements-progression-contact-form-container -->
	<?php endif; ?>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsContact_Form() );