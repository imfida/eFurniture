<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class InstragramFeed extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'instragramfeed' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/instragramfeed.php";
	}
}