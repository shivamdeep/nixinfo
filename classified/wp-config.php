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
define('DB_NAME', 'classified');

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
define('AUTH_KEY',         'T#BnrmLsX#(enLN;wP2SDqYaozx.txXb=P `.XOW%%{b9z)YkYiK?{3xxy|~hgg)');
define('SECURE_AUTH_KEY',  '|;my/+32:y}7K<=htK68aueR$=B^>6.dPS,WWFkMVfCS!O9<Cg-`3yTjdTp#}fU9');
define('LOGGED_IN_KEY',    't0FOH9<R2a;$q:HQ(1dt]2R9Cx6x`Oc%qd$3!8:2=m+f5Vwqpl2.@20M6y7E|^9p');
define('NONCE_KEY',        '/0:#}/$Ab T YX0s ,bnBiphdYx0XneoPY>WkT@Lw6Rec YGnrc5P(2&I{u@JY`&');
define('AUTH_SALT',        'dO#_aU)d~mHsO73RPR0N~ed1[QnArtBqfXQ0#gXqMP8s}/%e7ONJLZDZ.|kEh)SZ');
define('SECURE_AUTH_SALT', 'SFO-5,.jRT81<Z~8J#%kW&~~`&$MD]v#l}oZw/*|:cps$VY~lnhQxYZnKafXg7Z|');
define('LOGGED_IN_SALT',   '41g-ow< XiS){5q(YsAacC#MV^3%_r0pi9i)i*Npuj]u/[+_um8=<9a<RP?Sy`it');
define('NONCE_SALT',       'h0!lYJ_(1[QBtI%N5}=HN~ujcM)W.[*{a&f<(B?vu-Y@_s`8XUTx6OQiNNhbYl@w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
