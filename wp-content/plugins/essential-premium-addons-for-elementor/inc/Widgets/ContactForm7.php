<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ContactForm7 extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'contactform7' ) ) {
			return;
		}

		if ( function_exists( 'wpcf7' )) {
			require_once $this->plugin_path . "widgets/contactform7.php";
		}
	}
}