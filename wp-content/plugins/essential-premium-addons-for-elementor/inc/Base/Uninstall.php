<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Base;

class Uninstall {
	public static function uninstall() {
		flush_rewrite_rules();

		$option_name = 'wfe_elementor' ;
		if ( get_option( $option_name ) !== false ) {

			// The option already exists, so update it.
			delete_option( $option_name );

		}
	}
}