<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_postgrid extends Widget_Base {

	public function get_name() {
		return 'epa_postgrid';
	}

	public function get_title() {
		return __( 'Post Grid', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-posts-grid wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}


	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		$this->start_controls_section( 'epa_posts_grid_content_section', [
			'label' => esc_html__( 'Posts Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_postsgrid_post_count', [
			'label'   => esc_html__( 'Post Count', 'epa_elementor' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => '6',
		] );

		$this->add_responsive_control( 'epa_postsgrid_columns', [
			'label'           => esc_html__( 'Columns', 'epa_elementor' ),
			'label_block'     => true,
			'type'            => Controls_Manager::SELECT,
			'desktop_default' => '33.330%',
			'mobile_default'  => '100%',
			'options'         => [
				'100%'    => esc_html__( '1 Column', 'epa_elementor' ),
				'50%'     => esc_html__( '2 Column', 'epa_elementor' ),
				'33.330%' => esc_html__( '3 Columns', 'epa_elementor' ),
				'25%'     => esc_html__( '4 Columns', 'epa_elementor' ),
				'20%'     => esc_html__( '5 Columns', 'epa_elementor' ),
				'16.67%'  => esc_html__( '6 Columns', 'epa_elementor' ),
			],
			'selectors'       => [
				'{{WRAPPER}} .epa-postsgrid-wrapper' => 'width: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_image_display', [
			'label'        => esc_html__( 'Show Image', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			'default'   => 'medium',
			'condition' => [
				'epa_postsgrid_image_display' => 'yes',
			],
		] );

		$this->add_control( 'epa_postsgrid_excerpt', [
			'label'        => esc_html__( 'Excerpt', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_postsgrid_excerpt_count', [
			'label'     => esc_html__( 'Excerpt Words', 'epa_elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => '50',
			'condition' => [
				'epa_postsgrid_excerpt' => 'yes',
			],
		] );


		$this->add_control( 'epa_postsgrid_meta_data_location', [
			'label'       => esc_html__( 'Meta Data Location', 'epa_elementor' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT,
			'default'     => 'middle',
			'options'     => [
				'top'    => esc_html__( 'Top', 'epa_elementor' ),
				'middle' => esc_html__( 'Middle', 'epa_elementor' ),
				'bottom' => esc_html__( 'Bottom', 'epa_elementor' ),
			],
			'separator'   => 'before',
		] );

		$this->add_control( 'epa_postsgrid_meta_data', [
			'label'       => esc_html__( 'Meta Data', 'epa_elementor' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT2,
			'default'     => [ 'date', 'categories' ],
			'multiple'    => true,
			'options'     => [
				'author'     => esc_html__( 'Author', 'epa_elementor' ),
				'date'       => esc_html__( 'Date', 'epa_elementor' ),
				'categories' => esc_html__( 'Categories', 'epa_elementor' ),
				'comments'   => esc_html__( 'Comments', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'epa_postsgrid_readmore_show_hide', [
			'label'        => __( 'Read More?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'epa_postsgrid_readmore_location', [
			'label'       => esc_html__( 'Meta Data Location', 'epa_elementor' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT,
			'default'     => 'onimage',
			'options'     => [
				'onimage' => esc_html__( 'On Image', 'epa_elementor' ),
				'bottom'  => esc_html__( 'Bottom', 'epa_elementor' ),
			],
			'description' => 'On Image Location it will show After Hover On Item. On Bottom Location It will show always',
			'condition'   => [
				'epa_postsgrid_readmore_show_hide' => 'yes',
			],
		] );

		/*Price Margin*/
		$this->add_responsive_control( 'epa_postsgrid_readmore_button_margin', [
			'label'      => esc_html__( 'Margin', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_readmore_wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [
				'epa_postsgrid_readmore_location' => 'onimage',
			],
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'epa_postsgrid_order_section', [
			'label' => esc_html__( 'Post Order', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_postsgrid_order_by', [
			'label'   => esc_html__( 'Order By', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'date',
			'options' => [
				'date'          => esc_html__( 'Default - Date', 'epa_elementor' ),
				'title'         => esc_html__( 'Post Title', 'epa_elementor' ),
				'menu_order'    => esc_html__( 'Menu Order', 'epa_elementor' ),
				'modified'      => esc_html__( 'Last Modified', 'epa_elementor' ),
				'comment_count' => esc_html__( 'Comment Count', 'epa_elementor' ),
				'rand'          => esc_html__( 'Random', 'epa_elementor' ),
			],
		] );


		$this->add_control( 'epa_postsgrid_order_asc_desc', [
			'label'   => esc_html__( 'Order', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'DESC',
			'options' => [
				'ASC'  => esc_html__( 'Ascending', 'epa_elementor' ),
				'DESC' => esc_html__( 'Descending', 'epa_elementor' ),
			],
		] );


		$this->add_control( 'epa_postsgrid_offset_count', [
			'label'       => esc_html__( 'Offset Count', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => '0',
			'default'     => '0',
			'description' => esc_html__( 'Use this to skip over posts (Example: 3 would skip the first 3 posts.)', 'epa_elementor' ),
		] );

		$this->end_controls_section();


		// Posts Query
		$this->start_controls_section( 'epa_posts_query', [
			'label' => esc_html__( 'Query', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_postsgrid_post_type_control', [
			'label'   => esc_html__( 'Post Type', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => epa_postsgrid_post_type_control(),
			'default' => 'post',
		] );


		$this->add_control( 'epa_post_type_author', [
			'label'       => esc_html__( 'Author', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_type_author(),
		] );

		$this->add_control( 'epa_post_type_categories', [
			'label'       => esc_html__( 'Categories', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_type_categories(),
			'condition'   => [
				'epa_postsgrid_post_type_control' => 'post',
			],
		] );

		$this->add_control( 'epa_post_type_tags', [
			'label'       => esc_html__( 'Tags', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_type_tags(),
			'condition'   => [
				'epa_postsgrid_post_type_control' => 'post',
			],
		] );

		$post_formats_terms = get_terms( array( 'taxonomy' => 'post_format' ) );
		if ( ! empty( $post_formats_terms ) && ! is_wp_error( $post_formats_terms ) ) {
			$this->add_control( 'epa_post_type_post_formats', [
				'label'       => esc_html__( 'Post Format', 'epa_elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => epa_postsgrid_post_type_format(),
				'condition'   => [
					'epa_postsgrid_post_type_control' => 'post',
				],
			] );
		}


		$this->add_control( 'epa_post_list_exclude', [
			'label'       => esc_html__( 'Choose Posts to Exclude', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_list_selection(),
			'condition'   => [
				'epa_postsgrid_post_type_control' => 'post',
			],
		] );
		$this->end_controls_section();

		$this->start_controls_section( 'epa_postsgrid_pagination_section', [
			'label' => esc_html__( 'Pagination', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_postsgrid_pagination', [
			'label'       => esc_html__( 'Pagination', 'epa_elementor' ),
			'label_block' => true,
			'type'        => Controls_Manager::SELECT,
			'default'     => 'none',
			'options'     => [
				'none'    => esc_html__( 'None', 'epa_elementor' ),
				'default' => esc_html__( 'Default Pagination', 'epa_elementor' ),
				//'infinite'  => esc_html__( 'Infinite Loading', 'epa_elementor' ),
				//'load-more' => esc_html__( 'Load More Button', 'epa_elementor' ),
			],
		] );


		$this->add_control( 'epa_postsgrid_pagination_prev', [
			'label'     => esc_html__( 'Previous Label', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => '&lsaquo; Previous',
			'condition' => [
				'epa_postsgrid_pagination' => 'default',
			],
		] );

		$this->add_control( 'epa_postsgrid_pagination_next', [
			'label'     => esc_html__( 'Next Label', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => 'Next &rsaquo;',
			'condition' => [
				'epa_postsgrid_pagination' => 'default',
			],
		] );

		/*	$this->add_control( 'epa_postsgrid_pagination_load_more', [
					'label'     => esc_html__( 'Load More Label', 'epa_elementor' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Load More',
					'condition' => [
						'epa_postsgrid_pagination' => 'load-more',
					],
				] );

			$this->add_control( 'epa_postsgrid_pagination_load_more_icon', [
					'type'      => Controls_Manager::ICON,
					'label'     => esc_html__( 'Icon', 'epa_elementor' ),
					'condition' => [
						'epa_postsgrid_pagination' => 'load-more',
					],
				] );

			$this->add_control( 'epa_postsgrid_pagination_load_more_icon_indent', [
					'label'     => esc_html__( 'Icon Spacing', 'epa_elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .boosted-elements-infinite-nav-pro span i' => 'padding-left: {{SIZE}}px;',
					],
					'condition' => [
						'epa_postsgrid_pagination_load_more_icon!' => '',
					],
				] );*/

		$this->end_controls_section();
		/* ===============================================
		START ZOOM MAGNIFIER STYLE SECTION
		===========================================*/

		$this->start_controls_section( 'epa_postsgrid_main_style_section', [
			'label' => esc_html__( 'Main Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_postsgrid_content_background',
			'types'    => [ 'none', 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .epa-bpost-item',
		] );


		$this->add_responsive_control( 'epa_postgrid_margin_left_right', [
			'label'     => esc_html__( 'Padding', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item' => 'padding:{{SIZE}}px;',

			],
		] );


		$this->add_responsive_control( 'epa_postsgrid_margin_bottom', [
			'label'     => esc_html__( 'Margin Bottom', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item' => 'margin-bottom:{{SIZE}}px;',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_section_main_image_styles', [
			'label' => esc_html__( 'Image Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'epa_postsgrid_image_hover_trasparency', [
			'label'     => esc_html__( 'Image Hover Transparency', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'step' => 0.1,
					'min'  => 0,
					'max'  => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item:hover .epa-post-img img' => 'opacity: {{SIZE}};',
			],
		] );


		$this->add_control( 'epa_postsgrid_image_background_color', [
			'label'     => esc_html__( 'Background color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-img:before' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_image_border_radius', [
			'label'     => esc_html__( 'Image Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-post-img img, .epa-post-img:before' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_section_title_styles', [
			'label' => esc_html__( 'Title Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'epa_postsgrid_title_color', [
			'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-post-title a' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_heading_color_hover', [
			'label'     => esc_html__( 'Title Hover Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-post-title a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_postsgrid_heading_spacing', [
			'label'     => esc_html__( 'Title Spacing', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-post-title' => 'margin-bottom:{{SIZE}}px;',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_postsgrid_heading_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-post-title a',
		] );

		$this->add_control( 'epa_postsgrid_title_shape_show_hide', [
			'label'        => __( 'Show Shape', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_postsgrid_shape_border_style', [
			'label'     => __( 'Shape Border Style', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'solid',
			'options'   => [
				'solid'  => __( 'Solid', 'epa_elementor' ),
				'dashed' => __( 'Dashed', 'epa_elementor' ),
				'dotted' => __( 'Dotted', 'epa_elementor' ),
				'double' => __( 'Double', 'epa_elementor' ),
				'groove' => __( 'Groove', 'epa_elementor' ),
				'ridge'  => __( 'Ridge', 'epa_elementor' ),
				'none'   => __( 'None', 'epa_elementor' ),
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-title:after' => 'border-style: {{VALUE}};',
			],
			'condition' => [
				'epa_postsgrid_title_shape_show_hide' => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_postsgrid_title_shape_border_width', [
			'label'     => __( 'Shape Border Pixel', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 3,
			],
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 10,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-title:after' => 'border-width: {{SIZE}}px;',
			],
			'condition' => [
				'epa_postsgrid_title_shape_show_hide' => 'yes',
			],
		] );

		$this->add_control( 'epa_postsgrid_shape_color', [
			'label'     => esc_html__( 'Shape Border Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-title::after' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'epa_postsgrid_title_shape_show_hide' => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_postsgrid_title_shape_width', [
			'label'     => __( 'Shape Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 70,
			],
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 1000,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-title:after' => 'width: {{SIZE}}px;',
			],
			'condition' => [
				'epa_postsgrid_title_shape_show_hide' => 'yes',
			],
		] );
		$this->add_responsive_control( 'epa_postsgrid_title_shape_margin_top', [
			'label'     => esc_html__( 'Margin Top', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-title:after' => 'margin-top:{{SIZE}}px;',
			],
			'condition' => [
				'epa_postsgrid_title_shape_show_hide' => 'yes',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_section_meta_styles', [
			'label' => esc_html__( 'Meta Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_responsive_control( 'epa_postsgrid_meta_icon_size', [
			'label'     => __( 'Meta Icon Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 40,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-info li i' => 'font-size: {{SIZE}}px;',
			],
		] );


		$this->add_control( 'epa_postsgrid_meta_icon_color', [
			'label'     => esc_html__( 'Meta Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-info li i' => 'color: {{VALUE}};',
			],

		] );

		$this->add_control( 'epa_postsgrid_meta_color', [
			'label'     => esc_html__( 'Meta Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-post-info li a' => 'color: {{VALUE}};',
			],

		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_postsgrid_meta_border_color',
			'selector' => '{{WRAPPER}} .epa-post-info',
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_postsgrid_meta_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-bpost-item .epa-post-info li a',
		] );
		$this->add_responsive_control( 'epa_postsgrid_meta_separator', [
			'label'     => __( 'Meta Separator', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 5,
			],
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 20,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-bpost-item .epa-post-info li' => 'margin-right: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_postsgrid_meta_spacing', [
			'label'      => esc_html__( 'Meta Margins', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-post-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'epa_postsgrid_meta_spacing_padding', [
			'label'      => esc_html__( 'Meta Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-post-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_section_excerpt_styles', [
			'label'     => esc_html__( 'Excerpt Styles', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_postsgrid_excerpt' => 'yes',
			],
		] );
		$this->add_control( 'epa_postsgrid_heading_excerpt_styles', [
			'type'  => Controls_Manager::HEADING,
			'label' => esc_html__( 'Excerpt Styles', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_postsgrid_excerpt_color', [
			'label'     => esc_html__( 'Excerpt Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-post-content p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_postsgrid_excerpt_spacing', [
			'label'     => esc_html__( 'Excerpt Spacing', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 50,
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} ..epa-bpost-item .epa-post-content' => 'margin-bottom:{{SIZE}}px;',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_postsgrid_excerpt_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			'selector' => '{{WRAPPER}} .epa-post-content p',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_section_readmore_styles', [
			'label'     => esc_html__( 'Read More Styles', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_postsgrid_readmore_show_hide' => 'yes',
			],
		] );

		$this->add_control( 'epa_postsgrid_read_more_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} a.epa-read, a.epa-read-button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_read_more_color_hover', [
			'label'     => esc_html__( 'Hover color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} a.epa-read:hover, a.epa-read-button:hover' => 'color: {{VALUE}};',
			],
		] );

		/*		$this->add_responsive_control( 'epa_postsgrid_read_more_spacing', [
						'label'       => esc_html__( 'Spacing', 'epa_elementor' ),
						'type'        => Controls_Manager::SLIDER,
						'range'       => [
							'px' => [
								'min' => -50,
								'max' => 100,
							],
						],
						'selectors'   => [
							'{{WRAPPER}}  a.epa-read, a.epa-read-button' => 'margin-bottom:{{SIZE}}px;',
						],
					] );*/


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_postsgrid_read_more_typography',
			//'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} a.epa-read, a.epa-read-button',
		] );

		$this->add_responsive_control( 'epa_postsgrid_readmore_button_padding', [
			'label'      => esc_html__( 'Padding', 'wfe_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'    => 8,
				'right'  => 10,
				'bottom' => 8,
				'left'   => 10,
				'unit'   => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} a.epa-read, a.epa-read-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Icon Background*/
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_postsgrid_readmore_button_background',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} a.epa-read, a.epa-read-button',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_postsgrid_readmore_border',
			'selector' => '{{WRAPPER}} a.epa-read, a.epa-read-button',
		] );

		$this->add_responsive_control( 'epa_postsgrid_read_more_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}}  a.epa-read, a.epa-read-button' => 'border-radius:{{SIZE}}px;',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_main_pagination_styles', [
				'label'     => esc_html__( 'Pagination Styles', 'epa_elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'epa_postsgrid_pagination' => 'default',
				],
			] );


		$this->add_control( 'epa_postsgrid_pagination_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#686c6c',
			'selectors' => [
				'{{WRAPPER}} .epa-postsgrid-pagination-container li a' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_pagination_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f8f8f8',
			'selectors' => [
				'{{WRAPPER}} .epa-postsgrid-pagination-container li a' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_pagination_active_color', [
			'label'     => esc_html__( 'Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-postsgrid-pagination-container ul li .current' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_postsgrid_pagination_ative_bg_color', [
			'label'     => esc_html__( 'Active Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#85b83d',
			'selectors' => [
				'{{WRAPPER}} .epa-postsgrid-pagination-container ul li .current' => 'background-color: {{VALUE}};',
			],
		] );


		$this->add_responsive_control( 'epa_postsgrid_pagination_align', [
				'label'       => esc_html__( 'Align', 'epa_elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
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
				'default'     => 'center',
				'selectors'   => [
					'{{WRAPPER}} .epa-postsgrid-pagination-container' => 'text-align: {{VALUE}}!important',
				],
			] );


		$this->add_responsive_control( 'epa_postsgrid_pagination_padding', [
				'label'      => esc_html__( 'Padding', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => 3,
					'right'  => 11,
					'bottom' => 3,
					'left'   => 11,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .epa-postsgrid-pagination-container .page-numbers li a.page-numbers, .epa-postsgrid-pagination-container ul li .current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );


		$this->add_control( 'epa_postsgrid_pagination_spacing', [
				'label'     => esc_html__( 'Space Between Page Numbers', 'epa_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-postsgrid-pagination-container .page-numbers li, .epa-postsgrid-pagination-container ul li .current' => 'margin-left:{{SIZE}}px; margin-right:{{SIZE}}px;',
				],
			] );

		$this->add_control( 'epa_postsgrid_pagination_first_last_spacing', [
				'label'     => esc_html__( 'Space Label', 'epa_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'default'    => [
					'margin-left' => 15,
					'margin-right' => 15,
                ],
					'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-postsgrid-pagination-container ul li:first-child a.page-numbers' => 'margin-right:{{SIZE}}px;',

					'{{WRAPPER}} .epa-postsgrid-pagination-container ul li:last-child a.page-numbers' => 'margin-left:{{SIZE}}px;',
				],
			] );

		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_elementor_postsgrid_button_border',
			'selector' => '{{WRAPPER}} .epa-postsgrid-pagination-container .page-numbers li a.page-numbers, .epa-postsgrid-pagination-container ul li .current',
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'epa_elementor_postsgrid_button_box_shadow',
			'selector' => '{{WRAPPER}} .epa-postsgrid-pagination-container .page-numbers li a.page-numbers, .epa-postsgrid-pagination-container ul li .current',
		] );

		$this->add_control( 'epa_postsgrid_paginate_button_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'default'    => [
				'size' => 5,
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-postsgrid-pagination-container .page-numbers li a.page-numbers, .epa-postsgrid-pagination-container ul li .current' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$output      = '';
		$epaMetaData = '';
		global $post;


		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} else if ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}


		$post_per_page = $settings['epa_postsgrid_post_count'];
		$offset        = $settings['epa_postsgrid_offset_count'];
		$offset_new    = $offset + ( ( $paged - 1 ) * $post_per_page );

		// Author List
		$authorarr = $settings['epa_post_type_author']; // get custom field value
		if ( $authorarr >= 1 ) {
			$authorid = implode( ', ', $authorarr );
		} else {
			$authorid = '';
		}


		// Category List Exclude
		if ( ! empty( $settings['epa_post_type_categories'] ) ) {
			$catarray = $settings['epa_post_type_categories']; // get custom field value
			if ( $catarray >= 1 && $settings['epa_postsgrid_post_type_control'] == 'post' ) {
				$catids            = implode( ', ', $catarray );
				$catformatoperator = 'IN';

			} else {
				$catids            = '';
				$catformatoperator = 'NOT IN';
			}
		} else {
			$catids            = '';
			$catformatoperator = 'NOT IN';
		}

		// TAGS Exclude

		if ( ! empty( $settings['epa_post_type_tags'] ) ) {

			$tagarray = $settings['epa_post_type_tags']; // get custom field value
			if ( $tagarray >= 1 && $settings['epa_postsgrid_post_type_control'] == 'post' ) {
				$tagids            = implode( ', ', $tagarray );
				$tagidsexpand      = explode( ', ', $tagids );
				$tagformatoperator = 'IN';

			} else {
				$tagidsexpand      = '';
				$tagformatoperator = 'NOT IN';
			}
		} else {
			$tagidsexpand      = '';
			$tagformatoperator = 'NOT IN';
		}

		// Fotmats
		if ( ! empty( $settings['epa_post_type_post_formats'] ) ) {

			$formatarray = $settings['epa_post_type_post_formats']; // get custom field value
			if ( $formatarray >= 1 ) {
				$formatids       = implode( ', ', $formatarray );
				$formatidsexpand = explode( ', ', $formatids );
				$formatoperator  = 'IN';
			} else {
				$formatidsexpand = '';
				$formatoperator  = 'NOT IN';
			}

		} else {
			$formatidsexpand = '';
			$formatoperator  = 'NOT IN';
		}


		$post_exclude_array = $settings['epa_post_list_exclude']; // get custom field value
		if ( $post_exclude_array >= 1 && $settings['epa_postsgrid_post_type_control'] == 'post' ) {
			$post_exlude_id = $post_exclude_array;
		} else {
			$post_exlude_id = array();
		}

		$args       = array(
			'post_type'      => '' . $settings['epa_postsgrid_post_type_control'] . '',
			'posts_per_page' => $post_per_page,
			'paged'          => $paged,
			'post__not_in'   => $post_exlude_id,
			'offset'         => $offset_new,
			//'category' => 0,
			'orderby'        => '' . $settings['epa_postsgrid_order_by'] . '',
			'order'          => '' . $settings['epa_postsgrid_order_asc_desc'] . '',
			'post_status'    => 'publish',
			'author'         => $authorid,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'post_format',
						'field'    => 'id',
						'operator' => $formatoperator,
						'terms'    => $formatidsexpand,
					),
				),
				array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $catids,
						'operator' => $catformatoperator,
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tagidsexpand,
						'operator' => $tagformatoperator,
					),
				),
			)
			//'suppress_filters' => true
		);
		$post_query = new \WP_Query( $args );

		$MetaDataLocation = $settings['epa_postsgrid_meta_data_location'];
		?>
        <!--        <div class="epa-postgrid-container"> -->
		<?php

		while ( $post_query->have_posts() ) :
			$post_query->the_post();

			// Featured Image Calling
			$featured_image = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), '' . $settings['image_size'] . '' );
			$dummyImg       = 'http://vollrath.com/ClientCss/images/VollrathImages/No_Image_Available.jpg';

			$featured_image = ! empty( $featured_image ) ? $featured_image : $dummyImg;

			$featured_image = ( ! empty( $featured_image ) && ! empty( $settings['epa_postsgrid_image_display'] ) ) ? $featured_image : '';

			global $metaData;
			$metaData = $settings['epa_postsgrid_meta_data'];


			?>
            <div class="epa-postsgrid-wrapper">
            <div class="epa-bpost-item epa-main-postsgrid-column">

			<?php if ( $MetaDataLocation == 'top' ) : ?>
			<?php epa_post_meta_info(); ?>
		<?php endif; ?>

			<?php

			echo '<div class="epa-post-img">
                        <img src="' . $featured_image . '" alt="">';
			if ( $settings['epa_postsgrid_readmore_location'] == 'onimage' ) {
				echo '<div class="epa_readmore_wrapper">';
				echo '<a href="' . get_the_permalink() . '" class="epa-read">read more</a>';
				echo '</div>';
			}
			echo '</div>';

			?>

			<?php if ( $MetaDataLocation == 'middle' ) : ?>
			<?php epa_post_meta_info(); ?>
		<?php endif; ?>

			<?php
			echo '<div class="epa-post-content">
<!--                         <span class="post-author">
                             <a href="#"><img src="images/index.jpg" alt=""></a>
                         </span> -->
                      <h3 class="epa-post-title">
						<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>
                        </h3>';
			?>

			<?php if ( $MetaDataLocation == 'bottom' ) : ?>
			<?php epa_post_meta_info(); ?>
		<?php endif; ?>

			<?php
			if ( ! empty( $settings['epa_postsgrid_excerpt'] ) ) {
				echo '<p class="epa-post-description">';
				echo epa_postsQuery_excerpt( $settings['epa_postsgrid_excerpt_count'] );
				echo '</p>';
			}
			if ( $settings['epa_postsgrid_readmore_location'] == 'bottom' ) {
				echo '<div class="epa_readmore_wrapper">';
				echo '<a href="' . get_the_permalink() . '" class="epa-read-button">read more</a>';
				echo '</div>';
			}
			echo '</div></div></div>';

			//echo $output;
		endwhile;
		?>

        <!--   </div>  END MAIN CONTAINER WRAPPER -->

		<?php
		if ( $settings['epa_postsgrid_pagination'] == 'default' ) : ?>
            <div class="epa-postsgrid-pagination-container">
				<?php
				$page_tot = ceil( ( $post_query->found_posts - $offset ) / $post_per_page );

				if ( $page_tot > 1 ) {
					$big = 999999999;
					echo paginate_links( array(
						'base'      => str_replace( $big, '%#%', get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
						'format'    => '?paged=%#%',
						'current'   => max( 1, $paged ),
						'total'     => ceil( ( $post_query->found_posts - $offset ) / $post_per_page ),
						'prev_next' => true,
						'prev_text' => esc_attr( $settings['epa_postsgrid_pagination_prev'] ),
						'next_text' => esc_attr( $settings['epa_postsgrid_pagination_next'] ),
						'end_size'  => 1,
						'mid_size'  => 2,
						'type'      => 'list',
					) );
				}
				?>
            </div>
		<?php endif; ?>

		<?php if ( $settings['epa_postsgrid_pagination'] == 'load-more' ) : ?>
            <!--
					<div class="epa-pagination-loadmore-container">
						<button class="loadmore">Load More...</button>
					</div>-->

		<?php endif; ?>

		<?php
		wp_reset_postdata();

	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_postgrid() );