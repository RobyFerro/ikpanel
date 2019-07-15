<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 30/04/2019
 * Time: 11:15
 */

namespace ikdev\ikpanel\App\Rules;


use Illuminate\Contracts\Validation\Rule;

class IsAfterOrEqualDailyHours implements Rule {
	
	protected $compare;
	protected $comparedLabel;
	
	public function __construct($compare, $label) {
		$this->compare = $compare;
		$this->comparedLabel = $label;
	}
	
	public function passes($attribute, $value) {
		return strtotime($value) >= strtotime($this->compare);
	}
	
	public function message() {
		return "The field :attribute must be after or equal to {$this->comparedLabel}";
	}
}
