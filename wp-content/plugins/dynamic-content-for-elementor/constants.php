<?php

define('DCE_VERSION', '1.12.3');
define('DCE__FILE__', __FILE__);
define('DCE_URL', plugins_url('/', __FILE__));
define('DCE_PATH', plugin_dir_path(__FILE__));
define('DCE_PLUGIN_BASE', plugin_basename(DCE__FILE__));
define('DCE_ELEMENTOR_VERSION_REQUIRED', '2.9.11');
define('DCE_ELEMENTOR_PRO_VERSION_REQUIRED', '2.10.0');
define('DCE_PHP_VERSION_SUGGESTED', '7.1');
define('DCE_OPTIONS', 'dyncontel_options');
define('DCE_BACKUP_PATH', ABSPATH . 'wp-content/backup');
define('DCE_BACKUP_URL', site_url() . '/wp-content/backup');
$wp_upload_dir = wp_upload_dir();
define('DCE_ELEMENTOR_UPLOADS_PATH', $wp_upload_dir['basedir'] . '/elementor/');
define('DCE_ELEMENTOR_UPLOADS_URL', $wp_upload_dir['baseurl'] . '/elementor/');

// License and update
define('DCE_LICENSE_URL', 'https://license.dynamic.ooo');
define('DCE_PRODUCT_ID', 'WP-DCE-1');
$protocol = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ( ! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443 ) ) ? 'https://' : 'http://';
define('DCE_INSTANCE', str_replace($protocol, '', get_bloginfo('wpurl')));
$license = get_option(DCE_PRODUCT_ID . '_license_key');
define('DCE_LICENSE', $license);
