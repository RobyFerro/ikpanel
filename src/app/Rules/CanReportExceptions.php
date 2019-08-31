<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 08/04/2019
 * Time: 11:31
 */

namespace ikdev\ikpanel\App\Rules;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CanReportExceptions implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value) {
            return Auth::user()->hasToken('SHOW_EXCEPTIONS');
        } else {
            return true;
        }
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You can't enable exceptions reports for your user!";
    }
}
