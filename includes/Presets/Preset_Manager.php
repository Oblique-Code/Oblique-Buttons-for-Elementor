<?php

namespace Oblique\Buttons\Presets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bridges the Preset_Registry to the Elementor control API.
 */
class Preset_Manager {

	/**
	 * Value used by the effect/surface selects to mean "whatever the chosen
	 * preset ships with". Kept distinct from 'none', which explicitly turns
	 * the preset's own effect off.
	 */
	public const INHERIT = '';

	/**
	 * Builds the `groups` array for an Elementor SELECT control, keeping
	 * presets organized by category in the panel.
	 */
	public static function get_select_groups(): array {
		// Elementor's Select control renders a plain <option> for any group
		// entry that is a string instead of a { label, options } array.
		$groups = array(
			'' => esc_html__( 'None (start from scratch)', 'oblique-buttons-for-elementor' ),
		);

		foreach ( Preset_Registry::get_all() as $preset ) {
			$category = $preset['category'];

			if ( ! isset( $groups[ $category ] ) ) {
				$groups[ $category ] = array(
					'label'   => Preset_Registry::get_category_label( $category ),
					'options' => array(),
				);
			}

			$groups[ $category ]['options'][ $preset['id'] ] = $preset['name'];
		}

		return array_values( $groups );
	}

	public static function get_css_class_for_settings( array $settings ): string {
		$preset_id = $settings['preset'] ?? '';

		if ( '' === $preset_id || ! Preset_Registry::exists( $preset_id ) ) {
			return '';
		}

		return Preset_Registry::get_css_class( $preset_id );
	}

	/**
	 * Resolves what a widget instance actually renders for a given key.
	 *
	 * The user's own choice always wins; INHERIT falls back to whatever the
	 * selected preset declares; an unset preset key resolves to 'none'.
	 */
	public static function resolve( array $settings, string $control_name, string $preset_key ): string {
		$chosen = $settings[ $control_name ] ?? self::INHERIT;

		if ( self::INHERIT !== $chosen ) {
			return $chosen;
		}

		$preset_id = $settings['preset'] ?? '';
		$preset    = '' === $preset_id ? null : Preset_Registry::get( $preset_id );

		return $preset[ $preset_key ] ?? 'none';
	}

	/**
	 * Editor condition that reveals an effect's style controls when the
	 * effect is active - either because the user picked it explicitly, or
	 * because they left the select on "Preset Default" and the chosen preset
	 * ships with it.
	 *
	 * Elementor evaluates nested condition terms recursively in both PHP and
	 * the editor JS, so this stays accurate live in the panel.
	 *
	 * @param string $control_name Effect select control, e.g. 'hover_effect'.
	 * @param string $preset_key   Matching preset metadata key.
	 * @param array  $values       Effect values that count as a match.
	 */
	public static function effect_conditions( string $control_name, string $preset_key, array $values ): array {
		$preset_ids = array();

		foreach ( $values as $value ) {
			$preset_ids = array_merge( $preset_ids, Preset_Registry::get_ids_by( $preset_key, $value ) );
		}

		return array(
			'relation' => 'or',
			'terms'    => array(
				array(
					'name'     => $control_name,
					'operator' => 'in',
					'value'    => $values,
				),
				array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => $control_name,
							'operator' => '===',
							'value'    => self::INHERIT,
						),
						array(
							'name'     => 'preset',
							'operator' => 'in',
							'value'    => array_values( array_unique( $preset_ids ) ),
						),
					),
				),
			),
		);
	}
}
