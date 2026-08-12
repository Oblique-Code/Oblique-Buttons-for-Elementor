<?php
/**
 * Plugin Name:       Oblique Buttons for Elementor
 * Plugin URI:        https://github.com/Oblique-Code/Oblique-Buttons-for-Elementor
 * Description:       Professionally designed, ready-made Elementor button presets combined with complete customization.
 * Version:           0.1.0
 * Author:            Oblique Code
 * Text Domain:       oblique-buttons-for-elementor
 * Domain Path:       /languages
 * Requires PHP:      7.4
 * Requires at least: 6.0
 * Elementor tested up to: 4.2.2
 * Elementor Pro tested up to: 4.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OBLIQUE_BUTTONS_VERSION', '0.1.0' );
define( 'OBLIQUE_BUTTONS_FILE', __FILE__ );
define( 'OBLIQUE_BUTTONS_PATH', plugin_dir_path( __FILE__ ) );
define( 'OBLIQUE_BUTTONS_URL', plugin_dir_url( __FILE__ ) );
define( 'OBLIQUE_BUTTONS_MIN_ELEMENTOR_VERSION', '3.20.0' );
define( 'OBLIQUE_BUTTONS_MIN_PHP_VERSION', '7.4' );

require_once OBLIQUE_BUTTONS_PATH . 'includes/Plugin.php';

/**
 * Boots the plugin once all active plugins are loaded, so Elementor's
 * presence (and version) can be reliably checked before doing anything.
 */
function oblique_buttons_run() {
	\Oblique\Buttons\Plugin::instance();
}
add_action( 'plugins_loaded', 'oblique_buttons_run' );
