<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostCarousel extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'postcarousel' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/postcarousel.php";
	}
}