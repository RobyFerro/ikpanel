<?php

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * @package ikdev\ikpanel\app
 * @property string $id
 * @property string $id_token
 * @property string $name
 * @property string $route
 * @property string $icon
 * @property string $relation
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Menu extends Model {
	
	protected $table = 'menu';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	public $incrementing = false;
	public $keyType = 'string';
	
	public function parent() {
		return $this->belongsTo(Menu::class, 'relation', 'id');
	}
	
	public function children() {
		return $this->hasMany(Menu::class, 'relation', 'id');
	}
	
	public function token(){
		return $this->hasOne(Token::class, 'id','id_token');
	}
	
}

