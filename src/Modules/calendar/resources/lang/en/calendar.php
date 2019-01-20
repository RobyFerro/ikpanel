<?php

return [
	"show" => [
		"sectionName"        => "Calendar",
		"titleName"          => "Calendar",
		"contentTitle"       => 'Manage events',
		"newEventModalTitle" => "Create new event",
		"buttons"            => [
			"closeEventModal" => "Close",
			"saveEventModal"  => "Save",
			"newEvent"        => "New event",
			"close"           => "Close"
		],
		"modal"              => [
			"title"        => "Details",
			"placeholders" => [
				"eventName"    => "Event name",
				"location"     => "Location",
				"eventContent" => 'Notes'
			],
			"labels"       => [
				"startDate" => "Start at:",
				"endDate"   => "End:",
				"allDay"    => "All day",
				"people"    => "People"
			],
			"options"      => [
				"users"  => "Users",
				"custom" => "Custom"
			],
			"buttons"      => [
				"close"  => 'Close',
				"delete" => 'Delete',
				"save"   => 'Save'
			]
		]
	]
];
