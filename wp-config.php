<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'barber' );

/** MySQL database username */
define( 'DB_USER', 'barbero' );

/** MySQL database password */
define( 'DB_PASSWORD', 'barbero' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '00zu,y0|Uf1_DT4945rJq6_vl:/*KRXG)WJHjL9Y_mI>P./&CP<0#x b$96Ox;Lx' );
define( 'SECURE_AUTH_KEY',  'p,ah=P.W``f2.jzy}#zBXAJmL2I9N]GEIwtYEV*GGmoIg9[/y@[;3UVuyBeEC7{t' );
define( 'LOGGED_IN_KEY',    'OBW^yTm Bql2#IbW:FB._4ODD_rHzqNC6T/P{9n$2x,.m8qPf[AnZcG/WS}9um0]' );
define( 'NONCE_KEY',        ' ?1CZ>A~<U7z8M=*^r{O59PP~@K<i|%~V-4</.Xp!!oz&,pWMYGnDCkk==SPWdHK' );
define( 'AUTH_SALT',        'eom{F<?4}`~ywEMwZl oFOD-[Mg7Mokh<e/z,b.A@BXX=%baO:l,?wD71SRSMi*:' );
define( 'SECURE_AUTH_SALT', '[kl Xcm:5S/@_K(44WbRd8]X_UDOe/l.S@-]vpU-W=Tz:VS:w{|(*e3GmiYO{z-i' );
define( 'LOGGED_IN_SALT',   'SLg3u-MLUw(c&pDC9^*S<hqK?*,aPl;lck`GW2?<ik$XdjWaH5Jk[,uNzBcVP7`$' );
define( 'NONCE_SALT',       ';W#@Z4AHr;YxXQgzi:cpm=M??t!k!?>eQhwyps_FO(UgIMN#WL~$4p*CMIC*R%kJ' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
