@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
    <style>
        .cart-container {
            margin-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .cart-item {
            width: calc(33.33% - 20px);
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .cart-item:hover {
            transform: translateY(-5px);
        }

        .cart-item img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .cart-item-content {
            padding: 20px;
            background-color: #fff;
        }

        .cart-item-title {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .cart-item-price {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .cart-item-quantity {
            margin-bottom: 10px;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
        }

        .total {
            font-weight: bold;
            color: #e44d26;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            filter: brightness(90%);
        }

        .cart-actions {
            width: 100%;
            margin-top: 20px;
            text-align: right;
        }

        .btn-checkout {
            background-color: #e44d26;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-checkout:hover {
            filter: brightness(90%);
            color: white;
            text-decoration: none;

        }

        .coupon-input {
            width: 200px;
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .apply-coupon-btn {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .apply-coupon-btn:hover {
            filter: brightness(90%);
        }
    </style>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <h2 style="text-align: center">Your Shopping Cart</h2>
        </div>
        <div class="col-md-4">
            <div class="total">
                <h5>Total price: {{$totalPrice}}</h5>

            </div>

            <div class="coupon-section">
                <input type="text" class="coupon-input" placeholder="Enter coupon code" required>
                <button class="apply-coupon-btn" onclick="applyCoupon()">Apply Coupon</button>
            </div>
        </div>

        <div id="message" class="alert alert-success" style="display: none;"></div>

        <div class="col-md-3">
            <div class="cart-actions" style="margin-bottom: 20px">
                <a href="{{ route('front.checkout') }}" class="btn-checkout">Proceed to Checkout</a>
            </div>
        </div>
    </div>

    <div class="container cart-container">
        @if (count($cartItems) > 0)

            @foreach ($cartItems as $key => $item)
                <div class="cart-item">
                    <img src="{{ asset('uploads/product/' . $item['image']) }}" alt="Product Image">
                    <div class="cart-item-content">
                        <div class="cart-item-title">{{ $item['title'] }}</div>
                        <div class="cart-item-price">Unit Price: Rs {{ $item['price'] }}</div>
                        <div class="cart-item-quantity">
                            Quantity:
                            <input type="" class="quantity-input" value="{{ $item['quantity'] }}"
                                data-key="{{ $key }}" data-price="{{ $item['price'] }}" disabled>
                        </div>
                        <div class="total">Total Price: Rs {{ $item['price'] * $item['quantity'] }}</div>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="updateQuantity({{ $key }})">Update
                                Quantity</button>
                            <button class="btn btn-danger" onclick="removeItem({{ $key }})">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-danger" role="alert">
                No items in the cart.
            </div>
        @endif


    </div>
@endsection

@section('scripts')
    <script>
        function updateQuantity(key) {
            var newQuantity = parseInt(prompt("Enter new quantity:"));

            if (!isNaN(newQuantity) && newQuantity > 0) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/cart/update/${key}`, {
                        method: 'PATCH', // Use the correct method
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            quantity: newQuantity
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error updating quantity in the cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating the quantity.');
                    });
            }
        }

        function removeItem(key) {
            if (confirm("Are you sure you want to remove this item?")) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/cart/remove/${key}`, {
                        method: 'DELETE', // Use the correct method
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error removing item from the cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the item.');
                    });
            }
        }

        function applyCoupon() {
            var couponCode = document.querySelector('.coupon-input').value;
            if(!couponCode){
                return alert('Enter valid coupon code.');
            }

            // Send a POST request to the couponAdd route with the coupon code
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/customer/cart/coupon/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        code: couponCode
                    })
                })
                .then(response => {
                    console.log(response)
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to apply coupon');
                    }
                })
                .then(data => {
                    // Assuming data contains updated total amount after applying coupon
                    document.querySelector('.total').innerHTML = `<h3>Total Amount: Rs ${data.totalAmount}</h3>`;
                    document.querySelector('.coupon-input').value = ""
                    alert(data.message); // Show success message
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to apply coupon.');
                });
        }
    </script>
@endsection
