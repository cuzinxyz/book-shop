<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        // dd($order);
        // return response()->json($authors);
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        Author::create($request->all());

        // return response()->json([
        //     'message' => 'Added Successfully',
        // ]);
        return redirect()->route('admin.authors.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        // dd($order);

        return view('admin.order.show', [
            'order' => $order
        ]);
    }

    public function edit($id, Request $request)
    {
        $order = Order::findOrFail($id);
        // dd($request->status);
        if( $request->status ) {
            $order->status_order = $request->status;

            $order->save();

            return redirect()->back()->with('status', 'Sửa thành công trạng thái đơn hàng!');
        }
        dd(123123);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $author->update($request->all());

        return redirect()->route('admin.authors.index');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        $author->delete();

        return redirect()->route('admin.authors.index');
    }
}
