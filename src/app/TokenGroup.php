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

/**
 * Class TokenGroup
 * @package ecit\admin_panel\app
 * @property string $id
 * @property string $group_name
 * @property string $description
 * @property string $icon
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TokenGroup extends Model {
	
	protected $table = 'token_group';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	public $incrementing = false;
	public $keyType = 'string';
	
	public function token() {
		return $this->hasMany(Token::class, 'id_group', 'id');
	}
}