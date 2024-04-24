<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);

        // Fetch titles and prices
        $cartDetails = [];

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

        return view('client.cart', ['cartItems' => $cartDetails]);
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
}
