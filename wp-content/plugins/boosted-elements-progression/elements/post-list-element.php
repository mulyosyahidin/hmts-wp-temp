<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsPostList extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-post-list';
	}

	public function get_title() {
		return esc_html__( 'Post List - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-post-list boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_masonry_js' ]; 
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_settings',
  			[
  				'label' => esc_html__( 'Settings', 'boosted-elements-progression' )
  			]
  		);

		$this->add_control(
			'boosted_post_list_layout',
			[
				'label' => esc_html__( 'Post Layout', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'overlay' => esc_html__( 'Overlay', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_count',
			[
				'label' => esc_html__( 'Post Count', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '12',
			]
		);
		
		$this->add_responsive_control(
			'boosted_post_list_columns',
			[
  				'label' => esc_html__( 'Columns', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,				
				'desktop_default' => '33.330%',
				'mobile_default' => '100%',
				'options' => [
					'100%' => esc_html__( '1 Column', 'boosted-elements-progression' ),
					'50%' => esc_html__( '2 Column', 'boosted-elements-progression' ),
					'33.330%' => esc_html__( '3 Columns', 'boosted-elements-progression' ),
					'25%' => esc_html__( '4 Columns', 'boosted-elements-progression' ),
					'20%' => esc_html__( '5 Columns', 'boosted-elements-progression' ),
					'16.67%' => esc_html__( '6 Columns', 'boosted-elements-progression' ),
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-masonry-column' => 'width: {{VALUE}};',
				],
				'render_type' => 'template'
			]
		);

		$this->add_control(
			'boosted_post_list_masonry',
			[
				'label' => esc_html__( 'Masonry Layout', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_post_list_image_display',
			[
				'label' => esc_html__( 'Show Image', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'medium',
				'condition' => [
					'boosted_post_list_image_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'boosted_post_list_avatar',
			[
				'label' => esc_html__( 'Avatar', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_post_list_title',
			[
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_post_list_excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_post_list_excerpt_count',
			[
				'label' => esc_html__( 'Excerpt Words', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '50',
				'condition' => [
					'boosted_post_list_excerpt' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_meta_data_location',
			[
				'label' => esc_html__( 'Meta Data Location', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'middle',
				'options' => [
					'top' => esc_html__( 'Top', 'boosted-elements-progression' ),
					'middle' => esc_html__( 'Middle', 'boosted-elements-progression' ),
					'bottom' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_post_list_meta_data',
			[
				'label' => esc_html__( 'Meta Data', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'default' => [ 'date', 'categories' ],
				'multiple' => true,
				'options' => [
					'author' => esc_html__( 'Author', 'boosted-elements-progression' ),
					'date' => esc_html__( 'Date', 'boosted-elements-progression' ),
					'categories' => esc_html__( 'Categories', 'boosted-elements-progression' ),
					'comments' => esc_html__( 'Comment Count', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_meta_data_divider',
			[
				'label' => esc_html__( 'Meta Divider', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => '-',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-meta-data li span:after' => 'content: "{{VALUE}}"',
				],
				'condition' => [
					'boosted_post_list_meta_data!' => '',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_read_more',
			[
				'label' => esc_html__( 'Read More', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator' => 'before',
				'default' => 'yes',
				'condition' => [
					'boosted_post_list_layout' => 'default',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_read_more_text',
			[
				'label' => esc_html__( 'Read More Text', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Read More', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
					'boosted_post_list_layout' => 'default',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_overlay_tax',
			[
				'label' => esc_html__( 'Taxonomy Overlay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_overlay_tax_overlay',
			[
				'label' => esc_html__( 'Taxonomy Overlay', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cat',
				'options' => [
					'cat' => esc_html__( 'Category', 'boosted-elements-progression' ),
					'tag' => esc_html__( 'Tag', 'boosted-elements-progression' ),
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
			]
		);
		
		
		
		
		$this->end_controls_section();
		

  		$this->start_controls_section(
  			'section_title_boosted_global_layout',
  			[
  				'label' => esc_html__( 'Post Order', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_post_list_order_by',
			[
				'label' => esc_html__( 'Order By', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Default - Date', 'boosted-elements-progression' ),
					'title' => esc_html__( 'Post Title', 'boosted-elements-progression' ),
					'menu_order' => esc_html__( 'Menu Order', 'boosted-elements-progression' ),
					'modified' => esc_html__( 'Last Modified', 'boosted-elements-progression' ),
					'comment_count' => esc_html__( 'Comment Count', 'boosted-elements-progression' ),
					'rand' => esc_html__( 'Random', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_order_asc_desc',
			[
				'label' => esc_html__( 'Order', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'Ascending', 'boosted-elements-progression' ),
					'DESC' => esc_html__( 'Descending', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_offset_count',
			[
				'label' => esc_html__( 'Offset Count', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '0',
				'default' => '0',
				'description' => esc_html__( 'Use this to skip over posts (Example: 3 would skip the first 3 posts.)', 'boosted-elements-progression' ),
			]
		);
		
		$this->end_controls_section();
		
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_global_query',
  			[
  				'label' => esc_html__( 'Query', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_post_type_control',
			[
				'label' => esc_html__( 'Post Type', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => boosted_elements_post_type_control(),
				'default' => 'post',
			]
		);
		
		
		$this->add_control(
			'boosted_post_type_author',
			[
				'label' => esc_html__( 'Author', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_elements_post_type_author(),
			]
		);
		
		
		$this->add_control(
			'boosted_post_type_categories',
			[
				'label' => esc_html__( 'Categories', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_elements_post_type_categories(),
				'condition' => [
					'boosted_post_type_control' => 'post',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_type_tags',
			[
				'label' => esc_html__( 'Tags', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_elements_post_type_tags(),
				'condition' => [
					'boosted_post_type_control' => 'post',
				],
			]
		);
		
		$post_formats_terms = get_terms( array( 'taxonomy' => 'post_format' ));
		if ( ! empty( $post_formats_terms ) && ! is_wp_error( $post_formats_terms ) ){
			$this->add_control(
				'boosted_post_type_post_formats',
				[
					'label' => esc_html__( 'Post Format', 'boosted-elements-progression' ),
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => boosted_elements_post_type_format(),
					'condition' => [
						'boosted_post_type_control' => 'post',
					],
				]
			);
		}
		
		
		$this->add_control(
			'boosted_post_list_exclude',
			[
				'label' => esc_html__( 'Choose Posts to Exclude', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => boosted_post_list_selection(),
				'condition' => [
					'boosted_post_type_control' => 'post',
				],
			]
		);
		
		
		$this->end_controls_section();
		
  		$this->start_controls_section(
  			'section_title_boosted_global_pagination',
  			[
  				'label' => esc_html__( 'Pagination', 'boosted-elements-progression' )
  			]
  		);
		
		
		$this->add_control(
			'boosted_post_list_pagination',
			[
				'label' => esc_html__( 'Pagination', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'boosted-elements-progression' ),
					'default' => esc_html__( 'Default Pagination', 'boosted-elements-progression' ),
					'infinite' => esc_html__( 'Infinite Loading', 'boosted-elements-progression' ),
					'load-more' => esc_html__( 'Load More Button', 'boosted-elements-progression' ),
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_pagination_prev',
			[
				'label' => esc_html__( 'Previous Label', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => '&lsaquo; Previous',
				'condition' => [
					'boosted_post_list_pagination' => 'default',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_pagination_next',
			[
				'label' => esc_html__( 'Next Label', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Next &rsaquo;',
				'condition' => [
					'boosted_post_list_pagination' => 'default',
				],
			]
		);
		
		/* 
		$this->add_control(
			'boosted_post_list_pagination_no_more_posts',
			[
				'label' => esc_html__( 'No Posts Label', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'No more posts',
				'condition' => [
					'boosted_post_list_pagination' => ['infinite', 'load-more']
				],
			]
		);
		*/
		
		$this->add_control(
			'boosted_post_list_pagination_load_more',
			[
				'label' => esc_html__( 'Load More Label', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Load More',
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_pagination_load_more_icon',
			[
				'type' => Controls_Manager::ICON,
				'label' => esc_html__( 'Icon', 'progression-elements-viseo' ),
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_pagination_load_more_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro span i' => 'padding-left: {{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_pagination_load_more_icon!' => '',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_main_container_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_post_list_content_background',
				'types' => [ 'none', 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-blog-main-styles',
				'condition' => [
					'boosted_post_list_layout' => 'default',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_post_list_overlay_background',
				'types' => [ 'none', 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-blog-overlay-layout .boosted-elements-overlay-positioning',
				'condition' => [
					'boosted_post_list_layout' => 'overlay',
				],
			]
		);
		
		
  		$this->add_responsive_control(
  			'boosted_post_list_margin_left_right',
  			[
  				'label' => esc_html__( 'Margin Left/Right', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-masonry-margins' => 'margin-left:-{{SIZE}}px; margin-right:-{{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-image-masonry-padding' => 'padding-left: {{SIZE}}px; padding-right:{{SIZE}}px;',
				],
				'render_type' => 'template'
  			]
  		);
		
		
		
  		$this->add_responsive_control(
  			'boosted_post_list_margin_bottom',
  			[
  				'label' => esc_html__( 'Margin Bottom', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-masonry-margins' => 'margin-top:-{{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-image-masonry-padding' => 'padding-top:{{SIZE}}px; padding-bottom:{{SIZE}}px;',
				],
				'render_type' => 'template'
  			]
  		);
		
		

		
  		$this->add_control(
  			'boosted_post_list_cotainer_brdr_radius',
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
					'{{WRAPPER}} .boosted-elements-blog-main-styles' => 'border-radius:{{SIZE}}px;',
				],
  			]
  		);
		
		
  		$this->add_responsive_control(
  			'boosted_post_list_overlay_height',
  			[
  				'label' => esc_html__( 'Height', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 350,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 900,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-overlay-layout .boosted-elements-blog-overlay-image' => 'height: {{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_layout' => 'overlay',
				],
				'render_type' => 'template'
  			]
  		);
		
		
		
		$this->add_control(
			'boosted_elements_post_list_vertical_position',
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
				'default' => 'bottom',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-post-list-vertical-align' => '{{VALUE}}',
				],
				'condition' => [
					'boosted_post_list_layout' => 'overlay',
				],
				'selectors_dictionary' => [
					'top' => 'display:block; position:static;',
					'middle' => 'display:table-cell; vertical-align:middle;  position:static;',
					'bottom' => 'position:absolute; bottom:0px; display:block;',
				],

			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_post_list_content_align',
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
					'{{WRAPPER}} .boosted-elements-blog-main-styles' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_post_list_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_pagination_hover_background_overlay',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Hover Background Color', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_post_list_layout' => 'overlay',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'boosted_elements_post_list_overlay_background_hover',
				'types' => [ 'none', 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .boosted-elements-blog-overlay-layout:hover .boosted-elements-overlay-positioning',
				'condition' => [
					'boosted_post_list_layout' => 'overlay',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_post_list_border',
				'selector' => '{{WRAPPER}} .boosted-elements-blog-content-container',
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_main_text_styles',
			[
				'label' => esc_html__( 'Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		
		$this->add_control(
			'boosted_post_list_heading_color',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-blog-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} h3.boosted-elements-blog-title' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_heading_color_hover',
			[
				'label' => esc_html__( 'Title Hover Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-blog-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_heading_spacing',
  			[
  				'label' => esc_html__( 'Title Spacing', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-blog-title' => 'margin-bottom:{{SIZE}}px;',
				],
				'render_type' => 'template'
  			]
  		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_post_list_heading_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.boosted-elements-blog-title',
			]
		);
		
  		
		$this->add_control(
			'boosted_post_list_heading_meta_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Meta Styles', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_meta_color',
			[
				'label' => esc_html__( 'Meta Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data' => 'color: {{VALUE}};',
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data a' => 'color: {{VALUE}};',
				],
				
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_post_list_meta_border_color',
				'selector' => '{{WRAPPER}} ul.boosted-elements-blog-meta-data',
			]
		);
		
	
		
		$this->add_responsive_control(
			'boosted_post_list_meta_spacing',
			[
				'label' => esc_html__( 'Meta Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_post_list_meta_spacing_padding',
			[
				'label' => esc_html__( 'Meta Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_meta_color_sep',
			[
				'label' => esc_html__( 'Separator Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data li.boosted-elements-blog-meta-item span:after' => 'color: {{VALUE}};',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_meta_separator_spacing',
  			[
  				'label' => esc_html__( 'Separator Spacing', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.boosted-elements-blog-meta-data li.boosted-elements-blog-meta-item span:after' => 'padding-right:{{SIZE}}px; padding-left:{{SIZE}}px;',
				],
  			]
  		);
		
  		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_post_list_meta_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ul.boosted-elements-blog-meta-data',
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_heading_excerpt_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Excerpt Styles', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_post_list_excerpt' => 'yes',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_excerpt_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_excerpt' => 'yes',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_excerpt_spacing',
  			[
  				'label' => esc_html__( 'Excerpt Spacing', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-excerpt' => 'margin-bottom:{{SIZE}}px;',
				],
				'render_type' => 'template',
				'condition' => [
					'boosted_post_list_excerpt' => 'yes',
				],
  			]
  		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_post_list_excerpt_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-blog-excerpt',
				'condition' => [
					'boosted_post_list_excerpt' => 'yes',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_heading_read_more_styles',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Read More Styles', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_read_more_color',
			[
				'label' => esc_html__( 'Read More Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.boosted-elements-blog-read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_read_more_color_hover',
			[
				'label' => esc_html__( 'Read More Hover', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.boosted-elements-blog-read-more:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_read_more_spacing',
  			[
  				'label' => esc_html__( 'Read More Spacing', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.boosted-elements-blog-read-more' => 'margin-bottom:{{SIZE}}px;',
				],
				'render_type' => 'template',
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
				],
  			]
  		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_post_list_read_more_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} a.boosted-elements-blog-read-more',
				'condition' => [
					'boosted_post_list_read_more' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_main_image_styles',
			[
				'label' => esc_html__( 'Image Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_post_list_layout' => 'default',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_post_list_image_hover_trasparency',
			[
				'label' => esc_html__( 'Image Hover Transparency', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0,
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);
		
		
		
		$this->add_control(
			'boosted_post_list_image_background',
			[
				'label' => esc_html__( 'Image Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-image' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_image_border_radius',
			[
				'label' => esc_html__( 'Image Border Radius', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-image img' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_main_avatar_tax_styles',
			[
				'label' => esc_html__( 'Taxonomy Overlay Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_post_list_taxonomy_positionn_vertical',
			[
				'label' => esc_html__( 'Vertical', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'top:0px; bottom:auto;',
					'bottom' => 'top:auto; bottom:0px;',
				],

			]
		);
		
		$this->add_control(
			'boosted_elements_post_list_taxonomy_position',
			[
				'label' => esc_html__( 'Horizontal', 'boosted-elements-progression' ),
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
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay' => '{{VALUE}}',
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
				'selectors_dictionary' => [
					'left' => 'left:0px; right:auto;',
					'right' => 'left:auto; right:0px;',
				],

			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_post_list_taxonomy_position_margins',
			[
				'label' => esc_html__( 'Taxonomy Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_elements_post_list_taxonomy_position_spacing',
  			[
  				'label' => esc_html__( 'Taxonomy Spacing', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay a' => 'margin-left:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
  			]
  		);
		
		
		$this->add_control(
			'boosted_post_list_taxonomy_color',
			[
				'label' => esc_html__( 'Taxonomy Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_taxonomy_background',
			[
				'label' => esc_html__( 'Taxonomy BG', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_avatar_taxonomy_radius',
  			[
  				'label' => esc_html__( 'Taxonomy Radius', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay a' => 'border-radius:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
  			]
  		);
		
  		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'boosted_post_list_taxonomy_typo',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-blog-taxonomy-overlay a',
				'condition' => [
					'boosted_post_list_overlay_tax' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_main_avatar_main_styles',
			[
				'label' => esc_html__( 'Avatar Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_post_list_avatar' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_post_list_avatar_position_vertical',
			[
				'label' => esc_html__( 'Vertical', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-avatar' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'top:0px; bottom:auto;',
					'bottom' => 'top:auto; bottom:0px;',
				],

			]
		);
		
		
		$this->add_control(
			'boosted_elements_post_list_avatar_position',
			[
				'label' => esc_html__( 'Horizontal', 'boosted-elements-progression' ),
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
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-avatar' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'left:0px; right:auto;',
					'right' => 'left:auto; right:0px;',
				],

			]
		);
		

		$this->add_responsive_control(
			'boosted_post_list_avatar_margins',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_avatar_width',
  			[
  				'label' => esc_html__( 'Avatar Size', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-avatar' => 'width:{{SIZE}}px;',
				],
  			]
  		);
		
  		$this->add_responsive_control(
  			'boosted_post_list_avatar_border_radius',
  			[
  				'label' => esc_html__( 'Avatar Radius', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-avatar img' => 'border-radius:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_avatar' => 'yes',
				],
  			]
  		);
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_main_pagination_styles',
			[
				'label' => esc_html__( 'Pagination Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'boosted_post_list_pagination!' => 'none',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_post_list_pagination_align',
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
					'{{WRAPPER}} .boosted-elements-pagination-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_post_list_padingation_padding',
			[
				'label' => esc_html__( 'Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pagination-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_post_list_pagination_between_spacing',
			[
				'label' => esc_html__( 'Space Between Page Numbers', 'progression-elements-viseo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pagination-container ul li' => 'padding-left:{{SIZE}}px; padding-right:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'default',
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_pagination_load_more_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Load More Button Styles', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} .boosted-elements-infinite-nav-pro a',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_post_list_pagination_load_more_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		
		
		$this->start_controls_tabs( 'boosted_elements_load_more_btn_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'boosted-elements-progression' ), 'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				], ] );

		$this->add_control(
			'boosted_elements_load_more_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_load_more_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_load_more_btn_border_main_control',
				'selector' => '{{WRAPPER}} .boosted-elements-infinite-nav-pro a',
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'boosted_elements_hover', [ 'label' => esc_html__( 'Hover', 'boosted-elements-progression' ), 'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				], ] );

		$this->add_control(
			'boosted_elements_load_more_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);

		$this->add_control(
			'boosted_elements_load_more_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);

		$this->add_control(
			'boosted_elements_load_more_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-infinite-nav-pro a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => 'load-more',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		
		
		
		$this->add_control(
			'boosted_post_list_pagination_load_more_gif_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Loading Image', 'boosted-elements-progression' ),
				'separator' => 'before',
				'condition' => [
					'boosted_post_list_pagination' => ['load-more', 'infinite'],
				],
			]
		);
		
		$this->add_control(
			'boosted_post_list_pagination_load_more_gif_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => esc_html__( 'GIF Loading Image', 'boosted-elements-progression' ),
				'condition' => [
					'boosted_post_list_pagination' => ['load-more', 'infinite'],
				],
			]
		);
		
		
  		$this->add_control(
  			'boosted_post_list_loading_image_brdr_radius',
  			[
  				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [ 'px' => '100' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #infscr-loading img' => 'border-radius:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_pagination' => ['load-more', 'infinite'],
				],
  			]
  		);
		
  		$this->add_control(
  			'boosted_post_list_loading_image_padding',
  			[
  				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [ 'px' => '20' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #infscr-loading img' => 'padding:{{SIZE}}px;',
				],
				'condition' => [
					'boosted_post_list_pagination' => ['load-more', 'infinite'],
				],
  			]
  		);
		
		
		$this->add_control(
			'boosted_post_list_loading_image_background',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #infscr-loading img' => 'background: {{VALUE}};',
				],
				'condition' => [
					'boosted_post_list_pagination' => ['load-more', 'infinite'],
				],
			]
		);
		
		
		
		$this->end_controls_section();
		
		
		
		
	}

	
	protected function render( ) {
		
      $settings = $this->get_settings();


		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {   $paged = get_query_var('page'); } else {  $paged = 1; }
		
		
		$post_per_page = $settings['boosted_post_list_count'];
		$offset = $settings['boosted_post_list_offset_count'];
		$offset_new = $offset + (( $paged - 1 ) * $post_per_page);
		
		$authorarray = $settings['boosted_post_type_author']; // get custom field value
		if($authorarray >= 1) { 
			$authorid = implode(', ', $authorarray); 
		} else {
			$authorid = '';
		}
		
		
		if ( ! empty( $settings['boosted_post_type_categories'] ) ){
		$catarray = $settings['boosted_post_type_categories']; // get custom field value
		if($catarray >= 1 && $settings['boosted_post_type_control'] == 'post' ) { 
			$catids = implode(', ', $catarray); 
			$catformatoperator = 'IN'; 
			
		} else {
			$catids = '';
			$catformatoperator = 'NOT IN'; 
		}
	} else {
		$catids = '';
		$catformatoperator = 'NOT IN'; 
	}
	
		
		if ( ! empty( $settings['boosted_post_type_tags'] ) ){
		
		$tagarray = $settings['boosted_post_type_tags']; // get custom field value
		if($tagarray >= 1 && $settings['boosted_post_type_control'] == 'post') { 			
			$tagids = implode(', ', $tagarray);
         $tagidsexpand = explode(', ', $tagids);
			$tagformatoperator = 'IN'; 
			
		} else {
			$tagidsexpand = '';
			$tagformatoperator = 'NOT IN'; 
		}
	} else {
		$tagidsexpand = '';
		$tagformatoperator = 'NOT IN'; 
	}
		
		
		
		
		
		
		
		
		
		
		if ( ! empty( $settings['boosted_post_type_post_formats'] ) ){
			
		$formatarray = $settings['boosted_post_type_post_formats']; // get custom field value
		if($formatarray >= 1) { 
			$formatids = implode(', ', $formatarray);
         $formatidsexpand = explode(', ', $formatids);
			$formatoperator = 'IN'; 
		} else {
			$formatidsexpand = '';
			$formatoperator = 'NOT IN'; 
		}
		
	} else {
		$formatidsexpand = '';
		$formatoperator = 'NOT IN'; 
	}
	
	$post_exclude_array = $settings['boosted_post_list_exclude']; // get custom field value
	if($post_exclude_array >= 1 && $settings['boosted_post_type_control'] == 'post') { 
		$post_exlude_id = $post_exclude_array;
	} else {
		$post_exlude_id = array();
	}

		$args = array(
			'post_type'         		=>	$settings['boosted_post_type_control'],
			'ignore_sticky_posts' 	=> 1,
			'post__not_in' 			=> $post_exlude_id,
			'posts_per_page'    		=>	$post_per_page,
			'paged' 						=> $paged,
			'order'     				=> $settings['boosted_post_list_order_asc_desc'],
			'orderby'     				=> $settings['boosted_post_list_order_by'],
			'offset' 					=> $offset_new,
			'author'						=> $authorid,
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'relation' => 'OR',
								array(
									'taxonomy' => 	'post_format',
									'field'    => 	'id',
									'operator'    => 	$formatoperator,
									'terms'    => 	$formatidsexpand,
								)
				),
				array(
					'relation' => 'AND',
					array(
						'taxonomy' => 	'category',
						'field'    => 	'id',
						'terms'    => 	$catids,
						'operator'    => 	$catformatoperator,
					),
					array(
						'taxonomy' => 	'post_tag',
						'field'    => 	'id',
						'terms'    => 	$tagidsexpand,
						'operator'    => 	$tagformatoperator,
					)
				)
			)
				
		);
		

		$blogloop = new \WP_Query( $args );
		
	?>
	
	
	<div class="boosted-elements-progression-post-list-container <?php if($settings['boosted_elements_post_list_content_background_background']  == "none" || $settings['boosted_elements_post_list_overlay_background_background']  == "none" ) :  ?> boosted-transparent-background-color<?php endif; ?>">
		<div class="boosted-elements-masonry-margins">
			<div id="boosted-elements-post-list-masonry<?php echo esc_attr($this->get_id()); ?>">
					
				<?php  while($blogloop->have_posts()): $blogloop->the_post();?>
					<div class="boosted-elements-progression-masonry-item boosted-elements-progression-masonry-column">
						<div class="boosted-elements-progression-image-masonry-padding">
							<div class="boosted-elements-progression-isotope-animation">
								
									<?php if ( $settings['boosted_post_list_layout'] == 'overlay' ) : ?>
										<div class="boosted-elements-blog-main-styles boosted-elements-blog-overlay-layout">
											
											<?php $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
											
											<a href="<?php the_permalink(); ?>" class="boosted-elements-blog-overlay-image" <?php if( ! empty( $featured_image_url ) && !empty( $settings['boosted_post_list_image_display'] ) ): ?> style="background:url(<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])?>); background-repeat: no-repeat;  background-position:center center;  background-size: cover;"<?php endif; ?>>

											<div class="boosted-elements-overlay-positioning">
												<div class="boosted-elements-slider-display-table">
													<div class="boosted-elements-post-list-vertical-align">
																										<div class="boosted-elements-blog-content-container">
													
																											<?php if ( $settings['boosted_post_list_meta_data_location'] == 'top' ) : ?>
																											<ul class="boosted-elements-blog-meta-data">
																												<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_date() ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php $i = 0;
														$sep = ', ';
														$cats = '';
														foreach ( ( get_the_category() ) as $category ) {
														  if (0 < $i)
														    $cats .= $sep;
														  $cats .= $category->cat_name;
														  $i++;
														}
														echo $cats; ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
																											</ul>
																											<?php endif; ?>
													
																											<?php if ( ! empty( $settings['boosted_post_list_title'] ) ) : ?><h3 class="boosted-elements-blog-title"><?php the_title(); ?></h3><?php endif; ?> 
														
																											<?php if ( $settings['boosted_post_list_meta_data_location'] == 'middle' ) : ?>
																											<ul class="boosted-elements-blog-meta-data">
																												<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php $i = 0;
														$sep = ', ';
														$cats = '';
														foreach ( ( get_the_category() ) as $category ) {
														  if (0 < $i)
														    $cats .= $sep;
														  $cats .= $category->cat_name;
														  $i++;
														}
														echo $cats; ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
																											</ul>
																											<?php endif; ?>
													
													
																											<?php if ( ! empty( $settings['boosted_post_list_excerpt'] ) ) : ?>
																											<div class="boosted-elements-blog-excerpt">
																												<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo boosted_elements_excerpt($settings['boosted_post_list_excerpt_count'] ); ?></p><?php endif; ?> 
																											</div>
																											<?php endif; ?>
													
																											<?php if ( $settings['boosted_post_list_meta_data_location'] == 'bottom' ) : ?>
																											<ul class="boosted-elements-blog-meta-data">
																												<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php $i = 0;
														$sep = ', ';
														$cats = '';
														foreach ( ( get_the_category() ) as $category ) {
														  if (0 < $i)
														    $cats .= $sep;
														  $cats .= $category->cat_name;
														  $i++;
														}
														echo $cats; ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
																											</ul>
																											<?php endif; ?>
											
																											<div class="clearfix-boosted-element"></div>
																										</div><!-- close .boosted-elements-blog-content-container -->
																					
													</div><!-- close .boosted-elements-post-list-vertical-align -->
												</div>
											</div><!-- close .boosted-elements-overlay-positioning -->
											
											</a>
											<?php if ( ! empty( $settings['boosted_post_list_overlay_tax'] ) ) : ?>
												<div class="boosted-elements-blog-taxonomy-overlay">
													<?php if ( $settings['boosted_post_list_overlay_tax_overlay'] == 'cat' ) : ?><?php the_category(' ') ?><?php endif; ?>
													<?php if ( $settings['boosted_post_list_overlay_tax_overlay'] == 'tag' ) : ?><?php the_tags(' ') ?><?php endif; ?>
												</div>
											<?php endif; ?>
											<?php if ( ! empty( $settings['boosted_post_list_avatar'] ) ) : ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="boosted-elements-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '250'); ?></a><?php endif; ?>								
										</div><!-- close .boosted-elements-blog-main-style -->
											
									<?php else: ?>
										<div class="boosted-elements-blog-main-styles">
											<?php 	
											$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
											if( ! empty( $featured_image_url ) && !empty( $settings['boosted_post_list_image_display'] ) ): ?>
											<div class="boosted-elements-blog-image-container">
													<a href="<?php the_permalink(); ?>" class="boosted-elements-blog-image"><?php the_post_thumbnail($settings['image_size']); ?></a>
													<?php if ( ! empty( $settings['boosted_post_list_avatar'] ) ) : ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="boosted-elements-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '250'); ?></a><?php endif; ?>
													<?php if ( ! empty( $settings['boosted_post_list_overlay_tax'] ) ) : ?>
														<div class="boosted-elements-blog-taxonomy-overlay">
															<?php if ( $settings['boosted_post_list_overlay_tax_overlay'] == 'cat' ) : ?><?php the_category(' ') ?><?php endif; ?>
															<?php if ( $settings['boosted_post_list_overlay_tax_overlay'] == 'tag' ) : ?><?php the_tags(' ') ?><?php endif; ?>
														</div>
													<?php endif; ?>
											</div>
											<?php endif; ?>
									
												<div class="boosted-elements-blog-content-container">
										
													<?php if ( $settings['boosted_post_list_meta_data_location'] == 'top' ) : ?>
													<ul class="boosted-elements-blog-meta-data">
														<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
													</ul>
													<?php endif; ?>
										
													<?php if ( ! empty( $settings['boosted_post_list_title'] ) ) : ?><h3 class="boosted-elements-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php endif; ?> 
										
													<?php if ( $settings['boosted_post_list_meta_data_location'] == 'middle' ) : ?>
													<ul class="boosted-elements-blog-meta-data">
														<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
													</ul>
													<?php endif; ?>
													
										
													<?php if ( ! empty( $settings['boosted_post_list_excerpt'] ) ) : ?>
													<div class="boosted-elements-blog-excerpt">
														<?php if(has_excerpt() ): ?><?php the_excerpt(); ?><?php else: ?><p><?php echo boosted_elements_excerpt($settings['boosted_post_list_excerpt_count'] ); ?></p><?php endif; ?> 
													</div>
													<?php endif; ?> 
													<div class="clearfix-boosted-element"></div>
													<?php if ( ! empty( $settings['boosted_post_list_read_more'] ) ) : ?><a class="boosted-elements-blog-read-more" href="<?php the_permalink(); ?>"><?php echo esc_attr($settings['boosted_post_list_read_more_text'] ); ?></a><?php endif; ?> 
													<div class="clearfix-boosted-element"></div>
													
											
													<?php if ( $settings['boosted_post_list_meta_data_location'] == 'bottom' ) : ?>
													<ul class="boosted-elements-blog-meta-data">
														<?php if ( in_array( 'author', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_author(); ?></span></li><?php endif; ?><?php if ( in_array( 'date', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_time(get_option('date_format')); ?></span></li><?php endif; ?><?php if ( in_array( 'categories', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php the_category(', ') ?></span></li><?php endif; ?><?php if ( in_array( 'comments', $settings['boosted_post_list_meta_data'] ) ) : ?><li class="boosted-elements-blog-meta-item"><span><?php comments_number(); ?></span></li><?php endif; ?> 
													</ul>
													<?php endif; ?>
													<div class="clearfix-boosted-element"></div>
											
												</div><!-- close .boosted-elements-blog-content-container -->
											
												<div class="clearfix-boosted-element"></div>
											</div><!-- close .boosted-elements-blog-main-styles -->
									<?php endif; ?><!-- close boosted_post_list_layout layout -->

									
							</div><!-- close .boosted-elements-progression-isotope-animation -->
						</div><!-- close .boosted-elements-progression-image-masonry-padding -->
					</div><!-- close .boosted-elements-progression-masonry-item progression-masonry-col -->
				<?php  endwhile; // end of the loop. ?>

			</div><!-- close #boosted-elements-post-list-masonry<?php echo esc_attr($this->get_id()); ?>  -->
		</div><!-- close .boosted-elements-masonry-margins-->
	</div><!-- close .boosted-elements-progression-post-list-container -->
	
	
	<?php if ( $settings['boosted_post_list_pagination'] == 'default' ) : ?>
		<div class="boosted-elements-pagination-container">
			<?php
		
			$page_tot = ceil(($blogloop->found_posts - $offset) / $post_per_page);
		
			if ( $page_tot > 1 ) {
			$big        = 999999999;
	      echo paginate_links( array(
	              'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
	              'format'    => '?paged=%#%',
	              'current'   => max( 1, $paged ),
	              'total'     => ceil(($blogloop->found_posts - $offset) / $post_per_page),
	              'prev_next' => true,
	  				'prev_text'    => esc_attr($settings['boosted_post_list_pagination_prev'] ),
	  				'next_text'    => esc_attr($settings['boosted_post_list_pagination_next'] ),
	              'end_size'  => 1,
	              'mid_size'  => 2,
	              'type'      => 'list'
	          )
	      );
			}
			?>
		</div><!-- close .boosted-elements-pagination-container -->
	<?php endif; ?>
	
	<?php if ( $settings['boosted_post_list_pagination'] == 'load-more' ) : ?>
		<div class="boosted-elements-pagination-container">
			<?php $page_tot = ceil(($blogloop->found_posts - $offset) / $post_per_page); if ( $page_tot > 1 ) : ?>
				<div class="boosted-elements-load-more-manual">
					<div id="boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-infinite-nav-pro"><div class="boosted-elements-nav-previous"><?php next_posts_link( $settings['boosted_post_list_pagination_load_more']
			. '<span><i class="fa ' . $settings['boosted_post_list_pagination_load_more_icon'] . '"></i></span>', $blogloop->max_num_pages ); ?></div></div>
					</div>
			<?php endif ?>
		</div><!-- close .boosted-elements-pagination-container -->
	<?php endif; ?>
	
	<?php if ( $settings['boosted_post_list_pagination'] == 'infinite' ) : ?>
		<div class="boosted-elements-pagination-container">
			<?php $page_tot = ceil(($blogloop->found_posts - $offset) / $post_per_page); if ( $page_tot > 1 ) : ?><div id="boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-infinite-nav-pro"><div class="boosted-elements-nav-previous"><?php next_posts_link( 'Next', $blogloop->max_num_pages ); ?></div></div><?php endif ?>
		</div><!-- close .boosted-elements-pagination-container -->
	<?php endif; ?>
	
	
	
	
	<script type="text/javascript">
	jQuery(document).ready(function($) { 'use strict';	
		/* Default Isotope Load Code */
		var $container<?php echo esc_attr($this->get_id()); ?> = $('#boosted-elements-post-list-masonry<?php echo esc_attr($this->get_id()); ?>').isotope();
		$container<?php echo esc_attr($this->get_id()); ?>.imagesLoaded( function() {
			
			$(".boosted-elements-progression-masonry-item").addClass("boosted-elements-isotope-animation-start");
			
			$container<?php echo esc_attr($this->get_id()); ?>.isotope({
				itemSelector: '#boosted-elements-post-list-masonry<?php echo esc_attr($this->get_id()); ?> .boosted-elements-progression-masonry-item',				
				percentPosition: true,
				layoutMode: <?php if ( ! empty( $settings['boosted_post_list_masonry'] ) ) : ?>"masonry"<?php else: ?>"fitRows"<?php endif; ?> 
	 		});
			
		});
		/* END Default Isotope Code */
		<?php if ( $settings['boosted_post_list_pagination'] == 'infinite' || $settings['boosted_post_list_pagination'] == 'load-more' ) : ?>
		/* Begin Infinite Scroll */
		$container<?php echo esc_attr($this->get_id()); ?>.infinitescroll({
		errorCallback: function(){  $("#boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?>").delay(500).fadeOut(500, function(){ $(this).remove(); }); },
		  navSelector  : "#boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?>",  
		  nextSelector : "#boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?> .boosted-elements-nav-previous a", 
		  itemSelector : "#boosted-elements-post-list-masonry<?php echo esc_attr($this->get_id()); ?> .boosted-elements-progression-masonry-item", 
	   		loading: {
	   		 	img: "<?php $image = $settings['boosted_post_list_pagination_load_more_gif_image']; $imageurl = wp_get_attachment_image_src($image['id'], 'full'); ?><?php if ( $imageurl )  : ?><?php echo esc_url($imageurl[0]);?><?php else: ?><?php echo plugins_url( 'assets/images/loader.gif', BOOSTED_ELEMENTS_PROGRESSION_FILE__ ) ; ?><?php endif; ?>",
	   			 msgText: "",
	   		 	finishedMsg: "<div id='boosted-elements-no-more-posts'></div>",
	   		 	speed: 0, }
		  },
		  // trigger Isotope as a callback
		  function( newElements ) {
			  
			  //Add JS as needed here
			  
 		    var $newElems = $( newElements );
 	
 				$newElems.imagesLoaded(function(){
					
 				$container<?php echo esc_attr($this->get_id()); ?>.isotope( "appended", $newElems );
 				$(".boosted-elements-progression-masonry-item").addClass("boosted-elements-isotope-animation-start");
				
 			});

 		  }
 		);
 	    /* END Infinite Scroll */
		
		<?php endif; ?>
		
		<?php if ( $settings['boosted_post_list_pagination'] == 'load-more' ) : ?>
		/* PAUSE FOR LOAD MORE */
		$(window).unbind(".infscr");
		// Resume Infinite Scroll
		$("#boosted-elements-infinite-nav<?php echo esc_attr($this->get_id()); ?> .boosted-elements-nav-previous a").click(function(){
			$container<?php echo esc_attr($this->get_id()); ?>.infinitescroll("retrieve");
			return false;
		});
		/* End Infinite Scroll */
		<?php endif; ?>
		
	});
	</script>
	
	<div class="clearfix-boosted-element"></div>
	
	<?php wp_reset_postdata();?>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsPostList() );