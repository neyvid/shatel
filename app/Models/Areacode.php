<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areacode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function telecomcenter()
    {
        return $this->belongsTo(Telecomcenter::class);
    }

    public function oprators()
    {
        return $this->belongsToMany(Oprator::class);
    }
}
