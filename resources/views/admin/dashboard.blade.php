@extends('layouts.admin')

@section('title', 'Admin Dashboard | Sutra Accessories')

@section('main-content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h2 class="text-white">{{ $newOrdersCount }}</h2>
                        <div class="text-white">Recent Orders</div>
                        <i class="ti-shopping-cart text-white"></i>
                        <div><i class="fa fa-level-up text-white"></i><small class="text-white">25% increase</small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h2 class="text-white">${{ $totalIncome }}</h2>
                        <div class="text-white">Total Revenue</div>
                        <i class="fa fa-money text-white"></i>
                        <div><i class="fa fa-level-up text-white"></i><small class="text-white">22% growth</small></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Latest Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        {{-- <th>Amount</th> --}}
                                        <th>Status</th>
                                        {{-- <th width="91px">Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestOrders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('order.show', $order->id) }}">{{ $order->order_number }}</a>
                                            </td>
                                            <td>{{ \App\Models\User::find($order->user_id)->name }}</td>
                                            {{-- <td>Rs {{ $order->total_amount }}</td> --}}
                                            <td>
                                                @if ($order->condition == 'delivered')
                                                    <span class="badge badge-success">{{ ucfirst($order->condition) }}</span>
                                                @elseif ($order->condition == 'shipped')
                                                    <span class="badge badge-primary">{{ ucfirst($order->condition) }}</span>
                                                @elseif ($order->condition == 'out for delivery')
                                                    <span class="badge badge-info">{{ ucfirst($order->condition) }}</span>
                                                @elseif ($order->condition == 'processing')
                                                    <span class="badge badge-warning">{{ ucfirst($order->condition) }}</span>
                                                @elseif ($order->condition == 'cancelled')
                                                    <span class="badge badge-danger">{{ ucfirst($order->condition) }}</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $order->created_at->format('m/d/Y') }}</td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="text-white">Order Trends</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="orderTrendChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('orderTrendChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Order Trends',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
