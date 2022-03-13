<?php

namespace DynamicContentForElementor\Widgets;

use Elementor\Controls_Manager;

if ( ! defined('ABSPATH') ) {
	exit;
} // Exit if accessed directly

class DCE_Widget_IncludeFile extends DCE_Widget_Prototype {

	public function get_name() {
		return 'dyncontel-includefile';
	}

	public function show_in_panel() {
		if ( ! current_user_can('manage_options') ) {
			return false;
		}
		return true;
	}

	public function get_title() {
		return __('File Include', 'dynamic-content-for-elementor');
	}
	public function get_description() {
		return __('Directly include files from a path in root as if you were writing in a theme. Ideal for developers with no limits', 'dynamic-content-for-elementor');
	}
	public function get_docs() {
		return 'https://www.dynamic.ooo/widget/file-include/';
	}
	public function get_icon() {
		return 'icon-dyn-incfile';
	}

	protected function _register_controls() {
		if ( current_user_can('manage_options') || ! is_admin() ) {
			$this->register_controls_content();
		} elseif ( ! current_user_can('manage_options') && is_admin() ) {
			$this->register_controls_non_admin_notice();
		}
	}

	protected function register_controls_content() {
		$this->start_controls_section(
			'section_includefile',
			[
				'label' => __('File Include', 'dynamic-content-for-elementor'),
			]
		);
		if ( current_user_can('manage_options') ) {
			$this->add_control(
				'file',
				[
					'label' => __('Path of file', 'dynamic-content-for-elementor'),
					'description' => __('The path of file to include (e.g.:folder/file.html) ', 'dynamic-content-for-elementor'),
					'placeholder' => 'wp-content/themes/my-theme/my-custom-file.php',
					'type' => Controls_Manager::TEXT,
					'frontend_available' => true,
					'default' => '',

				]
			);
		} else {
			$this->add_control(
				'html_notice',
				[
					'type'    => Controls_Manager::RAW_HTML,
					'raw' => __('You will need administrator capabilities to edit this widget.', 'dynamic-content-for-elementor'),
					'content_classes' => 'dce-notice',
				]
			);
		}
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['file'] != '' ) {
			$problem = __('The file doesn\'t exists', 'dynamic-content-for-elementor');
			if ( current_user_can('manage_options') ) {
				$path = get_home_path();
				if ( file_exists($path . $settings['file']) ) {
					include $path . $settings['file'];
				} else {
					echo $problem;
				}
			} else {
				if ( file_exists('./' . $settings['file']) ) {
					include './' . $settings['file'];
				} else {
					echo $problem;
				}
			}
		} elseif ( current_user_can('manage_options') && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			_e('Select file', 'dynamic-content-for-elementor');
		}
	}
}
