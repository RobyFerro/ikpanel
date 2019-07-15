<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

return [
	"show" => [
		'title'        => 'Manage users',
		'filter_label' => "Filter for status",
		'breadcrumb'   => 'Manage users',
		'buttons'      => [
			'new'     => 'New user',
			'close'   => 'Close',
			'edit'    => 'Edit',
			'delete'  => 'Delete',
			'restore' => 'Restore'
		],
		'search'       => 'Search',
		'table'        => [
			'name'    => 'Name',
			'surname' => 'Surname',
			'email'   => 'E-Mail',
			'status'  => 'Status',
			'actions' => 'Actions'
		],
		'filters'      => [
			'all'     => 'All',
			'active'  => 'Active',
			'deleted' => 'Deleted'
		]
	],
	'edit' => [
		'title'      => 'Edit user',
		'breadcrumb' => 'Edit user',
		'buttons'    => [
			'save'       => 'Save',
			'save-close' => 'Save & Close',
			'close'      => 'Close'
		],
		'inputs'     => [
			'name'              => 'Name',
			'surname'           => 'Surname',
			'email'             => 'E-mail',
			'password'          => 'Password',
			'repeat-password'   => 'Repeat password',
			'role'              => 'Role',
			'avatar'            => 'Avatar',
			"report-exceptions" => "Send all exception reports"
		],
		'card'       => [
			'general' => [
				'title' => 'General'
			]
		]
	]
];
