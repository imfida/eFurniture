<?php
/**
 * @package  EpaElementor
 */

namespace Epa\Base;

class Activate extends BaseController {
	public static function activate() {
		flush_rewrite_rules();

		$option_name = 'wfe_elementor';

		if ( get_option( $option_name ) ) {
			return;
		}

		$default = array(
			'flipbox',
			'pricing',
			'hovereffects',
			'preloader',
			'servicebox',
			'teammember',
			'infobox',
			'imagehotspot',
			'accordion',
			'counter',
			'testimonialslider',
			'animatedtext',
			'postgrid',
			'postcarousel',
			'instragramfeed',
			'buttons',
			'filtergalllery',
			'contactform7',
		);

		$default_settings = array_fill_keys( $default, true );

		if ( get_option( $option_name ) !== false ) {

			// The option already exists, so update it.
			update_option( $option_name, $default_settings );

		} else {

			// The option hasn't been created yet, so add it with $autoload set to 'no'.
			$deprecated = null;
			$autoload   = 'no';
			add_option( $option_name, $default_settings, $deprecated, $autoload );

		}
	}
}