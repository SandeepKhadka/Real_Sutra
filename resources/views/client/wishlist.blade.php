@extends('layouts.client')

@section('title', 'Sutra Accessories')

@section('style')
    <style>
        .cart-container {
            margin-top: 50px;
            margin-bottom: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .cart-card {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .cart-card-content {
            padding: 20px;
        }

        .cart-card-content h3 {
            margin-bottom: 10px;
        }

        .cart-card-content p {
            margin-bottom: 20px;
        }

        .cart-actions {
            display: flex;
            justify-content: flex-end;
        }

        .btn-add-to-cart,
        .btn-remove {
            background-color: #e44d26;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }

        .flash-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
            font-size: 16px;
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
    <h2 style="text-align: center">Your Wishlist</h2>
    <div class="container cart-container">
        @if (count($wishlists) > 0)

            @foreach ($wishlists as $key => $item)
                <div class="cart-card">
                    <img src="{{ asset('uploads/product/' . $item['image']) }}" alt="Product Image">
                    <div class="cart-card-content">
                        <h5>{{ $item['title'] }}</h5>
                        <p>Unit Price: Rs {{ $item['price'] }}</p>
                        <div class="cart-actions">
                            <form action="{{ route('product.addToCart', ['id' => $item['id']]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn-add-to-cart" style="background-color: green">Add to
                                    Cart</button>
                            </form>
                            <button class="btn-remove" onclick="removeItem({{ $key }})">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-danger" role="alert">
                No items in the wishist.
            </div>
        @endif

        @if (session('success') || session('info'))
            <div class="flash-message">
                <div class="flash-content">
                    <p>{{ session('success') ?? session('info') }}</p>
                    <span class="close-btn" onclick="closeFlashMessage()">&times;</span>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function removeItem(key) {
            if (confirm("Are you sure you want to remove this item?")) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/wishlist/remove/${key}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Error removing item from the wishlist.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the item.');
                    });
            }
        }

        function closeFlashMessage() {
            document.querySelector('.flash-message').style.display = 'none';
        }

        setTimeout(function() {
            document.querySelector('.flash-message').style.display = 'none';
        }, 5000);
    </script>
@endsection
