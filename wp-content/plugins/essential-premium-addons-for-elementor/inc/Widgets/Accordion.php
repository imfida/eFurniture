<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Accordion extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'accordion' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/accordion.php";
	}
}