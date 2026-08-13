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
		'name'     => esc_html__( 'Classic Outline', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
	array(
		'id'       => 'rounded-outline',
		'name'     => esc_html__( 'Rounded Outline', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
	array(
		'id'       => 'thick-border',
		'name'     => esc_html__( 'Thick Border', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
	array(
		'id'       => 'minimal-outline',
		'name'     => esc_html__( 'Minimal Outline', 'oblique-buttons-for-elementor' ),
		'category' => 'outline',
	),
	array(
		'id'           => 'animated-border',
		'name'         => esc_html__( 'Animated Border', 'oblique-buttons-for-elementor' ),
		'category'     => 'outline',
		'hover_effect' => 'border-draw',
	),
);
