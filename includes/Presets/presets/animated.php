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
		'id'           => 'slide-background',
		'name'         => esc_html__( 'Slide Background', 'oblique-buttons-for-elementor' ),
		'category'     => 'animated',
		'hover_effect' => 'fill-right',
	),
	array(
		'id'           => 'fill-left',
		'name'         => esc_html__( 'Fill From Left', 'oblique-buttons-for-elementor' ),
		'category'     => 'animated',
		'hover_effect' => 'fill-left',
	),
	array(
		'id'           => 'fill-right',
		'name'         => esc_html__( 'Fill From Right', 'oblique-buttons-for-elementor' ),
		'category'     => 'animated',
		'hover_effect' => 'fill-right',
	),
	array(
		'id'           => 'shine',
		'name'         => esc_html__( 'Shine', 'oblique-buttons-for-elementor' ),
		'category'     => 'animated',
		'hover_effect' => 'shine',
	),
	array(
		'id'             => 'arrow-reveal',
		'name'           => esc_html__( 'Arrow Reveal', 'oblique-buttons-for-elementor' ),
		'category'       => 'animated',
		'icon_animation' => 'move-right',
	),
	array(
		'id'             => 'icon-slide',
		'name'           => esc_html__( 'Icon Slide', 'oblique-buttons-for-elementor' ),
		'category'       => 'animated',
		'icon_animation' => 'move-right',
	),
	array(
		'id'           => 'border-draw',
		'name'         => esc_html__( 'Border Draw', 'oblique-buttons-for-elementor' ),
		'category'     => 'animated',
		'hover_effect' => 'border-draw',
	),
);
