<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 11:03
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use Carbon\Carbon;
use ikdev\ikpanel\app\Errors;
use ikdev\ikpanel\app\Facades\PanelException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExceptionController extends BaseController {
	
	/**
	 * @var Errors
	 */
	protected $errors;
	
	public function __construct(Errors $errors) {
		$this->errors = $errors;
	}
	
	/**
	 * Report front end exception
	 * @param Request $request
	 */
	public function reportFrontEndException(Request $request) {
		PanelException::report($request->get('exception'), 'front');
	}
	
	/**
	 * Show all reported exceptions
	 * @param string $filter
	 * @return Factory|View
	 */
	public function show($filter = 'active') {
		
		switch ($filter) {
			case 'active':
				$exceptions = $this->errors->whereNull('fixed_at')->orderByDesc('id')->paginate();
				break;
			case 'all':
				$exceptions = $this->errors->withTrashed()->orderByDesc('id')->paginate();
				break;
			case 'deleted':
				$exceptions = $this->errors->onlyTrashed()->orderByDesc('id')->paginate();
				break;
			case 'resolved':
				$exceptions = $this->errors->whereNotNull('fixed_at')->orderByDesc('id')->paginate();
				break;
			default:
				return null;
				break;
		}
		
		return view('ikpanel::exception.show')->with([
			'exceptions' => $exceptions,
			'filter'     => $filter
		]);
	}
	
	/**
	 * Show single exception
	 * @param $id
	 * @return Factory|View
	 */
	public function edit($id) {
		$error = $this->errors->withTrashed()->find($id);
		is_null($error->first_seen) ? $error->first_seen = Carbon::now() : null;
		
		$error->last_seen = Carbon::now();
		$error->save();
		
		return view('ikpanel::exception.edit')->with([
			'exception' => $error,
			'stack'     => $error->exception
		]);
	}
	
	/**
	 * Resolve specific error
	 * @param Request $request
	 * @return Carbon
	 */
	public function resolve(Request $request) {
		$fixedDate = Carbon::now();
		
		$error = $this->errors->find($request->get('id'));
		$error->fixed_at = $fixedDate;
		$error->fixed_by = Auth::id();
		$error->save();
		
		return $fixedDate;
	}
	
	/**
	 * Remove specific exception
	 * @param Request $request
	 */
	public function remove(Request $request) {
		$this->errors->find($request->get('id'))->delete();
	}
	
	public function restore(Request $request) {
		$this->errors->withTrashed()->find($request->id)->restore();
	}
	
}
