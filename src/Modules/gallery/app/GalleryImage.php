<?php

namespace ikdev\ikpanel\Modules\gallery\app;


use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model {
	
	protected $primaryKey = 'id';
	protected $table = 'gallery_image';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description', 'path'];
	
	/**
	 * Get related categories
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories() {
		return $this->belongsToMany(
			GalleryCategory::class,
			'gallery_category_image',
			'id_image',
			'id_category'
		);
	}
	
}
