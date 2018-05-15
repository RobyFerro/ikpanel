<?php
/**
 * Created by PhpStorm.
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace Ikdev\Ikpanel\app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    public function users(){
        return $this->hasMany(Users::class,'role','id');
    }
}