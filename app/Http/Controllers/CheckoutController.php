<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function viewCheckout(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);

        // Fetch titles and prices
        $cartDetails = [];
        $totalPrice = 0; // Initialize total price

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem['id']);

            if ($product) {
                $cartDetails[] = [
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $cartItem['quantity'],
                    // Add other product details as needed
                ];

                // Calculate total price
                $totalPrice += $product->price * $cartItem['quantity'];
            }
        }

        return view('client.checkout', ['cartItems' => $cartDetails, 'totalPrice' => $totalPrice]);
    }

    public function checkoutStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'email|required|exists:users,email',
            'phone' => 'string|required',
            'address' => 'string|required',
            'city' => 'string|required',
            'country' => 'string|required',
            'state' => 'string|nullable',
            'postcode' => 'numeric|nullable',
            'note' => 'string|nullable',
            'semail' => 'email|required',
            'sphone' => 'string|required',
            'saddress' => 'string|required',
            'scity' => 'string|required',
            'scountry' => 'string|required',
            'sstate' => 'string|nullable',
            'spostcode' => 'numeric|nullable',
            'payment_method' => 'string|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->all());

        $data = $request->except(['_token']);
        $data['oid'] = uniqid();
        $data['sub_total'] = floatval($data['sub_total']);
        $data['user_id'] = auth()->user()->id;
        $data['order_number'] = Str::upper('ORD-' . Str::random(4) . rand(0, 100));
        $data['total_amount'] = $data['sub_total'];
        $data['payment_status'] = 'unpaid';
        $data['condition'] = 'processing';
        $data['delivery_charge'] = 0;
        $order_id = $data['order_number'];
        $this->order->fill($data);
        $status = $this->order->save();

        $cartItems = $request->session()->get('cart', []);
        $cartDetails = [];

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem['id']);

            if ($product) {
                $quantity = $cartItem['quantity'];
                $this->order->products()->attach($product, ['quantity' => $quantity]);
            }
        }

        if ($status) {
            if ($request->payment_method == 'cod') {
                Session::forget('cart');
                return view('client.confirmation', compact('order_id'));
            } else {
                session()->put('oid', $data['oid']);
                $this->esewaPay($data['oid'], $data['total_amount']);
            }
        } else {
            return redirect()->back()->with('error', 'There was problem in placing order');
        }
        // dd($order);
    }

    public function esewaPay($oid, $amount)
    {

        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // config for development
        $config = new Config($successUrl, $failureUrl);

        // initialize eSewa client
        $esewa = new Client($config);

        $esewa->process($oid, $amount, 0, 0, 0);
        // store oid in session
    }

    public function esewaPaySuccess()
    {

        $oid = $_GET['oid'];
        $redId = $_GET['refId'];
        $amount = $_GET['amt'];

        $order = Order::where('oid', $oid)->first();
        $update_status = Order::find($order->id)->update([
            'payment_status' => 'paid'
        ]);
        $order_id = $order->order_number;
        if ($update_status) {
            Session::forget('cart');
            return view('client.confirmation', compact('order_id'));
        }
    }

    public function esewaPayFailed()
    {
        $oid = session()->get('oid') ?? "";
        $order = Order::where('oid', $oid)->first();

        if ($order) {
            $order->delete();
        }
        return redirect()->back()->with('error', 'Your transaction is unsuccessfull');
    }
}
