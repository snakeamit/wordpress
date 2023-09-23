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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ibrMock' );

/** Database username */
define( 'DB_USER', 'ibrlive' );

/** Database password */
define( 'DB_PASSWORD', 'tubelight' );

/** Database hostname */
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
define( 'AUTH_KEY',         ')47(<tXsJPqns4-+i~DVUeKR2:U-fxW88-99#p+[fMuC*C5QdT%).OF5,pIoXkn[' );
define( 'SECURE_AUTH_KEY',  '(K(2(2R1 X:qsd8QLA]#kZ4T0i3*ofA(xGPJ&q:JzQyJhg8]#p &UcCs#[>7Y/@W' );
define( 'LOGGED_IN_KEY',    'VH]n6rzu3aG_ECAB]H[l] 1GU=!&UvZL:&4I~yURi!]vz#+v3Z47tcz[#.IwpJ7h' );
define( 'NONCE_KEY',        'SFFp#Hc@W<X~HJCkBNRMWN+LH,oKh)6j;YG2zJo8sri0d2DIufC:#_S&Bs}KjIOx' );
define( 'AUTH_SALT',        '3)A0D^^Pi!C.}oWuM4b+>~[E2o!v(1_83)gC^`&3u|cQ$Dlxc yN!G]KF)*UFc A' );
define( 'SECURE_AUTH_SALT', 'HRKI/6B{=38E4@Ppef.h/u2SajF(x*Mj4Ur/2*w<XJh<-p`2,]YREpmR~%,c5K=j' );
define( 'LOGGED_IN_SALT',   'J`n/uTPhfNtW^K<n{[W|Om(j(`s*a`#Y`Gh<!=- zTExIv2xA8F[UPdG~v}sIxd;' );
define( 'NONCE_SALT',       '/7X^l^B<XuR>sN1N}Jl:|@>`&Z]&}_+~kJ5:aw/},Ulb/]^<%4tzPzg.a5A5k2cj' );

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
