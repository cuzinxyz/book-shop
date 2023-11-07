<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class BookController extends Controller
{
    function showComment($idBook)
    {
        if (isset($idBook)) {
            $book = Book::find($idBook);
            if ($book) {
                $comments = $book->comments;

                $commentsWithUser = $comments->load('user');

                return response()->json(array(
                    'book' => $commentsWithUser
                ));
            } else {
                return response()->json([
                    'message' => 'Học đâu cái thói mất dạy vậy?'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Múa cái gì?'
            ]);
        }
    }

    function addComment(Request $request, $idBook)
    {
        $book = Book::findOrFail($idBook);
        $book->comment($request->comment, user: auth()->user());

        return response()->json([
            'message' => 'Added Successfully'
        ]);
    }

    function getMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    function addToCart(Request $request, $idBook)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantity = $request->input('quantity');
            $book = Book::find($idBook);
            if ($book) {
                Cart::add([
                    'id' => $idBook,
                    'name' => $book->title,
                    'weight' => 0,
                    'qty' => $quantity,
                    'price' => $book->price,
                    'options' => [
                        'cover' => $book->cover->getUrl()
                    ],
                ]);
                return response()->json([
                    'success' => 'Successfully Added on Your Cart'
                ], 200);
            }
            return response()->json([
                'message' => 'Có lỗi rồi má!'
            ]);
        }
    }

    function updateQuantity(Request $request)
    {
        Cart::update($request->productId, $request->newQuantity); // Will update the quantity

        return response()->json(array(
            Cart::content()
        ));
    }

    function removeBookCart(Request $request)
    {
        if ($request->input('rowId')) {
            Cart::remove($request->input('rowId'));

            return response()->json([
                'success' => 'Successfully remove.'
            ]);
        } else {
            return response()->json([
                'message' => 'Nào không quậy nào.'
            ]);
        }
    }

    function checkOutCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return view('checkout', [
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ]);
    }

    function checkOutOrder(Request $request)
    {
        $order = $request->all();

            $result = Order::create($order);

            if($result) {
                Cart::destroy();
                return response()->json([
                    'message' => 'Order successfully!'
                ]);
            } else {
                return response()->json([
                    'message' => 'Có lỗi xảy ra!'
                ]);
            }

    }
}
