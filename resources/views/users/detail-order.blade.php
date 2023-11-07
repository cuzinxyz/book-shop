@extends('layouts.app')

@section('title')
    | My Library
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/order-detail.css') }}">
@endpush

@section('content')
    <div class="container-fluid order-detail-page">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <section class="order-id-wrapper pb-100">
                    <div class="container d-flex justify-content-between mb-3">
                        <a class="text-black-50" href="{{ url()->previous() }}"><i class="fa-solid fa-angle-left"></i> return to order list</a>
                    </div>
                    <div class="container bg-white rounded py-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="order-id-content">
                                    <h4 class="order-id">Order ID: {{ $order->id }}</h4>
                                    <ul class="order-meta">
                                        <li><a class="product" href="#0">{{ sizeof($order->cart_orders) }} Product</a></li>
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
                                            <p class="text-capitalize">{{ $class }}</p>
                                        </div>
                                        <div class="progress-bar-inner">
                                            <div class="bar-inner bar-inner-2">
                                                <div class="progress-horizontal">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-track">
                                            <p>Track Order</p>
                                        </div>
                                    </div>
                                    <span class="order-price">${{ $order->cart_total }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="order-product mt-30">
                                            <div class="order-title">
                                                <h5 class="title">Ordered Products</h5>
                                            </div>
                                            <div class="order-product-table table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($order->cart_orders as $book)
                                                        <tr>
                                                            <td class="product">
                                                                <div class="order-product-item d-flex">
                                                                    <div class="product-thumb">
                                                                        <img width="48" height="48" src="{{ $book['options']['cover'] }}"
                                                                            alt="{{ $book['name'] }}">
                                                                    </div>
                                                                    <div class="product-content media-body">
                                                                        <h5 class="title">
                                                                            <a href="#0">{{ $book['name'] }}</a>
                                                                        </h5>
                                                                        <ul>
                                                                            <li><span>{{ $book['qty'] }} X {{ $book['price'] }}</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                <p class="product-price">${{ $book['subtotal'] }}</p>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        {{-- <tr>
                                                            <td class="product">
                                                                <div class="order-product-item d-flex">
                                                                    <div class="product-thumb">
                                                                        <img src="https://demo.ecommercehtml.com/assets/images/product-cart/product-2.png"
                                                                            alt="product">
                                                                    </div>
                                                                    <div class="product-content media-body">
                                                                        <h5 class="title">
                                                                            <a href="#0">Mist Black Triblend</a>
                                                                        </h5>
                                                                        <ul>
                                                                            <li><span>Brown</span></li>
                                                                            <li><span>XL</span></li>
                                                                            <li><span>1 X 36.00</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                <p class="product-price">$36.00</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product">
                                                                <div class="order-product-item d-flex">
                                                                    <div class="product-thumb">
                                                                        <img src="https://demo.ecommercehtml.com/assets/images/product-cart/product-3.png"
                                                                            alt="product">
                                                                    </div>
                                                                    <div class="product-content media-body">
                                                                        <h5 class="title">
                                                                            <a href="#0">Realm Bone</a>
                                                                        </h5>
                                                                        <ul>
                                                                            <li><span>Brown</span></li>
                                                                            <li><span>XL</span></li>
                                                                            <li><span>1 X 36.00</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                <p class="product-price">$36.00</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product">
                                                                <div class="order-product-item d-flex">
                                                                    <div class="product-thumb">
                                                                        <img src="https://demo.ecommercehtml.com/assets/images/product-cart/product-4.png"
                                                                            alt="product">
                                                                    </div>
                                                                    <div class="product-content media-body">
                                                                        <h5 class="title">
                                                                            <a href="#0">Circular Sienna</a>
                                                                        </h5>
                                                                        <ul>
                                                                            <li><span>Brown</span></li>
                                                                            <li><span>XL</span></li>
                                                                            <li><span>1 X 36.00</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                <p class="product-price">$36.00</p>
                                                            </td>
                                                        </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="order-product-total">
                                                <div class="sub-total">
                                                    <p class="value">Subotal Price:</p>
                                                    <p class="price">${{ $order->cart_total }}</p>
                                                </div>
                                                <div class="sub-total">
                                                    <p class="value">Discount (-):</p>
                                                    <p class="price">$10.00</p>
                                                </div>
                                            </div>
                                            <div class="payable-total">
                                                <p class="value">Total Payable:</p>
                                                <p class="price">${{ $order->cart_total }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="single-order-details mt-30">
                                            <div class="order-title">
                                                <h5 class="title">Ordered Products</h5>
                                            </div>
                                            <div class="order-details-content">
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Order ID:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p>{{ $order->id }}</p>
                                                    </div>
                                                </div>
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Date &amp; Time:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p title="{{ $order->created_at }}">{{ $order->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-order-details mt-25">
                                            <div class="order-title">
                                                <h5 class="title">Shipping Address</h5>
                                            </div>
                                            <div class="order-details-content">
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Name:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p>{{ $order->fullname }}</p>
                                                    </div>
                                                </div>
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Email:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p>{!! $order->email ? $order->email : '<i class="fa-solid fa-xmark"></i>' !!}</p>
                                                    </div>
                                                </div>
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Phone:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p>{{ $order->phone_number }}</p>
                                                    </div>
                                                </div>
                                                <div class="single-details-item d-flex flex-wrap">
                                                    <div class="details-title">
                                                        <h6 class="title">Mailing Address:</h6>
                                                    </div>
                                                    <div class="details-content">
                                                        <p>
                                                            {{ $order->address }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="order-policy mt-30">
                                            <div class="order-title">
                                                <h5 class="title">Cancellation Policy</h5>
                                            </div>
                                            <div class="policy-content">
                                                <p>Cancellation Policy goes here.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="order-btn pt-20">
                                            <a href="{{ route('admin.order.edit', $order->id) }}?status=2" class="main-btn error-btn-text">Cancel order</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
