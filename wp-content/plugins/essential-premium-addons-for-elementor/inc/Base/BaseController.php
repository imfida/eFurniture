<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Base;

class BaseController {
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $shortcodes = array();

	//For PHP Lower Version - Get Path
	public function cstm_dirname( $path, $count = 1 ) {
		if ( $count > 1 ) {
			return dirname( $this->cstm_dirname( $path, -- $count ) );
		} else {
			return dirname( $path );
		}
	}

	public function __construct() {
		$this->plugin_path = plugin_dir_path( $this->cstm_dirname( __FILE__, 2 ) );
		$this->plugin_url  = plugin_dir_url( $this->cstm_dirname( __FILE__, 2 ) );
		$this->plugin      = plugin_basename( $this->cstm_dirname( __FILE__, 3 ) ) . '/essential-premium-addons-for-elementor.php';


		/*-----------------------------------------------------------------------------------*/
		/*	Initalising Shortcodes In Content and Widget
		/*-----------------------------------------------------------------------------------*/
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'the_content', 'do_shortcode' );
		add_filter( 'the_excerpt', 'do_shortcode' );


		$this->shortcodes = array (
			'servicebox'      => 'Service Box',
			'flipbox'      => 'Flip Box',
			'pricing'      => 'Pricing Table',
			'hovereffects'      => 'Hover Effects',
			'preloader'      => 'Preloader',
			'teammember'      => 'Team Member',
			'infobox'      => 'Info Box',
			'imagehotspot'      => 'Image Hotspot',
			'accordion'      => 'Accordion',
			'counter'      => 'Counter',
			'testimonialslider'      => 'Testimonial Slider',
			'animatedtext'      => 'Animated Text',
			'postgrid'      => 'Post Grid',
			'postcarousel'      => 'Post Carousel',
			'instragramfeed'      => 'Instagram Feed',
			'buttons'      => 'Buttons',
			'filtergalllery'      => 'Filter Gallery',
			'contactform7'      => 'Contact Form 7',
		);

	}

	public function activated( $key ) {
		$option = get_option( 'wfe_elementor' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}