<?php

namespace Oblique\Buttons\Presets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads button preset definitions from includes/Presets/presets/*.php.
 *
 * A preset is pure metadata. Its base look lives in assets/css/button.css as
 * a `.oblique-button--preset-*` class, and any motion/surface it ships with
 * is named here rather than hard-coded into that class:
 *
 *   id             (string) unique slug
 *   name           (string) label shown in the panel
 *   category       (string) one of CATEGORY_ORDER
 *   hover_effect   (string) optional, e.g. 'shine' - the effect this preset
 *                  ships with. The widget treats it as a default the user
 *                  can override or switch off.
 *   surface        (string) optional, e.g. 'glass' - as above, for surfaces.
 *   icon_animation (string) optional default icon motion.
 *
 * Because effects are named rather than baked into the preset's CSS, the
 * exact same effect CSS (and the same detailed style controls) serves both
 * "the preset that ships with it" and "a user who applied it to any other
 * preset". Adding a preset stays a data + one CSS rule task.
 */
class Preset_Registry {

	private const CATEGORY_ORDER = array( 'signature', 'solid', 'outline', 'modern', 'animated', 'creative' );

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

	/**
	 * Every preset id that ships with the given value for the given key.
	 *
	 * Used to build the editor conditions that reveal an effect's style
	 * controls when the chosen preset already uses that effect.
	 *
	 * @return array<int, string>
	 */
	public static function get_ids_by( string $key, string $value ): array {
		$ids = array();

		foreach ( self::get_all() as $preset ) {
			if ( isset( $preset[ $key ] ) && $preset[ $key ] === $value ) {
				$ids[] = $preset['id'];
			}
		}

		return $ids;
	}

	/**
	 * Every preset id whose value for the given key starts with the prefix.
	 *
	 * Lets the directional fill effects ('fill-left', 'fill-right', ...) be
	 * matched as one family.
	 *
	 * @return array<int, string>
	 */
	public static function get_ids_by_prefix( string $key, string $prefix ): array {
		$ids = array();

		foreach ( self::get_all() as $preset ) {
			if ( isset( $preset[ $key ] ) && 0 === strpos( $preset[ $key ], $prefix ) ) {
				$ids[] = $preset['id'];
			}
		}

		return $ids;
	}

	/**
	 * Every preset id whose metadata has a truthy value for the given flag.
	 *
	 * @return array<int, string>
	 */
	public static function get_ids_with( string $flag ): array {
		$ids = array();

		foreach ( self::get_all() as $preset ) {
			if ( ! empty( $preset[ $flag ] ) ) {
				$ids[] = $preset['id'];
			}
		}

		return $ids;
	}

	public static function get_category_label( string $category ): string {
		$labels = array(
			'solid'    => esc_html__( 'Solid', 'oblique-buttons-for-elementor' ),
			'outline'  => esc_html__( 'Outline', 'oblique-buttons-for-elementor' ),
			'modern'   => esc_html__( 'Modern', 'oblique-buttons-for-elementor' ),
			'animated' => esc_html__( 'Animated', 'oblique-buttons-for-elementor' ),
			'creative' => esc_html__( 'Creative', 'oblique-buttons-for-elementor' ),
			'signature' => esc_html__( 'Signature', 'oblique-buttons-for-elementor' ),
		);

		return $labels[ $category ] ?? ucfirst( $category );
	}

	public static function get_css_class( string $id ): string {
		return 'oblique-button--preset-' . $id;
	}
}
