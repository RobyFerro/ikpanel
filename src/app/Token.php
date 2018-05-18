<?php
/**
 * Created by PhpStorm.
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Token
 * @package ikdev\ikpanel\app\
 * @property int $id
 * @property int $id_group
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Token extends Model {
	use SoftDeletes;
	
	protected $table = 'token';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	
	public function roles() {
		return $this->belongsToMany(Role::class, 'token_role', 'tokenid','roleid');
	}
	
	public function group(){
		return $this->hasOne(TokenGroup::class, 'id','id_group');
	}
	
	public function menu(){
		return $this->hasMany(Menu::class,'id_token','id');
	}
}