<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnimatedText extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'animatedtext' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/animatedtext.php";
	}
}