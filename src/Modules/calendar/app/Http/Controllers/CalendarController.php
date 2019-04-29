<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\calendar\app\Http\Controllers;

use Carbon\Carbon;
use ikdev\ikpanel\Modules\calendar\app\Event;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CalendarController extends Controller {
	
	protected $events;
	
	public function __construct(Event $event) {
		$this->events = $event;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return view('ikpanel-calendar::calendar');
	}
	
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request) {
		$data = $request->get('data');
		
		if($data['startTime'] === 'Invalid date'){
			$data['startTime'] = '00:00';
		}
		
		if($data['stopTime'] === 'Invalid date'){
			$data['stopTime'] = '00:00';
		}
		
		$start = Carbon::createFromFormat('d/m/Y H:i', $data['date'] . ' ' . $data['startTime']);
		$stop = Carbon::createFromFormat('d/m/Y H:i', $data['date'] . ' ' . $data['stopTime']);
		
		
		try {
			$event = $this->events;
			$event->start = $start;
			$event->end = $stop;
			$event->all_day = $data['allDay'];
			$event->title = $data['title'];
			$event->description = $data['content'];
			$event->location = $data['location'];
			$event->save();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return response($event);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$data = $request->get('data');
		
		if($data['startTime'] === 'Invalid date'){
			$data['startTime'] = '00:00';
		}
		
		if($data['stopTime'] === 'Invalid date'){
			$data['stopTime'] = '00:00';
		}
		
		$start = Carbon::createFromFormat('d/m/Y H:i', $data['date'] . ' ' . $data['startTime']);
		$stop = Carbon::createFromFormat('d/m/Y H:i', $data['date'] . ' ' . $data['stopTime']);
		
		try {
			$event = $this->events->find($id);
			$event->start = $start;
			$event->end = $stop;
			$event->all_day = $data['allDay'];
			$event->title = $data['title'];
			$event->description = $data['content'];
			$event->location = $data['location'];
			$event->save();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return response($event);
		
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return void
	 */
	public function destroy($id) {
		//
	}
	
	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function getEvents(Request $request) {
		return Event::getEvents(
			Carbon::parse($request->get('start')),
			Carbon::parse($request->get('end'))
		);
	}
}
