<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class InfoBox extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'infobox' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/infobox.php";
	}
}