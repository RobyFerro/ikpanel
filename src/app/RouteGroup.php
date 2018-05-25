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
 * Class RouteGroup
 * @package ecit\admin_panel\app
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $id_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RouteGroup extends Model {
	
	protected $table = 'route_group';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	
	public function token() {
		return $this->belongsTo(Token::class, 'id', 'id_token');
	}
}