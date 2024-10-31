<?php
class SlitScale
{
	public function __construct()
	{
		add_action( 'admin_init', array($this, 'slit_settings_api_init') );
	}

	function slit_settings_api_init() {
		add_settings_section(
			'slit_setting_section',
			'Set threshold limit when to scale down image',
			array($this, 'slit_setting_section_callback_function'),
			'media'
		);

		add_settings_field(
			'slit_image_threshold',
			'Image scaling threshold',
			array($this, 'slit_setting_callback_function_threshold'),
			'media',
			'slit_setting_section'
		);

		add_settings_field(
			'slit_image_threshold_disable',
			'Disable large image scaling',
			array($this, 'slit_setting_callback_function_disable_threshold'),
			'media',
			'slit_setting_section'
		);

		register_setting( 'media', 'slit_image_threshold' );
		register_setting( 'media', 'slit_image_threshold_disable' );
	}

	function slit_setting_callback_function_threshold() {
		echo '<input name="slit_image_threshold" type="number" step="1" min="0" id="slit_image_threshold" value="'. get_option( 'slit_image_threshold' ) . '" class="small-text" />';
	}

	function slit_setting_callback_function_disable_threshold() {
		echo '<input name="slit_image_threshold_disable" id="slit_image_threshold_disable" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'slit_image_threshold_disable' ), false ) . ' />';
	}

	function slit_setting_section_callback_function() {
		echo '<p>When you will upload very large images, you can force scale it down based on your limit set. If images hit this limit, it will be automatically scaled down for you. Set your threshold now for large images.</p>';
	}
}
