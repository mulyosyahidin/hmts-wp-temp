<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsSlider extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-slider';
	}

	public function get_title() {
		return esc_html__( 'Slider - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-slideshow boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_flexslider_js', 'boosted_elements_progression_video_background_js', 'boosted_elements_progression_prettyphoto_js', 'boosted_elements_progression_matchheight_js' ];
	}
	
	public function get_style_depends() { 
		return [ 'elementor-icons-shared', 'elementor-icons-fa-solid' ];
	}

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Slide Content', 'boosted-elements-progression' )
  			]
  		);
		
		$repeater = new Repeater();
		
		$repeater->start_controls_tabs( 'boosted_slide_container' );
		
		$repeater->start_controls_tab( 'content', [ 'label' => esc_html__( 'Content', 'boosted-elements-progression' ) ] );
		
		$repeater->add_control(
			'boosted_elements_slide_title',
			[
				'placeholder' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Slide Title', 'boosted-elements-progression' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_sub_title',
			[
				'placeholder' => esc_html__( 'Slide Sub-Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_content',
			[
				'placeholder' => esc_html__( 'Slide Content', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_slide_content_image_on_off',
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
		
		
		$repeater->add_control(
			'boosted_elements_slide_content_image',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_slide_content_image_on_off' => 'image',
				],
			]
		);
		
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumb',
				'default' => 'full',
				'condition' => [
					'boosted_elements_slide_content_image[url]!' => '',
				],
			]
		);


		
		$repeater->add_control(
			'boosted_elements_slide_button_url',
			[
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_button_url_application',
			[
				'label' => esc_html__( 'Apply link to', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_button_link' => esc_html__( 'Button', 'boosted-elements-progression' ),
					'boosted_slide_link' => esc_html__( 'Entire Slide', 'boosted-elements-progression' ),
					'boosted_lightbox_link' => esc_html__( 'Open in Lightbox', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_button_link',
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_button_url[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_button_text',
			[
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'boosted_elements_button_icon',
			[
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition' => [
					'boosted_elements_slide_button_text!' => '',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_button_icon!' => '',
				],
			]
		);

		$repeater->add_control(
			'boosted_elements_button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slide-button-main .slide-button-align-icon-right' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-slide-button-main .slide-button-align-icon-left' => 'margin-left: {{SIZE}}px;',
				],
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_slide_second_button_text',
			[
				'label' => esc_html__( 'Additional Button', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'condition' => [
					'boosted_elements_slide_button_text!' => '',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_second_button_url',
			[
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
				'label_block' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_second_button_text',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_second_button_url_application',
			[
				'label' => esc_html__( 'Apply link to', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_button_link' => esc_html__( 'Button', 'boosted-elements-progression' ),
					'boosted_lightbox_link' => esc_html__( 'Open in Lightbox', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_button_link',
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_second_button_url[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		
		
		
		$repeater->add_control(
			'boosted_elements_second_button_icon',
			[
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition' => [
					'boosted_elements_slide_second_button_text!' => '',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_second_button_icon_align',
			[
				'label' => esc_html__( 'Additional Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_second_button_icon!' => '',
				],
			]
		);

		$repeater->add_control(
			'boosted_elements_second_button_icon_indent',
			[
				'label' => esc_html__( 'Additional Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_second_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slide-button-secondary .slide-second-button-align-icon-right' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-slide-button-secondary .slide-second-button-align-icon-left' => 'margin-left: {{SIZE}}px;',
				],
			]
		);
		
		
		
		
		$repeater->end_controls_tab();
		
		
		
		$repeater->start_controls_tab( 'boosted_slide_background', [ 'label' => esc_html__( 'Background', 'boosted-elements-progression' ) ] );
		
		$repeater->add_control(
			'boosted_elements_slide_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-background, {{WRAPPER}} {{CURRENT_ITEM}} .progression-studios-boosted-slider-upside-down' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_background_image',
			[
				'label' => esc_html__( 'Background Image', 'boosted-elements-progression' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-background, {{WRAPPER}} {{CURRENT_ITEM}} .progression-studios-boosted-slider-upside-down' => 'background-image: url({{URL}})',
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_background_cover',
			[
				'label' => esc_html__( 'Background Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => esc_html__( 'Cover', 'boosted-elements-progression' ),
					'contain' => esc_html__( 'Contain', 'boosted-elements-progression' ),
					'auto' => esc_html__( 'Auto', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-background, {{WRAPPER}} {{CURRENT_ITEM}} .progression-studios-boosted-slider-upside-down' => 'background-size: {{VALUE}}; background-position:center center;',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		

		
		$repeater->add_control(
			'boosted_elements_slide_image_overlay',
			[
				'label' => esc_html__( 'Image Overlay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'boosted_elements_slide_image_overlay_color',
			[
				'label' => esc_html__( 'Overlay color', 'boosted-elements-progression' ),
				'label_block' => 'true',
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.7)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_image_overlay',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-background .boosted-elements-slider-bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_slide_video_background',
			[
				'label' => esc_html__( 'Video Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => '',
			]
		);
		
		$repeater->add_control(
			'boosted_elements_slide_video_background_mp4_address',
			[
				'label' => esc_html__( 'Video', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '.mp4 Video URL', 'boosted-elements-progression' ),
				'label_block' => false,
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_elements_slide_video_background',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		
		
		
		$repeater->end_controls_tab();
		
		
		
		
		$repeater->start_controls_tab( 'boosted_slide_position', [ 'label' => esc_html__( 'Custom', 'boosted-elements-progression' ) ] );
		
		
		$repeater->add_control(
			'boosted_slide_position_per_slide',
			[
				'label' => esc_html__( 'Customize per slide', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		
		$repeater->add_control(
			'boosted_slide_position_per_slide_text_align',
			[
				'label' => esc_html__( 'Text Align', 'boosted-elements-progression' ),
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
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		
		$repeater->add_control(
			'boosted_slide_position_per_slide_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto; margin-left:0px;',
					'center' => 'margin: 0 auto;',
					'right' => 'margin-left: auto; margin-right:0px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		$repeater->add_control(
			'boosted_slide_position_per_slide_vertical_position',
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
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content-container' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'display:block; position:static;',
					'middle' => 'display:table-cell; vertical-align:middle;  position:static;',
					'bottom' => 'position:absolute; bottom:0px; display:block;',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		$repeater->add_control(
			'boosted_elements_per_slide_heading_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content .boosted-elements-slide-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content .boosted-elements-slide-sub-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content .boosted-elements-slide-content' => 'color: {{VALUE}}',

				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		
		$repeater->add_responsive_control(
			'boosted_elements_per_slide_content_width',
			[
				'label' => esc_html__( 'Caption Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .boosted-elements-slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		
		$repeater->add_responsive_control(
			'boosted_elements_per_slide_content_padding',
			[
				'label' => esc_html__( 'Caption Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .bosted-element-content-margin' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'boosted_slide_position_per_slide',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
			]
		);
		
		

		
		$repeater->end_controls_tab();
		
		
		$this->add_control(
			'boosted_slide_control',
			[
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
					[
						'boosted_elements_slide_title' => esc_html__( 'Slide 1 Title', 'boosted-elements-progression' ),
						'boosted_elements_slide_background_color' => '#0e9dd2',
						'boosted_elements_slide_content' => esc_html__( 'Easily add or remove any text on your slider!', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_slide_title' => esc_html__( 'Slide 2 Title', 'boosted-elements-progression' ),
						'boosted_elements_slide_background_color' => '#6fbc96',
						'boosted_elements_slide_content' => esc_html__( 'All of the fields are optional on your slider!', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_slide_title' => esc_html__( 'Slide 3 Title', 'boosted-elements-progression' ),
						'boosted_elements_slide_background_color' => '#d78a8a',
						'boosted_elements_slide_content' => esc_html__( 'Adjust your image background colors, add a background image and more!', 'boosted-elements-progression' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'title_field' => '<i class="far fa-file-image"></i> {{{ boosted_elements_slide_title }}}',
			]
		);
		
		
		$this->end_controls_section();

		
  		$this->start_controls_section(
  			'section_title_boosted_slider_options',
  			[
  				'label' => esc_html__( 'Slider Options', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_responsive_control(
			'boosted_elements_slider_main_height',
			[
				'label' => esc_html__( 'Slider Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 600,
					'unit' => 'px',
				],
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
					'{{WRAPPER}} .boosted-elements-slider-background, {{WRAPPER}}  .boosted-elements-slider-loader-height' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_force_height',
			[
				'label' => esc_html__( 'Match Slider Height to container', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Add div by id or class to force slider to that container height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'boosted_elements_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_play_number_speed',
			[
				'label' => esc_html__( 'Autoplay Speed', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '7000',
				'condition' => [
					'boosted_elements_autoplay!' => '',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_slider_pause_hover',
			[
				'label' => esc_html__( 'Pause on Hover', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_slider_arrow_visiblity',
			[
				'label' => esc_html__( 'Slide Arrows', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted_elements_slider_arrow_visiblity_hover',
				'options' => [
					'boosted_elements_slider_arrow_visiblity_visible' => esc_html__( 'Always Visible', 'boosted-elements-progression' ),
					'boosted_elements_slider_arrow_visiblity_hover' => esc_html__( 'Visible on Hover', 'boosted-elements-progression' ),
					'boosted_elements_slider_arrow_visiblity_hidden' => esc_html__( 'Hidden', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_slider_bullets_visiblity',
			[
				'label' => esc_html__( 'Slide Bullets', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted_elements_slider_dots_visiblity_visible',
				'options' => [
					'boosted_elements_slider_dots_visiblity_visible' => esc_html__( 'Always Visible', 'boosted-elements-progression' ),
					'boosted_elements_slider_dots_visiblity_hover' => esc_html__( 'Visible on Hover', 'boosted-elements-progression' ),
					'boosted_elements_slider_dots_visiblity_hidden' => esc_html__( 'Hidden', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_slide_scroll_down',
			[
				'label' => esc_html__( 'Scroll Down Button', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_slide_scroll_down_spacing',
			[
				'label' => esc_html__( 'Scroll Down Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'condition' => [
					'boosted_slide_scroll_down!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'bottom: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_slide_scroll_down_offset',
			[
				'label' => esc_html__( 'Scroll Down Offset', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'condition' => [
					'boosted_slide_scroll_down!' => '',
				],
			]
		);
		
		
		$this->add_control(
			'progression_elements_slider_reflection',
			[
				'label' => esc_html__( 'Show Reflection', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_reflection_color',
			[
				'label' => esc_html__( 'Reflection Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progression-studios-boosted-slider-upside-down:after' => 'background: -moz-linear-gradient(top, {{VALUE}} 0%, {{VALUE}} 80% , rgba(8,7,14,0) 100% );
					background: -webkit-linear-gradient(top,  {{VALUE}} 0%, {{VALUE}} 80%, rgba(8,7,14,0) 100% );
					background: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 80%, rgba(8,7,14,0) 100% )',
				],
				'condition' => [
					'progression_elements_slider_reflection' => 'yes',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_slider_animations',
  			[
  				'label' => esc_html__( 'Slide Animations', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_slider_transition',
			[
				'label' => esc_html__( 'Slide Transition', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => esc_html__( 'Fade', 'boosted-elements-progression' ),
					'slide' => esc_html__( 'Slide', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_slide_transition_speed',
			[
				'label' => esc_html__( 'Transition Speed', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '500',
			]
		);
		
		$this->add_control(
			'boosted_elements_slider_css3_animation',
			[
				'label' => esc_html__( 'Text Animation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bosted_animate_in',
				'options' => [
					'bosted_animate_none' => esc_html__( 'No Animation', 'boosted-elements-progression' ),
					'bosted_animate_in' => esc_html__( 'Zoom in', 'boosted-elements-progression' ),
					'bosted_animate_out' => esc_html__( 'Zoom Out', 'boosted-elements-progression' ),
					'bosted_animate_down' => esc_html__( 'Fade Down', 'boosted-elements-progression' ),
					'bosted_animate_up' => esc_html__( 'Fade Up', 'boosted-elements-progression' ),
					'bosted_animate_right' => esc_html__( 'Fade Right', 'boosted-elements-progression' ),
					'bosted_animate_left' => esc_html__( 'Fade Left', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_slider_css3_animation_delay',
			[
				'label' => esc_html__( 'Animation Delay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted-animation-delay-none',
				'options' => [
					'boosted-animation-delay-one' => esc_html__( '100ms', 'boosted-elements-progression' ),
					'boosted-animation-delay' => esc_html__( '200ms', 'boosted-elements-progression' ),
					'boosted-animation-delay-three' => esc_html__( '300ms', 'boosted-elements-progression' ),
					'boosted-animation-delay-four' => esc_html__( '400ms', 'boosted-elements-progression' ),
					'boosted-animation-delay-five' => esc_html__( '500ms', 'boosted-elements-progression' ),
					'boosted-animation-delay-none' => esc_html__( 'No delay', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_kenburns_effect',
			[
				'label' => esc_html__( 'Ken Burns Effect', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'template',
			]
		);
		
		$this->add_control(
			'boosted_elements_slide_ken_burns',
			[
				'label' => esc_html__( 'Ken Burns Speed in milliseconds', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'render_type' => 'template',
				'default' => '6000',
				'condition' => [
					'boosted_elements_kenburns_effect' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-background' => 'transition:all {{SIZE}}ms; background-size: 100% !important; ',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_slide_ken_burns_percentage',
			[
				'label' => esc_html__( 'Ken Burns Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 120,
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 100,
						'max' => 200,
					],
				],
				'render_type' => 'template',
				'condition' => [
					'boosted_elements_kenburns_effect' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} li.boosted-elements-slider-active-slide .boosted-elements-slider-background' => 'background-size: {{SIZE}}% !important; ',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'boosted_elements_section_main_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_container_full_width',
			[
				'label' => esc_html__( 'Content Container Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1600,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-container-fixed-optional' => 'width: {{SIZE}}{{UNIT}}; margin:0 auto;',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_caption_text_background_color',
			[
				'label' => esc_html__( 'Caption Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bosted-element-content-margin' => 'background: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_content_width',
			[
				'label' => esc_html__( 'Caption Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '70',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_content_padding',
			[
				'label' => esc_html__( 'Caption Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bosted-element-content-margin' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_content_align',
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
					'{{WRAPPER}} .boosted-elements-slider-content' => 'text-align: {{VALUE}}',
				],
			]
		);
		

		$this->add_responsive_control(
			'boosted_elements_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
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
					'{{WRAPPER}} .boosted-elements-slider-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto; margin-left:0px;',
					'center' => 'margin: 0 auto;',
					'right' => 'margin-left: auto; margin-right:0px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_horizontal_adjustment',
			[
				'label' => esc_html__( 'Horizontal Adjustment', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .bosted-element-content-margin' => 'left: {{SIZE}}{{UNIT}}; position:relative;',
				],
			]
		);

		
		$this->add_responsive_control(
			'boosted_elements_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
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
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content-container' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'display:block; position:static;',
					'middle' => 'display:table-cell; vertical-align:middle; position:static;',
					'bottom' => 'position:absolute; bottom:0px;',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_overlay_gradient_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Slide Overlay Gradient', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_overlay_gradient_background',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-slider-gradient-overlay',
			]
		);
		



		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'boosted_elements_section_title_styles',
			[
				'label' => esc_html__( 'Content Title', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_heading_spacing',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title' => 'margin-bottom: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_heading_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_heading_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_heading_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title',
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_title_padding_text',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_heading_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title span' => 'background: {{VALUE}}',
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title span:after, {{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-title span:before' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'boosted_elements_section_sub_title_styles',
			[
				'label' => esc_html__( 'Content Sub-title', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_sub_heading_spacing',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title' => 'margin-bottom: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_sub_heading_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title' => 'color: {{VALUE}}',

				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_sub_heading_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_sub_heading_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title',
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_subtitle_padding_text',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_subtitle_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-sub-title span' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'boosted_elements_section_main_typography_styles',
			[
				'label' => esc_html__( 'Content Main', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_main_content_spacing',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content' => 'margin-bottom: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_main_content_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content' => 'color: {{VALUE}}',

				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_main_content_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_main_content_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content',
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_elements_main_text_padding_text',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_main_text_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-content span' => 'background: {{VALUE}}',
				],
			]
		);
		

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'boosted_elements_section_image_styles',
			[
				'label' => esc_html__( 'Image Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,

			]
		);

		

		
		
		$this->add_responsive_control(
			'boosted_elements_content_image_vertical_position',
			[
				'label' => esc_html__( 'Vertical Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '40',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content-image' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_content_image_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '80',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content-image' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_content_image_padding',
			[
				'label' => esc_html__( 'Image Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content-image-margins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_elements_content_image_width',
			[
				'label' => esc_html__( 'Image Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 850,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'default' => [
					'size' => '100',
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'boosted_elements_section_button_typography_styles',
			[
				'label' => esc_html__( 'Content Button', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_section_button_spacing_margin',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		

		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
			]
		);
		
		$this->add_control(
			'boosted_elements_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'border-radius: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_button_border_width_new',
				'selector' => '{{WRAPPER}}  .boosted-elements-slider-content .boosted-elements-slide-button-main',
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
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_main_btn_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main',
			]
		);
		
		
		

		$this->end_controls_section();
		
		
		
		
		$this->start_controls_section(
			'boosted_elements_section_button_second_typography_styles',
			[
				'label' => esc_html__( 'Content Additional Button', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_secondary_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);
		
		$this->add_control(
			'boosted_elements_button_margins',
			[
				'label' => esc_html__( 'Margin Between Buttons', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-main' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'boosted_elements_second_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		

		
		
		$this->add_responsive_control(
			'boosted_elements_main_alterantive_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		
		$this->start_controls_tabs( 'boosted_elements_secondary_button_tabs' );

		$this->start_controls_tab( 'secondary_normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_secondary_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_secondary_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_second_button_border_width_new',
				'selector' => '{{WRAPPER}}  .boosted-elements-slider-content .boosted-elements-slide-button-secondary',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_second_btn_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary',
			]
		);
		
		
		
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_secondary_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_secondary_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_secondary_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_secondary_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'boosted_elements_second_btn_text_shadow_hover',
				'selector' => '{{WRAPPER}} .boosted-elements-slider-content .boosted-elements-slide-button-secondary:hover',
			]
		);
		
	
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		
		
		
		

		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'boosted_elements_section_navigation_styles',
			[
				'label' => esc_html__( 'Navigation Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'boosted_elements_navigation_arrow_color',
			[
				'label' => esc_html__( 'Arrow Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-direction-nav a:before' => 'color: {{VALUE}}; text-shadow:none;',

				],
			]
		);
		
		$this->add_control(
			'boosted_elements_navigation_arrow_size',
			[
				'label' => esc_html__( 'Arrow Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-direction-nav a:before' => 'font-size: {{SIZE}}px',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_navigation_arrow_position',
			[
				'label' => esc_html__( 'Arrow Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-direction-nav .boosted-elements-slider-prev' => 'padding-left: {{SIZE}}px',
					'{{WRAPPER}} .boosted-elements-slider-direction-nav .boosted-elements-slider-next' => 'padding-right: {{SIZE}}px',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_navigation_bullet_hover_color',
			[
				'label' => esc_html__( 'Bullet Selected Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-control-paging li a.boosted-elements-slider-active' => 'background: {{VALUE}}',

				],
			]
		);
		
		$this->add_control(
			'boosted_elements_navigation_bullet_color',
			[
				'label' => esc_html__( 'Bullet Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-control-paging li a' => 'background: {{VALUE}}',

				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_navigation_bullet_size',
			[
				'label' => esc_html__( 'Bullet Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-control-paging li a' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_navigation_bullet_position_bottom',
			[
				'label' => esc_html__( 'Bullet Position Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-control-nav' => 'bottom: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_navigation_bullet_position_left_right',
			[
				'label' => esc_html__( 'Bullet Left/Right Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-slider-control-nav li' => 'margin-left: {{SIZE}}px; margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_arrow_down_border_radius',
			[
				'label' => esc_html__( 'Scroll Down Border Radius', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_arrow_down_border_width',
			[
				'label' => esc_html__( 'Scroll Down Border Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		
		
		$this->start_controls_tabs( 'boosted_elements_arrow_down_tabs' );

		$this->start_controls_tab( 'arrow_downnormal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_arrow_down_text_color',
			[
				'label' => esc_html__( 'Scroll Down Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_arrow_down_border_color',
			[
				'label' => esc_html__( 'Scroll Down Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_arrow_down_background_color',
			[
				'label' => esc_html__( 'Scroll Down Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down' => 'background-color: {{VALUE}};',
				],
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elementsarrow_down_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_arrow_down_hover_text_color',
			[
				'label' => esc_html__( 'Scroll Down Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_arrow_down_hover_background_color',
			[
				'label' => esc_html__( 'Scroll Down Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_arrow_down_hover_border_color',
			[
				'label' => esc_html__( 'Scroll Down Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-slider-arrow-down:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		
		$this->end_controls_section();
		
		

	}
	
	
	

	protected function render( ) {
		
      $settings = $this->get_settings();
		
		if ( empty( $settings['boosted_slide_control'] ) ) {
			return;
		}

		
	?>
	
	<?php if ( empty( $settings['boosted_elements_force_height'] ) ) : ?><div class="boosted-elements-slider-loader-height"><?php endif; ?>
		<div class="boosted-elements-progression-slider-container <?php if ( $settings['boosted_elements_slider_css3_animation_delay'] == 'boosted-animation-delay-none' ) : ?>boosted-no-delay-animate<?php else: ?>boosted-delay-animate<?php endif; ?> <?php echo esc_attr($settings['boosted_elements_slider_arrow_visiblity'] ); ?> <?php echo esc_attr($settings['boosted_elements_slider_bullets_visiblity'] ); ?>">
			<div id="boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-slider-main">
				<ul class="boosted-elements-slides">
					<?php foreach ( $settings['boosted_slide_control'] as $item ) : ?>
						<li class="elementor-repeater-item-<?php echo $item['_id'] ?> <?php echo esc_attr($settings['boosted_elements_slider_css3_animation'] ); ?>">
						
						
							<?php if ( $item['boosted_elements_slide_button_url_application'] == 'boosted_slide_link' &&  ! empty( $item['boosted_elements_slide_button_url']['url'] ) ) : ?>
								<a href="<?php echo esc_url($item['boosted_elements_slide_button_url']['url']); ?>" <?php if ( ! empty( $item['boosted_elements_slide_button_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $item['boosted_elements_slide_button_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>> 
							<?php endif; ?>
						
						
						
							<div class="boosted-elements-slider-background">
							
								<div class="boosted-elements-slider-display-table">
									<div class="boosted-elements-slider-content-container">
									
										<div class="boosted-elements-slider-container-fixed-optional">
										<div class="boosted-elements-slider-content">
										
											<div class="bosted-element-content-margin">
												<?php if ( ! empty( $item['boosted_elements_slide_title'] ) ) : ?>
													<h2 class="boosted-elements-slide-title <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>"><span><?php echo wp_kses( __($item['boosted_elements_slide_title'] ), true); ?></span></h2>
												<?php endif; ?>
												<?php if ( ! empty( $item['boosted_elements_slide_sub_title'] ) ) : ?>
													<div class="boosted-elements-slide-sub-title <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>"><span><?php echo wp_kses( __($item['boosted_elements_slide_sub_title'] ), true); ?></span></div>
												<?php endif; ?>
												<?php if ( ! empty( $item['boosted_elements_slide_content'] ) ) : ?>
													<div class="boosted-elements-slide-content <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>"><span><?php echo wp_kses( __($item['boosted_elements_slide_content'] ), true); ?></span></div>
												<?php endif; ?>
									
												<?php if (  ! empty( $item['boosted_elements_slide_button_text'] ) && $item['boosted_elements_slide_button_url_application'] == 'boosted_button_link' &&  ! empty( $item['boosted_elements_slide_button_url']['url'] ) ) : ?>
													<a href="<?php echo esc_url($item['boosted_elements_slide_button_url']['url']); ?>" class="boosted-elements-slide-button-main <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>" <?php if ( ! empty( $item['boosted_elements_slide_button_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $item['boosted_elements_slide_button_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>>
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'left' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-right' ] ); ?>
													<?php endif; ?>
														<?php echo esc_attr($item['boosted_elements_slide_button_text'] ); ?>
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'right' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-left' ] ); ?>
													<?php endif; ?>
													</a>
												
												
												<?php else: ?>
												
												
													<?php if (  $item['boosted_elements_slide_button_url_application'] == 'boosted_lightbox_link' &&  ! empty( $item['boosted_elements_slide_button_url']['url'] ) ) : ?>
														<a href="<?php echo esc_url($item['boosted_elements_slide_button_url']['url']); ?>" data-rel="prettyPhoto" class="boosted-elements-slider-lightbox boosted-elements-slide-button-main <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>"> 
														
														
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'left' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-right' ] ); ?>
													<?php endif; ?>
														<?php echo esc_attr($item['boosted_elements_slide_button_text'] ); ?>
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'right' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-left' ] ); ?>
													<?php endif; ?>
												
													</a>
												
													<?php else: ?>
												
													<?php if (  ! empty( $item['boosted_elements_slide_button_text'] ) ) : ?><div class="boosted-elements-slide-button-main <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?>">
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'left' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-right' ] ); ?>
													
													<?php endif; ?>
														<?php echo esc_attr($item['boosted_elements_slide_button_text'] ); ?>
													<?php if ( ! empty( $item['boosted_elements_button_icon'] ) && $item['boosted_elements_button_icon_align'] == 'right' ) : ?>
														<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-button-align-icon-left' ] ); ?>
													
													<?php endif; ?>
												
												
													</div><?php endif; ?><?php endif; ?>
												<?php endif; ?>
	
											
											
											
												<?php if ( ! empty( $item['boosted_elements_slide_second_button_text'] ) ) : ?>
													<<?php if ( ! empty( $item['boosted_elements_slide_second_button_url']['url'] ) ) : ?>a href="<?php echo esc_url($item['boosted_elements_slide_second_button_url']['url']); ?>"<?php else: ?>div <?php endif; ?> class="boosted-elements-slide-button-secondary <?php echo esc_attr($settings['boosted_elements_slider_css3_animation_delay'] ); ?> <?php if (  $item['boosted_elements_slide_second_button_url_application'] == 'boosted_lightbox_link' &&  ! empty( $item['boosted_elements_slide_second_button_url']['url'] ) ) : ?> boosted-elements-slider-lightbox<?php endif; ?>" <?php if (  $item['boosted_elements_slide_second_button_url_application'] == 'boosted_lightbox_link' &&  ! empty( $item['boosted_elements_slide_second_button_url']['url'] ) ) : ?>data-rel="prettyPhoto"<?php endif; ?> <?php if ( ! empty( $item['boosted_elements_slide_second_button_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $item['boosted_elements_slide_second_button_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>>
														<?php if ( ! empty( $item['boosted_elements_second_button_icon'] ) && $item['boosted_elements_second_button_icon_align'] == 'left' ) : ?>
															<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_second_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-second-button-align-icon-right' ] ); ?>
														
														<?php endif; ?>
														<?php echo esc_attr($item['boosted_elements_slide_second_button_text'] ); ?>
												
														<?php if ( ! empty( $item['boosted_elements_second_button_icon'] ) && $item['boosted_elements_second_button_icon_align'] == 'right' ) : ?>
															<?php \Elementor\Icons_Manager::render_icon( $item['boosted_elements_second_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'slide-second-button-align-icon-left' ] ); ?>
														<?php endif; ?>
													<?php if ( ! empty( $item['boosted_elements_slide_second_button_url']['url'] ) ) : ?></a><?php else: ?></div><?php endif; ?>
												<?php endif; ?>									
									
												<div class="clearfix-boosted-element"></div>
											</div><!-- close .bosted-element-content-margin -->	
											
										</div><!-- close .boosted-elements-slider-content -->
									
										</div><!-- close .boosted-elements-slider-container-fixed-optional -->
									
										<?php if ( $item['boosted_elements_slide_content_image_on_off'] == 'image' ) : ?>
										<div class="boosted-elements-slider-content-image ">
											<div class="boosted-elements-slider-content-image-margins">
												<div class="boosted-elements-slider-image-animate">
							  				 <?php if ( ! empty( $item['boosted_elements_slide_content_image'] ) ) : ?>
							  					<?php $image = $item['boosted_elements_slide_content_image'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb', $item ); ?>
							  					<img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_html__( 'Insert Image Here', 'boosted-elements-progression' ); ?>">	
							  				 <?php endif; ?>
											 </div><!-- close .boosted-elements-slider-image-animate -->
											</div><!-- close .boosted-elements-slider-content-image-margins -->
										</div><!-- close .boosted-elements-slider-content-image -->
										<?php endif; ?>	
									
									</div><!-- close .boosted-elements-slider-content-container -->

									<?php if ( ! empty( $item['boosted_elements_slide_video_background_mp4_address'] ) && ! empty( $item['boosted_elements_slide_video_background'] ) ) : ?>
									<div id="boosted-elements-video-bg-<?php echo $item['_id'] ?>" class="boosted-elements-video-bg"></div>
									<script type="text/javascript"> 
									jQuery(document).ready(function($) {
										'use strict';
										$('#boosted-elements-video-bg-<?php echo $item['_id'] ?>').vidbg({
										  'mp4': '<?php echo esc_url($item['boosted_elements_slide_video_background_mp4_address'] ); ?>',
										}, {
										  muted: true,
										  loop: true,
										});
									});
									</script>
										
									<?php endif; ?>
								
								
									<?php if ( ! empty( $item['boosted_elements_slide_image_overlay'] ) ) : ?><div class="boosted-elements-slider-bg-overlay"></div><!-- close .boosted-elements-slider-bg-overlay --><?php endif; ?>
									<div class="boosted-elements-slider-gradient-overlay"></div>
								</div>
							
							</div><!-- close  .boosted-elements-slider-background -->
					
						
							<?php if ( $item['boosted_elements_slide_button_url_application'] == 'boosted_slide_link' &&  ! empty( $item['boosted_elements_slide_button_url']['url'] ) ) : ?></a><?php endif; ?>
								
								<?php if ( $settings['progression_elements_slider_reflection'] == 'yes') : ?><div class="progression-studios-boosted-slider-upside-down"></div><?php endif; ?>
						
						</li>
					<?php endforeach; ?>
				</ul>
			
				<?php if ( ! empty( $settings['boosted_slide_scroll_down'] ) ) : ?><div class="boosted-slider-arrow-down"><i class="fas fa-chevron-down" aria-hidden="true"></i></div><?php endif; ?>
			
			</div><!-- #boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?> -->
		</div><!-- close .boosted-elements-progression-slider-container -->
	<?php if ( empty( $settings['boosted_elements_force_height'] ) ) : ?></div><!-- close .boosted-elements-slider-loader-height --><?php endif; ?>
	<div class="clearfix-boosted-element"></div>
	
	
													
	<script type="text/javascript"> 
	jQuery(document).ready(function($) {
		'use strict';
		
		<?php if ( ! empty( $settings['boosted_slide_scroll_down'] ) ) : ?>
		$('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?> .boosted-slider-arrow-down').click(function(){	
			$("html, body").animate({
			      scrollTop: $('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?>').offset().top + $('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?>').outerHeight(true)	<?php if ( ! empty( $settings['boosted_slide_scroll_down_offset']['size'] ) ) : ?> + <?php echo esc_attr($settings['boosted_slide_scroll_down_offset']['size'] ); ?><?php endif; ?>	
			    }, 500);
		});
		<?php endif; ?>
		
      $('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?>').flexslider({
			namespace: "boosted-elements-slider-",
			selector: ".boosted-elements-slides  > li",
			prevText: "",
			touch: true,
			nextText: "",
			slideshow:<?php if ( ! empty( $settings['boosted_elements_autoplay'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
			slideshowSpeed: <?php echo esc_attr($settings['boosted_elements_play_number_speed'] ); ?>,
			animation: "<?php echo esc_attr($settings['boosted_elements_slider_transition'] ); ?>",
			animationSpeed: <?php echo esc_attr($settings['boosted_elements_slide_transition_speed'] ); ?>,
			pauseOnHover: <?php if ( ! empty( $settings['boosted_elements_slider_pause_hover'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
			<?php if ( $settings['boosted_elements_slider_transition'] == 'slide' ) : ?>
			start: function(){
			        $('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?>').resize();
			    }
			<?php endif; ?>
      });
		
   	$("#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?> a.boosted-elements-slider-lightbox[data-rel^='prettyPhoto']").prettyPhoto({
 			theme: 'pp_default',
   			hook: 'data-rel',
 				opacity: 0.7,
   			show_title: false,
   			deeplinking: false,
   			overlay_gallery: false,
   			custom_markup: '',
 				default_width: 900,
 				default_height: 506,
   			social_tools: ''
   	});
		
		
		<?php if ( ! empty( $settings['boosted_elements_force_height'] ) ) : ?>
		$('#boosted-elements-progression-flexslider-<?php echo esc_attr($this->get_id()); ?> .boosted-elements-slider-background').matchHeight({
		        target: $('<?php echo esc_attr($settings['boosted_elements_force_height'] ); ?>')
		});		
		<?php endif; ?>
		
	});
	</script>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsSlider() );