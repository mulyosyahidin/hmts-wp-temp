<?php


/**
 * Class - Enqueues
 */
class wps_ic_enqueues extends wps_ic {

	public static $version;
	public static $slug;
	public static $css_combine;
	public static $settings;
	public static $quality;
	public static $zone_name;
	public static $js_debug;
	public static $wst;
	public static $response_key;
	public static $site_url;


	public function __construct() {
		$this::$slug        = parent::$slug;
		$this::$version     = parent::$version;
		self::$settings     = parent::$settings;
		self::$zone_name    = parent::$zone_name;
		self::$quality      = parent::$quality;
		self::$js_debug     = parent::$js_debug;
		self::$response_key = parent::$response_key;
		self::$wst          = $this->is_st();
		self::$site_url     = site_url();

		if ( ! empty($_GET['defer-test'])) {
			self::$wst = true;
		}

		if ( ! empty($_GET['trp-edit-translation']) || ! empty($_GET['elementor-preview']) || ! empty($_GET['preview']) || ! empty($_GET['tatsu']) || ( ! empty($_GET['fl_builder']) || isset($_GET['fl_builder'])) || ! empty($_GET['PageSpeed']) || ! empty($_GET['et_fb']) || ! empty($_GET['tve']) || ! empty($_GET['fb-edit']) || ! empty($_GET['bricks']) || ! empty($_GET['ct_builder']) || ( ! empty($_SERVER['SCRIPT_URL']) && $_SERVER['SCRIPT_URL'] == "/wp-admin/customize.php" || strpos($_SERVER['REQUEST_URI'],
																																																																																																																																																																																																																																																	'wp-login.php') !== false)) {
			// Do nothing
		}
		else {

			if ( ! empty($_GET['dbg']) && $_GET['dbg'] == 'combine') {
				add_action('wp_print_styles', array($this, 'enqueue_css_print'), PHP_INT_MAX);
			}

			if ( ! isset($_GET['wpc_is_amp']) || empty($_GET['wpc_is_amp'])) {
				add_action('wp_print_scripts', array($this, 'inline_frontend'), 1);
				add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend'), 1);
				add_action('admin_enqueue_scripts', array($this, 'enqueue_all'));

				// Remove CSS/Js Version - Required for CDN
				add_filter('style_loader_src', array($this, 'remove_css_js_version'), 9999);
				add_filter('script_loader_src', array($this, 'remove_css_js_version'), 9999);

				if ( ! empty(self::$settings['defer-js']) && self::$settings['defer-js'] == '1') {
					add_filter('script_loader_tag', array($this, 'defer_parsing_of_js'), 10, 3);
				}

				if (self::$wst) {
					add_filter('script_loader_tag', array($this, 'async_parsing_of_js'), 10, 3);
					add_filter('script_loader_tag', array($this, 'defer_parsing_of_js'), 10, 3);
				}

			}

		}

	}


