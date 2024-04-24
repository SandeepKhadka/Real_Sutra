@extends('layouts.admin')

@section('title', 'Order List | Sutra Accessories')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Details</h3>
                        <div class="card-tools">
                            <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Order Number:</strong> {{ $order_data->order_number }}<br>
                                <strong>User:</strong>
                                {{ \App\Models\User::where('id', $order_data->user_id)->value('name') }}<br>
                                <strong>Payment Method:</strong> {{ $order_data->payment_method }}<br>
                                <strong>Payment Status:</strong>
                                @if ($order_data->payment_status == 'paid')
                                    <span class="badge bg-success">{{ ucfirst($order_data->payment_status) }}</span>
                                @elseif ($order_data->payment_status == 'unpaid')
                                    <span class="badge bg-danger">{{ ucfirst($order_data->payment_status) }}</span>
                                @elseif ($order_data->payment_status == 'redeem')
                                    <span class="badge bg-warning">{{ ucfirst($order_data->payment_status) }}</span>
                                @endif
                                <br>
                                <strong>Sub-total:</strong> Rs {{ number_format($order_data->sub_total, 2) }}<br>
                                <strong>Total:</strong> Rs {{ number_format($order_data->total_amount, 2) }}<br>
                                <strong>Condition:</strong>
                                @if ($order_data->condition == 'delivered')
                                    <span class="badge bg-success">{{ ucfirst($order_data->condition) }}</span>
                                @elseif ($order_data->condition == 'shipped')
                                    <span class="badge bg-primary">{{ ucfirst($order_data->condition) }}</span>
                                @elseif ($order_data->condition == 'out for delivery')
                                    <span class="badge bg-info">{{ ucfirst($order_data->condition) }}</span>
                                @elseif ($order_data->condition == 'processing')
                                    <span class="badge bg-yellow">{{ ucfirst($order_data->condition) }}</span>
                                @elseif ($order_data->condition == 'cancelled')
                                    <span class="badge bg-danger">{{ ucfirst($order_data->condition) }}</span>
                                @endif
                                <div>
                                    <a href="{{ route('order.details', $order_data->id) }}" class="btn btn-primary">
                                        View
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Product Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_data->products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if (file_exists(public_path() . '/uploads/product/Thumb-' . $item->image))
                                                <img src="{{ asset('/uploads/product/Thumb-' . $item->image) }}"
                                                    alt="Product Image" style="max-width: 100px;">
                                            @endif
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>Rs {{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('order.status', $order_data->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order_data->id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Status:</strong>
                                    <select name="condition" class="form-control">
                                        <option value="shipped"
                                            {{ $order_data->condition == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="processing"
                                            {{ $order_data->condition == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="delivered"
                                            {{ $order_data->condition == 'delivered' ? 'selected' : '' }}>Delivered
                                        </option>
                                        <option value="cancelled"
                                            {{ $order_data->condition == 'cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-top: 20px">
                                    <button type="submit" class="btn btn-success">Update Status</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
