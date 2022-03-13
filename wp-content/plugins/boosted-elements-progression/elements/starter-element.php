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
		return 'far fa-keyboard boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
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

		
		$this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

	<div class="boosted-elements-progression-animated-typing-container">			
			
	</div><!-- close .boosted-elements-progression-animated-typing-container -->
	
	
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsAnimated_Typing() );