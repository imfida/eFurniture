<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Counter extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'counter' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/counter.php";
	}
}