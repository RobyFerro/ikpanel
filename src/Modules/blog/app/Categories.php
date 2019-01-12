<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 07/01/2019
 * Time: 15:36
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
	
	
}