@extends('layouts.client')

@section('title', 'Checkout - Sutra Accessories')

@section('style')
    <style>
     .check-container {
    max-width: 1000px;
    margin: 50px auto;
    display: flex;
    flex-wrap: wrap; /* Allow cards to wrap on smaller screens */
    gap: 20px;
}

.card {
    flex-basis: calc(50% - 20px); /* Adjust card width */
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    margin-bottom: 20px; /* Add spacing between cards */
}

h2,
h3 {
    color: #333;
    margin-bottom: 15px;
}

.checkout-form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input,
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.text-area {
    resize: vertical;
}

.checkbox-container {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.checkbox-label {
    margin-left: 5px;
    font-weight: normal;
}

.right-card {
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

thead {
    background-color: #f2f2f2;
}

tfoot {
    background-color: #e44d26;
    color: #fff;
}

tfoot td {
    font-weight: bold;
}

.payment-options label {
    margin-right: 15px;
    font-weight: bold;
}

    </style>
@endsection

@section('main-content')
    <div class="check-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="left-card">
            <h2>Checkout</h2>

            <!-- Delivery and Shipping Details Form -->
            <form action="{{ route('front.checkoutStore') }}" method="post" class="checkout-form">
                @csrf

                <div>
                    <h3>Delivery Details</h3>
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" required placeholder="Enter your first name">
                    @error('first_name')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" required placeholder="Enter your last name">
                    @error('last_name')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="email">Email</label>
                    <input type="email" name="email" required placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="phone">Phone</label>
                    <input type="number" name="phone" required placeholder="Enter your phone">
                    @error('phone')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="country">Country</label>
                    <input type="text" name="" value="Nepal" readonly>
                    <input type="text" name="country" value="Nepal" hidden>

                    <label for="address">Address</label>
                    <input type="text" name="address" required placeholder="Enter your address">
                    @error('address')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="city">City</label>
                    <input type="text" name="city" required placeholder="Enter your city">
                    @error('city')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="postcode">Post code</label>
                    <input type="text" name="postcode" required placeholder="Enter your postcode">
                    @error('postcode')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <div for="order-notes" style="font-weight: bold; margin-bottom: 5px">Order Notes</div>
                    <textarea class="text-area" id="order-notes" name="note" placeholder="Write a short note for your order delivery."
                        rows="4" cols="50" style="resize: none"></textarea>
                </div>

                <div>
                    <h3>Shipping Details</h3>
                    <div class="checkbox-container">
                        <div>
                            <input type="checkbox" id="same-address" onclick="copyBillingAddress()">
                        </div>
                        <label class="checkbox-label" for="same-address">Same as Billing Address</label>
                    </div>
                    <label for="sfirst_name">First Name</label>
                    <input type="text" name="sfirst_name" required placeholder="Enter your first name">
                    @error('sfirst_name')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="slast_name">Last Name</label>
                    <input type="text" name="slast_name" required placeholder="Enter your last name">
                    @error('slast_name')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="semail">Email</label>
                    <input type="email" name="semail" required placeholder="Enter your email">
                    @error('semail')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="sphone">Phone</label>
                    <input type="number" name="sphone" required placeholder="Enter your phone">
                    @error('sphone')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="scountry">Country</label>
                    <input type="text" name="" value="Nepal" readonly>
                    <input type="text" name="scountry" value="Nepal" hidden>

                    <label for="saddress">Address</label>
                    <input type="text" name="saddress" required placeholder="Enter your address">
                    @error('saddress')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="scity">City</label>
                    <input type="text" name="scity" required placeholder="Enter your city">
                    @error('scity')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="spostcode">Post code</label>
                    <input type="text" name="spostcode" required placeholder="Enter your postcode">
                    @error('spostcode')
                        <div class="invalid-feedback" style="background-color: #f8d7da; padding: 5px; color: #721c24;">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="hidden" name="sub_total" id="" value={{ $totalPrice }}>
                </div>
            </form>
        </div>

        <div class="right-card">
            <!-- Order Summary -->
            <h3>Order Summary</h3>

            @if (count($cartItems) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>{{ $cartItem['title'] }}</td>
                                <td>{{ $cartItem['quantity'] }}</td>
                                <td>{{ $cartItem['price'] }}</td>
                                <td>{{ $cartItem['quantity'] * $cartItem['price'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td>{{ $totalPrice }}</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Payment Options -->
                <h3 style="margin-top: 20px">Choose Payment Option</h3>
                <div class="payment-options">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="esewa" name="payment_method"
                            value="esewa">
                        <label class="form-check-label" for="esewa">Esewa</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="cod" name="payment_method"
                            value="cod">
                        <label class="form-check-label" for="cod">Cash On Delivery</label>
                    </div>
                </div>

                <!-- Proceed to Payment Button -->
                <button type="button" class="btn btn-primary mx-auto d-block" onclick="proceedToPayment()"
                    style="margin-top: 10px; width: 100%;">Proceed to Payment</button>
            @else
                <p>No items in the cart.</p>
            @endif
        </div>



    </div>
@endsection

@section('scripts')
    <script>
        function copyBillingAddress() {
            // Check if the checkbox is checked
            var isChecked = document.getElementById('same-address').checked;

            if (isChecked) {
                // Copy values from billing address to shipping address
                document.getElementsByName('sfirst_name')[0].value = document.getElementsByName('first_name')[0].value;
                document.getElementsByName('slast_name')[0].value = document.getElementsByName('last_name')[0].value;
                document.getElementsByName('semail')[0].value = document.getElementsByName('email')[0].value;
                document.getElementsByName('sphone')[0].value = document.getElementsByName('phone')[0].value;
                document.getElementsByName('scountry')[0].value = document.getElementsByName('country')[0].value;
                document.getElementsByName('saddress')[0].value = document.getElementsByName('address')[0].value;
                document.getElementsByName('scity')[0].value = document.getElementsByName('city')[0].value;
                document.getElementsByName('spostcode')[0].value = document.getElementsByName('postcode')[0].value;
            } else {
                // Clear values in shipping address
                document.getElementsByName('sfirst_name')[0].value = '';
                document.getElementsByName('slast_name')[0].value = '';
                document.getElementsByName('semail')[0].value = '';
                document.getElementsByName('sphone')[0].value = '';
                document.getElementsByName('scountry')[0].value = '';
                document.getElementsByName('saddress')[0].value = '';
                document.getElementsByName('scity')[0].value = '';
                document.getElementsByName('spostcode')[0].value = '';
            }

            // Check for validation errors and display messages
            checkValidationErrors();
        }

        function checkValidationErrors() {
            var errorElements = document.querySelectorAll('.invalid-feedback');

            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].style.display = 'none';
            }

            var validationErrors = document.querySelectorAll('.is-invalid');

            if (validationErrors.length > 0) {
                // Display error messages
                for (var i = 0; i < validationErrors.length; i++) {
                    var errorElement = validationErrors[i].nextElementSibling;
                    errorElement.style.display = 'block';
                }

                // Prevent form submission
                return false;
            }

            return true;
        }

        function proceedToPayment() {
            // Check for validation errors and proceed only if there are no errors
            if (checkValidationErrors()) {
                var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');

                if (selectedPaymentMethod) {
                    var hiddenPaymentMethodInput = document.createElement("input");
                    hiddenPaymentMethodInput.setAttribute("type", "hidden");
                    hiddenPaymentMethodInput.setAttribute("name", "payment_method");
                    hiddenPaymentMethodInput.setAttribute("value", selectedPaymentMethod.value);
                    document.querySelector('.checkout-form').appendChild(hiddenPaymentMethodInput);

                    document.querySelector('.checkout-form').submit();
                } else {
                    alert('Please select a payment method.');
                }
            }
        }
    </script>
@endsection
