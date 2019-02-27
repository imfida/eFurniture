<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class UltimateButton extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'ultimatebutton' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/ultimatebutton.php";
	}
}