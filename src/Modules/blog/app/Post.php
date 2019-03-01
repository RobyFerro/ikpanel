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

class Post extends Model {
	
	use SoftDeletes;
	
	protected $table = 'post';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = [
		'id_owner',
		'owner_alias',
		'title',
		'description',
		'content',
		'keywords',
		'main_pic',
		'thumbnail'
	];
	
	/**
	 * Get related categories
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories() {
		return $this->belongsToMany(Categories::class,
			'post_category',
			'id_post',
			'id_category');
	}
	
	
}
