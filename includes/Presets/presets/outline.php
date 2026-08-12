<?php
/**
 * Outline preset definitions.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'outline',
		'name'     => esc_html__( 'Outline', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
	array(
		'id'       => 'rounded-outline',
		'name'     => esc_html__( 'Rounded Outline', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
);
