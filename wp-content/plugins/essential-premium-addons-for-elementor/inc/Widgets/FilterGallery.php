<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FilterGallery extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'filtergalllery' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/filtergalllery.php";
	}
}