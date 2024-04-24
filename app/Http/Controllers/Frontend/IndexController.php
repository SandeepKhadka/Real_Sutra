<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $banner = null;
    protected $product = null;

    public function __construct(Banner $_banner, Product $_product)
    {
        $this->banner = $_banner;
        $this->product = $_product;
    }

    public function index()
    {
        $banner_list = $this->banner
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->get();

        $latest_product_list = $this->product
            ->where('conditions', 'new') // Adjust the condition as needed
            ->get();

        $for_you_product_list = $this->product
            ->where('conditions', 'for_you') // Adjust the condition as needed
            ->get();

        return view('client.index', [
            'banner_list' => $banner_list,
            'latest_product_list' => $latest_product_list,
            'for_you_product_list' => $for_you_product_list,
        ]);
    }

    public function myOrders()
    {
        $userOrders = Order::where('user_id', auth()->user()->id)->get();

        return view('client.myOrders', compact('userOrders'));
    }

    public function about(){
        return view('client.about');
    }

    public function contact(){
        return view('client.contact');
    }
}
