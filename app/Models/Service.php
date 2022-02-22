<?php

namespace App\Models;

use App\Models\service\ServicePlan;
use App\Models\service\ServiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated.at'];
    protected $appends = [];
    public function oprator()
    {
        return $this->belongsTo(Oprator::class);
    }

    public function getTypeNameAttribute()
    {

        return ServiceType::getServiceTypeWithTypeNumber($this->attributes['type']);
    }
    public function getPlanNameAttribute()
    {

        return ServicePlan::getServicePlanWithPlanNumber($this->attributes['plan']);
    }
}
