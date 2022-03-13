<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsPopUp extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-popup-modal';
	}

	public function get_title() {
		return esc_html__( 'PopUp Modal - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-lightbox boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_popup_js' ]; 
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Popup Content', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_modal_open',
			[
				'label' => esc_html__( 'Popup visible outside of page builder only', 'boosted-elements-progression' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		

		$this->add_control(
			'boosted_elements_page_selection',
			[
				'label' => esc_html__( 'Display Elementor Template in modal?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'boosted_elements_page_list',
			[
				'label' => esc_html__( 'Choose a Elementor Template for your Popup Modal', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => boosted_page_list_selection(),
				'condition' => [
					'boosted_elements_page_selection' => 'yes',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_modal_title',
			[
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Popup Modal Heading', 'boosted-elements-progression' ),
				'render_type' => 'none',
				'condition' => [
					'boosted_elements_page_selection!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_sub_title',
			[
				'label' => esc_html__( 'Sub-Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'render_type' => 'none',
				'condition' => [
					'boosted_elements_page_selection!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_content',
			[
				'placeholder' => esc_html__( 'Content', 'boosted-elements-progression' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Easily add or remove any text on your popup!', 'boosted-elements-progression' ),
				'render_type' => 'none',
				'condition' => [
					'boosted_elements_page_selection!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_content_btn',
			[
				'label' => esc_html__( 'Button Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'condition' => [
					'boosted_elements_page_selection!' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_content_btn_link',
			[
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
				'condition' => [
					'boosted_elements_modal_content_btn!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_content_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'boosted_elements_modal_content_btn!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_modal_content_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_modal_content_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_modal_content_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_modal_content_icon!' => '',
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .content-pop-up-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'#boosted-elements-popup-{{ID}} .content-pop-up-button-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_social_icon_options',
  			[
  				'label' => esc_html__( 'Social Icons', 'boosted-elements-progression' )
  			]
  		);

		$this->add_control(
			'boosted_elements_social_show_hide',
			[
				'label' => esc_html__( 'Display Social Icons?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'social',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'facebook-f',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'stumbleupon',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
					'is_external' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'http://progressionstudios.com', 'boosted-elements-progression' ),
			]
		);
		
		
		$this->add_control(
			'boosted_elements_social_icon_list',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'boosted_elements_social_show_hide!' => '',
				],
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social' => [
							'value' => 'fab fa-linkedin',
							'library' => 'fa-brands',
						],
					],
					[
						'social' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<i class="fab fa-{{{ elementor.helpers.getSocialNetworkNameFromIcon( social ) }}}"></i> - {{{ elementor.helpers.getSocialNetworkNameFromIcon( social ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
			]
		);
		
		
		
		$this->end_controls_section();
		
  		$this->start_controls_section(
  			'section_title_boosted_modal_display',
  			[
  				'label' => esc_html__( 'Popup Settings', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_modal_open_second_section',
			[
				'label' => esc_html__( 'Popup visible outside of page builder only', 'boosted-elements-progression' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_delay_opening',
			[
				'label' => esc_html__( 'Delay on Open', 'boosted-elements-progression' ),
				'description' => esc_html__( 'In Milliseconds', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
				'render_type' => 'none',
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_scrollock',
			[
				'label' => esc_html__( 'Scroll Lock', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Disable scrolling of background content while the popup is visible.', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'Lock Scrolling', 'boosted-elements-progression' ),
					'false' => esc_html__( 'Allow Scrolling', 'boosted-elements-progression' ),
				],
				'default' => 'false',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_popup_automatic',
			[
				'label' => esc_html__( 'Auto Open?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'Open on page load', 'boosted-elements-progression' ),
					'false' => esc_html__( 'Open on button click', 'boosted-elements-progression' ),
					'image' => esc_html__( 'Open on image click', 'boosted-elements-progression' ),
				],
				'default' => 'true',
			]
		);
		

		
		$this->add_control(
			'boosted_elements_popup_image',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_popup_automatic' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'boosted_elements_popup_automatic' => 'image',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_pop_up_default_alignment',
			[
				'label' => esc_html__( 'Align', 'boosted-elements-progression' ),
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pop-up-align-image' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'image',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_popup_expire',
			[
				'label' => esc_html__( 'Popup Expiration', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Reload on every page load', 'boosted-elements-progression' ),
					'cookie_day' => esc_html__( 'Set cookie by days', 'boosted-elements-progression' ),
					'cookie_minute' => esc_html__( 'Set cookie by minutes', 'boosted-elements-progression' ),
				],
				'render_type' => 'none',
				'default' => 'default',
				'condition' => [
					'boosted_elements_popup_automatic' => 'true',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_expire_time',
			[
				'label' => esc_html__( 'Expiration Time', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '1',
				'render_type' => 'none',
				'condition' => [
					'boosted_elements_popup_expire!' => 'default',
				],
			]
		);


		$this->add_control(
			'boosted_elements_modal_open_btn',
			[
				'label' => esc_html__( 'Button Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click to open', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Use this button to open the popup modal manually', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_modal_open_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);

		$this->add_control(
			'boosted_elements_modal_open_btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_modal_open_btn_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_modal_open_btn_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_modal_open_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .open-pop-up-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .open-pop-up-button-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		
		
		$this->add_responsive_control(
			'boosted_button_default_alignment',
			[
				'label' => esc_html__( 'Align', 'boosted-elements-progression' ),
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-button-align.boosted-elements-pop-up-align-btn' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_popup_default_button_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_default_border_radius',
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
					'{{WRAPPER}} .boosted-elements-open-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_popup_default_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-open-btn',
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->start_controls_tabs( 'boosted_elements_default_content_tabs' );

		$this->start_controls_tab( 'normal_default_content', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ), 'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				], ] );

		$this->add_control(
			'boosted_elements_default_content_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_default_content_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_default_content_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-open-btn',
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_default_btn_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ), 'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				], ] );

		$this->add_control(
			'boosted_elements_popup_default_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);

		$this->add_control(
			'boosted_elements_popup_default_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);

		$this->add_control(
			'boosted_elements_popup_default_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-open-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_popup_automatic' => 'false',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_content_main_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_elements_popup_transition',
			[
				'label' => esc_html__( 'Popup Transition', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Fade', 'boosted-elements-progression' ),
					'boosted_fade_and_scale' => esc_html__( 'Scale', 'boosted-elements-progression' ),
					'boosted_popup_slide' => esc_html__( 'Slide Down', 'boosted-elements-progression' ),
					'boosted_popup_slide_up' => esc_html__( 'Slide Up', 'boosted-elements-progression' ),
					'boosted_popup_slide_left' => esc_html__( 'Slide Left', 'boosted-elements-progression' ),
					'boosted_popup_slide_right' => esc_html__( 'Slide Right', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_position',
			[
				'label' => esc_html__( 'Popup Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'center' => esc_html__( 'Center', 'boosted-elements-progression' ),
					'top' => esc_html__( 'Top', 'boosted-elements-progression' ),
					'bottom' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
				],
			]
		);
		
		
  		$this->add_responsive_control(
  			'boosted_elements_popup_content_width',
  			[
  				'label' => esc_html__( 'Content Width', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 600,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1200,
					],
					'em' => [
						'min' => 10,
						'max' => 90,
					],
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-progression-popup-container' => 'width:{{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
  			]
  		);
		
		$this->add_control(
			'boosted_elements_popup_border_radius',
			[
				'label' => esc_html__( 'Content Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-progression-popup-container' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		

		$this->add_control(
			'boosted_flip_box_front_title_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Popup Content Background', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_popup_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-progression-popup-container',
			]
		);
		
  		
		
		
		
		$this->add_control(
			'section_lightbox_main_background',
			[
				'label' => esc_html__( 'Lightbox Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				
				'default' => "rgba(0, 0, 0, 0.8)",
				'selectors' => [
					'#boosted-elements-popup-{{ID}}_background.popup_background' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		
		

		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_header_popup_styles',
			[
				'label' => esc_html__( 'Header Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		$this->add_control(
			'section_header_background',
			[
				'label' => esc_html__( 'Header Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-header' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_popup_header_border',
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-header',
			]
		);
		
		$this->add_responsive_control(
			'boosted_popup_header_padding',
			[
				'label' => esc_html__( 'Header Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_popup_header_color',
			[
				'label' => esc_html__( 'Header Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-header h2.boosted-elements-popup-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_popup_header_typo',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-header h2.boosted-elements-popup-title',
			]
		);
		
		
		$this->add_control(
			'boosted_popup_header_subtitle_color',
			[
				'label' => esc_html__( 'Sub-title Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-header h3.boosted-elements-popup-sub-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_popup_header_subtitle_typo',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-header h3.boosted-elements-popup-sub-title',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_content_popup_styles',
			[
				'label' => esc_html__( 'Content Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		$this->add_control(
			'boosted_content_background',
			[
				'label' => esc_html__( 'Content Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_popup_body_border',
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-content',
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_content_background_padding',
			[
				'label' => esc_html__( 'Content Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_content_text_color',
			[
				'label' => esc_html__( 'Content Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_content_text_typo',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-content',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_popup_content_button_styles',
			[
				'label' => esc_html__( 'Content Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_content_button_margin_bottom',
			[
				'label' => esc_html__( 'Button Margin Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_button_popup_content_alignment',
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
				'default' => 'left',
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-button-align' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_popup_content_button_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_content_border_radius',
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
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_popup_content_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn',
			]
		);
		
		$this->start_controls_tabs( 'boosted_elements_button_content_tabs' );

		$this->start_controls_tab( 'normal_popup_content', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_popup_content_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_popup_content_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_popup_content_btn_border',
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn',
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_content_btn_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_popup_content_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_popup_content_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_popup_content_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-popup-content .boosted-elements-content-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		

		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_content_close_styles',
			[
				'label' => esc_html__( 'Close Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_close_button_font_size',
			[
				'label' => esc_html__( 'Close Icon Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 80,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-close-btn' => 'font-size: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_close_button_size',
			[
				'label' => esc_html__( 'Close Button Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 130,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-close-btn' => 'line-height: {{SIZE}}px; width: {{SIZE}}px; height: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_image_close_button_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-close-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_close_button_position',
			[
  				'label' => esc_html__( 'Close Position', 'boosted-elements-progression' ),
				'label_block' => true,
				'separator' => 'after',
				'type' => Controls_Manager::SELECT,				
				'default' => 'top:0px;right:0px;',
				'options' => [
					'top:0px; left:0px;' => esc_html__( 'Top Left', 'boosted-elements-progression' ),
					'top:0px;right:0px;' => esc_html__( 'Top Right', 'boosted-elements-progression' ),
					'bottom:0px; left:0px;' => esc_html__( 'Bottom left', 'boosted-elements-progression' ),
					'bottom:0px; right:0px;' => esc_html__( 'Bottom Right', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-close-btn' => '{{VALUE}};',
				],
				'render_type' => 'template'
			]
		);
		
		$this->start_controls_tabs( 'boosted_elements_popup_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_popup_close_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}}  .boosted-elements-close-btn' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_popup_close_background_color_main',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}}  .boosted-elements-close-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_popup_close_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}}  .boosted-elements-close-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_popup_close_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}}  .boosted-elements-close-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_team_social_icons_styles',
			[
				'label' => esc_html__( 'Social Icon Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		

		$this->add_responsive_control(
			'boosted_elements_social_size',
			[
				'label' => esc_html__( 'Size', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 100,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a' => 'font-size:{{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_social_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a' => 'line-height:{{SIZE}}{{UNIT}}; min-width:{{SIZE}}{{UNIT}}; min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_social_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 100,
					],
				],
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a' => 'margin:0px {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',
				],
			]
		);
		
				
		
		$this->add_responsive_control(
			'boosted_social_icon_alignment',
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
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_icon_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}}  .boosted-elements-icons-container a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		
		$this->start_controls_tabs( 'boosted_elements_social_tabs' );
		
		$this->start_controls_tab( 'normal_social_tab', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_socia_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_social_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_icon_border',
				'selector' => '#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a',
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover_social', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ) ] );

		$this->add_control(
			'boosted_elements_social_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_social_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_social_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'#boosted-elements-popup-{{ID}} .boosted-elements-icons-container a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		
		
		$this->end_controls_section();
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
	?>
	


	<?php if ( ! empty( $settings['boosted_elements_modal_open_btn'] ) && ($settings['boosted_elements_popup_automatic']) == 'false' || ! empty( $settings['boosted_elements_modal_open_btn'] ) && ($settings['boosted_elements_popup_automatic']) == 'image' ) : ?>
		
		<?php if ( ($settings['boosted_elements_popup_automatic']) == 'false'  ) : ?>
		<div class="boosted-elements-button-align boosted-elements-pop-up-align-btn">
		<div class="boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?>_open boosted-elements-open-btn boosted-elements-button">
			<?php if ( ! empty( $settings['boosted_elements_modal_open_btn_icon'] ) && $settings['boosted_elements_modal_open_btn_icon_align'] == 'left' ) : ?>
				<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_modal_open_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-pop-up-button-icon-left' ] ); ?>
			<?php endif; ?>
			<?php echo esc_attr($settings['boosted_elements_modal_open_btn'] ); ?>
			<?php if ( ! empty( $settings['boosted_elements_modal_open_btn_icon'] ) && $settings['boosted_elements_modal_open_btn_icon_align'] == 'right' ) : ?>
				<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_modal_open_btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-pop-up-button-icon-right' ] ); ?>
			<?php endif; ?>
		</div>
		</div><!-- close .boosted-elements-button-align -->
		<?php else: ?>
		<div class="boosted-elements-pop-up-align-image">
		<div class="boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?>_open boosted-elements-pop-up-image">
			<?php if ( ! empty( $settings['boosted_elements_popup_image']['url'] ) ) : ?>
			<?php $image = $settings['boosted_elements_popup_image'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
			<img src="<?php echo esc_url($image_url);?>" alt="Pop-up Image">
			<?php endif; ?>
		</div>
		</div><!-- close .boosted-elements-button-align -->
		<?php endif; ?>
	<?php endif; ?>
	

	<div id="boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-close-modal-in-editor <?php echo esc_attr($settings['boosted_elements_popup_transition'] ); ?>" style="display:none;">
		<div class="boosted-elements-progression-popup-container">			
			<?php if ( ! empty( $settings['boosted_elements_page_selection'] ) ) : ?>
				
				<?php
					$boosted_elements_page_id = $settings['boosted_elements_page_list'];
					$boosted_elements_frontend = new Frontend;
					echo $boosted_elements_frontend->get_builder_content_for_display($boosted_elements_page_id, true);
				?>

			<?php else: ?>
				
			<div class="boosted-elements-popup-header">
				<?php if ( ! empty( $settings['boosted_elements_modal_title'] ) ) : ?>
					<h2 class="boosted-elements-popup-title"><?php echo esc_attr($settings['boosted_elements_modal_title'] ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $settings['boosted_elements_modal_sub_title'] ) ) : ?>
					<h3 class="boosted-elements-popup-sub-title"><?php echo esc_attr($settings['boosted_elements_modal_sub_title'] ); ?></h2>
				<?php endif; ?>
			</div><!-- close .boosted-elements-popup-header -->
				<div class="boosted-elements-popup-content">
					
					<?php echo apply_filters('the_content', ($settings['boosted_elements_modal_content']) ); ?>
					
					<?php if ( ! empty( $settings['boosted_elements_modal_content_btn'] ) ) : ?>
						<div class="boosted-elements-button-align">
							<a href="<?php echo esc_url($settings['boosted_elements_modal_content_btn_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_modal_content_btn_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_modal_content_btn_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>>
						
								<div class="boosted-elements-content-btn boosted-elements-button">
									<?php if ( ! empty( $settings['boosted_elements_modal_content_icon'] ) && $settings['boosted_elements_modal_content_btn_icon_align'] == 'left' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_modal_content_icon'], [ 'aria-hidden' => 'true', 'class' => 'content-pop-up-button-icon-left' ] ); ?>
									<?php endif; ?>
									<?php echo esc_attr($settings['boosted_elements_modal_content_btn'] ); ?>
									<?php if ( ! empty( $settings['boosted_elements_modal_content_icon'] ) && $settings['boosted_elements_modal_content_btn_icon_align'] == 'right' ) : ?>
										<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_modal_content_icon'], [ 'aria-hidden' => 'true', 'class' => 'content-pop-up-button-icon-right' ] ); ?>
									<?php endif; ?>
								</div>
								
							</a>
						</div><!-- close .boosted-elements-button-align -->
					<?php endif; ?>
					
					<?php if ( ! empty( $settings['boosted_elements_social_show_hide'] ) ): ?>
					<div class="boosted-elements-icons-container">
						<?php foreach ( $settings['boosted_elements_social_icon_list'] as $item ) : ?>
							<?php if ( ! empty( $item['social'] ) ) : ?>
								<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
								<a class="boosted-elements-team-social" href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><?php \Elementor\Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] ); ?></a>
							<?php endif; ?>
						<?php endforeach; ?>
					</div><!-- close .boosted-elements-icons-container -->
					<?php endif; ?>
					
					<div class="clearfix-boosted-element"></div></div>
			

			
			<?php endif; ?>
			
			 <div class="boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?>_close boosted-elements-close-btn"><i class="fas fa-times" aria-hidden="true"></i></div>
			
			<div class="clearfix-boosted-element"></div>
				
		</div><!-- close .boosted-elements-progression-popup-container -->
		
	
		
	</div><!-- close #boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?> -->
	
	
	<script type="text/javascript"> 
	jQuery(document).ready(function($) {
		'use strict';
		
		<?php if ( ($settings['boosted_elements_popup_expire']) == 'cookie_day' || ($settings['boosted_elements_popup_expire']) == 'cookie_minute'  ) : ?>
		var date = new Date();
		var minutes = <?php echo esc_attr($settings['boosted_elements_modal_expire_time'] ); ?>;
		date.setTime(date.getTime() + (minutes * 60 * 1000));
		
		if($.cookie('boosted-elements-modal-<?php echo esc_attr($this->get_id()); ?>') == null){
		$.cookie('boosted-elements-modal-<?php echo esc_attr($this->get_id()); ?>', 'yes', {expires : <?php if ( ($settings['boosted_elements_popup_expire']) == 'cookie_minute'  ) : ?>date<?php else: ?><?php echo esc_attr($settings['boosted_elements_modal_expire_time'] ); ?><?php endif; ?>, path: '/' });
		<?php endif; ?>
		
		setTimeout( function() {
		$('#boosted-elements-popup-<?php echo esc_attr($this->get_id()); ?>').popup({ autoopen: <?php if ( ($settings['boosted_elements_popup_automatic']) == 'image'  ) : ?>false<?php else: ?><?php echo esc_attr($settings['boosted_elements_popup_automatic'] ); ?><?php endif; ?>, opacity:1, scrolllock: <?php echo esc_attr($settings['boosted_elements_popup_scrollock'] ); ?>, color: '', transition: 'all 500ms', vertical: '<?php echo esc_attr($settings['boosted_elements_popup_position'] ); ?>'});
		}, <?php echo esc_attr($settings['boosted_elements_modal_delay_opening'] ); ?>);
		<?php if ( ($settings['boosted_elements_popup_expire']) == 'cookie_day' || ($settings['boosted_elements_popup_expire']) == 'cookie_minute'  ) : ?>
		}
		<?php endif; ?>
		
	});
	</script>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsPopUp() );