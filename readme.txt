=== Oblique Buttons for Elementor ===
Contributors: nurulanam
Tags: elementor, button, widget, elementor addon, button group
Requires at least: 6.0
Tested up to: 7.0.3
Requires PHP: 7.4
Elementor tested up to: 4.2.2
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Beautiful Elementor buttons with 42 presets and deep control over every effect. Fully free.

== Description ==

Oblique Buttons for Elementor adds two widgets to the Elementor editor - **Oblique Button** and **Oblique Button Group**. Pick a ready-made preset, then customize every property, including the preset's own effect, with full Elementor controls.

**This plugin is completely free. There is no Pro version, no paid upgrade, and no locked features.**

Current functionality:

* Two widgets: Oblique Button and Oblique Button Group, both under the Elementor General category
* Content: Text, Link (with Open in New Window / Nofollow), Icon, Icon Position, Icon Spacing, Accessible Label for icon-only buttons
* Icon styling: Icon Size, Icon Color, Icon Color on hover, and a vertical offset for optically aligning the icon with the text
* Width control: Auto (fit content), Full Width, or a custom responsive width in px, %, em, rem, or vw
* Two independent alignment controls: Button Position (where the button sits in the widget area) and Text Alignment (where the text and icon sit inside the button, including Space Between)
* 42 built-in presets across Signature, Solid, Outline, Modern, Animated, and Creative categories — presets only set defaults, any style control you change always overrides the preset
* Signature presets are the distinctive, motion-led ones: Icon Orbit (a circular icon badge that spins on hover), Icon Capsule, Arrow Launch (corners morph to a pill while the icon flies out and back), Icon Tilt, Radius Morph, Hard Shadow, Glow Ring, Gradient Sweep, Spotlight, Stroke Grow, Elevate and Letter Track
* An Accent Color control retints the highlight a Signature preset is built around — the icon badge, offset shadow, ring or spotlight — in one click
* Every effect is fully customizable: pick the Shine preset and you get Shine Color, Width, Angle and Speed controls; Glow gives you Color, Size and Spread; Underline gives you Color, Thickness, Distance and direction. The same goes for Fill, Pulse and Border Draw
* Effects are not locked to their preset — apply Shine to any preset, switch a preset's own effect off, or add a Glass, Gradient Border or Neumorphic surface to any button, each with its own detailed controls
* Custom Transform hover mode with independent Offset X/Y, Scale, Rotate and Skew sliders
* Full style controls for Normal, Hover, Focus, and Active states: typography, background (including gradients), text color, border, border radius, box shadow, padding, and minimum width
* Basic hover, active, and icon animations (Grow, Shrink, Lift, Press, Rotate, Skew, icon movement), automatically disabled for visitors who prefer reduced motion
* Renders as a semantic `<a>` when a link is set or a real `<button>` otherwise, with a visible keyboard focus state by default
* Button Group: a repeater where every button has its own text, link, preset, icon and effect, plus responsive direction, gap, alignment, equal width, and a Stack On breakpoint for mobile
* CSS is only loaded on pages that actually contain one of the widgets

Planned for a future release: global and user-saved presets, a visual Preset Builder, preset import/export, and design tokens - all of which will also be free.

== Requirements ==

* Elementor (free) must be installed and active
* Elementor 3.20.0 or greater
* PHP 7.4 or greater

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/oblique-buttons-for-elementor` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Make sure Elementor is installed and active.
4. Edit any page with Elementor and search for "Oblique" in the widget panel.

== Frequently Asked Questions ==

= Does this require Elementor Pro? =

No, the free version of Elementor is sufficient.

= Is there a paid or Pro version of this plugin? =

No. Every feature is included for free, and there are no plans to gate features behind a paid tier.

= Can I use a preset's effect on a different preset? =

Yes. Effects are independent of presets. Open the Effects section and pick any hover effect - Shine, Glow, Pulse, Fill, Underline or Border Draw - and it applies to whichever preset you are using, with its own detailed style controls. You can also set it to None to switch off an effect a preset ships with, or apply a Glass, Gradient Border or Neumorphic surface to any button.

= Can I style the button yet? =

Yes. Pick a preset in the Preset panel, then use the Style tab (Normal / Hover / Focus / Active) to change any property — your changes always take priority over the preset.

= How do I go back to the preset's original look after customizing a control? =

Use the small reset arrow next to that control's label in the Elementor panel. It appears whenever a value differs from "use the preset," and clicking it clears your override.

== Changelog ==

= 0.1.0 =
* Initial release
* Oblique Button widget with 42 presets across six categories, including a Signature set of motion-led designs
* Fully customizable hover effects (Fill, Shine, Glow, Pulse, Underline, Border Draw) and surfaces (Glass, Gradient Border, Neumorphic), each with its own style controls
* Oblique Button Group widget with per-button presets and responsive layout
* Icon, width, alignment, transform and responsive controls throughout
