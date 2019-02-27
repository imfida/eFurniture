<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_infobox extends Widget_Base {

	public function get_name() {
		return 'wfe-infobox';
	}

	public function get_title() {
		return __( 'Info Box', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-icon-box wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		$this->start_controls_section( 'epa_infobox_display_option_section', [
			'label' => esc_html__( 'Display Option', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_infobox_icon_img_show', [
			'label'        => __( 'Show Icon or Image?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'epa_infobox_title_show', [
			'label'        => __( 'Show Title?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'epa_infobox_content_show', [
			'label'        => __( 'Show Content?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'epa_infobox_button_link_show', [
			'label'        => __( 'Show Button?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'epa_infobox_hover_border_shape_show', [
			'label'        => __( 'Hover Border Shape?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_infobox_img_icon_section', [
			'label'     => esc_html__( 'Infobox Image', 'epa_elementor' ),
			'condition' => [
				'epa_infobox_icon_img_show' => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_infobox_img_icon', [
			'label'       => esc_html__( 'Image or Icon', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
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

		$this->add_control( 'epa_infobox_img', [
			'label'     => esc_html__( 'Infobox Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_infobox_img_icon' => 'img',
			],
		] );

		$this->add_control( 'epa_infobox_icon', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-briefcase',
			'condition' => [
				'epa_infobox_img_icon' => 'icon',
			],
		] );

		$this->end_controls_section();


		/**
		 * Infobox Content Section
		 */
		$this->start_controls_section( 'epa_infobox_content_section', [
			'label' => esc_html__( 'Infobox Content', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_infobox_title', [
			'label'       => esc_html__( 'Title', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'epa_infobox_title_show' => 'yes',
			],
			'default'     => esc_html__( 'This is an info box', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_infobox_description', [
			'label'       => esc_html__( 'Description', 'epa_elementor' ),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'epa_infobox_content_show' => 'yes',
			],
			'default'     => esc_html__( 'Description Goes Here, That will describe the title or something informational and useful.', 'epa_elementor' ),
		] );
		$this->add_responsive_control( 'epa_infobox_content_alignment', [
			'label'        => esc_html__( 'Content Alignment', 'epa_elementor' ),
			'type'         => Controls_Manager::CHOOSE,
			'label_block'  => true,
			'options'      => [
				'left'   => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'      => 'center',
			'prefix_class' => 'epa-infobox-content-align-',
		] );
		$this->end_controls_section();

		/**
		 * ----------------------------------------------
		 * Infobox Button Section
		 * ----------------------------------------------
		 */
		$this->start_controls_section( 'epa_infobox_button', [
			'label'     => esc_html__( 'Button Link', 'epa_elementor' ),
			'condition' => [
				'epa_infobox_button_link_show' => 'yes',
			],
		] );

		$this->add_control( 'show_button_or_clickable', [
			'label' => __( 'Button or Box Clickable?', 'plugin-domain' ),
			'type'  => Controls_Manager::CHOOSE,

			'options' => [
				'showbutton' => [
					'title' => __( 'Show Button', 'plugin-domain' ),
					'icon'  => 'fa fa-money',
				],
				'clickable'  => [
					'title' => __( 'Infobox Clickable', 'plugin-domain' ),
					'icon'  => 'fa fa-hand-o-up',
				],
			],
			'default' => 'showbutton',
			'toggle'  => true,
		] );

		$this->add_control( 'epa_infobox_clickable_link', [
			'label'         => esc_html__( 'Infobox Link', 'epa_elementor' ),
			'type'          => Controls_Manager::URL,
			'label_block'   => true,
			'default'       => [
				'url'         => '#',
				'is_external' => '',
			],
			'show_external' => true,
			'condition'     => [
				'show_button_or_clickable' => 'clickable',
			],
		] );

		$this->add_control( 'epa_infobox_button_text', [
			'label'       => __( 'Button Text', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => 'View More',
			'separator'   => 'before',
			'placeholder' => __( 'Enter button text', 'epa_elementor' ),
			'title'       => __( 'Enter button text here', 'epa_elementor' ),
			'condition'   => [
				'show_button_or_clickable' => 'showbutton',
			],
		] );

		$this->add_control( 'epa_infobox_button_link', [
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
				'show_button_or_clickable' => 'showbutton',
			],
		] );

		$this->add_control( 'epa_infobox_button_icon_show', [
			'label'        => __( 'Show Icon in Button?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'condition'    => [
				'show_button_or_clickable!' => 'clickable',
			],
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_infobox_button_icon', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-arrow-right',
			'condition' => [
				'show_button_or_clickable!'    => 'clickable',
				'epa_infobox_button_icon_show' => 'yes',
			],
		] );

		$this->add_control( 'epa_infobox_button_icon_space', [
			'label'     => esc_html__( 'Icon Spacing', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 60,
				],
			],
			'condition' => [
				'show_button_or_clickable!'    => 'clickable',
				'epa_infobox_button_icon!'     => '',
				'epa_infobox_button_icon_show' => 'yes',
			],
			'selectors' => [
				'{{WRAPPER}} .service-Content a span i' => 'margin-right: {{SIZE}}px;',
			],
		] );

		$this->end_controls_section();


		/////////////// INFO BOX STYLE SECTION ////////////////
		/// ////////////////////////////////////////////////////

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_infobox_icon_style_section', [
			'label'     => esc_html__( 'Icon Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_infobox_img_icon' => 'icon',
			],
		] );

		$this->add_responsive_control( 'epa_infobox_icon_size', [
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
				'{{WRAPPER}} .serviceBox .service-icon i' => 'font-size: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_infobox_icon_bg_size', [
			'label'     => __( 'Icon Background Size', 'epa_elementor' ),
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
				'{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
		] );

		$this->add_responsive_control( 'epa_infobox_icon_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .serviceBox .service-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'epa_infobox_icon_styles_control' );

		$this->start_controls_tab( 'epa_infobox_icon_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_infobox_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .epa-service-icon-item' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_infobox_icon_bg_shape', [
			'label'        => esc_html__( 'Background Shape', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'none',
			'label_block'  => false,
			'options'      => [
				'none'   => esc_html__( 'None', 'epa_elementor' ),
				'circle' => esc_html__( 'Circle', 'epa_elementor' ),
				'radius' => esc_html__( 'Radius', 'epa_elementor' ),
				'square' => esc_html__( 'Square', 'epa_elementor' ),
			],
			'prefix_class' => 'epa-iconBox-bg-shape-',
		] );

		$this->add_control( 'epa_infobox_icon_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item' => 'background: {{VALUE}};',
			],
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'epa_infobox_icon_border',
			'label'     => esc_html__( 'Border', 'epa_elementor' ),
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
			'selector'  => '{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_infobox_icon_shadow',
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
			'selector'  => '{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab( 'epa_infobox_icon_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_icon_hover_animation', [
			'label' => esc_html__( 'Animation', 'epa_elementor' ),
			'type'  => Controls_Manager::HOVER_ANIMATION,
		] );

		$this->add_control( 'epa_icon_hover_color', [
			'label'     => esc_html__( 'Icon Hover Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .epa-service-icon-item:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_icon_hover_bg_color', [
			'label'     => esc_html__( 'Shape Hover Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item:hover' => 'background: {{VALUE}};',
			],
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_infobox_icon_hover_shadow',
			'condition' => [
				'epa_infobox_icon_bg_shape!' => 'none',
			],
			'selector'  => '{{WRAPPER}} .serviceBox .service-icon .epa-service-icon-item:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		/* ===============================================
		END ICON STYLE SECTION
		==========================================*/

		/* ===============================================
		Start Info Box Image Style
		===========================================*/

		$this->start_controls_section( 'epa_infobox_imgae_style_section', [
			'label'     => esc_html__( 'Image Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_infobox_img_icon' => 'img',
			],
		] );


		$this->add_control( 'epa_infobox_image_size', [
			'label'     => esc_html__( 'Image Resizer', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 100,
			],
			'range'     => [
				'px' => [
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .service-img img' => 'width: {{SIZE}}px;',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'epa_infobox_img[url]!' => '',
			],
		] );

		$this->add_responsive_control( 'epa_infobox_img_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .service-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'epa_infobox_image_style' );

		$this->start_controls_tab( 'epa_infobox_image_normal', [
			'label' => __( 'Normal', 'epa_elementor' ),
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_infobox_image_shadow',
			'selector' => '{{WRAPPER}} .service-img img',
		] );

		$this->add_responsive_control( 'epa_infobox_image_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .service-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_infobox_image_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .service-img img',
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
			'condition'    => [
				'epa_infobox_img_icon' => 'img',
			],
		] );
		$this->add_responsive_control( 'epa_infobox_image_margin_hover', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .service-img img:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();

		$this->start_controls_tab( 'epa_infobox_image_hover_section', [
			'label' => __( 'Hover', 'epa_elementor' ),
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_infobox_image_hover_shadow',
			'selector' => '{{WRAPPER}} .service-img img:hover',
		] );

		$this->add_control( 'epa_image_hover_animation', [
			'label' => esc_html__( 'Animation', 'epa_elementor' ),
			'type'  => Controls_Manager::HOVER_ANIMATION,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_infobox_image_hover_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .service-img img:hover',
		] );

		$this->add_control( 'epa_infobox_img_hover_shape', [
			'label'        => esc_html__( 'Image Shape', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'square',
			'label_block'  => false,
			'options'      => [
				'square' => esc_html__( 'Square', 'epa_elementor' ),
				'circle' => esc_html__( 'Circle', 'epa_elementor' ),
				'radius' => esc_html__( 'Radius', 'epa_elementor' ),
			],
			'prefix_class' => 'epa-img-hover-shape-',
			'condition'    => [
				'epa_infobox_img_icon' => 'img',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		/* ===============================================
		END IMAGE STYLE SECTION
		===========================================*/


		/* ===============================================
		START BUTTON STYLE SECTION
		===========================================*/

		$this->start_controls_section( 'epa_button_section_settings', [
			'label'     => esc_html__( 'Button Styles', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_infobox_button_link_show' => 'yes',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_button_typography',
			'selector' => '{{WRAPPER}} .read-more span',
		] );

		$this->add_responsive_control( 'epa_button_padding', [
			'label'      => esc_html__( 'Button Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .read-more span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'epa_button_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .read-more span' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->start_controls_tabs( 'infobox_button_styles_controls_tabs' );

		$this->start_controls_tab( 'epa_infobox_button_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_button_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#282828',
			'selectors' => [
				'{{WRAPPER}} .read-more span' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_button_background_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .read-more span' => 'background: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_button_border',
			'selector' => '{{WRAPPER}} .read-more span',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .read-more span',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'infobox_button_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_button_hover_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#282828',
			'selectors' => [
				'{{WRAPPER}} .read-more span:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_button_hover_background_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .read-more span:hover' => 'background: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_button_hover_border',
			'selector' => '{{WRAPPER}} .read-more span:hover',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_hover_box_shadow',
			'selector' => '{{WRAPPER}} .read-more span:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ===============================================
		END BUTTON STYLE SECTION
		===========================================*/

		/* ===============================================
		START COLOR & TYPHOGRAPHY STYLE SECTION
		===========================================*/

		$this->start_controls_section( 'epa_title_style_section', [
				'label' => esc_html__( 'Color &amp; Typography', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

/*		$this->start_controls_tabs( 'epa_content_hover_style_tab' );

		$this->start_controls_tab( 'infobox_content_normal_style', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );*/

		$this->add_control( 'epa_title_heading', [
				'label' => esc_html__( 'Title Style', 'epa_elementor' ),
				'type'  => Controls_Manager::HEADING,
			] );

		$this->add_control( 'epa_infobox_title_color', [
				'label'     => esc_html__( 'Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .serviceBox .title' => 'color: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_title_typography',
				'selector' => '{{WRAPPER}} .serviceBox .title',
			] );

		$this->add_responsive_control( 'epa_title_margin', [
				'label'      => esc_html__( 'Margin', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .serviceBox .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );
		$this->add_control( 'epa_content_heading', [
				'label'     => esc_html__( 'Content Style', 'epa_elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			] );


		$this->add_control( 'epa_content_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .service-Content p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_content_typography_hover',
			'selector' => '{{WRAPPER}} .service-Content p',
		] );

		$this->add_responsive_control( 'epa_content_margin', [
				'label'      => esc_html__( 'Content Margin', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .service-Content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_responsive_control( 'epa_content_padding', [
			'label'      => esc_html__( 'Content Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .service-Content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_control( 'epa_fullbox_heading', [
			'label'     => esc_html__( 'Box Border Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		// Normal Border FullBox
		$this->start_controls_tabs( 'infobox_fullbox_styles_normal_tabs' );

		$this->start_controls_tab( 'epa_fullbox_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_fullbox_border',
			'selector' => '{{WRAPPER}} .serviceBox',
		] );
		$this->end_controls_tab();

		// Hover Border FullBox
		$this->start_controls_tab( 'epa_fullbox_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_border_shape_color', [
			'label'     => esc_html__( 'Border Shape Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#41d7f7',
			'selectors' => [
				'{{WRAPPER}} .serviceBox::before, .serviceBox::after' => 'background: {{VALUE}};',
			],
			'condition' => [
				'epa_infobox_hover_border_shape_show' => 'yes',
			],

		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_fullbox_hover_border',
			'selector' => '{{WRAPPER}} .serviceBox:hover',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ===============================================
		END COLOR & TYPHOGRAPHY STYLE SECTION
		===========================================*/
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Get Link Value
		$button_url  = $settings['epa_infobox_button_link']['url']; // Button URL Value
		$infobox_url = $settings['epa_infobox_clickable_link']['url']; // Infobox URL Value

		$button_target    = $settings['epa_infobox_button_link']['is_external'] ? ' target="_blank"' : '';
		$infobox_target   = $settings['epa_infobox_clickable_link']['is_external'] ? ' target="_blank"' : '';
		$button_nofollow  = $settings['epa_infobox_button_link']['nofollow'] ? ' rel="nofollow"' : '';
		$infobox_nofollow = $settings['epa_infobox_clickable_link']['nofollow'] ? ' rel="nofollow"' : '';
		// End Link Value

		$output = '';
		if($settings['epa_infobox_hover_border_shape_show'] == '') {
			$output .= '<style type="text/css">.serviceBox:before, .serviceBox:after {display:none;}</style>';
		}
		if ( $settings['show_button_or_clickable'] == 'clickable' ) {
			$output .= '<a href="' . $infobox_url . '" ' . $infobox_target . $infobox_nofollow . '>';
		}
		$output .= '<div class="serviceBox">'; // Main Wrapper

		// Icon Section
		if ( $settings['epa_infobox_img_icon'] == 'icon' ) {
			$output .= '<div class="service-icon"><div class="epa-service-icon-item elementor-animation-' . $settings['epa_image_hover_animation'] . '"><i class="' . $settings['epa_infobox_icon'] . '"></i></div></div>';
		}

		// Image Section
		if ( $settings['epa_infobox_img_icon'] == 'img' ) {

			// Get Image Value
			$infobox_image     = $this->get_settings( 'epa_infobox_img' );
			$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );
			if ( empty( $infobox_image_url ) ) : $infobox_image_url = $infobox_image['url'];
			else: $infobox_image_url = $infobox_image_url; endif;

			$output .= '<div class="service-img elementor-animation-' . $settings['epa_image_hover_animation'] . '"><img src="' . $infobox_image_url . '" alt=""></div>';
		}
		$output .= '<div class="service-Content">
                    <h3 class="title">' . $settings['epa_infobox_title'] . '</h3>
                    <p class="description">' . $settings['epa_infobox_description'] . '</p>';


		if ( $settings['show_button_or_clickable'] == 'showbutton' ) {
			$output .= '<a href="' . $button_url . '" class="read-more" ' . $button_target . ' ' . $button_nofollow . '><span>';
			if ( $settings['epa_infobox_button_icon_show'] == 'yes' ) {
				$output .= '<i class="' . $settings['epa_infobox_button_icon'] . '"></i>';
			}
			$output .= '' . $settings['epa_infobox_button_text'] . '';

			$output .= '</span></a>';
		}
		$output .= '</div></div>';
		if ( $settings['show_button_or_clickable'] == 'clickable' ) {
			$output .= '</a>';
		}
		echo $output;
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_infobox() );