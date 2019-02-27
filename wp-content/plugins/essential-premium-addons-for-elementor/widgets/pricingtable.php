<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_pricing extends Widget_Base {

	public function get_name() {
		return 'wfe-pricing';
	}

	public function get_title() {
		return __( 'Pricing Table', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-price-table wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium pricing table
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		/* Start Title Settings Section */
		$this->start_controls_section( 'wfe_elementor_pricing_title', [
			'label' => esc_html__( 'Pricing Table Options', 'wfe_elementor' ),
		] );

		$this->add_control( 'wfe_elementor_pricing_icon_switcher', [
			'label' => esc_html__( 'Show Icon?', 'wfe_elementor' ),
			'type'  => Controls_Manager::SWITCHER,
		] );

		$this->add_control( 'wfe_elementor_pricing_title_switcher', [
			'label'   => esc_html__( 'Show Title?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'wfe_elementor_pricing_subtitle_switcher', [
			'label'   => esc_html__( 'Show Sub Title?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'wfe_elementor_pricing_price_switcher', [
			'label'   => esc_html__( 'Show Price?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'wfe_elementor_pricing_list_switcher', [
			'label'   => esc_html__( 'Show Features?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'wfe_elementor_pricing_button_switcher', [
			'label'   => esc_html__( 'Show Button?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'wfe_elementor_pricing_badge_switcher', [
			'label'   => esc_html__( 'Show Badge?', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'no',
		] );

		$this->end_controls_section();

		/*Title Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_icon_section', [
			'label'     => esc_html__( 'Icon', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_icon_switcher' => 'yes',
			],
		] );

		$this->add_control( 'wfe_elementor_pricing_icon_selection', [
			'label'   => esc_html__( 'Select an Icon', 'wfe_elementor' ),
			'type'    => Controls_Manager::ICON,
			'default' => 'fa fa-check',
		] );

		$this->end_controls_section();

		/*Title Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_title_section', [
			'label'     => esc_html__( 'Title', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_title_switcher' => 'yes',
			],
		] );

		/*Pricing Table Title*/
		$this->add_control( 'wfe_elementor_pricing_title_text', [
			'label'       => esc_html__( 'Title', 'wfe_elementor' ),
			'default'     => 'Pricing Title',
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );
		$this->end_controls_section();

		/*Title Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_subtitle_section', [
			'label'     => esc_html__( 'Sub Title', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_subtitle_switcher' => 'yes',
			],
		] );

		/*Pricing Table Subtitle*/
		$this->add_control( 'wfe_elementor_pricing_subtitle_text', [
			'label'       => esc_html__( 'Sub Title', 'wfe_elementor' ),
			'default'     => 'subtitle text goes here',
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );
		$this->end_controls_section();


		/*Price Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_price_section', [
			'label'     => esc_html__( 'Price', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_price_switcher' => 'yes',
			],
		] );

		/*Price Currency*/
		$this->add_control( 'wfe_elementor_pricing_price_currency', [
			'label'       => esc_html__( 'Currency', 'wfe_elementor' ),
			'default'     => '$',
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		/*Price Value*/
		$this->add_control( 'wfe_elementor_pricing_price_value', [
			'label'       => esc_html__( 'Price', 'wfe_elementor' ),
			'default'     => '25',
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		/*Price Duration*/
		$this->add_control( 'epa_elementor_pricing_price_duration', [
			'label'       => esc_html__( 'Duration', 'wfe_elementor' ),
			'default'     => 'Per Month',
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$this->end_controls_section();

		/*Icon List Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_list_section', [
			'label'     => esc_html__( 'Feature List', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_list_switcher' => 'yes',
			],
		] );

		$repeater = new REPEATER();

		$repeater->add_control( 'epa_pricing_list_item_text', [
			'label'       => esc_html__( 'Text', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$repeater->add_control( 'epa_pricing_list_item_icon', [
			'label' => esc_html__( 'Icon', 'wfe_elementor' ),
			'type'  => Controls_Manager::ICON,
		] );

		$this->add_control( 'epa_pricing_feature_list_items', [
			'label'   => esc_html__( 'Features', 'wfe_elementor' ),
			'type'    => Controls_Manager::REPEATER,
			'default' => [
				[
					'epa_pricing_list_item_icon' => 'fa fa-check',
					'epa_pricing_list_item_text' => esc_html__( 'List Item #1', 'wfe_elementor' ),
				],
				[
					'epa_pricing_list_item_icon' => 'fa fa-check',
					'epa_pricing_list_item_text' => esc_html__( 'List Item #2', 'wfe_elementor' ),
				],
				[
					'epa_pricing_list_item_icon' => 'fa fa-check',
					'epa_pricing_list_item_text' => esc_html__( 'List Item #3', 'wfe_elementor' ),
				],
			],
			'fields'  => array_values( $repeater->get_controls() ),
		] );

		$this->add_responsive_control( 'wfe_elementor_pricing_list_align', [
			'label'     => __( 'Alignment', 'wfe_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'wfe_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'wfe_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'wfe_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .pricing-content' => 'text-align: {{VALUE}}',
			],
			'default'   => 'center',
		] );

		$this->end_controls_section();

		/*Description Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_description_section', [
			'label'     => esc_html__( 'Description', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_description_switcher' => 'yes',
			],
		] );


		/*Description Text*/
		$this->add_control( 'wfe_elementor_pricing_description_text', [
			'label'   => esc_html__( 'Description', 'wfe_elementor' ),
			'type'    => Controls_Manager::WYSIWYG,
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'wfe_elementor' ),
		] );

		$this->end_controls_section();

		/*Button Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_button_section', [
			'label'     => esc_html__( 'Button', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_button_switcher' => 'yes',
			],
		] );


		/*Button Text*/
		$this->add_control( 'epa_elementor_pricing_button_text', [
			'label'       => esc_html__( 'Text', 'wfe_elementor' ),
			'default'     => esc_html__( 'Sing Up', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		/**
		 * Button Link
		 */
		$this->add_control( 'pricing_button_link', [
			'label'         => __( 'Link', 'epa_elementor' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => __( 'https://yourlink.com', 'epa_elementor' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
		] );

		/*End Button Settings Section*/
		$this->end_controls_section();

		/*Button Content Section*/
		$this->start_controls_section( 'wfe_elementor_pricing_bagde_section', [
			'label'     => esc_html__( 'Badge', 'wfe_elementor' ),
			'condition' => [
				'wfe_elementor_pricing_badge_switcher' => 'yes',
			],
		] );

		$this->add_control( 'wfe_elementor_pricing_badge_text', [
			'label'       => esc_html__( 'Text', 'wfe_elementor' ),
			'default'     => esc_html__( 'Popular', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$this->add_responsive_control( 'wfe_elementor_pricing_badge_left_size', [
			'label'     => esc_html__( 'Size', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ptsColBadge-left-top .ptsColBadgeContent span ' => 'font-size: {{SIZE}}px',
			],
			'condition' => [
				'wfe_elementor_pricing_badge_position' => 'left',
			],
		] );

		$this->add_control( 'wfe_elementor_pricing_badge_right_size', [
			'label'     => esc_html__( 'Size', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ptsColBadgeContent span' => 'font-size: {{SIZE}}px',
			],
			'condition' => [
				'wfe_elementor_pricing_badge_position' => 'right',
			],
		] );

		$this->add_control( 'wfe_elementor_pricing_badge_position', [
			'label'   => esc_html__( 'Position', 'wfe_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'right' => esc_html__( 'Right', 'wfe_elementor' ),
				'left'  => esc_html__( 'Left', 'wfe_elementor' ),
			],
			'default' => 'right',
		] );

		$this->end_controls_section();

		/*Start Styling Section*/
		/*Start Icon Style Settings */
		$this->start_controls_section( 'epa_pricing_icon_style_settings', [
			'label'     => esc_html__( 'Icon', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_icon_switcher' => 'yes',
			],
		] );

		/*Icon Color*/
		$this->add_control( 'epa_pricing_icon_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_2,
			],
			'selectors' => [
				'{{WRAPPER}} .epa_pricing_icon i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_pricing_icon_size', [
			'label'     => esc_html__( 'Size', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 35,
			],
			'selectors' => [
				'{{WRAPPER}} .epa_pricing_icon i' => 'font-size: {{SIZE}}px',
			],
		] );

		/*Icon Margin*/
		$this->add_responsive_control( 'epapricing_icon_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 35,
				'right'  => 0,
				'bottom' => 35,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa_pricing_icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Icon Padding*/
		$this->add_responsive_control( 'epa_pricing_icon_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa_pricing_icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_pricing_icon_inner_border',
			'selector' => '{{WRAPPER}} .epa_pricing_icon i',
		] );

		$this->add_control( 'epa_pricing_icon_inner_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'default'    => [
				'size' => 100,
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa_pricing_icon i' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
			'separator'  => 'after',
		] );


		$this->add_control( 'epa_pricing_icon_container_heading', [
			'label' => esc_html__( 'Icon Background', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		// Icon Background Switcher
		$this->add_control( 'wfe_elementor_pricing_bg_icon_switcher', [
			'label'   => esc_html__( 'Background', 'wfe_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		/*Icon Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => 'wfe_elementor_pricing_icon_background',
			'types'     => [ 'classic', 'gradient' ],
			'selector'  => '{{WRAPPER}} .epa_pricing_icon',
			'condition' => [
				'wfe_elementor_pricing_bg_icon_switcher' => 'yes',
			],
		] );

		/*Icon Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'epa_pricing_icon_border',
			'selector'  => '{{WRAPPER}} .epa_pricing_icon',
			'condition' => [
				'wfe_elementor_pricing_bg_icon_switcher' => 'yes',
			],
		] );

		/*Icon Border Radius*/
		$this->add_control( 'epa_pricing_icon_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_pricing_icon' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [
				'wfe_elementor_pricing_bg_icon_switcher' => 'yes',
			],
		] );

		/*End Icon Style Settings */
		$this->end_controls_section();

		/*Start Title Style Settings */
		$this->start_controls_section( 'premium_pricing_title_style_settings', [
			'label'     => esc_html__( 'Title', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_title_switcher' => 'yes',
			],
		] );

		/*Title Color*/
		$this->add_control( 'premium_pricing_title_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .epa-priceTable1-header h3' => 'color: {{VALUE}};',
			],
		] );

		/*Title Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-priceTable1-header h3',
		] );
		/*Title Margin*/
		$this->add_responsive_control( 'epa_pricing_title_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1-header h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Title Padding*/
		$this->add_responsive_control( 'epa_pricing_title_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1-header h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'  => 'after',
		] );


		$this->add_control( 'epa_pricing_subtitle_color_typh', [
			'label'     => esc_html__( 'Sub Title', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		// Divider
		$this->add_control( 'epa_pricing_subtitle_hr', [
			'type'  => Controls_Manager::DIVIDER,
			'style' => 'thick',
		] );

		/*Title Color*/
		$this->add_control( 'epa_pricing_subtitle_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .epa-priceTable1-header span' => 'color: {{VALUE}};',
			],
		] );

		/*Title Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'subtitle_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-priceTable1-header span',
		] );

		$this->add_control( 'epa_pricing_title_subtitle_bg', [
			'label'     => esc_html__( 'Title - Sub Title Background', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_pricing_subtitle_bg_separator', [
			'type'  => Controls_Manager::DIVIDER,
			'style' => 'thick',
		] );
		/*Title & Subtitle Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'wfe_elementor_pricing_title_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .epa-priceTable1-header',
		] );

		/*End Title Style Settings */
		$this->end_controls_section();


		/*Start Price Style Settings */
		$this->start_controls_section( 'epa_pricing_price_style_settings', [
			'label'     => esc_html__( 'Price', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_price_switcher' => 'yes',
			],
		] );


		$this->add_control( 'premium_pricing_price_heading', [
			'label' => esc_html__( 'Price Option', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		/*Price Color*/
		$this->add_control( 'premium_pricing_price_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .price-value .amount' => 'color: {{VALUE}};',
			],
		] );


		/*Currency Color*/
		$this->add_control( 'epa_pricing_currency_bg_color', [
			'label'     => esc_html__( 'Background Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'default'   => '#D90429',
			'selectors' => [
				'{{WRAPPER}} .price-value .amount' => 'background: {{VALUE}};',
			],
		] );

		/*Price Typo*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'price_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .price-value .amount',
		] );

		$this->add_responsive_control( 'epa_pricing_price_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .price-value .amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_control( 'premium_pricing_currency_heading', [
			'label'     => esc_html__( 'Currency', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		/*Currency Color*/
		$this->add_control( 'epa_pricing_currency_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .price-value .amount .currency' => 'color: {{VALUE}};',
			],
		] );

		/*Currency Typo*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'currency_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .price-value .amount .currency',
		] );

		$this->add_responsive_control( 'epa_pricing_currency_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .price-value .amount .currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'epa_pricing_duration_section', [
			'label'     => esc_html__( 'Pricing Duration', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		/*Price Color*/
		$this->add_control( 'epa_pricing_duration_price_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#2a3a73',
			'selectors' => [
				'{{WRAPPER}} .price-value .month' => 'color: {{VALUE}};',
			],
		] );

		/*Price Background Color*/
		$this->add_control( 'epa_pricing_duration_bg_color', [
			'label'     => esc_html__( 'Background Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .price-value .month' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .epa-priceTable1 .month::after' => 'border-color: transparent transparent transparent {{VALUE}};',
			],
		] );

		/*Price Typo*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'duration_price_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .price-value .month',
		] );

		$this->add_responsive_control( 'epa_pricing_slashed_price_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .price-value .month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_pricing_slashed_price_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1 .month' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_pricing_duration_area_border',
			'selector' => '{{WRAPPER}} .epa-priceTable1 .price-value',
		] );

		$this->add_control( 'epa_pricing_price_container_heading', [
			'label'     => esc_html__( 'Container', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'      => 'epa_pricing_price_container_border',
				'label'     => esc_html__( 'Border', 'wfe_elementor' ),
				'selector'  => '{{WRAPPER}} .price-value',
			] );

		/*Price Margin*/
		$this->add_responsive_control( 'epa_pricing_price_container_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .price-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Price Padding*/
		$this->add_responsive_control( 'epa_pricing_price_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .price-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*End Price Style Settings */
		$this->end_controls_section();

		/*Start List Style Settings*/
		$this->start_controls_section( 'premium_pricing_list_style_settings', [
			'label'     => esc_html__( 'Features', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_list_switcher' => 'yes',
			],
		] );

		$this->add_control( 'premium_pricing_features_text_heading', [
			'label' => esc_html__( 'Text', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'premium_pricing_list_text_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default' => '#2A3A73',
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'list_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .pricing-content ul li',
		] );

		$this->add_control( 'epa_pricing_features_icon_heading', [
			'label' => esc_html__( 'Icon', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		/*Button Color*/
		$this->add_control( 'epa_pricing_list_icon_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_pricing_list_icon_size', [
			'label'     => esc_html__( 'Size', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li i' => 'font-size: {{SIZE}}px',
			],
		] );

		$this->add_control( 'epa_pricing_features_border_heading', [
			'label' => esc_html__( 'Feature Border color', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		/*Button Color*/
		$this->add_control( 'epa_pricing_feature_border_color', [
			'label'     => esc_html__( 'Border Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_pricing_list_icon_spacing', [
			'label'     => esc_html__( 'Spacing', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li i' => 'margin-right: {{SIZE}}px',
			],
		] );

		$this->add_control( 'epa_pricing_list_item_margin', [
			'label'     => esc_html__( 'Vertical Spacing', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .pricing-content ul li' => 'padding-bottom: {{SIZE}}px; padding-top: {{SIZE}}px;',
			],
			'separator' => 'after',
		] );

		$this->add_control( 'premium_pricing_features_container_heading', [
			'label' => esc_html__( 'Container', 'wfe_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		/*List Margin*/
		$this->add_responsive_control( 'epa_pricing_list_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .pricing-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*List Padding*/
		$this->add_responsive_control( 'epa_pricing_list_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .pricing-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/*Start Button Style Settings */
		$this->start_controls_section( 'epa_pricing_button_style_settings', [
			'label'     => esc_html__( 'Button', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_button_switcher' => 'yes',
			],
		] );

		/*Button Color*/
		$this->add_control( 'epa_pricing_button_color', [
			'label'     => esc_html__( 'Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default' => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .read' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_pricing_button_hover_color', [
			'label'     => esc_html__( 'Hover Text Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default' => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .read:hover' => 'color: {{VALUE}};',
			],
		] );

		/*Button Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'button_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .read',
		] );

		$this->start_controls_tabs( 'wfe_elementor_pricing_button_style_tabs' );

		$this->start_controls_tab( 'wfe_elementor_pricing_button_style_normal', [
			'label' => esc_html__( 'Normal', 'wfe_elementor' ),
		] );

		/*Button Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'wfe_elementor_pricing_button_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .read',
		] );

		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'wfe_elementor_pricing_button_border',
			'selector' => '{{WRAPPER}} .read',
		] );

		/*Button Border Radius*/
		$this->add_control( 'epa_elementor_pricing_box_button_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .read' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'wfe_elementor_pricing_button_box_shadow',
			'selector' => '{{WRAPPER}} .read',
		] );

		/*Button Margin*/
		$this->add_responsive_control( 'epa_pricing_button_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .read' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Button Padding*/
		$this->add_responsive_control( 'epa_pricing_button_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 10,
				'right'  => 40,
				'bottom' => 10,
				'left'   => 40,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .read' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_elementor_pricing_button_style_hover', [
			'label' => esc_html__( 'Hover', 'wfe_elementor' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'wfe_elementor_pricing_button_background_hover',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .read:hover',
		] );


		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'wfe_elementor_pricing_button_border_hover',
			'selector' => '{{WRAPPER}} .read:hover',
		] );

		/*Button Border Radius*/
		$this->add_control( 'wfe_elementor_pricing_button_border_radius_hover', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .read:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'epa_pricing_button_shadow_hover',
			'selector' => '{{WRAPPER}} .read:hover',
		] );

		/*Button Margin*/
		$this->add_responsive_control( 'epa_pricing_button_margin_hover', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .read:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Button Padding*/
		$this->add_responsive_control( 'epa_pricing_button_padding_hover', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'default'    => [
				'top'    => 10,
				'right'  => 40,
				'bottom' => 10,
				'left'   => 40,
				'unit'   => 'px',
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .read:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->end_controls_tab();

		$this->end_controls_tabs();

		/*End Button Style Section*/
		$this->end_controls_section();

		$this->start_controls_section( 'wfe_elementor_pricing_badge_style', [
			'label'     => esc_html__( 'Badge', 'wfe_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'wfe_elementor_pricing_badge_switcher' => 'yes',
			],
		] );

		$this->add_control( 'premium_pricing_badge_text_color', [
			'label'     => esc_html__( 'Text Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'  => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .ptsColBadgeContent span' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'badge_text_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .ptsColBadgeContent span'
		] );

		$this->add_responsive_control( 'wfe_elementor_pricing_badge_right_top', [
			'label'     => esc_html__( 'Vertical Distance', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -70,
					'max' => 20,
					'step' => -77,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ptsColBadgeContent span' => 'top: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'wfe_elementor_pricing_badge_right_right', [
			'label'     => esc_html__( 'Horizontal Distance', 'wfe_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => -110,
					'max' => 10,
					'step' => -110,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ptsColBadgeContent span' => 'right: {{SIZE}}px;',
			],
			'condition' => [
				'wfe_elementor_pricing_badge_position' => 'right',
			],
		] );

		/*Badge Color*/
		$this->add_control( 'epa_pricing_badge_left_color', [
			'label'     => esc_html__( 'Background Color', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default' => '#000',
			'selectors' => [
				'{{WRAPPER}} .ptsColBadgeContent span' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		/*Start Box Style Settings*/
		$this->start_controls_section( 'epa_pricing_box_style_settings', [
			'label' => esc_html__( 'Box Settings', 'wfe_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'wfe_elementor_pricing_box_style_tabs' );

		$this->start_controls_tab( 'wfe_elementor_pricing_box_style_normal', [
			'label' => esc_html__( 'Normal', 'wfe_elementor' ),
		] );

		/*Box Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'wfe_elementor_pricing_box_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .epa-priceTable1',
		] );

		/*Box Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'wfe_elementor_pricing_box_border',
			'selector' => '{{WRAPPER}} .epa-priceTable1',
		] );

		/*Box Border Radius*/
		$this->add_control( 'wfe_elementor_pricing_box_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Box Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'wfe_elementor_pricing_box_shadow',
			'selector' => '{{WRAPPER}} .epa-priceTable1',
		] );

		/*Box Margin*/
		$this->add_responsive_control( 'premium_pricing_box_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Box Padding*/
		$this->add_responsive_control( 'premium_pricing_box_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 24,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_elementor_pricing_box_style_hover', [
			'label' => esc_html__( 'Hover', 'wfe_elementor' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'wfe_elementor_pricing_box_background_hover',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .epa-priceTable1:hover',
		] );


		/*Box Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'wfe_elementor_pricing_box_border_hover',
			'selector' => '{{WRAPPER}} .epa-priceTable1:hover',
		] );

		/*Box Border Radius*/
		$this->add_control( 'wfe_elementor_pricing_box_border_radius_hover', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Box Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'wfe_elementor_pricing_box_shadow_hover',
			'selector' => '{{WRAPPER}} .epa-priceTable1:hover',
		] );

		/*Box Margin*/
		$this->add_responsive_control( 'premium_pricing_box_margin_hover', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Box Padding*/
		$this->add_responsive_control( 'premium_pricing_box_padding_hover', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 24,
				'left'   => 0,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-priceTable1:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/*End Box Style Settings*/
		$this->end_controls_section();


	}

	protected function render() {
		// get our input from the widget settings.

		$settings = $this->get_settings_for_display();

		// Get Value :
		$price_title     = $settings['wfe_elementor_pricing_title_text']; // pricing Title
		$price_subtitle  = $settings['wfe_elementor_pricing_subtitle_text']; // Pricing Subtitle
		$price_currecny  = $settings['wfe_elementor_pricing_price_currency']; // Pricing Currency
		$price           = $settings['wfe_elementor_pricing_price_value']; // Price
		$duration        = $settings['epa_elementor_pricing_price_duration']; // Pricing Duration
		$featured        = $settings['epa_pricing_feature_list_items']; // Pricing featured
		$button          = $settings['epa_elementor_pricing_button_text']; // Button
		$badge           = $settings['wfe_elementor_pricing_badge_text']; // Badge
		$badge_position  = $settings['wfe_elementor_pricing_badge_position']; // Badge Position
		$icon            = $settings['wfe_elementor_pricing_icon_selection']; // Icon
		$icon_switcher   = $settings['wfe_elementor_pricing_icon_switcher']; // Icon Switcher
		$badge_switcher  = $settings['wfe_elementor_pricing_badge_switcher']; // Badge Switcher
		$price_switcher  = $settings['wfe_elementor_pricing_price_switcher']; // Badge Switcher
		$button_switcher = $settings['wfe_elementor_pricing_button_switcher']; // Icon Switcher
		$iconbg_switcher = ($settings['wfe_elementor_pricing_bg_icon_switcher'] == 'yes') ? 'yes' : 'no'; // Icon Switcher
		// Get Link Value
		$target   = $settings['pricing_button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['pricing_button_link']['nofollow'] ? ' rel="nofollow"' : '';

		require "addonstyle/pricingTable.php"; // Require Pricing Table Style

		if ( $iconbg_switcher == 'no' ) {
			$output .= '<style type="text/css">
				.epa_pricing_icon {
					background: none !important;
					}
			</style>';
		}
		echo $output;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_pricing() );