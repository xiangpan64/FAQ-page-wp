<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '{2l|Z#{nO0jR]x`4:.1}8DH4]g8]mO|Bq`SDt~qK3*%YH|l%:eD2>|*x</IuE#Hw');
define('SECURE_AUTH_KEY',  'd(,[+W$Y|ayTapRbU=:0CPj[RZ>eVEa`4{Nfqw)7[LT66GA]w66jQ!s2]=k-)kYl');
define('LOGGED_IN_KEY',    '$3;4FhzOr2}1Q`D:0dqGlvBG:9i4xySr+$Vf+UDv`{2vw@ @[eF oBifA9HSpgs+');
define('NONCE_KEY',        '!N_f{GNt)Inj?di-%bv*nh9qFz8Gy&nr7Y}Lmg_<nYu}|Bb~PHDWh,@Nft&oNvJT');
define('AUTH_SALT',        ',,/n@B?M$:t-IGddf#`My^te_FGD=MTnz^hnJk#/z!a(4(kX&=^3I/XBzpp`npk)');
define('SECURE_AUTH_SALT', '3Ah&6Wy4>eKp!k)h@gtQ_E8}WC>p_]tkBeuz,DHR:gB$Gn2`zj.E;tZcnebHDgZE');
define('LOGGED_IN_SALT',   'k]:;C(!o+!pb1@X/-E|KQ-l-/Y7AL?[L7aWmTEXR{;FZZ0|7*TsTwk08e*C|p|H~');
define('NONCE_SALT',       'sRGfG]GOu>S8]|+-K3n@fvSA]D0<pfv]+aI[7S0y}#nD{-=?|[iRu4&AJ*MQSG2U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
