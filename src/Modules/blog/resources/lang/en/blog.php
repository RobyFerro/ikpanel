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
		],
		"edit" => [
			"title"       => 'Edit category',
			"sectionName" => "Edit category",
			"inputs"      => [
				"categoryName"        => "Category name",
				"categoryDescription" => "Category description",
				"keywordsDescription" => "Keywords"
			],
			"buttons"     => [
				"delete" => "Delete category"
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