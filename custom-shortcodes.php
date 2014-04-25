<?php
/*
Plugin Name: Custom Shortcodes
Plugin URI:
Description: Provides additional shortcodes
Version: 2014.04.24
Author: khromov
Author URI: http://profiles.wordpress.org/khromov/
License: GPL2
*/

/**
 * Define our text domain
 *
 * MO file example name:
 * languages/Custom_Shortcodes_TextDomain-en_US.mo
 */
const CS_TextDomain = 'Custom_Shortcodes_TextDomain';
const CS_Enqueue_Slug = 'custom_shortcodes';

/** Load plugin translations **/
add_action('plugins_loaded', function()
{
	load_plugin_textdomain(CS_TextDomain, false, basename(dirname(__FILE__)) . '/languages');
});

/** Include our libraries **/
add_action('plugins_loaded', function()
{
	foreach (glob(__DIR__ . "/includes/*.php") as $filename)
		include $filename;
});

/** Load shortcodes **/
add_action('after_setup_theme', function()
{
	foreach (glob(__DIR__ . "/shortcodes/*.php") as $filename)
		include $filename;
});

/** Load shortcode scripts and styles **/
add_action('wp_enqueue_scripts', function()
{
	//Shortcodes folder
	foreach(glob(__DIR__ . "/shortcodes/css/*.css") as $filename)
		wp_enqueue_style(CS_Enqueue_Slug . '_css_' . basename($filename, '.css'), plugins_url('shortcodes/css/' . basename($filename), __FILE__));

	foreach(glob(__DIR__ . "/shortcodes/js/*.js") as $filename)
		wp_enqueue_script(CS_Enqueue_Slug . '_js_' . basename($filename, '.js'), plugins_url('shortcodes/js/' . basename($filename), __FILE__), array('jquery'), false, true);
});

/** Load admin side scripts and styles **/
add_action('admin_enqueue_scripts', function()
{
	foreach(glob(__DIR__ . "/mappings/css/*.css") as $filename)
		wp_enqueue_style(CS_Enqueue_Slug . '_admin_css_' . basename($filename, '.css'), plugins_url('mappings/css/' . basename($filename), __FILE__));

	foreach(glob(__DIR__ . "/mappings/js/*.js") as $filename)
		wp_enqueue_script(CS_Enqueue_Slug . '_admin_js_' . basename($filename, '.js'), plugins_url('mappings/js/' . basename($filename), __FILE__), array('jquery'), false, true);
});

/** Visual Composer mappings **/
add_action('init', function()
{
	global $pagenow;
	if(function_exists('vc_map') && is_admin() && $pagenow === 'post.php' || $pagenow === 'admin-ajax.php' || $pagenow === 'post-new.php') //Only load in admin mode on posts page. Will probably screw up frontend editor.
	{
		foreach (glob(__DIR__ . "/mappings/*.php") as $filename)
			include $filename;
	}
}, 9); //Show our custom shortcodes first in the list