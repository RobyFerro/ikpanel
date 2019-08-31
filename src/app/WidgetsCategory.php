<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app;

use Illuminate\Database\Eloquent\Model;

class WidgetsCategory extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'widgets_category';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['option'];
    
    public function widgets()
    {
        return $this->hasMany(Widgets::class, 'id_category', 'id');
    }
    
    
}
