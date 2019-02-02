<?php

namespace ikdev\ikpanel\Modules\gallery\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryCategory extends Model {
	
	use SoftDeletes;
	
	protected $primaryKey = 'id';
	protected $table = 'gallery_category';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = [
		'name', 'keywords', 'description', 'main_pic'
	];
	
	/**
	 * Get related images
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function images() {
		return $this->belongsToMany(
			GalleryImage::class,
			'gallery_category_image',
			'id_category',
			'id_image'
		);
	}
}
