<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_button extends Widget_Base {

	public function get_name() {
		return 'wfe-button';
	}

	public function get_title() {
		return __( 'Buttons', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-bold wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section( 'wfe_section_ultimate_button_content', [
				'label' => esc_html__( 'Button Content', 'wfe_elementor' ),
			] );


		$this->add_control( 'ultimate_button_text', [
				'label'       => __( 'Button Text', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Click Me!',
				'placeholder' => __( 'Enter button text', 'wfe_elementor' ),
				'title'       => __( 'Enter button text here', 'wfe_elementor' ),
			] );

		/*		$this->add_control(
					'ultimate_button_secondary_text',
					[
						'label' => __( 'Button Secondary Text', 'wfe_elementor' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Go!',
						'placeholder' => __( 'Enter button secondary text', 'wfe_elementor' ),
						'title' => __( 'Enter button secondary text here', 'wfe_elementor' ),
					]
				);*/


		$this->add_control( 'epa_button_link_url', [
				'label'       => __( 'Link URL', 'wfe_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '#',
				'placeholder' => __( 'Enter link URL for the button', 'wfe_elementor' ),
				'title'       => __( 'Enter heading for the button', 'wfe_elementor' ),
			] );

		$this->add_control( 'epa_button_link_target', [
				'label'     => esc_html__( 'Open in new window?', 'wfe_elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( '_blank', 'wfe_elementor' ),
				'label_off' => __( '_self', 'wfe_elementor' ),
				'default'   => '_self',
			] );

		$this->add_responsive_control( 'epa_button_alignment', [
				'label'        => esc_html__( 'Button Alignment', 'wfe_elementor' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => true,
				'options'      => [
					'left'    => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'wfe_elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'default'      => '',
				'prefix_class' => 'epa-button-align-',
			] );

		$this->add_control( 'epa_button_icon', [
				'label' => esc_html__( 'Icon', 'wfe_elementor' ),
				'type'  => Controls_Manager::ICON,
			] );

		$this->add_control( 'epa_button_icon_position', [
				'label'     => esc_html__( 'Icon Position', 'wfe_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => esc_html__( 'Before', 'wfe_elementor' ),
					'right' => esc_html__( 'After', 'wfe_elementor' ),
				],
				'condition' => [
					'epa_button_icon!' => '',
				],
			] );


		$this->add_control( 'epa_button_icon_indent', [
				'label'     => esc_html__( 'Icon Spacing', 'wfe_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'epa_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .epa-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .epa-button-icon-left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .epa-button-shikoba i' => 'left: -{{SIZE}}px;',
				],
			] );

		$this->end_controls_section();


		// Style Controls
		$this->start_controls_section( 'wfe_section_ultimate_button_settings', [
				'label' => esc_html__( 'Button Effects &amp; Styles', 'wfe_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		$this->add_control( 'epa_button_effect', [
				'label'   => esc_html__( 'Button Effect', 'wfe_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'epa-button-default',
				'options' => [
					'epa-button-default' => esc_html__( 'Default', 'wfe_elementor' ),
					'epa-button-pipaluk' => esc_html__( 'Pipaluk', 'wfe_elementor' ),
					'epa-button-moema'   => esc_html__( 'Moema', 'wfe_elementor' ),
					'epa-button-mohon'   => esc_html__( 'Mohon', 'wfe_elementor' ),
					'epa-button-munna'   => esc_html__( 'Munna', 'wfe_elementor' ),
					'epa-button-salu'   => esc_html__( 'Salu', 'wfe_elementor' ),
					'epa-button-sajjat'   => esc_html__( 'Sajjat', 'wfe_elementor' ),
					'epa-button-raju'   => esc_html__( 'Raju', 'wfe_elementor' ),
					'epa-button-fade'   => esc_html__( 'Fade', 'wfe_elementor' ),
					'epa-button-roqy'   => esc_html__( 'Roqy', 'wfe_elementor' ),
					'epa-button-shiney'   => esc_html__( 'Shiney', 'wfe_elementor' ),

				],
			] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .epa-button-unvrs span',
			] );

		$this->add_responsive_control( 'epa_button_padding', [
				'label'      => esc_html__( 'Button Padding', 'wfe_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-button-unvrs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );


		$this->start_controls_tabs( 'wfe_ultimate_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );

		$this->add_control( 'wfe_ultimate_button_text_color', [
				'label'   => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .epa-button-unvrs' => 'color: {{VALUE}};',
				],
			] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'wfe_ultimate_button_background_color',
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .epa-button-unvrs',
		] );

/*		$this->add_control( 'wfe_ultimate_button_background_color', [
				'label'   => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .epa-button-unvrs' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-pipaluk::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .epa-button-aylen:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-aylen:after' => 'background-color: {{VALUE}};',
				],
			] );*/

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'wfe_ultimate_button_border',
				'selector' => '{{WRAPPER}} .epa-button-unvrs',
			] );

		$this->add_control( 'wfe_ultimate_button_border_radius', [
				'label'     => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-button-unvrs'         => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .epa-button-unvrs::before' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .epa-button-unvrs::after'  => 'border-radius: {{SIZE}}px;',
				],
			] );


		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_ultimate_button_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );

		$this->add_control( 'wfe_ultimate_button_hover_text_color', [
				'label'   => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .epa-button-unvrs:hover' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'wfe_ultimate_button_hover_background_color', [
				'label'   => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#2b48a0',
				'selectors' => [
					'{{WRAPPER}} .epa-button-ujarak:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-unvrs:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-ujarak::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-munna::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-salu::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-sajjat::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-fade:before::before' => 'background-color: {{VALUE}};',

				],
			] );

		$this->add_control( 'wfe_ultimate_button_hover_border_color', [
				'label'     => esc_html__( 'Border Color', 'wfe_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-button:hover'                                => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-unvrs.epa-button-wapasha::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-unvrs.epa-button-antiman::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-unvrs.epa-button-pipaluk::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .epa-button-unvrs.epa-button-quidel::before'  => 'background-color: {{VALUE}};',
				],
			] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .epa-button-unvrs',
		] );

		$this->end_controls_section();


		$this->end_controls_section();


	}


	protected function render() {


		$settings         = $this->get_settings();
		$button_padding   = $this->get_settings( 'epa_button_padding' );
		$button_alignment = '<i class="' . esc_attr( $settings['epa_button_icon'] ) . ' epa-button-icon-' . $settings['epa_button_icon_position'] . '" aria-hidden="true"></i>';

		?>


        <a id="epa-button-<?php echo $this->get_id(); ?>" class="epa-button-unvrs <?php echo $settings['epa_button_effect']; ?>"

           href="<?php echo esc_attr( $settings['epa_button_link_url'] ); ?>" target="<?php echo $settings['epa_button_link_target']; ?>">
	<span>

        <!-- Button Icon Alignment Start -->
		<?php
		if ( ! empty( $settings['epa_button_icon'] ) && $settings['epa_button_icon_position'] == 'left' ) {
			echo $button_alignment;
		}
		echo $settings['ultimate_button_text'];

		if ( ! empty( $settings['epa_button_icon'] ) && $settings['epa_button_icon_position'] == 'right' ) {
			echo $button_alignment;
		}
		?>
        <!-- Button Icon Alignment End -->

	</span>
        </a>
		<?php

	}

	protected function content_template() {

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_button() );