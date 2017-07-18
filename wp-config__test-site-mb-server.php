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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db365556742');

/** MySQL database username */
define('DB_USER', 'dbo365556742');

/** MySQL database password */
define('DB_PASSWORD', 'Iam_the_14ND_only');

/** MySQL hostname */
define('DB_HOST', 'db2714.oneandone.co.uk');

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
 define('AUTH_KEY',         '|C{1+_|.Blp>nQnlc<nam.du:jA_Z:`U1GXhh84b6|W`QKUY&m13*b-:|Mavi[E|');
 define('SECURE_AUTH_KEY',  'B~sDn!]<|p6C.xf2aB46jgaXFS,k/b>N2?PtO-](VDlTz+nhuCbxE:u*TAb;2&M!');
 define('LOGGED_IN_KEY',    'vE-cSGysBo%v>1<Z39@{wA{bq(NC}-2G9&J:z}37*z6KUo24qq]A)X|74:Vgop>s');
 define('NONCE_KEY',        '9dnPaKMq!|aHW[[D$ Q0io*V?Q5.xoE,{K&jxVciet5#IZ{P@`M);PmZ>cp#o g5');
 define('AUTH_SALT',        '[[74|) SJb73WX+d3b+37|#S3-G?=IQygrhXb}0s-Y Re3fXi,;[- vd- 5fD/C|');
 define('SECURE_AUTH_SALT', '9;W$>mTmzz@||fRs5au{-^BmTmzP?{5NWktDTtQ|=@ues>mQ;f-D&}m%^=3zo`cO');
 define('LOGGED_IN_SALT',   '0p&4<JR<x~^CtXcnUISg-XQ[BCHY`%Rq`!5X6t|#I%U/bDcp!j6HM<QSK30yW+--');
 define('NONCE_SALT',       '1Q|O&BAV?5`x8S;Z3Cq1UUL4t{m)h*^yBe=Ut>q{K9mdL:|y=jcWTjjf:FS3/<7#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
