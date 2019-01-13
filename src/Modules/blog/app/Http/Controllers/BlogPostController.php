<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 12/01/2019
 * Time: 11:11
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use Carbon\Carbon;
use ikdev\ikpanel\app\Users;
use ikdev\ikpanel\Modules\blog\app\Categories;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\EditPostRequest;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\NewPostRequest;
use ikdev\ikpanel\Modules\blog\app\Post;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller {
	
	/**
	 * Show all active posts
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show() {
		
		try {
			$posts = Post::with('categories')
				->get();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return view('ikpanel-blog::articles.show')
			->with(['posts' => $posts]);
	}
	
	/**
	 * Remove article
	 * @param $id
	 * @return void
	 */
	public function delete($id) {
		try {
			Post::find($id)
				->delete();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
	}
	
	/**
	 * Get filtered articles
	 * @param null $filter
	 * @return Post[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getFilteredCategories($filter = null) {
		
		if (is_null($filter)) {
			$data = Post::with('categories')
				->get();
		} else {
			$categories = new Post();
			
			switch ($filter) {
				case 'ALL':
					try {
						$data = $categories
							->with('categories')
							->withTrashed()
							->get();
					} catch (QueryException $e) {
						throw $e;
					} // try
					break;
				case 'ACTIVE':
					try {
						$data = $categories
							->with('categories')
							->get();
					} catch (QueryException $e) {
						throw $e;
					} // try
					break;
				case 'DELETED':
					try {
						$data = $categories
							->with('categories')
							->onlyTrashed()
							->get();
					} catch (QueryException $e) {
						throw $e;
					} // try
					
					break;
			} // switch
			
			return view('ikpanel-blog::articles.table')->with([
				'posts' => $data
			]);
			
		} // if
		
	}
	
	/**
	 * Restore article
	 * @param $id
	 */
	public function restore($id) {
		
		try {
			Post::onlyTrashed()
				->where('id', $id)
				->restore();
		} catch (QueryException $e) {
			throw $e;
		} // try
	}
	
	/**
	 * Edit category
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id) {
		
		try {
			$post = Post::where('id', '=', $id)
				->with('categories')
				->first();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		$activeCategories = [];
		
		foreach ($post->categories as $category) {
			$activeCategories[] = $category->id;
		} // foreach
		
		return view('ikpanel-blog::articles.edit')
			->with(
				[
					"users"            => Users::all(),
					"activeCategories" => $activeCategories,
					'post'             => $post,
					'categories'       => Categories::all()
				]
			);
	}
	
	/**
	 * Update specific article
	 * @param EditPostRequest $request
	 */
	public function update(EditPostRequest $request) {
		
		DB::beginTransaction();
		
		$categories = [];
		
		foreach ($request->all() as $key => $item) {
			if (preg_match('/category/', $key) == 1 && filter_var($item, FILTER_VALIDATE_BOOLEAN)) {
				$categories[] = (int)explode('-', $key)[1];
			} // if
		} // if
		
		try {
			Post::find($request->get('articleID'))
				->categories()
				->detach();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Post::find($request->get('articleID'))
				->categories()
				->attach($categories);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Post::find($request->get('articleID'))
				->update([
					"title"       => $request->get('title'),
					"content"     => $request->get('content'),
					"description" => $request->get('shortDescription'),
					"owner_alias" => $request->get('ownerAlias'),
					"id_owner"    => (int)$request->get('author'),
					"keywords"    => $request->get('keywords'),
				]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		DB::commit();
		
	}
	
	/**
	 * Show new article view
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function new() {
		return view('ikpanel-blog::articles.new')->with([
			"users"      => Users::all(),
			'categories' => Categories::all()
		]);
	}
	
	/**
	 * Insert new category
	 * @param NewPostRequest $request
	 * @return array
	 */
	public function insert(NewPostRequest $request) {
		
		DB::beginTransaction();
		$newPost = new Post();
		
		try {
			$id = $newPost->insertGetId([
				"title"       => $request->get('title'),
				"content"     => $request->get('content'),
				"description" => $request->get('shortDescription'),
				"owner_alias" => $request->get('ownerAlias'),
				"id_owner"    => $request->get('author'),
				"keywords"    => $request->get('keywords'),
				'created_at'  => Carbon::now()
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		$categories = [];
		
		foreach ($request->all() as $key => $item) {
			if (preg_match('/category/', $key) == 1 && filter_var($item, FILTER_VALIDATE_BOOLEAN)) {
				$categories[] = (int)explode('-', $key)[1];
			} // if
		} // if
		
		try {
			Post::find($id)
				->categories()
				->attach($categories);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		DB::commit();
		return $id;
	}
	
	
}