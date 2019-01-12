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
	
	/**
	 * Show category list
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show() {
		return view('ikpanel-blog::categories.show')
			->with(['categories' => Categories::all()]);
	}
	
	/**
	 * Get filtered categories
	 * @param null $filter
	 * @return Categories[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getFilteredCategories($filter = null) {
		
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
	
	/**
	 * Remove category
	 * @param $id
	 * @return void
	 */
	public function delete($id) {
		try {
			Categories::find($id)
				->delete();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
	}
	
	/**
	 * Restore category
	 * @param $id
	 */
	public function restore($id) {
		
		try {
			Categories::onlyTrashed()
				->where('id', $id)
				->restore();
		} catch (QueryException $e) {
			throw $e;
		} // try
	}
	
}