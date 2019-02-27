<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_contactform7 extends Widget_Base {

	public function get_name() {
		return 'wfe-textseparator';
	}

	public function get_title() {
		return __( 'Contact Form 7', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-envelope-o wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section( 'epa_cf7_contact_form_section', [
				'label' => __( 'Contact Form', 'epa_elementor' ),
			] );

		$this->add_control( 'contact_form_list', [
				'label'       => esc_html__( 'Select Form', 'epa_elementor' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => epa_contact_form7(),
				'default'     => '0',
			] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_cf7_contact_form_field_section', [
			'label' => __( 'Fields', 'epa_elementor' ),
		] );

		$this->add_responsive_control( 'text_indent', [
			'label'      => __( 'Text Indent', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 60,
					'step' => 1,
				],
				'%'  => [
					'min'  => 0,
					'max'  => 30,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select' => 'text-indent: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'epa_input_width', [
			'label'      => __( 'Input Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1200,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select' => 'width: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'epa_input_height', [
			'label'      => __( 'Input Height', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select' => 'height: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'epa_textarea_width', [
			'label'      => __( 'Textarea Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1200,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
			],
		] );


		$this->add_responsive_control( 'input_spacing', [
			'label'      => __( 'Field Spacing', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => '0',
				'unit' => 'px',
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form p:not(:last-of-type) .wpcf7-form-control' => 'margin-bottom: {{SIZE}}{{UNIT}}',
			],
		] );
		$this->end_controls_section();

		/**
		 * Style Tab: Submit Button
		 */
		$this->start_controls_section( 'epa_section_submit_button', [
			'label' => __( 'Submit Button', 'epa_elementor' ),
		] );

		$this->add_control( 'button_width_type', [
			'label'        => __( 'Width', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'custom',
			'options'      => [
				'full-width' => __( 'Full Width', 'epa_elementor' ),
				'custom'     => __( 'Custom', 'epa_elementor' ),
			],
			'prefix_class' => 'epa-cf7-7-button-',
		] );

		$this->add_responsive_control( 'button_align', [
			'label'     => __( 'Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'default'   => 'left',
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'epa_elementor' ),
					'icon'  => 'eicon-h-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'epa_elementor' ),
					'icon'  => 'eicon-h-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'epa_elementor' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form p:nth-last-of-type(1)' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]'  => 'display:inline-block;',
			],
			'condition' => [
				'button_width_type' => 'custom',
			],
		] );

		$this->add_responsive_control( 'button_width', [
			'label'      => __( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1200,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'button_width_type' => 'custom',
			],
		] );

		$this->add_responsive_control( 'button_height', [
			'label'      => __( 'Height', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'height: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'button_width_type' => 'custom',
			],
		] );


		$this->end_controls_section();
		/**
		 * Fields Style
		 */
		$this->start_controls_section( 'section_fields_style', [
				'label' => __( 'Fields Style', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );


		$this->add_control(
			'epa_cf7_label_styles',
			[
				'label' => __( 'Label Style', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control( 'label_text_color', [
			'label'     => __( 'Label Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form label' => 'color: {{VALUE}}',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'epa_label_typography',
			'label'     => __( 'Typography', 'epa_elementor' ),
			'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
			'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form label',
		] );

		$this->add_control( 'field_bg', [
				'label'     => __( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			] );

		$this->add_control( 'field_text_color', [
				'label'     => __( 'Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}}',
				],
				//'separator' => 'before',
			] );

		$this->add_responsive_control( 'field_padding', [
				'label'      => __( 'Padding', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'        => 'field_border',
				'label'       => __( 'Border', 'epa_elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select',
				'separator'   => 'before',
			] );

		$this->add_control( 'field_radius', [
				'label'      => __( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'      => 'field_typography',
				'label'     => __( 'Typography', 'epa_elementor' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'field_box_shadow',
				'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .epa-cf7-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			] );

		$this->add_control(
			'epa_cf7_focus_styles',
			[
				'label' => __( 'Focus Style', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control( 'field_bg_focus', [
				'label'     => __( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input:focus, {{WRAPPER}} .epa-cf7-7 .wpcf7-form textarea:focus' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'        => 'input_border_focus',
				'label'       => __( 'Border', 'epa_elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form input:focus, {{WRAPPER}} .epa-cf7-7 .wpcf7-form textarea:focus',
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'focus_box_shadow',
				'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form input:focus, {{WRAPPER}} .epa-cf7-7 .wpcf7-form textarea:focus',
			] );

		$this->end_controls_section();

		/**
		 * Style Tab: Submit Button
		 */
		$this->start_controls_section( 'section_submit_button_style', [
				'label' => __( 'Submit Button Styles', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab( 'tab_button_normal', [
				'label' => __( 'Normal', 'epa_elementor' ),
			] );

		$this->add_control( 'button_bg_color_normal', [
				'label'     => __( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form  input[type="submit"]' => 'background: {{VALUE}}',
				],
			] );

		$this->add_control( 'button_text_color_normal', [
				'label'     => __( 'Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
				],
			] );


		$this->add_responsive_control( 'button_margin', [
			'label'      => __( 'Margin Top', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'label'     => __( 'Typography', 'epa_elementor' ),
			'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
			'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]',
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'button_border_normal',
				'label'    => __( 'Border', 'epa_elementor' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]',
			] );

		$this->add_control( 'button_border_radius', [
				'label'      => __( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_responsive_control( 'button_padding', [
				'label'      => __( 'Padding', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]',
				'separator' => 'before',
			] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_button_hover', [
				'label' => __( 'Hover', 'epa_elementor' ),
			] );

		$this->add_control( 'button_bg_color_hover', [
				'label'     => __( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}',
				],
			] );

		$this->add_control( 'button_text_color_hover', [
				'label'     => __( 'Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}',
				],
			] );

		$this->add_control( 'button_border_color_hover', [
				'label'     => __( 'Border Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-cf7-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
				],
			] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'epa-contact-form', 'class', [
				'epa-cf7',
				'epa-cf7-7',
				'epa-cf7-'.$this->get_id(),
			] );
			$this->add_render_attribute( 'epa-contact-form', 'class', 'epa-cf7-radio-checkbox' );

		if ( function_exists( 'wpcf7' ) ) {
			if ( ! empty( $settings['contact_form_list'] ) ) { ?>
                <div class="epa-cf7-7-wrapper">
                    <div <?php echo $this->get_render_attribute_string( 'epa-contact-form' ); ?>>
						<?php echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' ); ?>
                    </div>
                </div>
				<?php
			}
		}
	}
	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_contactform7() );