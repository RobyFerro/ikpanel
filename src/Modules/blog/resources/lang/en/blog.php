<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

return [
	"categories" => [
		"show"   => [
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
		"edit"   => [
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
		"new"    => [
			"title"       => 'New category',
			"sectionName" => "New category",
			"inputs"      => [
				"categoryName"        => "Category name",
				"categoryDescription" => "Category description",
				"keywordsDescription" => "Keywords"
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
	"articles"   => [
		"show" => [
			"title"       => "Articles",
			"sectionName" => "Articles",
			"table"       => [
				"title"       => "Title",
				"description" => "Description",
				"publishDate" => 'Publish date',
				"categories"  => "Categories",
				"author"      => "Author"
			],
			"buttons"     => [
				"new"           => "New article",
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
			"title"       => 'Edit article',
			"sectionName" => "Edit article",
			"inputs"      => [
				"title"            => "Title",
				"shortDescription" => "Short description",
				"content"          => "Article content",
				"keywords"         => "Keywords",
				"categories"       => "Categories",
				"ownerLabel"       => "Author",
				"ownerAlias"       => "Author alias",
				"authorList"       => "Authors",
				"mainPic"          => "Main picture"
			],
			"buttons"     => [
				"delete" => "Delete article"
			],
			"errors"      => [
				"titleRequired"     => 'Title field is required',
				"contentRequired"   => 'Content field is required',
				"ownerRequired"     => 'Author field is required',
				"ownerExist"        => "Author does not exist",
				'keywordsMaxLength' => 'Keywords field is too long',
				'mainPicWrongMime'  => 'Image type is not supported'
			]
		],
		"new"  => [
			"title"       => 'New article',
			"sectionName" => "New article",
			"inputs"      => [
				"title"            => "Title",
				"shortDescription" => "Short description",
				"content"          => "Article content",
				"keywords"         => "Keywords",
				"categories"       => "Categories",
				"ownerLabel"       => "Author",
				"ownerAlias"       => "Author alias",
				"authorList"       => "Authors",
				"mainPic"          => "Main picture"
			],
			"errors"      => [
				"titleRequired"     => 'Title field is required',
				"titleMaxLength"    => 'Title is too long',
				"contentRequired"   => 'Content field is required',
				"ownerRequired"     => 'Author field is required',
				"ownerExist"        => "Author does not exist",
				'keywordsMaxLength' => 'Keywords field is too long',
				'mainPicWrongMime'  => 'Image type is not supported'
			]
		]
	]
];
