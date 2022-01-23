<?php

namespace MasterAddons\Modules\DynamicTags\Tags;

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class JLTMA_User_Info extends Tag
{

	public function get_name()
	{
		return 'jltma-user-info';
	}

	public function get_title()
	{
		return esc_html__('User Info', JLTMA_TD);
	}

	public function get_group()
	{
		return 'site';
	}

	public function get_categories()
	{
		return [TagsModule::TEXT_CATEGORY];
	}

	public function render()
	{
		$type = $this->get_settings('type');
		$user = wp_get_current_user();
		if (empty($type) || 0 === $user->ID) {
			return;
		}

		$value = '';
		switch ($type) {
			case 'login':
			case 'email':
			case 'url':
			case 'nicename':
				$field = 'user_' . $type;
				$value = isset($user->$field) ? $user->$field : '';
				break;
			case 'id':
			case 'description':
			case 'first_name':
			case 'last_name':
			case 'display_name':
				$value = isset($user->$type) ? $user->$type : '';
				break;
			case 'meta':
				$key = $this->get_settings('meta_key');
				if (!empty($key)) {
					$value = get_user_meta($user->ID, $key, true);
				}
				break;
		}

		echo wp_kses_post($value);
	}

	public function get_panel_template_setting_key()
	{
		return 'type';
	}

	protected function register_controls()
	{
		$this->add_control(
			'type',
			[
				'label' => esc_html__('Field', JLTMA_TD),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('Choose', JLTMA_TD),
					'id' => esc_html__('ID', JLTMA_TD),
					'display_name' => esc_html__('Display Name', JLTMA_TD),
					'login' => esc_html__('Username', JLTMA_TD),
					'first_name' => esc_html__('First Name', JLTMA_TD),
					'last_name' => esc_html__('Last Name', JLTMA_TD),
					'description' => esc_html__('Bio', JLTMA_TD),
					'email' => esc_html__('Email', JLTMA_TD),
					'url' => esc_html__('Website', JLTMA_TD),
					'meta' => esc_html__('User Meta', JLTMA_TD),
				],
			]
		);

		$this->add_control(
			'meta_key',
			[
				'label' => esc_html__('Meta Key', JLTMA_TD),
				'condition' => [
					'type' => 'meta',
				],
			]
		);
	}
}
