<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 07/01/2019
 * Time: 15:53
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use ikdev\ikpanel\Modules\blog\app\Categories;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;

class BlogCategoryController extends Controller {
	
	public function show() {
		return view('ikpanel-blog::categories.show')
			->with(['categories' => $this->getAllCategories()]);
	}
	
	public function getFilteredItems($filter) {
		return $this->getAllCategories($filter);
	}
	
	/**
	 * @param null $filter
	 * @return Categories[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getAllCategories($filter = null) {
		
		if (is_null($filter)) {
			return Categories::all();
		} else {
			$categories = new Categories();
			
			switch ($filter) {
				case 'ALL':
					try {
						$data = $categories->withTrashed()
							->get();
					} catch (QueryException $e) {
						throw $e;
					} // try
					break;
				case 'ACTIVE':
					try {
						$data = $categories->all();
					} catch (QueryException $e) {
						throw $e;
					} // try
					break;
				case 'DELETED':
					try {
						$data = $categories->onlyTrashed()
							->get();
					} catch (QueryException $e) {
						throw $e;
					} // try
					
					break;
			} // switch
			
			return view('ikpanel-blog::categories.table')->with([
				'categories' => $data
			]);
			
		} // if
		
	}
	
}