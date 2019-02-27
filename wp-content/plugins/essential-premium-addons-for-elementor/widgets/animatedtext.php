<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_animatedtext extends Widget_Base {

	public function get_name() {
		return 'wfe-animatedtext';
	}

	public function get_title() {
		return __( 'Animted Text', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-animated-headline wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// START REGESTER CONTROL
	protected function _register_controls() {


		$this->start_controls_section( 'epa_animaed_text_section', [
			'label' => esc_html__( 'Animated Text', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_animated_before_text', [
			'label'       => __( 'Before Text', 'epa_elementor' ),
			'placeholder' => esc_html__( 'Write Before Text Here..', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'We can bring', 'epa_elementor' ),
		] );

		$repeater = new REPEATER();
		$repeater->add_control( 'epa_animated_text_animate_repeater_text_field', [
			'label'       => esc_html__( 'Text', 'wfe_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );
		$this->add_control( 'epa_animated_text_animate_repeater', [
			'label'   => esc_html__( 'Animated Text', 'wfe_elementor' ),
			'type'    => Controls_Manager::REPEATER,
			'default' => [
				[
					'epa_animated_text_animate_repeater_text_field' => esc_html__( 'Success', 'epa_elementor' ),
				],
				[
					'epa_animated_text_animate_repeater_text_field' => esc_html__( 'Growth', 'epa_elementor' ),
				],
				[
					'epa_animated_text_animate_repeater_text_field' => esc_html__( 'Profits', 'epa_elementor' ),
				],
			],
			'fields'  => array_values( $repeater->get_controls() ),
		] );


		$this->add_control( 'epa_animated_text_ending_text', [
			'label'       => __( 'After Text', 'epa_elementor' ),
			'placeholder' => esc_html__( 'Write After Text Here..', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'to your business', 'epa_elementor' ),
		] );


		$this->end_controls_section();


		$this->start_controls_section( 'epa_animated_text_settings_section', [
			'label' => esc_html__( 'Animated Text Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_animated_text_animation_type', [
			'label'   => esc_html__( 'Animated Text Style', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'typing',
			'options' => [
				'typing'      => esc_html__( 'Typing', 'epa_elementor' ),
				'morphext'      => esc_html__( 'Morphext', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'epa_animated_text_animation', [
			'label'   => esc_html__( 'Animation', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'fadeIn',
			'options' => [
				'fadeIn'      => esc_html__( 'Fade', 'epa_elementor' ),
				'fadeInUp'    => esc_html__( 'Fade Up', 'epa_elementor' ),
				'fadeInDown'  => esc_html__( 'Fade Down', 'epa_elementor' ),
				'fadeInLeft'  => esc_html__( 'Fade Left', 'epa_elementor' ),
				'fadeInRight' => esc_html__( 'Fade Right', 'epa_elementor' ),
				'zoomIn'      => esc_html__( 'Zoom', 'epa_elementor' ),
				'bounceIn'    => esc_html__( 'BounceIn', 'epa_elementor' ),
				'swing'       => esc_html__( 'Swing', 'epa_elementor' ),
				'bounce'       => esc_html__( 'Bounce', 'epa_elementor' ),
				'flash'       => esc_html__( 'Flash', 'epa_elementor' ),
				'pulse'       => esc_html__( 'Pulse', 'epa_elementor' ),
				'rubberBand'       => esc_html__( 'RubberBand', 'epa_elementor' ),
				'shake'       => esc_html__( 'Shake', 'epa_elementor' ),
				'tada'       => esc_html__( 'Tada', 'epa_elementor' ),
				'jello' => esc_html__( 'Jello', 'epa_elementor' ),
				'rollIn' => esc_html__( 'RollIn', 'epa_elementor' ),
			],
			'condition' => [
				'epa_animated_text_animation_type' => array('morphext', 'textillate'),
			],
		] );


		$this->add_control( 'epa_animated_text_delay', [
			'label'   => esc_html__( 'Delay on Change', 'epa_elementor' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => '2500',
		] );

		$this->add_control( 'epa_animated_text_speed', [
			'label'     => esc_html__( 'Typing Speed', 'epa_elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => '50',
			'condition' => [
				'epa_animated_text_animation_type' => 'typing',
			],
		] );


		$this->add_control( 'epa_animated_text_loop', [
			'label'     => esc_html__( 'Loop the Typing', 'epa_elementor' ),
			'type'      => Controls_Manager::SWITCHER,
			'default'   => 'yes',
			'condition' => [
				'epa_animated_text_animation_type' => 'typing',
			],
		] );

		$this->add_control( 'epa_animated_text_cursor', [
			'label'     => esc_html__( 'Display Type Cursor', 'epa_elementor' ),
			'type'      => Controls_Manager::SWITCHER,
			'default'   => 'yes',
			'condition' => [
				'epa_animated_text_animation_type' => 'typing',
			],
		] );

		$this->add_responsive_control( 'epa_animated_text_alignment', [
			'label'       => esc_html__( 'Content Align', 'epa_elementor' ),
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
				'{{WRAPPER}} .epa_elementor-animated-typing-container' => 'text-align: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_before_text_style', [
			'label' => esc_html__( 'Before Text', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .epa_animated_before_text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa_animated_before_text',
		] );


		$this->end_controls_section();


		$this->start_controls_section( 'epa_animated_text_style_section', [
			'label' => esc_html__( 'Animated Text', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'animated_text_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .epa-animated-repeater-field' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_repeater_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-animated-repeater-field, {{WRAPPER}} .typed-cursor',
		] );

		$this->add_control( 'epa_repeater_title_background_color', [
			'label'     => esc_html__( 'Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-animated-repeater-field' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_repeater_title_color_cursor_color', [
			'label'     => esc_html__( 'Type Cusor Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .typed-cursor' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_animated_text_cursor' => 'yes',
			],
		] );

		$this->add_responsive_control( 'epa_repeater_title_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-animated-repeater-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_repeater_title_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-animated-repeater-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'repeat_title_border_main',
			'selector' => '{{WRAPPER}} .epa-animated-repeater-field',
		] );


		$this->add_control( 'epa_repeat_title_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-animated-repeater-field' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();


		$this->start_controls_section( 'epa_after_animated_text_setion', [
			'label' => esc_html__( 'After Text', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_after_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .epa-animated-after-text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_ending_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-animated-after-text',
		] );


		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings();

		$atid = uniqid();

		$output = '<div class="epa_elementor-animated-typing-container">';

		if ( ! empty( $settings['epa_animated_before_text'] ) ) {
			$output .= '<span class="epa_animated_before_text">';
			$output .= '<span>' . $settings['epa_animated_before_text'] . '</span> ';
			$output .= '</span>';
		}

		if ( $settings['epa_animated_text_animation_type'] == 'typing' ) {
			$output .= '<span id="animated-text-' . $atid . '" class="epa-animated-repeater-field"></span>';
		}
		if ( $settings['epa_animated_text_animation_type'] == 'morphext' ) {
			$output  .= '<span id="animated-text-' . $atid . '" class="epa-animated-repeater-field">';
			$animateText = "";
			foreach ( $settings['epa_animated_text_animate_repeater'] as $item ) {
				$animateText .= $item['epa_animated_text_animate_repeater_text_field'] . ', ';
			}
			$output .= '' . rtrim( $animateText, ", " ) . '';
			$output .= '</span>';
		}
		if ( ( ! empty( $settings['epa_animated_text_ending_text'] ) ) ) {
			$output .= '<span class="epa-animated-after-text"> ' . $settings['epa_animated_text_ending_text'] . '</span>';
		}
		$output .= '</div>';


		if ( $settings['epa_animated_text_animation_type'] == 'typing' ) : ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    'use strict';
                    $("#animated-text-<?php echo esc_attr( $atid ); ?>").typed({
                        strings: [<?php foreach ( $settings['epa_animated_text_animate_repeater'] as $item ) : ?><?php if ( ! empty( $item['epa_animated_text_animate_repeater_text_field'] ) ) : ?>"<?php echo wp_kses( __( $item['epa_animated_text_animate_repeater_text_field'] ), true ); ?>",<?php endif; ?><?php endforeach; ?>],
                        typeSpeed: <?php echo esc_attr( $settings['epa_animated_text_speed'] ); ?>,
                        backSpeed: 0,
                        startDelay: 300,
                        backDelay: <?php echo esc_attr( $settings['epa_animated_text_delay'] ); ?>,
                        showCursor: <?php if ( ! empty( $settings['epa_animated_text_cursor'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
                        loop: <?php if ( ! empty( $settings['epa_animated_text_loop'] ) ) : ?>true<?php else: ?>false<?php endif; ?>,
                    });
                });
            </script>
		<?php endif; ?>

		<?php if ( $settings['epa_animated_text_animation_type'] == 'morphext' ) : ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    'use strict';
                    $("#animated-text-<?php echo esc_attr( $atid ); ?>").Morphext({
                        animation: "<?php echo esc_attr( $settings['epa_animated_text_animation'] ); ?>",
                        separator: ",",
                        speed: <?php echo esc_attr( $settings['epa_animated_text_delay'] ); ?>,
                        complete: function () {
                            // Overrides default empty function
                        }
                    });
                });
            </script>
		<?php endif; ?>
		<?php

		echo $output;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_animatedtext() );