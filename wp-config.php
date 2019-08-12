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
define( 'DB_NAME', 'wordpresspluginimporte' );

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
define( 'AUTH_KEY',         'R`Wsgg1&1 mT3/J(c$0b9ilGR10G$cG]| PD[eI|Z~8TJb`l7^XH[v~<eJ}J{u>e' );
define( 'SECURE_AUTH_KEY',  'qZurnm0{f]$xwZlwuqzTO7$0}fR/+r%1cs4%GlU9Ue~d5Ws>NoPb[tgCvt;wXxUG' );
define( 'LOGGED_IN_KEY',    '9Kn NP>#B?qcGQ%dDr;]+*_.JHg&+6ty,kQZ@{R&9L7n)H^s;%5o>P7pGT$[v~nJ' );
define( 'NONCE_KEY',        'QLyB^V,nVz7Q2>BiQDCAI)Se7aPz(lX{eVtB3bsx.n8hcm<`oV;m3rJF1y^i!3OU' );
define( 'AUTH_SALT',        'M2/G|h68o9_KTdg/;]F1eZdw[QZGU_pb3x]a%w:lhJJLm9VcWP1&8>ejT;/)%w57' );
define( 'SECURE_AUTH_SALT', ')P+#WNb`Jg-S#}HF5v?:qD[4]ddv59-[ZiR^lQ=X[%_9CE(b-lk.L F?[k(OswHC' );
define( 'LOGGED_IN_SALT',   'Pf0qG5:FM. =Q[6CRnE%:<+^USyhi=?:EWk)[29*czw$~7*!_S`&[!t^O^0(~vJ|' );
define( 'NONCE_SALT',       '<%K=7XlG!Sg6rwk}K:P@jXjeaHyX_{9v[/kB7,I:XP1/Mj*{W_[<7oxhTu_?hL*3' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
@ini_set( 'upload_max_filesize' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );
