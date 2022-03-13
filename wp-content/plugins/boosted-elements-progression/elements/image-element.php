<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsImageGrid extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-image-grid';
	}

	public function get_title() {
		return esc_html__( 'Image Grid - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-posts-grid boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_masonry_js', 'boosted_elements_progression_prettyphoto_js' ];
	}

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Image Grid Options', 'boosted-elements-progression' )
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
		
	
		
		$this->add_responsive_control(
			'boosted_elements_image_grid_column_count',
			[
  				'label' => esc_html__( 'Columns', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,				
				'desktop_default' => '33.330%',
				'tablet_default' => '50%',
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
		
		
  		$this->add_responsive_control(
  			'boosted_elements_image_grid_margin',
  			[
  				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-masonry-margins' => 'margin-top:-{{SIZE}}px; margin-left:-{{SIZE}}px; margin-right:-{{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-image-masonry-padding' => 'padding: {{SIZE}}px;',
				],
				'render_type' => 'template'
  			]
  		);

		$this->add_control(
			'boosted_elements_gallery_masonry',
			[
				'label' => esc_html__( 'Masonry Layout', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		
		
		$this->end_controls_section();
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_image_captions',
  			[
  				'label' => esc_html__( 'Image Caption Options', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_gallery_captions',
			[
				'label' => esc_html__( 'Image Captions', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
		
		
		$this->add_control(
		'boosted_elements_gallery_caption_location',
		[
			'label' => esc_html__( 'Caption Location', 'boosted-elements-progression' ),
			'label_block' => true,
			'type' => Controls_Manager::SELECT,				
			'boosted-elements-image-grid-caption-under' => 'default',
			'options' => [
				'boosted-elements-image-grid-caption-under' => esc_html__( 'Underneath', 'boosted-elements-progression' ),
				'boosted-elements-image-grid-caption-overlay' => esc_html__( 'Overlay on Hover', 'boosted-elements-progression' ),
			],
		]
		);
		
		
  		$this->end_controls_section();
		
		
		
		
  		$this->start_controls_section(
  			'section_title_boosted_lightbox_options',
  			[
  				'label' => esc_html__( 'Image Lightbox Options', 'boosted-elements-progression' )
  			]
  		);

		
		$this->add_control(
			'boosted_elements_image_grid_lightbox',
			[
				'label' => esc_html__( 'Open Large Image on Click', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		

		
		$this->add_control(
			'boosted_elements_image_prettyphoto_disable',
			[
				'label' => esc_html__( 'Use Default Lighbox', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_gallery_lightbox_captions',
			[
				'label' => esc_html__( 'Display Secondary Lightbox Captions', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);


		$this->end_controls_section();
		
		
  		
		
		
		$this->start_controls_section(
			'section_boosted_elements_title_style',
			[
				'label' => esc_html__( 'Caption Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'styles_boosted_elements_title_color',
			[
				'label' => esc_html__( 'Caption Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .progression-studios-grid-caption' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'styles_boosted_elements_background_content_color',
			[
				'label' => esc_html__( 'Caption Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .progression-studios-image-grid-caption-table' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_caption_main_padding',
			[
				'label' => esc_html__( 'Caption Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .progression-studios-grid-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .progression-studios-grid-caption',
			]
		);
		
		$this->add_control(
			'boosted_elements_caption_alignment',
			[
				'label' => esc_html__( 'Alignment', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .progression-studios-grid-caption' => 'text-align: {{VALUE}}',
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
					'{{WRAPPER}} .boosted-elements-image-grid-caption-overlay .progression-studios-image-grid-caption-table-cell' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'display:block;',
					'middle' => 'display:table-cell; vertical-align:middle;',
					'bottom' => 'position:absolute; bottom:0px; width:100%;',
				],
				'condition' => [
					'boosted_elements_gallery_caption_location' => 'boosted-elements-image-grid-caption-overlay',
				],
			]
		);
		

       $this->end_controls_section();
		 
		
 		$this->start_controls_section(
 			'section_boosted_elements_image_styles',
 			[
 				'label' => esc_html__( 'Image Styles', 'boosted-elements-progression' ),
 				'tab' => Controls_Manager::TAB_STYLE
 			]
 		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_image_border_main',
				'label' => esc_html__( 'Border', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} img.boosted-elements-progression-image',
			]
		);

		$this->add_control(
			'boosted_elements_image_main_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} img.boosted-elements-progression-image' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .boosted-elements-image-grid-caption-overlay .progression-studios-image-grid-caption-table' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .boosted-elements-image-grid-caption-overlay .boosted-elements-progression-image-grid-item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_imagealignment',
			[
				'label' => esc_html__( 'Alignment', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-progression-image-grid-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		
 		$this->start_controls_section(
 			'section_boosted_elements_image_hover',
 			[
 				'label' => esc_html__( 'Image Hover Animations', 'boosted-elements-progression' ),
 				'tab' => Controls_Manager::TAB_STYLE
 			]
 		);
		
		
  		$this->add_control(
  			'boosted_elements_image_hover_transparency',
  			[
  				'label' => esc_html__( 'Image Hover Transparency', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'step' => 0.01,
						'min' => 0,
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .boosted-elements-progression-image-grid-item:hover img' => 'opacity: {{SIZE}};',
				],
  			]
  		);
		
		
		
		$this->add_control(
			'styles_boosted_elements_img_background',
			[
				'label' => esc_html__( 'Image Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-image-grid-item' => 'background: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_image_grid_image_transition',
			[
  				'label' => esc_html__( 'Image Hover Effect', 'boosted-elements-progression' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,		
				'default' => 'boosted-elements-image-grid-transition-none',		
				'options' => [
					'boosted-elements-image-grid-transition-none' => esc_html__( 'No Effect', 'boosted-elements-progression' ),
					'boosted-elements-image-grid-transition-zoom' => esc_html__( 'Zoom', 'boosted-elements-progression' ),
					'boosted-elements-image-grid-transition-grey' => esc_html__( 'Greyscale', 'boosted-elements-progression' ),
					'boosted-elements-image-grid-transition-sepia' => esc_html__( 'Sepia', 'boosted-elements-progression' ),
					'boosted-elements-image-grid-transition-saturate' => esc_html__( 'Saturate', 'boosted-elements-progression' ),
				],
				'render_type' => 'template'
			]
		);
		
		
		$this->end_controls_section();

	}
	

	protected function render( ) {
		
      $settings = $this->get_settings();
		
		if ( empty( $settings['boosted_elements_image_gallery'] ) ) {
			return;
		}

	?>



	<div class="boosted-elements-progression-image-grid-container <?php echo esc_attr($settings['boosted_elements_gallery_caption_location']); ?> <?php echo esc_attr($settings['boosted_elements_image_grid_image_transition']); ?>">
		<div class="boosted-elements-masonry-margins">
			<div class="boosted-elements-grid-masonry<?php echo esc_attr($this->get_id()); ?>">
				
				<?php  $pro_images_gallery = $this->get_settings( 'boosted_elements_image_gallery' ); foreach ( $pro_images_gallery as $image ) : ?>
		
					<div class="boosted-elements-progression-masonry-item boosted-elements-progression-masonry-column">
						<div class="boosted-elements-progression-image-masonry-padding">
							<div class="boosted-elements-progression-isotope-animation">
								
								<div class="boosted-elements-progression-image-grid-item">
									<?php $image_lightbox = wp_get_attachment_image_src($image['id'], 'large'); ?>
									<?php $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
								
									
									<?php if ( ! empty( $settings['boosted_elements_image_grid_lightbox'] ) ) : ?>
									<a href="<?php echo esc_attr($image_lightbox[0]);?>" class="boosted-elements-lightbox-js" <?php if (  $settings['boosted_elements_image_prettyphoto_disable'] != "yes" ) : ?>data-rel="prettyPhoto[boosted-elements-gallery-<?php echo esc_attr($this->get_id()); ?>]"<?php else: ?>data-elementor-lightbox-slideshow="gallery-boosted-<?php echo esc_attr($this->get_id()); ?>"<?php endif; ?> <?php if ( ! empty( $settings['boosted_elements_gallery_lightbox_captions'] ) ) : ?><?php $get_description = get_post($image['id'])->post_excerpt; if(!empty($get_description)){  echo 'title="' . esc_attr($get_description) . '"'; }  ?><?php endif; ?>>
									<?php endif; ?>

									<img src="<?php echo esc_attr($image_url);?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $image ) ); ?>" class="boosted-elements-progression-image">
									
									<?php if ( ! empty( $settings['boosted_elements_gallery_captions'] ) ) : ?>
									<?php $get_description = get_post($image['id'])->post_excerpt; if(!empty($get_description)){ 
										echo '<div class="progression-studios-image-grid-caption-overlay"><div class="progression-studios-image-grid-caption-table"><div class="progression-studios-image-grid-caption-table-cell"><div class="progression-studios-grid-caption">' . esc_attr($get_description) . '</div></div></div></div><!-- close .progression-studios-image-grid-caption-table -->'; } 
									?>
									<?php endif; ?>

									<?php if ( ! empty( $settings['boosted_elements_image_grid_lightbox'] ) ) : ?></a><?php endif; ?>
									
									
										
										<div class="clearfix-boosted-element"></div>
								</div><!-- close .boosted-elements-progression-image-grid-item -->
								
							</div><!-- close .boosted-elements-progression-isotope-animation -->
						</div><!-- close .boosted-elements-progression-image-masonry-padding -->
					</div><!-- close .boosted-elements-progression-masonry-item progression-masonry-col -->

		<?php endforeach; ?>
		</div><!-- close .boosted-elements-grid-masonry<?php echo esc_attr($this->get_id()); ?>  -->
		</div><!-- close .boosted-elements-masonry-margins-->
	
	</div><!-- close .boosted-elements-progression-image-grid-container -->
	
	<script type="text/javascript">
		jQuery(document).ready(function($) { 'use strict';
		/* Default Isotope Load Code */
		var $container = $('.boosted-elements-grid-masonry<?php echo esc_attr($this->get_id()); ?>').isotope();
		$container.imagesLoaded( function() {
			
			$(".boosted-elements-progression-masonry-item").addClass("boosted-elements-isotope-animation-start");
			
			$container.isotope({
				itemSelector: '.boosted-elements-progression-masonry-item',				
				percentPosition: true,
				layoutMode: <?php if ( ! empty( $settings['boosted_elements_gallery_masonry'] ) ) : ?>"masonry"<?php else: ?>"fitRows" <?php endif; ?> 
	 		});
			
			
	   	$("boosted-elements-grid-masonry<?php echo esc_attr($this->get_id()); ?> a[data-rel^='prettyPhoto']").prettyPhoto({
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
			
		});
		/* END Default Isotope Code */
	});
	</script>
	
	<div class="clearfix-boosted-element"></div>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsImageGrid() );