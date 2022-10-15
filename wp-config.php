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
define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pass' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '[j03*ExR.BBmT}s4-f<iW~$-BJbHfriw,}9z-#]ZR0k.4dP{jqxe`uvYE9c1nh,*' );
define( 'SECURE_AUTH_KEY',   'ja~yZ#I@>zj4oj5vs90cR!wTe[^ZRDu1R=7X`2|Cq{ 1$X$lHu*gL2ogd,0BO@0N' );
define( 'LOGGED_IN_KEY',     '$wGnT[n|T!3x:t`iQJ^:_{x=>3U|7uSO!Z#T!4IA@%SGiyHq9vM{%2e%@t:GlfH<' );
define( 'NONCE_KEY',         'j[kHNR`2xTPRZ]UPkz`=<i=yx#N$jnjzR>q%i>e;>!8](6bd8HkW$T_ue8;{a[TJ' );
define( 'AUTH_SALT',         's5(|fhqLyFM>iW5:2c^+d?vEJ`m6#>7u!op%.mR(JNGw!.i!C,IniOH.NK3TX[jG' );
define( 'SECURE_AUTH_SALT',  '4T|]cG<`w7Jet/Bq#4*DR9=T|[EZUy&0LII},}].?j}S:B]dvOhd&gHR!*2OYMno' );
define( 'LOGGED_IN_SALT',    'UCkBUA9r#}lTG5A(+z~lmCK+U+eOcio&#_x,E:||_SoU7ts<iK=L9.QFiTQ%#W;p' );
define( 'NONCE_SALT',        'r:JE~@D#NRn:Z[l1P/)^9-e_nT[Twt0>JA|&bGP[gtm&~Oy3UeNER r~E%R7rZ<X' );
define( 'WP_CACHE_KEY_SALT', '7gDKCa^Z+PA#z+zbg}t#FvjpM.@@x27$>chl4-9iYcmX2G?dS_aQS/;{3G/b:|a:' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


$_SERVER[ "HTTPS" ] = "on";
define( 'WP_HOME', 'https://Tarea2-GC-WordPress.DieterPreuss.repl.co' );
define( 'WP_SITEURL', 'https://Tarea2-GC-WordPress.DieterPreuss.repl.co' );
define ('FS_METHOD', 'direct');
define('FORCE_SSL_ADMIN', true);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
