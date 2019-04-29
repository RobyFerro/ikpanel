<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\calendar\app;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
	
	use SoftDeletes;
	
	protected $table = 'events';
	protected $primaryKey = 'id';
	protected $dates = ['start', 'end', 'created_at', 'updated_at', 'deleted_at'];
	
	public static function getEvents(Carbon $start, Carbon $end) {
		return self::whereDate('start', '>=', $start->toDateString())
			->whereDate('end', '<=', $end->toDateString())
			->get()->map(function($item) {
				return [
					"title"         => $item->title,
					"start"         => $item->start->toIso8601String(),
					"end"           => $item->end->toIso8601String(),
					"allDay"        => $item->all_day,
					"extendedProps" => [
						"content"  => $item->description ?? '',
						"location" => $item->location ?? ''
					]
				
				];
			});
	}
	
}
