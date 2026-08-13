<?php
/**
 * Solid preset definitions.
 *
 * Each entry is pure metadata. `hover_effect` and `surface` name the effect
 * the preset ships with; the widget uses them as defaults that the user can
 * override or switch off entirely. See Preset_Registry for the full schema.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'primary',
		'name'     => esc_html__( 'Primary', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
	array(
		'id'       => 'secondary',
		'name'     => esc_html__( 'Secondary', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
	array(
		'id'       => 'dark',
		'name'     => esc_html__( 'Dark', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
	array(
		'id'       => 'light',
		'name'     => esc_html__( 'Light', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
	array(
		'id'       => 'success',
		'name'     => esc_html__( 'Success', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
	array(
		'id'       => 'gradient',
		'name'     => esc_html__( 'Gradient', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
);
