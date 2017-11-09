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
define('DB_NAME', 'mew');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '{$N%8!at|=kQ$!zV*#v>z$R|VvWtXpd<v%3OJ-! h2W-vU}-}RG-B)QWi Y}H*W?');
define('SECURE_AUTH_KEY',  '>_W|r5hv<.2znqhSmRn]@RLg%V4(bZhQAE&|_0IiYV{)?qh(5eP+xHdjg~-qeb>}');
define('LOGGED_IN_KEY',    'cAPG}}Kud)GT*$P:TWS<KQSjc]>,RLg+ zFv-[Gg)!ACsz}vN>Hk?/SdZ-3=AJK4');
define('NONCE_KEY',        'p[npe35r_|:R5abRSY=,pTGGvKAvrPQv?n9#:*I:1H-o9a:<w_&Oy-cUg6T+=7Y(');
define('AUTH_SALT',        '/?tBi}#@=n;Opi7s?@#WM!Q28a)SI.ubgRJbhOK9]i.}P&o>>@qp+g2OEFRX_|b#');
define('SECURE_AUTH_SALT', 'Xls{$;`<ziTGaI,BY=mJyvBXG0HT+st[r?wx{Vgr|Vxxwcenc|q}i2-wn:Uu$822');
define('LOGGED_IN_SALT',   'H^nu9~2J/yv^`+~y(@|tq.k~v>Uh cE/?Lbq.i$HchiLAEw(2<sx*uG@unLl?o>v');
define('NONCE_SALT',       '3V`JX$qP]WmAF&LjQQ$4[3D2RjS%OV77:!M4]j>dmyMQ`A!Negyvcu,9)#;{v9aP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wda_2016_2_';

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
