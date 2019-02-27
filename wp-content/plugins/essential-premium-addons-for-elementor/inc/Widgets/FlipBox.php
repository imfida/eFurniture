<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class FlipBox extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'flipbox' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/flipbox.php";
	}
}