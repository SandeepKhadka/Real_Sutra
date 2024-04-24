@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
    <style>
        Got it ! Let's keep the structure of the code intact and focus on updating the CSS to give the interface a fresh look. Here' s the revised CSS: ```css

        /* General Styles */
        .single-product-section {
            margin-top: 50px;
        }

        /* Product Image Section */
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Product Details Section */
        .product-details {
            padding: 20px;
            /* background-color: #f9f9f9; */
            /* border-radius: 8px; */
            /* box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); */
        }

        .product-details h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .product-details .price {
            font-size: 20px;
            color: #e44d26;
            margin-bottom: 15px;
        }

        .product-details .description {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            flex: 1;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #e44d26;
            color: #fff;
        }

        .btn-outline-secondary {
            background-color: #fff;
            color: #333;
            border: 1px solid #333;
        }

        .btn-primary:hover,
        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Product Description Section */
        .product-description {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .product-description h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .product-description p {
            font-size: 16px;
            color: #555;
        }

        /* Flash Message Styles */
        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ffffff;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .flash-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 18px;
        }

        .close-btn {
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            color: #31708f;
        }
    </style>
@endsection

@section('main-content')
    <section class="single-product-section layout_padding">
        <div class="container">
            <div class="row">
                <!-- Product Image Section (Left Side) -->
                <div class="row product-details">
                    <div class="col-md-6">
                        <div class="">
                            <img src="{{ asset('uploads/product/' . $product->image) }}" alt="{{ $product->title }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                            <h2>{{ $product->title }}</h2>
                            <p>Rating: ⭐⭐⭐⭐⭐</p>
                            <p>Available in: <span
                                    style="color: grey; margin-left: 5px; margin-top: auto; font-size: 14px">XS, S, M, L,
                                    XL</span></p>
                            <p class="price">Rs {{ $product->price }}</p>
                            <p class="description">
                                {{ $product->summary }}
                            </p>

                            <!-- Add to Cart and Add to Wishlist Buttons -->
                            <div class="action-buttons">
                                <form action="{{ route('product.addToCart', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                </form>
                                <form action="{{ route('product.addToWishlist', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Add to Wishlist</button>
                                </form>
                                <form id="my-form"
                                    action="{{ url('http://127.0.0.1:8000/chatify/1') }}"
                                    method="get" target="_blank">
                                    <input type="hidden" value="{{ @$product->id }}" name="product_id">
                                    <button class="btn btn--e-brand-b-2 btn-primary"
                                        onclick="if (confirm('Do you want to start a conversation about this product?')) { submitForm(); }">Chat
                                        Now</button>
                                </form>
                            </div>

                            <!-- Flash Messages -->
                            @if (session('success'))
                                <div class="flash-message">
                                    <div class="flash-content">
                                        <p>{{ session('success') }}</p>
                                        <span class="close-btn" onclick="closeFlashMessage()">&times;</span>
                                    </div>
                                </div>
                            @endif
                            @if (session('info'))
                                <div class="flash-message">
                                    <div class="flash-content">
                                        <p>{{ session('info') }}</p>
                                        <span class="close-btn" onclick="closeFlashMessage()">&times;</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Details Section (Right Side) -->



                <hr>
                <!-- Product Description Section (Below Product Details) -->
                <div class="col-md-12 mt-4">
                    <div class="product-description">
                        <!-- You can style the description box here -->
                        <h3>Description</h3>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Use this script if you are using jQuery
        function closeFlashMessage() {
            $('.flash-message').fadeOut();
        }

        // Automatically close the flash message after 5 seconds
        setTimeout(function() {
            $('.flash-message').fadeOut();
        }, 5000);
    </script>
     <script>
        function submitForm() {
            document.getElementById("my-form").submit();
        }
    </script>
@endsection
