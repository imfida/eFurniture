<?php
/**
 * @package  EpaElementor
 */
/*
Plugin Name: Essential Premium Addons for Elementor
Description: This plugin adds new elements/widgets to Elementor Page Builder. Essential Premium Addons is the biggest Addon Pakage for Elementor Page Builder. This Addon Bundle provide you everything for your Elementor Page Builder. professional looking, easy to use yet highly functional Addons that can be used in Elementor page builder.
Author: wpcodestar
Version: 2.0.3
Requires at least: 3.8
Tested up to:      5.1
Author URI: https://codenat.com/
License: GPL2
Text Domain: epa_elementor
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// prevent direct access
defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

// Vendor Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// All Query
require 'widgets/addonstyle/postsquery.php';

//The code that runs during plugin activation
function activate_epa_plugin() {
	Epa\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activate_epa_plugin' );


//The code that runs during plugin deactivation
function deactivate_epa_plugin() {
	Epa\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_epa_plugin' );


//The code that runs during plugin Uninstall
function uninstall_epa_plugin() {
	Epa\Base\Uninstall::uninstall();
}

register_uninstall_hook( __FILE__, 'uninstall_epa_plugin' );


// Redirect Settings Page After Plugin Activation
function epa_activation_redirect( $plugin ) {
	if ( $plugin == plugin_basename( __FILE__ ) ) {
		exit( wp_redirect( admin_url( 'admin.php?page=wfe_elementor' ) ) );
	}
}

add_action( 'activated_plugin', 'epa_activation_redirect' );


// Register ALL Services
if ( class_exists( 'Epa\\Init' ) ) {
	Epa\Init::register_services();
}

function epa_ccn_widgets_reg() {

	if ( class_exists( 'Epa\\Widgets' ) ) {
		Epa\Widgets::register_services();
	}
}

add_action( 'elementor/widgets/widgets_registered', 'epa_ccn_widgets_reg' );