<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Base;

class Enqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ) );
	}

	public function admin_enqueue() {

		//admin enqueue scripts
		wp_enqueue_style( 'epa_fontawesome_load_admin', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css' );

		wp_enqueue_style( 'epa-google-font', 'https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Roboto|Roboto+Condensed' );

		wp_enqueue_style( 'epa_adminstyle_css', $this->plugin_url . 'assets/css/adminstyle.css' );

		wp_enqueue_script( 'epa-adminscript-js', $this->plugin_url . 'assets/js/adminscript.min.js', array( 'jquery' ), '', true );

	}

	//wp/front enqueue scripts
	public function front_enqueue() {

		wp_enqueue_style( 'epa-owl-carousel', $this->plugin_url . 'assets/css/owl.carousel.min.css' );
		wp_enqueue_style( 'epa-owl-carousel-theme', $this->plugin_url . 'assets/css/owl.theme.min.css' );

		wp_enqueue_style( 'epa-widgets-css', $this->plugin_url . 'assets/css/widgets.min.css' );

		wp_enqueue_script( 'epa-widgets-js', $this->plugin_url . 'assets/js/widgets.min.js', array( 'jquery' ), '', false );

		wp_enqueue_script( 'epa-owl-carousel-js', $this->plugin_url . 'assets/js/owl.carousel.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'epa-waypoint-counter-js', $this->plugin_url . 'assets/js/waypoint.js', array( 'jquery' ), '', true );
	}
}