@extends('layouts.client')

@section('title', 'Order Confirmation - Sutra Accessories')

@section('style')
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* Center align content */
        }

        .confirmation-container h2 {
            color: #e44d26;
            /* Use accent color for headings */
            font-size: 28px;
            margin-bottom: 20px;
        }

        .confirmation-container p {
            color: #555;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .order-details {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .order-details strong {
            color: #333;
            /* Darken text color for emphasis */
            font-size: 20px;
        }

        .additional-info {
            margin-top: 20px;
            color: #777;
            font-size: 16px;
        }

        .contact-info {
            margin-top: 30px;
            font-size: 16px;
        }

        .contact-info a {
            color: #e44d26;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .button {
            background-color: #0cb923;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            text-decoration: none
        }

        .button:hover {
            background-color: #65d357;
            text-decoration: none;
            color: white

        }
    </style>
@endsection

@section('main-content')
    <div class="confirmation-container">
        <h2>Thank You for Your Order!</h2>
        <p>Your order has been successfully placed.</p>

        <div class="order-details">
            <strong>Your Order ID:</strong> {{ $order_id }} <!-- Assuming $order contains order details -->
        </div>

        <!-- Add any additional information or instructions as needed -->

        <a href="{{ route('front.shop') }}" class="button">Shop Again</a>
    </div>
@endsection
