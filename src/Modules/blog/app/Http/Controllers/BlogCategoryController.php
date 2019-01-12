<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 07/01/2019
 * Time: 15:53
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use ikdev\ikpanel\Modules\blog\app\Categories;
use Illuminate\Routing\Controller;

class BlogCategoryController extends Controller {
	
	public function show() {
		return view('ikpanel-blog::categories.show')
			->with(['categories' => $this->getAllCategories()]);
	}
	
	public function getAllCategories() {
		return Categories::all();
	}
	
}