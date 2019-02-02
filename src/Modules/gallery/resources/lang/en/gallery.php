<?php

return [
	'categories' => [
		'new'    => [
			"title"       => 'New category',
			"sectionName" => "New category",
			"inputs"      => [
				"categoryName"        => "Category name",
				"categoryDescription" => "Category description",
				"keywordsDescription" => "Keywords"
			]
		],
		'edit'   => [
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
		],
		'show'   => [
			"title"       => "Gallery categories",
			"sectionName" => "Gallery categories",
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
		"errors" => [
			'idRequired'        => 'Cannot update category without ID',
			'idExists'          => 'Missing category ID',
			'nameRequired'      => 'Name field is required',
			'nameMaxLength'     => 'Name field is too long',
			'keywordsMaxLength' => 'Keywords field is too long'
		]
	],
	'images'     => [
		'new'  => [
		
		],
		'edit' => [
		
		],
		'show' => [
		
		]
	]
];
