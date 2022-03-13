<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_BoostedElementsLogo extends Widget_Base {

	public function get_name() {
		return 'boosted-elements-logog';
	}

	public function get_title() {
		return esc_html__( 'Logo - Boosted', 'boosted-elements-progression' );
	}

	public function get_icon() {
		return 'eicon-logo boosted-elements-progression-icon';
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
			'custom_image',
			[
				'label' => esc_html__( 'Custom Image', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
        
		$this->add_control(
			'boosted_elements_logo_custom',
			[
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'custom_image' => 'yes',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
                'default' => 'full',
				'condition' => [
					'custom_image' => 'yes',
				],
			]
		);
        
		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__( 'Logo Width', 'boosted-elements-progression' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-logo-container img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
		$this->add_responsive_control(
			'logo_align',
			[
				'label' => esc_html__( 'Menu Align', 'boosted-elements-progression' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'boosted-elements-progression' ),
						'icon' => 'eicon-h-align-right',
                    ]
				],
				'selectors' => [
					'{{WRAPPER}} .boosted-elements-logo-container' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'text-align:left;',
					'center' => 'text-align:center;',
					'right' => 'text-align:right;',
				],
			]
		);
        
        
		$this->add_control(
			'logo_link',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Logo Link', 'boosted-elements-progression' ),
				'options' => [
					'default' => esc_html__( 'Default', 'boosted-elements-progression' ),
                    'none' => esc_html__( 'None', 'boosted-elements-progression' ),
					'custom_url' => esc_html__( 'Custom URL', 'boosted-elements-progression' ),
				],
                'default' => 'default',
			]
		);
        
		$this->add_control(
			'custom_logo_url',
			[
				'label' => esc_html__( 'Link', 'boosted-elements-progression' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#!',
				],
				'placeholder' => 'https://progressionstudios.com',
				'label_block' => true,
				'condition' => [
					'logo_link' => 'custom_url',
				],
			]
		);


		$this->end_controls_section();

		
	}


	protected function render( ) {
		
      $settings = $this->get_settings();
		

	?>
    
	<div class="boosted-elements-logo-container">
 
            <?php if ( $settings['logo_link'] != 'none' ) : ?>
                <?php if ( $settings['logo_link'] == 'default' ) : ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php endif; ?>
                <?php if ( $settings['logo_link'] == 'custom_url' ) : ?><a href="<?php echo esc_url($settings['custom_logo_url']['url']); ?>" <?php if ( ! empty( $settings['custom_logo_url']['is_external'] ) ) : ?>target="_blank"<?php endif; ?> <?php if ( ! empty( $settings['custom_logo_url']['nofollow'] ) ) : ?>rel="nofollow"<?php endif; ?>><?php endif; ?>
            <?php endif; ?>
            
            
            <?php if ( $settings['custom_image'] == 'yes' ) : ?>
                
				<?php $image = $settings['boosted_elements_logo_custom'];  $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings ); ?>
				<img src="<?php echo esc_url($image_url);?>" alt="<?php bloginfo('name'); ?>">
                
            <?php else: ?>
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                }
                ?>
            <?php endif; ?>
            
            
            <?php if ( $settings['logo_link'] != 'none' ) : ?></a><?php endif; ?>
            
        
	</div><!-- close .boosted-elements-logo-container -->
	
	
	<?php
	
	}

	protected function content_template(){}

}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_BoostedElementsLogo() );