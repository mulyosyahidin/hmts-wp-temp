<?php
namespace DynamicContentForElementor;

use DynamicContentForElementor\Documents\PageSettings_Scrollify;
use DynamicContentForElementor\Documents\PageSettings_InertiaScroll;
use DynamicContentForElementor\Helper;
use DynamicContentForElementor\Core\Upgrade\Manager as UpgradeManager;

/**
 * Main Plugin Class
 *
 * @since 0.0.1
 */
class Plugin {

	/**
	 * @var UpgradeManager
	 */
	public $upgrade;

	/**
	 * Constructor
	 *
	 * @since 0.0.1
	 *
	 * @access public
	 */
	public function __construct() {
		$this->init();
	}

	public function init() {

		// Instance classes
		$this->instances();

		// Add WPML Compatibility
		add_action( 'wpml_loaded', array( $this, 'init_wpml_compatibility' ) );

		add_action( 'admin_menu', array( $this, 'add_dce_menu' ), 200 );

		// fire actions
		add_action( 'elementor/init', array( $this, 'add_dce_to_elementor' ), 0 );

		add_filter( 'plugin_action_links_' . DCE_PLUGIN_BASE, '\DynamicContentForElementor\Plugin::dce_plugin_action_links_config' );

		add_filter( 'pre_handle_404', [ $this, 'dce_allow_posts_pagination' ], 999, 2 );

	}

	public function instances() {
		$this->controls = new Controls();
		$this->extensions = new Extensions();
		$this->documents = new Documents();
		$this->settings = new Settings();
		$this->info = new Info();
		$this->widgets = new Widgets();
		new Ajax();
		new Assets();
		new Dashboard();
		new License();
		new TemplateSystem();

		new DCE_Query();
	}

	private function init_wpml_compatibility() {
			new Compatibility\WPML();
	}

	/**
	 * Add Actions
	 *
	 * @since 0.0.1
	 *
	 * @access private
	 */
	public function add_dce_to_elementor() {

		// Global Settings Panel
		\DynamicContentForElementor\Includes\Settings\Settings_Manager::init();

		$this->upgrade = UpgradeManager::instance();
		// Controls
		add_action('elementor/controls/controls_registered', [ $this->controls, 'on_controls_registered' ]);

		// Controls Manager
		\Elementor\Plugin::$instance->controls_manager = new DCE_Controls_Manager( \Elementor\Plugin::$instance->controls_manager );

		// Extensions
		$this->extensions->on_extensions_registered();

		// Documents
		$this->documents->on_documents_registered();

		// Widgets
		add_action('elementor/widgets/widgets_registered', [ $this->widgets, 'on_widgets_registered' ]);

	}

	public function add_dce_menu() {
		// TemplateSystem sotto Template
		if ( defined('\Elementor\TemplateLibrary\Source_Local::ADMIN_MENU_SLUG') && current_user_can('manage_options') ) {
			add_submenu_page(
				\Elementor\TemplateLibrary\Source_Local::ADMIN_MENU_SLUG,
				__('Dynamic Template System', 'dynamic-content-for-elementor'),
				__('Template System', 'dynamic-content-for-elementor'),
				'publish_posts',
				'dce_templatesystem',
				array(
					$this->settings,
					'dce_setting_templatesystem',
				)
			);
		}

		// Dynamic Content sotto Elementor
		add_submenu_page(
			\Elementor\Settings::PAGE_ID,
			__('Dynamic Content Settings', 'dynamic-content-for-elementor'),
			__('Dynamic Content', 'dynamic-content-for-elementor'),
			'manage_options',
			'dce_opt',
			[
				$this->settings,
				'dce_setting_page',
			]
		);

		// La pagina Informazioni che appare alla prima attivazione del plugin.
		add_submenu_page(
				'admin.php', __('Dynamic Content for Elementor', 'dynamic-content-for-elementor'), __('Dynamic Content for Elementor', 'dynamic-content-for-elementor'), 'manage_options', 'dce_info', array(
					$this->info,
					'dce_information_plugin',
				)
		);
	}

	public static function dce_plugin_action_links_config( $links ) {
		$links['config'] = '<a title="Configuration" href="' . admin_url() . 'admin.php?page=dce_opt">' . __('Configuration', 'dynamic-content-for-elementor') . '</a>';
		return $links;
	}

	public function dce_allow_posts_pagination( $preempt, $wp_query ) {

		if ( $preempt || empty( $wp_query->query_vars['page'] ) || empty( $wp_query->post ) || ! is_singular() ) {
			return $preempt;
		}

		$allow_pagination = false;
		$document = '';
		$current_post_id = $wp_query->post->ID;
		$dce_posts_widgets = [ 'dyncontel-acfposts', 'dce-dynamicposts-v2', 'dyncontel-dynamicusers' ];

		// Check if current post/page is built with Elementor and check for DCE posts pagination
		if ( \Elementor\Plugin::$instance->db->is_built_with_elementor( $current_post_id ) && ! $allow_pagination ) {
			$allow_pagination = $this->dce_check_posts_pagination( $current_post_id, $dce_posts_widgets );
		}

		// Check if single DCE template is active and check for DCE posts pagination in template
		if ( ! get_option('dce_template_disable') && ! $allow_pagination ) {
			$options = get_option('dyncontel_options');
			$post_type = get_post_type($current_post_id);

			if ( $options[ 'dyncontel_field_single' . $post_type ] ) {
				$allow_pagination = $this->dce_check_posts_pagination( $options[ 'dyncontel_field_single' . $post_type ], $dce_posts_widgets );
			}
		}

		// Check if single Elementor Pro template is active and check for DCE posts pagination in template
		if ( Helper::is_elementorpro_active() && ! $allow_pagination ) {
			$locations = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_locations_manager()->get_locations();

			if ( isset($locations['single']) ) {
				$location_docs = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager()->get_documents_for_location('single');
				if ( ! empty($location_docs) ) {
					foreach ( $location_docs as $location_doc_id => $settings ) {
						if ( ( $wp_query->post->ID !== $location_doc_id ) && ! $allow_pagination ) {
							$allow_pagination = $this->dce_check_posts_pagination( $location_doc_id, $dce_posts_widgets );
							break;
						}
					}
				}
			}
		}

		if ( $allow_pagination ) {
			return $allow_pagination;
		} else {
			return $preempt;
		}

	}

	protected function dce_check_posts_pagination( $post_id, $dce_posts_widgets, $current_page = null ) {
		$pagination = false;

		if ( $post_id ) {
			$document = \Elementor\Plugin::$instance->documents->get( $post_id );
			$document_elements = $document->get_elements_data();

			// Check if DCE posts widgets are present and if pagination or infinite scroll is active
			\Elementor\Plugin::$instance->db->iterate_data( $document_elements, function( $element ) use ( &$pagination, $dce_posts_widgets ) {
				if ( isset( $element['widgetType'] ) && in_array( $element['widgetType'], $dce_posts_widgets, true )
				) {
					if ( isset($element['settings']['pagination_enable']) ) {
						if ( $element['settings']['pagination_enable'] ) {
							$pagination = true;
						}
					}
					if ( isset($element['settings']['infiniteScroll_enable']) ) {
						if ( $element['settings']['infiniteScroll_enable'] ) {
							$pagination = true;
						}
					}
				}
			});
		}

		return $pagination;
	}

}
