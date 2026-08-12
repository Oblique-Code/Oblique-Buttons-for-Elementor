<?php
/**
 * Animated preset definitions.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'arrow-reveal',
		'name'     => esc_html__( 'Arrow Reveal', 'oblique-buttons-for-elementor' ),
		'category' => 'animated',
	),
	array(
		'id'       => 'shine',
		'name'     => esc_html__( 'Shine', 'oblique-buttons-for-elementor' ),
		'category' => 'animated',
	),
	array(
		'id'       => 'border-draw',
		'name'     => esc_html__( 'Border Draw', 'oblique-buttons-for-elementor' ),
		'category' => 'animated',
	),
);
