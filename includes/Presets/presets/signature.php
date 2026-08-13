<?php
/**
 * Signature preset definitions.
 *
 * The distinctive, motion-led designs - icon badges that spin or slide,
 * corners that morph, sweeps and spotlights. Presets flagged with
 * `accent` expose an Accent Color control; those flagged `needs_icon`
 * are built around an icon and show a hint in the panel when none is set.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'         => 'icon-orbit',
		'name'       => esc_html__( 'Icon Orbit', 'oblique-buttons-for-elementor' ),
		'category'   => 'signature',
		'accent'     => true,
		'needs_icon' => true,
	),
	array(
		'id'         => 'icon-capsule',
		'name'       => esc_html__( 'Icon Capsule', 'oblique-buttons-for-elementor' ),
		'category'   => 'signature',
		'accent'     => true,
		'needs_icon' => true,
	),
	array(
		'id'         => 'arrow-launch',
		'name'       => esc_html__( 'Arrow Launch', 'oblique-buttons-for-elementor' ),
		'category'   => 'signature',
		'accent'     => true,
		'needs_icon' => true,
	),
	array(
		'id'         => 'icon-tilt',
		'name'       => esc_html__( 'Icon Tilt', 'oblique-buttons-for-elementor' ),
		'category'   => 'signature',
		'accent'     => true,
		'needs_icon' => true,
	),
	array(
		'id'       => 'radius-morph',
		'name'     => esc_html__( 'Radius Morph', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'hard-shadow',
		'name'     => esc_html__( 'Hard Shadow', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'glow-ring',
		'name'     => esc_html__( 'Glow Ring', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'gradient-sweep',
		'name'     => esc_html__( 'Gradient Sweep', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
	),
	array(
		'id'       => 'spotlight',
		'name'     => esc_html__( 'Spotlight', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'stroke-grow',
		'name'     => esc_html__( 'Stroke Grow', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'elevate',
		'name'     => esc_html__( 'Elevate', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
	array(
		'id'       => 'letter-track',
		'name'     => esc_html__( 'Letter Track', 'oblique-buttons-for-elementor' ),
		'category' => 'signature',
		'accent'   => true,
	),
);
