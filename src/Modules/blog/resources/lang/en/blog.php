<?php

return [
	"categories" => [
		"show" => [
			"title"       => "Categories",
			"sectionName" => "Categories",
			"table"       => [
				"name"        => "Name",
				"description" => "Description",
			],
			"buttons"     => [
				"new"           => "New category",
				"close"         => "Close",
				"actionDelete"  => "Delete",
				"actionRestore" => "Restore",
				"actionEdit"    => "Edit"
			],
			"search"      => "Search",
			'filterLabel' => "Filter for status",
			'filters'     => [
				'all'     => 'All',
				'active'  => 'Active',
				'deleted' => 'Deleted'
			]
		]
	],
	"articles"   => [
		"show" => [
			"title"       => "Articles",
			"sectionName" => "Articles",
		]
	]
];