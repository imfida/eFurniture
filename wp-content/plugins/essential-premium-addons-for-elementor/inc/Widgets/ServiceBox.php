<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ServiceBox extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'servicebox' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/servicebox.php";
	}
}