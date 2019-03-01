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
 * Class Token
 * @package ikdev\ikpanel\app
 * @property string $id
 * @property string $name
 * @property string $id_group
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Token extends Model {
	
	protected $table = 'token';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at'];
	public $incrementing = false;
	public $keyType = 'string';
	
	public function roles() {
		return $this->belongsToMany(Role::class, 'token_role', 'tokenid','roleid');
	}
	
	public function group(){
		return $this->belongsTo(TokenGroup::class, 'id_group','id');
	}
	
	public function type(){
		return $this->belongsTo(TokenType::class, 'id_type','id');
	}
	
	public function menu(){
		return $this->hasMany(Menu::class,'id_token','id');
	}
	
	public function route(){
		return $this->hasMany(RouteGroup::class,'id_token','id');
	}
	
	
	public function children() {
		return $this->hasMany(Token::class, 'relation', 'id');
	}
	
	public function parent() {
		return $this->belongsTo(Token::class, 'relation', 'id');
	}
	
	public static function getList(){
		
		$groups=TokenGroup::with(['token'=>function($query){
			$query->whereNull('relation');}
			])->get();
		
		foreach($groups as &$group) {
			foreach($group->token as &$token) {
				
				$children = $token->children()
				                  ->with('children')
				                  ->get();
				if(count($children) > 0) {
					$token->children = $children;
				}
			}
		}
		return $groups;
	}
}
