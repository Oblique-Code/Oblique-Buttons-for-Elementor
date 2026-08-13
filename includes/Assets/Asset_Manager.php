<?php

namespace Oblique\Buttons\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers (but does not enqueue) frontend assets.
 *
 * Registration only happens here - actual enqueueing is delegated to
 * Elementor via Widget_Button::get_style_depends()/get_script_depends(), so
 * a page without an Oblique Button never loads these files at all. See
 * section 14 of oblique-buttons-for-elementor.md.
 */
class Asset_Manager {

	public const STYLE_HANDLE            = 'oblique-buttons';
	public const ANIMATIONS_STYLE_HANDLE = 'oblique-buttons-animations';
	public const EFFECTS_STYLE_HANDLE    = 'oblique-buttons-effects';
	public const GROUP_STYLE_HANDLE      = 'oblique-buttons-group';

	public function register(): void {
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );
	}

	public function register_styles(): void {
		wp_register_style(
			self::STYLE_HANDLE,
			OBLIQUE_BUTTONS_URL . 'assets/css/button.css',
			array(),
			OBLIQUE_BUTTONS_VERSION
		);

		wp_register_style(
			self::ANIMATIONS_STYLE_HANDLE,
			OBLIQUE_BUTTONS_URL . 'assets/css/animations.css',
			array( self::STYLE_HANDLE ),
			OBLIQUE_BUTTONS_VERSION
		);

		wp_register_style(
			self::EFFECTS_STYLE_HANDLE,
			OBLIQUE_BUTTONS_URL . 'assets/css/effects.css',
			array( self::STYLE_HANDLE ),
			OBLIQUE_BUTTONS_VERSION
		);

		wp_register_style(
			self::GROUP_STYLE_HANDLE,
			OBLIQUE_BUTTONS_URL . 'assets/css/button-group.css',
			array( self::STYLE_HANDLE ),
			OBLIQUE_BUTTONS_VERSION
		);
	}
}
