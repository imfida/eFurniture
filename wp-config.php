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
define('DB_NAME', 'eFurniture');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '}%x4%q,y< [j)Sy<;!+$k{Otk,:g]D?XvY m;Xk7G.?%YcB>VfRJy{2sk8f9t+{F');
define('SECURE_AUTH_KEY',  '.86U#iq,^,s+x*CV2N>{5Dcd~weAx16oHV:JQQ=odCraG6>.9fTd.o{eEW!ic9%j');
define('LOGGED_IN_KEY',    'sghXvDABX_>Op%(Uo(n+mkk9r_z+Nr&q=7y5oQzaqjoBK-a8pBoV0@NFdnz8!b1s');
define('NONCE_KEY',        'K#R!<0QA0>&H&U&t!~8;L,8]~t%UZ 4lJGq,[~e->8]2k`^(?OT$cIO,07`WlFkD');
define('AUTH_SALT',        '9/kR3tw9mQwh[Y@=kpS`]dc*0lJPE8:HgGy3?$Es=ReYls% Bf@?XquZXEc-{S`w');
define('SECURE_AUTH_SALT', 'ikrftu`?epAcf.6F.t9`|a-33/ekcxVW*Z;-(ng{zYL[xyb%)@0AMVGZgf]P&)J6');
define('LOGGED_IN_SALT',   '}(GatR!5X.<39XEEMq{^S((|xVTs>:_>6U}T_CyX5:~$do:z/y+PDA@ceH4APnT&');
define('NONCE_SALT',       'uVf6K157I%>n37y3Yp{E,R5t.8rR, SOtftASin [49pK-@>9mOc3z2{Zty{>?aM');

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
