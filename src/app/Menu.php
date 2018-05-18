<?php

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 * @package ikdev\ikpanel\app\
 * @property int $id
 * @property int $id_token
 * @property string $name
 * @property string $route
 * @property string $icon
 * @property int $relation
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Menu extends Model {
	use SoftDeletes;
	
	protected $table = 'menu';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	
	public function sub_level() {
		return $this->hasMany(Menu::class, 'relation', 'id');
	}
	
	public function main_level() {
		return $this->belongsTo(Menu::class, 'relation', 'id');
	}
	
	public function token(){
		return $this->hasOne(Token::class, 'id','id_token');
	}
	
}

