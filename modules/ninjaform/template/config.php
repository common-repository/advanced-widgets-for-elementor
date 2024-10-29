<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background as Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Perfecto awe Portfolio
 *
 * Elementor widget for awe portfolio
 *
 * @since 1.0.0
 */
class awe_Ninjaform extends Widget_Base {

	public function get_name() {
		return 'awe-ninjaform';
	}

	public function get_title() {
		return esc_html__( 'Ninjaform', 'aw_elementor' );
	}

	public function get_icon() {
		return 'ad ad-form';
	}

	public function get_categories() {
		return [ 'awe_elementor' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'awe-ninjaform' ];
    }

    protected  function get_profile_names() {
        return [
            'apple' => __( 'Apple', 'aw_elementor' ),
            'behance' => __( 'Behance', 'aw_elementor' ),
            'bitbucket' => __( 'BitBucket', 'aw_elementor' ),
            'codepen' => __( 'CodePen', 'aw_elementor' ),
            'delicious' => __( 'Delicious', 'aw_elementor' ),
            'deviantart' => __( 'DeviantArt', 'aw_elementor' ),
            'digg' => __( 'Digg', 'aw_elementor' ),
            'dribbble' => __( 'Dribbble', 'aw_elementor' ),
            'email' => __( 'Email', 'aw_elementor' ),
            'facebook' => __( 'Facebook', 'aw_elementor' ),
            'flickr' => __( 'Flicker', 'aw_elementor' ),
            'foursquare' => __( 'FourSquare', 'aw_elementor' ),
            'github' => __( 'Github', 'aw_elementor' ),
            'houzz' => __( 'Houzz', 'aw_elementor' ),
            'instagram' => __( 'Instagram', 'aw_elementor' ),
            'jsfiddle' => __( 'JS Fiddle', 'aw_elementor' ),
            'linkedin' => __( 'LinkedIn', 'aw_elementor' ),
            'medium' => __( 'Medium', 'aw_elementor' ),
            'pinterest' => __( 'Pinterest', 'aw_elementor' ),
            'product-hunt' => __( 'Product Hunt', 'aw_elementor' ),
            'reddit' => __( 'Reddit', 'aw_elementor' ),
            'slideshare' => __( 'Slide Share', 'aw_elementor' ),
            'snapchat' => __( 'Snapchat', 'aw_elementor' ),
            'soundcloud' => __( 'SoundCloud', 'aw_elementor' ),
            'spotify' => __( 'Spotify', 'aw_elementor' ),
            'stack-overflow' => __( 'StackOverflow', 'aw_elementor' ),
            'tripadvisor' => __( 'TripAdvisor', 'aw_elementor' ),
            'tumblr' => __( 'Tumblr', 'aw_elementor' ),
            'twitch' => __( 'Twitch', 'aw_elementor' ),
            'twitter' => __( 'Twitter', 'aw_elementor' ),
            'vimeo' => __( 'Vimeo', 'aw_elementor' ),
            'vk' => __( 'VK', 'aw_elementor' ),
            'website' => __( 'Website', 'aw_elementor' ),
            'whatsapp' => __( 'WhatsApp', 'aw_elementor' ),
            'wordpress' => __( 'WordPress', 'aw_elementor' ),
            'xing' => __( 'Xing', 'aw_elementor' ),
            'yelp' => __( 'Yelp', 'aw_elementor' ),
            'youtube' => __( 'YouTube', 'aw_elementor' ),
        ];
    }
    

	protected function _register_controls() {
		
        $this->start_controls_section(
			'_section_ninjaf',
			[
				'label' => Advance_Addons_is_ninjaf_activated() ? __( 'Ninja Forms', 'aw_elementor' ) : __( 'Notice', 'aw_elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        if ( ! Advance_Addons_is_ninjaf_activated() ) {
            $this->add_control(
                'ninjaf_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __( 'Hi, it seems %1$s is missing in your site. Please install and activate %1$s first.', 'aw_elementor' ),
                        '<a href="https://wordpress.org/plugins/ninja-forms/" target="_blank" rel="noopener">Ninja Form</a>'
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
            'form_id',
            [
                'label' => __( 'Select Your Form', 'aw_elementor' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
				'options' => ['' => __( '', 'aw_elementor' ) ] + \Advance_Addons_get_ninjaform(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => __( 'Form Fields', 'aw_elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => __( 'Field Spacing', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .nf-field-container:not(.submit-container)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label' => __( 'Padding', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label' => __( 'Border Radius', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => __( 'Typography', 'aw_elementor' ),
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'field_textcolor',
            [
                'label' => __( 'Field Text Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            'field_placeholder_color',
            [
                'label' => __( 'Field Placeholder Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder'	=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder'			=> 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder'		=> 'color: {{VALUE}};',
                ],
            ]
		);

		$this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => __( 'Normal', 'aw_elementor' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea',
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label' => __( 'Background Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text], {{WRAPPER}} .email-wrap input, {{WRAPPER}} .textarea-wrap textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => __( 'Focus', 'aw_elementor' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_focus_border',
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus',
            ]
		);

		$this->add_control(
            'field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap input[type=text]:focus, {{WRAPPER}} .email-wrap input:focus, {{WRAPPER}} .textarea-wrap textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'ninjaf-form-label',
            [
                'label' => __( 'Form Fields Label', 'aw_elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => __( 'Margin', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_padding',
            [
                'label' => __( 'Padding', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'display: inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __( 'Label Typography', 'aw_elementor' ),
                'selector' => '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __( 'Description Typography', 'aw_elementor' ),
                'selector' => '{{WRAPPER}} .nf-field-description p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __( 'Label Text Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .textbox-wrap label, {{WRAPPER}} .email-wrap label, {{WRAPPER}} .textarea-wrap label' => 'color: {{VALUE}}',
                ],
            ]
		);

		$this->add_control(
            'requered_label',
            [
                'label' => __( 'Required Label Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ninja-forms-req-symbol' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'desc_color',
            [
                'label' => __( 'Description Text Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nf-field-description p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'submit',
            [
                'label' => __( 'Submit Button', 'aw_elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'submit_btn_position',
            [
                'label' => __( 'Button Position', 'aw_elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'aw_elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'aw_elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'aw_elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'desktop_default' => 'left',
                'toggle' => false,
				'prefix_class' => 'ha-form-btn--%s',
				'selectors' => [
                    '{{WRAPPER}} .field-wrap.submit-wrap' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_margin',
            [
                'label' => __( 'Margin', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding',
            [
                'label' => __( 'Padding', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .submit-container input',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .submit-container input',
            ]
        );

        $this->add_control(
            'submit_border_radius',
            [
                'label' => __( 'Border Radius', 'aw_elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_box_shadow',
                'selector' => '{{WRAPPER}} .submit-container input',
            ]
        );

        $this->add_control(
            'hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'aw_elementor' ),
            ]
        );

        $this->add_control(
            'submit_color',
            [
                'label' => __( 'Text Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_bg_color',
            [
                'label' => __( 'Background Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'aw_elementor' ),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label' => __( 'Text Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_bg_color',
            [
                'label' => __( 'Background Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'aw_elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .submit-container input:hover, {{WRAPPER}} .submit-container input:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

	}

	protected function render() {
		require AWE_PATH . '/modules/ninjaform/template/view.php';
	}


}
