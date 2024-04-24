<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'oid',
        'order_number',
        'sub_total',
        'total_amount',
        'coupon',
        'payment_method',
        'payment_status',
        'condition',
        'delivery_charge',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'address',
        'city',
        'state',
        'postcode',
        'note',
        'sfirst_name',
        'slast_name',
        'semail',
        'sphone',
        'scountry',
        'saddress',
        'scity',
        'sstate',
        'spostcode',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('quantity');
    }

    // public function productOrders()
    // {
    //     return $this->hasMany(ProductOrder::class);
    // }
}
