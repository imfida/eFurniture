<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageHotspot extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'imagehotspot' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/imagehotspot.php";
	}
}