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
define('DB_NAME', 've_Vision');

/** MySQL database username */
define('DB_USER', 've_vision');

/** MySQL database password */
define('DB_PASSWORD', '?B=4Ufdk7-[e');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'L]$sR)h676k$f$@&Kb6,T*;Rn{Oe39]P%H2,3_g71#^8eeninPS8@sM#Fu!H{n??');
define('SECURE_AUTH_KEY',  'iET+y4Bs+44oRy*5 c+,gF&yWXoa`1qVvj]!r&|[%T,g~w8%dAO+:|yh^S_Py$3e');
define('LOGGED_IN_KEY',    'iIP05i(~I80.@{2N(,@gfKl|:que*j53#qIT||tdZ_8pT=`ml%?=U/`RuHC<my)e');
define('NONCE_KEY',        'L@1/N&R4a[m_1{Q~ny{-3>Tk9;{l &jPL/MJP]A!#W.^mNvz&qW9OhWx4`;Pvz~}');
define('AUTH_SALT',        '~,~S`DLjdYf~a)z>R<X;:3Rex.:-_$M5El<rS7?k;22LKxqI@T%!=1H&usQIcWW&');
define('SECURE_AUTH_SALT', 'A.w@tdx_x-dm^GLh?I2 TrsH|$b!{?S`UBWa#Hy|jIz=LycCqPAd);D#Y6AV$%9 ');
define('LOGGED_IN_SALT',   '|l3mL%TQp8,8t$hOFdrU9@c:=:MEr]/:CjWCN-E`STNKr_($7&I~xWs6[J/fg!E:');
define('NONCE_SALT',       '}pz8LiVW78eT#oQ,9FnN]+p{kXmQChDfz<0XA~OTx8`x3ph/LOSWM;U--@4.Afbr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'vision_';

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
