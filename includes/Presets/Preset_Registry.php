<?php

namespace Oblique\Buttons\Presets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads button preset definitions from includes/Presets/presets/*.php.
 *
 * Presets are pure metadata (id, name, category) - the visual appearance of
 * each preset lives in assets/css/button.css as a `.oblique-button--preset-*`
 * class. Adding a preset means adding a data entry here and a CSS rule,
 * never touching the widget itself. See section 6 of
 * oblique-buttons-for-elementor.md.
 */
class Preset_Registry {

	private const CATEGORY_ORDER = array( 'solid', 'outline', 'modern', 'animated' );

	private static ?array $presets = null;

	/**
	 * @return array<int, array{id: string, name: string, category: string}>
	 */
	public static function get_all(): array {
		if ( null !== self::$presets ) {
			return self::$presets;
		}

		$files = glob( OBLIQUE_BUTTONS_PATH . 'includes/Presets/presets/*.php' );

		$presets = array();

		foreach ( (array) $files as $file ) {
			$group = include $file;

			if ( is_array( $group ) ) {
				$presets = array_merge( $presets, $group );
			}
		}

		usort(
			$presets,
			static function ( $a, $b ) {
				$order_a = array_search( $a['category'], self::CATEGORY_ORDER, true );
				$order_b = array_search( $b['category'], self::CATEGORY_ORDER, true );

				return $order_a <=> $order_b;
			}
		);

		self::$presets = $presets;

		return self::$presets;
	}

	public static function get( string $id ): ?array {
		foreach ( self::get_all() as $preset ) {
			if ( $preset['id'] === $id ) {
				return $preset;
			}
		}

		return null;
	}

	public static function exists( string $id ): bool {
		return null !== self::get( $id );
	}

	public static function get_category_label( string $category ): string {
		$labels = array(
			'solid'    => esc_html__( 'Solid', 'oblique-buttons-for-elementor' ),
			'outline'  => esc_html__( 'Outline', 'oblique-buttons-for-elementor' ),
			'modern'   => esc_html__( 'Modern', 'oblique-buttons-for-elementor' ),
			'animated' => esc_html__( 'Animated', 'oblique-buttons-for-elementor' ),
		);

		return $labels[ $category ] ?? ucfirst( $category );
	}

	public static function get_css_class( string $id ): string {
		return 'oblique-button--preset-' . $id;
	}
}
