<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Eap_filtergalllery extends Widget_Base {

	public function get_name() {
		return 'wfe-filtergalllery';
	}

	public function get_title() {
		return __( 'Filter Gallery', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-th wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {

		$this->start_controls_section( 'filter_gallery_display_option', [
			'label' => __( 'Display Options', 'epa_elementor' ),
		] );
		$this->add_control( 'filter_gallery_first_cat_switcher', [
			'label'   => __( 'First Category', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_lightbox_switcher', [
			'label'   => __( 'Lightbox Gallery?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_link_switcher', [
			'label'   => __( 'Gallery Link?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_title_switcher', [
			'label'   => __( 'Show Title?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_description_switcher', [
			'label'   => __( 'Show Description?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_cats', [
			'label' => __( 'Categories', 'epa_elementor' ),
		] );


		$this->add_control( 'filter_gallery_first_cat_label', [
			'label'     => __( 'First Category Label', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => __( 'All', 'epa_elementor' ),
			'dynamic'   => [ 'active' => true ],
			'condition' => [
				'filter_gallery_first_cat_switcher' => 'yes',
			],
		] );

		$repeater = new REPEATER();

		$repeater->add_control( 'filter_gallery_img_cat', [
			'label'   => __( 'Category', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'filter_gallery_cats_content', [
			'label'       => __( 'Categories', 'epa_elementor' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'filter_gallery_img_cat' => 'Category 1',
				],
				[
					'filter_gallery_img_cat' => 'Category 2',
				],
			],
			'fields'      => array_values( $repeater->get_controls() ),
			'title_field' => '{{{ filter_gallery_img_cat }}}',
		] );

		$this->add_control( 'filter_gallery_active_cat', [
			'label'       => __( 'Active Category Index', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'description' => __( 'Put the index of the default active category, default is 1', 'epa_elementor' ),
			'min'         => 0,
			'max'         => 20,
			'default'     => 0,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_content', [
			'label' => __( 'Images', 'epa_elementor' ),
		] );

		$img_repeater = new REPEATER();

		$img_repeater->add_control( 'filter_gallery_img_upload', [
			'label'   => __( 'Upload Image', 'epa_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [ 'active' => true ],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$img_repeater->add_control( 'filter_gallery_img_name', [
			'label'       => __( 'Name', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$img_repeater->add_control( 'filter_gallery_img_desc', [
			'label'       => __( 'Description', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$img_repeater->add_control( 'filter_gallery_img_category', [
			'label'   => __( 'Category', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [ 'active' => true ],
            'description' => 'Category Name is case-sensitive. You Must Put Same categories Name which You Created Before'
		] );
		$img_repeater->add_control( 'filter_gallery_img_link', [
			'label'       => __( 'Link', 'epa_elementor' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => 'https://codenat.com/',
			'label_block' => true,
		] );

		$this->add_control( 'filter_gallery_img_content', [
			'label'       => __( 'Images', 'epa_elementor' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'filter_gallery_img_name'     => 'Image #1',
					'filter_gallery_img_category' => 'Category 1',
				],
				[
					'filter_gallery_img_name'     => 'Image #2',
					'filter_gallery_img_category' => 'Category 2',
				],
			],
			'fields'      => array_values( $img_repeater->get_controls() ),
			'title_field' => '{{{ filter_gallery_img_name }}}' . ' / {{{ filter_gallery_img_category }}}',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_grid_settings', [
			'label' => __( 'Grid Settings', 'epa_elementor' ),

		] );

		$this->add_responsive_control( 'filter_gallery_column_number', [
			'label'           => __( 'Columns', 'epa_elementor' ),
			'label_block'     => true,
			'type'            => Controls_Manager::SELECT,
			'desktop_default' => '50%',
			'tablet_default'  => '100%',
			'mobile_default'  => '100%',
			'options'         => [
				'100%'    => __( '1 Column', 'epa_elementor' ),
				'50%'     => __( '2 Columns', 'epa_elementor' ),
				'33.330%' => __( '3 Columns', 'epa_elementor' ),
				'25%'     => __( '4 Columns', 'epa_elementor' ),
				'20%'     => __( '5 Columns', 'epa_elementor' ),
				'16.66%'  => __( '6 Columns', 'epa_elementor' ),
				'8.33%'   => __( '12 Columns', 'epa_elementor' ),
			],
			'selectors'       => [
				'{{WRAPPER}} .epa-filtergallery-item ' => 'width: {{VALUE}};',
			],
			'render_type'     => 'template',
		] );

		$this->add_control( 'filter_gallery_img_size_select', [
			'label'   => __( 'Grid Layout', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'fitRows' => __( 'Even', 'epa_elementor' ),
				'masonry' => __( 'Masonry', 'epa_elementor' ),
			],
			'default' => 'fitRows',
		] );

		/*		$this->add_group_control( Group_Control_Image_Size::get_type(), [
						'name'      => 'thumbnail', // Actually its `image_size`.
						'default'   => 'full',
						'condition' => [
							'filter_gallery_img_size_select' => 'fitRows',
						],
					] );*/

		$this->add_responsive_control( 'filter_gallery_gap', [
			'label'      => __( 'Image Gap', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', "em" ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-filtergallery-item' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );
		/*
				$this->add_control( 'filter_gallery_img_style', [
						'label'       => __( 'Skin', 'epa_elementor' ),
						'type'        => Controls_Manager::SELECT,
						'description' => __( 'Choose a layout style for the gallery', 'epa_elementor' ),
						'options'     => [
							'default' => __( 'Style 1', 'epa_elementor' ),
							'style1'  => __( 'Style 2', 'epa_elementor' ),
							'style2'  => __( 'Style 3', 'epa_elementor' ),
						],
						'default'     => 'default',
						'label_block' => true,
					] );

				$this->add_responsive_control( 'filter_gallery_style1_border_border', [
						'label'       => __( 'Height', 'epa_elementor' ),
						'type'        => Controls_Manager::SLIDER,
						'range'       => [
							'px' => [
								'min' => 0,
								'max' => 700,
							],
						],
						'label_block' => true,
						'selectors'   => [
							'{{WRAPPER}} .pa-gallery-img.style1 .premium-gallery-caption' => 'bottom: {{SIZE}}px;',
						],
						'condition'   => [
							'filter_gallery_img_style' => 'style1',
						],
					] );*/

		/*		$this->add_control( 'filter_gallery_img_effect', [
						'label'       => __( 'Style', 'epa_elementor' ),
						'type'        => Controls_Manager::SELECT,
						'description' => __( 'Choose a hover effect for the image', 'epa_elementor' ),
						'options'     => [
							'none'    => __( 'None', 'epa_elementor' ),
							'zoomin'  => __( 'Zoom In', 'epa_elementor' ),
							'zoomout' => __( 'Zoom Out', 'epa_elementor' ),
							'scale'   => __( 'Scale', 'epa_elementor' ),
							'gray'    => __( 'Grayscale', 'epa_elementor' ),
							'blur'    => __( 'Blur', 'epa_elementor' ),
							'bright'  => __( 'Bright', 'epa_elementor' ),
							'sepia'   => __( 'Sepia', 'epa_elementor' ),
							'trans'   => __( 'Translate', 'epa_elementor' ),
						],
						'default'     => 'zoomin',
						'label_block' => true,
					] );*/

		$this->add_responsive_control( 'filter_gallery_content_align', [
			'label'     => __( 'Content Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption' => 'text-align: {{VALUE}};',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'filter_gallery_filter_style', [
			'label' => __( 'Filter Button', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'filter_gallery_filter_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_filter_active_color', [
			'label'     => __( 'Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .is-checked' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_filter_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		$this->add_control( 'filter_gallery_background_color', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f3f3f3',
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .button' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_background_active_color', [
			'label'     => __( 'Background Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#666',
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .is-checked' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_filter_border',
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		/*Border Radius*/
		$this->add_control( 'filter_gallery_filter_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'filter_gallery_filter_shadow',
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		$this->add_responsive_control( 'filter_gallery_filter_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Front Icon Padding*/
		$this->add_responsive_control( 'filter_gallery_filter_padding', [
			'label'      => __( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'filter_gallery_img_style_section', [
			'label' => __( 'Images', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'filter_gallery_image_overlay_color', [
			'label'     => __( 'Hover Overlay Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects:after' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'thumbnail',
			'condition' => [
				'filter_gallery_img_size_select' => 'fitRows',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_img_border',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects',
		] );

		/*First Border Radius*/
		$this->add_control( 'filter_gallery_img_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => __( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_img_box_shadow',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects',
		] );

		/*Margin*/
		$this->add_responsive_control( 'filter_gallery_img_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_content_style', [
			'label' => __( 'Content', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'filter_gallery_title_heading', [
			'label' => __( 'Title', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'filter_gallery_title_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption h3' => 'color: {{VALUE}};',
			],
		] );

		/*Title Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_title_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .caption h3',
		] );

		$this->add_control( 'filter_gallery_description_heading', [
			'label'     => __( 'Description', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'filter_gallery_description_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_description_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .caption p',
		] );
		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_icons_style', [
			'label' => __( 'Icons', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'filter_gallery_icons_style_tabs' );

		$this->start_controls_tab( 'filter_gallery_icons_style_normal', [
			'label' => __( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'filter_gallery_icons_style_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_icons_style_background', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'background-color: {{VALUE}};',
			],
		] );

		/* Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_icons_style_border',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a',
		] );

		/*Button Border Radius*/
		$this->add_control( 'filter_gallery_icons_style_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => __( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_icons_style_shadow',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a',
		] );

		/* Margin*/
		$this->add_responsive_control( 'filter_gallery_icons_style_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'filter_gallery_icons_style_hover', [
			'label' => __( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'filter_gallery_icons_style_color_hover', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_icons_style_background_hover', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover' => 'background-color: {{VALUE}};',
			],
		] );

		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_icons_style_border_hover',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover',
		] );

		/*Button Border Radius*/
		$this->add_control( 'filter_gallery_icons_style_border_radius_hover', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => __( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_icons_style_shadow_hover',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover',
		] );

		/*Button Margin*/
		$this->add_responsive_control( 'filter_gallery_icons_style_margin_hover', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} ..epa-fil-gallery-effects .link-wrap a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$act_cat       = $settings['filter_gallery_active_cat'];
		$act_cat_index = $act_cat == 0 ? 'is-checked' : '';

		$uni_button_id = uniqid();


		//$active_cat = $settings['filter_gallery_active_cat'] == 'yes' ? 'active-work' : '';
		?>
        <!-- Start Work Section -->
        <div class="epa-filtergallery-wrapper">

            <div class="button-group filters-button-group flbutgrp<?php echo $uni_button_id; ?>">
				<?php if ( $settings['filter_gallery_first_cat_switcher'] == 'yes' ) : ?>
                    <button class="button <?php echo $act_cat_index; ?>" data-filter="*"><?php echo $settings['filter_gallery_first_cat_label']; ?></button>

				<?php endif; ?>
				<?php
				$i = 1;
				$epaid = uniqid();
				foreach ( $settings['filter_gallery_cats_content'] as $item ) {
					$active_cat   = $act_cat == $i ++ ? 'is-checked' : '';
					$filter_class = $item['filter_gallery_img_cat'];
					$filter_class = str_replace( " ", "-", strtolower( $filter_class ) );
					?>

                    <button class="button <?php echo $active_cat; ?>" data-filter=".<?php echo $filter_class; ?>"><?php echo $item['filter_gallery_img_cat']; ?></button>

				<?php } ?>

            </div>


            <div class="epa-filtergallery-grid epa-flgallery-wap<?php echo $epaid; ?>">

				<?php
				foreach ( $settings['filter_gallery_img_content'] as $items ) {
					$icon_link = $items['filter_gallery_img_link']['url'];
					$external  = $items['filter_gallery_img_link']['is_external'] ? 'target="_blank"' : '';
					$no_follow = $items['filter_gallery_img_link']['nofollow'] ? 'rel="nofollow"' : '';

					$filter_class = $items['filter_gallery_img_category'];
					$filter_class = str_replace( " ", "-", strtolower( $filter_class ) );

					$lightbox_switcher    = $settings['filter_gallery_lightbox_switcher'];
					$link_switcher        = $settings['filter_gallery_link_switcher'];
					$title_switcher       = $settings['filter_gallery_title_switcher'];
					$description_switcher = $settings['filter_gallery_description_switcher'];


                    if($settings['filter_gallery_img_size_select'] == 'fitRows') {
					// Image Value Get
					$epa_team_image    = $items['filter_gallery_img_upload'];
					$epateam_image_url = Group_Control_Image_Size::get_attachment_image_src( $epa_team_image['id'], 'thumbnail', $settings );
					if ( empty( $epateam_image_url ) ) : $epateam_image_url = $epa_team_image['url'];
					else: $epateam_image_url = $epateam_image_url;
					endif;
                    }
                    else {
	                    $epateam_image_url = $items['filter_gallery_img_upload']['url'];
                    }


					?>

                    <div class="epa-filtergallery-item <?php echo $filter_class; ?>">

                        <div class="epa-fil-gal-effect1 epa-fil-gallery-effects">
                            <img class="epa-flga-img" src="<?php echo $epateam_image_url; ?>" alt="img1">
                            <div class="caption">
								<?php if ( $title_switcher == 'yes' ) : ?>
                                    <h3><?php echo $items['filter_gallery_img_name']; ?></h3>
								<?php endif; ?>
								<?php if ( $description_switcher == 'yes' ) : ?>
                                    <p><?php echo $items['filter_gallery_img_desc'] ?></p>
								<?php endif; ?>
                            </div>

                            <div class="link-wrap">
								<?php if ( $lightbox_switcher == 'yes' ) : ?>
                                    <a href="<?php echo $items['filter_gallery_img_upload']['url']; ?>" data-fancybox="gallery<?php echo $epaid;?>"><i class="fa fa-search"></i></a>
								<?php endif; ?>

								<?php if ( $link_switcher == 'yes' ) : ?>
                                    <a href="<?php echo esc_attr( $icon_link ); ?>" <?php echo $external; ?><?php echo $no_follow; ?>><i class="fa fa-link"></i></a>
								<?php endif; ?>
                            </div>
                        </div>


                    </div>
				<?php } ?>

            </div>

        </div><!-- End Work Section -->

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                // init Isotope
                var $grid = $('.epa-flgallery-wap<?php echo $epaid; ?>').isotope({
                   itemSelector: '.epa-filtergallery-item',
                    layoutMode: '<?php echo $settings['filter_gallery_img_size_select']; ?>'
                });

                // filter functions
                var filterFns = {
                    // show if number is greater than 50
                    numberGreaterThan50: function () {
                        var number = $(this).find('.number').text();
                        return parseInt(number, 10) > 50;
                    },
                    // show if name ends with -ium
                    ium: function () {
                        var name = $(this).find('.name').text();
                        return name.match(/ium$/);
                    }
                };
                // bind filter button click
                $('.flbutgrp<?php echo $uni_button_id; ?>').on('click', 'button', function () {
                    var filterValue = $(this).attr('data-filter');
                    // use filterFn if matches value
                    filterValue = filterFns[filterValue] || filterValue;
                    $grid.isotope({filter: filterValue});
                });
                // change is-checked class on buttons
                $('.flbutgrp<?php echo $uni_button_id; ?>').each(function (i, buttonGroup) {
                    var $buttonGroup = $(buttonGroup);
                    $buttonGroup.on('click', 'button', function () {
                        $buttonGroup.find('.is-checked').removeClass('is-checked');
                        $(this).addClass('is-checked');
                    });
                });
                $('[data-fancybox="gallery<?php echo $epaid;?>"]').fancybox({
                    // Options will go here
                });
            });
        </script>

		<?php
	}

	protected function _content_template() {

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Eap_filtergalllery() );