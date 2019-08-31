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

class Widgets extends Model
{
    protected $table = 'widgets';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'path', 'position', 'id_category'];
    
    public function role()
    {
        return $this->belongsToMany(
            Role::class,
            'widgets_role',
            'id_widget',
            'id_role'
        );
    }
    
    public function category()
    {
        return $this->hasOne(WidgetsCategory::class, 'id', 'id_category');
    }
}
