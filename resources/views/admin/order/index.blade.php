@extends('layouts.app')

@section('title')
    | Order
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Order history</h5>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>ID Receipt</th>
                            <th>Status</th>
                            <th></th>
                        </thead>

                        <tbody>
                            @foreach ($orders as $key=>$order)
                @php
                    if($order->status_order == 1) {
                        $class = '<span class="font-weight-light px-1 py-2 rounded text-white bg-primary">shipped</span>';
                    } elseif($order->status_order == 2) {
                        $class = '<span class="font-weight-light px-1 py-2 rounded text-white bg-danger">cancel</span>';
                    } elseif($order->status_order == 3) {
                        $class = '<span class="font-weight-light px-1 py-2 rounded text-white bg-success">delivered</span>';
                    } else {
                        $class = '<span class="font-weight-light px-1 py-2 rounded text-white bg-warning">waiting</span>';
                    }
                @endphp
                            <tr>
                                {{-- @dd($order) --}}
                                <td>{{ ++$key }}</td>
                                <td><span class="font-weight-bold">{{ $order->id }}</span> - {{ $order->user->name }} - qty: {{ sizeof($order->cart_orders) }}</td>
                                <td>
                                    {!! $class !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="bg-primary text-white rounded py-1 px-2">view now</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
