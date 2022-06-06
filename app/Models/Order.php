<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return config('orderStatus.confirmPay');
        }
        return config('orderStatus.notConfirmPay');
    }
}
