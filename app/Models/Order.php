<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'order_quantity', 'total_amount', 'total_amount', 'payment_method', 'status','order_number'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastTransaction = self::orderBy('order_number', 'desc')->first();
            if ($lastTransaction) {
                $lastInvoiceNumber = intval($lastTransaction->order_number);
                $invoiceNumber = str_pad($lastInvoiceNumber + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $invoiceNumber = '00001';
            }
            $model->order_number = $invoiceNumber;
        });
    }

}
