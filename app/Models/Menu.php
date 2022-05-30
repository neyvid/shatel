<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function childrens()
    {
        return $this->hasMany(Menu::class, 'parent_id');

    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');

    }

//    public function getParentIdAttribute($value)
//    {
//        if($value==0){
//            return 'منو اصلی';
//        }
//    }
}
