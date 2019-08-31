<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Controllers;


use ikdev\ikpanel\Modules\blog\app\Categories;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\EditCategoryRequest;
use ikdev\ikpanel\Modules\blog\app\Http\Requests\NewCategoryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    
    /**
     * Show category list
     * @return Factory|View
     */
    public function show()
    {
        return view('ikpanel-blog::categories.show')
            ->with(['categories' => Categories::all()]);
    }
    
    /**
     * Edit category
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('ikpanel-blog::categories.edit')
            ->with(['category' => Categories::find($id)]);
    }
    
    /**
     * Show new category view
     * @return Factory|View
     */
    public function new()
    {
        return view('ikpanel-blog::categories.new');
    }
    
    /**
     * Insert new category
     * @param  NewCategoryRequest  $request
     * @return array
     */
    public function insert(NewCategoryRequest $request)
    {
        
        $newCategory = new Categories();
        
        try {
            $id = $newCategory->insertGetId([
                "name" => $request->get('name'),
                "keywords" => $request->get('keywords'),
                "description" => $request->get('categoryDescription')
            ]);
        } catch (QueryException $e) {
            throw $e;
        } // try
        
        return $id;
    }
    
    /**
     * Update specific category
     * @param  EditCategoryRequest  $request
     */
    public function update(EditCategoryRequest $request)
    {
        
        try {
            Categories::find($request->get('categoryID'))
                ->update([
                    "name" => $request->get('name'),
                    "keywords" => $request->get('keywords'),
                    "description" => $request->get('categoryDescription')
                ]);
        } catch (QueryException $e) {
            throw $e;
        } // try
        
    }
    
    /**
     * Get filtered categories
     * @param  null  $filter
     * @return Categories[]|Collection
     */
    public function getFilteredCategories($filter = null)
    {
        
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
    public function delete($id)
    {
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
    public function restore($id)
    {
        
        try {
            Categories::onlyTrashed()
                ->where('id', $id)
                ->restore();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }
    
}
