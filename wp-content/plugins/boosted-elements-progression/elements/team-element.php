<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsTeam_Member extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-person boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	

	
	protected function register_controls() {

		
  		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Main Content', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_team_title_text',
			[
				'label' => esc_html__( 'Name', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_team_title_text', 'none' );
		
		$this->add_control(
			'boosted_elements_team_job_title_text',
			[
				'label' => esc_html__( 'Job Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Senior Engineer', 'boosted-elements-progression' ),
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_team_job_title_text', 'none' );
		
		
		$this->add_control(
			'boosted_elements_team_sub_title_description',
			[
				'label' => esc_html__( 'Description', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Easily add or remove any text for your Team Member!', 'boosted-elements-progression' ),
			]
		);
		$this->add_inline_editing_attributes( 'boosted_elements_team_sub_title_description', 'none' );
		
		$this->add_control(
			'boosted_elements_team_button',
			[
				'label' => esc_html__( 'Button', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'boosted_elements_team_button_icon',
			[
				'label' => esc_html__( 'Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'boosted_elements_team_button!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_team_button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'boosted-elements-progression' ),
					'right' => esc_html__( 'After', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_team_button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'boosted_elements_team_button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'boosted_elements_team_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .open-team-member-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .open-team-member-button-icon-left' => 'margin-right: {{SIZE}}px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_team_link',
			[
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://progressionstudios.com',
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
			]
		);

		$this->end_controls_section();
			
  		$this->start_controls_section(
  			'section_title_boosted_image_options',
  			[
  				'label' => esc_html__( 'Image Options', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_team_image',
			[
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'boosted_elements_team_image[url]!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_image_align',
			[
				'label' => esc_html__( 'Image Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_elements_image_align_top' => esc_html__( 'Top', 'boosted-elements-progression' ),
					'boosted_elements_image_align_left' => esc_html__( 'Left', 'boosted-elements-progression' ),
					'boosted_elements_image_align_right' => esc_html__( 'Right', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_elements_team_image[url]!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_social_icon_overlay',
			[
				'label' => esc_html__( 'Overlay Content', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'boosted_elements_icon_default' => esc_html__( 'No Overlay', 'boosted-elements-progression' ),
					'boosted_elements_icon_overlay_image' => esc_html__( 'Overlay Icons', 'boosted-elements-progression' ),
					'boosted_elements_content_overlay_image' => esc_html__( 'Overlay All Content', 'boosted-elements-progression' ),
				],
				'default' => 'boosted_elements_icon_default',
				'condition' => [
					'boosted_elements_social_show_hide!' => '',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_icon_overlay_background',
			[
				'label' => esc_html__( 'Overlay Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => "#cccccc",
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-team-image .boosted-elements-content-container-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_social_icon_overlay!' => 'boosted_elements_icon_default',
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
				'default' => 'yes',
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
				'label' => esc_html__( 'Social Icons', 'boosted-elements-progression' ),
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
			'section_team_main_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_elements_team_main_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => "#ffffff",
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-team-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_team_padding',
			[
				'label' => esc_html__( 'Content Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_team_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_team_border',
				'selector' => '{{WRAPPER}}  .boosted-elements-progression-team-member-container',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_team_image_styles',
			[
				'label' => esc_html__( 'Image Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'boosted_team_image_align',
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
					'{{WRAPPER}} .boosted-elements-team-image' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'boosted_team_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-team-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_team_image_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-team-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_image_border_team_member',
				'selector' => '{{WRAPPER}} .boosted-elements-team-image',
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boosted_iamge_teaeM_box_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-team-image',
			]
		);
		
        
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_team_text_styles',
			[
				'label' => esc_html__( 'Content Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		$this->add_control(
			'boosted_team_title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Name', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_control(
			'boosted_elements_team_title_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h4.boosted-elements-team-heading' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_team_title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h4.boosted-elements-team-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_team_title_align',
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h4.boosted-elements-team-heading' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_team_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container h4.boosted-elements-team-heading',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'heading_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container h4.boosted-elements-team-heading',
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_team_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Job Position', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_elements_team_job_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h5.boosted-elements-team-job-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_team_job_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h5.boosted-elements-team-job-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_team_job_align',
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container h5.boosted-elements-team-job-title' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_team_job_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container h5.boosted-elements-team-job-title',
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_team_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description Styles', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_elements_team_description_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-team-description' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_team_description_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-team-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_team_description_align',
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-team-description' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_elements_team_description_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-team-description',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_team_button_styles',
			[
				'label' => esc_html__( 'Button Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_button_spacing',
			[
				'label' => esc_html__( 'Spacing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -15,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_button_alignment',
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
					'{{WRAPPER}} .boosted-elements-button-align' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_flip_box_rear_button_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_flip_box_rear_btn_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button',
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_rear_btn_border',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button',
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
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'btn_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-progression-team-member-container .boosted-elements-button',
			]
		);
		
		
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
					'{{WRAPPER}} .boosted-elements-icons-container a' => 'font-size:{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-icons-container a' => 'line-height:{{SIZE}}{{UNIT}}; min-width:{{SIZE}}{{UNIT}}; min-height:{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-icons-container a' => 'margin:0px {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .boosted-elements-icons-container' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .boosted-elements-icons-container a' => 'color: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_social_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icons-container a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_icon_border',
				'selector' => '{{WRAPPER}} .boosted-elements-icons-container a',
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
					'{{WRAPPER}} .boosted-elements-icons-container a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_social_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icons-container a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'boosted_elements_social_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-icons-container a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		
		
		$this->end_controls_section();
		
		
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
	?>
	
	

	<div class="boosted-elements-progression-team-member-container <?php echo esc_attr($settings['boosted_elements_image_align'] ); ?>">	
		
	 <?php if ( ! empty( $settings['boosted_elements_team_image']['url'] ) ) : ?>
		<?php $image = $settings['boosted_elements_team_image'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
		<div class="boosted-elements-team-image"><div class="boosted-elements-team-image-border-shadow"><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_team_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_team_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_team_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr($settings['boosted_elements_team_title_text'] ); ?>"><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?></a><?php endif; ?></div>
		
		<?php if ( ! empty( $settings['boosted_elements_social_show_hide'] ) && $settings['boosted_elements_social_icon_overlay'] == "boosted_elements_icon_overlay_image"  ) : ?>
		<div class="boosted-elements-content-container-overlay">
			<div class="boosted-elements-overlay-table">
				<div class="boosted-elements-overlay-table-cell">
					<div class="boosted-elements-icons-container">
					
					<?php foreach ( $settings['boosted_elements_social_icon_list'] as $item ) : ?>
						<?php if ( ! empty( $item['social'] ) ) : ?>
							<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
							<a class="boosted-elements-team-social" href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?> <?php if ( ! empty( $item['link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php \Elementor\Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] ); ?></a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				</div>
			</div>
		</div><!-- close .boosted-elements-icons-container -->
		<?php endif; ?>
		
		<?php if ( $settings['boosted_elements_social_icon_overlay'] == "boosted_elements_content_overlay_image"  ) : ?>
		<div class="boosted-elements-content-container-overlay">
			<div class="boosted-elements-overlay-table">
				<div class="boosted-elements-overlay-table-cell">
					
					<div class="boosted-elements-team-content">
						<?php if ( ! empty( $settings['boosted_elements_team_title_text'] ) ) : ?>
							<?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_team_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_team_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?><h4 class="boosted-elements-team-heading"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_team_title_text' ) . '>' . $this->get_settings( 'boosted_elements_team_title_text' ) . '</span>';?></h4><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?></a><?php endif; ?>
						<?php endif; ?>
						<?php if ( ! empty( $settings['boosted_elements_team_job_title_text'] ) ) : ?>
							<h5 class="boosted-elements-team-job-title"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_team_job_title_text' ) . '>' . $this->get_settings( 'boosted_elements_team_job_title_text' ) . '</span>';?></h5>
						<?php endif; ?>
						<?php if ( ! empty( $settings['boosted_elements_team_sub_title_description'] ) ) : ?>
							<div class="boosted-elements-team-description">
								<?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_team_sub_title_description' ) . '>' . $this->get_settings( 'boosted_elements_team_sub_title_description' ) . '</div>';?></div>
						<?php endif; ?>
		
		
						<?php if ( ! empty( $settings['boosted_elements_team_button'] ) ) : ?>
							<div class="boosted-elements-button-align"><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_team_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_team_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?><div class="boosted-elements-button">
								<?php if ( ! empty( $settings['boosted_elements_team_button_icon'] ) && $settings['boosted_elements_team_button_icon_align'] == 'left' ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_team_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-team-member-button-icon-left' ] ); ?>
								<?php endif; ?>
								<?php echo esc_attr($settings['boosted_elements_team_button'] ); ?>
								<?php if ( ! empty( $settings['boosted_elements_team_button_icon'] ) && $settings['boosted_elements_team_button_icon_align'] == 'right' ) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_team_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-team-member-button-icon-right' ] ); ?> 
								<?php endif; ?>
							</div><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?></a><?php endif; ?></div>
						<?php endif; ?>
		
		
		
						<?php if ( ! empty( $settings['boosted_elements_social_show_hide'] ) ): ?>
						<div class="boosted-elements-icons-container">
							<?php foreach ( $settings['boosted_elements_social_icon_list'] as $item ) : ?>
								<?php if ( ! empty( $item['social'] ) ) : ?>
									<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>									
									<a class="boosted-elements-team-social" href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?>><?php \Elementor\Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true'] ); ?></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div><!-- close .boosted-elements-icons-container -->
						<?php endif; ?>
		
						<div class="clearfix-boosted-element"></div>
		
					</div>
					
				</div>
			</div>
		</div><!-- close .boosted-elements-icons-container -->
		<?php endif; ?>
		
		</div>
	 <?php endif; ?>		
	 
	 
	 <?php if ( $settings['boosted_elements_social_icon_overlay'] != "boosted_elements_content_overlay_image"  ) : ?>
	<div class="boosted-elements-team-content">
		<?php if ( ! empty( $settings['boosted_elements_team_title_text'] ) ) : ?>
			<?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_team_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_team_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?><h4 class="boosted-elements-team-heading"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_team_title_text' ) . '>' . $this->get_settings( 'boosted_elements_team_title_text' ) . '</span>';?></h4><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?></a><?php endif; ?>
		<?php endif; ?>
		<?php if ( ! empty( $settings['boosted_elements_team_job_title_text'] ) ) : ?>
			<h5 class="boosted-elements-team-job-title"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_team_job_title_text' ) . '>' . $this->get_settings( 'boosted_elements_team_job_title_text' ) . '</span>';?></h5>
		<?php endif; ?>
		<?php if ( ! empty( $settings['boosted_elements_team_sub_title_description'] ) ) : ?>
			<div class="boosted-elements-team-description"><?php echo '<div ' . $this->get_render_attribute_string( 'boosted_elements_team_sub_title_description' ) . '>' . $this->get_settings( 'boosted_elements_team_sub_title_description' ) . '</div>';?></div>
		<?php endif; ?>
		
		
		<?php if ( ! empty( $settings['boosted_elements_team_button'] ) ) : ?>
			<div class="boosted-elements-button-align"><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?><a href="<?php echo esc_url($settings['boosted_elements_team_link']['url']); ?>" <?php if ( ! empty( $settings['boosted_elements_team_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?>><?php endif; ?><div class="boosted-elements-button">
				<?php if ( ! empty( $settings['boosted_elements_team_button_icon'] ) && $settings['boosted_elements_team_button_icon_align'] == 'left' ) : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_team_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-team-member-button-icon-left' ] ); ?>
				<?php endif; ?>
				<?php echo esc_attr($settings['boosted_elements_team_button'] ); ?>
				<?php if ( ! empty( $settings['boosted_elements_team_button_icon'] ) && $settings['boosted_elements_team_button_icon_align'] == 'right' ) : ?>
					<?php \Elementor\Icons_Manager::render_icon( $settings['boosted_elements_team_button_icon'], [ 'aria-hidden' => 'true', 'class' => 'open-team-member-button-icon-right' ] ); ?>
					
				<?php endif; ?>
			
			</div><?php if ( ! empty( $settings['boosted_elements_team_link']['url'] ) ) : ?></a><?php endif; ?></div>
		<?php endif; ?>
		
		
		
		<?php if ( ! empty( $settings['boosted_elements_social_show_hide'] ) && $settings['boosted_elements_social_icon_overlay'] == "boosted_elements_icon_default"  ) : ?>
		<div class="boosted-elements-icons-container">
			<?php foreach ( $settings['boosted_elements_social_icon_list'] as $item ) : ?>
				<?php if ( ! empty( $item['social'] ) ) : ?>
					<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
					<a class="boosted-elements-team-social" href="<?php echo esc_attr( $item['link']['url'] ); ?>"<?php echo $target; ?> <?php if ( ! empty( $item['link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php \Elementor\Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true'] ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div><!-- close .boosted-elements-icons-container -->
		<?php endif; ?>
		
		<div class="clearfix-boosted-element"></div>
		
	</div>
	<?php endif; ?>
	
	<div class="clearfix-boosted-element"></div>
	
	</div><!-- close .boosted-elements-progression-team-member-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsTeam_Member() );