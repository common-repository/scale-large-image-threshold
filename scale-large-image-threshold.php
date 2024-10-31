<?php
/*
Plugin Name:  Scale Large Image Threshold
Plugin URI:   https://developer.wordpress.org/plugins/scale-large-image-threshold
Description:  Control scaling of big images in Wordpress using big_image_size_threshold filter. Image will be scaled forcefully when it will reach this threshold. Useful to control large images in Wordpress.
Version:      1.2
Author:       Shaharia Azam <mail@shaharia.com>
Author URI:   http://www.shaharia.com?utm_source=scale-large-image-threshold
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  scale-large-image-threshold
*/

if( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if(is_admin()){
	require __DIR__ . DIRECTORY_SEPARATOR . "SlitScale.php";
	new SlitScale();

	$threshold = get_option("slit_image_threshold");
	$thresholdDisabled = get_option("slit_image_threshold_disable", '');

	if(intval($thresholdDisabled) === 1){
		add_filter( 'big_image_size_threshold', '__return_false' );
	}

	if(!empty($threshold) && intval($threshold) > 0){
		add_filter("big_image_size_threshold", function () use ($threshold) {
			return intval($threshold);
		});
	}
}
