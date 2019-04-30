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
use ikdev\ikpanel\Modules\calendar\app\Http\Requests\EventRequest;
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
	 * @param EventRequest $request
	 * @return Response
	 */
	public function store(EventRequest $request) {
		
		$start = Carbon::createFromFormat(
			'd/m/Y H:i',
			$request->get('date') . ' ' . $request->get('startTime'));
		$stop = Carbon::createFromFormat(
			'd/m/Y H:i',
			$request->get('date') . ' ' . $request->get('stopTime'));
		
		try {
			$event = $this->events;
			$event->start = $start;
			$event->end = $stop;
			$event->all_day = $request->get('allDay');
			$event->title = $request->get('title');
			$event->description = $request->get('content');
			$event->location = $request->get('location');
			$event->save();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return response($event);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param EventRequest $request
	 * @param int $id
	 * @return Response
	 */
	public function update(EventRequest $request, $id) {
		
		$start = Carbon::createFromFormat(
			'd/m/Y H:i',
			$request->get('date') . ' ' . $request->get('startTime'));
		$stop = Carbon::createFromFormat(
			'd/m/Y H:i',
			$request->get('date') . ' ' . $request->get('stopTime'));
		
		try {
			$event = $this->events->find($id);
			$event->start = $start;
			$event->end = $stop;
			$event->all_day = $request->get('allDay');
			$event->title = $request->get('title');
			$event->description = $request->get('content');
			$event->location = $request->get('location');
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
