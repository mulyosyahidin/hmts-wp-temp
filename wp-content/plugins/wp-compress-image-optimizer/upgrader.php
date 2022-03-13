<?php


class wpc_upgrader extends wps_ic {

	public static $options;

	function __construct() {

		if ( ! $this->is_latest() || ! empty($_GET['force_update'])) {
			self::$options = get_option(WPS_IC_OPTIONS);

			//$this->setup_default_options();
			if (file_exists(WPS_IC_DIR . 'local_script_decode.txt')) {
				unlink(WPS_IC_DIR . 'local_script_decode.txt');
			}

			if (file_exists(WPS_IC_DIR . 'local_script_encode_2.txt')) {
				unlink(WPS_IC_DIR . 'local_script_encode_2.txt');
			}

			// Purge CDN
			$this->purge_cdn();

			// Upgrade CDN
			$this->update_to_latest();
		}

	}


	public function upgrade() {
		return;
		$old_settings     = get_option(WPS_IC_SETTINGS);
		$default_Settings = array('js'                     => '0',
															'css'                    => '0',
															'css_image_urls'         => '0',
															'external-url'           => '0',
															'replace-all-link'       => '0',
															'emoji-remove'           => '0',
															'on-upload'              => '0',
															'defer-js'               => '0',
															'serve_jpg'              => '1',
															'serve_png'              => '1',
															'serve_gif'              => '1',
															'serve_svg'              => '1',
															'search-through'         => 'html',
															'preserve-exif'          => '0',
															'background-sizing' => '0',
															'remove-render-blocking' => '0',
															'minify-css'             => '0',
															'minify-js'              => '0');

		foreach ($default_Settings as $name => $defaultValue) {
			if ( ! isset($old_settings[ $name ]) || empty($old_settings[ $name ])) {
				$old_settings[ $name ] = $defaultValue;
			}
		}

		update_option(WPS_IC_SETTINGS, $old_settings);
	}


	public function setup_default_options() {
		$old_settings     = get_option(WPS_IC_SETTINGS);
		$default_Settings = array('js' => '0', 'css' => '0', 'css_image_urls' => '0', 'external-url' => '0', 'replace-all-link' => '0', 'emoji-remove' => '1', 'on-upload' => '0', 'defer-js' => '0', 'serve_jpg' => '1', 'serve_png' => '1', 'serve_gif' => '1', 'serve_svg' => '1', 'search-through' => 'html');

		foreach ($default_Settings as $name => $defaultValue) {
			if ( ! isset($old_settings[ $name ]) || empty($old_settings[ $name ])) {
				$old_settings[ $name ] = $defaultValue;
			}
		}

		update_option(WPS_IC_SETTINGS, $old_settings);
	}


	public function update_to_latest() {
		update_option('wpc_version', parent::$version);
	}


	public function is_latest() {
		$plugin_version = get_option('wpc_version');

		if (empty($plugin_version) || version_compare($plugin_version, parent::$version, '<')) {
			// Must Upgrade
			return false;
		}
		else {
			return true;
		}
	}


	public function purge_cdn() {
		self::purgeBreeze();
		self::purge_cache_files();

		// Clear cache.
		if (function_exists('rocket_clean_domain')) {
			rocket_clean_domain();
		}

		// Lite Speed
		if (defined('LSCWP_V')) {
			do_action('litespeed_purge_all');
		}

		// HummingBird
		if (defined('WPHB_VERSION')) {
			do_action('wphb_clear_page_cache');
		}
	}


	public static function purgeBreeze() {
		if (defined('BREEZE_VERSION')) {
			global $wp_filesystem;
			require_once(ABSPATH . 'wp-admin/includes/file.php');

			WP_Filesystem();

			$cache_path = breeze_get_cache_base_path(is_network_admin(), true);
			$wp_filesystem->rmdir(untrailingslashit($cache_path), true);

			if (function_exists('wp_cache_flush')) {
				wp_cache_flush();
			}
		}
	}


	public static function purge_cache_files() {
		$cache_dir = WPS_IC_CACHE;

		self::removeDirectory($cache_dir);

		return true;
	}


	public static function removeDirectory($path) {
		$files = glob($path . '/*');
		foreach ($files as $file) {
			is_dir($file) ? self::removeDirectory($file) : unlink($file);
		}

		return;
	}


	public function upgrade_cdn() {
		$url = 'https://keys.wpmediacompress.com/?action=updateCDN&apikey=' . self::$options['api_key'] . '&site=' . site_url();

		$call = wp_remote_get($url, array('timeout'    => 10,
																			'sslverify'  => 'false',
																			'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:20.0) Gecko/20100101 Firefox/20.0'));
	}


}