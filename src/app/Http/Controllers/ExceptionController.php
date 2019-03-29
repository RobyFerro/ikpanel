<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 11:03
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use ikdev\ikpanel\app\Errors;
use ikdev\ikpanel\app\Facades\PanelException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class ExceptionController extends BaseController {
	
	/**
	 * Report front end exception
	 * @param Request $request
	 */
	public function reportFrontEndException(Request $request) {
		PanelException::report($request->get('exception'), 'front');
	}
	
	/**
	 * @return Factory|View
	 */
	public function show() {
		return view('ikpanel::exception.show')->with([
			'exceptions' => Errors::orderByDesc('id')->paginate(10)
		]);
	}
	
}
