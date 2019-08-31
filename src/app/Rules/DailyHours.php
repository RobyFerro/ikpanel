<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 30/04/2019
 * Time: 11:01
 */

namespace ikdev\ikpanel\App\Rules;


use Illuminate\Contracts\Validation\Rule;

class DailyHours implements Rule
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
        return strtotime($value);
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must be a valid daily hour";
    }
}
