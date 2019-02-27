<?php
namespace Wfe\Widgets;

use Wfe\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TextSeparator extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'textseparator' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/textseparator.php";
	}
}