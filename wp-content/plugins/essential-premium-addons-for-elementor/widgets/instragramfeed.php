<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Wfe_instragramfeed extends Widget_Base {

	public function get_name() {
		return 'wfe-instragramfeed';
	}

	public function get_title() {
		return __( 'Instagram Feed', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'fa fa-instagram wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium instagram feed
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {
		$this->start_controls_section( 'eael_section_instafeed_display_option', [
			'label' => esc_html__( 'Instagram Display Option', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_instafeed_loadmore_button', [
			'label'        => esc_html__( 'Enable Load More?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => '',
		] );

		$this->add_control( 'epa_instafeed_caption', [
			'label'        => esc_html__( 'Display Caption', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => '',
		] );

		$this->add_control( 'epa_instafeed_likes', [
			'label'        => esc_html__( 'Display Like', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_instafeed_comments', [
			'label'        => esc_html__( 'Display Comments', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'eael_section_instafeed_settings_account', [
				'label' => esc_html__( 'Instagram Account Settings', 'epa_elementor' ),
			] );

		$this->add_control( 'epa_instafeed_access_token', [
				'label'       => esc_html__( 'Access Token', 'epa_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( '5834397922.8f4c5bf.76ef64c716484618aea36ec2239fc93e', 'epa_elementor' ),
				'description' => '<a href="http://www.jetseotools.com/instagram-access-token/" class="eael-btn" target="_blank">Get Access Token</a>',
				'epa_elementor',
			] );

		$this->add_control( 'epa_instafeed_user_id', [
				'label'       => esc_html__( 'User ID', 'epa_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( '5834397922', 'epa_elementor' ),
				'description' => '<a href="https://codeofaninja.com/tools/find-instagram-user-id" class="eael-btn" target="_blank">Get User ID</a>',
				'epa_elementor',
			] );


		$this->add_control( 'epa_instafeed_client_id', [
				'label'       => esc_html__( 'Client ID', 'epa_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( '8a8d2899db0b4d379102f6cba8a8e181', 'epa_elementor' ),
				'description' => '<a href="https://www.instagram.com/developer/clients/manage/" class="eael-btn" target="_blank">Get Client ID</a>',
				'epa_elementor',
			] );


		$this->end_controls_section();

		$this->start_controls_section( 'eael_section_instafeed_settings_content', [
				'label' => esc_html__( 'Instagram Feed Settings', 'epa_elementor' ),
			] );

		$this->add_control( 'epa_instafeed_source', [
				'label'   => esc_html__( 'Feed Source', 'epa_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'user',
				'options' => [
					'user'   => esc_html__( 'User', 'epa_elementor' ),
					'tagged' => esc_html__( 'Hashtag', 'epa_elementor' ),
				],
			] );

		$this->add_control( 'epa_instafeed_hashtag', [
				'label'       => esc_html__( 'Hashtag', 'epa_elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'clocks', 'epa_elementor' ),
				'condition'   => [
					'epa_instafeed_source' => 'tagged',
				],
				'description' => 'Place the hashtag without #', 'epa_elementor',
			] );

		$this->add_control( 'epa_instafeed_sort_by', [
				'label'   => esc_html__( 'Sort By', 'epa_elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'            => esc_html__( 'None', 'epa_elementor' ),
					'most-recent'     => esc_html__( 'Most Recent', 'epa_elementor' ),
					'least-recent'    => esc_html__( 'Least Recent', 'epa_elementor' ),
					'most-liked'      => esc_html__( 'Most Likes', 'epa_elementor' ),
					'least-liked'     => esc_html__( 'Least Likes', 'epa_elementor' ),
					'most-commented'  => esc_html__( 'Most Commented', 'epa_elementor' ),
					'least-commented' => esc_html__( 'Least Commented', 'epa_elementor' ),
					'random'          => esc_html__( 'Random', 'epa_elementor' ),
				],
			] );

		$this->add_control( 'epa_instafeed_image_count', [
				'label'   => esc_html__( 'Max Visible Images', 'epa_elementor' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range'   => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
			] );

		$this->end_controls_section();


		$this->start_controls_section( 'eael_section_instafeed_settings_general', [
				'label' => esc_html__( 'General Settings', 'epa_elementor' ),
			] );

		$this->add_responsive_control( 'epa_postsgrid_columns', [
			'label'           => esc_html__( 'Columns', 'epa_elementor' ),
			'label_block'     => true,
			'type'            => Controls_Manager::SELECT,
			'desktop_default' => '25%',
			'mobile_default'  => '100%',
			'options'         => [
				'100%'    => esc_html__( '1 Column', 'epa_elementor' ),
				'50%'     => esc_html__( '2 Column', 'epa_elementor' ),
				'33.330%' => esc_html__( '3 Columns', 'epa_elementor' ),
				'25%'     => esc_html__( '4 Columns', 'epa_elementor' ),
				'20%'     => esc_html__( '5 Columns', 'epa_elementor' ),
				'16.66%'  => esc_html__( '6 Columns', 'epa_elementor' ),
			],
			'selectors'       => [
				'{{WRAPPER}} .epa-instagram-feed-wrapper' => 'width: {{VALUE}};',
			],
		] );


		$this->add_control( 'epa_instafeed_popimage_or_link', [
			'label'   => esc_html__( 'View Image Options', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'link',
			'options' => [
				'link'   => esc_html__( 'Link', 'epa_elementor' ),
				'pop_image' => esc_html__( 'Pop Up Image', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'epa_instafeed_link_target', [
				'label'        => esc_html__( 'Open in new window?', 'epa_elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'epa_instafeed_popimage_or_link' => 'link',
				],
			] );

		$this->end_controls_section();


		$this->start_controls_section( 'eael_section_instafeed_styles_general', [
				'label' => esc_html__( 'Instagram Feed Images', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );

		$this->add_responsive_control( 'epa_instafeed_spacing', [
				'label'      => esc_html__( 'Padding Between Images', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .epa-instagram-feed-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

		$this->add_control( 'epa_instafeed_image_resolution', [
			'label'   => esc_html__( 'Image Resolution', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'low_resolution',
			'options' => [
				'thumbnail'           => esc_html__( 'Thumbnail (150x150)', 'epa_elementor' ),
				'low_resolution'      => esc_html__( 'Low Res (306x306)', 'epa_elementor' ),
				'standard_resolution' => esc_html__( 'Standard (612x612)', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'epa_instafeed_force_square', [
			'label'        => esc_html__( 'Force Square Image?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => '',
		] );

		$this->add_responsive_control( 'epa_instafeed_sq_image_size', [
			'label'     => esc_html__( 'Image Dimension (px)', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 300,
			],
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .img-featured-container img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
			],
			'condition' => [
				'epa_instafeed_force_square' => 'yes',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'epa_instafeed_box_border',
				'label'    => esc_html__( 'Border', 'epa_elementor' ),
				'selector' => '{{WRAPPER}} .epa-instagram-feed-wrapper',
			] );

		$this->add_control( 'epa_instafeed_box_border_radius', [
				'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .img-featured-container' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			] );

		$this->end_controls_section();


		$this->start_controls_section( 'eael_section_instafeed_styles_content', [
				'label' => esc_html__( 'Color &amp; Typography', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			] );


		$this->add_control( 'epa_instafeed_overlay_color', [
				'label'     => esc_html__( 'Hover Overlay Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0, .75)',
				'selectors' => [
					'{{WRAPPER}} .img-featured-container .img-backdrop' => 'background: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_instafeed_like_comments_heading', [
				'label' => __( 'Like & Comments Styles', 'epa_elementor' ),
				'type'  => Controls_Manager::HEADING,
			] );

		$this->add_control( 'epa_instafeed_like_comments_color', [
				'label'     => esc_html__( 'Like &amp; Comments Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .epa-description-container .likes' => 'color: {{VALUE}};',
					'{{WRAPPER}} .epa-description-container .comments ' => 'color: {{VALUE}};'
				],
			] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_instafeed_like_comments_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .epa-description-container .likes .epa-description-container .comments',
			] );

		$this->add_control( 'epa_instafeed_caption_style_heading', [
				'label' => __( 'Caption Styles', 'epa_elementor' ),
				'type'  => Controls_Manager::HEADING,
			] );

		$this->add_control( 'epa_instafeed_caption_color', [
				'label'     => esc_html__( 'Caption Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .epa-description-container > p' => 'color: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_instafeed_caption_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .epa-description-container > p',
			] );


		$this->end_controls_section();

		$this->start_controls_section( 'eael_section_load_more_btn', [
				'label' => __( 'Load More Button Style', 'epa_elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                    'epa_instafeed_loadmore_button' => 'yes'
            ]
			] );

		$this->add_responsive_control( 'epa_instafeed_load_more_btn_padding', [
				'label'      => esc_html__( 'Padding', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #btn-instafeed-load' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			] );

	/*	$this->add_responsive_control( 'epa_instafeed_load_more_btn_margin', [
				'label'      => esc_html__( 'Margin', 'epa_elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #btn-instafeed-load' => 'margin: {{TOP}}{{UNIT}}',
				],
			] );*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'epa_instafeed_load_more_btn_typography',
				'selector' => '{{WRAPPER}} #btn-instafeed-load',
			] );

		$this->start_controls_tabs( 'epa_instafeed_load_more_btn_tabs' );

		// Normal State Tab
		$this->start_controls_tab( 'epa_instafeed_load_more_btn_normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );

		$this->add_control( 'epa_instafeed_load_more_btn_normal_text_color', [
				'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'eael_cta_btn_normal_bg_color', [
				'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1d54e0',
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load' => 'background: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
				'name'     => 'epa_instafeed_load_more_btn_normal_border',
				'label'    => esc_html__( 'Border', 'epa_elementor' ),
				'selector' => '{{WRAPPER}} #btn-instafeed-load',
			] );

		$this->add_control( 'epa_instafeed_load_more_btn_border_radius', [
				'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load' => 'border-radius: {{SIZE}}px;',
				],
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'epa_instafeed_load_more_btn_shadow',
				'selector'  => '{{WRAPPER}} #btn-instafeed-load',
				'separator' => 'before',
			] );

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'epa_instafeed_load_more_btn_hover', [ 'label' => esc_html__( 'Hover', 'epa_elementor' ) ] );

		$this->add_control( 'epa_instafeed_load_more_btn_hover_text_color', [
				'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load:hover' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_instafeed_load_more_btn_hover_bg_color', [
				'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1b75d6',
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load:hover' => 'background: {{VALUE}};',
				],
			] );

		$this->add_control( 'epa_instafeed_load_more_btn_hover_border_color', [
				'label'     => esc_html__( 'Border Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} #btn-instafeed-load:hover' => 'border-color: {{VALUE}};',
				],
			]

		);

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'epa_instafeed_load_more_btn_hover_shadow',
				'selector'  => '{{WRAPPER}} #btn-instafeed-load:hover',
				'separator' => 'before',
			] );
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$captions = $settings['epa_instafeed_caption'] == 'yes' ? '<p class="caption">{{caption}}</p>' : '';
		$likes = $settings['epa_instafeed_likes'] == 'yes' ? '<span class="likes"><i class="fa fa-heart"></i> {{likes}}</span>' : '';
		$comments = $settings['epa_instafeed_comments'] == 'yes' ? '<span class="comments"><i class="fa fa-comments"></i> {{comments}}</span>' : '';

		// View Image Options
		if ($settings['epa_instafeed_popimage_or_link'] == 'link') {
		    $newTab = $settings['epa_instafeed_link_target'] == 'yes' ? 'target="_blank"' : '';
			$instagram_link = '<a href="{{link}}" '.$newTab.'>';
        }
		else {
			$instagram_link = '<a href="{{image}}">';
        }

		$i = uniqid();
		?>
        <div id="instafeed-gallery-feed<?php echo $i; ?>" class="gallery">

        </div>

        <?php if ($settings['epa_instafeed_loadmore_button'] == 'yes') : ?>
        <button id="btn-instafeed-load" class="btn">Load more</button>
        <?php endif;?>

        <script type="text/javascript">

            var userFeed = new Instafeed({
                get: '<?php echo $settings['epa_instafeed_source']?>',
                tagName: '<?php echo $settings['epa_instafeed_hashtag'] ?>',
                userId: '<?php echo $settings['epa_instafeed_user_id'] ?>',
                limit: <?php echo $settings['epa_instafeed_image_count']['size'] ?>,
                resolution: '<?php echo $settings['epa_instafeed_image_resolution'] ?>',
                accessToken: '<?php echo $settings['epa_instafeed_access_token'] ?>',
                sortBy: '<?php echo $settings['epa_instafeed_sort_by'] ?>',
                template: '<div class="epa-instagram-feed-wrapper"><?php echo $instagram_link; ?><div class="img-featured-container"><div class="img-backdrop"></div><div class="epa-description-container"><?php echo $captions; echo $likes;  echo $comments; ?></div><img src="{{image}}" class="img-responsive"></div></a></div>',
                target: "instafeed-gallery-feed<?php echo $i; ?>",
                after: function () {
                    // disable button if no more results to load
                    if (!this.hasNext()) {
                        btnInstafeedLoad.setAttribute('disabled', 'disabled');
                    }
                },
            });
            userFeed.run();

            var btnInstafeedLoad = document.getElementById("btn-instafeed-load");
            btnInstafeedLoad.addEventListener("click", function () {
                userFeed.next()
            });

        </script>
		<?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Wfe_instragramfeed() );