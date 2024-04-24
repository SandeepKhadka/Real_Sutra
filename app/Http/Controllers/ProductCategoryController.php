<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $product_category = $request->category;
        if ($product_category != "all") {
            $is_exists = Category::find($product_category);
            if (!$is_exists) {
                return redirect()->route('client.shop');
            }
        }
        // dd($product_category);
        $parent_categories = Category::where(['is_parent' => 1, 'status' => 'active'])->get();
        if ($product_category === 'all') {
            $all_products = Product::where(['status' => 'active'])->get();
        } else {
            $all_products = Product::where(['status' => 'active', 'cat_id' => $product_category])->get();
        }

        return view('client.category_product', [
            'parent_categories' => $parent_categories,
            'all_products' => $all_products,
        ]);
    }
}
