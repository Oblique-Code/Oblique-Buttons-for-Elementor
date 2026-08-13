<?php

namespace Oblique\Buttons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Oblique\Buttons\Assets\Asset_Manager;
use Oblique\Buttons\Presets\Preset_Manager;
use Oblique\Buttons\Presets\Preset_Registry;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Oblique Button Group widget.
 *
 * A repeater of buttons sharing one layout. Each row picks its own preset
 * and effect, so a group can mix a solid primary with an outline secondary
 * without either being a separate widget. Layout, gap, alignment, equal
 * width and mobile stacking are all responsive.
 */
class Widget_Button_Group extends Widget_Base {

	public function get_name(): string {
		return 'oblique-button-group';
	}

	public function get_title(): string {
		return esc_html__( 'Oblique Button Group', 'oblique-buttons-for-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-button';
	}

	public function get_categories(): array {
		return array( 'general' );
	}

	public function get_keywords(): array {
		return array( 'button', 'group', 'cta', 'buttons', 'oblique' );
	}

	public function get_style_depends(): array {
		return array(
			Asset_Manager::STYLE_HANDLE,
			Asset_Manager::ANIMATIONS_STYLE_HANDLE,
			Asset_Manager::EFFECTS_STYLE_HANDLE,
			Asset_Manager::GROUP_STYLE_HANDLE,
		);
	}

	protected function register_controls(): void {
		$this->register_buttons_section();
		$this->register_layout_section();
		$this->register_style_section();
	}

	private function register_buttons_section(): void {
		$this->start_controls_section(
			'section_buttons',
			array(
				'label' => esc_html__( 'Buttons', 'oblique-buttons-for-elementor' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			array(
				'label'   => esc_html__( 'Text', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click Here', 'oblique-buttons-for-elementor' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'oblique-buttons-for-elementor' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'preset',
			array(
				'label'   => esc_html__( 'Preset', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'groups'  => Preset_Manager::get_select_groups(),
				'default' => 'primary',
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label' => esc_html__( 'Icon', 'oblique-buttons-for-elementor' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Before Text', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'After Text', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => false,
				'condition' => array( 'icon[value]!' => '' ),
			)
		);

		$repeater->add_control(
			'hover_effect',
			array(
				'label'   => esc_html__( 'Hover Effect', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => Preset_Manager::INHERIT,
				'options' => array(
					Preset_Manager::INHERIT => esc_html__( 'Preset Default', 'oblique-buttons-for-elementor' ),
					'none'                  => esc_html__( 'None', 'oblique-buttons-for-elementor' ),
					'fill-left'             => esc_html__( 'Fill - From Left', 'oblique-buttons-for-elementor' ),
					'fill-right'            => esc_html__( 'Fill - From Right', 'oblique-buttons-for-elementor' ),
					'fill-up'               => esc_html__( 'Fill - From Bottom', 'oblique-buttons-for-elementor' ),
					'fill-down'             => esc_html__( 'Fill - From Top', 'oblique-buttons-for-elementor' ),
					'fill-center'           => esc_html__( 'Fill - Center Expand', 'oblique-buttons-for-elementor' ),
					'shine'                 => esc_html__( 'Shine', 'oblique-buttons-for-elementor' ),
					'glow'                  => esc_html__( 'Glow', 'oblique-buttons-for-elementor' ),
					'pulse'                 => esc_html__( 'Pulse', 'oblique-buttons-for-elementor' ),
					'underline'             => esc_html__( 'Underline', 'oblique-buttons-for-elementor' ),
					'border-draw'           => esc_html__( 'Border Draw', 'oblique-buttons-for-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'hover_animation',
			array(
				'label'   => esc_html__( 'Hover Animation', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => esc_html__( 'None', 'oblique-buttons-for-elementor' ),
					'grow'   => esc_html__( 'Grow', 'oblique-buttons-for-elementor' ),
					'shrink' => esc_html__( 'Shrink', 'oblique-buttons-for-elementor' ),
					'lift'   => esc_html__( 'Lift', 'oblique-buttons-for-elementor' ),
					'press'  => esc_html__( 'Press', 'oblique-buttons-for-elementor' ),
				),
			)
		);

		$repeater->add_control(
			'accessible_label',
			array(
				'label'       => esc_html__( 'Accessible Label', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Read by screen readers. Required when this button has an icon but no visible text.', 'oblique-buttons-for-elementor' ),
				'condition'   => array( 'text' => '' ),
			)
		);

		$this->add_control(
			'buttons',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text || "Button" }}}',
				'default'     => array(
					array(
						'text'   => esc_html__( 'Get Started', 'oblique-buttons-for-elementor' ),
						'preset' => 'primary',
					),
					array(
						'text'   => esc_html__( 'Learn More', 'oblique-buttons-for-elementor' ),
						'preset' => 'outline',
					),
				),
			)
		);

		$this->end_controls_section();
	}

	private function register_layout_section(): void {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Layout', 'oblique-buttons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'direction',
			array(
				'label'     => esc_html__( 'Direction', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'row',
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Horizontal', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column' => array(
						'title' => esc_html__( 'Vertical', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button-group' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'gap',
			array(
				'label'      => esc_html__( 'Gap', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array(
						'min' => 0,
						'max' => 100,
					),
					'em'  => array(
						'min'  => 0,
						'max'  => 8,
						'step' => 0.1,
					),
					'rem' => array(
						'min'  => 0,
						'max'  => 8,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button-group' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'group_align',
			array(
				'label'     => esc_html__( 'Alignment', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Start', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-align-start-h',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-align-center-h',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'End', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-align-end-h',
					),
					'stretch'    => array(
						'title' => esc_html__( 'Stretch', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-align-stretch-h',
					),
				),
				'default'   => 'flex-start',
				'selectors' => array(
					'{{WRAPPER}} .oblique-button-group' => 'justify-content: {{VALUE}}; align-items: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'equal_width',
			array(
				'label'        => esc_html__( 'Equal Width', 'oblique-buttons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Makes every button share the available space evenly.', 'oblique-buttons-for-elementor' ),
				'return_value' => 'yes',
				'selectors'    => array(
					'{{WRAPPER}} .oblique-button-group .oblique-button' => 'flex: 1 1 0; width: auto;',
				),
			)
		);

		$this->add_control(
			'stack_on',
			array(
				'label'        => esc_html__( 'Stack On', 'oblique-buttons-for-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'none',
				'options'      => array(
					'none'   => esc_html__( 'Never', 'oblique-buttons-for-elementor' ),
					'tablet' => esc_html__( 'Tablet & Down', 'oblique-buttons-for-elementor' ),
					'mobile' => esc_html__( 'Mobile Only', 'oblique-buttons-for-elementor' ),
				),
				'description'  => esc_html__( 'Stacks the buttons vertically and makes them full width at the chosen breakpoint.', 'oblique-buttons-for-elementor' ),
				'prefix_class' => 'oblique-group-stack-',
			)
		);

		$this->end_controls_section();
	}

	private function register_style_section(): void {
		$this->start_controls_section(
			'section_group_style',
			array(
				'label' => esc_html__( 'Buttons Style', 'oblique-buttons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'style_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'These settings apply to every button in the group. Each button keeps its own preset, icon and effect from the Buttons tab.', 'oblique-buttons-for-elementor' ),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'group_typography',
				'selector' => '{{WRAPPER}} .oblique-button',
			)
		);

		$this->add_responsive_control(
			'group_padding',
			array(
				'label'      => esc_html__( 'Padding', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'group_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'group_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 6,
						'max' => 100,
					),
					'em' => array(
						'min'  => 0.1,
						'max'  => 5,
						'step' => 0.1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-icon-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'group_icon_spacing',
			array(
				'label'      => esc_html__( 'Icon Spacing', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
					'em' => array(
						'min'  => 0,
						'max'  => 4,
						'step' => 0.1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-icon-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['buttons'] ) ) {
			return;
		}

		$this->add_render_attribute( 'group', 'class', 'oblique-button-group' );
		?>
		<div <?php $this->print_render_attribute_string( 'group' ); ?>>
			<?php foreach ( $settings['buttons'] as $index => $button ) : ?>
				<?php $this->render_button( $button, $index ); ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Renders one repeater row.
	 *
	 * Mirrors Widget_Button::render() - same markup contract, same effect
	 * resolution - so every stylesheet and effect works identically whether
	 * a button came from the single widget or from a group row.
	 */
	private function render_button( array $button, int $index ): void {
		$key = 'button_' . $index;

		$has_link = ! empty( $button['link']['url'] );
		$has_icon = ! empty( $button['icon']['value'] );
		$has_text = '' !== trim( (string) ( $button['text'] ?? '' ) );

		$tag = $has_link ? 'a' : 'button';

		$this->add_render_attribute( $key, 'class', 'oblique-button' );

		$preset_id = $button['preset'] ?? '';
		if ( '' !== $preset_id && Preset_Registry::exists( $preset_id ) ) {
			$this->add_render_attribute( $key, 'class', Preset_Registry::get_css_class( $preset_id ) );
		}

		$hover_effect = Preset_Manager::resolve( $button, 'hover_effect', 'hover_effect' );
		if ( 'none' !== $hover_effect ) {
			$this->add_render_attribute( $key, 'data-ob-effect', $hover_effect );
		}

		$surface = Preset_Manager::resolve( $button, 'surface_style', 'surface' );
		if ( 'none' !== $surface ) {
			$this->add_render_attribute( $key, 'data-ob-surface', $surface );
		}

		$icon_animation = Preset_Manager::resolve( $button, 'icon_animation', 'icon_animation' );
		if ( $has_icon && 'none' !== $icon_animation ) {
			$this->add_render_attribute( $key, 'data-ob-icon-fx', $icon_animation );
		}

		if ( ! empty( $button['hover_animation'] ) && 'none' !== $button['hover_animation'] ) {
			$this->add_render_attribute( $key, 'data-ob-hover-fx', $button['hover_animation'] );
		}

		if ( $has_link ) {
			$this->add_link_attributes( $key, $button['link'] );
		} else {
			$this->add_render_attribute( $key, 'type', 'button' );
		}

		if ( ! $has_text && ! empty( $button['accessible_label'] ) ) {
			$this->add_render_attribute( $key, 'aria-label', $button['accessible_label'] );
		}

		$icon_html = '';
		if ( $has_icon ) {
			ob_start();
			Icons_Manager::render_icon( $button['icon'], array( 'aria-hidden' => 'true' ) );
			$icon_html = '<span class="oblique-button__icon">' . ob_get_clean() . '</span>';
		}

		$text_html = $has_text ? '<span class="oblique-button__text">' . esc_html( $button['text'] ) . '</span>' : '';

		$position = $button['icon_position'] ?? 'left';
		$inner    = 'right' === $position ? $text_html . $icon_html : $icon_html . $text_html;
		?>
		<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( $key ); ?>>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_html() text and Icons_Manager::render_icon(), which escapes its own output.
			echo $inner;
			?>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
	}
}
