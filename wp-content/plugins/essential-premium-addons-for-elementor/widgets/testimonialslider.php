<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_testimonialslider extends Widget_Base {

	public function get_name() {
		return 'epa_testimonialslider';
	}

	public function get_title() {
		return __( 'Testimonial Slider', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-comments wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {


		$this->start_controls_section( 'epa_section_testimonial_content', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_testimonial_slider_item', [
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'eael_testimonial_name' => 'John Doe',
				],

			],
			'fields'      => [
				[
					'name'    => 'epa_testimonial_image',
					'label'   => esc_html__( 'Author', 'epa_elementor' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],

				[
					'name'    => 'epa_testimonial_name',
					'label'   => esc_html__( 'User Name', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Jonathon', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],

				[
					'name'    => 'epa_testimonial_company_title',
					'label'   => esc_html__( 'Company Name', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Web Developer', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],
				[
					'name'    => 'epa_testimonial_description',
					'label'   => esc_html__( 'Testimonial Description', 'epa_elementor' ),
					'type'    => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Add testimonial description here. Edit and place your own text.', 'epa_elementor' ),
				],

				[
					'name'    => 'epa_testimonial_enable_rating',
					'label'   => esc_html__( 'Display Rating?', 'epa_elementor' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				],

				[
					'name'      => 'epa_testimonial_rating_number',
					'label'     => __( 'Rating Number', 'your-plugin' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '5',
					'options'   => [
						'1' => __( '1', 'epa_elementor' ),
						'2' => __( '2', 'epa_elementor' ),
						'3' => __( '3', 'epa_elementor' ),
						'4' => __( '4', 'epa_elementor' ),
						'5' => __( '5', 'epa_elementor' ),
					],
					'condition' => [
						'epa_testimonial_enable_rating' => 'yes',
					],
				],


			],
			'title_field' => 'Testimonial Item',
		] );
		$this->end_controls_section();

		/**
		 * Testimonial : Settings
		 */
		$this->start_controls_section( 'epa_section_testimonialadditional_options', [
			'label' => __( 'Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'show_hide_dots', [
			'label'        => __( 'Show Hide Dots?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'visiable_items', [
			'label'       => __( 'Visiable Items', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => 1,
			'max'         => 10,
			'step'        => 1,
			'description' => __( 'Set How many Item Visiable in Testimonial Slider, Default is 1)', 'epa_elementor' ),
			'default'     => 1,
		] );

/*		$this->add_control( 'animation_in', [
				'label'        => __( 'Animation In', 'epa_elementor' ),
				'type'         => Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
			] );

		$this->add_control( 'animation_out', [
				'label'        => __( 'Animation Out', 'epa_elementor' ),
				'type'         => Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
			] );*/


		$this->add_control( 'autoplay_speed', [
				'label'       => __( 'Autoplay Duration', 'epa_elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1000,
				'max'         => 10000,
				'step'        => 100,
				'description' => __( 'Duration of Autoplay (in ms)', 'epa_elementor' ),
				'default'     => 4000,
			] );
		$this->add_control( 'slide_speed', [
				'label'       => __( 'Slider Speed', 'epa_elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 200,
				'max'         => 5000,
				'step'        => 100,
				'description' => __( 'Duration of Slide Speed, Default is 800 (in ms)', 'epa_elementor' ),
				'default'     => 800,
			] );

		$this->add_control( 'autoplay', [
			'label'        => __( 'Autoplay', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',

		] );

		$this->add_control( 'pause_on_hover', [
			'label'        => __( 'Pause On Hover', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
			'condition'    => [
				'autoplay' => 'yes',
			],
		] );

		$this->add_control( 'infinite_loop', [
			'label'        => __( 'Infinite Loop', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
			'condition'    => [
				'autoplay' => 'yes',
			],
		] );
/*
		$this->add_control( 'epa_testimonial_left_quotes', [
			'label'        => __( 'Display Left Quotes?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',

		] );
		$this->add_control( 'epa_testimonial_right_quotes', [
			'label'        => __( 'Display Right Quotes?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );*/

		$this->end_controls_section();


		/*Image Styling*/
		$this->start_controls_section( 'epa_testimonial_image_style', [
				'label' => __( 'Image', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		/*Image Size*/
		$this->add_control( 'epa_testimonial_img_size', [
				'label'      => __( 'Size', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'unit' => 'px',
					'size' => 110,
				],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .epa-testimonial .pic' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			] );

		/*Image Border Width*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_slider_image_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-testimonial .pic',
		] );

		$this->add_control( 'epa_testimonial_slider_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial .pic' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->end_controls_section();

		/*Start Person Settings Section*/
		$this->start_controls_section( 'epa_testimonials_person_style', [
				'label' => __( 'Author', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		/*Person Name Color*/
		$this->add_control( 'epa_testimonial_person_name_color', [
				'label'     => __( 'Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .epa-testimonial .testimonial-title' => 'color: {{VALUE}};',
				],
			] );

		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'author_name_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .epa-testimonial .testimonial-title',
			] );

		/*Separator Color*/
		$this->add_control( 'epa_testimonial_separator_color', [
				'label'     => __( 'Divider Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .epa-testimonial .post::before' => 'border-color: {{VALUE}};',
				],
			] );

		$this->end_controls_section();

		/*Start Company Settings Section*/
		$this->start_controls_section( 'epa_testimonial_company_style', [
				'label' => __( 'Company', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		/*Company Name Color*/
		$this->add_control( 'epa_testimonial_company_name_color', [
				'label'     => __( 'Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .epa-testimonial .post' => 'color: {{VALUE}};',
				],
			] );

		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'company_name_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .epa-testimonial .post',
			] );

		/*End Color Section*/
		$this->end_controls_section();

		/*Start Content Settings Section*/
		$this->start_controls_section( 'epa_testimonial_content_style', [
				'label' => __( 'Content', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		/*Content Color*/
		$this->add_control( 'epa_testimonial_content_color', [
				'label'     => __( 'Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .epa-testimonial p' => 'color: {{VALUE}};',
				],
			] );

		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'content_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .epa-testimonial p',
			] );


		/*Testimonial Text Margin*/
		$this->add_responsive_control( 'epa_testimonial_margin', [
				'label'      => __( 'Margin', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => 15,
					'bottom' => 15,
					'left'   => 0,
					'right'  => 0,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .epa-testimonial .description' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				],
			] );

		/*End Content Settings Section*/
		$this->end_controls_section();

		/*Start Quotes Style Section*/
		$this->start_controls_section( 'epa_testimonial_quotes', [
				'label' => __( 'Quotation Icon', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		/*Quotes Color*/
		$this->add_control( 'epa_testimonial_quote_icon_color', [
				'label'     => __( 'Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .epa-testimonial::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-title:before' => 'color: {{VALUE}};',
				],
			] );

		/*Quotes Size*/
		$this->add_control( 'epa_testimonial_quotes_size', [
				'label'      => __( 'Size', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'unit' => 'px',
					'size' => 60,
				],
				'range'      => [
					'px' => [
						'min' => 5,
						'max' => 250,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .epa-testimonial::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-title:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			] );

		/*Upper Quote Position*/
		$this->add_responsive_control( 'epa_testimonial_left_quote_position', [
				'label'      => __( 'Left Quote Position', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'  => 0,
					'left' => 0,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .epa-testimonial::before' => 'top: {{TOP}}{{UNIT}};  left:{{LEFT}}{{UNIT}};',
				],
			] );
		/*Upper Quote Position*/
		$this->add_responsive_control( 'epa_testimonial_right_quote_position', [
				'label'      => __( 'Right Quote Position', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'  => 0,
					'left' => 0,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-title::before' => 'top: {{TOP}}{{UNIT}};  right:{{LEFT}}{{UNIT}};',
				],
			] );

		/*End Typography Section*/
		$this->end_controls_section();

		/*Start Dots Style Section*/
		$this->start_controls_section( 'epa_testimonial_dots', [
			'label' => __( 'Dots', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_hide_dots' => 'yes',
			],
		] );

		$this->add_control( 'epa_testimonial_dot_color', [
			'label'     => __( 'Dot Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ddd',
			'selectors' => [
				'{{WRAPPER}} .epaowlDot' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_testimonial_dot_hover_color', [
			'label'     => __( 'Dot Hover Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ddd',
			'selectors' => [
				'{{WRAPPER}} .epaowlDot:hover' => 'background-color: {{VALUE}};',
			],
		] );

		/*Dot Color*/
		$this->add_control( 'epa_testimonial_dot_active_color', [
			'label'     => __( 'Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#141414',
			'selectors' => [
				'{{WRAPPER}} .epaowlDot.active' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_dot_height', [
			'label'     => __( 'Dot Height', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epaowlDot' => 'height: {{SIZE}}px;',
				'{{WRAPPER}} .epaowlDot.active' => 'height: {{SIZE}}px;',
			],
		] );
		$this->add_responsive_control( 'epa_dot_width', [
			'label'     => __( 'Dot Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 20,
			],
			'range'     => [
				'px' => [
					'min'  => 1,
					'max'  => 150,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epaowlDot' => 'width: {{SIZE}}px;',
				'{{WRAPPER}} .epaowlDot.active' => 'width: {{SIZE}}px;',
			],
		] );

		$this->add_control(
			'dot_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'left' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'center' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'right' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],

				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .epaowlDots' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => 'epa_dot_border',
			'label'     => esc_html__( 'Border', 'epa_elementor' ),
			'selector'  => '{{WRAPPER}} .epaowlDot, .epaowlDot.active',
		] );
		$this->add_control( 'epa_testimonial_dots_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epaowlDot, .epaowlDot.active' => 'border-radius: {{SIZE}}px;',
			],
		] );


		$this->add_responsive_control( 'epa_testimonialslider_dots_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epaowlDot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		/*End Typography Section*/
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$i        = uniqid(); // Testimonial Slider Unique ID

		$autoplay       = $settings['autoplay'] == 'yes' ? 'true' : 'false';
		$pause_on_hover = $settings['pause_on_hover'] == 'yes' ? 'true' : 'false';
		$infinite_loop  = $settings['infinite_loop'] == 'yes' ? 'true' : 'false';


		$show_hide_dots  = $settings['show_hide_dots'] == 'yes' ? 'true' : 'false';


		//$left_quotes  = $settings['epa_testimonial_left_quotes'] == 'yes' ? 'yes' : 'no';
		//$right_quotes  = $settings['epa_testimonial_right_quotes'] == 'yes' ? 'yes' : 'no';

		$animateIn = !empty($settings['animation_in']) ? $settings['animation_in'] : 'slideInLeft';

		$output = '<div id="testimonial-slider' . $i . '" class="owl-carousel owl-theme">';

		foreach ( $settings['epa_testimonial_slider_item'] as $item ) {
			$output .= '<div class="epa-testimonial">
                        <div class="pic">
                            <img src="' . $item['epa_testimonial_image']['url'] . '" alt="">
                        </div>
                        <p class="description">
                            ' . $item['epa_testimonial_description'] . '
                        </p>
                        <h3 class="testimonial-title">' . $item['epa_testimonial_name'] . ' <span class="post">' . $item['epa_testimonial_company_title'] . '</span></h3>';


			if ( $item['epa_testimonial_enable_rating'] == "yes" ) {

				$output .= '<ul class="testimonial-rating">';

				$testi_nonerating = 5 - $item['epa_testimonial_rating_number']; // None Rating

				for ( $x = 1; $x <= $item['epa_testimonial_rating_number']; $x ++ ) {
					$output .= '  <li class="fa fa-star" id="testi_star"></li>';
				}

				for ( $x = 1; $x <= $testi_nonerating; $x ++ ) {
					$output .= ' <li class="fa fa-star" id="testi_nonestar"></li>';
				}

				$output .= ' </ul>';
			}

			$output .= '</div>';
		}


		$output .= '</div>';

		$output .= '
		 <script type="text/javascript">
    jQuery("#testimonial-slider' . $i . '").owlCarousel({
    
    				items:'.$settings['visiable_items'].',
			        autoplay:' . $autoplay . ',
			        loop:' . $infinite_loop . ',
			     	autoplayTimeout:' . $settings['autoplay_speed'] . ',
			    	autoplayHoverPause:' . $pause_on_hover . ',
			    	dotClass: "epaowlDot",
			    	dotsClass: "epaowlDots",
			    	dots: '.$show_hide_dots.',
			    	smartSpeed: '.$settings['slide_speed'].'
    });
</script>';


		echo $output;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_testimonialslider() );