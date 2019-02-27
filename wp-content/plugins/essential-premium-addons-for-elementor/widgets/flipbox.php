<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_flipbox extends Widget_Base {

	public function get_name() {
		return 'wfe-flipbox';
	}

	public function get_title() {
		return __( 'Flip Box', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-flip-box wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {


		$this->start_controls_section( 'epa_elementor_section_flipbox_content_settings', [
			'label' => esc_html__( 'Flipbox Options', 'epa_elementor' ),
		] );

		/*		// FlipBox Effects
				$this->add_control( 'epa_elementor_flipbox_type', [
					'label'       => esc_html__( 'Flipbox Style', 'epa_elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'default',
					'label_block' => false,
					'options'     => [
						'default' => esc_html__( 'Default', 'epa_elementor' ),
						//'animate-zoom-in' => esc_html__( 'Zoom Flip', 'epa_elementor' ),
					],
				] );*/
		$this->add_control( 'epa_elementor_flipbox_style', [
			'label'   => __( 'Flipbox Style', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'flip-left',
			'options' => [
				'flip-left'  => __( 'Flip Left', 'epa_elementor' ),
				'flip-right'  => __( 'Flip Right', 'epa_elementor' ),
				'flip-top'  => __( 'Flip Top', 'epa_elementor' ),
				'flip-bottom'  => __( 'Flip Bottom', 'epa_elementor' ),
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_flipbox_img_icon_section', [
			'label' => esc_html__( 'Image or Icon', 'epa_elementor' ),
		] );
		$this->start_controls_tabs( 'epa_icon_image_front_back' );

		$this->start_controls_tab( 'front', [
			'label' => __( 'Front', 'epa_elementor' ),
		] );

		// Icon Image or Icon
		$this->add_responsive_control( 'epa_flipbox_img_or_icon', [
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


		$this->add_control( 'epa_front_flipbox_image', [
			'label'     => esc_html__( 'Flipbox Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_flipbox_img_or_icon' => 'img',
			],
		] );

		$this->add_control( 'epa_flipbox_icon', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-snowflake-o',
			'separator' => 'before',
			'condition' => [
				'epa_flipbox_img_or_icon' => 'icon',
			],
		] );

		$this->add_responsive_control( 'epa_flipbox_image_resizer', [
			'label'     => esc_html__( 'Image Resizer', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '80',
			],
			'range'     => [
				'px' => [
					'max' => 500,
				],
			],
			'separator' => 'before',
			'selectors' => [
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-front-content img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'condition' => [
				'epa_flipbox_img_or_icon' => 'img',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'epa_front_flipbox_image[url]!' => '',
				'epa_flipbox_img_or_icon'       => 'img',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'back', [
			'label' => __( 'Back', 'epa_elementor' ),
		] );


		// Icon Image or Icon
		$this->add_responsive_control( 'epa_flipbox_img_or_icon_back', [
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


		$this->add_control( 'epa_back_flipbox_image', [
			'label'     => esc_html__( 'Flipbox Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_flipbox_img_or_icon_back' => 'img',
			],
		] );

		$this->add_control( 'epa_flipbox_icon_back', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-snowflake-o',
			'condition' => [
				'epa_flipbox_img_or_icon_back' => 'icon',
			],
		] );

		$this->add_responsive_control( 'epa_flipbox_image_resizer_back', [
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
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-back-content img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'condition' => [
				'epa_flipbox_img_or_icon_back' => 'img',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail_back',
			'default'   => 'full',
			'condition' => [
				'epa_flipbox_image_back[url]!' => '',
				'epa_flipbox_img_or_icon_back' => 'img',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Flipbox Content
		 */
		$this->start_controls_section( 'epa_elementor_flipbox_content', [
			'label' => esc_html__( 'Flipbox Content', 'epa_elementor' ),
		] );
		$this->add_responsive_control( 'epa_elementor_flipbox_front_or_back_content', [
			'label'       => esc_html__( 'Front or Back Content', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'front' => [
					'title' => esc_html__( 'Front Content', 'epa_elementor' ),
					'icon'  => 'fa fa-reply',
				],
				'back'  => [
					'title' => esc_html__( 'Back Content', 'epa_elementor' ),
					'icon'  => 'fa fa-share',
				],
			],
			'default'     => 'front',
		] );
		/**
		 * Condition: 'epa_elementor_flipbox_front_or_back_content' => 'front'
		 */
		$this->add_control( 'epa_elementor_flipbox_front_title', [
			'label'       => esc_html__( 'Front Title', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => esc_html__( 'Front Title Goes Here', 'epa_elementor' ),
			'condition'   => [
				'epa_elementor_flipbox_front_or_back_content' => 'front',
			],
		] );
		$this->add_control( 'epa_elementor_flipbox_front_text', [
			'label'       => esc_html__( 'Front Text', 'epa_elementor' ),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'default'     => __( 'Flipbox Frontend content', 'epa_elementor' ),
			'condition'   => [
				'epa_elementor_flipbox_front_or_back_content' => 'front',
			],
		] );
		/**
		 * Condition: 'epa_elementor_flipbox_front_or_back_content' => 'back'
		 */
		$this->add_control( 'epa_elementor_flipbox_back_title', [
			'label'       => esc_html__( 'Back Title', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => esc_html__( 'Back Title Goes Here', 'epa_elementor' ),
			'condition'   => [
				'epa_elementor_flipbox_front_or_back_content' => 'back',
			],
		] );
		$this->add_control( 'epa_elementor_flipbox_back_text', [
			'label'       => esc_html__( 'Back Text', 'epa_elementor' ),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'default'     => __( 'Flipbox Backend content', 'epa_elementor' ),
			'condition'   => [
				'epa_elementor_flipbox_front_or_back_content' => 'back',
			],
		] );


		$this->add_responsive_control( 'epa_flipbox_content_alignment', [
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
			'prefix_class' => 'epa-flipbox-content-align-',
		] );

		$this->end_controls_section();

		/**
		 * ----------------------------------------------
		 * Flipbox Link
		 * ----------------------------------------------
		 */
		$this->start_controls_section( 'epa_flixbox_link_section', [
			'label' => esc_html__( 'Link', 'epa_elementor' ),
		] );

		$this->add_control( 'flipbox_link_type', [
			'label'   => __( 'Link Type', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'none',
			'options' => [
				'none'   => __( 'None', 'epa_elementor' ),
				'box'    => __( 'Box', 'epa_elementor' ),
				'title'  => __( 'Title', 'epa_elementor' ),
				'button' => __( 'Button', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'flipbox_link', [
			'label'         => __( 'Link', 'epa_elementor' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => __( 'https://yourlink.com', 'epa_elementor' ),
			'show_external' => true,
			'default'       => [
				'url'         => '#',
				'is_external' => true,
				'nofollow'    => true,
			],
			'condition'     => [
				'flipbox_link_type!' => 'none',
			],
		] );

		$this->add_control( 'flipbox_button_text', [
			'label'     => __( 'Button Text', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'dynamic'   => [
				'active' => true,
			],
			'default'   => __( 'Read More', 'epa_elementor' ),
			'condition' => [
				'flipbox_link_type' => 'button',
			],
		] );

		$this->add_control( 'button_icon', [
			'label'     => __( 'Button Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => '',
			'condition' => [
				'flipbox_link_type' => 'button',
			],
		] );

		$this->add_control( 'button_icon_position', [
			'label'        => __( 'Icon Position', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'before',
			'options'      => [
				'before' => __( 'Before', 'epa_elementor' ),
				'after'  => __( 'After', 'epa_elementor' ),
			],
			'prefix_class' => 'epa_button_icon_position-',
			'condition'    => [
				'flipbox_link_type' => 'button',
				'button_icon!'      => '',
			],
		] );


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_flipbox_style_section', [
			'label' => esc_html__( 'Filp Box Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'epa_flipbox_front_back_backgound_style_section' );

		$this->start_controls_tab( 'epa_flipbox_front_backgound_style', [
			'label' => __( 'Front', 'epa_elementor' ),
		] );

		/*Title & Subtitle Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_flipbox_front_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .flip-front-overlay',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab( 'epa_flipbox_back_backgound_style', [
			'label' => __( 'Back', 'epa_elementor' ),
		] );

		/*Title & Subtitle Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_flipbox_back_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .flip-back-overlay',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control( 'epa_flipbox_container_border_heading', [
			'label'     => esc_html__( 'Container Box Style', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_filbpox_container_border',
			'selector' => '{{WRAPPER}} .epa-flipbox-wrapper .flipbox-front-side',
		] );

		$this->add_control( 'epa_elementor_flipbox_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-front-side' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-back-side'  => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->add_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_flipbox_container_shadow',
			'selector' => [
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-front-side',
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-back-side',
			],
		] );

		$this->add_responsive_control( 'epa_elementor_flipbox_container_margin', [
			'label'      => esc_html__( 'Fornt / Back Container Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-flipbox-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_elementor_flipbox_front_back_padding', [
			'label'      => esc_html__( 'Fornt / Back Container Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-flipbox-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_elementor_section_flipbox_imgae_style_settings', [
			'label'     => esc_html__( 'Image Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_flipbox_img_or_icon' => 'img',
			],
		] );

		$this->add_control( 'epa_elementor_flipbox_img_type', [
			'label'        => esc_html__( 'Image Type', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'default',
			'label_block'  => false,
			'options'      => [
				'default' => esc_html__( 'Default', 'epa_elementor' ),
				'radius'  => esc_html__( 'Radius', 'epa_elementor' ),
				'circle'  => esc_html__( 'Circle', 'epa_elementor' ),
			],
			'prefix_class' => 'epa-flipbox-img-',
		] );

		/**
		 * Condition: 'epa_elementor_flipbox_img_type' => 'radius'
		 */
		$this->add_control( 'epa_elementor_filpbox_img_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-front-content img' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-flipbox-wrapper .flipbox-back-content img' => 'border-radius: {{SIZE}}px;',
			],
			'condition' => [
				'epa_elementor_flipbox_img_type'    => 'radius',
			],
		] );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_elementor_section_flipbox_icon_style_settings', [
			'label'     => esc_html__( 'Icon Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_flipbox_img_or_icon' => 'icon',
			],
		] );

		$this->start_controls_tabs( 'epa_flipbox_icon_style_front_back_section' );

		$this->start_controls_tab( 'epa_flipbox_front_icon_style', [
			'label' => __( 'Front', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_flipbox_front_icon_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-front-content i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_flipbox_front_icon_size', [
			'label'     => esc_html__( 'Icon Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .flipbox-front-content i' => 'font-size: {{SIZE}}px;',
			],
		] );


		$this->end_controls_tab();


		$this->start_controls_tab( 'epa_flipbox_back_icon_style', [
			'label' => __( 'Back', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_flipbox_back_icon_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-back-content #flipbox_back_icon' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_flipbox_back_icon_size', [
			'label'     => esc_html__( 'Icon Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .flipbox-back-content #flipbox_back_icon' => 'font-size: {{SIZE}}px;',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_flipbox_title_style_section', [
			'label' => esc_html__( 'Color &amp; Typography', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'epa_flipbox_color_and_typhography_section' );


		$this->start_controls_tab( 'epa_flipbox_front_color_typhography_style', [
			'label' => __( 'Front', 'epa_elementor' ),
		] );
		/**
		 * Title
		 */
		$this->add_control( 'epa_flipbox_title_front_heading', [
			'label'     => esc_html__( 'Title Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_flipbox_front_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-front-content h2' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_flipbox_front_title_typhography',
			'selector' => '{{WRAPPER}} .flipbox-front-content h2',
		] );

		/**
		 * Content
		 */
		$this->add_control( 'epa_flipbox_front_content_style_heading', [
			'label'     => esc_html__( 'Content Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_front_content_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-front-content p' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_flipbox_front_content_typography',
			'selector' => '{{WRAPPER}} .flipbox-front-content p',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'epa_flipbox_back_color_typhography_style', [
			'label' => __( 'Back', 'epa_elementor' ),
		] );
		/**
		 * Title
		 */
		$this->add_control( 'epa_flipbox_title_back_heading', [
			'label'     => esc_html__( 'Title Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_flipbox_back_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-back-content h2' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_flipbox_back_title_typhography',
			'selector' => '{{WRAPPER}} .flipbox-back-content h2',
		] );

		/**
		 * Content
		 */
		$this->add_control( 'epa_flipbox_back_content_style_heading', [
			'label'     => esc_html__( 'Content Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_back_content_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .flipbox-back-content p' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_flipbox_back_content_typography',
			'selector' => '{{WRAPPER}} .flipbox-back-content p',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Box Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_button_style_section', [
			'label'     => esc_html__( 'Button Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'flipbox_link_type' => 'button',
			],
		] );

		$this->start_controls_tabs( 'flipbox_button_style_settings' );

		$this->start_controls_tab( 'flipbox_button_normal_style', [
			'label' => __( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_flipbox_button_color', [
			'label'     => esc_html__( 'Button Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a span' => 'color: {{VALUE}};',
				//'{{WRAPPER}} .epa_flipbox_button a i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_flipbox_button_bg_color', [
			'label'     => esc_html__( 'Button Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#000000',
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_flipbox_button_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'step' => 1,
					'max'  => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa_flipbox_button a' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_flipbox_button_typography',
			'selector' => '{{WRAPPER}} .epa_flipbox_button a span',
		] );

		$this->add_responsive_control( 'epa_flipbox_button_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_flipbox_button a span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_flipbox_button_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_flipbox_button a span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_control( 'epa_flipbox_button_icon_heading', [
			'label'     => esc_html__( 'Button Icon', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_flipbox_button_icon_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a i' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_button_icon_spacing_before', [
			'label'     => esc_html__( 'Spacing', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'condition' => [
				'button_icon_position' => 'before',
			],
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a i' => 'margin-right: {{SIZE}}px',
			],
		] );
		$this->add_control( 'epa_button_icon_spacing_after', [
			'label'     => esc_html__( 'Spacing', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'condition' => [
				'button_icon_position' => 'after',
			],
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a i' => 'margin-left: {{SIZE}}px',
			],
		] );


		$this->end_controls_tab();

		$this->start_controls_tab( 'flipbox_button_hover_style', [
			'label' => __( 'Hover', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_flipbox_button_hover_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a span:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_flipbox_button_hover_bg_color', [
			'label'     => esc_html__( 'Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			//'default'   => '#000000',
			'selectors' => [
				'{{WRAPPER}} .epa_flipbox_button a:hover' => 'background: {{VALUE}};',
			],
		] );
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings();


		// Get Link Value
		$flipbox_url = $settings['flipbox_link']['url']; // Flipbox URL
		$target      = $settings['flipbox_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow    = $settings['flipbox_link']['nofollow'] ? ' rel="nofollow"' : '';

		//Get Flipbox Array Value SECTION

		$fronttitle        = $settings['epa_elementor_flipbox_front_title']; // Front Title
		$backtitle         = $settings['epa_elementor_flipbox_back_title']; // Back Title
		$fronttext         = $settings['epa_elementor_flipbox_front_text']; // Front Text
		$backtext          = $settings['epa_elementor_flipbox_back_text']; // Back Text

		// Icon Image For Front & Back
		$iconimg   = ( $settings['epa_flipbox_img_or_icon'] ) == "icon" ? "icon" : ( ( $settings['epa_flipbox_img_or_icon'] ) == "img" ? "img" : "" );
		$bkiconimg = ( $settings['epa_flipbox_img_or_icon_back'] ) == "icon" ? "icon" : ( ( $settings['epa_flipbox_img_or_icon_back'] ) == "img" ? "img" : "" );


/*		// Get Image Value For Front And Back
		$flipbox_image     = ( isset( $settings['epa_front_flipbox_image'] ) ) ? $settings['epa_front_flipbox_image'] : ( $settings['epa_back_flipbox_image'] ? $settings['epa_back_flipbox_image'] : '' ); //Front Image*/

		//Front Image Value
		$flipbox_front_image     = $settings['epa_front_flipbox_image']; //Front Image*
		$flipbox_front_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_front_image['id'], 'thumbnail', $settings );
		if ( empty( $flipbox_front_image_url ) ) : $flipbox_front_image_url = $flipbox_front_image['url'];
		else: $flipbox_front_image_url = $flipbox_front_image_url; endif;

		//Back Image Value
		$flipbox_back_image     = $settings['epa_back_flipbox_image']; //Front Image*
		$flipbox_back_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_back_image['id'], 'thumbnail', $settings );
		if ( empty( $flipbox_back_image_url ) ) : $flipbox_back_image_url = $flipbox_back_image['url'];
		else: $flipbox_back_image_url = $flipbox_back_image_url; endif;



		require "addonstyle/flipboxstyle.php"; // Require Flip Box Style

		echo $output;
	}

	protected function content_template() {

		?>


		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_flipbox() );