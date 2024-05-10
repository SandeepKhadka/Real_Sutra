<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);

        // Fetch titles, prices, and calculate total price
        $cartDetails = [];
        $totalPrice = $this->calculateTotalPrice(); // Calculate total price from cart items

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem['id']);

            if ($product) {
                $cartDetails[] = [
                    'title' => $product->title,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => $cartItem['quantity'],
                    // Add other product details as needed
                ];
            }
        }

        // Subtract the coupon discount from the total price if it exists in the session
        $couponDiscount = Session::get('coupon_discount', 0);
        $finalPrice = $totalPrice - $couponDiscount;

        return view('client.cart', [
            'cartItems' => $cartDetails,
            'totalPrice' => $finalPrice, // Pass the final price to the view
        ]);
    }
    // Add these methods in your CartController

    public function updateQuantity($key)
    {
        $cartItems = session('cart', []);

        // Check if the key exists in the cart items
        if (array_key_exists($key, $cartItems)) {
            // Get the new quantity from the request
            $newQuantity = request('quantity');

            // Validate the new quantity (you can add more validation rules as needed)
            if (is_numeric($newQuantity) && $newQuantity > 0) {
                // Update the quantity of the item with the specified key
                $cartItems[$key]['quantity'] = $newQuantity;

                // Update the session with the modified cart items
                session(['cart' => $cartItems]);

                return response()->json(['success' => true], 200);
            }
        }

        return response()->json(['success' => false], 400);
    }

    public function removeItem($key)
    {
        $cartItems = session('cart', []);

        // Check if the key exists in the cart items
        if (array_key_exists($key, $cartItems)) {
            // Remove the item with the specified key
            unset($cartItems[$key]);

            // Update the session with the modified cart items
            session(['cart' => $cartItems]);

            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 400);
    }

    private function calculateTotalPrice()
    {
        $cartItems = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            // Retrieve the product based on the product ID from your database
            $product = Product::find($cartItem['id']);

            if ($product) {
                // Calculate the total price for each item and accumulate
                $totalPrice += $product->price * $cartItem['quantity'];
            }
        }

        return $totalPrice;
    }

    private function isProductInCart($coupon)
    {
        $cartItems = session('cart', []);
        $productIdsInCart = array_column($cartItems, 'id');

        // Check if the product ID associated with the coupon is in the cart
        return in_array($coupon->product_id, $productIdsInCart);
    }

    public function couponAdd(Request $request)
    {
        // Retrieve the coupon based on the provided code and ensure it's active
        $coupon = Coupon::where(['code' => $request->input('code'), 'status' => 'active'])->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code, Please enter a valid coupon code'], 400);
        }

        // Check if the product associated with the coupon is in the cart
        if (!$this->isProductInCart($coupon)) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code, Please enter a valid coupon code'], 400);
        }

        // Calculate total price of the items in the cart
        $totalPrice = $this->calculateTotalPrice();

        // Calculate the discount based on the coupon and the total price
        $discountAmount = $coupon->discount($totalPrice);

        // Apply the discount to the total price
        $finalPrice = $totalPrice - $discountAmount;

        // Store the discount amount and final price in session or database as needed
        Session::put('coupon_discount', $discountAmount);
        Session::put('final_price', $finalPrice);
        Session::put('applied_coupon_code', $coupon->code);

        // Return success response with updated total amount
        return response()->json(['success' => true, 'totalAmount' => $finalPrice, 'message' => 'Coupon applied successfully'], 200);
    }



    // Helper function to calculate total price of items in the cart

}
