<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    protected $guarded=['id'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
