<?php

return [
	"show" => [
		"title"         => "View errors",
		"section-name"  => "View errors",
		"card_title"    => "What's happening?",
		"table"         => [
			"type"         => "Locations",
			"exception"    => "Details",
			"created_date" => "Created date",
			"no_rows"      => "Congrats! There's no exceptions!",
			"ip_address"   => "IP"
		],
		"status_filter" => [
			"label"   => "Status filter",
			"options" => [
				"resolved" => "Fixed errors",
				"active"   => "Active exceptions",
				"deleted"  => "Deleted errors",
				"all"      => "All errors"
			]
		]
	],
	"edit" => [
		"title"          => "Show exception",
		"section-name"   => "Show exception",
		"ip_address"     => "IP address:",
		"reported_at"    => "Reported at:",
		"exception_type" => "Error type:",
		"user_agent"     => "User agent:",
		"first_seen"     => "First seen:",
		"last_seen"      => "Last seen:",
		"fixed_at"       => "Fixed at:",
		"assign_to"      => "Assign to:",
		"buttons"        => [
			"resolve" => "Resolve this error",
			"delete"  => "Remove",
		]
	]
];
