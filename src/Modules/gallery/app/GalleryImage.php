<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\gallery\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    protected $table = 'gallery_image';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'description', 'path', 'keywords', 'thumbnail'];
    
    /**
     * Get related categories
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            GalleryCategory::class,
            'gallery_category_image',
            'id_image',
            'id_category'
        );
    }
    
}
