<?php

namespace Oblique\Buttons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Oblique Button widget.
 *
 * Phase 1 scope: registration plus the minimum content needed to place a
 * button on the page. Presets, style controls, and animations are added in
 * later phases per oblique-buttons-for-elementor.md.
 */
class Widget_Button extends Widget_Base {

	public function get_name(): string {
		return 'oblique-button';
	}

	public function get_title(): string {
		return esc_html__( 'Oblique Button', 'oblique-buttons-for-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-button';
	}

	public function get_categories(): array {
		return array( 'general' );
	}

	public function get_keywords(): array {
		return array( 'button', 'cta', 'link', 'oblique' );
	}

	protected function register_controls(): void {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Button', 'oblique-buttons-for-elementor' ),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Text', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Click Here', 'oblique-buttons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter button text', 'oblique-buttons-for-elementor' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'oblique-buttons-for-elementor' ),
				'default'     => array(
					'url' => '',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button', 'class', 'oblique-button' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}

		$tag = ! empty( $settings['link']['url'] ) ? 'a' : 'span';
		?>
		<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
			<?php echo esc_html( $settings['text'] ); ?>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
	}
}
