<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 10:59
 */

namespace ikdev\ikpanel\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorsComments extends Model
{
    use SoftDeletes;
    
    protected $table = 'exception_comment';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
    
    public function exception()
    {
        return $this->belongsToMany(Errors::class, 'comment_error', 'comment_id', 'id');
    }
    
}
