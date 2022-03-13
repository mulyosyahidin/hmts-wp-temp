<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsAnimated_Typing extends Widget_Base {
	

	public function get_name() {
		return 'boosted-elements-animated-typing';
	}

	public function get_title() {
		return esc_html__( 'Animated Typing - Boosted', 'boosted-elements-progression' );
	}
	public function get_icon() {
		return 'eicon-animation-text boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	public function get_script_depends() { 
		return [ 'boosted_elements_progression_animated_js' ]; 
	}

	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Typing Text', 'boosted-elements-progression' )
  			]
  		);

		
		$this->add_control(
			'boosted_elements_typing_starting_text',
			[
				'placeholder' => esc_html__( 'Starting Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'We can bring', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_typing_starting_text', 'none' );
		
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'boosted_elements_typing_repeater_text_field',
			[
				'label' => esc_html__( 'Animated Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Additional Text', 'boosted-elements-progression' ),
			]
		);
		
		
		$this->add_control(
			'boosted_elements_typing_repeater',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'boosted_elements_typing_repeater_text_field' => esc_html__( 'Success', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_typing_repeater_text_field' => esc_html__( 'Growth', 'boosted-elements-progression' ),
					],
					[
						'boosted_elements_typing_repeater_text_field' => esc_html__( 'Profits', 'boosted-elements-progression' ),
					],
				],
				'title_field' => '{{{ boosted_elements_typing_repeater_text_field }}}',
			]
		);


		$this->add_control(
			'boosted_elements_typing_end_text',
			[
				'placeholder' => esc_html__( 'Ending Text', 'boosted-elements-progression' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'to your business', 'boosted-elements-progression' ),
			]
		);
		
		$this->add_inline_editing_attributes( 'boosted_elements_typing_end_text', 'none' );
		

		$this->end_controls_section();
		
		
  		$this->start_controls_section(
  			'section_title_boosted_typing_settings',
  			[
  				'label' => esc_html__( 'Typing Settings', 'boosted-elements-progression' )
  			]
  		);
		
		$this->add_responsive_control(
			'boosted_elements_typing_align',
			[
				'label' => esc_html__( 'Content Align', 'boosted-elements-progression' ),
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
					'{{WRAPPER}} .boosted-elements-progression-animated-typing-container' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_typing_transition_type',
			[
				'label' => esc_html__( 'Animation', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'typing',
				'options' => [
					'typing' => esc_html__( 'Typing', 'boosted-elements-progression' ),
					'fadeIn' => esc_html__( 'Fade', 'boosted-elements-progression' ),
					'fadeInUp' => esc_html__( 'Fade Up', 'boosted-elements-progression' ),
					'fadeInDown' => esc_html__( 'Fade Down', 'boosted-elements-progression' ),
					'fadeInLeft' => esc_html__( 'Fade Left', 'boosted-elements-progression' ),
					'fadeInRight' => esc_html__( 'Fade Right', 'boosted-elements-progression' ),
					'zoomIn' => esc_html__( 'Zoom', 'boosted-elements-progression' ),
					'bounceIn' => esc_html__( 'Bounce', 'boosted-elements-progression' ),
					'swing' => esc_html__( 'Swing', 'boosted-elements-progression' ),
				],
			]
		);
		

		$this->add_control(
			'boosted_elements_typing_delay',
			[
				'label' => esc_html__( 'Delay on Change', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '2500'
			]
		);

		$this->add_control(
			'boosted_elements_typing_speed',
			[
				'label' => esc_html__( 'Typing Speed', 'boosted-elements-progression' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '50',
				'condition' => [
					'boosted_elements_typing_transition_type' => 'typing',
				],
			]
		);
		
		
		$this->add_control(
			'boosted_elements_typing_loop',
			[
				'label' => esc_html__( 'Loop the Typing', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'boosted_elements_typing_transition_type' => 'typing',
				],
			]
		);
		
		$this->add_control(
			'boosted_elements_cursor',
			[
				'label' => esc_html__( 'Display Type Cursor', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'boosted_elements_typing_transition_type' => 'typing',
				],
			]
		);
		
		
		$this->end_controls_section();
		
	
		
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Starting Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-typing-starting-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-typing-starting-text',
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_repeater_text_style',
			[
				'label' => esc_html__( 'Animated Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'repeater_title_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-repeater-field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'repeater_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-repeater-field, {{WRAPPER}} .typed-cursor',
			]
		);
		
		$this->add_control(
			'repeater_title_background_color',
			[
				'label' => esc_html__( 'Background', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-repeater-field' => 'background: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'repeater_title_color_cursor_color',
			[
				'label' => esc_html__( 'Type Cusor Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .typed-cursor' => 'color: {{VALUE}};',
				],
				'condition' => [
					'boosted_elements_cursor' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'repeater_title_padding',
			[
				'label' => esc_html__( 'Padding', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-repeater-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'repeater_title_margin',
			[
				'label' => esc_html__( 'Margin', 'boosted-elements-progression' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-repeater-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'repeat_title_border_main',
				'selector' => '{{WRAPPER}} .boosted-elements-repeater-field',
			]
		);
		
		
		$this->add_control(
			'repeat_title_border_radius',
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
					'{{WRAPPER}} .boosted-elements-repeater-field' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_ending_text_style',
			[
				'label' => esc_html__( 'Ending Text Styles', 'boosted-elements-progression' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_control(
			'ending_title_color',
			[
				'label' => esc_html__( 'Color', 'boosted-elements-progression' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
				    'type' => \Elementor\Core\Schemes\Color::get_type(),
				    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-typing-ending-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'ending_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .boosted-elements-typing-ending-text',
			]
		);
		
		
		$this->end_controls_section();
		
		
		
		
	}

	
	
	
	protected function render( ) {
		
		
      $settings = $this->get_settings();
		

	?>

	<div class="boosted-elements-progression-animated-typing-container">			
			<?php if ( ! empty( $settings['boosted_elements_typing_starting_text'] ) ) : ?><span class="boosted-elements-typing-starting-text"><?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_typing_starting_text' ) . '>' . $this->get_settings( 'boosted_elements_typing_starting_text' ) . '</span>';?> </span><?php endif; ?>
			
			<?php if ( $settings['boosted_elements_typing_transition_type']  == 'typing' ) : ?>
			<span id="animated-typing-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-repeater-field"></span>
			<?php endif; ?>
			
			<?php if ( $settings['boosted_elements_typing_transition_type']  != 'typing' ) : ?>
			<span id="animated-typing-<?php echo esc_attr($this->get_id()); ?>" class="boosted-elements-repeater-field"><?php 
				$boosted_typing_text_list = "";
				foreach ( $settings['boosted_elements_typing_repeater'] as $item ) {
				           $boosted_typing_text_list .=  $item['boosted_elements_typing_repeater_text_field'] . ', '; 
				}
				echo rtrim($boosted_typing_text_list, ", "); ?></span>
			<?php endif; ?>
			
			<?php if ( ! empty( $settings['boosted_elements_typing_end_text'] ) ) : ?><span class="boosted-elements-typing-ending-text"> <?php echo '<span ' . $this->get_render_attribute_string( 'boosted_elements_typing_end_text' ) . '>' . $this->get_settings( 'boosted_elements_typing_end_text' ) . '</span>';?> </span><?php endif; ?>
	</div><!-- close .boosted-elements-progression-animated-typing-container -->
	
	<div class="clearfix-boosted-element"></div>
	
	<?php if ( $settings['boosted_elements_typing_transition_type']  == 'typing' ) : ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		'use strict';
		$("#animated-typing-<?php echo esc_attr($this->get_id()); ?>").typed({
		strings: [<?php foreach ( $settings['boosted_elements_typing_repeater'] as $item ) : ?><?php if ( ! empty( $item['boosted_elements_typing_repeater_text_field'] ) ) : ?>"<?php echo wp_kses( __($item['boosted_elements_typing_repeater_text_field'] ), true); ?>",<?php endif; ?><?php endforeach; ?>],
			typeSpeed: <?php echo esc_attr($settings['boosted_elements_typing_speed'] ); ?>,
			backSpeed: 0,
			startDelay: 300,
			backDelay: <?php echo esc_attr($settings['boosted_elements_typing_delay'] ); ?>,
			showCursor: <?php if ( ! empty( $settings['boosted_elements_cursor'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
			loop: <?php if ( ! empty( $settings['boosted_elements_typing_loop'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
		});
	});
	</script>
	<?php endif; ?>
	
	<?php if ( $settings['boosted_elements_typing_transition_type']  != 'typing' ) : ?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			'use strict';
			$("#animated-typing-<?php echo esc_attr($this->get_id()); ?>").Morphext({
				animation: "<?php echo esc_attr($settings['boosted_elements_typing_transition_type'] ); ?>",
				separator: ",",
				speed: <?php echo esc_attr($settings['boosted_elements_typing_delay'] ); ?>,
				complete: function () {
				        // Overrides default empty function
				    }
			});
		});
		</script>
	<?php endif; ?>
	
	<?php
	
	}

	protected function content_template(){}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsAnimated_Typing() );