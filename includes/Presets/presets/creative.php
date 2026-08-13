<?php
/**
 * Creative preset definitions.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'skew',
		'name'     => esc_html__( 'Skew', 'oblique-buttons-for-elementor' ),
		'category' => 'creative',
	),
	array(
		'id'           => 'underline',
		'name'         => esc_html__( 'Underline', 'oblique-buttons-for-elementor' ),
		'category'     => 'creative',
		'hover_effect' => 'underline',
	),
	array(
		'id'       => 'split-color',
		'name'     => esc_html__( 'Split Color', 'oblique-buttons-for-elementor' ),
		'category' => 'creative',
	),
	array(
		'id'       => 'corner-accent',
		'name'     => esc_html__( 'Corner Accent', 'oblique-buttons-for-elementor' ),
		'category' => 'creative',
	),
	array(
		'id'       => 'dual-tone',
		'name'     => esc_html__( 'Dual Tone', 'oblique-buttons-for-elementor' ),
		'category' => 'creative',
	),
	array(
		'id'       => 'morph',
		'name'     => esc_html__( 'Morph', 'oblique-buttons-for-elementor' ),
		'category' => 'creative',
	),
);
