<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_ultimatebutton extends Widget_Base {

	public function get_name() {
		return 'wfe-ultimatebutton';
	}

	public function get_title() {
		return __( 'Ultimate Button', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-bold wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		// Content Controls
		$this->start_controls_section(
			'wfe_section_ultimate_button_content',
			[
				'label' => esc_html__( 'Button Content', 'wfe_elementor' )
			]
		);


		$this->add_control(
			'ultimate_button_text',
			[
				'label' => __( 'Button Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Click Me!',
				'placeholder' => __( 'Enter button text', 'wfe_elementor' ),
				'title' => __( 'Enter button text here', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'ultimate_button_secondary_text',
			[
				'label' => __( 'Button Secondary Text', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Go!',
				'placeholder' => __( 'Enter button secondary text', 'wfe_elementor' ),
				'title' => __( 'Enter button secondary text here', 'wfe_elementor' ),
			]
		);


		$this->add_control(
			'ultimate_button_link_url',
			[
				'label' => __( 'Link URL', 'wfe_elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'placeholder' => __( 'Enter link URL for the button', 'wfe_elementor' ),
				'title' => __( 'Enter heading for the button', 'wfe_elementor' ),
			]
		);

		$this->add_control(
			'ultimate_button_link_target',
			[
				'label' => esc_html__( 'Open in new window?', 'wfe_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( '_blank', 'wfe_elementor' ),
				'label_off' => __( '_self', 'wfe_elementor' ),
				'default' => '_self',
			]
		);

		$this->add_responsive_control(
			'wfe_ultimate_button_alignment',
			[
				'label' => esc_html__( 'Button Alignment', 'wfe_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wfe_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wfe_elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wfe_elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'wfe_elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'prefix_class' => 'wfe-ultimate-button-align-',
			]
		);

		$this->add_control(
			'wfe_ultimate_button_icon',
			[
				'label' => esc_html__( 'Icon', 'wfe_elementor' ),
				'type' => Controls_Manager::ICON,
			]
		);

		$this->add_control(
			'wfe_ultimate_button_icon_alignment',
			[
				'label' => esc_html__( 'Icon Position', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'wfe_elementor' ),
					'right' => esc_html__( 'After', 'wfe_elementor' ),
				],
				'condition' => [
					'wfe_ultimate_button_icon!' => '',
				],
			]
		);


		$this->add_control(
			'wfe_ultimate_button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'wfe_ultimate_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-ultimate-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .wfe-ultimate-button-icon-left' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .wfe-ultimate-button--shikoba i' => 'left: -{{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();



		// Style Controls
		$this->start_controls_section(
			'wfe_section_ultimate_button_settings',
			[
				'label' => esc_html__( 'Button Effects &amp; Styles', 'wfe_elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ultimate_button_effect',
			[
				'label' => esc_html__( 'Set Button Effect', 'wfe_elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'wfe-ultimate-button--default',
				'options' => [
					'wfe-ultimate-button--default' 	=> esc_html__( 'Default', 	'wfe_elementor' ),
					'wfe-ultimate-button--winona' 		=> esc_html__( 'Winona', 	'wfe_elementor' ),
					'wfe-ultimate-button--ujarak' 		=> esc_html__( 'Ujarak', 	'wfe_elementor' ),
					'wfe-ultimate-button--wayra' 		=> esc_html__( 'Wayra', 	'wfe_elementor' ),
					'wfe-ultimate-button--tamaya' 		=> esc_html__( 'Tamaya', 	'wfe_elementor' ),
					'wfe-ultimate-button--rayen' 		=> esc_html__( 'Rayen', 	'wfe_elementor' ),
					'wfe-ultimate-button--pipaluk' 	=> esc_html__( 'Pipaluk', 	'wfe_elementor' ),
					'wfe-ultimate-button--moema' 		=> esc_html__( 'Moema', 	'wfe_elementor' ),
					'wfe-ultimate-button--wave' 		=> esc_html__( 'Wave', 		'wfe_elementor' ),
					'wfe-ultimate-button--aylen' 		=> esc_html__( 'Aylen', 	'wfe_elementor' ),
					'wfe-ultimate-button--saqui' 		=> esc_html__( 'Saqui', 	'wfe_elementor' ),
					'wfe-ultimate-button--wapasha' 	=> esc_html__( 'Wapasha', 	'wfe_elementor' ),
					'wfe-ultimate-button--nuka' 		=> esc_html__( 'Nuka', 		'wfe_elementor' ),
					'wfe-ultimate-button--antiman' 	=> esc_html__( 'Antiman', 	'wfe_elementor' ),
					'wfe-ultimate-button--quidel' 		=> esc_html__( 'Quidel', 	'wfe_elementor' ),
					'wfe-ultimate-button--shikoba' 	=> esc_html__( 'Shikoba', 	'wfe_elementor' ),
				],
			]
		);



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wfe_ultimate_button_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wfe-ultimate-button',
			]
		);

		$this->add_responsive_control(
			'wfe_ultimate_button_padding',
			[
				'label' => esc_html__( 'Button Padding', 'wfe_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
			]
		);



		$this->start_controls_tabs( 'wfe_ultimate_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_ultimate_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);



		$this->add_control(
			'wfe_ultimate_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wfe_ultimate_button_border',
				'selector' => '{{WRAPPER}} .wfe-ultimate-button',
			]
		);

		$this->add_control(
			'wfe_ultimate_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wfe_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wfe-ultimate-button' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .wfe-ultimate-button::before' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .wfe-ultimate-button::after' => 'border-radius: {{SIZE}}px;',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab( 'wfe_ultimate_button_hover', [ 'label' => esc_html__( 'Hover', 'wfe_elementor' ) ] );

		$this->add_control(
			'wfe_ultimate_button_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$this->add_control(
			'wfe_ultimate_button_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f54',
			]
		);

		$this->add_control(
			'wfe_ultimate_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'wfe_elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wfe-ultimate-button:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-ultimate-button.wfe-ultimate-button--wapasha::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-ultimate-button.wfe-ultimate-button--antiman::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-ultimate-button.wfe-ultimate-button--pipaluk::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wfe-ultimate-button.wfe-ultimate-button--quidel::before'  => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .wfe-ultimate-button',
			]
		);


		$this->end_controls_section();


		$this->end_controls_section();


	}


	protected function render( ) {


		$settings = $this->get_settings();
		$ultimate_button_image = $this->get_settings( 'ultimate_button_image' );
		$button_padding = $this->get_settings( 'wfe_ultimate_button_padding' );

		?>


        <a id="wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>" class="wfe-ultimate-button <?php echo esc_attr($settings['ultimate_button_effect'] ); ?>"
           href="<?php echo esc_attr($settings['ultimate_button_link_url'] ); ?>" target="<?php echo esc_attr($settings['ultimate_button_link_target'] ); ?>" data-text="<?php echo esc_attr($settings['ultimate_button_secondary_text'] ); ?>">
	<span>
		<?php if ( ! empty( $settings['wfe_ultimate_button_icon'] ) && $settings['wfe_ultimate_button_icon_alignment'] == 'left' ) : ?>
            <i class="<?php echo esc_attr($settings['wfe_ultimate_button_icon'] ); ?> wfe-ultimate-button-icon-left" aria-hidden="true"></i>
		<?php endif; ?>

		<?php echo  $settings['ultimate_button_text'];?>

		<?php if ( ! empty( $settings['wfe_ultimate_button_icon'] ) && $settings['wfe_ultimate_button_icon_alignment'] == 'right' ) : ?>
            <i class="<?php echo esc_attr($settings['wfe_ultimate_button_icon'] ); ?> wfe-ultimate-button-icon-right" aria-hidden="true"></i>
		<?php endif; ?>
	</span>
        </a>

        <style type="text/css">

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?> {
                color: <?php echo esc_attr($settings['wfe_ultimate_button_text_color'] ); ?>;
                padding: <?php echo $button_padding['top'] . $button_padding['unit'] .' '.  $button_padding['right'] . $button_padding['unit'] .' '.  $button_padding['bottom'] . $button_padding['unit'] .' '.  $button_padding['left'] . $button_padding['unit'] ?>;
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>:hover {
                color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_text_color'] ); ?>;
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }


            <?php if ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--winona' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--winona::after,
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--winona > span {
                padding: <?php echo $button_padding['top'] . $button_padding['unit'] .' '.  $button_padding['right'] . $button_padding['unit'] .' '.  $button_padding['bottom'] . $button_padding['unit'] .' '.  $button_padding['left'] . $button_padding['unit'] ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--winona::after {
                color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_text_color'] ); ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--ujarak' ): ?>


            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--ujarak:hover {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--ujarak::before {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--wayra' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--wayra:hover {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--wayra:hover::before {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--tamaya' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--tamaya::before,
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--tamaya::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
                color: <?php echo esc_attr($settings['wfe_ultimate_button_text_color'] ); ?>;
            }

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--tamaya:hover {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--tamaya::before {
                padding: <?php echo $button_padding['top'] . $button_padding['unit'] .' '.  $button_padding['right'] . $button_padding['unit'] .' '.  $button_padding['bottom'] . $button_padding['unit'] .' '.  $button_padding['left'] . $button_padding['unit'] ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--rayen' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--rayen:hover {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--rayen::before {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--rayen::before,
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--rayen > span {
                padding: <?php echo $button_padding['top'] . $button_padding['unit'] .' '.  $button_padding['right'] . $button_padding['unit'] .' '.  $button_padding['bottom'] . $button_padding['unit'] .' '.  $button_padding['left'] . $button_padding['unit'] ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--pipaluk' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--pipaluk::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--wave' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--wave:hover {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--wave::before,
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--wave:hover::before {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }


            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--aylen' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--aylen::before {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--aylen::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }

            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--saqui' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--saqui:hover {
                color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--saqui::after {
                color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_text_color'] ); ?>;
                padding: <?php echo $button_padding['top'] . $button_padding['unit'] .' '.  $button_padding['right'] . $button_padding['unit'] .' '.  $button_padding['bottom'] . $button_padding['unit'] .' '.  $button_padding['left'] . $button_padding['unit'] ?>;
            }


            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--nuka' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--nuka::before,
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--nuka::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--nuka:hover::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }


            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--antiman' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--antiman::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }


            <?php elseif ( $settings['ultimate_button_effect'] == 'wfe-ultimate-button--quidel' ): ?>

            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--quidel::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_background_color'] ); ?>;
            }
            a#wfe-ultimate-button-<?php echo esc_attr($this->get_id()); ?>.wfe-ultimate-button--quidel:hover::after {
                background-color: <?php echo esc_attr($settings['wfe_ultimate_button_hover_background_color'] ); ?>;
            }

            <?php else: ?>


            <?php endif; ?>

        </style>


		<?php

	}

	protected function content_template() {

		?>


		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_ultimatebutton() );