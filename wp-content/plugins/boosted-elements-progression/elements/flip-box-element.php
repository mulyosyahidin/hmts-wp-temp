<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsFlipBox extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-flip-box';
	}

	public function get_title() {
		return esc_html__( 'Flip Box - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-flip-box boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_front_options',
  			[
  				'label' => esc_html__( 'Front Box', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_icon_image',
			[
				'label' => esc_html__( 'Icon/Image', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'boosted-elements-progression' ),
						'icon' => 'fas fa-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'boosted-elements-progression' ),
						'icon' => 'far fa-image',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'boosted-elements-progression' ),
						'icon' => 'fas fa-user-circle',
					],
				],
				'default' => 'icon',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_flip_front_image',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_icon_image' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'condition' => [
					'boosted_elements_icon_image' => 'image',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_flip_front_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user-circle',
					'library' => 'regular',
				],
				'condition' => [
					'boosted_elements_icon_image' => 'icon',
				],
			]
		);
		
		$this->add_control(
			'boosted_eleements_flip_front_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'boosted_eleements_flip_front_icon_style_background' => esc_html__( 'Background', 'boosted-elements-progression' ),
					'boosted_eleements_flip_front_icon_style_bordered' => esc_html__( 'Bordered', 'boosted-elements-progression' ),
				],
				'default' => 'default',
				'condition' => [
					'boosted_elements_icon_image' => 'icon',
				],
			]
		);
		
		$this->add_control(
			'boosted_eleements_flip_front_icon_shape',
			[
				'label' => esc_html__( 'Shape', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_flip_box_icon_border_round' => esc_html__( 'Rounded', 'boosted-elements-progression' ),
					'boosted_flip_box_icon_border_square' => esc_html__( 'Square', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_flip_box_icon_border_round',
				'condition' => [
					'boosted_eleements_flip_front_icon_style!' => 'default',
					'boosted_elements_icon_image' => 'icon',
				],
			]
		);
		
		

		

		$this->add_control(
			'boosted_elements_flip_front_heading',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Front Box Heading', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_flip_front_heading', 'none' );
		
		$this->add_control(
			'boosted_elements_flip_front_content',
			[
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'after',
				'placeholder' => esc_html__( 'Content', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Easily add or remove any text on your flip box!', 'boosted-elements-progression' ),
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_flip_front_content', 'none' );
		
		
		$this->add_control(
			'boosted_elements_flip_box_link',
			[
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_control(
			'boosted_elements_table_button_apply_to',
			[
				'label' => esc_html__( 'Apply link to', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_button_link' => esc_html__( 'Button', 'boosted-elements-progression' ),
					'boosted_slide_link' => esc_html__( 'Entire Flip Box', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_button_link',
				'condition' => [
					'boosted_elements_flip_box_link[url]!' => '',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_flip_front_btn_text',
			[
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_flip_front_btn_text', 'none' );
		
		$this->add_control(
			'boosted_elements_front_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'boosted_elements_flip_front_btn_text!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_front_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_front_btn_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_front_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_front_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-button-front-alignment-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-button-front-alignment-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		

		$this->end_controls_section();
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_rear_options',
  			[
  				'label' => esc_html__( 'Rear Box', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_rear_icon_image',
			[
				'label' => esc_html__( 'Icon/Image', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => esc_html__( 'None', 'boosted-elements-progression' ),
						'icon' => 'fas fa-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'boosted-elements-progression' ),
						'icon' => 'far fa-image',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'boosted-elements-progression' ),
						'icon' => 'fa fa-user-circle',
					],
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_flip_rear_image',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_rear_icon_image' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_rear',
				'condition' => [
					'boosted_elements_rear_icon_image' => 'image',
				],
			]
		);
		
		

		
		$this->add_control(
			'boosted_elements_flip_rear_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user-circle',
					'library' => 'regular',
				],
				'condition' => [
					'boosted_elements_rear_icon_image' => 'icon',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_eleements_flip_rear_icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'boosted_eleements_flip_front_icon_style_background' => esc_html__( 'Background', 'boosted-elements-progression' ),
					'boosted_eleements_flip_front_icon_style_bordered' => esc_html__( 'Bordered', 'boosted-elements-progression' ),
				],
				'default' => 'default',
				'condition' => [
					'boosted_elements_rear_icon_image' => 'icon',
				],
			]
		);
		
		$this->add_control(
			'boosted_eleements_flip_rear_icon_shape',
			[
				'label' => esc_html__( 'Shape', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_flip_box_icon_border_round' => esc_html__( 'Rounded', 'boosted-elements-progression' ),
					'boosted_flip_box_icon_border_square' => esc_html__( 'Square', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_flip_box_icon_border_round',
				'condition' => [
					'boosted_eleements_flip_rear_icon_style!' => 'default',
					'boosted_elements_rear_icon_image' => 'icon',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_flip_rear_heading',
			[
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'placeholder' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Rear Box Heading', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_flip_rear_heading', 'none' );
		
		$this->add_control(
			'boosted_elements_flip_rear_content',
			[
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'after',
				'placeholder' => esc_html__( 'Content', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Easily add or remove any text on your flip box!', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_flip_rear_content', 'none' );
		
		$this->add_control(
			'boosted_elements_flip_rear_btn_text',
			[
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_flip_rear_btn_text', 'none' );
		
		
		$this->add_control(
			'boosted_elements_rear_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'boosted_elements_flip_rear_btn_text!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_rear_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_rear_btn_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_rear_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_rear_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-button-rear-alignment-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-button-rear-alignment-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		
		
		$this->end_controls_section();
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_flip_options',
  			[
  				'label' => esc_html__( 'Global Options', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_responsive_control(
			'boosted_elements_flip_main_height',
			[
				'label' => esc_html__( 'Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
					],
					'vh' => [
						'min' => 10,
						'max' => 150,
					],
					'em' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-flip-box-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_flip_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-flip-box-container .boosted-elements-flip-box-front-container' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .boosted-elements-progression-flip-box-container .boosted-elements-flip-box-rear-container' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boosted_iamge_shadow_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-flip-box-container .boosted-elements-flip-box-front-container, {{WRAPPER}} .boosted-elements-progression-flip-box-container .boosted-elements-flip-box-rear-container',
			]
		);
		
		$this->add_control(
			'boosted_eleements_flip_box_animate',
			[
				'label' => esc_html__( 'Animation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted-animate-flip',
				'options' => [
					'boosted-animate-flip' => esc_html__( 'Flip', 'boosted-elements-progression' ),
					'boosted-animate-slide' => esc_html__( 'Slide', 'boosted-elements-progression' ),
					'boosted-animate-push' => esc_html__( 'Push', 'boosted-elements-progression' ),
					'boosted-animate-zoom-in' => esc_html__( 'Zoom In', 'boosted-elements-progression' ),
					'boosted-animate-zoom-out' => esc_html__( 'Zoom Out', 'boosted-elements-progression' ),
					'boosted-animate-fade' => esc_html__( 'Fade', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_eleements_flip_box_animate_direction',
			[
				'label' => esc_html__( 'Animation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted-animate-left',
				'options' => [
					'boosted-animate-up' => esc_html__( 'Up', 'boosted-elements-progression' ),
					'boosted-animate-down' => esc_html__( 'Down', 'boosted-elements-progression' ),
					'boosted-animate-left' => esc_html__( 'Left', 'boosted-elements-progression' ),
					'boosted-animate-right' => esc_html__( 'Right', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_eleements_flip_box_animate!' => [
							'boosted-animate-zoom-in',
							'boosted-animate-zoom-out',
							'boosted-animate-fade',
						],
				],
			]
		);
		

		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_front_box_styles',
			[
				'label' => esc_html__( 'Front Box General Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_front_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container',
			]
		);


		$this->add_responsive_control(
			'boosted_elements_front_box_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-padding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_front_box_vertical_position',
			[
				'label' => esc_html__( 'Vertical', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'middle',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-vertical-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'display:block; position:static;',
					'middle' => 'display:table-cell; vertical-align:middle;  position:static;',
					'bottom' => 'position:absolute; bottom:0px; display:block;',
				],

			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_front_box_content_align',
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
					'{{WRAPPER}} .boosted-elements-flip-box-front-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_front_box_border',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_front_box_text_styles',
			[
				'label' => esc_html__( 'Front Box Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_title_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container h2.boosted-elements-flip-box-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_title_color',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container h2.boosted-elements-flip-box-heading' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_front_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container h2.boosted-elements-flip-box-heading',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'front_box_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container h2.boosted-elements-flip-box-heading',
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_content_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Content', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'boosted_flip_box_front_content_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_content_color',
			[
				'label' => esc_html__( 'Content Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-content' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_front_content_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-content',
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_icon_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_responsive_control(
			'boosted_flip_box_front_icon_size',
			[
				'label' => esc_html__( 'Icon/Image Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image i' => 'font-size: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_flip_box_front_icon_spacing',
			[
				'label' => esc_html__( 'Icon/Image Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_icon_background',
			[
				'label' => esc_html__( 'Icon Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_icon_bdr',
			[
				'label' => esc_html__( 'Icon Border', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_flip_box_front_icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-flip-box-icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_button_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_front_button_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_front_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button',
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_btn_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_front_btn_background',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_front_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button',
			]
		);
		
		$this->add_control(
			'boosted_elements_button_front_border_radius',
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
					'{{WRAPPER}} .boosted-elements-flip-box-front-container .boosted-elements-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_rear_box_styles',
			[
				'label' => esc_html__( 'Rear Box General Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_rear_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container',
			]
		);


		$this->add_responsive_control(
			'boosted_elements_rear_box_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-padding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_rear_box_vertical_position',
			[
				'label' => esc_html__( 'Vertical', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'middle',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-vertical-align' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'display:block; position:static;',
					'middle' => 'display:table-cell; vertical-align:middle;  position:static;',
					'bottom' => 'position:absolute; bottom:0px; display:block;',
				],

			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_rear_box_content_align',
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
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_rear_box_border',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_rear_box_text_styles',
			[
				'label' => esc_html__( 'Rear Box Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_title_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_flip_box_rear_title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container h2.boosted-elements-flip-box-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_title_color',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container h2.boosted-elements-flip-box-heading' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_rear_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container h2.boosted-elements-flip-box-heading',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'rear_box_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container h2.boosted-elements-flip-box-heading',
			]
		);
		
		
		
		$this->add_control(
			'boosted_flip_box_rear_content_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Content', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'boosted_flip_box_rear_content_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_content_color',
			[
				'label' => esc_html__( 'Content Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-content' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_rear_content_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-content',
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_icon_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_flip_box_rear_icon_size',
			[
				'label' => esc_html__( 'Icon/Image Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image i' => 'font-size: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_flip_box_rear_icon_spacing',
			[
				'label' => esc_html__( 'Icon/Image Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_rear_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_rear_icon_background',
			[
				'label' => esc_html__( 'Icon Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_rear_icon_bdr',
			[
				'label' => esc_html__( 'Icon Border', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_flip_box_rear_icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_flip_box_rear_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-flip-box-icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_button_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_button_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_flip_main_rear_border_radius',
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
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_rear_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button',
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
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_rear_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button',
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
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-flip-box-rear-container .boosted-elements-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		

		$this->end_controls_section();
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

	<div class="boosted-elements-progression-flip-box-container <?php echo esc_attr($settings['boosted_eleements_flip_box_animate'] ); ?> <?php echo esc_attr($settings['boosted_eleements_flip_box_animate_direction'] ); ?>">
		<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_slide_link' &&  ! empty( $settings['boosted_elements_flip_box_link']['url'] ) ) : ?><a <?php if ( ! empty( $settings['boosted_elements_flip_box_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?> href="<?php echo esc_url($settings['boosted_elements_flip_box_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_flip_box_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?>
		<div class="boosted-elements-flip-box-flip-card">
			<div class="boosted-elements-flip-box-front-container">
				<div class="boosted-elements-slider-display-table">
					<div class="boosted-elements-flip-box-vertical-align">
						<div class="boosted-elements-flip-box-padding">
							<?php if ( $settings['boosted_elements_icon_image'] == 'icon' ) : ?>
								<div class="boosted-elements-flip-box-icon-image <?php echo esc_attr($settings['boosted_eleements_flip_front_icon_style'] ); ?> <?php echo esc_attr($settings['boosted_eleements_flip_front_icon_shape'] ); ?>"><?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_flip_front_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
							<?php endif; ?>

							<?php if ( $settings['boosted_elements_icon_image'] == 'image' ) : ?>
								<div class="boosted-elements-flip-box-icon-image">
								 <?php if ( ! empty( $settings['boosted_elements_flip_front_image'] ) ) : ?>
									<?php $image = $settings['boosted_elements_flip_front_image'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
									<img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_html__( 'Insert Image Here', 'boosted-elements-progression' ); ?>">	
								 <?php endif; ?>
								</div>
							<?php endif; ?>


							<?php if ( ! empty( $settings['boosted_elements_flip_front_heading'] ) ) : ?>
								<h2 class="boosted-elements-flip-box-heading"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_front_heading' ) . '>' . $this->get_settings( 'boosted_elements_flip_front_heading' ) . '</span>';?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $settings['boosted_elements_flip_front_content'] ) ) : ?>
								<div class="boosted-elements-flip-box-content"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_front_content' ) . '>' . $this->get_settings( 'boosted_elements_flip_front_content' ) . '</span>';?></div>
							<?php endif; ?>
							<?php if ( ! empty( $settings['boosted_elements_flip_front_btn_text'] ) ) : ?>
								<div class="boosted-elements-button">
									<?php if ( ! empty( $settings['boosted_elements_front_btn_icon'] ) && $settings['boosted_elements_front_btn_icon_align'] == 'left' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_front_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-button-front-alignment-icon-left' ] ); ?>
									<?php endif; ?>
									<?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_front_btn_text' ) . '>' . $this->get_settings( 'boosted_elements_flip_front_btn_text' ) . '</span>';?>
									<?php if ( ! empty( $settings['boosted_elements_front_btn_icon'] ) && $settings['boosted_elements_front_btn_icon_align'] == 'right' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_front_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-button-front-alignment-icon-right' ] ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div><!-- close .boosted-elements-flip-box-padding -->
					</div><!-- close .boosted-elements-flip-box-vertical-align -->
				</div><!--close .boosted-elements-slider-display-table -->
			</div><!-- close .boosted-elements-flip-box-front-container -->

			<div class="boosted-elements-flip-box-rear-container">
				<div class="boosted-elements-slider-display-table">
					<div class="boosted-elements-flip-box-vertical-align">
						<div class="boosted-elements-flip-box-padding">
							
							<?php if ( $settings['boosted_elements_rear_icon_image'] == 'icon' ) : ?>
								<div class="boosted-elements-flip-box-icon-image <?php echo esc_attr($settings['boosted_eleements_flip_rear_icon_style'] ); ?> <?php echo esc_attr($settings['boosted_eleements_flip_rear_icon_shape'] ); ?>"><?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_flip_rear_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
							<?php endif; ?>

							<?php if ( $settings['boosted_elements_rear_icon_image'] == 'image' ) : ?>
								<div class="boosted-elements-flip-box-icon-image">
								 <?php if ( ! empty( $settings['boosted_elements_flip_rear_image'] ) ) : ?>
									<?php $image_rear = $settings['boosted_elements_flip_rear_image'];  $image_url_rear = Group_Control_Image_Size::get_attachment_image_src( $image_rear['id'], 'thumbnail_rear', $settings ); ?>
									<img src="<?php echo esc_url($image_url_rear);?>" alt="<?php echo esc_html__( 'Insert Image Here', 'boosted-elements-progression' ); ?>">	
								 <?php endif; ?>
								</div>
							<?php endif; ?>
							
							<?php if ( ! empty( $settings['boosted_elements_flip_rear_heading'] ) ) : ?>
								<h2 class="boosted-elements-flip-box-heading"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_rear_heading' ) . '>' . $this->get_settings( 'boosted_elements_flip_rear_heading' ) . '</span>';?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $settings['boosted_elements_flip_rear_content'] ) ) : ?>
								<div class="boosted-elements-flip-box-content"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_rear_content' ) . '>' . $this->get_settings( 'boosted_elements_flip_rear_content' ) . '</span>';?></div>
							<?php endif; ?>
							
							<?php if ( ! empty( $settings['boosted_elements_flip_rear_btn_text'] ) ) : ?>
								<?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_button_link' &&  ! empty( $settings['boosted_elements_flip_box_link']['url'] ) ) : ?><a <?php if ( ! empty( $settings['boosted_elements_flip_box_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?> href="<?php echo esc_url($settings['boosted_elements_flip_box_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_flip_box_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?><div class="boosted-elements-button">
									<?php if ( ! empty( $settings['boosted_elements_rear_btn_icon'] ) && $settings['boosted_elements_rear_btn_icon_align'] == 'left' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_rear_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-button-rear-alignment-icon-left' ] ); ?>
									<?php endif; ?>
									<?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_flip_rear_btn_text' ) . '>' . $this->get_settings( 'boosted_elements_flip_rear_btn_text' ) . '</span>';?>
									<?php if ( ! empty( $settings['boosted_elements_rear_btn_icon'] ) && $settings['boosted_elements_rear_btn_icon_align'] == 'right' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_rear_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'boosted-button-rear-alignment-icon-right' ] ); ?>
									<?php endif; ?>
								</div></a><?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_button_link' &&  ! empty( $settings['boosted_elements_flip_box_link']['url'] ) ) : ?></a><?php endif; ?>
							<?php endif; ?>
							
						</div><!-- close .boosted-elements-flip-box-padding -->		
					</div><!-- close .boosted-elements-flip-box-vertical-align -->
				</div><!--close .boosted-elements-slider-display-table -->
				
			</div>

		</div><!-- close .boosted-elements-flip-box-rear-container --><?php if ( $settings['boosted_elements_table_button_apply_to'] == 'boosted_slide_link' &&  ! empty( $settings['boosted_elements_flip_box_link']['url'] ) ) : ?></a><?php endif; ?>
		
	</div><!-- close .boosted-elements-progression-flip-box-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsFlipBox() );