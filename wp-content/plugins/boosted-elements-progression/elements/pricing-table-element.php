<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsPricingTable extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-price-table boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_boosted_global_options',
  			[
  				'label' => esc_html__( 'Top Section', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_header_image_control',
			[
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => esc_html__( 'No Image', 'boosted-elements-progression' ),
						'icon' => 'fas fa-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'boosted-elements-progression' ),
						'icon' => 'far fa-image',
					],
				],
				'default' => 'none',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_header_main_image',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_header_image_control' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'full',
				'condition' => [
					'boosted_elements_header_image_control' => 'image',
				],
			]
		);
		
		$this->add_control(
			'section_boosted_header_image_align',
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
						'icon' => 'fas fa-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-right',
					],
				],				
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-header-image' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'boosted_elements_header_image_control' => 'image',
				],
			]
		);
		
		$this->add_responsive_control(
			'image_spacing_header',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-header-image' => 'margin-bottom:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_header_image_control' => 'image',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_table_heading',
			[
				'label' => esc_html__( 'Heading', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Table Heading', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_table_heading', 'none' );
		
		
		$this->add_control(
			'boosted_elements_table_sub_title',
			[
				'label' => esc_html__( 'Sub-Heading', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Sample Sub-Heading', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_table_sub_title', 'none' );
		
		
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_boosted_price_section',
  			[
  				'label' => esc_html__( 'Price Section', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_table_currency',
			[
				'label' => esc_html__( 'Currency', 'boosted-elements-progression' ),
				'default' => esc_html__( '$', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_table_currency', 'none' );
		
		$this->add_control(
			'boosted_elements_table_price',
			[
				'label' => esc_html__( 'Price', 'boosted-elements-progression' ),
				'default' => esc_html__( '99', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_table_price', 'none' );
		
		
		$this->add_control(
			'boosted_elements_table_duration',
			[
				'label' => esc_html__( 'Duration', 'boosted-elements-progression' ),
				'default' => esc_html__( '/mo', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_table_duration', 'none' );
		
		
		$this->add_control(
			'boosted_elements_table_duration_display_block',
			[
				'label' => esc_html__( 'Duration Inline', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'boosted_elements_table_duration!' => 'yes',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_table_for_sale',
			[
				'label' => esc_html__( 'Optional Sale Price', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_boosted_features',
  			[
  				'label' => esc_html__( 'Features', 'boosted-elements-progression' )
  			]
  		);
		
		
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'boosted_elements_feature_repeater_text_field',
			[
				'label' => esc_html__( 'Feature', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Featured Description', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'boosted_elements_feature_repeater_icon',
			[
				'type' => Controls_Manager::ICONS,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_feature_repeater_icon_color',
			[
				'label' => esc_html__( 'Optional Icon Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_feature_repeater_strike_through',
			[
				'label' => esc_html__( 'Strikethrough Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		
		$this->add_control(
			'boosted_elements_feature_repeater',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'boosted_elements_feature_repeater_text_field' => esc_html__( 'Featured Description #1', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_feature_repeater_text_field' => esc_html__( 'Featured Description #2', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_feature_repeater_text_field' => esc_html__( 'Featured Description #3', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_feature_repeater_text_field' => esc_html__( 'Featured Description #4', 'boosted-elements-progression' ),
						'boosted_elements_feature_repeater_strike_through' => 'yes',
					],
				],
				'title_field' => '{{{ boosted_elements_feature_repeater_text_field }}}',
			]
		);

		$this->end_controls_section();

  		$this->start_controls_section(
  			'section_boosted_button',
  			[
  				'label' => esc_html__( 'Footer', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_table_button_text',
			[
				'label' => esc_html__( 'Button Text', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Sign up', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_table_button_text', 'none' );
		
		$this->add_control(
			'boosted_elements_table_button_link',
			[
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
			]
		);
		
		$this->add_control(
			'boosted_elements_table_button_apply_to',
			[
				'label' => esc_html__( 'Apply link to', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_button_link' => esc_html__( 'Button', 'boosted-elements-progression' ),
					'boosted_slide_link' => esc_html__( 'Entire Pricing Table', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_button_link',
				'condition' => [
					'boosted_elements_table_button_link[url]!' => '',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_table_button_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
			]
		);
		
		
		$this->add_control(
			'boosted_elements_table_button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_table_button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_table_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_table_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-footer .pricing-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-pricing-footer .pricing-button-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_table_footer_text',
			[
				'label' => esc_html__( 'Optional Text Below Button', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		
		$this->end_controls_section();
		
		
		
		
  		$this->start_controls_section(
  			'section_boosted_ribben',
  			[
  				'label' => esc_html__( 'Ribbon', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'section_boosted_ribben_text',
			[
				'label' => esc_html__( 'Ribbon Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'section_boosted_ribbon_align',
			[
				'label' => esc_html__( 'Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'fas fa-align-right',
					],
				],
				'default' => 'left',
			]
		);
		
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Top Section Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		
		$this->add_control(
			'title_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-header' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'top_section_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-header' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Heading Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} h2.boosted-elements-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h2.boosted-elements-pricing-title',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} h2.boosted-elements-pricing-title',
			]
		);
		
		
		$this->add_control(
			'sub_title_color',
			[
				'label' => esc_html__( 'Sub-Heading Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} h4.boosted-elements-pricing-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'sub_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} h4.boosted-elements-pricing-sub-title',
			]
		);
		
		$this->add_control(
			'top_section_border_radius',
			[
				'label' => esc_html__( 'Top Section Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-header' => 'border-top-left-radius: {{SIZE}}px; border-top-right-radius: {{SIZE}}px',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border_main',
				'selector' => '{{WRAPPER}}  .boosted-elements-pricing-header',
			]
		);
		
		
		
		
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_pricing_style',
			[
				'label' => esc_html__( 'Pricing Section Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'pricing_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-section' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'pricing_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'pricing_section_align',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-section' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pricing_border_main',
				'selector' => '{{WRAPPER}}  .boosted-elements-pricing-section',
			]
		);
		
		$this->add_control(
			'curency_color',
			[
				'label' => esc_html__( 'Currency Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-currency' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'currency_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-currency',
			]
		);
		

		$this->add_control(
			'currency_vertical_position',
			[
				'label' => esc_html__( 'Currency Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -70,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-currency' => 'top:{{SIZE}}px;',
				],
			]
		);
		
		
		
		$this->add_control(
			'main_price_color',
			[
				'label' => esc_html__( 'Price Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-main-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'price_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-main-price',
			]
		);
		
		
		$this->add_control(
			'main_duration__color',
			[
				'label' => esc_html__( 'Duration Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-duration' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'duration_vertical_position',
			[
				'label' => esc_html__( 'Duration Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -70,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-duration' => 'top:{{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'duration_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-duration',
			]
		);
		
		
		$this->add_control(
			'main_sale_price__color',
			[
				'label' => esc_html__( 'Sale Price Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-for-sale' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'sale_price_vertical_position',
			[
				'label' => esc_html__( 'Sale Price Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -70,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-for-sale' => 'top:{{SIZE}}px; position:relative;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'sale_price_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-for-sale',
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_feature_style',
			[
				'label' => esc_html__( 'Features Section Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'features_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'feature_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->add_control(
			'feature_title_color',
			[
				'label' => esc_html__( 'Feature Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'feature_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ul.boosted-elements-pricing-features li',
			]
		);
		
		$this->add_control(
			'feature_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li i' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->add_control(
			'feature_margin_bottom',
			[
				'label' => esc_html__( 'Margin Between Features', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li' => 'margin-bottom: {{SIZE}}px; padding-bottom: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_features_align',
			[
				'label' => esc_html__( 'Feature Align', 'boosted-elements-progression' ),
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'feature_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'feature_border_width',
			[
				'label' => esc_html__( 'Border Bottom Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-pricing-features li' => 'border-bottom-width: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		
		$this->start_controls_section(
			'section_footer_style',
			[
				'label' => esc_html__( 'Footer Section Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'footer_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-footer' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'ffooter_section_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'footer_section_border_radius',
			[
				'label' => esc_html__( 'Bottom Section Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-footer' => 'border-bottom-left-radius: {{SIZE}}px; border-bottom-right-radius: {{SIZE}}px',
				],
			]
		);
		
		
		
		$this->add_responsive_control(
			'feature_button_align',
			[
				'label' => esc_html__( 'Button Alignment', 'boosted-elements-progression' ),
				'separator' => 'before',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-footer' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_footer_block_inline',
			[
  				'label' => esc_html__( 'Button Display', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,				
				'default' => 'inline-block',
				'options' => [
					'inline-block' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'block' => esc_html__( 'Full Width', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'display: {{VALUE}};',
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
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_button_border_options',
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-table-button',
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
					'{{WRAPPER}} .boosted-elements-pricing-table-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_control(
			'boosted_elements_button_border_radius',
			[
				'label' => esc_html__( 'Button Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		

		
		$this->add_responsive_control(
			'boosted_elements_main_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} .boosted-elements-pricing-table-button',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
			]
		);
		
		
		
		
		
		
		
		$this->add_control(
			'feature_optional_title_color',
			[
				'label' => esc_html__( 'Optional Text Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-footer-additional-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'footer_section_button_margin_bottom',
			[
				'label' => esc_html__( 'Optional Text Margin Top', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-table-button' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'feature_optional_title_align',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-footer-additional-text' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'feature_optioanl_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-footer-additional-text',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => esc_html__( 'Ribbon Section Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'ribbon_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elelements-pricing-ribbon' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'ribbon_main_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elelements-pricing-ribbon' => 'color: {{VALUE}};',
				],
			]
		);
		

		
	
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_ribbon_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}  .boosted-elelements-pricing-ribbon',
			]
		);
		
		
		
		$this->end_controls_section();
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>






	<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_slide_link' &&  ! empty( $settings['boosted_elements_table_button_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_table_button_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_table_button_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_table_button_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?>
	<div class="boosted-elements-progression-pricing-container<?php if ( $settings['boosted_elements_table_duration_display_block'] != 'yes'  ) : ?> boosted-elements-display-duration-block<?php endif; ?><?php if ( $settings['section_boosted_ribbon_align'] == 'right'  ) : ?> boosted-elements-pricing-table-ribbon-right<?php endif; ?>">			
		<div class="boosted-elements-pricing-header">
			
			<?php if ( $settings['boosted_elements_header_image_control'] == 'image' ) : ?>
				<div class="boosted-elements-header-image">
				 <?php if ( ! empty( $settings['boosted_elements_header_main_image'] ) ) : ?>
					<?php $image = $settings['boosted_elements_header_main_image'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
					<img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_html__( 'Insert Image Here', 'boosted-elements-progression' ); ?>">	
				 <?php endif; ?>
				</div>
			<?php endif; ?>
			
			
			<?php if ( ! empty( $settings['boosted_elements_table_heading'] ) ) : ?>
				<h2 class="boosted-elements-pricing-title"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_heading' ) . '>' . $this->get_settings( 'boosted_elements_table_heading' ) . '</div>';?></h2>
			<?php endif; ?>
		
			<?php if ( ! empty( $settings['boosted_elements_table_sub_title'] ) ) : ?>
				<h4 class="boosted-elements-pricing-sub-title"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_sub_title' ) . '>' . $this->get_settings( 'boosted_elements_table_sub_title' ) . '</div>';?></h4>
			<?php endif; ?>
		</div><!-- close .boosted-elements-pricing-header -->
		
		<div class="boosted-elements-pricing-section">
			<?php if ( ! empty( $settings['boosted_elements_table_for_sale'] ) ) : ?><span class="boosted-elements-pricing-for-sale"><?php echo esc_attr($settings['boosted_elements_table_for_sale'] ); ?></span><?php endif; ?><?php if ( ! empty( $settings['boosted_elements_table_currency'] ) ) : ?><span class="boosted-elements-pricing-currency"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_currency' ) . '>' . $this->get_settings( 'boosted_elements_table_currency' ) . '</div>';?></span><?php endif; ?><?php if ( ! empty( $settings['boosted_elements_table_price'] ) ) : ?><span class="boosted-elements-pricing-main-price"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_price' ) . '>' . $this->get_settings( 'boosted_elements_table_price' ) . '</div>';?></span><?php endif; ?><?php if ( ! empty( $settings['boosted_elements_table_duration'] ) ) : ?><span class="boosted-elements-pricing-duration"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_duration' ) . '>' . $this->get_settings( 'boosted_elements_table_duration' ) . '</div>';?></span><?php endif; ?>
		</div><!-- close .boosted-elements-pricing-section -->
		
		<ul class="boosted-elements-pricing-features">
		<?php foreach ( $settings['boosted_elements_feature_repeater'] as $item ) : ?>
			<?php if ( ! empty( $item['boosted_elements_feature_repeater_text_field'] ) ) : ?>
				<li class="elementor-repeater-item-<?php echo $item['_id'] ?> boosted-elements-pricing-feature-list-item<?php if ( ! empty( $item['boosted_elements_feature_repeater_strike_through'] )) : ?> boosted-elements-strikethrough<?php endif; ?>">
					<?php if ( ! empty( $item['boosted_elements_feature_repeater_icon'] )) : ?>
						<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_feature_repeater_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php endif; ?>
					<?php echo wp_kses(($item['boosted_elements_feature_repeater_text_field'] ), true); ?>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
		<div class="clearfix-boosted-element"></div>
		

		<div class="boosted-elements-pricing-footer">
			<?php if ( ! empty( $settings['boosted_elements_table_button_text'] ) ) : ?>
			
			<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_button_link' &&  ! empty( $settings['boosted_elements_table_button_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_table_button_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_table_button_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_table_button_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?>
				
				<div class="boosted-elements-pricing-table-button">
				<?php if ( ! empty( $settings['boosted_elements_table_button_icon'] ) && $settings['boosted_elements_table_button_icon_align'] == 'left' ) : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_table_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'pricing-button-icon-left' ] ); ?>
				<?php endif; ?>
				
				<?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_table_button_text' ) . '>' . $this->get_settings( 'boosted_elements_table_button_text' ) . '</div>';?>
				
				<?php if ( ! empty( $settings['boosted_elements_table_button_icon'] ) && $settings['boosted_elements_table_button_icon_align'] == 'right' ) : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_table_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'pricing-button-icon-right' ] ); ?>
				<?php endif; ?>
				</div>
			
			<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_button_link' &&  ! empty( $settings['boosted_elements_table_button_link']['url'] ) ) : ?></a><?php endif; ?>
			
			<?php endif; ?>
			
			<?php if ( ! empty( $settings['boosted_elements_table_footer_text'] ) ) : ?>
				<div class="boosted-elements-footer-additional-text"><?php echo wp_kses(($settings['boosted_elements_table_footer_text'] ), true); ?></div>
			<?php endif; ?>
			
		</div><!-- close .boosted-elements-pricing-footer -->
		
		
		<?php if ( ! empty( $settings['section_boosted_ribben_text'] ) ) : ?>
			<div class="boosted-elelements-pricing-ribbon"><?php echo esc_attr($settings['section_boosted_ribben_text'] ); ?></div>
		<?php endif; ?>
	</div><!-- close .boosted-elements-progression-pricing-container -->
	<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_slide_link' &&  ! empty( $settings['boosted_elements_table_button_link']['url'] ) ) : ?></a><?php endif; ?>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsPricingTable() );