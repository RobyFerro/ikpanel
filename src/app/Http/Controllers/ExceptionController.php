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
	protected $itemInPage;
	
	public function __construct(Errors $errors) {
		$this->errors = $errors;
		$this->itemInPage = 10;
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
	 * @return Factory|View
	 */
	public function show() {
		return view('ikpanel::exception.show')->with([
			'exceptions' => $this->errors->orderByDesc('id')->paginate($this->itemInPage)
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
	
	/**
	 * Obtain exception collection instead of filter
	 * @param Request $request
	 * @param string $filter
	 * @return Errors | null
	 */
	public function filter(Request $request, $filter = 'active') {
		
		switch ($filter) {
			case 'active':
				return $this->errors->whereNull('fixed_at')->orderByDesc('id')->paginate($this->itemInPage);
				break;
			case 'all':
				return $this->errors->withTrashed()->orderByDesc('id')->paginate($this->itemInPage);
				break;
			case 'deleted':
				return $this->errors->onlyTrashed()->orderByDesc('id')->paginate($this->itemInPage);
				break;
			case 'resolved':
				return $this->errors->whereNotNull('fixed_at')->orderByDesc('id')->paginate($this->itemInPage);
				break;
			default:
				return null;
				break;
		}
	}
	
}
