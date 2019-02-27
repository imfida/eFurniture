<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_servicebox extends Widget_Base {

	public function get_name() {
		return 'epa_servicebox';
	}

	public function get_title() {
		return __( 'Service Box', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-favorite wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Register Control
	protected function _register_controls() {
		$this->start_controls_section( 'icon_section', [
			'label' => __( 'Service Icon', 'epa_elementor' ),
		] );

		// Icon Image or Icon
		$this->add_responsive_control( 'servicebox_img_or_icon', [
			'label'       => esc_html__( 'Image or Icon', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
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
			//'prefix_class' => 'servicebox-img-icon-',
		] );

		// Services Icon
		$this->add_control( 'service_icon', [
			'label'       => __( 'Icon', 'epa_elementor' ),
			'type'        => Controls_Manager::ICON,
			'label_block' => true,
			'default'     => 'fa fa-star',
			'condition'   => [
				'servicebox_img_or_icon' => 'icon',
			],
		] );

		$this->add_control( 'servicebox_image', [
			'label'     => esc_html__( 'Servicebox Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'servicebox_img_or_icon' => 'img',
			],
		] );


		$this->end_controls_section();
		// Service Section END

		// Service Section Start
		$this->start_controls_section( 'content_section', [
			'label' => __( 'ServiceBox Content', 'epa_elementor' ),
		] );

		//Title Control
		$this->add_control( 'service_title', [
			'label'       => __( 'Title', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Creative Idea', 'epa_elementor' ),
			'placeholder' => __( 'Type your Service Title here', 'epa_elementor' ),
		] );

		//Description Control
		$this->add_control( 'service_description', [
			'label'       => __( 'Description', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings.', 'epa_elementor' ),
			'placeholder' => __( 'Type your Service Item Description here', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_servicebox_button_show', [
			'label'        => __( 'Show Button?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'separator'   => 'before',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );


		$this->add_control( 'epa_servicebox_button_text', [
			'label'       => __( 'Button Text', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => 'View More',
			'placeholder' => __( 'Enter button text', 'epa_elementor' ),
			'title'       => __( 'Enter button text here', 'epa_elementor' ),
			'condition'   => [
				'epa_servicebox_button_show' => 'yes',
			],
		] );

		$this->add_control( 'epa_servicebox_button_link', [
			'label'         => __( 'Button URL', 'epa_elementor' ),
			'type'          => Controls_Manager::URL,
			'label_block'   => true,
			'placeholder'   => __( 'Enter link URL for the button', 'epa_elementor' ),
			'show_external' => true,
			'default'       => [
				'url' => '#',
			],
			'title'         => __( 'Enter heading for the button', 'epa_elementor' ),
			'condition'     => [
				'epa_servicebox_button_show' => 'yes',
			],
		] );
		$this->end_controls_section();


		/* ===============================================
			START ICON STYLE SECTION
			===========================================*/

		$this->start_controls_section( 'servicebox_icon_style_sec', [
			'label'     => __( 'Icon Style', 'epa_elementor' ),
			'condition' => [
				'servicebox_img_or_icon' => 'icon',
			],
			'tab'       => Controls_Manager::TAB_STYLE,
		] );

		// Icon Size
		$this->add_responsive_control( 'servicebox_icon_size', [
			'label'     => __( 'Icon Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 40,
			],
			'range'     => [
				'px' => [
					'min'  => 20,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox i' => 'font-size: {{SIZE}}px;',
			],
			'condition' => [
				'servicebox_img_or_icon!' => 'img',
			],
		] );


		// Icon Color
		$this->add_control( 'servicebox_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox i' => 'color: {{VALUE}};',
			],
			'condition' => [
				'servicebox_img_or_icon!' => 'img',
			],
		] );

		// Icon Background Shape
		$this->add_control( 'servicebox_icon_bgshape', [
			'label'        => esc_html__( 'Background Shape', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'circle',
			'label_block'  => false,
			'options'      => [
				'none'   => esc_html__( 'None', 'epa_elementor' ),
				'circle' => esc_html__( 'Circle', 'epa_elementor' ),
				'radius' => esc_html__( 'Radius', 'epa_elementor' ),
				'square' => esc_html__( 'Square', 'epa_elementor' ),
			],
			'prefix_class' => 'servicebox-icon-bgshape-',
			'condition'    => [
				'servicebox_img_or_icon!' => 'img',
			],
		] );

		// Icon Background Size
		$this->add_responsive_control( 'servicebox_icon_background_size', [
			'label'     => __( 'Background Shape Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 90,
			],
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 300,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox .epa-service-icon' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'condition' => [
				'servicebox_img_or_icon!'  => 'img',
				'servicebox_icon_bgshape!' => 'none',
			],
		] );

		//Background Shape Color
		$this->add_control( 'servicebox_icon_bgcolor', [
			'label'     => esc_html__( 'Background Shape Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#428ef8',
			'selectors' => [

				'{{WRAPPER}} .epa-servicebox  .epa-service-icon'        => 'background: {{VALUE}};',
				'{{WRAPPER}} .epa-service1:hover'                       => 'border: 1px solid {{VALUE}};',
				'{{WRAPPER}} .epa-service1'                             => 'border-bottom-color: {{VALUE}};',
			],
			'condition' => [
				'servicebox_icon_bgshape!' => 'none',
				'servicebox_img_or_icon!'  => 'img',
			],
		] );

		// Icon Border Color With none Background Shape
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'servicebox_icon_border',
			'label'     => esc_html__( 'Border', 'epa_elementor' ),
			'selector'  => '{{WRAPPER}} .epa-servicebox .epa-service-icon i:before',
			'condition' => [
				'servicebox_img_or_icon'  => 'icon',
				'servicebox_icon_bgshape' => 'none',
			],
		] );

		// Box Shadow With None Background Shape
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'servicebox_icon_shadow',
			'condition' => [
				'servicebox_img_or_icon'  => 'icon',
				'servicebox_icon_bgshape' => 'none',
			],
			'selector'  => '{{WRAPPER}} .epa-servicebox .epa-service-icon i:before',
		] );

		// Icon Border Color With BG Shape
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'servicebox_icon_border_cir_sqe',
			'label'     => esc_html__( 'Border', 'epa_elementor' ),
			'selector'  => '{{WRAPPER}} .epa-servicebox .epa-service-icon',
			'condition' => [
				'servicebox_img_or_icon'   => 'icon',
				'servicebox_icon_bgshape!' => 'none',

			],
		] );

		// Box Shadow With BG Shape
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'servicebox_icon_shadow_cir_sqe',
			'condition' => [
				'servicebox_img_or_icon'   => 'icon',
				'servicebox_icon_bgshape!' => 'none',

			],
			'selector'  => '{{WRAPPER}} .epa-servicebox .epa-service-icon',
		] );
		$this->end_controls_section();

		/* ===============================================
		END ICON STYLE SECTION
		===========================================*/

		/* ===============================================
		START IMAGE STYLE SECTION
		===========================================*/

		$this->start_controls_section( 'servicebox_image_style_sec', [
			'label'     => __( 'Image Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'servicebox_img_or_icon' => 'img',
			],
		] );

		// Image Size
		$this->add_responsive_control( 'servicebox_img_size', [
			'label'     => __( 'Image Resizer', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 40,
			],
			'range'     => [
				'px' => [
					'min'  => 20,
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'servicebox_img_or_icon[url]!' => '',
			],
		] );


		$this->add_control( 'epa_infobox_img_shape', [
			'label'        => esc_html__( 'Image Shape', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'square',
			'label_block'  => false,
			'options'      => [
				'square' => esc_html__( 'Square', 'epa_elementor' ),
				'circle' => esc_html__( 'Circle', 'epa_elementor' ),
				'radius' => esc_html__( 'Radius', 'epa_elementor' ),
			],
			'prefix_class' => 'epa-iconBox-bg-shape-',
		] );

		// Image Border Color
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'servicebox_image_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-servicebox img',
		] );

		$this->add_responsive_control( 'servicebox_image_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-servicebox img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'servicebox_image_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-servicebox img' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/* ===============================================
			START COLOR & TYPHOGRAPHY STYLE SECTION
			===========================================*/

		$this->start_controls_section( 'servicebox_color_typography_section', [
			'label' => __( 'Color & Typography', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'servicebox_title_heading', [
			'label'     => esc_html__( 'Title Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		// Title Color
		$this->add_control( 'servicebox_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#252525',
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox .epa-title' => 'color: {{VALUE}};',
			],
		] );

		// Title Typography
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'servicebox_title_typography',
			'selector' => '{{WRAPPER}} .epa-servicebox .epa-title',
		] );

		$this->add_responsive_control( 'servicebox_title_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-servicebox .epa-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Content Style
		$this->add_control( 'servicebox_content_heading', [
			'label'     => esc_html__( 'Content Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		// content Color
		$this->add_control( 'servicebox_content_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .epa-servicebox .epa-description' => 'color: {{VALUE}};',
			],
		] );
		// Content Typograpgy
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'servicebox_content_typography',
			'selector' => '{{WRAPPER}} .epa-servicebox .epa-description',
		] );

		// Content Padding
		$this->add_responsive_control( 'servicebox_content_padding', [
			'label'      => esc_html__( 'Content Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-servicebox .epa-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();


		// Start Advance TAB
		$this->start_controls_section( '_section_style', [
			'label' => esc_html__( 'ServiceBox Advanced', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_ADVANCED,
			'name'  => 'advanced',
		] );

		$this->add_responsive_control( '_margin', [
			'label' => __( '', 'elementor' ),
			'name'  => '_margin',
		] );

		$this->add_responsive_control( 'servicebox_container_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-servicebox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/* ===============================================
			END COLOR & TYPHOGRAPHY STYLE SECTION
			===========================================*/


		/* ===============================================
			START BUTTON STYLE SECTION
			===========================================*/
		$this->start_controls_section( 'servicebox_button_section', [
			'label' => __( 'Button Style', 'epa_elementor' ),
			'condition'   => [
				'epa_servicebox_button_show' => 'yes',
			],
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		// content Color
		$this->add_control( 'servicebox_button_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#000000',
			'selectors' => [
				'{{WRAPPER}} .epa-service1 a' => 'color: {{VALUE}};',
			],
		] );
		// Button BG Color
		$this->add_control( 'servicebox_button_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			//'default'   => '#4054b2',
			'selectors' => [
				'{{WRAPPER}} .epa-service1 a' => 'background-color: {{VALUE}};',
			],
		] );
		// Button Typograpgy
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'servicebox_button_typography',
			'selector' => '{{WRAPPER}} .epa-service1 a',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'epa_servicebox_button_border',
			'label'     => esc_html__( 'Border', 'epa_elementor' ),
			'selector'  => '{{WRAPPER}} .epa-service1 a',
		] );

		$this->add_control( 'epa_servicebox_button_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-service1 a' => 'border-radius: {{SIZE}}px;',
			],
		] );

		// Button Margin
		$this->add_responsive_control( 'servicebox_button_margin', [
			'label'      => esc_html__( 'Button Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-service1 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		// Button Margin
		$this->add_responsive_control( 'servicebox_button_padding', [
			'label'      => esc_html__( 'Button Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-service1 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/* ===============================================
			END BUTTON STYLE SECTION
		   ===========================================*/


		/* ===============================================
			START CONTAINER STYLE SECTION
			===========================================*/

		$this->start_controls_section( 'servicebox_container_section', [
			'label' => __( 'Container Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'servicebox_container_background',
			'label'    => __( 'Background', 'epa_elementor' ),
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .epa-service1',
		] );

		$this->add_control( 'servicebox_normal_container_border', [
				'label'     => __( 'Normal Border', 'epa_elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			] );
		// Icon Border Color With none Background Shape
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'servicebox_container_border',
			'selector' => '{{WRAPPER}} .epa-service1',
		] );
		$this->add_control( 'servicebox_hover_container_border', [
			'label'     => __( 'Hover Border', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		// Icon Border Color With none Background Shape
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'servicebox_container_hover_border',
			'selector' => '{{WRAPPER}} .epa-service1:hover',
		] );

		// content Color
		$this->add_control( 'servicebox_container_border_shape_color', [
			'label'     => esc_html__( 'Shape Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#428EF8',
			'selectors' => [
				'{{WRAPPER}} .epa-service1::before' => 'background: {{VALUE}};',
				'{{WRAPPER}} .epa-service1::after' => 'background: {{VALUE}};',
			],
		] );


		$this->end_controls_section();

	}

	// Render Control in Frontend
	protected function render() {

		$settings = $this->get_settings_for_display();

		// Get Url Value
		$target   = $settings['epa_servicebox_button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['epa_servicebox_button_link']['nofollow'] ? ' rel="nofollow"' : '';
		$sbox_url = $settings['epa_servicebox_button_link']['url'];

		// Image Value Get
		$servicebox_image     = $settings['servicebox_image'];
		$servicebox_image_url = Group_Control_Image_Size::get_attachment_image_src( $servicebox_image['id'], 'thumbnail', $settings );

		if ( empty( $servicebox_image_url ) ) : $servicebox_image_url = $servicebox_image['url'];
		else: $servicebox_image_url = $servicebox_image_url;
		endif;

		$output = '';
		$output .= '<div class="epa-servicebox epa-service1">
					<div class="epa-service-icon">';

		if ( $settings['servicebox_img_or_icon'] == 'icon' ) {
			$output .= '<i class="' . $settings['service_icon'] . '"></i>';
		}

		if ( $settings['servicebox_img_or_icon'] == 'img' ) {
			$output .= '<img src="' . $servicebox_image_url . '" alt="">';
		}

		$output .= '</div>
                    <h3 class="epa-title">' . $settings['service_title'] . '</h3>
                    <p class="epa-description">
                        ' . $settings['service_description'] . '
                    </p>';
		if($settings['epa_servicebox_button_show'] == 'yes') {
			$output .= '<a href="'.$sbox_url.'" '.$target . $nofollow .'>'.$settings['epa_servicebox_button_text'].'</a>';
		}
		$output .= '</div>';

		echo $output;

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_servicebox() );