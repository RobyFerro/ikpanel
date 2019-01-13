<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 07/01/2019
 * Time: 15:53
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use ikdev\ikpanel\Modules\blog\app\Categories;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\EditCategoryRequest;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\NewCategoryRequest;
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
	 * Edit category
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id) {
		return view('ikpanel-blog::categories.edit')
			->with(['category' => Categories::find($id)]);
	}
	
	/**
	 * Show new category view
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function new() {
		return view('ikpanel-blog::categories.new');
	}
	
	/**
	 * Insert new category
	 * @param NewCategoryRequest $request
	 * @return array
	 */
	public function insert(NewCategoryRequest $request) {
		
		$newCategory = new Categories();
		
		try {
			$id = $newCategory->insertGetId([
				"name"        => $request->get('name'),
				"keywords"    => $request->get('keywords'),
				"description" => $request->get('categoryDescription')
			]);
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return $id;
	}
	
	/**
	 * Update specific category
	 * @param EditCategoryRequest $request
	 */
	public function update(EditCategoryRequest $request) {
		
		try {
			Categories::find($request->get('categoryID'))
				->update([
					"name"        => $request->get('name'),
					"keywords"    => $request->get('keywords'),
					"description" => $request->get('categoryDescription')
				]);
		} catch (QueryException $e) {
			throw $e;
		} // try
		
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