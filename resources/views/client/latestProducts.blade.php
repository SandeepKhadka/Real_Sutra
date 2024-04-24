@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
<style>
    .product-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 30px;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image {
        max-width: 80%;
        height: auto;
    }

    .product-details {
        padding: 20px;
    }

    .product-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .product-price {
        font-size: 16px;
        color: #e44d26;
    }
</style>
@endsection

@section('main-content')
<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <div class="">
                <h5>All Products</h5>
            </div>
        </div>

        <div class="row">
            @forelse ($results as $product)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="product-card">
                    <a href="{{ route('front.single_product', ['id' => $product->id, 'slug' => $product->title]) }}">
                        {{-- Adjust this according to your array structure --}}
                        <div class="product-image">
                            <img src="{{ asset('uploads/product/' . $product->image) }}" alt="">
                        </div>
                        <div class="product-details">
                            <h6 class="product-title">{{ $product->title }}</h6>
                            <p class="product-price">Rs {{ $product->price }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p>No results found.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
@endsection
