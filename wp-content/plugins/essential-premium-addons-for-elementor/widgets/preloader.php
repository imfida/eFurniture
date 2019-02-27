<?php
namespace Elementor; // E plus

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_preloader extends Widget_Base {

	public function get_name() {
		return 'wfe-preloader';
	}

	public function get_title() {
		return __( 'Preloader', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-adjust wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section(
			'section_preloader',
			[
				'label' => __( 'Preloader Option', 'wfe_elementor' ),
			]
		);

/*		$this->add_control(
			'preloader_icon',
			[
				'label'   => __( 'Preloader Icon', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'fa fa-spinner'        => __( 'Spinner', 'wfe_elementor' ),
					'circle-o-notch' => __( 'Circle', 'wfe_elementor' ),
					'refresh'        => __( 'Refresh', 'wfe_elementor' ),
					'cog'            => __( 'Cog', 'wfe_elementor' ),
				],
			]
		);*/

		$this->add_control(
			'preloader_icon',
			[
				'label'       => __( 'Preloader icon', 'wfe_elementor' ),
				'type' => Controls_Manager::ICON,
                'default' => 'fa fa-spinner',
			]
		);

		$this->add_control(
			'preloader_preview',
			[
				'label'     => __( 'Toggle Preloader Preview', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => [
					'block' => __( 'On', 'wfe_elementor' ),
					'none'  => __( 'Off', 'wfe_elementor' ),
				],
				'selectors' => [
					'.elementor-editor-active {{WRAPPER}} #preloader' => 'display: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'preloader_size',
			[
				'label' => __( 'Preloader Size', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} #preloader i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #preloader #status' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; margin: calc(-{{SIZE}}{{UNIT}} / 2) 0 0 calc(-{{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Preloader', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} div#status' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} div#preloader' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$icon     = ! empty( $settings['preloader_icon'] ) ? $settings['preloader_icon'] : 'fa fa-spinner';

		?>
        <div id="wfe-pr-<?php echo esc_attr( $this->get_id() ); ?>">
            <div id="preloader">
                <div id="status"><i class="<?php echo esc_attr( $icon ); ?> fa-spin" aria-hidden="true"></i></div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function () {
                jQuery(document).trigger('elementor/render/wfe_preloader', '#wfe-pr-<?php echo esc_attr( $this->get_id() ); ?>');
            });
        </script>
		<?php
	}

}
Plugin::instance()->widgets_manager->register_widget_type( new Wfe_preloader() );