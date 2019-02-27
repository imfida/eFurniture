<?php

settings_errors();

// Get Plugin Version Information
$base_nam       = plugin_dir_path( dirname( __FILE__ ) );
$filpath        = str_replace( "\\", "/", $base_nam );
$plugin_data    = get_plugin_data( $filpath . 'essential-premium-addons-for-elementor.php' );
$plugin_version = $plugin_data['Version'];

?>

<div id="pev-wrap">
    <div id="pev-desc-main">
        <h3 id="pev-title">Essential Premium Addons For Elementor</h3>
        <p>Essential Premium Addons For Elementor has module basis structure. You can easily activate/deactivate any Essential Premium Addons as your needs anytime. When you updated plugin, you can check this page and activate new
            modules.</p>
        <p>All Essential Premium Addons Activate By Default, You Should Deactivate Essential Premium Addons Which One you like, You may deactivate/activate All Essential Premium Addons By Clicking Enable/Disable Button.</p>
    </div>
    <div class="wfe-logo-img"><span>Version <?php echo $plugin_version; ?></span></div>

		<ul class="prime-nav prime-nav-tabs">
			<li class="prime-active"><i class="fab fa-adn prime_menu_icon"></i><a href="#tab-1">Addons</a></li>
			<li><i class="fab fa-codepen prime_menu_icon"></i><a href="#tab-2">About</a></li>
<!--			<li><i class="fab fa-angular prime_menu_icon"></i><a href="#tab-3">Custom CSS</a></li>-->

		</ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane prime-active">
            <form method="post" action="options.php">
				<?php
				settings_fields( 'wfe_options_group' );
				$option = get_option( 'wfe_elementor' );
				if ( is_array( $option ) ) {
					$activate   = count( array_filter( $option ) );
					$all_extens = count( $option );
					$inactive   = $all_extens - $activate;
				} else {
					$activate   = 0;
					$all_extens = count( $this->shortcodes );
					$inactive   = count( $this->shortcodes );
				}
				?>

                <ul class="prime_module_count">
                    <li class="prime-ext-all"><a href="<?php echo add_query_arg( array( 'page' => 'wfe_elementor', 'filter' => 'all' ), admin_url( 'admin.php' ) ); ?>">All <span
                                    class="count">(<?php echo $all_extens; ?>)</span></a> |
                    </li>
                    <li class="active"><a href="<?php echo add_query_arg( array( 'page' => 'wfe_elementor', 'filter' => 'active' ), admin_url( 'admin.php' ) ); ?>">Active <span
                                    class="count">(<?php echo $activate; ?>)</span></a> |
                    </li>
                    <li class="inactive"><a href="<?php echo add_query_arg( array( 'page' => 'wfe_elementor', 'filter' => 'inactive' ), admin_url( 'admin.php' ) ); ?>">Inactive <span
                                    class="count">(<?php echo $inactive; ?>)</span></a></li>

                </ul>
                <div class="prime_checkbox_select">
                    <input type="checkbox" id="select_all" value="1"/> Enable/Disable All
                </div>
				<?php
				do_settings_sections( 'wfe_elementor' );
				submit_button();
				?>
<!--                <input type="submit" name="wphw_submit" value="Save changes" class="button-primary" />-->
            </form>
        </div>

        <div id="tab-2" class="tab-pane">

            <div class="prime-page-welcome about-wrap container">
                <div class="prime_welcome-feature">
                    <!--<div class="about-text">The Prime Extensions VC Addons currently has a lot of modules. It will be updated periodically and you'll get much more modules & existing modules will be
                        improved.
                    </div>-->


                    <div class="prime-grid-wrapper row">
                        <div class="col-md-6 prime-grid-item ">
                            <h4><span class="dashicons dashicons-images-alt2 prime_lefticon"></span>What is Essential Premium Addons For Elementor Plugin?</h4>
                            <p>Essential Premium Addons For Elementor is developed to extend Elementor to save your time in building websites. This plugin adds a number of elements to the
                                basic set of elements that come with the page builder. All these elements are added to your Elementor editor and can be used just like any other built-in
                                features.</p>
                        </div>

                        <div class="col-md-6 prime-grid-item">
                            <h4><span class="dashicons dashicons-admin-settings prime_lefticon"></span> Icons, Fonts, Typography, Design</h4>
                            <p>Infinity effects & variations usage comes with Essential Premium Addons For Elementor in your way. You can apply your own customized shortcodes in anywhere with flexible
                                effects.</p>
                        </div>
                    </div>
                    <div class="prime-grid-wrapper">
                        <div class="col-md-6 prime-grid-item">
                            <h4><span class="dashicons dashicons-editor-expand prime_lefticon"></span>Advanced Elements</h4>
                            <p>With the Essential Premium Addons For Elementor, you are free to use the basic elements of Elementor with several advanced elements that it adds in the editor.</p>
                        </div>

                        <div class="col-md-6 ">
                            <h4><span class="dashicons dashicons-universal-access prime_lefticon"></span> We stand by you!</h4>
                            <p>With several video tutorials and a dedicated support team, we assure complete help and support whenever you need us. Go ahead and explore the Essential Premium Addons For Elementor of Elementor Page Builder!</p>
                        </div>
                    </div>
<!--
                    <div class="prime-grid-wrapper">
                        <div class="col-lg-12 nopadding">
                            <iframe class="prime-iframe" src="https://codecans.com/tutorials/Essential Premium Addons-for-elementor/changelog.html" frameborder="0" width="100%" height="400px"></iframe>
                        </div>
                    </div>-->

                </div>

            </div>

        </div>
    </div>
</div>