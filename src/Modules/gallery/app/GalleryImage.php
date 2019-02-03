<?php

namespace ikdev\ikpanel\Modules\gallery\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model {
	
	use SoftDeletes;
	
	protected $primaryKey = 'id';
	protected $table = 'gallery_image';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description', 'path', 'keywords'];
	
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
