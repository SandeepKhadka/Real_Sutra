@extends('layouts.client')

@section('title', 'My Orders - Sutra Accessories')

@section('style')
    <!-- Add any specific styles for the My Orders page if needed -->
    <style>
        .orders-container {
            max-width: 800px;
            margin: 20px auto;
        }

        .order-item {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-details {
            margin-top: 15px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-details {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            justify-content: space-between;
        }

        .product-image {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 5px;
            object-fit: cover;
        }

        .product-info {
            /* flex: 1; */
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            color: #333;
            font-size: 14px;
        }

        .product-quantity {
            font-size: 14px;
            color: #888;
        }

        .total-amount {
            font-size: 16px;
            margin-top: 10px;
            font-weight: bold;
        }

        .order-status {
            font-size: 16px;
            color: #4caf50;
            font-weight: bold;
        }

        .no-orders {
            text-align: center;
            color: #888;
            margin-top: 20px;
        }
    </style>
@endsection

@section('main-content')
    <div class="orders-container">
        <h4>My Orders</h4>

        @if (count($userOrders) > 0)
            @foreach ($userOrders as $order)
                <div class="order-item">
                    <h5>Order #{{ $order->order_number }}</h5>

                    <div class="order-details">
                        @foreach ($order->products as $product)
                            <div class="product-card">
                                <div class="product-details">
                                    <img src="{{ asset('uploads/product/' . $product->image) }}" alt="Product Image"
                                        class="product-image">
                                    <div class="product-quantity">Quantity: {{ $product->pivot->quantity }}</div>
                                    <div class="product-info">
                                        <div class="product-title">{{ $product->title }}</div>
                                        <div class="product-price">Price: {{ $product->price }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <p class="total-amount">Total Amount: {{ $order->total_amount }}</p>
                        <p class="order-status">Order Status: {{ $order->condition }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-orders">No orders available.</p>
        @endif
    </div>
@endsection
