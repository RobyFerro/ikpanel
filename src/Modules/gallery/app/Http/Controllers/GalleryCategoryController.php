<?php

namespace ikdev\ikpanel\Modules\gallery\app\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use ikdev\ikpanel\Modules\gallery\app\GalleryCategory;
use ikdev\ikpanel\Modules\gallery\app\Http\Requests\EditGalleryCategoryRequest;
use ikdev\ikpanel\Modules\gallery\app\Http\Requests\NewGalleryCategoryRequest;
use Illuminate\Database\QueryException;

class GalleryCategoryController extends Controller {
	
	/**
	 * Show all gallery categories
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		return view('ikpanel-gallery::categories.show')
			->with(['categories' => GalleryCategory::all()]);
	}
	
	/**
	 * Show new category view
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function new() {
		return view('ikpanel-gallery::categories.new');
	}
	
	/**
	 * Show edit category view
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id) {
		try {
			return view('ikpanel-gallery::categories.edit')
				->with(['category' => GalleryCategory::find($id)]);
		} catch (QueryException $e) {
			throw $e;
		} // try
	}
	
	/**
	 * Insert new category
	 * @param NewGalleryCategoryRequest $request
	 * @return int
	 */
	public function insert(NewGalleryCategoryRequest $request) {
		
		try {
			$id = GalleryCategory::insertGetId([
				'name'        => $request->get('name'),
				'keywords'    => $request->get('keywords'),
				'description' => $request->get('categoryDescription'),
				'created_at'  => Carbon::now(),
				'updated_at'  => Carbon::now()
			]);
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return $id;
	}
	
	/**
	 * Update specific category
	 * @param EditGalleryCategoryRequest $request
	 */
	public function update(EditGalleryCategoryRequest $request) {
		try {
			GalleryCategory::find($request->get('categoryID'))
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
	 * Delete specific category
	 * @param $id
	 */
	public function delete($id) {
		
		try {
			GalleryCategory::find($id)
				->delete();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
	}
	
	/**
	 * Restore specific category
	 * @param $id
	 */
	public function restore($id) {
		try {
			GalleryCategory::onlyTrashed()
				->where('id', $id)
				->restore();
		} catch (QueryException $e) {
			throw $e;
		} // try
	}
	
	/**
	 * Get filtered categories
	 * @param null $filter
	 * @return GalleryCategory[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getFilteredCategories($filter = null) {
		
		if (is_null($filter)) {
			return GalleryCategory::all();
		} else {
			$categories = new GalleryCategory();
			$data = null;
			
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
			
			return view('ikpanel-gallery::categories.table')
				->with([
					'categories' => $data
				]);
			
		} // if
		
	}
	
}
