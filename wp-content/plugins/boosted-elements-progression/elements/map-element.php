<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsMap extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-googlemaps';
	}

	public function get_title() {
		return esc_html__( 'Maps - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-google-maps boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_google_maps' ]; 
	}
	
	protected function register_controls() {
		
		$this->start_controls_section(
			'section_map_pins',
			[
				'label' => esc_html__( 'Map Pins', 'boosted-elements-progression' ),
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'progression_map_address',
			[
				'label' => esc_html__( 'Map Address', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( '1600 Holloway Ave, San Francisco, CA 94132', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'progression_map_title',
			[
				'label' => esc_html__( 'Pin Title', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Progression Studios', 'boosted-elements-progression' ),
			]
		);
		
		
		$repeater->add_control(
			'progression_map_content',
			[
				'label' => esc_html__( 'Pin Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Add an optional title and description to your map pins', 'boosted-elements-progression' ),
			]
		);
		
		$repeater->add_control(
			'progressio_map_maker_open',
			[
				'label' => esc_html__( 'Open Pin Automatically?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		$repeater->add_control(
			'progression_map_icon',
			[
				'label' => esc_html__( 'Custom Pin Icon', 'boosted-elements-progression' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		
		 
		$this->add_control(
			'boosted_elements_progression_map_pins',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'progression_map_address' => esc_html__( '1600 Holloway Ave, San Francisco, CA 94132', 'boosted-elements-progression' ),
						'progression_map_title' => esc_html__( 'Progression Studios', 'boosted-elements-progression' ),
						'progression_map_content' => esc_html__( 'Add an optional title and description to your map pins', 'boosted-elements-progression' ),
					],
				],
				'title_field' => '<i class="fa fa-map-marker"></i> {{{ progression_map_address }}}',
			]
		);


		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_global_options',
  			[
  				'label' => esc_html__( 'Map Options', 'boosted-elements-progression' )
  			]
  		);

  		$this->add_responsive_control(
  			'map_height',
  			[
  				'label' => esc_html__( 'Map Height', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min' => 80,
						'max' => 1400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-map-mobile-menu-height' => 'height: {{SIZE}}px;',
				],
  			]
  		);
		
  		
		
  		$this->add_control(
  			'map_zoom',
  			[
  				'label' => esc_html__( 'Map Zoom', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 22,
					],
				],
  			]
  		);
		

		$this->add_control(
			'map_option_single_pin',
			[
				'label' => esc_html__( 'Open One Pin at a Time?', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'map_option_streeview',
			[
				'label' => esc_html__( 'Street View Controls', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		
		
		$this->add_control(
			'map_option_maptype_control',
			[
				'label' => esc_html__( 'Map Type Controls Top Right', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'map_option_mapscroll',
			[
				'label' => esc_html__( 'Scroll Wheel Zoom', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'map_type',
			[
				'label' => esc_html__( 'Map Type', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ROADMAP',
				'options' => [
					'ROADMAP' => esc_html__( 'Road Map', 'boosted-elements-progression' ),
					'SATELLITE' => esc_html__( 'Satellite', 'boosted-elements-progression' ),
					'TERRAIN' => esc_html__( 'Terrain', 'boosted-elements-progression' ),
					'HYBRID' => esc_html__( 'Hybrid', 'boosted-elements-progression' ),
				],
			]
		);

		
		$this->add_control(
			'map_center_address',
			[
				'label' => esc_html__( 'Optional Moving Center of Map', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Map Address', 'boosted-elements-progression' ),
			]
		);
		
  		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Pin Title Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'section_title_main_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-map-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-map-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-progression-map-title',
			]
		);

       $this->end_controls_section();
		 
		 
  		$this->start_controls_section(
  			'section_text_style',
  			[
  				'label' => esc_html__( 'Pin Text Styles', 'boosted-elements-progression' ),
  				'tab' => Controls_Manager::TAB_STYLE
  			]
  		);
		
		$this->add_responsive_control(
			'section_content_main_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-progression-map-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

  		$this->add_control(
  			'content_color',
  			[
  				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
  				'type' => Controls_Manager::COLOR,
  				'selectors' => [
  					'{{WRAPPER}} .boosted-elements-progression-map-content' => 'color: {{VALUE}};',
  				],
  			]
  		);

  		$this->add_group_control(
  			Group_Control_Typography::get_type(),
  			[
            'name' => 'content_typography',
  				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
  				'selector' => '{{WRAPPER}} .boosted-elements-progression-map-content',
  			]
  		);
      
		$this->end_controls_section();
		
	}
	

	protected function render( ) {

      $settings = $this->get_settings();
	
	?>
	
	<div class="boosted-elements-progression-google-maps-container">
		<div id="boosted-elements-progression-map-list-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-map-mobile-menu-height"></div>
	</div><!-- close .boosted-elements-progression-google-maps-container -->
	
	<script type="text/javascript"> 
	jQuery(document).ready(function($) {
		'use strict';
    	$("#boosted-elements-progression-map-list-<?php echo esc_attr($this->get_id()); ?>").goMap({
			<?php if ( ! empty( $settings['map_center_address'] ) ) : ?>address: '<?php echo esc_attr($settings['map_center_address'] ); ?>',<?php endif; ?>
        markers: [ <?php foreach ( $settings['boosted_elements_progression_map_pins'] as $item ) : ?>{ address: '<?php echo esc_attr( $item['progression_map_address'] ); ?>', <?php if ( ! empty( $item['progression_map_icon'] ) ) : ?>icon: '<?php $image = $item['progression_map_icon']; $imageurl = wp_get_attachment_image_src($image['id'], 'large'); ?><?php echo esc_attr($imageurl[0]);?>',<?php endif; ?> <?php if ( ! empty( $item['progression_map_title'] ) ) : ?>html: {content: "<div class='google-maps-pin'><h6 class='boosted-elements-progression-map-title'><?php echo esc_attr($item['progression_map_title'] ); ?></h6><div class='boosted-elements-progression-map-content'><?php echo wp_kses( __($item['progression_map_content'] ), true); ?></div></div>", popup:<?php if ( ! empty( $item['progressio_map_maker_open'] ) ) : ?>true<?php else: ?>false<?php endif; ?>}<?php endif; ?>},
				<?php endforeach; ?>
		],
		scrollwheel: <?php if ( ! empty( $settings['map_option_mapscroll'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,  disableDoubleClickZoom: false, zoom: <?php $width = $this->get_settings( 'map_zoom' );  echo esc_attr($width['size']);  ?>, maptype: '<?php echo esc_attr($settings['map_type'] ); ?>', streetViewControl:	<?php if ( ! empty( $settings['map_option_streeview'] ) ) : ?>true<?php else: ?>false<?php endif; ?>, oneInfoWindow: <?php if ( ! empty( $settings['map_option_single_pin'] ) ) : ?>true<?php else: ?>false<?php endif; ?>, mapTypeControl:<?php if ( ! empty( $settings['map_option_maptype_control'] ) ) : ?>true<?php else: ?>false<?php endif; ?>	
    });
	});
	</script>

	<?php
	
	}

	protected function content_template(){}
		
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsMap() );