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
}
