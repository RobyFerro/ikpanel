<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

return [
    'categories' => [
        'new' => [
            "title" => 'New category',
            "sectionName" => "New category",
            "inputs" => [
                "categoryName" => "Category name",
                "categoryDescription" => "Category description",
                "keywordsDescription" => "Keywords"
            ]
        ],
        'edit' => [
            "title" => 'Edit category',
            "sectionName" => "Edit category",
            "inputs" => [
                "categoryName" => "Category name",
                "categoryDescription" => "Category description",
                "keywordsDescription" => "Keywords"
            ],
            "buttons" => [
                "delete" => "Delete category"
            ]
        ],
        'show' => [
            "title" => "Gallery categories",
            "sectionName" => "Gallery categories",
            "table" => [
                "name" => "Name",
                "description" => "Description",
            ],
            "buttons" => [
                "new" => "New category",
                "close" => "Close",
                "actionDelete" => "Delete",
                "actionRestore" => "Restore",
                "actionEdit" => "Edit"
            ],
            "search" => "Search",
            'filterLabel' => "Filter for status",
            'filters' => [
                'all' => 'All',
                'active' => 'Active',
                'deleted' => 'Deleted'
            ]
        ],
        "errors" => [
            'idRequired' => 'Cannot update category without ID',
            'idExists' => 'Missing category ID',
            'nameRequired' => 'Name field is required',
            'nameMaxLength' => 'Name field is too long',
            'keywordsMaxLength' => 'Keywords field is too long'
        ]
    ],
    'images' => [
        "show" => [
            "title" => "Images",
            "sectionName" => "Images",
            "table" => [
                "name" => "Name",
                "description" => "Description",
                "image" => 'Image preview',
                "categories" => "Categories"
            ],
            "buttons" => [
                "new" => "New image",
                "close" => "Close",
                "actionDelete" => "Delete",
                "actionRestore" => "Restore",
                "actionEdit" => "Edit"
            ],
            "search" => "Search",
            'filterLabel' => "Filter for status",
            'filters' => [
                'all' => 'All',
                'active' => 'Active',
                'deleted' => 'Deleted'
            ]
        ],
        "edit" => [
            "title" => 'Edit image',
            "sectionName" => "Edit image",
            "inputs" => [
                "title" => "Title",
                "description" => "Image description",
                "keywords" => "Keywords",
                "categories" => "Categories",
                "pic" => "Picture"
            ],
            "buttons" => [
                "delete" => "Delete article"
            ],
            "errors" => [
                "titleRequired" => 'Title field is required',
                "contentRequired" => 'Content field is required',
                "ownerRequired" => 'Author field is required',
                "ownerExist" => "Author does not exist",
                'keywordsMaxLength' => 'Keywords field is too long',
                'mainPicWrongMime' => 'Image type is not supported'
            ]
        ],
        "new" => [
            "title" => 'New image',
            "sectionName" => "New image",
            "inputs" => [
                "title" => "Title",
                "description" => "Image description",
                "keywords" => "Keywords",
                "categories" => "Categories",
                "pic" => "Picture"
            ],
            "errors" => [
                "titleRequired" => 'Title field is required',
                "titleMaxLength" => 'Title is too long',
                "contentRequired" => 'Content field is required',
                "ownerRequired" => 'Author field is required',
                "ownerExist" => "Author does not exist",
                'keywordsMaxLength' => 'Keywords field is too long',
                'mainPicWrongMime' => 'Image type is not supported'
            ]
        ]
    ]
];
