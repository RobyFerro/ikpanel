<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\gallery\app\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use ikdev\ikpanel\Modules\gallery\app\GalleryCategory;
use ikdev\ikpanel\Modules\gallery\app\GalleryImage;
use ikdev\ikpanel\Modules\gallery\app\Http\Requests\EditGalleryImageRequest;
use ikdev\ikpanel\Modules\gallery\app\Http\Requests\NewGalleryImageRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryImagesController extends Controller
{
    
    /**
     * Show all images
     * @return Factory|View
     */
    public function index()
    {
        
        try {
            $images = GalleryImage::with('categories')
                ->get();
        } catch (QueryException $e) {
            throw $e;
        } // try
        
        return view('ikpanel-gallery::images.show')
            ->with([
                'images' => $images
            ]);
    }
    
    /**
     * Show new image view
     * @return Factory|View
     */
    public function new()
    {
        return view('ikpanel-gallery::images.new')
            ->with(['categories' => GalleryCategory::all()]);
    }
    
    /**
     * Show edit image view
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        
        try {
            $img = GalleryImage::where('id', '=', $id)
                ->with('categories')
                ->first();
        } catch (QueryException $e) {
            throw $e;
        } // try
        
        $activeCategories = [];
        
        foreach ($img->categories as $category) {
            $activeCategories[] = $category->id;
        } // foreach
        
        return view('ikpanel-gallery::images.edit')
            ->with(
                [
                    "activeCategories" => $activeCategories,
                    'img' => $img,
                    'categories' => GalleryCategory::all()
                ]
            );
    }
    
    /**
     * Get filtered images
     * @param  null  $filter
     * @return GalleryImage[]|Collection
     */
    public function getFilteredCategories($filter = null)
    {
        
        if (is_null($filter)) {
            return GalleryImage::with('categories')
                ->get();
        } else {
            $images = new GalleryImage();
            $data = null;
            
            switch ($filter) {
                case 'ALL':
                    try {
                        $data = $images
                            ->with('categories')
                            ->withTrashed()
                            ->get();
                    } catch (QueryException $e) {
                        throw $e;
                    } // try
                    break;
                case 'ACTIVE':
                    try {
                        $data = $images
                            ->with('categories')
                            ->get();
                    } catch (QueryException $e) {
                        throw $e;
                    } // try
                    break;
                case 'DELETED':
                    try {
                        $data = $images
                            ->with('categories')
                            ->onlyTrashed()
                            ->get();
                    } catch (QueryException $e) {
                        throw $e;
                    } // try
                    
                    break;
            } // switch
            
            return view('ikpanel-gallery::images.table')->with([
                'images' => $data
            ]);
            
        } // if
        
    }
    
    /**
     * Insert new image
     * @param  NewGalleryImageRequest  $request
     * @return mixed
     */
    public function insert(NewGalleryImageRequest $request)
    {
        
        DB::beginTransaction();
        
        try {
            $id = GalleryImage::insertGetId([
                'name' => $request->get('title'),
                'description' => $request->get('content'),
                'keywords' => $request->get('keywords'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
            
            $file = $request->file('pic');
            $filename = $file->getFilename().".".$file->extension();
            $storagePath = "public/gallery/images/{$id}/";
            $thumbnailPath = "public/gallery/images/{$id}/thumb";
            $file->storeAs($storagePath, $filename);
            
            $image = $request->file('pic');
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(370, 220);
            
            if (!file_exists(public_path("storage/gallery/images/{$id}/thumb"))) {
                mkdir(public_path("storage/gallery/images/{$id}/thumb"));
            } // if
            
            $image_resize->save(public_path("storage/gallery/images/{$id}/thumb/{$filename}"));
            
            try {
                GalleryImage::find($id)
                    ->update([
                        "path" => str_replace('public', 'storage', $storagePath).$filename,
                        "thumbnail" => str_replace('public', 'storage', $thumbnailPath)."/".$filename
                    ]);
            } catch (QueryException $e) {
                DB::rollBack();
                throw $e;
            } // try
            
        } // if
        
        $categories = [];
        
        foreach ($request->all() as $key => $item) {
            if (preg_match('/category/', $key) == 1 && filter_var($item, FILTER_VALIDATE_BOOLEAN)) {
                $categories[] = (int) explode('-', $key)[1];
            } // if
        } // if
        
        try {
            GalleryImage::find($id)
                ->categories()
                ->attach($categories);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        DB::commit();
        return $id;
        
    }
    
    /**
     * Update specific image
     * @param  EditGalleryImageRequest  $request
     */
    public function update(EditGalleryImageRequest $request)
    {
        
        DB::beginTransaction();
        
        $categories = [];
        
        if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
            
            $file = $request->file('pic');
            $filename = $file->getFilename().".".$file->extension();
            $storagePath = "public/gallery/images/{$request->get('imageID')}/";
            $thumbnailPath = "public/gallery/images/{$request->get('imageID')}/thumb";
            $file->storeAs($storagePath, $filename);
            
            $image = $request->file('pic');
            
            if (!file_exists(public_path("storage/gallery/images/{$request->get('imageID')}/thumb"))) {
                mkdir(public_path("storage/gallery/images/{$request->get('imageID')}/thumb"));
            } // if
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(370, 220);
            $image_resize->save(storage_path("app/public/gallery/images/{$request->get('imageID')}/thumb/{$filename}"));
            
            try {
                GalleryImage::find($request->get('imageID'))
                    ->update([
                        "path" => str_replace('public', 'storage', $storagePath).$filename,
                        "thumbnail" => str_replace('public', 'storage', $thumbnailPath)."/".$filename
                    ]);
            } catch (QueryException $e) {
                DB::rollBack();
                throw $e;
            } // try
            
        } // if
        
        foreach ($request->all() as $key => $item) {
            if (preg_match('/category/', $key) == 1 && filter_var($item, FILTER_VALIDATE_BOOLEAN)) {
                $categories[] = (int) explode('-', $key)[1];
            } // if
        } // if
        
        try {
            GalleryImage::find($request->get('imageID'))
                ->categories()
                ->sync($categories);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            GalleryImage::find($request->get('imageID'))
                ->update([
                    "name" => $request->get('title'),
                    "description" => $request->get('content'),
                    "keywords" => $request->get('keywords'),
                    'updated_at' => Carbon::now()
                ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        DB::commit();
        
    }
    
    /**
     * Delete specific image
     * @param $id
     */
    public function delete($id)
    {
        
        try {
            GalleryImage::find($id)
                ->delete();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }
    
    /**
     * Restore specific image
     * @param $id
     */
    public function restore($id)
    {
        try {
            GalleryImage::onlyTrashed()
                ->where('id', $id)
                ->restore();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }
    
}
