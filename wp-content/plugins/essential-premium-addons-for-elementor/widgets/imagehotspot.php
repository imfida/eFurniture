<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_hotspot extends Widget_Base {

	public function get_name() {
		return 'wfe_image_hotspot';
	}

	/**
	 * Retrieve image hotspots widget title.
	 */
	public function get_title() {
		return __( 'Image Hotspots', 'epa_elementor' );
	}

	/**
	 * Retrieve the list of categories the image hotspots widget belongs to.
	 */

	/**
	 * Retrieve image hotspots widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-hotspot';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	/**
	 * Register image hotspots widget controls.
	 */
	protected function _register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*	CONTENT TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Content Tab: Image
		 */
		$this->start_controls_section( 'epa_hotspot_image_section', [
			'label' => __( 'Hotspot Image', 'epa_elementor' ),
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Image', 'epa_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'    => 'image',
			'label'   => __( 'Image Size', 'epa_elementor' ),
			'default' => 'full',
		] );

		$this->end_controls_section();

		/**
		 * Content Tab: Hotspots
		 */
		$this->start_controls_section( 'epa_hotspots_section', [
			'label' => __( 'Hotspots Point', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_hotspot_pulse_effects', [
			'label'   => __( 'Radar Animation', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'hotspot_ring',
			'options' => [
				'hotspot-animation' => __( 'Normal', 'epa_elementor' ),
				'sq'                => __( 'SQ', 'epa_elementor' ),
				'hotspot_ring'      => __( 'Ring', 'epa_elementor' ),
				'sonar'             => __( 'Sonar', 'epa_elementor' ),
				'slack'             => __( 'Slack', 'epa_elementor' ),
			],
		] );


		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'epa_hotspots_tabs' );

		$repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'epa_elementor' ) ] );

		$repeater->add_control( 'epa_hotspot_type', [
			'label'   => __( 'Type', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'icon',
			'options' => [
				'icon' => __( 'Icon', 'epa_elementor' ),
			],
		] );

		$repeater->add_control( 'epa_hotspot_icon', [
			'label'     => __( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-dot-circle-o',
			'condition' => [
				'epa_hotspot_type' => 'icon',
			],
		] );

		$repeater->add_control( 'epa_hotspot_text', [
			'label'       => __( 'Text', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => '#',
			'condition'   => [
				'epa_hotspot_type' => 'text',
			],
		] );

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', [ 'label' => __( 'Position', 'epa_elementor' ) ] );

		$repeater->add_control( 'epa_left_position', [
			'label'      => esc_html__( 'Horizontal Position', 'ela_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
				'em' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'default'    => [
				'size' => 50,
				'unit' => '%',
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}}',
			],
		] );

		$repeater->add_control( 'epa_top_position', [
			'label'      => esc_html__( 'Vertical Position', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
				'em' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'default'    => [
				'size' => 50,
				'unit' => '%',
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}',
			],
		] );

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'epa_tab_tooltip', [ 'label' => __( 'Tooltip', 'epa_elementor' ) ] );

		$repeater->add_control( 'tooltip', [
			'label'        => __( 'Tooltip', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => __( 'Show', 'epa_elementor' ),
			'label_off'    => __( 'Hide', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$repeater->add_control( 'epa_tooltip_position_local', [
			'label'     => __( 'Tooltip Position', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'global',
			'options'   => [
				'global'       => __( 'Global', 'epa_elementor' ),
				'top'          => __( 'Top', 'epa_elementor' ),
				'bottom'       => __( 'Bottom', 'epa_elementor' ),
				'left'         => __( 'Left', 'epa_elementor' ),
				'right'        => __( 'Right', 'epa_elementor' ),
				'top-left'     => __( 'Top Left', 'epa_elementor' ),
				'top-right'    => __( 'Top Right', 'epa_elementor' ),
				'bottom-left'  => __( 'Bottom Left', 'epa_elementor' ),
				'bottom-right' => __( 'Bottom Right', 'epa_elementor' ),
			],
			'condition' => [
				'tooltip' => 'yes',
			],
		] );

		$repeater->add_control( 'tooltip_content', [
			'label'     => __( 'Tooltip Content', 'epa_elementor' ),
			'type'      => Controls_Manager::WYSIWYG,
			'default'   => __( 'Tooltip Content', 'epa_elementor' ),
			'condition' => [
				'tooltip' => 'yes',
			],
		] );

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control( 'hot_spots', [
			'label'       => '',
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'feature_text'      => __( 'Hotspot #1', 'epa_elementor' ),
					'feature_icon'      => 'fa fa-plus',
					'epa_left_position' => 20,
					'epa_top_position'  => 30,
				],
			],
			'fields'      => array_values( $repeater->get_controls() ),
			'title_field' => '{{{ epa_hotspot_text }}}',
		] );

		/*		$this->add_control( 'hotspot_pulse', [
						'label'        => __( 'Glow Effect', 'epa_elementor' ),
						'type'         => Controls_Manager::SWITCHER,
						'default'      => '',
						'label_on'     => __( 'Yes', 'epa_elementor' ),
						'label_off'    => __( 'No', 'epa_elementor' ),
						'return_value' => 'yes',
					] );*/


		$this->end_controls_section();

		/**
		 * Content Tab: Tooltip Settings
		 */
		$this->start_controls_section( 'section_tooltip', [
			'label' => __( 'Tooltip Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'tooltip_arrow', [
			'label'        => __( 'Show Arrow', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'tooltip_size', [
			'label'   => __( 'Size', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'default',
			'options' => [
				'default' => __( 'Default', 'epa_elementor' ),
				'tiny'    => __( 'Tiny', 'epa_elementor' ),
				'small'   => __( 'Small', 'epa_elementor' ),
				'large'   => __( 'Large', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'tooltip_position', [
			'label'   => __( 'Tooltip Position', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'top',
			'options' => [
				'top'          => __( 'Top', 'epa_elementor' ),
				'bottom'       => __( 'Bottom', 'epa_elementor' ),
				'left'         => __( 'Left', 'epa_elementor' ),
				'right'        => __( 'Right', 'epa_elementor' ),
				'top-left'     => __( 'Top Left', 'epa_elementor' ),
				'top-right'    => __( 'Top Right', 'epa_elementor' ),
				'bottom-left'  => __( 'Bottom Left', 'epa_elementor' ),
				'bottom-right' => __( 'Bottom Right', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'tooltip_animation_in', [
			'label' => __( 'Animation In', 'plugin-domain' ),
			'type'  => Controls_Manager::ANIMATION,
			//'prefix_class' => 'animated ',
		] );


		$this->add_control( 'tooltip_animation_out', [
			'label' => __( 'Animation Out', 'plugin-domain' ),
			'type'  => Controls_Manager::ANIMATION,
			//'prefix_class' => 'animated ',
		] );

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Image
		 */
		$this->start_controls_section( 'epa_hotspot_image_section_style', [
			'label' => __( 'Image Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'image_width', [
			'label'      => __( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 1200,
					'step' => 1,
				],
				'%'  => [
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-image' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_image_border',
			'label'    => __( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .wfe-hot-spot-image',
		] );


		$this->add_responsive_control( 'epa_image_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_image_padding', [
			'label'      => __( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * Style Tab: Hotspot
		 */
		$this->start_controls_section( 'epa_hotspots_section_style', [
			'label' => __( 'Hotspot Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'icon_color_normal', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .wfe-hot-spot-wrap, {{WRAPPER}} .wfe-hot-spot-inner, {{WRAPPER}} .wfe-hot-spot-inner:before' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'epa_radar_bgcolor', [
			'label'     => __( 'Radar Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#999',
			'selectors' => [
				'{{WRAPPER}} .hotspot_ring' => 'border-color: {{VALUE}}',
			],
		] );


		$this->add_control( 'epa_icon_bg_color', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .wfe-hot-spot-wrap, {{WRAPPER}} .wfe-hot-spot-inner, {{WRAPPER}} .wfe-hot-spot-inner:before, {{WRAPPER}} .wfe-hotspot-icon-wrap, {{WRAPPER}} .wfe-hot-spot-inner.slack' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_responsive_control( 'epa_epa_hotspot_icon_size', [
			'label'      => __( 'Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => '14' ],
			'range'      => [
				'px' => [
					'min'  => 6,
					'max'  => 400,
					'step' => 1,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'        => 'epa_icon_border_normal',
			'label'       => __( 'Border', 'epa_elementor' ),
			'placeholder' => '',
			//'default'     => '0px',
			'selector'    => '{{WRAPPER}} .wfe-hot-spot-inner',
		] );


		$this->add_responsive_control( 'epa_icon_border_radius', [
			'label'      => __( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => '100' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-inner' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_icon_box_shadow',
			'selector'  => '{{WRAPPER}} .wfe-hot-spot-inner',
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'epa_icon_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_icon_padding', [
			'label'      => __( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wfe-hot-spot-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();

		/**
		 * Style Tab: Tooltip
		 */
		$this->start_controls_section( 'epa_section_tooltips_style', [
			'label' => __( 'Tooltip Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'epa_tooltip_color', [
			'label'   => __( 'Text Color', 'epa_elementor' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '',
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_tooltip_typography',
			'label'    => __( 'Typography', 'epa_elementor' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			'selector' => '.wfe-tooltip-{{ID}}',
		] );
		$this->add_control( 'epa_tooltip_bg_color', [
			'label'   => __( 'Background Color', 'epa_elementor' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '',
		] );

		$this->add_control( 'epa_tooltip_width', [
			'label' => __( 'Width', 'epa_elementor' ),
			'type'  => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min'  => 50,
					'max'  => 400,
					'step' => 1,
				],
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}
		?>
        <div class="epa_elementors">
            <div class="wfe-hot-spot-image">
				<?php
				$i = 1;
				foreach ( $settings['hot_spots'] as $index => $item ) :

					$this->add_render_attribute( 'hotspot' . $i, 'class', 'wfe-hot-spot-wrap elementor-repeater-item-' . esc_attr( $item['_id'] ) );

					if ( $item['tooltip'] == 'yes' && $item['tooltip_content'] != '' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'class', 'wfe-hot-spot-tooptip' );
						$this->add_render_attribute( 'hotspot' . $i, 'data-tipso', '<span class="wfe-tooltip-' . $this->get_id() . '">' . $this->parse_text_editor( $item['tooltip_content'] ) . '</span>' );
					}

					$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position-global', $settings['tooltip_position'] );

					if ( $item['epa_tooltip_position_local'] != 'global' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-position-local', $item['epa_tooltip_position_local'] );
					}

					if ( $settings['tooltip_size'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-size', $settings['tooltip_size'] );
					}

					if ( $settings['epa_tooltip_width'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-width', $settings['epa_tooltip_width']['size'] );
					}

					if ( $settings['tooltip_animation_in'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-in', $settings['tooltip_animation_in'] );
					}

					if ( $settings['tooltip_animation_out'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-animation-out', $settings['tooltip_animation_out'] );
					}

					if ( $settings['epa_tooltip_bg_color'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-background', $settings['epa_tooltip_bg_color'] );
					}

					if ( $settings['epa_tooltip_color'] ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-text-color', $settings['epa_tooltip_color'] );
					}

					if ( $settings['tooltip_arrow'] == 'yes' ) {
						$this->add_render_attribute( 'hotspot' . $i, 'data-tooltip-arrow', $settings['tooltip_arrow'] );
					}

					$this->add_render_attribute( 'hotspot_inner_' . $i, 'class', 'wfe-hot-spot-inner' );

					$this->add_render_attribute( 'hotspot_inner_' . $i, 'class', $settings['epa_hotspot_pulse_effects'] );
					?>
                    <span <?php echo $this->get_render_attribute_string( 'hotspot' . $i ); ?>>
                        <span <?php echo $this->get_render_attribute_string( 'hotspot_inner_' . $i ); ?>>
                        <?php
                        // if ( $item['epa_hotspot_type'] == 'icon' ) {
                        printf( '<span class="wfe-hotspot-icon-wrap"><span class="wfe-hotspot-icon tooltip %1$s"></span></span>', esc_attr( $item['epa_hotspot_icon'] ) );

                        // }


                        /* elseif ( $item['epa_hotspot_type'] == 'text' ) {
	                        printf( '<span class="wfe-hotspot-icon-wrap"><span class="wfe-hotspot-text">%1$s</span></span>', esc_attr( $item['epa_hotspot_text'] ) );
                        }*/

                        ?>
                        </span>
                    </span>
					<?php $i ++; endforeach; ?>

				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
            </div>
        </div>
		<?php
	}

	protected function content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_hotspot() );