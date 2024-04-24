<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'cat_id',
        'sub_cat_id',
        'image',
        'price',
        'discount',
        'is_featured',
        'brand',
        'stock',
        'added_by',
        'status',
        'conditions',
    ];

    public function getSlug($title)
    {
        $slug = Str::slug($title);
        if ($this->where('slug', $slug)->count() > 0) {
            $slug .= date('Ymdhis') . rand(0, 99);
        }
        return $slug;
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->get()->toArray();
    }

    // Inside the Product model
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, 'product_orders')->withPivot('quantity');
    // }
}
