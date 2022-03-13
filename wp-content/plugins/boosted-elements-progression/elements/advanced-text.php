<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsAdvanced_Text extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-advanced-text';
	}

	public function get_title() {
		return esc_html__( 'Advanced Text - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-text-align-center boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression-deprecated' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Main Text', 'boosted-elements-progression' )
  			]
  		);
		
	
		
		$this->add_control(
			'boosted_elements_text',
			[
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'I am text block. Select the text to change it via inline editing. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'boosted-elements-progression' ),
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_text', 'advanced' );


		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'boosted-elements-progression' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
			]
		);
		
		$this->add_responsive_control(
			'boosted_paragraph_margin',
			[
				'label' => esc_html__( 'Paragraph Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_paragraph_padding',
			[
				'label' => esc_html__( 'Paragraph Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_link_style',
			[
				'label' => esc_html__( 'Link Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_control(
			'liink_color',
			[
				'label' => esc_html__( 'Link Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
			]
		);
		
		
		$this->add_control(
			'link_hover_color',
			[
				'label' => esc_html__( 'Link Hover Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} a',
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_li_style',
			[
				'label' => esc_html__( 'List Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'boosted_list_margin',
			[
				'label' => esc_html__( 'List Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_list_padding',
			[
				'label' => esc_html__( 'List Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		
		
		
		
		
		$this->add_control(
			'boosted_flip_box_front_title_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'List Item', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_list_position',
			[
				'label' => esc_html__( 'List Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inherit',
				'options' => [
					'inherit' => esc_html__( 'Inherit', 'boosted-elements-progression' ),
					'inside' => esc_html__( 'Inside', 'boosted-elements-progression' ),
					'outside' => esc_html__( 'Outside', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol' => 'list-style-position: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_list_display',
			[
				'label' => esc_html__( 'Item Display', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'list-item',
				'options' => [
					'list-item' => esc_html__( 'List Item', 'boosted-elements-progression' ),
					'block' => esc_html__( 'Block', 'boosted-elements-progression' ),
					'inline-block' => esc_html__( 'Inline-Block', 'boosted-elements-progression' ),
					'inline' => esc_html__( 'Inline', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul li, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol li' => 'display: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_list_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul li, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_list_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul li, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ul ol' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_list_item_paddingborder',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-advanced-text-container ul li, {{WRAPPER}} .boosted-elements-progression-advanced-text-container ol li',
			]
		);
		
		
		
		$this->end_controls_section();
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

	<div class="boosted-elements-progression-advanced-text-container">			
		<?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_text' ) . '>' . $this->get_settings( 'boosted_elements_text' ) . '</div>';?>
		<div class="clearfix-boosted-element"></div>
	</div><!-- close .boosted-elements-progression-advanced-text-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
		
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsAdvanced_Text() );