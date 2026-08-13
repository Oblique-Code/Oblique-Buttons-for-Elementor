<?php

namespace Oblique\Buttons;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin bootstrap. Verifies the environment and wires the widget(s)
 * into Elementor. Presets, style generation, and asset management will be
 * introduced in later phases per oblique-buttons-for-elementor.md.
 */
final class Plugin {

	private static ?Plugin $instance = null;

	public static function instance(): Plugin {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		if ( ! $this->has_valid_environment() ) {
			return;
		}

		require_once OBLIQUE_BUTTONS_PATH . 'includes/Assets/Asset_Manager.php';

		( new Assets\Asset_Manager() )->register();

		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
	}

	private function has_valid_environment(): bool {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_elementor' ) );

			return false;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, OBLIQUE_BUTTONS_MIN_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_minimum_elementor_version' ) );

			return false;
		}

		if ( version_compare( PHP_VERSION, OBLIQUE_BUTTONS_MIN_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_minimum_php_version' ) );

			return false;
		}

		return true;
	}

	public function register_widgets( $widgets_manager ): void {
		require_once OBLIQUE_BUTTONS_PATH . 'includes/Presets/Preset_Registry.php';
		require_once OBLIQUE_BUTTONS_PATH . 'includes/Presets/Preset_Manager.php';
		require_once OBLIQUE_BUTTONS_PATH . 'includes/Elementor/Widget_Button.php';
		require_once OBLIQUE_BUTTONS_PATH . 'includes/Elementor/Widget_Button_Group.php';

		$widgets_manager->register( new Elementor\Widget_Button() );
		$widgets_manager->register( new Elementor\Widget_Button_Group() );
	}

	public function notice_missing_elementor(): void {
		$this->render_notice(
			sprintf(
				/* translators: %s: Plugin name. */
				esc_html__( '%s requires Elementor to be installed and activated.', 'oblique-buttons-for-elementor' ),
				'<strong>Oblique Buttons for Elementor</strong>'
			)
		);
	}

	public function notice_minimum_elementor_version(): void {
		$this->render_notice(
			sprintf(
				/* translators: %1$s: Plugin name. %2$s: Required Elementor version. */
				esc_html__( '%1$s requires Elementor version %2$s or greater.', 'oblique-buttons-for-elementor' ),
				'<strong>Oblique Buttons for Elementor</strong>',
				OBLIQUE_BUTTONS_MIN_ELEMENTOR_VERSION
			)
		);
	}

	public function notice_minimum_php_version(): void {
		$this->render_notice(
			sprintf(
				/* translators: %1$s: Plugin name. %2$s: Required PHP version. */
				esc_html__( '%1$s requires PHP version %2$s or greater.', 'oblique-buttons-for-elementor' ),
				'<strong>Oblique Buttons for Elementor</strong>',
				OBLIQUE_BUTTONS_MIN_PHP_VERSION
			)
		);
	}

	private function render_notice( string $message ): void {
		printf( '<div class="notice notice-warning"><p>%s</p></div>', $message );
	}
}
