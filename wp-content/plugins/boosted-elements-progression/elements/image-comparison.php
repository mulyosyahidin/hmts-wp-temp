<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsImageComparison extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-image-comparison';
	}

	public function get_title() {
		return esc_html__( 'Image Comparison - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-image-before-after boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_image_compare_js' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Before Image', 'boosted-elements-progression' )
  			]
  		);
		

		$this->add_control(
			'boosted_elements_before_caption',
			[
				'label' => esc_html__( 'Caption Before', 'boosted-elements-progression' ),
				'default' => esc_html__( 'Before', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'boosted_elements_before_image',
			[
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_before',
				'default' => 'full',
			]
		);
		
		$this->end_controls_section();
		
		 
  		$this->start_controls_section(
  			'section_title_boosted_after_options',
  			[
  				'label' => esc_html__( 'After Image', 'boosted-elements-progression' )
  			]
  		);

		
		$this->add_control(
			'boosted_elements_after_caption',
			[
				'label' => esc_html__( 'Caption After', 'boosted-elements-progression' ),
				'default' => esc_html__( 'After', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'boosted_elements_after_image',
			[
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_after',
				'default' => 'full',
			]
		);
		

		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_js_option',
  			[
  				'label' => esc_html__( 'Comparison Settings', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_responsive_control(
			'boosted_elements_img_align',
			[
				'label' => esc_html__( 'Image Align', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-progression-image-comparison-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_visible_ratio',
			[
				'label' => esc_html__( 'Visible Ratio', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0,
						'max' => 1,
					],
				],
				'default' => [
					'size' => 0.5,
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_selection_control',
			[
				'label' => esc_html__( 'Interaction Mode', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'drag' => esc_html__( 'Drag', 'boosted-elements-progression' ),
					'mousemove' => esc_html__( 'Mouse Move', 'boosted-elements-progression' ),
					'click' => esc_html__( 'Mouse Click', 'boosted-elements-progression' ),
				],
				'default' => 'drag',
			]
		);
		
		$this->add_control(
			'boosted_elements_selection_separator',
			[
				'label' => esc_html__( 'Separator', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'Display Separator', 'boosted-elements-progression' ),
					'false' => esc_html__( 'Hide Separator', 'boosted-elements-progression' ),
				],
				'default' => 'true',
			]
		);
		
		$this->add_control(
			'boosted_elements_drag_handle',
			[
				'label' => esc_html__( 'Drag Handle', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'Display Handle', 'boosted-elements-progression' ),
					'false' => esc_html__( 'Hide Handle', 'boosted-elements-progression' ),
				],
				'default' => 'true',
			]
		);
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_caption_styles',
  			[
  				'label' => esc_html__( 'Caption Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		
		$this->add_control(
			'boosted_elements_caption_text_color',
			[
				'label' => esc_html__( 'Caption Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_caption_background_color',
			[
				'label' => esc_html__( 'Caption Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'section_boosted_caption_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .images-compare-label',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_select_caption_position',
			[
				'label' => esc_html__( 'Caption Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					'boosted-img-compare-position-top' => esc_html__( 'Top', 'boosted-elements-progression' ),
					'boosted-img-compare-position-middle' => esc_html__( 'Middle', 'boosted-elements-progression' ),
					'boosted-img-compare-position-bottom' => esc_html__( 'Bottom', 'boosted-elements-progression' ),
				],
				'default' => 'boosted-img-compare-position-top',
			]
		);
		
		$this->add_responsive_control(
			'section_title_caption_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'section_title_caption_margin',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'section_title_caption_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .images-compare-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_general_styles',
  			[
  				'label' => esc_html__( 'Control Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		$this->add_control(
			'boosted_elements_caption_divider_color',
			[
				'label' => esc_html__( 'Divider Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-separator' => 'background: {{VALUE}};',
				],
			]
		);
		

		
		$this->add_control(
			'boosted_elements_caption_drag_handle_color',
			[
				'label' => esc_html__( 'Drag Handle Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .images-compare-handle' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_caption_drag_handle_border_color',
			[
				'label' => esc_html__( 'Drag Border Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-handle' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_caption_drag_handle_arrow_left_color',
			[
				'label' => esc_html__( 'Drag Arrow Left Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-left-arrow' => 'border-right-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_caption_drag_handle_arrow_right_color',
			[
				'label' => esc_html__( 'Drag Arrow right Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .images-compare-right-arrow' => 'border-left-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>
	
	
	<?php if ( ! empty( $settings['boosted_elements_before_image']['url'] ) ) : ?>
	<div class="boosted-elements-progression-image-comparison-container <?php echo esc_attr($settings['boosted_elements_select_caption_position'] ); ?>">			
		<div id="BoostedImageCompare-<?php echo esc_attr($this->get_id()); ?>">
		    <!-- The first div will be the front element, to prevent FOUC add a style="display: none;" -->
		    <div class="BoostedImageCompareBeforeHidden">
		        <?php if ( ! empty( $settings['boosted_elements_before_caption'] ) ) : ?><span class="images-compare-label"><?php echo esc_attr($settings['boosted_elements_before_caption'] ); ?></span><?php endif; ?>
					  
					<?php $image_before = $settings['boosted_elements_before_image'];  $image_url_before = Group_Control_Image_Size::get_attachment_image_src( $image_before['id'], 'thumbnail_before', $settings ); ?>
		        <img src="<?php echo esc_url($image_url_before);?>" alt="<?php echo esc_attr($settings['boosted_elements_before_caption'] ); ?>">
		    </div>
		    <!-- This div will be the back element -->
		    <div class="BoostedImageCompareAfter">
		        <?php if ( ! empty( $settings['boosted_elements_after_caption'] ) ) : ?><span class="images-compare-label"><?php echo esc_attr($settings['boosted_elements_after_caption'] ); ?></span><?php endif; ?>
		        <?php if ( ! empty( $settings['boosted_elements_after_image']['url'] ) ) : ?>
					  <?php $image_after = $settings['boosted_elements_after_image'];  $image_url_after = Group_Control_Image_Size::get_attachment_image_src( $image_after['id'], 'thumbnail_after', $settings ); ?>
					  <img src="<?php echo esc_url($image_url_after);?>" alt="<?php echo esc_attr($settings['boosted_elements_after_caption'] ); ?>">
				 <?php endif; ?>
		    </div>
		</div>
	</div><!-- close .boosted-elements-progression-image-comparison-container -->
	<?php endif; ?>
	
	<script type="text/javascript"> 
	jQuery(document).ready(function($) {
		'use strict';
		$('#BoostedImageCompare-<?php echo esc_attr($this->get_id()); ?>').imagesCompare({
		    initVisibleRatio: <?php echo esc_attr($settings['boosted_elements_visible_ratio']['size'] ); ?>,
		    interactionMode: "<?php echo esc_attr($settings['boosted_elements_selection_control'] ); ?>",
		    addSeparator: <?php echo esc_attr($settings['boosted_elements_selection_separator'] ); ?>,
		    addDragHandle: <?php echo esc_attr($settings['boosted_elements_drag_handle'] ); ?>,
		    animationDuration: 400,
		    animationEasing: "swing",
			precision: 4
		});
	});
	</script>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsImageComparison() );