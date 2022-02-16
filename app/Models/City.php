<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function telecomcenters()
    {
        return $this->hasMany(Telecomcenter::class);
    }
}
