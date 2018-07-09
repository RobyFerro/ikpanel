<?php
/**
 * Created by PhpStorm.
 * User: ikdev.macbook
 * Date: 21/04/18
 * Time: 13:25
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use ikdev\ikpanel\app\Users;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use ikdev\ikpanel\app\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ikpanelController extends BaseController {
	
	/**
	 * Restituisce il contenuto del menu a seconda dell'utente
	 * @return mixed
	 */
	public static function getUserMenu() {
		/** @var Users $current_user */
		$mod_menu = new Menu();
		
		try {
			$active_token = Auth::user()
				->user_role
				->token()
				->pluck('id')
				->toArray();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		try {
			$menu_items = $mod_menu
				->whereNull('relation')
				->where(function($query) use ($active_token) {
					$query->whereIn('id_token', $active_token)
						->orWhereNull('id_token');
				})
				->with(['children' => function($query) use ($active_token) {
					$query->whereIn('id_token', $active_token)
						->orWhereNull('id_token');
				}])
				->get();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		foreach ($menu_items as $key => &$item) {
			
			if (is_null($item->route) && is_null($item->relation)) {
				if (count($item->children) == 0) {
					unset($menu_items[$key]);
				} // if
			} // if
			
		} // foreach
		
		return $menu_items;
		
	}
	
	/**
	 * Carica la vista Home
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function home(){
        return view('ikpanel::home');
    }
}