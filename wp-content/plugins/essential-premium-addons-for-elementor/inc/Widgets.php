<?php
/**
 * @package  EpaElementor
 */
namespace Epa;

final class Widgets {
	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [
			Widgets\ServiceBox::class,
			Widgets\FlipBox::class,
			Widgets\PricingTable::class,
			Widgets\VubonHover::class,
			Widgets\PreLoader::class,
			Widgets\TeamMember::class,
			Widgets\InfoBox::class,
			Widgets\ImageHotspot::class,
			Widgets\Accordion::class,
			Widgets\Counter::class,
			Widgets\TestimonialSlider::class,
			Widgets\AnimatedText::class,
			Widgets\PostGrid::class,
			Widgets\PostCarousel::class,
			Widgets\InstragramFeed::class,
			Widgets\Buttons::class,
			Widgets\FilterGallery::class,
			Widgets\ContactForm7::class,
		];

	}

	/**
	 * Loop through the classes::class, initialize them::class,
	 * and call the register() method if it exists
	 *
	 * @return
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$widgets = self::instantiate( $class );
			if ( method_exists( $widgets, 'widgets_register' ) ) {
				$widgets->widgets_register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class class from the services array
	 *
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$widgets = new $class();

		return $widgets;
	}

}