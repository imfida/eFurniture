<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_teammember extends Widget_Base {

	public function get_name() {
		return 'wfe-teammember';
	}

	public function get_title() {
		return __( 'Team Member', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-person wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		/////// Image Secttion ///////////
		/// //////////////////////////////

		$this->start_controls_section( 'epa_teammember_image_section', [
			'label' => esc_html__( 'Member Image', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_team_image', [
			'label'   => __( 'Image', 'epa_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'epa_team_image[url]!' => '',
			],
		] );
		$this->end_controls_section();


		///////// Team Content SecTion /////////
		/// ///////////////////////////////////

		$this->start_controls_section( 'epa_teammember_content_section', [
			'label' => esc_html__( 'Member Content', 'epa_elementor' ),
		] );


		$this->add_control( 'epa_teammember_name', [
			'label'   => esc_html__( 'Name', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Raju Sarkar', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_teammember_desig', [
			'label'   => esc_html__( 'Member Designation', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Web Developer', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_teammember_descr', [
			'label'   => esc_html__( 'Description', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Team Member Description Here. Remove the text if not necessary.', 'epa_elementor' ),
		] );
		$this->end_controls_section();

		//////////// Member Social Profile ////////
		/// ///////////////////////////////////////

		$this->start_controls_section( 'epa_teammember_social_profiles_section', [
			'label' => esc_html__( 'Social Profiles', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_teammember_social_profiles_active', [
			'label'   => esc_html__( 'Display Social Profiles?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );


		$this->add_control( 'epa_teammember_social_profile_repeater', [
			'type'      => Controls_Manager::REPEATER,
			'condition' => [
				'epa_teammember_social_profiles_active!' => '',
			],
			'default'   => [
				[
					'social' => 'fa fa-facebook',
				],
				[
					'social' => 'fa fa-twitter',
				],
				[
					'social' => 'fa fa-google-plus',
				],
				[
					'social' => 'fa fa-linkedin',
				],
			],
			'fields'    => [
				[
					'name'        => 'social',
					'label'       => esc_html__( 'Icon', 'epa_elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => true,
					'default'     => 'fa fa-wordpress',
					'include'     => [
						'fa fa-facebook',
						'fa fa-delicious',
						'fa fa-youtube',
						'fa fa-apple',
						'fa fa-behance',
						'fa fa-bitbucket',
						'fa fa-codepen',
						'fa fa-digg',
						'fa fa-dribbble',
						'fa fa-envelope',
						'fa fa-flickr',
						'fa fa-foursquare',
						'fa fa-github',
						'fa fa-google-plus',
						'fa fa-houzz',
						'fa fa-instagram',
						'fa fa-jsfiddle',
						'fa fa-medium',
						'fa fa-pinterest',
						'fa fa-vimeo',
						'fa fa-product-hunt',
						'fa fa-reddit',
						'fa fa-shopping-cart',
						'fa fa-slideshare',
						'fa fa-linkedin',
						'fa fa-snapchat',
						'fa fa-soundcloud',
						'fa fa-spotify',
						'fa fa-stack-overflow',
						'fa fa-tripadvisor',
						'fa fa-tumblr',
						'fa fa-twitch',
						'fa fa-twitter',
						'fa fa-vk',
						'fa fa-whatsapp',
						'fa fa-wordpress',
						'fa fa-xing',
						'fa fa-yelp',
					],
				],
				[
					'name'        => 'link',
					'label'       => esc_html__( 'Link', 'epa_elementor' ),
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'default'     => [
						'url'         => '',
						'is_external' => 'true',
					],
					'placeholder' => esc_html__( 'Place URL here', 'epa_elementor' ),
				],
			],
		] );

		$this->end_controls_section();

		///////// Team Member Image Style ///////
		////////////////////////////////////////

		$this->start_controls_section( 'epa_teammember_image_styles_section', [
			'label' => esc_html__( 'Image Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'epa_teammember_image_width', [
			'label'      => esc_html__( 'Image Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 100,
				'unit' => '%',
			],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
			'size_units' => [ '%', 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-team-member .pic img' => 'width:{{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'epa_pricing_image_hover_color', [
			'label'     => esc_html__( 'Image Hover Overlay', 'wfe_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'  => 'rgba(255,255,255,0.5)',
			'selectors' => [
				'{{WRAPPER}} .epa-team-member:hover .pic::before' => 'background: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_teammember_image_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-team-member .pic img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_teammember_image_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-team-member .pic img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_teammembers_image_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-team-member .pic img',
		] );
		$this->end_controls_section();


		/////// Team Member Content Style ///////
		/// /////////////////////////////////////

		$this->start_controls_section( 'epa_teammembers_content_section', [
			'label' => esc_html__( 'Content Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_teammember_content_background_heading', [
			'label' => __( 'Content Background Color', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );
		$this->add_control( 'epa_teammember_content_background', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-team-content'           => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .epa-team-member .epa-descr' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_teammember_name_title', [
			'label' => __( 'Member Name', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
			'separator' => 'after'
		] );

		$this->add_control( 'epa_teammember_name_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#282828',
			'selectors' => [
				'{{WRAPPER}} .epa-team-member .member-title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_teammember_name_typography',
			'selector' => '{{WRAPPER}} .epa-team-member .member-title',
		] );

		$this->add_responsive_control(
			'epa_teammember_member_name_margin',
			[
				'label' => esc_html__( 'Margin', 'epa_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .member-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control( 'epa_teammember_designation_heading', [
			'label' => __( 'Member Designation', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
			'separator' => 'after'
		] );

		$this->add_control( 'epa_teammember_designation_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#282828',
			'selectors' => [
				'{{WRAPPER}} .epa-team-member .member-title small' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_teammember_designation_typography',
			'selector' => '{{WRAPPER}} .epa-team-member .member-title small',
			'separator' => 'after'
		] );

		$this->add_control( 'epa_teammember_description_heading', [
			'label' => __( 'Member Description', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
			'separator' => 'after'
		] );

		$this->add_control( 'epa_teammember_description_color', [
			'label'     => esc_html__( 'Description Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#282828',
			'selectors' => [
				'{{WRAPPER}} .epa-team-member .epa-descr' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_teammember_description_color_typography',
			'selector' => '{{WRAPPER}} .epa-team-member .epa-descr',
		] );

		$this->add_control( 'epa_teammember_bottom_shape_heading', [
			'label' => __( 'Bottom Shape', 'epa_elementor' ),
			'separator' => 'after',
			'type'  => Controls_Manager::HEADING,
		] );


		$this->add_control( 'epa_teammember_show_border', [
				'label'        => __( 'Show Border Shape', 'plugin-domain' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'your-plugin' ),
				'label_off'    => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default'      => 'no',
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'      => 'eael_team_member_bottom_shape_border',
				'selector'  => '{{WRAPPER}} .epa-team-member .member-title::after',
				'condition' => [
					'epa_teammember_show_border!' => '',
				],
			] );

		$this->add_responsive_control( 'epa_teammember_bottom_shape_width', [
			'label'      => esc_html__( 'Shape Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 100,
				'unit' => '%',
			],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
			'size_units' => [ '%', 'px' ],
			'condition'  => [
				'epa_teammember_show_border!' => '',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-team-member .member-title::after' => 'width:{{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();

		///// Social Profile Section /////
		/// ///////////////////////////////

		$this->start_controls_section( 'epa_teammember_social_profile_section', [
				'label' => esc_html__( 'Social Profiles Style', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );


		$this->add_control( 'epa_teammember_socialicon_size', [
				'label'     => esc_html__( 'Icon Size', 'epa_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a' => 'font-size: {{SIZE}}px;',
				],
			] );

		$this->add_responsive_control( 'epa_teammember_socialicon_margin', [
				'label'      => esc_html__( 'Margin', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-team-member .social-link li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );
		$this->add_responsive_control( 'epa_teammember_socialicon_pading', [
				'label'      => esc_html__( 'Padding', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-team-member .social-link li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );


		$this->start_controls_tabs( 'epa_teammember_social_icon_style_tab' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );

		$this->add_control( 'eaa_teammember_social_icon_color', [
				'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2d2d2d',
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a' => 'color: {{VALUE}};',
				],
			] );


		$this->add_control( 'eaa_teammember_social_icon_background', [
				'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a' => 'background-color: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'eaa_teammember_social_icon_border',
				'selector' => '{{WRAPPER}} .epa-team-member .social-link li a',
			] );

		$this->add_control( 'eaa_teammember_socialicon_border_radius', [
				'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a' => 'border-radius: {{SIZE}}px;',
				],
			] );


		$this->end_controls_tab();

		$this->start_controls_tab( 'epa_teammember_socialicon_hover', [ 'label' => esc_html__( 'Hover', 'epa_elementor' ) ] );

		$this->add_control( 'ea_teammember_socialicon_hover_color', [
				'label'     => esc_html__( 'Icon Hover Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a:hover' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_team_member_social_iconhover_background', [
				'label'     => esc_html__( 'Hover Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a:hover' => 'background-color: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_teammember_socialicon_hover_border_color', [
				'label'     => esc_html__( 'Hover Border Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-team-member .social-link li a:hover' => 'border-color: {{VALUE}};',
				],
			] );
		$this->end_controls_tab();

		$this->end_controls_section();
		///////// Team Member Container Style ///////
		////////////////////////////////////////

		$this->start_controls_section( 'epa_teammember_container_section', [
			'label' => esc_html__( 'Container Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'eaa_teammember_container_border',
			'selector' => '{{WRAPPER}} .epa-team-member',
		] );
		/*Icon Border Radius*/
		$this->add_control( 'eaa_teammember_container_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'wfe_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-team-member' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );
		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'wfe_elementor' ),
			'name'     => 'epa_team_member_container_shadow',
			'selector' => '{{WRAPPER}} .epa-team-member',
		] );

		$this->add_responsive_control(
			'epa_teammember_container_margin',
			[
				'label' => esc_html__( 'Container Margin', 'epa_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .epa-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'epa_teammember_container_padding',
			[
				'label' => esc_html__( 'Container Padding', 'epa_elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .epa-team-member' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();


		// Image Value Get
		$epa_team_image    = $settings['epa_team_image'];
		$epateam_image_url = Group_Control_Image_Size::get_attachment_image_src( $epa_team_image['id'], 'thumbnail', $settings );
		if ( empty( $epateam_image_url ) ) : $epateam_image_url = $epa_team_image['url'];
		else: $epateam_image_url = $epateam_image_url;
		endif;

		//Get Data Value
		$mname       = $settings['epa_teammember_name']; // Member Name
		$mdesig      = $settings['epa_teammember_desig']; // Member Designation
		$mdescr      = $settings['epa_teammember_descr']; // Member Description
		$socialicons = $settings['epa_teammember_social_profile_repeater']; // Social Icon
		$showborder  = $settings['epa_teammember_show_border']; // Social Icon

		$output = '';
		if ( $showborder !== "yes" ) {
			$output .= '
			<style type="text/css">
				.epa-team-member .member-title::after {
				border-bottom: 0;
				}
			</style>
			';
		}

		$output .= '<div class="epa-team-member">
                <div class="pic">
                    <img src="' . $epateam_image_url . '" alt="">
                </div>
                <div class="epa-team-content">
                    <h3 class="member-title">' . $mname . '<small>' . $mdesig . '</small></h3>
                    <ul class="social-link">';
		if (!empty($socialicons)){
		foreach ( $socialicons as $icon ) {

			$target = $icon['link']['is_external'] ? ' target="_blank"' : ''; // Link Open In New Tab

			if ( ( ! empty( $icon['social'] ) ) ) {
				$output .= '<li><a href="' . $icon['link']['url'] . '" ' . $target . ' class="' . $icon['social'] . '"></a></li>';
			}
		}
		}
		$output .= '</ul>
                    <p class="epa-descr">' . $mdescr . '</p>
                </div>
            </div>';

		echo $output;
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_teammember() );