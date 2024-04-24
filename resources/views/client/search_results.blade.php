@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
    <style>
        .product-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 400px;

        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: auto;
            display: block;
            border-bottom: 2px solid #fff;
            transition: border-bottom 0.3s ease;
        }

        /* .product-card:hover .product-image {
            border-bottom: 2px solid #007bff;
        } */

        .product-details {
            padding: 20px;
            background-color: #fff;
        }

        .product-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .product-price {
            font-size: 16px;
            color: #007bff;
            font-weight: bold;
        }
    </style>
@endsection

@section('main-content')
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <div class="">
                    <h5>Search Results</h5>
                </div>
            </div>

            <div class="row">
                @forelse ($results as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <a href="{{ route('front.single_product', ['id' => $product->id, 'slug' => $product->title]) }}">
                                <div class="img-box">
                                    <img src="{{ asset('uploads/product/' . $product->image) }}" alt="Product Image"
                                        class="product-image">
                                </div>
                                <div class="product-details">
                                    <h6 class="product-title">{{ $product->title }}</h6>
                                    <span class="product-price">Rs {{ $product->price }}</span>
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
