<?php
namespace Elementor;

function epae_elementor_init() {
	Plugin::instance()->elements_manager->add_category( 'wfe-ccn', [
		'title' => 'Essential Premium Addons',
		'icon'  => 'font',
	], 1 );
}

add_action( 'elementor/init', 'Elementor\epae_elementor_init' );

