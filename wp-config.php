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
define( 'DB_NAME', 'porfolio' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

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
define( 'AUTH_KEY',         'k3^/[d*G,po1,NCHoViOj`5N2~jx-ky8K!ly`lG61msv_?L<-P$c%@=)&6RyT,lk' );
define( 'SECURE_AUTH_KEY',  'lg2jFFBG TviKX#w:Z0n?h,x<c!msZZ1F}iT_TcRK{L#b#/Ri>x#IB3 nX?-2h ^' );
define( 'LOGGED_IN_KEY',    '!,J10@+,|jrysCb5_to|halSIKISww@v1;;<>8vR5pVrS?)kgOVw/MnU$&h7Amg:' );
define( 'NONCE_KEY',        'v<>p[$h2J@>K:Qw.iE;I>t7<-rfh&^Rs_[<1N*2wpg(u&HMJ%o!V0P_63EJRqQcJ' );
define( 'AUTH_SALT',        '}:t)akj)I/mE46fFRMoB.E*DIS[%#c^E$7PBOhXr!}nZYQSK&g7de]+qDhx/#o~a' );
define( 'SECURE_AUTH_SALT', 'RjOXd)Hs0I=im4#:P.r}zM-{HoW%;y^2hG%/z@d<F]Zw/Ojqr{v65q9.T4NS#2Az' );
define( 'LOGGED_IN_SALT',   'Qx8o~8q7[D+4t7Bc%,SErn0n;:LlT<+{O5ld1|.Zcws+Y`KNW9%uz$<$Sf{>}[;(' );
define( 'NONCE_SALT',       '&CaCC8Wa:>@@]2ej@R]j&`tuf^`*88<gTAt58xx,,m>G`Ud0z20qdGhEXCsxIb$#' );

/**
 * Handle SSL reverse proxy
 */
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS']='on';

if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
}

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
