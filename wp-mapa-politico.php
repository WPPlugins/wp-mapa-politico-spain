<?php
/*
 * Plugin Name: WP Mapa Politico España
 * Version: 3.0.0
 * Plugin URI: http://mispinitoswp.wordpress.com/
 * Description: Este plugin permite definir para cada una de las provincias de un mapa politico de españa un enlace.
 * Author: Juan Carlos Gomez-Lobo
 * Author URI: http://mispinitoswp.wordpress.com/
 *
 * Text Domain: wpmps-plugin
 * Domain Path: /lang/
 *
 */


if ( ! defined( 'ABSPATH' ) ) exit;


// Load plugin class files
require_once( 'includes/class-wp-mapa-politico.php' );
require_once( 'includes/class-wp-mapa-politico-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-wp-mapa-politico-admin-api.php' );

// shortcodes
require_once( 'includes/shortcodes.php' );




/**
 * Returns the main instance of WP_Mapa_Politico to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WP_Mapa_Politico
 */
function WP_Mapa_Politico () {

	$instance = WP_Mapa_Politico::instance( __FILE__, '3.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = WP_Mapa_Politico_Settings::instance( $instance );
	}

	return $instance;
}

function my_donate_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $links[] = '<a href="https://www.paypal.me/jcglp" target="_blank">' . __('Donate', 'my-plugin-textdomain') . '</a>';
    }

    return $links;
}
add_filter( 'plugin_row_meta', 'my_donate_link', 10, 2 );


WP_Mapa_Politico();
