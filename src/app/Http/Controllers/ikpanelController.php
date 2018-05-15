<?php
/**
 * Created by PhpStorm.
 * User: ikdev.macbook
 * Date: 21/04/18
 * Time: 13:25
 */
namespace ikdev\ikpanel\App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use ikdev\ikpanel\app\Menu;

class ikpanelController extends BaseController
{
    /**
     * Ottengo tutte le voci di menu
     * @return mixed
     */
    public static function getNavigationMenu(){
	    $mod_menu = new Menu();

        try {
            $voci = $mod_menu
                ->whereNull('relation')
                ->with('sub_level')
                ->get();
        } catch (QueryException $e) {
            throw $e;
        } // try

        return $voci;

    }
    public function setError($message) {
        header('HTTP/1.1 422 Unprocessable Entity');
        header('Content-Type: application/json; charset=UTF-8');

        $message = [
            "message" => $message
        ];

        die(json_encode($message));
    }

}