<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hmts' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gf)%A=E3tArIgo+p1NB$P_5J{#<0{u.U%1[i|m54y*`#fbE`qX,}!5%}oSLK/.>t' );
define( 'SECURE_AUTH_KEY',  ' kpvV#,b/HjK^L1l(YL5^4:xYX%LO@,Gb%!z%5.0qs/Pd5:.SByoK+AkT5<1@IXB' );
define( 'LOGGED_IN_KEY',    'u}GO:/)SMc!-)l/maY.zMlrvMR^Nr@3wBG$NAl;~hBfi0mk*OsDHJ|^NQV*uHF2O' );
define( 'NONCE_KEY',        '1yM+3rgfEMa4=fu9D(ln7@rANtv|0hqMz#RvcQ>}Wi2aJ,V*.J4Nm6 a^lC[Ul)G' );
define( 'AUTH_SALT',        'muE=p|h,`j*v;M>IjP>!sC(QfURHJP(;%n<.N>i!E3_;FX{[)O.H&[8yFU`P0R&z' );
define( 'SECURE_AUTH_SALT', '1Q0txv7jhc3!yzv*oWyA~c!UY[*V#R*6@jCMB>IWDP(g`rhRE$ZkqCg%wY2yz8]Y' );
define( 'LOGGED_IN_SALT',   '/U[jv?2U5~?+]et*Y# LkM,d^{k03 /12AlX^EmzkEvTBuD_L9DYEJnEj%CCB~,>' );
define( 'NONCE_SALT',       't?,oxlrbkZt/!o6UT+9Xp]*0J.L!WV;@**vFou<Od1yhLitx?4GLWC0n L|Q]iGH' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
