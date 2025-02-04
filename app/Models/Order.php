<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'order_quantity', 'total_amount', 'total_amount', 'payment_method', 'status','order_number'];

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}
