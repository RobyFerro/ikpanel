<?php

namespace ikdev\ikpanel\App\Http\Controllers;

use ikdev\ikpanel\app\Logs;
use Illuminate\Routing\Controller as BaseController;

class LogsController extends BaseController
{
	/**
	 * Carica la vista con una lista di tutti log
	 * @return $this
	 * @throws \Exception
	 */
	public function show() {
		
		Logs::info('Ha visualizzato la vista "Logs"');
		
		$mod_logs=new Logs();
		$logs=$mod_logs
			->with('user')
			->orderByDesc('logs.date')
			->get();
		
		return view('ikpanel::logs.show')->with([
			'logs' => $logs
		]);
	}
}
