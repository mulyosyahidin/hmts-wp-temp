<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsCountdown extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-countdown';
	}

	public function get_title() {
		return esc_html__( 'Countdown - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-countdown boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_countdown_js' ]; 
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Countdown Settings', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_time',
			[
				'label' => esc_html__( 'Time for Countdown', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date("Y-m-d", strtotime("+ 1 day")),
				'description' => esc_html__( 'Example Date: 2020-01-22 01:30', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_control(
			'boosted_elements_days',
			[
				'label' => esc_html__( 'Display Days', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'boosted_elements_hours',
			[
				'label' => esc_html__( 'Display Hours', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		

		$this->add_control(
			'boosted_elements_minutes',
			[
				'label' => esc_html__( 'Display Minutes', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'boosted_elements_seconds',
			[
				'label' => esc_html__( 'Display Seconds', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_text_description',
  			[
  				'label' => esc_html__( 'Countdown Text', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_control(
			'boosted_elements_columns_force_two',
			[
				'label' => esc_html__( 'Column Display', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted-elements-default-column',
				'options' => [
					'boosted-elements-default-column' => esc_html__( 'Default', 'boosted-elements-progression' ),
					'boosted-elements-force-two-column' => esc_html__( 'Two Columns', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_days_text_position',
			[
				'label' => esc_html__( 'Text Position', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'boosted_elements_text_position_default',
				'options' => [
					'boosted_elements_text_position_default' => esc_html__( 'Underneath', 'boosted-elements-progression' ),
					'boosted_elements_text_position_inline' => esc_html__( 'Inline', 'boosted-elements-progression' ),
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_days_text',
			[
				'label' => esc_html__( 'Days Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'days', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Leave blank to hide', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_control(
			'boosted_elements_days_hours',
			[
				'label' => esc_html__( 'Hours Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'hours', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Leave blank to hide', 'boosted-elements-progression' ),
			]
		);
		
		
		$this->add_control(
			'boosted_elements_days_minutes',
			[
				'label' => esc_html__( 'Minutes Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'mins', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Leave blank to hide', 'boosted-elements-progression' ),
			]
		);
		
		
		$this->add_control(
			'boosted_elements_days_seconds',
			[
				'label' => esc_html__( 'Seconds Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'secs', 'boosted-elements-progression' ),
				'description' => esc_html__( 'Leave blank to hide', 'boosted-elements-progression' ),
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title_styles_boosted_countdown_container',
			[
				'label' => esc_html__( 'Countdown Main Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		
		

		$this->add_control(
			'boosted_elements_countdown_background',
			[
				'label' => esc_html__( 'Background Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-segment' => 'background: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_countdown_main_margin_right',
			[
				'label' => esc_html__( 'Space Between Timer', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-segment' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
					'{{WRAPPER}} .boosted-elements-progression-countdown-container' => 'margin-right: -{{SIZE}}px; margin-left: -{{SIZE}}px;',
				],
			]
		);
		
		$this->add_responsive_control(
			'boosted_elements_countdown_main_margin_bottom',
			[
				'label' => esc_html__( 'Space Below Timer', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .boosted-elements-timer-segment' => 'margin-bottom:{{SIZE}}px;',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_countdown_main_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-segment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'boosted_elements_countdown_main_border_main',
				'label' => esc_html__( 'Border', 'boosted-elements-progression' ),
				'selector' => '{{WRAPPER}} .boosted-elements-timer-segment',
			]
		);

		$this->add_control(
			'boosted_elements_countdown_main_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-segment' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_title_styles_boosted_countdown_timer',
			[
				'label' => esc_html__( 'Countdown Time', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_countdown_time_color',
			[
				'label' => esc_html__( 'Time Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-digit' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .boosted-elements-timer-digit',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-timer-digit',
			]
		);
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_title_styles_boosted_countdown_text',
			[
				'label' => esc_html__( 'Countdown Text', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'boosted_elements_countdown_text_color',
			[
				'label' => esc_html__( 'Text Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'boosted_elements_countdown_text_padding_left',
			[
				'label' => esc_html__( 'Padding Left', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-timer-text' => 'padding-left:{{SIZE}}px;',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography_two',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .boosted-elements-timer-text',
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'countdown_bottom_text_shadow',
				'selector' => '{{WRAPPER}} .boosted-elements-timer-text',
			]
		);
		
		$this->end_controls_section();
		
		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		
		$originalDateFormat =  esc_attr($settings['boosted_elements_time']);
		$NewDateFormat = date("M d Y G:i:s", strtotime($originalDateFormat));
		
	
	?>
	
	
	

	<div class="boosted-elements-progression-countdown-container-overflow">
		<div class="boosted-elements-progression-countdown-container <?php echo esc_attr($settings['boosted_elements_days_text_position'] ); ?> <?php echo esc_attr($settings['boosted_elements_columns_force_two'] ); ?>">		
			<ul id="boosted-elements-progression-countdown-js-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-progression-timer" data-date="<?php echo esc_attr($NewDateFormat) ; ?>">
			    <?php if ( ! empty( $settings['boosted_elements_days'] ) ) : ?><li class="boosted-elements-timer-float"><div class="boosted-elements-timer-segment"><span data-days class="boosted-elements-timer-digit">0</span><?php if ( ! empty( $settings['boosted_elements_days_text'] ) ) : ?><span class="boosted-elements-timer-text"><?php echo esc_attr($settings['boosted_elements_days_text'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			    <?php if ( ! empty( $settings['boosted_elements_hours'] ) ) : ?><li class="boosted-elements-timer-float"><div class="boosted-elements-timer-segment"><span data-hours class="boosted-elements-timer-digit">0</span><?php if ( ! empty( $settings['boosted_elements_days_hours'] ) ) : ?><span class="boosted-elements-timer-text"><?php echo esc_attr($settings['boosted_elements_days_hours'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			   <?php if ( ! empty( $settings['boosted_elements_minutes'] ) ) : ?><li class="boosted-elements-timer-float"><div class="boosted-elements-timer-segment"><span data-minutes class="boosted-elements-timer-digit">0</span><?php if ( ! empty( $settings['boosted_elements_days_minutes'] ) ) : ?><span class="boosted-elements-timer-text"><?php echo esc_attr($settings['boosted_elements_days_minutes'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			   <?php if ( ! empty( $settings['boosted_elements_seconds'] ) ) : ?><li class="boosted-elements-timer-float"><div class="boosted-elements-timer-segment"><span data-seconds class="boosted-elements-timer-digit">0</span><?php if ( ! empty( $settings['boosted_elements_days_seconds'] ) ) : ?><span class="boosted-elements-timer-text"><?php echo esc_attr($settings['boosted_elements_days_seconds'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
			</ul><!-- close .boosted-elements-progression-timer -->
			<div class="clearfix-boosted-element"></div>
		</div><!-- close .boosted-elements-progression-countdown-container -->
	</div><!-- close .boosted-elements-progression-countdown-container-overflow -->
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		'use strict';
		$("#boosted-elements-progression-countdown-js-<?php echo esc_attr($this->get_id()); ?>").countdown();
	});
	</script>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsCountdown() );