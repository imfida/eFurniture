<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class VubonHover extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'hovereffects' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/hovereffects.php";
	}
}