<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Base;

class CheckElementorActive/* extends BaseController*/ {
	public function register() {
		add_action( 'plugins_loaded', array($this, 'check_elementor_active' ));

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array($this, 'wfe_is_failed_to_load' ));
		}
	}

	public function check_elementor_active() {
		/**
		 * Check if Elementor is Installed or not
		 */
		if ( ! function_exists( 'wfe_is_elementor_active' ) ) :
			function wfe_is_elementor_active() {
				$file_path         = 'elementor/elementor.php';
				$installed_plugins = get_plugins();

				return isset( $installed_plugins[ $file_path ] );
			}
		endif;
	}


	/**
	 * This notice will appear if Elementor is not installed or activated or both
	 */
	public function wfe_is_failed_to_load() {
		$elementor = 'elementor/elementor.php';
		if ( wfe_is_elementor_active() ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}
			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
			$message        = __( '<strong>Essential Premium Addons For Elementor</strong> requires Elementor plugin to be active. Please activate Elementor to continue.', 'wfe_elementor' );
			$button_text    = __( 'Activate Elementor', 'wfe_elementor' );
		} else {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}
			$activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$message        = sprintf( __( '<strong>Essential Premium Addons For Elementor</strong> requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', 'wfe_elementor' ), '<strong>', '</strong>' );
			$button_text    = __( 'Install Elementor', 'wfe_elementor' );
		}
		$button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
		printf( '<div class="error"><p>%1$s</p>%2$s</div>', __( $message ), $button );
	}
}