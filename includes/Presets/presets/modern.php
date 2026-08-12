<?php
/**
 * Modern preset definitions.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'pill',
		'name'     => esc_html__( 'Pill', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
	),
	array(
		'id'       => 'soft-shadow',
		'name'     => esc_html__( 'Soft Shadow', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
	),
);
