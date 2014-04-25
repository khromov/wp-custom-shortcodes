<?php
vc_map(array(
	"name" => "Show authors",
	"base" => "show_authors",
	"description" => "Shows authors",
	"show_settings_on_create" => true,
	"class" => "vc-show-author-block",
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => 'Order',
			"param_name" => "order",
			"value" => array(
				'Ascending' => 'ASC',
				'Descending' => 'DESC'
			),
			"std" => "ASC",
			"description" => 'Choose sort order',
			"admin_label" => true
		)),
	"icon" => "show_authors"
));