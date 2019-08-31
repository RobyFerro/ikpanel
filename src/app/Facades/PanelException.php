<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 20/03/2019
 * Time: 19:06
 */

namespace ikdev\ikpanel\app\Facades;

use Illuminate\Support\Facades\Facade;

class PanelException extends Facade
{
    
    protected static function getFacadeAccessor()
    {
        return 'PanelException';
    }
    
}
