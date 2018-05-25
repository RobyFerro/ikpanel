<?php
/**
 * Created by PhpStorm.
 * User: ikdev.macbook
 * Date: 21/04/18
 * Time: 13:25
 */
namespace ecit\admin_panel\App\Http\Controllers;

use ecit\admin_panel\app\Users;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use ecit\admin_panel\app\Menu;
use Illuminate\Support\Facades\Auth;

class EcitPanelController extends BaseController
{

    public static function getUserMenu(){
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
                ->whereIn('id_token', $active_token)
                ->with(['children' => function($query) use ($active_token){
                    $query->whereIn('id_token', $active_token)
                        ->orWhereNull('id_token');
                }])
                ->get();
        } catch (QueryException $e) {
            throw $e;
        } // try

        return $menu_items;

	}



}