<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function services()
    {
        return $this->morphedByMany(Service::class, 'categoryable');
    }

    public function equipments()
    {
        return $this->morphedByMany(Equipment::class, 'categoryable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            $category->children()->delete();
        });
    }

}
