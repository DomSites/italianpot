<?php

/** Enable W3 Total Cache */
 //Added by WP-Cache Manager
/** Enable W3 Total Cache */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/italnbfh/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
 //Added by WP-Cache Manager
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
define('DB_NAME', 'italianpot');
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
define('AUTH_KEY',         'ppe1r6hxgzdkg14jyxjkkayflmfinh3bvtcgr1rvpqqqumuwbtckqjtvxula5fru');
define('SECURE_AUTH_KEY',  'vguckh5fr8ojnneyp3olvxqqg4zhdg6xxqpyxid8qfh5ticjr5lervds7qglzfwz');
define('LOGGED_IN_KEY',    'qjqdkchpyclwiel6fzzxxzmzimggcf2ngszs13xxvsjkjrojhdstyygrpcrjlczp');
define('NONCE_KEY',        'ynrnk3xzwnhxuupy9r8djtrow44zxdsdyuop9vqs1jhhahw9lrknrm5fmnwtvbji');
define('AUTH_SALT',        'aemxslb8fcalqnxuwbnpiq26dkvfmkysbdinfcgwgpupf2bqlb3qotlmwzdpz77s');
define('SECURE_AUTH_SALT', 'q81mdoke1pzbqls2ln4vgpfz0scbfnz0n5rmz9fotj1pphzliu4d1sy2qpaa1uqd');
define('LOGGED_IN_SALT',   'srpcy65dj0guqhjd0xekjhtsa2y9kxjungfw5hcdzzbvzydpb0t5yrufmxlm5oyn');
define('NONCE_SALT',       'xkbkjn8w4cja8dct6wj63qjoxv2jujbzppl6pexexth2wajmfpcn4nasq9n96rw5');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpyp_';
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
define('JETPACK_IP_ADDRESS_OK', '199.188.206.137');
