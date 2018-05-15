<?php

namespace ikdev\ikpanel\app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function sub_level(){
        return $this->hasMany(Menu::class,'relation','id');
    }

    public function main_level(){
        return $this->belongsTo(Menu::class,'relation','id');
    }
    
}

