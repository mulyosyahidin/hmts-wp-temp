<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsImage_Slideshow extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-image-slideshow';
	}

	public function get_title() {
		return esc_html__( 'Image Slideshow - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-image-bold boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_fotorama_js' ]; 
	}

	public function get_style_depends() { 
		return [ 'elementor-icons-shared', 'elementor-icons-fa-solid' ];
	}

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Images', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_image_gallery',
			[
				'label' => esc_html__( 'Images', 'boosted-elements-progression' ),
				'type' => Controls_Manager::GALLERY,
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_gallery_fit',
			[
				'label' => esc_html__( 'Image Fit', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => esc_html__( 'Cover', 'boosted-elements-progression' ),
					'contain' => esc_html__( 'Contain', 'boosted-elements-progression' ),
					'scaledown' => esc_html__( 'Scale Down', 'boosted-elements-progression' ),
					'none' => esc_html__( 'No Scaling', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_gallery_videos',
			[
				'label' => 'Add Youtube or Vimeo Slides via URL',
				'separator' => 'before',
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'boosted_elements_video_url',
						'label' => esc_html__( 'Video URL', 'boosted-elements-progression' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
				],
				'title_field' => '{{{ boosted_elements_video_url }}}',
			]
		);
		

		$this->end_controls_section();
		
  		$this->start_controls_section(
  			'section_title_boosted_slideshow_options',
  			[
  				'label' => esc_html__( 'Slideshow Options', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_gallery_navigation',
			[
				'label' => esc_html__( 'Navigation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'thumbs',
				'options' => [
					'thumbs' => esc_html__( 'Thumbnails', 'boosted-elements-progression' ),
					'dots' => esc_html__( 'Dots', 'boosted-elements-progression' ),
					'false' => esc_html__( 'None', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_arrows',
			[
				'label' => esc_html__( 'Arrow Navigation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_transition',
			[
				'label' => esc_html__( 'Transition', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'crossfade',
				'options' => [
					'crossfade' => esc_html__( 'Fade', 'boosted-elements-progression' ),
					'slide' => esc_html__( 'Slide', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_transition_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'boosted-elements-progression' ),
				'description' => esc_html__( 'In milliseconds', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '0',
				'default' => '300',
			]
		);
		
		$this->end_controls_section();
		
  		$this->start_controls_section(
  			'section_title_boosted_additional_options',
  			[
  				'label' => esc_html__( 'Additional Options', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_gallery_fullscreen',
			[
				'label' => esc_html__( 'FullScreen', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => esc_html__( 'Fullscreen', 'boosted-elements-progression' ),
					'native' => esc_html__( 'Native FullScreen', 'boosted-elements-progression' ),
					'none' => esc_html__( 'No FullScreen', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_gallery_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'boosted_post_list_autplay_duration',
			[
				'label' => esc_html__( 'Autoplay Duration', 'boosted-elements-progression' ),
				'description' => esc_html__( 'In milliseconds', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '100',
				'default' => '3000',
				'condition' => [
					'boosted_elements_gallery_autoplay!' => '',
				],
			]
		);
		
		
		
		
		$this->add_control(
			'boosted_elements_gallery_captions',
			[
				'label' => esc_html__( 'Image Captions', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'boosted_elements_gallery_hash',
			[
				'label' => esc_html__( 'URL Hash', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_shuffle',
			[
				'label' => esc_html__( 'Shuffle Images', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_keyboard',
			[
				'label' => esc_html__( 'Keyboard Navigation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_clitcktransition',
			[
				'label' => esc_html__( 'Click to switch slides', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		
		$this->add_control(
			'boosted_elements_gallery_loop',
			[
				'label' => esc_html__( 'Loop Slides', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_main_image_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'boosted_elements_main_image_content_align',
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
					'{{WRAPPER}} .fotorama__wrap' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-left:0px; margin-right:auto;',
					'center' =>  'margin-left:auto; margin-right:auto;',
					'right' => 'margin-left:auto; margin-right:0px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_percentage_option',
			[
				'label' => esc_html__( 'Dimensions', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'percentage',
				'options' => [
					'pixels' => esc_html__( 'Pixels', 'boosted-elements-progression' ),
					'percentage' => esc_html__( 'Percentage', 'boosted-elements-progression' ),
				],
			]
		);
		
  		
		
  		$this->add_control(
  			'boosted_elements_main_width_pixel',
  			[
  				'label' => esc_html__( 'Width in pixels', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
				],
				'condition' => [
					'boosted_elements_gallery_percentage_option' => 'pixels',
				],
  			]
  		);
		
		
  		$this->add_control(
  			'boosted_elements_main_height_pixel',
  			[
  				'label' => esc_html__( 'Height in pixels', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 600,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
				],
				'condition' => [
					'boosted_elements_gallery_percentage_option' => 'pixels',
				],
  			]
  		);

		
  		$this->add_control(
  			'boosted_elements_main_width_percentage',
  			[
  				'label' => esc_html__( 'Width in percent', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'condition' => [
					'boosted_elements_gallery_percentage_option' => 'percentage',
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_elements_main_height_percentage',
  			[
  				'label' => esc_html__( 'Height in percent', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'condition' => [
					'boosted_elements_gallery_percentage_option' => 'percentage',
				],
  			]
  		);

		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_thumbnail_styles',
			[
				'label' => esc_html__( 'Thumbnail Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
			]
		);
		
  		$this->add_control(
  			'boosted_elements_thumb_border_radius',
  			[
  				'label' => esc_html__( 'Thumbnail Radius', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__thumb-border' => 'border-radius:{{SIZE}}px;',
					'{{WRAPPER}} .fotorama__thumb' => 'border-radius:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
		
		$this->add_control(
			'boosted_thumbnail_border_color',
			[
				'label' => esc_html__( 'Thumbnail Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__thumb-border, .fotorama--fullscreen .fotorama__thumb-border' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
			]
		);
		
		$this->add_control(
			'boosted_thumbnail_background_color',
			[
				'label' => esc_html__( 'Overlay Thumb Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__thumb-border, .fotorama--fullscreen .fotorama__thumb-border' => 'background: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
			]
		);
		
		
  		$this->add_control(
  			'boosted_elements_thumb_width',
  			[
  				'label' => esc_html__( 'Thumbnail Width', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 800,
					],
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_elements_thumb_height',
  			[
  				'label' => esc_html__( 'Thumbnail Height', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 800,
					],
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_elements_thumb_margin',
  			[
  				'label' => esc_html__( 'Thumbnail Margin', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_elements_thumb_margin_top',
  			[
  				'label' => esc_html__( 'Thumbnail Vertical Adjustment', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__nav-wrap' => 'margin-top:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_elements_thumb_border',
  			[
  				'label' => esc_html__( 'Thumbnail Border', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'condition' => [
					'boosted_elements_gallery_navigation' => 'thumbs',
				],
  			]
  		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_caption_styles',
			[
				'label' => esc_html__( 'Caption Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_elements_gallery_captions!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_main_caption_align',
			[
				'label' => esc_html__( 'Caption Align', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-progression-image-slideshow-container' => 'text-align:{{VALUE}};',
				],
				'condition' => [
					'boosted_elements_gallery_captions!' => '',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_main_caption_padding',
			[
				'label' => esc_html__( 'Caption Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .fotorama__caption__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'boosted_elements_gallery_captions!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_main_caption_color',
			[
				'label' => esc_html__( 'Caption Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__caption' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_gallery_captions!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_main_caption_border_color',
			[
				'label' => esc_html__( 'Caption Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__caption__wrap' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_gallery_captions!' => '',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'caption_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .fotorama__caption',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_bullet_dots_styles',
			[
				'label' => esc_html__( 'Dot Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_elements_gallery_navigation' => 'dots',
				],
			]
		);
		
		
  		$this->add_control(
  			'section_bullet_dots_vertical_position',
  			[
  				'label' => esc_html__( 'Dot Vertical Position', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama--fullscreen .fotorama__dot' => 'top:{{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-dot-navigation .fotorama__dot' => 'top:{{SIZE}}px;',
				],
  			]
  		);
		
		$this->add_control(
			'section_bullet_dots_styles_text_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama--fullscreen .fotorama__dot' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-dot-navigation .fotorama__dot' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .fotorama--fullscreen .fotorama__nav__frame--dot.fotorama__active .fotorama__dot' => 'border-color: {{VALUE}}; background: {{VALUE}};',
					'{{WRAPPER}} .boosted-elements-dot-navigation .fotorama__nav__frame--dot.fotorama__active .fotorama__dot' => 'border-color: {{VALUE}}; background: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_arrow_styles',
			[
				'label' => esc_html__( 'Arrow Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_elements_gallery_arrows!' => '',
				],
			]
		);
		
  		$this->add_control(
  			'section_arrow_styles_font_size',
  			[
  				'label' => esc_html__( 'Arrow Size', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'font-size:{{SIZE}}px;',
					'{{WRAPPER}} .fotorama__arr--next' => 'font-size:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_arrows!' => '',
				],
  			]
  		);
		
  		$this->add_control(
  			'section_arrow_styles_width',
  			[
  				'label' => esc_html__( 'Arrow Width', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'width:{{SIZE}}px;',
					'{{WRAPPER}} .fotorama__arr--next' => 'width:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_arrows!' => '',
				],
  			]
  		);
		
  		$this->add_control(
  			'section_arrow_styles_height',
  			[
  				'label' => esc_html__( 'Arrow Height', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'height:{{SIZE}}px; line-height:{{SIZE}}px;',
					'{{WRAPPER}} .fotorama__arr--next' => 'height:{{SIZE}}px; line-height:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_arrows!' => '',
				],
  			]
  		);
		
		
  		$this->add_control(
  			'section_arrow_styles_vertical_align',
  			[
  				'label' => esc_html__( 'Vertical Align', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'margin-top:{{SIZE}}px;',
					'{{WRAPPER}} .fotorama__arr--next' => 'margin-top:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_elements_gallery_arrows!' => '',
				],
  			]
  		);
		
		$this->start_controls_tabs( 'boosted_elements_arrow_styles_tabs' );

		$this->start_controls_tab( 'normal_arrow_styles_style', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_arrow_styles_text_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fotorama__arr--next' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_arrow_styles_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev' => 'background: {{VALUE}};',
					'{{WRAPPER}} .fotorama__arr--next' => 'background: {{VALUE}};',
				],
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'hover_arrow_styles_style', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_arrow_styles_hover_text_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fotorama__arr--next:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_arrow_styles_hover_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fotorama__arr--prev:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .fotorama__arr--next:hover' => 'background: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		

		$this->end_controls_section();
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
		if ( empty( $settings['boosted_elements_image_gallery'] ) ) {
			return;
		}

	?>
	

	
	
	
	<div class="boosted-elements-progression-image-slideshow-container <?php if ( $settings['boosted_elements_gallery_navigation'] == 'dots' ) : ?>boosted-elements-dot-navigation<?php endif; ?>">
		<div class="boosted-elements-fotorama-<?php echo esc_attr($this->get_id()); ?>" data-nav="<?php echo esc_attr($settings['boosted_elements_gallery_navigation'] ); ?>" data-fit="<?php echo esc_attr($settings['boosted_elements_gallery_fit'] ); ?>" data-transition="<?php echo esc_attr($settings['boosted_elements_gallery_transition'] ); ?>" <?php if ( $settings['boosted_elements_gallery_fullscreen'] != 'none' ) : ?>data-allowfullscreen="<?php echo esc_attr($settings['boosted_elements_gallery_fullscreen'] ); ?>"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_gallery_hash'] ) ) : ?>data-hash="true"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_gallery_autoplay'] ) ) : ?>data-autoplay="<?php echo esc_attr($settings['boosted_post_list_autplay_duration'] ); ?>"<?php endif; ?> data-transitionduration="<?php echo esc_attr($settings['boosted_post_list_transition_duration'] ); ?>" <?php if ( ! empty( $settings['boosted_elements_gallery_keyboard'] ) ) : ?> data-keyboard="true"<?php endif; ?><?php if ( ! empty( $settings['boosted_elements_gallery_shuffle'] ) ) : ?> data-shuffle="true"<?php endif; ?><?php if ( ! empty( $settings['boosted_elements_gallery_arrows'] ) ) : ?> data-arrows="true"<?php endif; ?><?php if ( empty( $settings['boosted_elements_gallery_clitcktransition'] ) ) : ?> data-click="false"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_gallery_loop'] ) ) : ?> data-loop="true"<?php endif; ?> data-thumbwidth="<?php echo esc_attr($settings['boosted_elements_thumb_width']['size'] ); ?>" data-thumbheight="<?php echo esc_attr($settings['boosted_elements_thumb_height']['size'] ); ?>" data-thumbmargin="<?php echo esc_attr($settings['boosted_elements_thumb_margin']['size'] ); ?>" data-thumbborderwidth="<?php echo esc_attr($settings['boosted_elements_thumb_border']['size'] ); ?>" <?php if ( $settings['boosted_elements_gallery_percentage_option'] == 'percentage' ) : ?> data-width="<?php echo esc_attr($settings['boosted_elements_main_width_percentage']['size'] ); ?>%" data-height="<?php echo esc_attr($settings['boosted_elements_main_height_percentage']['size'] ); ?>%" <?php else: ?> data-width="<?php echo esc_attr($settings['boosted_elements_main_width_pixel']['size'] ); ?>" data-height="<?php echo esc_attr($settings['boosted_elements_main_height_pixel']['size'] ); ?>"<?php endif; ?>>
			<?php if ( ! empty( $settings['boosted_elements_gallery_videos'] ) ) : ?>
			<?php foreach ( $settings['boosted_elements_gallery_videos'] as $item ) : ?>
				<?php if ( ! empty( $item['boosted_elements_video_url'] ) ) : ?>
					<a href="<?php echo esc_attr($item['boosted_elements_video_url'] ); ?>"><?php echo esc_attr($item['boosted_elements_video_url'] ); ?></a>
				<?php endif; ?>	
			<?php endforeach; ?>
			<?php endif; ?>
			<?php  $pro_images_gallery = $this->get_settings( 'boosted_elements_image_gallery' ); foreach ( $pro_images_gallery as $image ) : ?>
				<?php $image_thumbnail = wp_get_attachment_image_src($image['id'], 'thumb'); ?>
				<?php  $image_main_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
				<a href="<?php echo esc_attr($image_main_url);?>" data-thumb="<?php echo esc_attr($image_thumbnail[0]);?>" <?php if ( ! empty( $settings['boosted_elements_gallery_captions'] ) ) : ?><?php $get_description = get_post($image['id'])->post_excerpt; if(!empty($get_description)){  echo 'data-caption="' . esc_attr($get_description) . '"'; }  ?><?php endif; ?>></a>
			<?php endforeach; ?>
			
			<div class="clearfix-boosted-element"></div>
		</div>
	</div><!-- close .boosted-elements-progression-image-slideshow-container -->
	
	<script type="text/javascript"> 
		
	jQuery(document).ready(function($) {
		'use strict';
		setTimeout(function(){
		$('.boosted-elements-fotorama-<?php echo esc_attr($this->get_id()); ?>').fotorama();
		}, 10);
	});
	</script>
	
	<div class="clearfix-boosted-element"></div>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsImage_Slideshow() );