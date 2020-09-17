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
define( 'DB_NAME', 'berkahmedika01' );

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
define( 'AUTH_KEY',         '_$P1X0tBAcUS?x41&~bRLd|;=u<e%B.s*YX=K|ZX]B<30p0rRL $)g&JdW$X#[4:' );
define( 'SECURE_AUTH_KEY',  'lO~t:u(EjY~@w7q]Zhy309`FkY:`YI[Ezx>5 4cV``C2W<a;3nZ*ME`gdNX^zc7H' );
define( 'LOGGED_IN_KEY',    'N4VHdCJW:r;Kv@02*o!T4K^Zb6|iiC=Zo`DS6y<.ix{e:{ypw,ONrI?]4-aT6OmD' );
define( 'NONCE_KEY',        'jwKeS j3v;LMVo;,V _DmxAtF+rMr-%;AUTE$<S&+sQ<5B}h{zFbZUv]h(?k@p36' );
define( 'AUTH_SALT',        'V0-F=Mio?YEYTmrdp4/z 1jDMZ8EYc^_#yqxs`@-8xxGkn<(u:aV65e)T$3P6dt[' );
define( 'SECURE_AUTH_SALT', 'UA5mOpQyskBb/^~YFh:tc9%u*LPHp])j#QKLHTfHaqO|%%s.J-SF-FV(}L&qXQ%E' );
define( 'LOGGED_IN_SALT',   'B/Cr:ckGURXxotkzEbG?%Cf;/VXLG#;v:JIPGse:hh !8@Sn+lPjqug)sBNrb:3c' );
define( 'NONCE_SALT',       '9CAzMWY_eFJ|9Go.{EUFH[&cyjC<(d=(r.BFyYt_dC/<vDJt$u)TwBB|m/5x?T[-' );

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
