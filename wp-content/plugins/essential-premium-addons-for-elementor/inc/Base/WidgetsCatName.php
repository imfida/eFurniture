<?php
/**
 * @package  EpaElementor
 */

namespace Epa\Base;

class WidgetsCatName extends BaseController {
	public function register() {
		require_once $this->plugin_path . "controller/cat_name_elementor.php";
	}
}