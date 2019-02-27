<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Base;

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}