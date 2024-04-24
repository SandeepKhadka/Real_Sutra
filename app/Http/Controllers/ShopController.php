<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $category = null;
    protected $product = null;

    public function __construct(Category $_category, Product $_product)
    {
        $this->category = $_category;
        $this->product = $_product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Fetch parent categories
        $parent_categories = $this->category->where(['is_parent' => 1, 'status' => 'active'])->get();

        // Initialize query builder for products
        $all_products = $this->product->where('status', 'active');

        // Apply price filtering
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');

        if ($minPrice && $maxPrice) {
            $all_products->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Apply category filtering
        $categoryId = $request->input('category');
        if ($categoryId && $categoryId != 'all') {
            $all_products->where('cat_id', $categoryId);
        }

        // Apply sorting
        $sortBy = $request->input('sort');
        switch ($sortBy) {
            case 'price-low-high':
                $all_products->orderBy('price', 'asc');
                break;
            case 'price-high-low':
                $all_products->orderBy('price', 'desc');
                break;
            default:
                // Default sorting logic
                break;
        }

        // Get paginated products
        $all_products = $all_products->paginate(9);

        return view('client.shop', [
            'parent_categories' => $parent_categories,
            'all_products' => $all_products,
            'minPrice' => $this->product->min('price'),
            'maxPrice' => $this->product->max('price'),
        ]);
    }



    public function singleProduct($id, $slug)
    {
        $single_product = Product::where(['id' => $id])->first();

        return view('client.single_product', [
            'product' => $single_product,
        ]);
    }


    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            abort(404); // Product not found
        }

        $cart = $request->session()->get('cart', []);

        // Check if the product is already in the cart
        foreach ($cart as $key => $item) {
            if ($item['id'] === $product->id) {
                // Increment the quantity if the product is already in the cart
                $cart[$key]['quantity'] += 1;

                $request->session()->put('cart', $cart);

                return redirect()->back()->with('info', 'Product quantity updated in the cart');
            }
        }

        // Add the product to the cart with quantity 1
        $cart[] = [
            'id' => $product->id,
            'quantity' => 1,
            // Add other product details as needed
        ];

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }


    public function addToWishlist(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            abort(404); // Product not found
        }

        // Retrieve the current wishlist from the session
        $wishlist = $request->session()->get('wishlist', []);

        // Check if the product is already in the wishlist
        foreach ($wishlist as $item) {
            // Assuming $item is an array with an 'id' key
            if (is_array($item) && array_key_exists('id', $item) && $item['id'] === $product->id) {
                return redirect()->back()->with('info', 'Product is already in the wishlist');
            }
        }

        // Add the entire product to the wishlist
        $wishlist[] = [
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'image' => $product->image,
            // Add more fields as needed
        ];

        // Update the wishlist in the session
        $request->session()->put('wishlist', $wishlist);

        return redirect()->back()->with('success', 'Product added to wishlist successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
