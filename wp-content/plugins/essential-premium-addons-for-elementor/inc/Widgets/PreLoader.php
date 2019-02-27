<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PreLoader extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'preloader' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/preloader.php";
	}
}