<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsPrice_Menu_List extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-price-menu-list';
	}

	public function get_title() {
		return esc_html__( 'Price/Menu - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-menu-card boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Price/Menu List', 'boosted-elements-progression' )
  			]
  		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'boosted_elements_price_repeater_title_field',
			[
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Price List Item', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'boosted_elements_price_repeater_text_price',
			[
				'label' => esc_html__( 'Price', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '$55', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'boosted_elements_price_repeater_main_text_field',
			[
				'label' => esc_html__( 'Main Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_price_repeater_content_external_link',
			[
				'label' => esc_html__( 'Optional Link', 'boosted-elements-progression' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'http://progressionstudios.com',
			]
		);
		
		
		$repeater->add_control(
			'boosted_elements_price_repeater_image',
			[
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => esc_html__( 'No Image', 'boosted-elements-progression' ),
						'icon' => 'fas fa-ban',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'boosted-elements-progression' ),
						'icon' => 'eicon-image',
					],
				],
				'default' => 'none',
			]
		);
		
		$repeater->add_control(
			'boosted_elements_price_repeater_image_field',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'boosted_elements_price_repeater_image' => 'image',
				],
			]
		);
		
		
		
	
		$this->add_control(
			'boosted_elements_price_repeater',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'boosted_elements_price_repeater_title_field' => esc_html__( 'Price List Item 1', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_text_price' => esc_html__( '$55', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_price_repeater_title_field' => esc_html__( 'Price List Item 2', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_text_price' => esc_html__( '$25', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_price_repeater_title_field' => esc_html__( 'Price List Item 3', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_text_price' => esc_html__( '$35', 'boosted-elements-progression' ),
						'boosted_elements_price_repeater_main_text_field' => esc_html__( 'Example text description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mi ex.', 'boosted-elements-progression' ),
					],
				],
				'title_field' => '{{{ boosted_elements_price_repeater_title_field }}}',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_price_main_styles',
			[
				'label' => esc_html__( 'Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'boosted_elements_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_heading_title_color',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-pricing-title' => 'color: {{VALUE}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'boosted_elements_heading_title_spacing_margin_top',
			[
				'label' => esc_html__( 'Margin Top', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-pricing-title' => 'margin-top: {{SIZE}}px',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_heading_title_spacing',
			[
				'label' => esc_html__( 'Margin Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} h3.boosted-elements-pricing-title' => 'margin-bottom: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_heading_title_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.boosted-elements-pricing-title',
			]
		);
		
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_title_underline_border',
				'selector' => '{{WRAPPER}} h3.boosted-elements-pricing-title',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} h3.boosted-elements-pricing-title',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_heading_price',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Price', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'boosted_elements_heading_price_color',
			[
				'label' => esc_html__( 'Price Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-list-price' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_heading_price_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-price-list-price',
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_content_pricing_padding',
			[
				'label' => esc_html__( 'Price Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-list-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_heading_main',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Main Text', 'boosted-elements-progression' ),
				'separator' => 'before',
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_heading_main_color',
			[
				'label' => esc_html__( 'Main text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-list-content' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_heading_main_spacing',
			[
				'label' => esc_html__( 'Margin Bottom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-list-content' => 'margin-bottom: {{SIZE}}px',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boosted_elements_main_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-price-list-content',
			]
		);
		

		
		$this->end_controls_section();
		
        
		$this->start_controls_section(
			'section_price_list_container_styles',
			[
				'label' => esc_html__( 'List Container Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
		
		$this->add_responsive_control(
			'boosted_elements_list_price_padding',
			[
				'label' => esc_html__( 'List Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-price-menu-list-container li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'boosted_elements_list_price_margin',
			[
				'label' => esc_html__( 'List Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-price-menu-list-container li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_group_control(
        			\Elementor\Group_Control_Background::get_type(),
        			[
        				'name' => 'boosted_elements_list_main_bg',
        				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
        				'types' => [ 'classic', 'gradient' ],
        				'selector' => '{{WRAPPER}} .boosted-elements-progression-price-menu-list-container li',
        			]
        );
        
        $this->add_group_control(
        			\Elementor\Group_Control_Border::get_type(),
        			[
        				'name' => 'boosted_elements_border_list',
        				'label' => esc_html__( 'Border', 'boosted-elements-progression' ),
        				'types' => [ 'classic', 'gradient' ],
        				'selector' => '{{WRAPPER}} .boosted-elements-progression-price-menu-list-container li',
        			]
        );
        
        $this->add_group_control(
        			\Elementor\Group_Control_Box_Shadow::get_type(),
        			[
        				'name' => 'boosted_elements_shadow',
        				'label' => esc_html__( 'Box Shadow', 'boosted-elements-progression' ),
        				'selector' => '{{WRAPPER}} .boosted-elements-progression-price-menu-list-container li',
        			]
        );
        
        
		
        
        
        
        
		$this->end_controls_section();
	
		
		$this->start_controls_section(
			'section_price_divider_styles',
			[
				'label' => esc_html__( 'Divider Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		
		$this->add_control(
			'boosted_elements_divider_main_color',
			[
				'label' => esc_html__( 'Divider Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eaeaea',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-bottom-divider' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_divider_border_style',
			[
				'label' => esc_html__( 'Style', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'boosted-elements-progression' ),
					'dotted' => esc_html__( 'Dotted', 'boosted-elements-progression' ),
					'dashed' => esc_html__( 'Dashed', 'boosted-elements-progression' ),
					'groove' => esc_html__( 'Groove', 'boosted-elements-progression' ),
					'none' => esc_html__( 'None', 'boosted-elements-progression' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-bottom-divider' => 'border-top-style:{{SIZE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_divider_height',
			[
				'label' => esc_html__( 'Divider Height', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-bottom-divider' => 'border-top-width: {{SIZE}}px',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_content_divider_padding',
			[
				'label' => esc_html__( 'Divider Margins', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '25',
					'left' => '0',
					'right' => '0',
					'bottom' => '25'
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-price-bottom-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_price_image_styles',
			[
				'label' => esc_html__( 'Image Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'full',
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_image_spacing',
			[
				'label' => esc_html__( 'Margin Right', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-pricing-image' => 'margin-right: {{SIZE}}px',
				],
			]
		);
		
		$this->end_controls_section();
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

	<ul class="boosted-elements-progression-price-menu-list-container">	
		<?php foreach ( $settings['boosted_elements_price_repeater'] as $item ) :  ?>
			<li>
				
				<?php if ( ! empty( $item['boosted_elements_price_repeater_content_external_link']['url']) ) : ?><a href="<?php echo esc_url($item['boosted_elements_price_repeater_content_external_link']['url']); ?>" <?php if ( ! empty( $item['boosted_elements_price_repeater_content_external_link']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $item['boosted_elements_price_repeater_content_external_link']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?>
					
					
					<?php if ( $item['boosted_elements_price_repeater_image'] == 'image' ) : ?>
						<div class="boosted-elements-pricing-image">
						 <?php if ( ! empty( $item['boosted_elements_price_repeater_image_field'] ) ) : ?>
							<?php $image = $item['boosted_elements_price_repeater_image_field'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'full', $settings ); ?>
							<img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_html__( 'Insert Image Here', 'boosted-elements-progression' ); ?>">	
						 <?php endif; ?>
						</div>
					<?php endif; ?>
					
					
					<?php if ( ! empty( $item['boosted_elements_price_repeater_title_field']) ) : ?><h3 class="boosted-elements-pricing-title"><?php echo esc_attr($item['boosted_elements_price_repeater_title_field'] ); ?><?php if ( ! empty( $item['boosted_elements_price_repeater_text_price']) ) : ?><span class="boosted-elements-price-list-price"><?php echo wp_kses(($item['boosted_elements_price_repeater_text_price'] ), true ); ?></span><?php endif; ?>
</h3><?php endif; ?>
						
						
			
					<?php if ( ! empty( $item['boosted_elements_price_repeater_main_text_field']) ) : ?><div class="boosted-elements-price-list-content"><?php echo wp_kses(($item['boosted_elements_price_repeater_main_text_field'] ), true ); ?></div><?php endif; ?>
				
				<div class="clearfix-boosted-element"></div>
				<?php if ( ! empty( $item['boosted_elements_price_repeater_content_external_link']['url']) ) : ?></a><?php endif; ?>
				
				<div class="boosted-elements-price-bottom-divider"></div>
				
			</li>
		<?php endforeach; ?>
	</ul><!-- close .boosted-elements-progression-price-menu-list-container -->
	
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsPrice_Menu_List() );