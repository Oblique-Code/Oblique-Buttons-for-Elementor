<?php
/**
 * Gradient preset definitions.
 *
 * @return array<int, array{id: string, name: string, category: string}>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(
	array(
		'id'       => 'gradient',
		'name'     => esc_html__( 'Gradient', 'oblique-buttons-for-elementor' ),
		'category' => 'solid',
	),
);
