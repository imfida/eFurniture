<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_vubonhovereffects extends Widget_Base {

	public function get_name() {
		return 'wfe-vubonhovereffects';
	}

	public function get_title() {
		return __( 'Hover Effects', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-info-box wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section( 'epa_hover_options_section', [
			'label' => esc_html__( 'Hover Options', 'wfe_elementor' ),
		] );

		$this->add_control( 'vhover_effect', [
			'label'   => esc_html__( 'Set Hover Style', 'wfe_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'effect-lily',
			'options' => [
				'effect-lily'   => esc_html__( 'Lily', 'wfe_elementor' ),
				'effect-sadie'  => esc_html__( 'Sadie', 'wfe_elementor' ),
				'effect-layla'  => esc_html__( 'Layla', 'wfe_elementor' ),
				'effect-oscar'  => esc_html__( 'Oscar', 'wfe_elementor' ),
				'effect-marley' => esc_html__( 'Marley', 'wfe_elementor' ),
				'effect-ruby'   => esc_html__( 'Ruby', 'wfe_elementor' ),
				'effect-roxy'   => esc_html__( 'Roxy', 'wfe_elementor' ),
				'effect-bubba'  => esc_html__( 'Bubba', 'wfe_elementor' ),
				'effect-romeo'  => esc_html__( 'Romeo', 'wfe_elementor' ),
				'effect-sarah'  => esc_html__( 'Sarah', 'wfe_elementor' ),
				'effect-chico'  => esc_html__( 'Chico', 'wfe_elementor' ),
				'effect-milo'   => esc_html__( 'Milo', 'wfe_elementor' ),
				'effect-apollo' => esc_html__( 'Apolo', 'wfe_elementor' ),
				'effect-jazz'   => esc_html__( 'Jazz', 'wfe_elementor' ),
				'effect-ming'   => esc_html__( 'Ming', 'wfe_elementor' ),
			],
		] );

		$this->end_controls_section();

		// Content Controls
		$this->start_controls_section( 'wfe_section_vhover_content', [
			'label' => esc_html__( 'Hover Content', 'wfe_elementor' ),
		] );


		$this->add_control( 'vhover_image', [
			'label'   => __( 'Hover Image', 'wfe_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_control( 'vhover_image_alt', [
			'label'       => __( 'Image ALT Tag', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => '',
			'placeholder' => __( 'Enter alter tag for the image', 'wfe_elementor' ),
			'title'       => __( 'Input image alter tag here', 'wfe_elementor' ),
			'dynamic'     => [ 'action' => true ],
		] );

		$this->add_control( 'vhover_heading', [
			'label'       => __( 'Hover Heading', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => 'I am Interactive',
			'placeholder' => __( 'Enter heading for the vhover', 'wfe_elementor' ),
			'title'       => __( 'Enter heading for the vhover', 'wfe_elementor' ),
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'vhover_content', [
			'label'   => __( 'Hover Content', 'wfe_elementor' ),
			'type'    => Controls_Manager::WYSIWYG,
			'default' => __( 'Click to inspect, then edit as needed.', 'wfe_elementor' ),
		] );

		$this->add_control( 'show_hide_hovereffect_link', [
			'label'        => __( 'Set Link', 'plugin-domain' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'your-plugin' ),
			'label_off'    => __( 'Hide', 'your-plugin' ),
			'return_value' => 'yes',
			'default'      => 'yes',
			/*				'condition' => [
								'epa_elementor_flipbox_front_or_back_content' => 'back'
							]*/
		] );

		/**
		 * Condition: 'epa_elementor_flipbox_front_or_back_content' => 'back'
		 */
		$this->add_control( 'hovereffect_link', [
			'label'         => __( 'Link', 'plugin-domain' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => __( 'https://yourlink.com', 'plugin-domain' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
			'condition'     => [
				'show_hide_hovereffect_link' => 'yes',
			],
		] );
		$this->end_controls_section();


		// Style Controls
		$this->start_controls_section( 'wfe_section_vhover_settings', [
			'label' => esc_html__( 'Hover Settings', 'wfe_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'vhover_container_width', [
			'label'     => esc_html__( 'Set max width for the container?', 'wfe_elementor' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __( 'yes', 'wfe_elementor' ),
			'label_off' => __( 'no', 'wfe_elementor' ),
			'default'   => 'no',
		] );

		$this->add_responsive_control( 'vhover_container_width_value', [
			'label'      => __( 'Container Max Width (% or px)', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 480,
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 500,
					'step' => 5,
				],
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover' => 'max-width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'vhover_container_width' => 'yes',
			],
		] );

		$this->add_responsive_control( 'vhover_image_height', [
			'label'      => __( 'Image Height (% or px)', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 300,
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 800,
					'step' => 2,
				],
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover figure img' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'vhover_border',
			'selectors' => [
				//'{{WRAPPER}} .wfe-interactive-vhover figure',
				'{{WRAPPER}} .wfe-interactive-vhover figure img',
			],
		] );


		$this->add_control( 'vhover_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wfe-interactive-vhover figure'     => 'border-radius: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .wfe-interactive-vhover figure img' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();


		$this->start_controls_section( 'wfe_section_vhover_styles', [
			'label' => esc_html__( 'Colors &amp; Typography', 'wfe_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'hover_effects_overlay_color', [
			'label'     => esc_html__( 'Overlay Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		$this->add_control( 'vhover_overlay_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#3085a3',
			'selectors' => [
				'{{WRAPPER}} .wfe-interactive-vhover figure' => 'background-color: {{VALUE}};',
			],
		] );


		$this->add_control( 'hover_effects_title_heading', [
			'label'     => esc_html__( 'Title Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		// Title Style
		$this->add_control( 'hover_heading_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'wfe_vhover_title_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2',
		] );

		$this->add_responsive_control( 'epa_hover_effects_title_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		// Content Padding
		$this->add_responsive_control( 'hover_effects_title_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover figure figcaption h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Content Style
		$this->add_control( 'servicebox_title_heading', [
			'label'     => esc_html__( 'Content Style', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		$this->add_control( 'vhover_content_color', [
			'label'     => esc_html__( 'Hover Content Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .wfe-interactive-vhover figure p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'wfe_vhover_content_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .wfe-interactive-vhover figure p',
		] );

		// Content Margin
		$this->add_responsive_control( 'hover_effects_content_margin', [
			'label'      => esc_html__( 'Content Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover figure p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		// Content Padding
		$this->add_responsive_control( 'hover_effects_content_padding', [
			'label'      => esc_html__( 'Content Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-interactive-vhover figure p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


	}


	protected function render() {


		$settings     = $this->get_settings_for_display();
		$vhover_image = $this->get_settings( 'vhover_image' );

		// Get Link Value
		$target   = $settings['hovereffect_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['hovereffect_link']['nofollow'] ? ' rel="nofollow"' : '';

		?>


        <div id="wfe-vhover-<?php echo esc_attr( $this->get_id() ); ?>" class="wfe-interactive-vhover">
            <figure class="<?php echo esc_attr( $settings['vhover_effect'] ); ?>">
				<?php echo '<img alt="' . $settings['vhover_image_alt'] . '" src="' . $vhover_image['url'] . '">'; ?>
                <figcaption>
                    <div>
						<?php if ( ! empty( $settings['vhover_heading'] ) ) : ?>
                            <h2><?php echo esc_attr( $settings['vhover_heading'] ); ?></h2>
						<?php endif; ?>
                        <p><?php echo $settings['vhover_content']; ?></p>
                    </div>

                    <!--  Link Show Hide-->
					<?php if ( $settings['show_hide_hovereffect_link'] == 'yes' )  : ?>
                        <a href="<?php echo esc_attr( $settings['hovereffect_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?> ></a>
					<?php endif; ?>


                </figcaption>
            </figure>
        </div>


		<?php

	}

	protected function content_template() {

		?>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_vubonhovereffects() );