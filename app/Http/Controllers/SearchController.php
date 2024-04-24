<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function autoSearch(Request $request)
    {
        $query = $request->get('term', '');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = array('value' => $product->title, 'id' => $product->id);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No result found', 'id' => ''];
        }
    }


    public function search(Request $request)
    {
        $term = $request->input('term');

        $results = Product::query()
            ->where(function ($query) use ($term) {
                $query->where('title', 'like', "$term%")
                    ->orWhereHas('category', function ($subQuery) use ($term) {
                        $subQuery->where('title', 'like', "$term%");
                    });
            })
            ->get();

        return view('client.search_results', compact('results'));
    }

    public function justForYou()
    {
        $results = Product::where('conditions', 'for_you')->get();
        return view('client.justForYou', compact('results'));
    }

    public function latestProducts()
    {
        $results = Product::where('conditions', 'new')->get();
        return view('client.latestProducts', compact('results'));
    }
}
