<?php
/**
 * Adds all shortcode CSS and JS files to MinQueue list
 */
add_filter('option_minqueue_options', function($value)
{
	//This makes it impossible to disable CSS minification
	//$value['styles_method'] = 'manual';
	//$value['scripts_method'] = 'manual';

	//Styles
	if(!isset($value['styles_manual']))
		$value['styles_manual'] = array();

	//Scripts
	if(!isset($value['scripts_manual']))
		$value['scripts_manual'] = array();

	$vc_shortcodes_styles = array();
	$vc_shortcodes_scripts = array();

	//Shortcodes CSS folder
	foreach(glob(__DIR__ . "/../shortcodes/css/*.css") as $filename)
		$vc_shortcodes_styles[] = CS_Enqueue_Slug . '_css_' . basename($filename, '.css');

	//Shortcodes JS folder
	foreach(glob(__DIR__ . "/../shortcodes/js/*.js") as $filename)
		$vc_shortcodes_scripts[] = CS_Enqueue_Slug . '_js_' . basename($filename, '.js');

	$value['styles_manual'][] = $vc_shortcodes_styles;
	$value['scripts_manual'][] = $vc_shortcodes_scripts;

	return $value;
});