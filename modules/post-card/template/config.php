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
class Awe_Post_Card extends Widget_Base {

	public function get_name() {
		return 'awe-post-card';
	}

	public function get_title() {
		return esc_html__( 'Post Cards', ' aw_elementor' );
	}

	public function get_icon() {
		return 'ad ad-playing-card';
	}

	public function get_categories() {
		return [ 'awe_elementor' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'awe-badges' ];
	}


	protected function _register_controls() {
		
		$this->start_controls_section(
			'_section_info',
			[
				'label' => __( 'Single Post Cards', ' aw_elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		/*-------------------------------------
			Visual Style
		-------------------------------------*/
        $this->add_control(
            'style',
            [
                'label'   => __( 'Visual Style', 'aw_elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
					'style1' => __( 'Style 1', ' aw_elementor' ),
                ],
            ]
        );


		$this->add_control(
			'post_name',
			[
				'label' => esc_html__( 'Post Name', 'aw_elementor' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => awe_post_name(),
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Title', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_content',
			[
				'label' => esc_html__( 'Content', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Excerpts', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => esc_html__( 'Category', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_author',
			[
				'label' => esc_html__( 'Author', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => esc_html__( 'Date', 'aw_elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

	$this->end_controls_section();

// Style Title tab section
$this->start_controls_section(
	'single_post_title_style_section',
	[
		'label' => __( 'Title', 'aw_elementor' ),
		'tab' => Controls_Manager::TAB_STYLE,
		'condition'=>[
			'show_title'=>'yes',
		]
	]
);
	$this->add_control(
		'title_color',
		[
			'label' => __( 'Color', 'aw_elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .caption h3 a' => 'color: {{VALUE}} !important',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'title_typography',
			'label' => __( 'Typography', 'aw_elementor' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .caption h3 a',
		]
	);

	$this->add_responsive_control(
		'title_margin',
		[
			'label' => __( 'Margin', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'title_padding',
		[
			'label' => __( 'Padding', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'title_align',
		[
			'label' => __( 'Alignment', 'aw_elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'aw_elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'aw_elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'aw_elementor' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'aw_elementor' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .awe-post-title' => 'text-align: {{VALUE}};',
			],
		]
	);

$this->end_controls_section();


// Style Title tab section
$this->start_controls_section(
	'single_post_content_style_section',
	[
		'label' => __( 'Content', 'aw_elementor' ),
		'tab' => Controls_Manager::TAB_STYLE,
		'condition'=>[
			'show_content'=>'yes',
		]
	]
);
	$this->add_control(
		'content_color',
		[
			'label' => __( 'Color', 'aw_elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .awe-post-con p' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'content_typography',
			'label' => __( 'Typography', 'aw_elementor' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .awe-post-con p',
		]
	);

	$this->add_responsive_control(
		'content_margin',
		[
			'label' => __( 'Margin', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-con' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'content_padding',
		[
			'label' => __( 'Padding', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-con' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'content_align',
		[
			'label' => __( 'Alignment', 'aw_elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'aw_elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'aw_elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'aw_elementor' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'aw_elementor' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .awe-post-con p' => 'text-align: {{VALUE}};',
			],
		]
	);

$this->end_controls_section();

// Style Category tab section
$this->start_controls_section(
	'single_post_category_style_section',
	[
		'label' => __( 'Category', 'aw_elementor' ),
		'tab' => Controls_Manager::TAB_STYLE,
		'condition'=>[
			'show_category'=>'yes',
		]
	]
);
	$this->add_control(
		'category_color',
		[
			'label' => __( 'Color', 'aw_elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .awe-post-cat' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'category_typography',
			'label' => __( 'Typography', 'aw_elementor' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .awe-post-cat',
		]
	);

	$this->add_responsive_control(
		'category_margin',
		[
			'label' => __( 'Margin', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'category_padding',
		[
			'label' => __( 'Padding', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Background::get_type(),
		[
			'name' => 'category_background',
			'label' => __( 'Background', 'aw_elementor' ),
			'types' => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .awe-post-cat',
		]
	);

$this->end_controls_section();

// Style Date tab section
$this->start_controls_section(
	'single_post_date_style_section',
	[
		'label' => __( 'Date', 'aw_elementor' ),
		'tab' => Controls_Manager::TAB_STYLE,
		'condition'=>[
			'show_date'=>'yes',
		]
	]
);
	$this->add_control(
		'date_color',
		[
			'label' => __( 'Color', 'aw_elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .awe-post-date' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'date_typography',
			'label' => __( 'Typography', 'aw_elementor' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .awe-post-date',
		]
	);

	$this->add_responsive_control(
		'date_margin',
		[
			'label' => __( 'Margin', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'date_padding',
		[
			'label' => __( 'Padding', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'date_align',
		[
			'label' => __( 'Alignment', 'aw_elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'aw_elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'aw_elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'aw_elementor' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'aw_elementor' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .awe-post-date' => 'text-align: {{VALUE}};',
			],
			'default' => 'left',
		]
	);

$this->end_controls_section();


// Style Date tab section
$this->start_controls_section(
	'single_post_auth_style_section',
	[
		'label' => __( 'Author', 'aw_elementor' ),
		'tab' => Controls_Manager::TAB_STYLE,
		'condition'=>[
			'show_date'=>'yes',
		]
	]
);
	$this->add_control(
		'auth_color',
		[
			'label' => __( 'Color', 'aw_elementor' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .awe-post-author' => 'color: {{VALUE}}',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'auth_typography',
			'label' => __( 'Typography', 'aw_elementor' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .awe-post-author',
		]
	);

	$this->add_responsive_control(
		'auth_margin',
		[
			'label' => __( 'Margin', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'auth_padding',
		[
			'label' => __( 'Padding', 'aw_elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors' => [
				'{{WRAPPER}} .awe-post-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'auth_align',
		[
			'label' => __( 'Alignment', 'aw_elementor' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'aw_elementor' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'aw_elementor' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'aw_elementor' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'aw_elementor' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .awe-post-author' => 'text-align: {{VALUE}};',
			],
			'default' => 'left',
		]
	);

$this->end_controls_section();


}

	protected function render() {
		require AWE_PATH . '/modules/post-card/template/view.php';
	}

	// protected function _content_template() {
	// 	require AWE_PATH . '/modules/post-card/template/content-template.php';
	// }

}
