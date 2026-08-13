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
		'id'       => 'glass',
		'name'     => esc_html__( 'Glass', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
		'surface'  => 'glass',
	),
	array(
		'id'       => 'soft-shadow',
		'name'     => esc_html__( 'Soft Shadow', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
	),
	array(
		'id'       => 'floating',
		'name'     => esc_html__( 'Floating', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
	),
	array(
		'id'       => 'pill',
		'name'     => esc_html__( 'Pill', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
	),
	array(
		'id'       => 'neumorphic',
		'name'     => esc_html__( 'Neumorphic', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
		'surface'  => 'neumorphic',
	),
	array(
		'id'       => 'gradient-border',
		'name'     => esc_html__( 'Gradient Border', 'oblique-buttons-for-elementor' ),
		'category' => 'modern',
		'surface'  => 'gradient-border',
	),
);
