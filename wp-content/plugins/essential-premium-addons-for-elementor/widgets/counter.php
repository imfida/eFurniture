<?php
namespace Elementor;

// E plus

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_counter extends Widget_Base {

	public function get_name() {
		return 'epa-counter';
	}

	public function get_title() {
		return __( 'Counter', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-counter wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/**
		 * Content Tab: Counter
		 */
		$this->start_controls_section( 'epa_counter_section', [
			'label' => __( 'Counter', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_counter_icon_type', [
			'label'       => esc_html__( 'Icon Type', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none' => [
					'title' => esc_html__( 'None', 'epa_elementor' ),
					'icon'  => 'fa fa-ban',
				],
				'icon' => [
					'title' => esc_html__( 'Icon', 'epa_elementor' ),
					'icon'  => 'fa fa-info-circle',
				],
				'img'  => [
					'title' => esc_html__( 'Image', 'epa_elementor' ),
					'icon'  => 'fa fa-picture-o',
				],
			],
			'default'     => 'icon',
		] );

		$this->add_control( 'epa_counter_icon', [
			'label'     => __( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-snowflake-o',
			'condition' => [
				'epa_counter_icon_type' => 'icon',
			],
		] );

		$this->add_control( 'epa_counter_image', [
			'label'     => __( 'Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_counter_icon_type' => 'img',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'epa_counter_image[url]!' => '',
				'epa_counter_icon_type'   => 'img',
			],
		] );

		$this->add_control( 'epa_counter_target_number', [
			'label'       => __( 'Targeted number', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => __( '2652', 'epa_elementor' ),
			'separator'   => 'before',
			'description' => 'The targeted number to count up to (From zero).',
		] );

		$this->add_control( 'epa_counter_delay', [
			'label'       => __( 'Counter Delay', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => __( '10', 'epa_elementor' ),
			'description' => 'The delay in milliseconds per number count up.',
		] );

		$this->add_control( 'epa_counter_duration', [
			'label'       => __( 'Counter Duration', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => __( '1000', 'epa_elementor' ),
			'description' => 'The total duration of the count up animation..',
		] );

		$this->add_control( 'epa_counter_title', [
			'label'     => __( 'Counter Title', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'dynamic'   => [
				'active' => true,
			],
			'default'   => __( 'Web Design', 'epa_elementor' ),
			'separator' => 'before',
		] );

		$this->add_control( 'epa_icon_divider', [
			'label'        => __( 'Icon Divider', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'no',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
			'separator'    => 'before',
			'condition'    => [
				'epa_counter_icon_type!' => 'none',
			],
		] );


		$this->add_control( 'epa_number_divider', [
			'label'        => __( 'Number Divider', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'no',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->end_controls_section();

		/**
		 * START ICON STYLE
		 *
		 */
		$this->start_controls_section( 'epa_counter_icon_style_section', [
			'label'     => __( 'Icon Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_counter_icon_type' => 'icon',
			],
		] );


		$this->add_control( 'epa_counter_icon_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .eak-counter-icon i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_counter_icon_bg_color', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .eak-counter-icon i' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_counter_icon_size', [
			'label'      => __( 'Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 5,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .eak-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control( 'epa_icon_hover_animation', [
			'label'        => __( 'Hover Animation?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'no',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
			'separator'    => 'after',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'        => 'epa_counter_icon_border',
			'label'       => __( 'Border', 'epa_elementor' ),
			'placeholder' => '1px',
			'default'     => '1px',
			'selector'    => '{{WRAPPER}} .eak-counter-icon i',
		] );

		$this->add_control( 'epa_counter_icon_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'separator'  => 'after',
			'selectors'  => [
				'{{WRAPPER}} .eak-counter-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_counter_icon_padding', [
			'label'       => __( 'Padding', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-icon i' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_counter_icon_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-icon i' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();

		/**
		 * START IMAGE STYLE
		 *
		 */
		$this->start_controls_section( 'epa_counter_image_style_section', [
			'label'     => __( 'Image Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_counter_icon_type' => 'img',
			],
		] );

		$this->add_responsive_control( 'epa_counter_image_resizer', [
			'label'     => esc_html__( 'Image Resizer', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '60',
			],
			'range'     => [
				'px' => [
					'max' => 500,
				],
			],
			'separator' => 'before',
			'selectors' => [
				'{{WRAPPER}} .eak-counter-img img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
		] );

		$this->add_control( 'epa_image_hover_animation', [
			'label'        => __( 'Hover Animation?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'no',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
			'separator'    => 'after',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'        => 'epa_counter_image_border',
			'label'       => __( 'Border', 'epa_elementor' ),
			'placeholder' => '1px',
			'default'     => '1px',
			'selector'    => '{{WRAPPER}} .eak-counter-img img',
		] );

		$this->add_control( 'epa_counter_image_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'separator'  => 'after',
			'selectors'  => [
				'{{WRAPPER}} .eak-counter-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_counter_image_padding', [
			'label'       => __( 'Padding', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-img img' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_counter_image_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-img img' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();


		/**
		 * NUMBER STYLE SECTION
		 */
		$this->start_controls_section( 'epa_counter_num_style_section', [
			'label' => __( 'Number', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_counter_num_color', [
			'label'     => __( 'Number Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} #epa-counter' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_counter_num_typography',
			'label'    => __( 'Typography', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} #epa-counter',
		] );

		$this->add_responsive_control( 'epa_counter_num_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} #epa-counter' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/*
		 * COUNTER TITLE STYLE SECTION
		 * */

		$this->start_controls_section( 'epa_counter_title_style_section', [
			'label'     => __( 'Title', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_counter_title!' => '',
			],
		] );

		$this->add_control( 'epa_counter_title_color', [
			'label'     => __( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .eak-counter-content h3' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_counter_title_typography',
			'label'    => __( 'Typography', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .eak-counter-content h3',
		] );

		$this->add_responsive_control( 'epa_counter_title_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-content h3' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
			'condition'   => [
				'epa_counter_title!' => '',
			],
		] );

		$this->add_responsive_control( 'epa_counter_title_padding', [
			'label'       => __( 'Padding', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .eak-counter-content h3' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
			],
			'condition'   => [
				'epa_counter_title!' => '',
			],
		] );

		$this->end_controls_section();

		/*
		 * COUNTER DIVIDER STYLE SECTION
		 * */

		$this->start_controls_section( 'epa_counter_divider_section', [
			'label' => __( 'Divider', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'icon_divider_heading', [
			'label'     => __( 'Icon Divider', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'condition' => [
				'epa_counter_icon_type' => 'icon',
				'epa_icon_divider'       => 'yes',
				'epa_counter_icon_type!' => 'none',
			],
		] );
		$this->add_control( 'image_divider_heading', [
			'label'     => __( 'Image Divider', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'condition' => [
				'epa_counter_icon_type' => 'img',
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'       => 'yes',
			],
		] );

		$this->add_control( 'icon_divider_type', [
			'label'     => __( 'Divider Type', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'solid',
			'options'   => [
				'solid'  => __( 'Solid', 'epa_elementor' ),
				'double' => __( 'Double', 'epa_elementor' ),
				'dotted' => __( 'Dotted', 'epa_elementor' ),
				'dashed' => __( 'Dashed', 'epa_elementor' ),
			],
			'selectors' => [
				'{{WRAPPER}} .epa-counter-icon-img-divider' => 'border-bottom-style: {{VALUE}}',
			],
			'condition' => [
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'icon_divider_height', [
			'label'      => __( 'Height', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 2,
			],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 20,
					'step' => 1,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-counter-icon-img-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_icon_divider_width', [
			'label'      => __( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 70,
			],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 1000,
					'step' => 1,
				],
				'%'  => [
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-counter-icon-img-divider' => 'width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'    => 'yes',
			],
		] );

		$this->add_control( 'epa_icon_divider_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-counter-icon-img-divider' => 'border-bottom-color: {{VALUE}}',
			],
			'condition' => [
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_counter_icon_divider_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .epa-counter-icon-img-divider' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
			'condition' => [
				'epa_counter_icon_type!' => 'none',
				'epa_icon_divider'    => 'yes',
			],
		] );


		/*
		 * NUMBER DIVIDER SECTION
		 * */

		$this->add_control( 'epa_number_divider_heading', [
			'label'     => __( 'Number Divider', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'condition' => [
				'epa_number_divider'       => 'yes',
			],
		] );

		$this->add_control( 'epa_number_divider_type', [
			'label'     => __( 'Divider Type', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'solid',
			'options'   => [
				'solid'  => __( 'Solid', 'epa_elementor' ),
				'double' => __( 'Double', 'epa_elementor' ),
				'dotted' => __( 'Dotted', 'epa_elementor' ),
				'dashed' => __( 'Dashed', 'epa_elementor' ),
			],
			'selectors' => [
				'{{WRAPPER}} .epa-counter-number-divider' => 'border-bottom-style: {{VALUE}}',
			],
			'condition' => [
				'epa_number_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_number_divider_height', [
			'label'      => __( 'Height', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 2,
			],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 20,
					'step' => 1,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-counter-number-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'epa_number_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_number_divider_width', [
			'label'      => __( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 70,
			],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 1000,
					'step' => 1,
				],
				'%'  => [
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-counter-number-divider' => 'width: {{SIZE}}{{UNIT}}',
			],
			'condition'  => [
				'epa_number_divider'    => 'yes',
			],
		] );

		$this->add_control( 'epa_number_divider_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-counter-number-divider' => 'border-bottom-color: {{VALUE}}',
			],
			'condition' => [
				'epa_number_divider'    => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_counter_number_divider_margin', [
			'label'       => __( 'Margin', 'epa_elementor' ),
			'type'        => Controls_Manager::DIMENSIONS,
			'size_units'  => [ 'px', '%' ],
			'placeholder' => [
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			],
			'selectors'   => [
				'{{WRAPPER}} .epa-counter-number-divider' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
			],
			'condition' => [
				'epa_number_divider'    => 'yes',
			],
		] );
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		//Front Image Value
		$epa_counter_image     = $settings['epa_counter_image']; //Front Image*
		$epa_counter_image_url = Group_Control_Image_Size::get_attachment_image_src( $epa_counter_image['id'], 'thumbnail', $settings );
		if ( empty( $epa_counter_image_url ) ) : $epa_counter_image_url = $epa_counter_image['url'];
		else: $epa_counter_image_url = $epa_counter_image_url; endif;

		$i = uniqid(); // Unique Counter ID
		// Image Animate
		$img_hover_animate = $settings['epa_image_hover_animation'] == 'yes' ? 'epaciha' : '';

		// Icon Animate
		$icon_hover_animate = $settings['epa_icon_hover_animation'] == 'yes' ? 'epacicinha' : '';

		$output = '
                <div class="eak-counter-content eak-counter" id="counter">';

		if ( $settings['epa_counter_icon_type'] == 'icon' ) {
			$output .= '<div class="eak-counter-icon ' . $icon_hover_animate . '">
                        <i class="' . $settings['epa_counter_icon'] . '"></i>
                    </div>';
		}
		if ( $settings['epa_counter_icon_type'] == 'img' ) {
			$output .= '<div class="eak-counter-img ' . $img_hover_animate . '">
                      				 <img src="' . $epa_counter_image_url . '" alt="">
                   			 </div>';
		}
		if ( $settings['epa_icon_divider'] == 'yes' ) {
			$output .= '<div class="epa-counter-icon-img-divider-wrapper">
                      <span class="epa-counter-icon-img-divider"></span>
          </div>';
		}

		$output .= '<span  id="epa-counter" class="counter' . $i . '">' . $settings['epa_counter_target_number'] . '</span>';

		if ( $settings['epa_number_divider'] == 'yes' ) {
			$output .= '<div class="epa-counter-number-divider-wrapper">
                      <span class="epa-counter-number-divider"></span>
          </div>';
		}

		$output .= '<h3>' . $settings['epa_counter_title'] . '</h3>
                </div>
           ';

		$output .= ' <script type="text/javascript">
					jQuery(document).ready(function($) {
					            $(".counter' . $i . '").counterUp({
					                delay: ' . $settings['epa_counter_delay'] . ',
					                time: ' . $settings['epa_counter_duration'] . '
					            });
					        });
				</script>';

		echo $output;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_counter() );