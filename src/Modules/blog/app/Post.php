<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 13/01/2019
 * Time: 11:10
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
		'keywords'
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