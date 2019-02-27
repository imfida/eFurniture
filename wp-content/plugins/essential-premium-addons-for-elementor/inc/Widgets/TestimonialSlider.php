<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TestimonialSlider extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'testimonialslider' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/testimonialslider.php";
	}
}