<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PostGrid extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'postgrid' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/postgrid.php";
	}
}