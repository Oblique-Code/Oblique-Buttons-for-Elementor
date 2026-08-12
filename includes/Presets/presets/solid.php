<?php
/**
 * Solid preset definitions.
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
);
