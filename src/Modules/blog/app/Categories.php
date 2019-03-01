<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\blog\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model {
	
	protected $table = 'blog_categories';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	protected $fillable = ['name', 'keywords', 'description'];
	
	use SoftDeletes;
	
	/**
	 * Get all related posts
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function posts() {
		return $this->belongsToMany(
			Post::class,
			'post_category',
			'id_category',
			'id_post');
	}
	
	
}
