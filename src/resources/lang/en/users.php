<?php

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
			'name'            => 'Name',
			'surname'         => 'Surname',
			'email'           => 'E-mail',
			'password'        => 'Password',
			'repeat-password' => 'Repeat password',
			'role'            => 'Role',
			'avatar'          => 'Avatar'
		],
		'card'       => [
			'general' => [
				'title' => 'General'
			]
		]
	]
];