@extends('layouts.app')

@section('title')
    | Order
@endsection

@push('styles')
    <style>
        .table thead th {
            white-space: nowrap !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="my-3 text-center">
                    <a href="{{ route('admin.order.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-compact-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223z" />
                        </svg> back to list</a>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Order detail: {{ $order->id }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 border-right">
                                <h4>Customer Infomation</h4>
                                <table class="table table-borderless">
                                    <thead>
                                        <th>Fullname</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Account</th>
                                    </thead>
                                    <tbody>
                                        {{-- @php
                                            dd($order)
                                        @endphp --}}
                                        <tr>
                                            <td>{{ $order->fullname }}</td>
                                            <td>{{ $order->phone_number }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->user->name }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <h4>Order List</h4>
                                <div style="overflow-x:auto;">
                                    <table class="table table-borderless">
                                        <thead>
                                            <th>#</th>
                                            <th>ID Book</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                        </thead>

                                        <tbody>
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($order->cart_orders as $key => $c_order)
                                                <tr>
                                                    <td>{{ $index++ }}</td>
                                                    <td>{{ $c_order['id'] }}</td>
                                                    <td>{{ $c_order['name'] }}</td>
                                                    <td>{{ $c_order['qty'] }}</td>
                                                    <td>{{ $c_order['price'] }}</td>
                                                    <td>{{ $c_order['subtotal'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center align-items-center">
                            <a href="{{ route('admin.order.edit', $order->id) }}?status=1" class="card-link">Shipped</a>
                            <a href="{{ route('admin.order.edit', $order->id) }}?status=2"
                                class="card-link text-danger">Cancel this order</a>
                            <a href="{{ route('admin.order.edit', $order->id) }}?status=3"
                                class="card-link text-success">Done</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Thông tin về đơn hàng:
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tổng tiền đơn hàng: <span
                                class="display-4">{{ $order->cart_total }}</span></li>
                        <li class="list-group-item">Trạng thái: <span class="display-4">
                                @php
                                    if ($order->status_order == 1) {
                                        echo '<span class="text-primary">Shipping</span>';
                                    } elseif ($order->status_order == 2) {
                                        echo '<span class="text-danger">Cancel</span>';
                                    } elseif ($order->status_order == 3) {
                                        echo '<span class="text-success">Done</span>';
                                    } else {
                                        echo '<span class="text-warning">Waiting</span>';
                                    }
                                @endphp

                            </span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
