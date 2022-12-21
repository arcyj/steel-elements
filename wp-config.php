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
define('DB_NAME', 'steel-elements');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         '.pl@NS EzYCw%4}kmTKnJ0.KtO]@]rRr|mRH%y5;4C|}x9|nVUB*/IpQ,o`JsJ+<');
define('SECURE_AUTH_KEY',  '~?^GI)L$,r&me#4<[.Z?r93ExChqat^CgK!tN_-;kE6sJ+$y$&ML(+uoq2 >>}+X');
define('LOGGED_IN_KEY',    'bm$$~?^Y-=6-0+w.6={~ %]Fn`sq HSoc8H^HGaRN;[?s6G_=ZW!H w|egwCN.+y');
define('NONCE_KEY',        'loZc_D:cXO[n{j*_gOv}b{*wJ4-BC6b|B?>G-%6-91(y* Pec*N,PA69u<<IVQ|)');
define('AUTH_SALT',        '[884O+Q@u2:*+!O,Q7<#gs|!9||#bHIgg8+*ZII793-m R0g8m$V-]`9(x. N=Dj');
define('SECURE_AUTH_SALT', '-JPcoEzx,PY:j9fZn}b _F:ngJ4%u3h$-]u= Gl2BnZ!4e!@8-5}U ~,)ru,&iR%');
define('LOGGED_IN_SALT',   '&<dz?B#wn<--=f6bZlI}a-7tP 1^C)q+y3P@17++v?V?/DTn4vbz3 d}a,4u>k8w');
define('NONCE_SALT',       'Ply%kW49_8(AZ,/pipbq;@Vl#b#YBg{+Ix:l$q.l;&@m+L^o2tbj3 R@*-{iw?_+');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'se_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
