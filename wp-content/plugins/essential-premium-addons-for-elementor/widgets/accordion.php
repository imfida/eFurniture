<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_accordion extends Widget_Base {

	public function get_name() {
		return 'epa-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-accordion wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/**
		 * Advance Accordion Settings
		 */
		$this->start_controls_section( 'epa_section_accordion_settings', [
			'label' => esc_html__( 'General Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_accordion_type', [
			'label'       => esc_html__( 'Accordion Type', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'true',
			'label_block' => false,
			'options'     => [
				'true'  => esc_html__( 'Accordion', 'epa_elementor' ),
				'false' => esc_html__( 'Toggle', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_accordion_speed', [
			'label'       => esc_html__( 'Accordion Speed (ms)', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'label_block' => false,
			'default'     => 400,
			'description' => 'A number determining the time to show and to hide the content from an accordion\'s item',
		] );
		$this->add_control( 'epa_accordion_delay', [
			'label'       => esc_html__( 'Accordion Delay', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'label_block' => false,
			'default'     => 0,
			'description' => 'A number determining the delay before to show a content or hide a content from an accordion item',
		] );
		$this->add_control( 'epa_accordion_right_icon_show', [
			'label'        => esc_html__( 'Enable Accordion Right Icon', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_accordion_right_icon', [
			'label'     => esc_html__( 'Accordion Right Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-chevron-up',
			'include'   => [
				'fa fa-angle-up',
				'fa fa-angle-double-up',
				'fa fa-caret-up',
				'fa fa-chevron-up',
				'fa fa-chevron-circle-up',
				'fa fa-arrow-up',
				'fa fa-long-arrow-up',
			],
			'condition' => [
				'epa_accordion_right_icon_show' => 'yes',
			],
		] );
		$this->end_controls_section();

		/**
		 * Advance Accordion Content Settings
		 */
		$this->start_controls_section( 'eael_section_adv_accordion_content_settings', [
			'label' => esc_html__( 'Content Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_accordion_tab', [
			'type'        => Controls_Manager::REPEATER,
			'seperator'   => 'before',
			'default'     => [
				[ 'epa_accordion_title' => esc_html__( 'Accordion Title 1', 'epa_elementor' ) ],
				[ 'epa_accordion_title' => esc_html__( 'Accordion Title 2', 'epa_elementor' ) ],
				[ 'epa_accordion_title' => esc_html__( 'Accordion Title 3', 'epa_elementor' ) ],
			],
			'fields'      => [
				[
					'name'         => 'epa_accordion_default_active',
					'label'        => esc_html__( 'Active as Default', 'epa_elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
				],
				[
					'name'         => 'epa_accordion_icon_show',
					'label'        => esc_html__( 'Enable Accordion Icon', 'epa_elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'return_value' => 'yes',
				],
				[
					'name'      => 'epa_accordion_icon',
					'label'     => esc_html__( 'Icon', 'epa_elementor' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-plus',
					'condition' => [
						'epa_accordion_icon_show' => 'yes',
					],
				],
				[
					'name'    => 'epa_accordion_title',
					'label'   => esc_html__( 'Tab Title', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Tab Title', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],

				[
					'name'    => 'epa_accordion_content',
					'label'   => esc_html__( 'Tab Content', 'epa_elementor' ),
					'type'    => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],
			],
			'title_field' => '{{epa_accordion_title}}',
		] );
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Accordion Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_accordion_style_settings', [
			'label' => esc_html__( 'General Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_responsive_control( 'epa_accordion_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_accordion_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa_accordion',
		] );
		$this->add_responsive_control( 'epa_accordion_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_accordion_box_shadow',
			'selector' => '{{WRAPPER}} .epa_accordion',
		] );
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Advance Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_accordion_section_style_settings', [
				'label' => esc_html__( 'Heading Style', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		$this->add_responsive_control( 'epa_accordion_heading_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_heading_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'epa_accordion_title_heading', [
			'label'     => esc_html__( 'Title Typhography', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_accordion_title_typography',
				'selector' => '{{WRAPPER}} .accordion-header',
				'separator' => 'after',
			] );

		$this->add_control( 'epa_accordion_left_icon_heading', [
			'label'     => esc_html__( 'Accordion Left Icon', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_responsive_control( 'epa_accordion_icon_size', [
				'label'      => __( 'Icon Size', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 18,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #accicon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			] );
		$this->add_responsive_control( 'eael_adv_accordion_tab_icon_gap', [
				'label'      => __( 'Icon Gap', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #accicon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			] );
		$this->add_control( 'epa_accordion_right_icon_heading', [
			'label'     => esc_html__( 'Accordion Right Icon', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'epa_accordion_right_icon_size', [
			'label'      => __( 'Right Icon Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 18,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .accordion-item-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->start_controls_tabs( 'epa_accordion_header_tabs' );
		# Normal State Tab
		$this->start_controls_tab( 'epa_accordion_header_normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_accordion_heading_bgcolor',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .accordion-header',
		] );


		$this->add_control( 'eael_adv_accordion_tab_text_color', [
				'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-header' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'epa_accordion_left_icon_color', [
				'label'     => esc_html__( 'Left Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} #accicon' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'epa_accordion_right_icon_color', [
				'label'     => esc_html__( 'Right Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-item-arrow' => 'color: {{VALUE}};',
				],
				'condition' => [
					'epa_accordion_right_icon_show' => 'yes',
				],
			] );
		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'epa_accordion_heading_border',
				'label'    => esc_html__( 'Border', 'epa_elementor' ),
				'selector' => '{{WRAPPER}} .accordion-header',
			] );
		$this->add_responsive_control( 'epa_accordion_heading_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );
		$this->end_controls_tab();

		# Hover State Tab
		$this->start_controls_tab( 'epa_accordion_header_hover', [
				'label' => esc_html__( 'Hover', 'epa_elementor' ),
			] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_accordion_heading_bgcolor_hover',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .accordion-header:hover',
		] );

		$this->add_control( 'epa_accordion_title_color_hover', [
				'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-header:hover' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'epa_accordion_left_icon_color_hover', [
				'label'     => esc_html__( 'Left Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-header:hover #accicon' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'epa_accordion_right_icon_color_hover', [
				'label'     => esc_html__( 'Right Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-header:hover .accordion-item-arrow' => 'color: {{VALUE}};',
				],
				'condition' => [
					'epa_accordion_right_icon_show' => 'yes',
				],
			] );
		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'epa_accordion_heading_border_hover',
				'label'    => esc_html__( 'Border', 'epa_elementor' ),
				'selector' => '{{WRAPPER}} .accordion-header:hover',
			] );
		$this->add_responsive_control( 'epa_accordion_heading_border_radius_hover', [
				'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );
		$this->end_controls_tab();

		#Active State Tab
		$this->start_controls_tab( 'eael_adv_accordion_header_active', [
				'label' => esc_html__( 'Active', 'epa_elementor' ),
			] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_accordion_heading_color_active',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .accordion-item.active .accordion-header',
		] );


		$this->add_control( 'epa_accordion_heading_title_color_active', [
				'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-item.active .accordion-header' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_accordion_left_icon_color_active', [
				'label'     => esc_html__( 'Left Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-item.active #accicon' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'epa_accordion_right_icon_color_active', [
				'label'     => esc_html__( 'Right Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#434955',
				'selectors' => [
					'{{WRAPPER}} .accordion-item.active .accordion-item-arrow' => 'color: {{VALUE}};',
				],
				'condition' => [
					'epa_accordion_right_icon_show' => 'yes',
				],
			] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'epa_accordion_content_style_settings',
			[
				'label'	=> esc_html__( 'Content Style', 'epa_elementor' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'epa_accordion_content_bg_color',
			[
				'label'		=> esc_html__( 'Background Color', 'epa_elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .accordion-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'epa_accordion_content_text_color',
			[
				'label'		=> esc_html__( 'Text Color', 'epa_elementor' ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#333',
				'selectors' => [
					'{{WRAPPER}} .accordion-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'epa_accordion_content_typography',
				'selector'	=> '{{WRAPPER}} .accordion-content',
			]
		);
		$this->add_responsive_control(
			'epa_accordion_content_padding',
			[
				'label'			=> esc_html__( 'Padding', 'epa_elementor' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'epa_accordion_content_margin',
			[
				'label'			=> esc_html__( 'Margin', 'epa_elementor' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'em', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'		=> 'epa_accordion_content_border',
				'label'		=> esc_html__( 'Border', 'epa_elementor' ),
				'selector'	=> '{{WRAPPER}} .accordion-content',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'		=> 'epa_accordion_content_shadow',
				'selector'	=> '{{WRAPPER}} .accordion-content',
				'separator'	=> 'before'
			]
		);
		$this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$accID  = uniqid(); // ACCORDION ID
		$output = '<div id="ac' . $accID . '" class="epa_accordion">';

		foreach ( $settings['epa_accordion_tab'] as $accContent ) {

			// Default Accordion Active
			$accDefault = $accContent['epa_accordion_default_active'] == 'yes' ? 'active' : '';

			$output .= '<div class="accordion-item ' . $accDefault . '">
					<div class="accordion-header">';
			if ( $accContent['epa_accordion_icon_show'] == 'yes' ) {
				$output .= '<i id="accicon" class="' . $accContent['epa_accordion_icon'] . '"></i>';
			}
			$output .= '' . $accContent['epa_accordion_title'] . '';
			if ( $settings['epa_accordion_right_icon_show'] == 'yes' ) {
				$output .= '<span class="accordion-item-arrow ' . $settings['epa_accordion_right_icon'] . '"></span>';
			}
			$output .= '</div>
					<div class="accordion-content">
						' . $accContent['epa_accordion_content'] . '
						</div>';
			$output .= '</div>';
		}

		$output .= '</div>';

		$output .= '<script type="text/javascript">
						   jQuery(document).ready(function(){  
						      jQuery("#ac' . $accID . '").epa_accordion({
						      duration: ' . $settings['epa_accordion_speed'] . ',
						      delay: ' . $settings['epa_accordion_delay'] . ',
						      exclusive: ' . $settings['epa_accordion_type'] . '
						      });
						   });
			</script>';

		echo $output;
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_accordion() );