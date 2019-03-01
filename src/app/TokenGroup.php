<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
 * Class TokenGroup
 * @package ikdev\ikpanel\app
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
