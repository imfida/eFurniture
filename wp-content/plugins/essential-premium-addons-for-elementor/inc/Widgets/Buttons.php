<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Buttons extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'buttons' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/buttons.php";
	}
}