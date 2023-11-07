@extends('layouts.app')

@section('title')
    | My Library
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my-order.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <section class="order-history-wrapper pt-90 pb-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="history-title">
                                    <h4 class="heading-4 font-weight-500 title">Order History</h4>
                                    <p class="paragraph-small">Your all the orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                @foreach ($orders as $order)
                                <div class="single-order" onclick="window.location.href='{{ route('library.order.detail', $order->id) }}'">
                                    <h4 class="order-id">Order ID: {{ $order->id }}</h4>
                                    <ul class="order-meta">
                                        <li><a class="product" href="#0">{{ sizeof($order->cart_orders) }} Product</a></li>
                                        <li><a class="date" href="#0" title="{{ $order->created_at }}">{{ $order->created_at->diffForHumans() }}</a></li>
                                    </ul>

                                    @php
                                        if($order->status_order == 1) {
                                            $class = 'shipped';
                                        } elseif($order->status_order == 2) {
                                            $class = 'cancelled';
                                        } elseif($order->status_order == 3) {
                                            $class = 'delivered';
                                        } else {
                                            $class = 'ready';
                                        }
                                    @endphp
                                    <div class="single-progress-bar-horizontal {{ $class }}">
                                        <div class="progress-text">
                                            <p>{{ $class }}</p>
                                        </div>
                                        <div class="progress-bar-inner">
                                            <div class="bar-inner">
                                                <div class="progress-horizontal"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="order-price">${{ $order->cart_total }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