	public function enqueue_css_print() {
		global $css_run;

		wp_styles(); //ensure styles is initialised
		global $wp_styles;

		$comined_css = '';
		$combined    = array();
		$uriRewrite  = new Minify_CSS_UriRewriter();

		$frontend = rtrim(ABSPATH, '/');
		if ( ! $frontend) {
			$frontend = parse_url(get_option('home'));
			$frontend = ! empty($frontend['path']) ? $frontend['path'] : '';
			$frontend = $_SERVER['DOCUMENT_ROOT'] . $frontend;
		}

		$frontend           = realpath($frontend);
		$modified_css_files = get_option('wps_ic_modified_css_cache');

		if (empty($modified_css_files)) {
			$modified_css_files = array();
		}

		$cache_dir = WPS_IC_CACHE;
		$cache_url = WPS_IC_CACHE_URL;

		$combined['deps']     = array();
		$combined['file_dir'] = $cache_dir . 'combined.css';
		$combined['file_url'] = $cache_url . 'combined.css';

		// Print all loaded Styles (CSS)
		global $wp_styles;

		foreach ($wp_styles->queue as $style) {

			if ($style == 'admin-bar') {
				continue;
			}

			$deps    = $wp_styles->registered[ $style ]->deps;
			$handle  = $wp_styles->registered[ $style ]->handle;
			$css_url = $wp_styles->registered[ $style ]->src;
			$extra   = $wp_styles->registered[ $style ]->extra;
			$after   = $extra['after'];

			if (strpos($css_url, 'google') !== false) {
				wp_deregister_style($style);
				wp_dequeue_style($style);
			}

			if (strpos($css_url, self::$site_url) === false && preg_match('/(\/wp-content\/[^\"\'=\s]+\.(css|js))/', $css_url) == 0 && preg_match('/(\/wp-includes\/[^\"\'=\s]+\.(css|js))/', $css_url) == 0) {
				continue;
			}

			$css_basename = basename($css_url);
			$css_basename = explode('?', $css_basename);
			$css_basename = $css_basename[0];
			$css_path     = str_replace(self::$site_url . '/', '', $css_url);
			$css_path     = explode('?', $css_path);
			$css_path     = ABSPATH . $css_path[0];

			$css_md5_original = filesize($css_path);
			if (in_array($handle, $modified_css_files)) {
				// In array, check if changed
				$css_old_m5 = $modified_css_files[ $handle ]['size'];
				if ($css_md5_original !== $css_old_m5) {
					// File has changed
					$modified_css_files[ $handle ]['size'] = $css_md5_original;
				}
				else {
					// Do nothing;
					continue;
				}
			}
			else {
				// Not in array
				$modified_css_files[ $handle ]['size'] = $css_md5_original;
			}

			// Works
			$modified_css_files[ $handle ]['deps']           = $deps;
			$modified_css_files[ $handle ]['cache_dir_file'] = $cache_dir . '/' . $handle . '-' . $css_basename;
			$modified_css_files[ $handle ]['cache_uri_file'] = $cache_url . '/' . $handle . '-' . $css_basename;
			$modified_css_files[ $handle ]['after']          = $after;

			// For Combined
			foreach ($deps as $k => $dep) {
				if ( ! in_array($dep, $combined['deps'])) {
					$combined['deps'][] = $dep;
				}
			}

			$css_contents = file_get_contents($css_path);
			if ( ! empty($css_contents)) {
				wp_deregister_style($style);
				wp_dequeue_style($style);

				$url_parsed = parse_url($this->ensure_scheme($css_url));

				if (substr($url_parsed['path'], 0, 1) === '/') {
					$file_path_ori = $_SERVER['DOCUMENT_ROOT'] . $url_parsed['path'];
				}
				else {
					$file_path_ori = $frontend . '/' . $url_parsed['path'];
				}

				$css_contents = $uriRewrite::rewrite($css_contents, dirname($file_path_ori));

				#$comined_css = preg_replace("/url\(\s*['\"]?(?!data:)(?!http)(?![\/'\"])(.+?)['\"]?\s*\)/i", "url(" . dirname($file_path_ori) . "/$1)", $comined_css);
				#$comined_css = preg_replace_callback('/(https?\:\/\/|\/\/)[^\s]+\S+\.(jpg|jpeg|png|gif|css|js|svg|woff|eot|ttf|woff2)/', array('wps_addon_cdn', 'obstart_replace_url_in_css'), $comined_css);
				#$comined_css = preg_replace_callback('/(?:("|\'))(?:(..\/|\/))wp-content\/[^\"\'=\s]+\.(jpg|jpeg|png|gif|svg)(?:("|\'))/', array('wps_addon_cdn', 'replace_path_css'), $comined_css);

				// Combine all css in one large file
				$comined_css .= $css_contents;

			}

		}

		// Combine all css in one large file
		if ( ! empty($combined['deps'])) {
			foreach ($combined['deps'] as $k => $dep) {
				wp_enqueue_style($dep);
			}
		}

		if ( ! file_exists($combined['file_dir'])) {
			$fp = fopen($combined['file_dir'], 'w+');

			fclose($fp);
		}

		file_put_contents($combined['file_dir'], $comined_css);

		if ( ! empty($combined) && file_exists($combined['file_dir']) && filesize($combined['file_dir']) > 0) {
			$combined_url = str_replace('https://www.wpcompress.com/', '', $combined['file_url']);
			$combined_url = str_replace('https://wpcompress.com/', '', $combined_url);
			wp_register_style('wps-ic-combined', 'https://' . self::$zone_name . '/' . $combined_url, array(), false, 'all');
			wp_enqueue_style('wps-ic-combined');
		}

		$css_run = 1;
		set_transient('wps_ic_css_cache', 'true', 2 * 60);
	}


