<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telecomcenter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
