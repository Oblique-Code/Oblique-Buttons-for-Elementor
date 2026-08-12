<?php

namespace Oblique\Buttons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Oblique\Buttons\Assets\Asset_Manager;
use Oblique\Buttons\Presets\Preset_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Oblique Button widget.
 *
 * Phase 1 scope (see oblique-buttons-for-elementor.md, sections 3-5 and 17):
 * content controls, the 12-preset selector, Normal/Hover/Focus/Active style
 * states, responsive layout controls, basic hover/icon animations, and
 * accessibility/performance defaults. The Preset Builder, Button Group, and
 * global presets are later phases.
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
		return array( 'button', 'cta', 'link', 'oblique', 'preset' );
	}

	/**
	 * Declares the styles this widget type needs.
	 *
	 * Elementor calls this both on real, fully-configured instances and on
	 * bare widget-type prototypes (e.g. when preloading every widget's CSS
	 * into the editor preview), so it must never touch instance settings —
	 * `get_settings_for_display()` is unsafe here and throws a fatal error
	 * on those prototype calls. The upside is still the one that matters
	 * per section 14 of the spec: a page with no Oblique Button on it never
	 * loads either stylesheet at all.
	 */
	public function get_style_depends(): array {
		return array( Asset_Manager::STYLE_HANDLE, Asset_Manager::ANIMATIONS_STYLE_HANDLE );
	}

	public function get_script_depends(): array {
		return array();
	}

	protected function register_controls(): void {
		$this->register_content_controls();
		$this->register_preset_controls();
		$this->register_style_controls();
		$this->register_icon_style_controls();
		$this->register_animation_controls();
	}

	private function register_content_controls(): void {
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
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'oblique-buttons-for-elementor' ),
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'accessible_label',
			array(
				'label'       => esc_html__( 'Accessible Label', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Read by screen readers. Required when the button has an icon but no visible text.', 'oblique-buttons-for-elementor' ),
				'condition'   => array( 'text' => '' ),
			)
		);

		$this->add_control(
			'icon_heading',
			array(
				'label'     => esc_html__( 'Icon', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => '',
				),
			)
		);

		$this->add_control(
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

		$this->add_responsive_control(
			'icon_spacing',
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
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-icon-gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'icon[value]!' => '' ),
			)
		);

		$this->end_controls_section();
	}

	private function register_preset_controls(): void {
		$this->start_controls_section(
			'section_preset',
			array(
				'label' => esc_html__( 'Preset', 'oblique-buttons-for-elementor' ),
			)
		);

		$this->add_control(
			'preset',
			array(
				'label'       => esc_html__( 'Preset', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::SELECT,
				'groups'      => Preset_Manager::get_select_groups(),
				'default'     => 'primary',
				'description' => esc_html__( 'Presets only set defaults. Any style control you change below always overrides the preset - use its reset arrow to fall back to the preset again.', 'oblique-buttons-for-elementor' ),
			)
		);

		$this->end_controls_section();
	}

	private function register_icon_style_controls(): void {
		$this->start_controls_section(
			'section_style_icon',
			array(
				'label'     => esc_html__( 'Icon', 'oblique-buttons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'icon[value]!' => '' ),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px'  => array(
						'min' => 6,
						'max' => 100,
					),
					'em'  => array(
						'min'  => 0.1,
						'max'  => 5,
						'step' => 0.1,
					),
					'rem' => array(
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

		$this->add_control(
			'icon_color',
			array(
				'label'       => esc_html__( 'Icon Color', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::COLOR,
				'description' => esc_html__( 'Leave empty to match the button text color.', 'oblique-buttons-for-elementor' ),
				'selectors'   => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-icon-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Color (Hover)', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button:hover' => '--ob-btn-icon-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_vertical_offset',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => -20,
						'max' => 20,
					),
				),
				'description' => esc_html__( 'Nudge the icon up or down to optically align it with the text.', 'oblique-buttons-for-elementor' ),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-icon-offset-y: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	private function register_style_controls(): void {
		$this->start_controls_section(
			'section_style_button',
			array(
				'label' => esc_html__( 'Button Style', 'oblique-buttons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->register_style_tab_normal();
		$this->register_style_tab_hover();
		$this->register_style_tab_focus();
		$this->register_style_tab_active();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Button Position', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
				// Meaningless when the button already spans the full width.
				'condition' => array( 'width_type!' => 'full' ),
				'separator' => 'before',
			)
		);

		$this->end_controls_section();
	}

	private function register_style_tab_normal(): void {
		$this->start_controls_tab(
			'tab_button_normal',
			array( 'label' => esc_html__( 'Normal', 'oblique-buttons-for-elementor' ) )
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .oblique-button',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .oblique-button',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-color: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .oblique-button',
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .oblique-button',
			)
		);

		$this->add_responsive_control(
			'padding',
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
			'min_width',
			array(
				'label'      => esc_html__( 'Minimum Width', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 600,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'width_type',
			array(
				'label'        => esc_html__( 'Width', 'oblique-buttons-for-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'auto',
				'options'      => array(
					'auto'   => esc_html__( 'Auto (fit content)', 'oblique-buttons-for-elementor' ),
					'full'   => esc_html__( 'Full Width', 'oblique-buttons-for-elementor' ),
					'custom' => esc_html__( 'Custom', 'oblique-buttons-for-elementor' ),
				),
				// A wrapper class rather than a selector, so the Full Width
				// rule and the Custom slider below can never both target the
				// same element at the same time and fight over specificity.
				'prefix_class' => 'oblique-btn-width-',
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'      => esc_html__( 'Custom Width', 'oblique-buttons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'vw' ),
				'range'      => array(
					'px'  => array(
						'min' => 0,
						'max' => 800,
					),
					'%'   => array(
						'min' => 0,
						'max' => 100,
					),
					'em'  => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 0.1,
					),
					'rem' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 0.1,
					),
					'vw'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oblique-button' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array( 'width_type' => 'custom' ),
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'       => esc_html__( 'Text Alignment', 'oblique-buttons-for-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Start', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'        => array(
						'title' => esc_html__( 'Center', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'      => array(
						'title' => esc_html__( 'End', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					),
					'space-between' => array(
						'title' => esc_html__( 'Space Between', 'oblique-buttons-for-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'description' => esc_html__( 'Positions the text and icon inside the button. Only has a visible effect when the button is wider than its content (Full Width, Custom Width, or a Minimum Width).', 'oblique-buttons-for-elementor' ),
				'selectors'   => array(
					'{{WRAPPER}} .oblique-button' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
	}

	private function register_style_tab_hover(): void {
		$this->start_controls_tab(
			'tab_button_hover',
			array( 'label' => esc_html__( 'Hover', 'oblique-buttons-for-elementor' ) )
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background_hover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .oblique-button:hover',
			)
		);

		$this->add_control(
			'text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .oblique-button:hover',
			)
		);

		$this->add_control(
			'hover_transition_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Hover motion (lift, grow, icon movement, etc.) is set in the Animation section.', 'oblique-buttons-for-elementor' ),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$this->end_controls_tab();
	}

	private function register_style_tab_focus(): void {
		$this->start_controls_tab(
			'tab_button_focus',
			array( 'label' => esc_html__( 'Focus', 'oblique-buttons-for-elementor' ) )
		);

		$focus_selector = '{{WRAPPER}} .oblique-button:focus-visible, {{WRAPPER}} .oblique-button:focus';

		$this->add_control(
			'background_color_focus',
			array(
				'label'     => esc_html__( 'Background Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$focus_selector => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color_focus',
			array(
				'label'     => esc_html__( 'Text Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$focus_selector => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'outline_color_focus',
			array(
				'label'     => esc_html__( 'Outline Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button' => '--ob-btn-focus-outline-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'border_color_focus',
			array(
				'label'     => esc_html__( 'Border Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$focus_selector => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow_focus',
				'selector' => $focus_selector,
			)
		);

		$this->end_controls_tab();
	}

	private function register_style_tab_active(): void {
		$this->start_controls_tab(
			'tab_button_active',
			array( 'label' => esc_html__( 'Active', 'oblique-buttons-for-elementor' ) )
		);

		$this->add_control(
			'background_color_active',
			array(
				'label'     => esc_html__( 'Background Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button:active' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_color_active',
			array(
				'label'     => esc_html__( 'Text Color', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oblique-button:active' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow_active',
				'selector' => '{{WRAPPER}} .oblique-button:active',
			)
		);

		$this->end_controls_tab();
	}

	private function register_animation_controls(): void {
		$this->start_controls_section(
			'section_animation',
			array(
				'label' => esc_html__( 'Animation', 'oblique-buttons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
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
					'rotate' => esc_html__( 'Rotate', 'oblique-buttons-for-elementor' ),
					'skew'   => esc_html__( 'Skew', 'oblique-buttons-for-elementor' ),
				),
			)
		);

		$this->add_control(
			'active_animation',
			array(
				'label'   => esc_html__( 'Active (Click) Animation', 'oblique-buttons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => esc_html__( 'None', 'oblique-buttons-for-elementor' ),
					'grow'   => esc_html__( 'Grow', 'oblique-buttons-for-elementor' ),
					'shrink' => esc_html__( 'Shrink', 'oblique-buttons-for-elementor' ),
				),
			)
		);

		$this->add_control(
			'icon_animation',
			array(
				'label'     => esc_html__( 'Icon Animation', 'oblique-buttons-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'       => esc_html__( 'None', 'oblique-buttons-for-elementor' ),
					'move-right' => esc_html__( 'Move Right', 'oblique-buttons-for-elementor' ),
					'move-left'  => esc_html__( 'Move Left', 'oblique-buttons-for-elementor' ),
					'move-up'    => esc_html__( 'Move Up', 'oblique-buttons-for-elementor' ),
					'move-down'  => esc_html__( 'Move Down', 'oblique-buttons-for-elementor' ),
					'rotate'     => esc_html__( 'Rotate', 'oblique-buttons-for-elementor' ),
					'bounce'     => esc_html__( 'Bounce', 'oblique-buttons-for-elementor' ),
					'scale'      => esc_html__( 'Scale', 'oblique-buttons-for-elementor' ),
				),
				'condition' => array( 'icon[value]!' => '' ),
			)
		);

		$this->add_control(
			'reduced_motion_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'All animations are automatically disabled for visitors who have "reduce motion" enabled in their operating system.', 'oblique-buttons-for-elementor' ),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$has_link = ! empty( $settings['link']['url'] );
		$has_icon = ! empty( $settings['icon']['value'] );
		$has_text = '' !== trim( (string) $settings['text'] );

		$tag = $has_link ? 'a' : 'button';

		$this->add_render_attribute( 'button', 'class', 'oblique-button' );

		$preset_class = Preset_Manager::get_css_class_for_settings( $settings );
		if ( '' !== $preset_class ) {
			$this->add_render_attribute( 'button', 'class', $preset_class );
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'button', 'class', 'oblique-button--icon-' . $settings['icon_position'] );
		}

		if ( ! empty( $settings['hover_animation'] ) && 'none' !== $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'data-ob-hover-fx', $settings['hover_animation'] );
		}

		if ( ! empty( $settings['active_animation'] ) && 'none' !== $settings['active_animation'] ) {
			$this->add_render_attribute( 'button', 'data-ob-active-fx', $settings['active_animation'] );
		}

		if ( $has_icon && ! empty( $settings['icon_animation'] ) && 'none' !== $settings['icon_animation'] ) {
			$this->add_render_attribute( 'button', 'data-ob-icon-fx', $settings['icon_animation'] );
		}

		if ( $has_link ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		} else {
			$this->add_render_attribute( 'button', 'type', 'button' );
		}

		if ( ! $has_text && '' !== $settings['accessible_label'] ) {
			$this->add_render_attribute( 'button', 'aria-label', $settings['accessible_label'] );
		}

		$icon_html = '';
		if ( $has_icon ) {
			// The icon is wrapped in a span rather than styled directly:
			// Icons_Manager puts the class we pass onto whatever element it
			// emits, which is an <i> in font mode but the <svg> itself in
			// SVG mode (and for uploaded SVGs). Sizing and coloring that
			// element directly is therefore unreliable, so all icon styling
			// targets this wrapper and cascades inward instead.
			ob_start();
			Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
			$icon_html = '<span class="oblique-button__icon">' . ob_get_clean() . '</span>';
		}

		$text_html = $has_text ? '<span class="oblique-button__text">' . esc_html( $settings['text'] ) . '</span>' : '';

		$icon_position = $settings['icon_position'] ?? 'left';
		$inner         = 'right' === $icon_position ? $text_html . $icon_html : $icon_html . $text_html;
		?>
		<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $inner is built from esc_html() text and Icons_Manager::render_icon(), which escapes its own output.
			echo $inner;
			?>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
	}
}
