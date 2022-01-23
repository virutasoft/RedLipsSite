<?php

namespace MasterAddons\Addons;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class JLTMA_Advanced_Accordion extends Widget_Base
{

	public function get_name()
	{
		return 'ma-advanced-accordion';
	}

	public function get_title()
	{
		return esc_html__('Advanced Accordion', JLTMA_TD);
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-accordion';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_style_depends()
	{
		return [
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/advanced-accordion/';
	}


	protected function register_controls()
	{

		/**
		 * Content Tab: Accordions
		 */
		$this->start_controls_section(
			'section_accordion_tabs',
			[
				'label' => esc_html__('Content', JLTMA_TD)
			]
		);

		$this->add_control(
			'accordion_type',
			[
				'label'       => esc_html__('Accordion Type', JLTMA_TD),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'accordion',
				'label_block' => false,
				'options'     => [
					'accordion' => esc_html__('Accordion', JLTMA_TD),
					'toggle'    => esc_html__('Toggle', JLTMA_TD),
				],
				'frontend_available' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'accordion_tab_default_active',
			[
				'label'                 => esc_html__('Active as Default', JLTMA_TD),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'no',
				'return_value'          => 'yes',
			]
		);

		$repeater->add_control(
			'accordion_tab_icon_show',
			[
				'label'                 => esc_html__('Enable Custom Icon', JLTMA_TD),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'return_value'          => 'yes',
			]
		);


		// Custom Icons Start
		$repeater->start_controls_tabs('accordion_tab_icon_custom');

		$repeater->start_controls_tab(
			'accordion_tab_icon_custom_expand',
			[
				'label'                 => __('Expand Icon', JLTMA_TD),
				'condition' => [
					'accordion_tab_icon_show' => 'yes'
				],
			]
		);

		$repeater->add_control(
			'accordion_tab_title_icon',
			[
				'label'         	=> esc_html__('Icon', JLTMA_TD),
				'description' 		=> esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fas fa-plus',
					'library'   => 'solid',
				],
				'render_type'      => 'template',
				'condition' => [
					'accordion_tab_icon_show' => 'yes'
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'accordion_tab_icon_custom_collapse',
			[
				'label'                 => __('Collapse Icon', JLTMA_TD),
				'condition' => [
					'accordion_tab_icon_show' => 'yes'
				],
			]
		);

		$repeater->add_control(
			'accordion_tab_title_icon_collapse',
			[
				'label'         	=> esc_html__('Icon', JLTMA_TD),
				'description' 		=> esc_html__('Please choose an icon from the list.', JLTMA_TD),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fas fa-minus',
					'library'   => 'solid',
				],
				'render_type'      => 'template',
				'condition' => [
					'accordion_tab_icon_show' => 'yes'
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		// Custom Icons End





		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			/* Start of Single Accordion Tab Styles */
			$repeater->add_control(
				'single_tab_title_bg_color_show',
				[
					'label'                 => esc_html__('Enable Background Color', JLTMA_TD),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'no',
					'return_value'          => 'yes',
				]
			);

			$repeater->add_control(
				'single_title_text_color',
				[
					'label'                 => esc_html__('Title Color', JLTMA_TD),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#333333',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					]
				]
			);

			$repeater->add_control(
				'single_tab_title_bg_color',
				[
					'label'                 => esc_html__('Title Background Color', JLTMA_TD),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#fff',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					]
				]
			);

			$repeater->add_control(
				'single_title_content_color',
				[
					'label'                 => esc_html__('Content Color', JLTMA_TD),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#333333',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item.ma-multicolor-accordion .jltma-accordion-tab-content p' => 'color: {{VALUE}}'
					]
				]
			);

			$repeater->add_control(
				'single_tab_content_bg_color',
				[
					'label'                 => esc_html__('Content Background Color', JLTMA_TD),
					'type'                  => Controls_Manager::COLOR,
					'default'               => '#fff',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					],
					'selectors'             => [
						'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item.ma-multicolor-accordion .jltma-accordion-tab-content' => 'background: {{VALUE}};'
					]
				]
			);


			/* End of Single Accordion Tab Styles */
		} else {

			/* Start of Single Accordion Tab Styles */
			$repeater->add_control(
				'single_tab_title_bg_color_show_pro',
				[
					'label'             => esc_html__('Enable Background Color', JLTMA_TD),
					'type' 				=> Controls_Manager::CHOOSE,
					'options' 			=> [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);

			$repeater->add_control(
				'single_title_text_color_pro',
				[
					'label'             => esc_html__('Title Color', JLTMA_TD),
					'type' 				=> Controls_Manager::CHOOSE,
					'options' 			=> [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);

			$repeater->add_control(
				'single_tab_title_bg_color_pro',
				[
					'label'             => esc_html__('Title Background Color', JLTMA_TD),
					'type' 				=> Controls_Manager::CHOOSE,
					'options' 			=> [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					],
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);

			$repeater->add_control(
				'single_title_content_color_pro',
				[
					'label'                 => esc_html__('Content Color', JLTMA_TD),
					'type' 				=> Controls_Manager::CHOOSE,
					'options' 			=> [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);

			$repeater->add_control(
				'single_tab_content_bg_color_pro',
				[
					'label'                 => esc_html__('Content Background Color', JLTMA_TD),
					'type'                  => Controls_Manager::COLOR,
					'options' 			=> [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'condition'             => [
						'single_tab_title_bg_color_show' => 'yes'
					],
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> unlock this Option.</span>'
				]
			);

			/* End of Single Accordion Tab Styles */
		}




		$repeater->add_control(
			'tab_title',
			[
				'label'                 => __('Title', JLTMA_TD),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Accordion Title', JLTMA_TD),
				'dynamic'               => [
					'active'   => true,
				],
			]
		);


		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$repeater->add_control(
				'content_type',
				[
					'label'                 => esc_html__('Content Type', JLTMA_TD),
					'type'                  => Controls_Manager::SELECT,
					'label_block'           => false,
					'options'               => [
						'content'   => __('Content', JLTMA_TD),
						//						'image'     => __( 'Image', JLTMA_TD ),
						//						'video' 	=> __( 'Video', JLTMA_TD ),
						'section'   => __('Saved Section', JLTMA_TD),
						'widget'    => __('Saved Widget', JLTMA_TD),
						'template'  => __('Saved Page Template', JLTMA_TD),
					],
					'default'               => 'content',
				]
			);

			$repeater->add_control(
				'accordion_content',
				[
					'label'                 => esc_html__('Content', JLTMA_TD),
					'type'                  => Controls_Manager::WYSIWYG,
					'default'               => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', JLTMA_TD),
					'dynamic'               => ['active' => true],
					'condition'             => [
						'content_type'	=> 'content',
					],
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'                 => __('Image', JLTMA_TD),
					'type'                  => Controls_Manager::MEDIA,
					'dynamic'               => [
						'active'   => true,
					],
					'default'               => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'conditions'            => [
						'terms' => [
							[
								'name'      => 'content_type',
								'operator'  => '==',
								'value'     => 'image',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'saved_widget',
				[
					'label'                 => __('Choose Widget', JLTMA_TD),
					'type'                  => Controls_Manager::SELECT,
					'options'               => $this->get_page_template_options('widget'),
					'default'               => '-1',
					'condition'             => [
						'content_type'    => 'widget',
					],
					'conditions'        => [
						'terms' => [
							[
								'name'      => 'content_type',
								'operator'  => '==',
								'value'     => 'widget',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'saved_section',
				[
					'label'                 => __('Choose Section', JLTMA_TD),
					'type'                  => Controls_Manager::SELECT,
					'options'               => $this->get_page_template_options('section'),
					'default'               => '-1',
					'conditions'        => [
						'terms' => [
							[
								'name'      => 'content_type',
								'operator'  => '==',
								'value'     => 'section',
							],
						],
					],
				]
			);

			$repeater->add_control(
				'templates',
				[
					'label'                 => __('Choose Template', JLTMA_TD),
					'type'                  => Controls_Manager::SELECT,
					'options'               => $this->get_page_template_options('page'),
					'default'               => '-1',
					'conditions'        => [
						'terms' => [
							[
								'name'      => 'content_type',
								'operator'  => '==',
								'value'     => 'template',
							],
						],
					],
				]
			);
		} else {
			$repeater->add_control(
				'content_type',
				[
					'label'                 => esc_html__('Content Type', JLTMA_TD),
					'type'                  => Controls_Manager::SELECT,
					'label_block'           => false,
					'options'               => [
						'content'   => __('Content', JLTMA_TD),
						'section'   => __('Saved Section (Pro)', JLTMA_TD),
						'widget'    => __('Saved Widget (Pro)', JLTMA_TD),
						'template'  => __('Saved Page Template (Pro)', JLTMA_TD),
					],
					'default'               => 'content',
				]
			);

			$repeater->add_control(
				'accordion_content',
				[
					'label'                 => esc_html__('Content', JLTMA_TD),
					'type'                  => Controls_Manager::WYSIWYG,
					'default'               => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', JLTMA_TD),
					'dynamic'               => ['active' => true],
					'condition'             => [
						'content_type'	=> 'content',
					],
				]
			);
		}


		$this->add_control(
			'tabs',
			[
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					['tab_title' => esc_html__('Accordion Tab Title 1', JLTMA_TD)],
					['tab_title' => esc_html__('Accordion Tab Title 2', JLTMA_TD)],
					['tab_title' => esc_html__('Accordion Tab Title 3', JLTMA_TD)],
				],
				'fields' 				=> $repeater->get_controls(),
				'title_field'           => '{{tab_title}}',
			]
		);


		$this->add_control(
			'toggle_icon_show',
			[
				'label'                 => esc_html__('Show Active/Inactive Icon?', JLTMA_TD),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'separator'             => 'before',
				'label_on'              => __('Show', JLTMA_TD),
				'label_off'             => __('Hide', JLTMA_TD),
				'return_value'          => 'yes',
			]
		);


		$this->add_control(
			'toggle_speed',
			[
				'label'                 => esc_html__('Toggle Speed (ms)', JLTMA_TD),
				'type'                  => Controls_Manager::NUMBER,
				'label_block'           => false,
				'default'               => 300,
				'frontend_available'    => true,
				'condition'				=> [
					'toggle_icon_show' => 'yes'
				]
			]
		);


		$this->add_control(
			'title_html_tag',
			[
				'label'   => __('Title HTML Tag', JLTMA_TD),
				'type'    => Controls_Manager::SELECT,
				'options' => Master_Addons_Helper::jltma_title_tags(),
				'default' => 'div',
			]
		);



		$this->end_controls_section();



		/**
		 * Style Tab: Items
		 */
		$this->start_controls_section(
			'section_accordion_items_style',
			[
				'label'                 => esc_html__('Items', JLTMA_TD),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'accordion_items_spacing',
			[
				'label'                 => __('Spacing', JLTMA_TD),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' 	=> [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'               => [
					'size' 	=> '',
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'accordion_items_border',
				'label'                 => esc_html__('Border', JLTMA_TD),
				'selector'              => '{{WRAPPER}} .jltma-accordion-item',
			]
		);

		$this->add_responsive_control(
			'accordion_items_border_radius',
			[
				'label'                 => esc_html__('Border Radius', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'accordion_items_box_shadow',
				'selector'              => '{{WRAPPER}} .jltma-accordion-item',
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Title
		 */
		$this->start_controls_section(
			'section_title_style',
			[
				'label'                 => esc_html__('Title', JLTMA_TD),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('accordion_tabs_style');

		$this->start_controls_tab(
			'accordion_tab_normal',
			[
				'label'                 => __('Normal', JLTMA_TD),
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_bg_color',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'selector'  => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title'
			]
		);

		$this->add_control(
			'tab_title_text_color',
			[
				'label'                 => esc_html__('Text Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#333333',
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'tab_title_typography',
				'selector'              => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'tab_title_border',
				'label'                 => esc_html__('Border', JLTMA_TD),
				'selector'              => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title',
			]
		);

		$this->add_responsive_control(
			'jltma_accordion_border_radius',
			array(
				'label'      => esc_html__('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_tab_hover',
			[
				'label'                 => __('Hover', JLTMA_TD),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_bg_color_hover',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'selector'  => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title:hover'
			]
		);


		$this->add_control(
			'tab_title_text_color_hover',
			[
				'label'                 => esc_html__('Text Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title:hover,
						{{WRAPPER}} .jltma-accordion-item.ma-multicolor-accordion .jltma-accordion-tab-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_title_border_color_hover',
			[
				'label'                 => esc_html__('Border Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'tab_title_border_hover',
				'label'                 => esc_html__('Border', JLTMA_TD),
				'selector'              => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title:hover',
			]
		);

		$this->add_responsive_control(
			'jltma_accordion_border_radius_hover',
			array(
				'label'      => esc_html__('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_tab_active',
			[
				'label'                 => __('Active', JLTMA_TD),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_title_bg_color_active',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'selector'  => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-title.active'
			]
		);

		$this->add_control(
			'tab_title_text_color_active',
			[
				'label'                 => esc_html__('Text Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_title_border_color_active',
			[
				'label'                 => esc_html__('Border Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'tab_title_border_active',
				'label'                 => esc_html__('Border', JLTMA_TD),
				'selector'              => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active',
			]
		);

		$this->add_responsive_control(
			'jltma_accordion_border_radius_active',
			array(
				'label'      => esc_html__('Border Radius', JLTMA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name' => 'jltma_accordion_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title',
			)
		);


		$this->add_responsive_control(
			'jltma_accordion_box_padding',
			[
				'label'                 => esc_html__('Padding', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Content
		 */
		$this->start_controls_section(
			'section_content_style',
			[
				'label'                 => esc_html__('Content', JLTMA_TD),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_content_bg_color',
			[
				'label'                 => esc_html__('Background Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_content_text_color',
			[
				'label'                 => esc_html__('Text Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#333',
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content,
						{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'tab_content_typography',
				'selector'              => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content',
			]
		);

		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label'                 => esc_html__('Padding', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name' => 'tab_content_padding_text_shadow',
				'label' => __('Text Shadow', JLTMA_TD),
				'selector' => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item .jltma-accordion-tab-content',
			)
		);

		$this->end_controls_section();

		/**
		 * Style Tab
		 */
		$this->start_controls_section(
			'section_toggle_icon_style',
			[
				'label'                 => esc_html__('Toggle icon', JLTMA_TD),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'				=> [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_position',
			array(
				'label'       => __('Alignment', JLTMA_TD),
				'description' => __('Show Toggle Icon Position.', JLTMA_TD),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left' => array(
						'title' => __('Left', JLTMA_TD),
						'icon' => 'eicon-h-align-left',
					),
					'none' => array(
						'title' => __('None', JLTMA_TD),
						'icon' => 'eicon-ban',
					),
					'right' => array(
						'title' => __('Right', JLTMA_TD),
						'icon' => 'eicon-h-align-right',
					)
				),
				'default'     => 'right',
				'separator'   => 'after',
				'toggle'      => true,
				'selectors'   => array(
					'{{WRAPPER}} .jltma-advanced-image' => 'float: {{VALUE}};',
				)
			)
		);



		$this->start_controls_tabs('toggle_icons_style');

		$this->start_controls_tab(
			'toggle_icons_tab_expand',
			[
				'label'                 => __('Expand Icon', JLTMA_TD),
			]
		);

		$this->add_control(
			'active_icon',
			[
				'label'         	=> esc_html__('Expand Icon', JLTMA_TD),
				'show_label'  		=> false,
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'render_type'      	=> 'template',
				'default'       	=> [
					'value'     => 'fas fa-plus',
					'library'   => 'solid',
				],
				'include'               => [
					'fa fa-minus',
					'fa fa-minus-circle',
					'fa fa-minus-square-o',
					'fa fa-minus-square',
					'fa fa-search-minus',
					'fa fa-plus',
					'fa fa-plus-circle',
					'fa fa-plus-square-o',
					'fa fa-plus-square',
					'fa fa-search-plus',
					'fa fa-angle-right',
					'fa fa-angle-double-right',
					'fa fa-chevron-right',
					'fa fa-chevron-circle-right',
					'fa fa-arrow-right',
					'fa fa-long-arrow-right',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]

			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_icons_tab_collapse',
			[
				'label'                 => __('Collapse Icon', JLTMA_TD),
			]
		);

		$this->add_control(
			'toggle_icon',
			[
				'label'         	=> esc_html__('Collapse Icon', JLTMA_TD),
				'type'          	=> Controls_Manager::ICONS,
				'show_label'  		=> false,
				'fa4compatibility' 	=> 'icon',
				'render_type'      	=> 'template',
				'default'       	=> [
					'value'     => 'fas fa-minus',
					'library'   => 'solid',
				],
				'include'               => [
					'fa fa-minus',
					'fa fa-minus-circle',
					'fa fa-minus-square-o',
					'fa fa-minus-square',
					'fa fa-search-minus',
					'fa fa-plus',
					'fa fa-plus-circle',
					'fa fa-plus-square-o',
					'fa fa-plus-square',
					'fa fa-search-plus',
					'fa fa-angle-right',
					'fa fa-angle-double-right',
					'fa fa-chevron-right',
					'fa fa-chevron-circle-right',
					'fa fa-arrow-right',
					'fa fa-long-arrow-right',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]

			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();




		$this->add_control(
			'toggle_icons_color_heading',
			[
				'label'                 => __('Icon Settings', JLTMA_TD),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);
		$this->start_controls_tabs('toggle_icons_color_tabs');

		$this->start_controls_tab(
			'toggle_icons_color_normal',
			[
				'label'                 => __('Normal', JLTMA_TD),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'toggle_icon_bg',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				],
				'selector'	=> '.jltma-advanced-accordion .jltma-accordion-tab-title .jltma-accordion-toggle-icon'
			]
		);

		$this->add_control(
			'toggle_icon_color',
			[
				'label'                 => esc_html__('Icon Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '#444',
				'selectors'	=> [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_size',
			[
				'label'                 => __('Icon Size', JLTMA_TD),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'	=> 16,
					'unit'	=> 'px',
				],
				'size_units'            => ['px'],
				'range'	=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing',
			[
				'label'                 => __('Icon Spacing', JLTMA_TD),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => ['px'],
				'range'                 => [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors'             => [
					'{{WRAPPER}} .ma-accordion-icon-align-left .ma-accordion-tab-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ma-accordion-icon-align-right .ma-accordion-tab-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->add_responsive_control(
			'toggle_icon_padding',
			[
				'label'                 => esc_html__('Padding', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_icons_color_hover',
			[
				'label'                 => __('Hover', JLTMA_TD),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'toggle_icon_bg_color_hover',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'selector'  => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item:hover .jltma-accordion-tab-title .jltma-accordion-toggle-icon'
			]
		);

		$this->add_control(
			'toggle_icon_color_hover',
			[
				'label'                 => esc_html__('Icon Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item:hover .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_size_hover',
			[
				'label'                 => __('Icon Size', JLTMA_TD),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'	=> 16,
					'unit'	=> 'px',
				],
				'size_units'            => ['px'],
				'range'	=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item:hover .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_padding_hover',
			[
				'label'                 => esc_html__('Padding', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-item:hover .jltma-accordion-tab-title .jltma-accordion-toggle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_icons_color_active',
			[
				'label'                 => __('Active', JLTMA_TD),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'toggle_icon_bg_color_active',
				'label'     => esc_html__('Background Color', JLTMA_TD),
				'types'     => ['classic', 'gradient'],
				'exclude'   => ['image'],
				'selector'  => '{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active .jltma-accordion-toggle-icon'
			]
		);

		$this->add_control(
			'toggle_icon_color_active',
			[
				'label'                 => esc_html__('Icon Color', JLTMA_TD),
				'type'                  => Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active .jltma-accordion-toggle-icon' => 'color: {{VALUE}};'
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_size_active',
			[
				'label'                 => __('Icon Size', JLTMA_TD),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size'	=> 16,
					'unit'	=> 'px',
				],
				'size_units'            => ['px'],
				'range'	=> [
					'px'	=> [
						'min'	=> 0,
						'max'	=> 100,
						'step'	=> 1,
					]
				],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active .jltma-accordion-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'toggle_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_padding_active',
			[
				'label'                 => esc_html__('Padding', JLTMA_TD),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'selectors'             => [
					'{{WRAPPER}} .jltma-advanced-accordion .jltma-accordion-tab-title.active .jltma-accordion-toggle-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->end_controls_section();




		/**
		 * Content Tab: Docs Links
		 */
		$this->start_controls_section(
			'jltma_section_help_docs',
			[
				'label' => esc_html__('Help Docs', JLTMA_TD),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', JLTMA_TD), '<a href="https://master-addons.com/demos/advanced-accordion/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', JLTMA_TD), '<a href="https://master-addons.com/docs/addons/elementor-accordion-widget/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', JLTMA_TD), '<a href="https://www.youtube.com/watch?v=rdrqWa-tf6Q" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_upgrade_pro',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD)
				]
			);

			$this->add_control(
				'maad_el_control_get_pro',
				[
					'label' => esc_html__('Unlock more possibilities', JLTMA_TD),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}


		if (ma_el_fs()->is_not_paying()) {
			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', JLTMA_TD),
					'tab' => Controls_Manager::TAB_STYLE
				]
			);
			$this->add_control(
				'ma_el_control_get_pro_style_tab',
				[
					'label' => esc_html__('Unlock more possibilities', JLTMA_TD),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', JLTMA_TD),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);
			$this->end_controls_section();
		}
	}

	protected function render()
	{

		$settings	= $this->get_settings_for_display();
		$id_int		= substr($this->get_id_int(), 0, 3);

		$this->add_render_attribute('jltma-accordion', [
			'class'                 => 'jltma-advanced-accordion',
			'id'                    => 'jltma-advanced-accordion-' . esc_attr($this->get_id()),
			'data-accordion-id'     => esc_attr($this->get_id())
		]);

		$this->add_render_attribute([
			'jltma-accordion-wrap' => [
				'class'                 => [
					'ma-accordion-wrap',
					'ma-accordion-icon-align-' . $settings['toggle_icon_position'],
					'id'                    => 'ma-accordion-' . esc_attr($this->get_id())
				]
			]
		]);
?>

		<div <?php echo $this->get_render_attribute_string('jltma-accordion'); ?> <?php echo 'data-accordion-id="' . esc_attr($this->get_id()) . '"'; ?>>
			<div <?php echo $this->get_render_attribute_string('jltma-accordion-wrap'); ?>>

				<?php
				foreach ($settings['tabs'] as $index => $tab) {

					$tab_count = $index + 1;
					$tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
					$tab_content_setting_key = $this->get_repeater_setting_key('accordion_content', 'tabs', $index);

					$tab_title_class 	= ['jltma-accordion-tab-title jltma-accordion-header'];
					$tab_content_class 	= ['jltma-accordion-tab-content'];


					if ($tab['accordion_tab_default_active'] == 'yes') {
						$tab_title_class[] 		= 'active-default';
						$tab_content_class[] 	= 'active-default';
					}

					$this->add_render_attribute($tab_title_setting_key, [
						'id' 			=> 'jltma-accordion-tab-title-' . $id_int . $tab_count,
						'class' 		=> $tab_title_class,
						'tabindex' 		=> $id_int . $tab_count,
						'data-tab' 		=> $tab_count,
						'role' 			=> 'tab',
						'aria-controls' => 'jltma-accordion-tab-content-' . $id_int . $tab_count,
					]);

					$this->add_render_attribute($tab_content_setting_key, [
						'id' 				=> 'jltma-accordion-tab-content-' . $id_int . $tab_count,
						'class' 			=> $tab_content_class,
						'data-tab' 			=> $tab_count,
						'role' 				=> 'tabpanel',
						'aria-labelledby' 	=> 'jltma-accordion-tab-title-' . $id_int . $tab_count,
					]);


					if (ma_el_fs()->can_use_premium_code()) {
						if ($tab['single_tab_title_bg_color_show'] == 'yes') {
							$single_item_class = 'jltma-multicolor-accordion';
						}
					}
				?>

					<div class="jltma-accordion-item <?php echo isset($single_item_class) ? $single_item_class : ''; ?>">
						<<?php echo tag_escape($settings['title_html_tag']); ?> <?php echo $this->get_render_attribute_string($tab_title_setting_key);

																				// Premium Version Codes
																				if (ma_el_fs()->can_use_premium_code()) {

																					if ($tab['single_tab_title_bg_color_show'] == 'yes') { ?> style="background-color:<?php echo esc_attr($tab['single_tab_title_bg_color']); ?>;
                                    color:<?php echo esc_attr($tab['single_title_text_color']); ?>" <?php } // Premium Version Codes

																							} ?>>
							<div class="jltma-accordion-title-icon">

								<?php
								if ($settings['toggle_icon_show'] === 'yes' && ($settings['toggle_icon_position'] == "left")) {
									if ($tab['accordion_tab_icon_show'] === 'yes') { ?>
										<span class="jltma-accordion-toggle-icon jltma-accordion-tab-icon">
											<?php
											Master_Addons_Helper::jltma_fa_icon_picker('fas fa-minus', 'icon', $tab['accordion_tab_title_icon_collapse'], 'accordion_tab_title_icon_collapse', 'jltma-el-accordion-icon-closed');
											Master_Addons_Helper::jltma_fa_icon_picker('fas fa-plus', 'icon', $tab['accordion_tab_title_icon'], 'accordion_tab_title_icon', 'jltma-el-accordion-icon-opened');
											?>
										</span>
									<?php } else { ?>
										<span class="jltma-accordion-toggle-icon">
											<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-minus', 'icon', $settings['toggle_icon'], 'toggle_minus_icon', 'jltma-el-accordion-icon-closed');
											?>
											<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-plus', 'icon', $settings['active_icon'], 'toggle_active_icon', 'jltma-el-accordion-icon-opened');
											?>
										</span>
								<?php }
								} ?>

								<div class="jltma-accordion-title-text">
									<?php echo esc_html($tab['tab_title']); ?>
								</div>
							</div>

							<?php if ($settings['toggle_icon_show'] === 'yes' && ($settings['toggle_icon_position'] == "right")) {
								if ($tab['accordion_tab_icon_show'] === 'yes') { ?>
									<span class="jltma-accordion-toggle-icon jltma-accordion-tab-icon">
										<?php
										Master_Addons_Helper::jltma_fa_icon_picker('fas fa-minus', 'icon', $tab['accordion_tab_title_icon_collapse'], 'accordion_tab_title_icon_collapse', 'jltma-el-accordion-icon-closed');
										Master_Addons_Helper::jltma_fa_icon_picker('fas fa-plus', 'icon', $tab['accordion_tab_title_icon'], 'accordion_tab_title_icon', 'jltma-el-accordion-icon-opened');
										?>
									</span>
								<?php } else { ?>
									<span class="jltma-accordion-toggle-icon">
										<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-minus', 'icon', $settings['toggle_icon'], 'toggle_minus_icon', 'jltma-el-accordion-icon-closed');
										?>
										<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-plus', 'icon', $settings['active_icon'], 'toggle_active_icon', 'jltma-el-accordion-icon-opened');
										?>
									</span>
							<?php }
							} ?>

						</<?php echo tag_escape($settings['title_html_tag']); ?>>

						<div <?php echo $this->get_render_attribute_string($tab_content_setting_key);

								// Premium Version Codes
								if (ma_el_fs()->can_use_premium_code()) {

									if ($tab['single_tab_title_bg_color_show'] == 'yes') { ?> style="background-color:<?php echo $tab['single_tab_content_bg_color']; ?>;
                                                color:<?php echo $tab['single_title_content_color']; ?>" <?php } // Premium Version Codes

																									}
																											?>>
							<?php

							if (ma_el_fs()->can_use_premium_code()) {
								if ($tab['content_type'] == 'content') {

									echo do_shortcode($tab['accordion_content']);
								} else if ($tab['content_type'] == 'section' && !empty($tab['saved_section'])) {

									echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($tab['saved_section']);
								} else if ($tab['content_type'] == 'template' && !empty($tab['templates'])) {

									echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($tab['templates']);
								} else if ($tab['content_type'] == 'widget' && !empty($tab['saved_widget'])) {

									echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($tab['saved_widget']);
								}
							} else {
								if ($tab['content_type'] == 'content') {

									echo do_shortcode($tab['accordion_content']);
								}
							}
							?>
						</div>

					</div>
				<?php } ?>
			</div>
		</div>
<?php
	}

	public function get_page_template_options($type = '')
	{

		$page_templates = Master_Addons_Helper::ma_get_page_templates($type);

		$options[-1]   = __('Select', JLTMA_TD);

		if (count($page_templates)) {
			foreach ($page_templates as $id => $name) {
				$options[$id] = $name;
			}
		} else {
			$options['no_template'] = __('No saved templates found!', JLTMA_TD);
		}

		return $options;
	}
}
