<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function viewWishlist(Request $request)
    {
        $wishlists = $request->session()->get('wishlist', []);

        // Fetch titles and prices
        $wishlistDetails = [];
        foreach ($wishlists as $wishlistItem) {
            if (is_array($wishlistItem)) {
                // If it's an associative array, use its values directly
                $wishlistDetails[] = [
                    'id' => $wishlistItem['id'],
                    'title' => $wishlistItem['title'],
                    'price' => $wishlistItem['price'],
                    'image' => $wishlistItem['image'],
                    // Add other product details as needed
                ];
            } else {
                // If it's just a product ID, fetch the product from the database
                $product = Product::find($wishlistItem);

                if ($product) {
                    $wishlistDetails[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product->price,
                        'image' => $product->image,
                        // Add other product details as needed
                    ];
                }
            }
        }

        return view('client.wishlist', ['wishlists' => $wishlistDetails]);
    }

    public function removeItem($key)
    {
        dd('hi');
        $wishlists = session('wishlist', []);

        // Check if the key exists in the cart items
        if (array_key_exists($key, $wishlists)) {
            // Remove the item with the specified key
            unset($wishlists[$key]);

            // Update the session with the modified cart items
            session(['wishlist' => $wishlists]);

            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false], 400);
    }
}
