<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsTemplate extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-templated';
	}

	public function get_title() {
		return esc_html__( 'Template - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-document-file boosted-elements-progression-icon';
	}

   public function get_categories() {
		return [ 'boosted-elements-progression' ];
	}
	
	protected function register_controls() {

		
  		$this->start_controls_section(
  			'section_title_boosted_global_options',
  			[
  				'label' => esc_html__( 'Template Options', 'boosted-elements-progression' )
  			]
  		);
		

		$this->add_control(
			'template_choice',
			[
				'label' => esc_html__( 'Choose a Template', 'boosted-elements-progression' ),
                'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => boosted_template_list(),
			]
		);

		
		$this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>

	<div class="boosted-elements-progression-template-container">
        
			<?php
			
			if ( !empty($settings['template_choice']) ) {
	            $frontend = new \Elementor\Frontend;
	            echo $frontend->get_builder_content_for_display($settings['template_choice'], true);
	        }else {
            echo "<h5>" . esc_attr('Please choose a template', 'boosted-elements-progression') ."</h5>";
            }
            
			?>
			
	</div><!-- close .boosted-elements-progression-template-container -->
	
	
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsTemplate() );