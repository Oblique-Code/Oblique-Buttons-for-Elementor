=== Oblique Buttons for Elementor ===
Contributors: nurulanam
Tags: elementor, button, widget, elementor addon
Requires at least: 6.0
Tested up to: 7.0.3
Requires PHP: 7.4
Elementor tested up to: 4.2.2
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds an Oblique Button widget to Elementor.

== Description ==

Oblique Buttons for Elementor adds a single **Oblique Button** widget to the Elementor editor: pick a ready-made preset, then customize every property with full Elementor controls.

Current functionality:

* Registers the Oblique Button widget under the Elementor General category
* Content: Text, Link (with Open in New Window / Nofollow), Icon, Icon Position, Icon Spacing, Accessible Label for icon-only buttons
* Icon styling: Icon Size, Icon Color, Icon Color on hover, and a vertical offset for optically aligning the icon with the text
* Width control: Auto (fit content), Full Width, or a custom responsive width in px, %, em, rem, or vw
* Two independent alignment controls: Button Position (where the button sits in the widget area) and Text Alignment (where the text and icon sit inside the button, including Space Between)
* 12 built-in presets across Solid, Outline, Modern, and Animated categories (Primary, Secondary, Dark, Light, Gradient, Outline, Rounded Outline, Pill, Soft Shadow, Arrow Reveal, Shine, Border Draw) — presets only set defaults, any style control you change always overrides the preset
* Full style controls for Normal, Hover, Focus, and Active states: typography, background (including gradients), text color, border, border radius, box shadow, padding, and minimum width
* Basic hover, active, and icon animations (Grow, Shrink, Lift, Press, Rotate, Skew, icon movement), automatically disabled for visitors who prefer reduced motion
* Renders as a semantic `<a>` when a link is set or a real `<button>` otherwise, with a visible keyboard focus state by default
* Button CSS is only loaded on pages that actually contain the widget; the animation CSS is only added when an instance uses an animation

Planned for upcoming phases: a second Button Group widget, 20+ additional presets, global/user-saved presets, and a visual Preset Builder.

== Requirements ==

* Elementor (free) must be installed and active
* Elementor 3.20.0 or greater
* PHP 7.4 or greater

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/oblique-buttons-for-elementor` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Make sure Elementor is installed and active.
4. Edit any page with Elementor and search for "Oblique Button" in the widget panel.

== Frequently Asked Questions ==

= Does this require Elementor Pro? =

No, the free version of Elementor is sufficient.

= Can I style the button yet? =

Yes. Pick a preset in the Preset panel, then use the Style tab (Normal / Hover / Focus / Active) to change any property — your changes always take priority over the preset.

= How do I go back to the preset's original look after customizing a control? =

Use the small reset arrow next to that control's label in the Elementor panel. It appears whenever a value differs from "use the preset," and clicking it clears your override.

== Changelog ==

= 0.1.0 =
* Initial release
* Registers the Oblique Button widget with Text and Link controls