	private function ensure_scheme($url) {
		return preg_replace("/(http(s)?:\/\/|\/\/)(.*)/i", "http$2://$3", $url);
	}


	public function remove_css_js_version($src) {
		if ( ! empty(self::$settings['css']) && self::$settings['css'] == '1') {
			// Remove for CSS Files
			if (strpos($src, '.css')) {
				if (strpos($src, '?ver=')) {
					$src = remove_query_arg('ver', $src);
				}
			}
		}

		if ( ! empty(self::$settings['js']) && self::$settings['js'] == '1') {
			// Remove for JS Files
			if (strpos($src, '.js')) {
				if (strpos($src, '?ver=')) {
					$src = remove_query_arg('ver', $src);
				}
			}
		}

		return $src;
	}


	/**
	 * Detect tests
	 * @return bool
	 */
	public function is_st() {
		if ( ! empty($_GET['ic_lazy'])) {
			return false;
		}

		if ( ! empty($_GET['write_speedtest_log'])) {
			$fp = fopen(WPS_IC_DIR . 'speedtest.txt', 'a+');
			fwrite($fp, 'IP: ' . $_SERVER['REMOTE_ADDR'] . "\r\n");
			fwrite($fp, 'User Agent: ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n");
			fclose($fp);
		}

		if (is_admin() || empty($_SERVER['HTTP_USER_AGENT']) || empty($_SERVER['REMOTE_ADDR'])) {
			return false;
		}

		$ip_list = array(0  => '52.162.212.163',
										 1  => '13.78.216.56',
										 2  => '65.52.113.236',
										 3  => '52.229.122.240',
										 4  => '172.255.48.147',
										 5  => '172.255.48.146',
										 6  => '172.255.48.145',
										 7  => '172.255.48.144',
										 8  => '172.255.48.143',
										 9  => '172.255.48.142',
										 10 => '208.70.247.157',
										 11 => '172.255.48.141',
										 12 => '172.255.48.140',
										 13 => '172.255.48.139',
										 14 => '172.255.48.138',
										 15 => '172.255.48.137',
										 16 => '172.255.48.136',
										 17 => '172.255.48.135',
										 18 => '172.255.48.134',
										 19 => '172.255.48.133',
										 20 => '172.255.48.132',
										 21 => '172.255.48.131',
										 22 => '172.255.48.130',
										 23 => '104.214.48.247',
										 24 => '40.74.243.176',
										 25 => '40.74.243.13',
										 26 => '40.74.242.253',
										 27 => '13.85.82.26',
										 28 => '13.85.24.90',
										 29 => '13.85.24.83',
										 30 => '13.66.7.11',
										 31 => '104.214.72.101',
										 32 => '191.235.99.221',
										 33 => '191.235.98.164',
										 34 => '104.41.2.19',
										 35 => '104.211.165.53',
										 36 => '104.211.143.8',
										 37 => '172.255.61.40',
										 38 => '172.255.61.39',
										 39 => '172.255.61.38',
										 40 => '172.255.61.37',
										 41 => '172.255.61.36',
										 42 => '172.255.61.35',
										 43 => '172.255.61.34',
										 44 => '65.52.36.250',
										 45 => '70.37.83.240',
										 46 => '104.214.110.135',
										 47 => '157.55.189.189',
										 48 => '191.232.194.51',
										 49 => '52.175.57.81',
										 50 => '52.237.236.145',
										 51 => '52.237.250.73',
										 52 => '52.237.235.185',
										 53 => '40.83.89.214',
										 54 => '40.123.218.94',
										 55 => '102.133.169.66',
										 56 => '52.172.14.87',
										 57 => '52.231.199.170',
										 58 => '52.246.165.153',
										 59 => '13.76.97.224',
										 60 => '13.53.162.7',
										 61 => '20.52.36.49',
										 62 => '20.188.63.151',
										 63 => '51.144.102.233',
										 64 => '23.96.34.105');

		#$x11        = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'x11');
		$pingdom    = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'pingdom');
		$pingdombot = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'pingbot');
		$gtmetrix   = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'gtmetrix');
		$pageSpeed  = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'pagespeed');
		$google     = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'google page speed');
		$google_ps  = strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'lighthouse');

		if ( ! empty($_GET['simulate_test'])) {
			return true;
		}

		if ($pingdom !== false) {
			return true;
		}

		if ($pingdombot !== false) {
			return true;
		}

		if ($pageSpeed !== false) {
			return true;
		}

		if ($gtmetrix !== false) {
			return true;
		}

		if ($google !== false) {
			return true;
		}

		if ($google_ps !== false) {
			return true;
		}

		$userIP = $_SERVER['REMOTE_ADDR'];
		if (in_array($userIP, $ip_list)) {
			return true;
		}
		else {
			return false;
		}
	}


	public function defer_wpc_scripts($tag, $handle, $src) {
		$defer = array('block-library',
			'dashicons');

		if (in_array($handle, $defer)) {
			#return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
		}

		return $tag;
	}


	public function inline_frontend() {
		echo '<style type="text/css">';

		echo '.wps-ic-lazy-image {opacity:0;}';
		echo '.wps-ic-no-lazy-loaded {opacity:1;}';
		echo '.ic-fade-in {
animation: ICfadeIn ease 1s;
-webkit-animation: ICfadeIn ease 1s;
-moz-animation: ICfadeIn ease 1s;
-o-animation: ICfadeIn ease 1s;
-ms-animation: ICfadeIn ease 1s;
}
@keyframes ICfadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-moz-keyframes ICfadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-webkit-keyframes ICfadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-o-keyframes ICfadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-ms-keyframes ICfadeIn {
0% {opacity:0;}
100% {opacity:1;}
}';
		echo '</style>';
	}


	public function defer_parsing_of_css($tag, $handle, $src) {
		if (is_admin()) {
			echo $tag;
		} //don't break WP Admin

		if (false === strpos($src, '.css')) {
			echo $tag;
		}

		echo str_replace(' href', ' async href', $tag);
	}


	public function async_parsing_of_js($tag, $handle, $src) {
		if (is_admin()) {
			return $tag;
		} //don't break WP Admin

		if (false === strpos($src, '.js')) {
			return $tag;
		}

		$tag = str_replace(' src=', ' async src=', $tag);

		return $tag;
	}


	public function defer_parsing_of_js($tag, $handle, $src) {
		if (is_admin()) {
			return $tag;
		} //don't break WP Admin

		if (false === strpos($src, '.js')) {
			return $tag;
		}

		if (strpos($tag, 'hooks') !== false || strpos($tag, 'i18n') !== false || strpos($tag, 'jquery.js') !== false || strpos($tag, 'jquery.min.js') !== false || strpos($tag, 'jquery-migrate') !== false) {
			return $tag;
		}

		$tag = str_replace(' src=', ' defer src=', $tag);

		return $tag;
	}


	public function enqueue_frontend() {
		$options = self::$settings;

		$webp = 'true';
		if (empty($options['generate_webp']) || $options['generate_webp'] == '0') {
			$webp = 'false';
		}

		$adaptive = 'true';
		if (empty($options['generate_adaptive']) || $options['generate_adaptive'] == '0') {
			$adaptive = 'false';
		}

		$background_sizing = 'false';
		if (!empty($options['background-sizing']) && $options['background-sizing'] == '1') {
			$background_sizing = 'true';
		}

		$retina = 'true';
		if (empty($options['retina']) || $options['retina'] == '0') {
			$retina = 'false';
		}

		$exif = 'false';
		if ( ! empty($options['preserve_exif']) && $options['preserve_exif'] == '1') {
			$exif = 'true';
		}

		if (is_user_logged_in() && current_user_can('manage_options')) {
			// Required for Admin Bar
			wp_enqueue_style($this::$slug . '-admin-bar', WPS_IC_URI . 'assets/css/admin-bar.min.css', array(), '1.0.0');
			wp_enqueue_script($this::$slug . '-admin-bar-js', WPS_IC_URI . 'assets/js/admin-bar' . WPS_IC_MIN . '.js', array('jquery'), $this::$version, true);
		}

		if (( ! empty($options['lazy']) && $options['lazy'] == '1')) {

			if ( ! empty($options['live-cdn']) && $options['live-cdn'] == '1') {
				wp_enqueue_script($this::$slug . '-aio', WPS_IC_URI . 'assets/js/all-in-one' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
				wp_enqueue_script($this::$slug . '-lazy', WPS_IC_URI . 'assets/js/new-lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
			}
			else {
				wp_enqueue_script($this::$slug . '-aio', WPS_IC_URI . 'assets/js/all-in-one' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
				wp_enqueue_script($this::$slug . '-lazy', WPS_IC_URI . 'assets/js/local.lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
			}

			if ( ! empty($_GET['remove_lazy'])) {

				wp_deregister_script($this::$slug . '-lazy');
				wp_dequeue_script($this::$slug . '-lazy');
				#wp_enqueue_script($this::$slug . '-lazy', WPS_IC_URI . 'assets/js/lazy.js', array('jquery'), $this::$version);

			}

			if (self::is_st()) {
				$st = '1';
			}
			else {
				$st = '0';
			}

			if ( ! empty($_GET['dbg']) && $_GET['dbg'] == 'direct') {
				if ( ! empty($_GET['webp']) && $_GET['webp'] == 'true') {
					$webp = 'true';
				}
				else {
					$webp = 'false';
				}

				if ( ! empty($_GET['retina']) && $_GET['retina'] == 'true') {
					$retina = 'true';
				}
				else {
					$retina = 'false';
				}
			}

			wp_localize_script($this::$slug . '-lazy', 'wpc_vars', array('siteurl'           => site_url(),
																																	 'api_url'           => 'https://' . self::$zone_name . '/',
																																	 'quality'           => self::$quality,
																																	 'ajaxurl'           => admin_url('admin-ajax.php'),
																																	 'spinner'           => WPS_IC_URI . 'assets/images/spinner.svg',
																																	 'background_sizing' => $background_sizing,
																																	 'webp_enabled'      => $webp,
																																	 'retina_enabled'    => $retina,
																																	 'exif_enabled'      => $exif,
																																	 'adaptive_enabled'  => $adaptive,
																																	 'speed_test'        => $st,
																																	 'js_debug'          => self::$js_debug));

		}
		else {

			if ( ! empty($options['live-cdn']) && $options['live-cdn'] == '1') {
				// Live CDN Enabled
				wp_enqueue_script($this::$slug . '-aio', WPS_IC_URI . 'assets/js/all-in-one-no-lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
				wp_enqueue_script($this::$slug . '-no-lazy', WPS_IC_URI . 'assets/js/no-lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
			}
			else {
				// Live CDN Disabled
				wp_enqueue_script($this::$slug . '-aio', WPS_IC_URI . 'assets/js/all-in-one-no-lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
				wp_enqueue_script($this::$slug . '-no-lazy', WPS_IC_URI . 'assets/js/local.no-lazy' . WPS_IC_MIN . '.js', array('jquery'), $this::$version);
			}

			if (self::is_st()) {
				$st = '1';
			}
			else {
				$st = '0';
			}

			wp_localize_script($this::$slug . '-no-lazy', 'wpc_vars', array('siteurl'          => site_url(),
																																			'ajaxurl'          => admin_url('admin-ajax.php'),
																																			'spinner'          => WPS_IC_URI . 'assets/images/spinner.svg',
																																			'background_sizing' => $background_sizing,
																																			'webp_enabled'     => $webp,
																																			'retina_enabled'   => $retina,
																																			'exif_enabled'     => $exif,
																																			'adaptive_enabled' => $adaptive,
																																			'speed_test'       => $st,
																																			'js_debug'         => self::$js_debug));
		}

	}


	public function is_mobile() {
		if ( ! isset($_SERVER['HTTP_USER_AGENT'])) {
			$_SERVER['HTTP_USER_AGENT'] = 'wpc';
		}

		$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

		$fp = fopen(WPS_IC_DIR . 'is_mobile.txt', 'w+');
		fwrite($fp, 'User Agent: ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n");
		fwrite($fp, $userAgent . "\r\n");
		fwrite($fp, strpos($userAgent, 'mobile') . "\r\n");
		fwrite($fp, strpos($userAgent, 'lighthouse') . "\r\n");
		fclose($fp);

		if (strpos($userAgent, 'mobile')) {
			return true;
		}
		else {
			return false;
		}
	}


	public function enqueue_all() {
		$response_key = self::$response_key;
		$settings     = self::$settings;

		$screen = get_current_screen();

		$this->asset_style('menu-icon', 'css/menu.wp.css');
		wp_enqueue_script($this::$slug . '-admin-bar-js', WPS_IC_URI . 'assets/js/admin-bar-backend.js', array('jquery'), '1.0.0');

		$page_array = array('upload', 'settings_page_' . $this::$slug, 'toplevel_page_' . $this::$slug . '-mu-network', 'toplevel_page_' . $this::$slug, 'media_page_' . $this::$slug  .'_optimize', 'media_page_' . $this::$slug . '_restore', 'media_page_' . $this::$slug . '_restore', 'plugins');

		if (is_admin()) {
			if (in_array($screen->base, $page_array)) {

				// Fix for Cloudflare by Optimole Plugin
				// https://wordpress.org/plugins/wp-cloudflare-page-cache/
				wp_dequeue_script('swcfpc_sweetalert_js');
				wp_deregister_script('swcfpc_sweetalert_js');

				wp_enqueue_script($this::$slug . '-circle', WPS_IC_URI . 'assets/js/circle-progress/circle-progress.js', array('jquery'), '1.0.0');

				if ($screen->base == 'toplevel_page_' . $this::$slug . '-mu-network') {
					$this->script('admin-mu-connect', 'mu.connect' . WPS_IC_MIN . '.js');

					// CSS
					$this->style('admin', 'admin.styles.css');
					$this->style('admin-media-library', 'admin.media-library.css');
					$this->style('admin-settings-page', 'settings_page.css');
					$this->style('admin-checkboxes', 'checkbox.css');

					// Icons
					$this->asset_style('admin-fontello', 'icons/css/fontello.min.css');

					// Tooltipster
					$this->asset_style('admin-tooltip-bundle-wcio', 'tooltip/css/tooltipster.bundle.min.css');
					$this->asset_script('admin-tooltip', 'tooltip/js/tooltipster.bundle.min.js');

					// Sweetalert
					$this->asset_style('admin-sweetalert', 'sweetalert/sweetalert2.min.css');
					$this->asset_script('admin-sweetalert', 'sweetalert/sweetalert2.all.min.js');

					// Mu style
					$this->style('admin-mu', 'multisite.style.css');

					// Vars
					wp_localize_script($this::$slug . '-admin-mu-connect', 'wps_ic_vars', array('ajaxurl' => admin_url('admin-ajax.php')));
				}

				if ($screen->base == 'toplevel_page_' . $this::$slug || $screen->base == 'settings_page_' . $this::$slug) {

					// Switch Box - Checkbox customizer
					$this->script('switchbox', 'switchbox' . WPS_IC_MIN . '.js');

					// Settings Area
					#wp_enqueue_style($this::$slug . '-google-font-Poppins', 'https://fonts.googleapis.com/css?family=Poppins:100,300,400,600&display=swap', array(), $this::$version);
					#wp_enqueue_style($this::$slug . '-google-font-sans', 'https://fonts.googleapis.com/css?family=Open+Sans', array(), $this::$version);
					$this->script('admin-settings', 'settings.admin' . WPS_IC_MIN . '.js');
					$this->script('admin-lottie-player', 'lottie/lottie-player.min.js');
					$this->script('admin-settings-live', 'live-settings.admin' . WPS_IC_MIN . '.js');
					wp_localize_script($this::$slug . '-admin-settings-live', 'wps_ic_vars', array('ajaxurl' => admin_url('admin-ajax.php')));

					if (is_multisite()) {
						$this->script('admin-mu-settings', 'mu-settings.admin' . WPS_IC_MIN . '.js');
					}

				}

				if ( ! empty($response_key)) {

					if ($screen->base == 'settings_page_' . $this::$slug && ( ! empty($_GET['view']) && $_GET['view'] == 'bulk')) {
						$this->script('media-library-bulk', 'media-library-bulk' . WPS_IC_MIN . '.js');
					}

					// Media Library Area
					if ($screen->base == 'upload' || $screen->base == 'media_page_' . $this::$slug . '_optimize' || $screen->base == 'plugins' || $screen->base == 'media_page_' . $this::$slug . '_restore' || $screen->base == 'media_page_wp_hard_restore_bulk') {

						// Icons
						$this->asset_style('admin-fontello', 'icons/css/fontello.min.css');

						// Tooltips
						$this->asset_style('admin-tooltip-bundle-wcio', 'tooltip/css/tooltipster.bundle.css');
						$this->asset_script('admin-tooltip', 'tooltip/js/tooltipster.bundle' . WPS_IC_MIN . '.js');

						$this->script('media-library', 'media-library-actions' . WPS_IC_MIN . '.js');
					}

					if ($screen->base == 'toplevel_page_' . $this::$slug || $screen->base == 'upload' || $screen->base == 'media_page_' . $this::$slug . '_optimize' || $screen->base == 'plugins' || $screen->base == 'media_page_' . $this::$slug . '_restore' || $screen->base == 'media_page_wp_hard_restore_bulk' || $screen->base == 'settings_page_'
					. $this::$slug) {

						#$this->script('admin', 'admin' . WPS_IC_MIN . '.js');
						#$this->script('popups', 'popups' . WPS_IC_MIN . '.js');
					}

				}

				if ($screen->base == 'toplevel_page_' . $this::$slug || $screen->base == 'settings_page_' . $this::$slug) {

					$this->asset_style('admin-tooltip-bundle-wcio', 'tooltip/css/tooltipster.bundle.min.css');
					$this->asset_script('admin-tooltip', 'tooltip/js/tooltipster.bundle.min.js');

					// Fontello
					$this->asset_style('admin-fontello', 'icons/css/fontello.css');
				}

				if ($screen->base == 'toplevel_page_' . $this::$slug || $screen->base == 'upload' || $screen->base == 'media_page_' . $this::$slug . '_optimize' || $screen->base == 'plugins' || $screen->base == 'media_page_' . $this::$slug . '_restore' || $screen->base == 'media_page_wp_hard_restore_bulk' || $screen->base ==
				'settings_page_' . $this::$slug) {
					$this->style('admin', 'admin.styles.css');
					$this->style('admin-media-library', 'admin.media-library.css');
					$this->style('admin-settings-page', 'settings_page.css');
					$this->style('admin-checkboxes', 'checkbox.css');
					$this->asset_script('admin-settings-page-progress-bar', 'progress/progressbar' . WPS_IC_MIN . '.js');
					$this->asset_script('admin-settings-page-charts', 'charts/chart.js');

					// Sweetalert
					$this->asset_style('admin-sweetalert', 'sweetalert/sweetalert2.min.css');
					$this->asset_script('admin-sweetalert', 'sweetalert/sweetalert2.all.min.js');
				}

				// Print footer script
				wp_localize_script('wps_ic-admin', 'wps_ic', array('uri' => WPS_IC_URI));
			}

		}

	}


	public function asset_style($name, $filename) {
		wp_enqueue_style($this::$slug . '-' . $name, WPS_IC_URI . 'assets/' . $filename, array(), $this::$version);
	}


	public function script($name, $filename, $footer = true) {
		wp_enqueue_script($this::$slug . '-' . $name, WPS_IC_URI . 'assets/js/' . $filename, array('jquery'), $this::$version, $footer);
	}


	public function asset_script($name, $filename) {
		wp_enqueue_script($this::$slug . '-' . $name, WPS_IC_URI . 'assets/' . $filename, array('jquery'), $this::$version, true);
	}


	public function style($name, $filename) {
		wp_enqueue_style($this::$slug . '-' . $name, WPS_IC_URI . 'assets/css/' . $filename, array(), $this::$version);
	}

}