<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TeamMember extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'teammember' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/teammember.php";
	}
}