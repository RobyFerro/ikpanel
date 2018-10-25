<?php
/**
 * Created By Interactive Knowledge Development
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TokenType
 * @package ikdev\ikpanel\app
 * @property string $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TokenType extends Model {
	
	protected $table = 'token_type';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	public $incrementing = false;
	public $keyType = 'string';
	
	public function token() {
		return $this->hasMany(Token::class, 'id_type', 'id');
	}
}