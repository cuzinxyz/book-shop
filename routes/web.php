<?php

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    $books = \App\Models\Book::where('publish', 1)->latest()->get();
    $userBooks = Auth::check() ? auth()->user()->books()->pluck('book_id')->toArray() : [];
    return view('index', compact('books', 'userBooks'));
})->name('home');

Route::post('/search', function(Request $request) {
    if($request->input('search')) {
        $books = Book::where('title', 'LIKE', '%' . $request->input("search") . '%')->with('media', 'author')->get();

        return response()->json([
            'books' => $books,
        ]);
    } else {
        return response()->json([
            'books' => Book::inRandomOrder()->with('media', 'author')->get()
        ]);
    }
})->name('search');

//Route comments
Route::get('/comment/{idBook}', [\App\Http\Controllers\Frontend\BookController::class, 'showComment'])->name('showComment');
Route::post('/comment/{idBook}', [\App\Http\Controllers\Frontend\BookController::class, 'addComment'])->name('addComment');

// Detail page
Route::get('/book/{slug}', function ($slug) {
    $book = \App\Models\Book::where('slug', $slug)->first();

    if($book) {
        if ($book->type_of_book) {
            switch ($book->type_of_book) {
                case 'ebook':
                    return view('ebook', compact('book'));
                    break;
                case 'rbook':
                    return view('rbook', compact('book'));
                    break;
            }
        } else {
            abort(404);
        }
    }else {
        abort(404);
    }
})->name('book');

// Redirect slug id to detail page
Route::get('/book/{id}', function($id) {
    $book = \App\Models\Book::where('id', $id)->first();

    if (!$book) {
        abort(404);
    }
    $slug = $book->slug;
    // Redirect sang trang detail page với slug
    return redirect("/book/".$slug);
})->where('id', '[0-9]+');

Route::view('about', 'about')->name('about');
Route::view('contact', 'contact')->name('contact');

Auth::routes();
// Auth route
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
        Route::get('/', 'HomeController@wallet')->name('index');
        Route::get('{id}/buy', 'HomeController@wallet_buy')->name('buy');
    });

    Route::group(['prefix' => 'library', 'as' => 'library.'], function () {
        Route::get('/', 'HomeController@library')->name('index');
        Route::get('/order', 'HomeController@order')->name('order');
        Route::get('/order/{id}', function($id) {
            $order = Order::findOrFail($id);
            if(!$order) {
                abort(404);
            }
            return view('users.detail-order', [
                'order' => $order
            ]);
        })->name('order.detail');
        Route::get('/{slug}', 'HomeController@book')->name('book');

        Route::get('/{id}/buy', 'HomeController@book_buy')->name('book.buy');
    });

    Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('/success', [StripeController::class, 'success'])->name('success');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
        Route::resource('users', 'UserController')->except(['show']);
        Route::resource('roles', 'RoleController')->except(['show']);
        Route::resource('plans', 'PlanController')->except(['show']);
        Route::resource('authors', 'AuthorController')->except(['show']);
        Route::resource('books', 'BookController');
        Route::resource('order', 'OrderController')->except(['create']);
    });

    // Add to cart
    Route::get('/order/minicart', [\App\Http\Controllers\Frontend\BookController::class, 'getMiniCart'])->name('getMiniCart');
    Route::post('/order/{idBook}', [\App\Http\Controllers\Frontend\BookController::class, 'addToCart'])->name('addToCart');
    // Add to cart

    // update quantity minicart
    Route::post('/updateQuantity', [\App\Http\Controllers\Frontend\BookController::class, 'updateQuantity'])->name('updateQuantity');
    // update quantity minicart

    // remove book from cart
    Route::delete('/removeBookCart', [\App\Http\Controllers\Frontend\BookController::class, 'removeBookCart'])->name('removeBookCart');
    // remove book from cart

    // checkout page
    Route::get('/checkOutCart', [\App\Http\Controllers\Frontend\BookController::class, 'checkOutCart'])->name('checkOutCart');
    Route::post('/checkOutCart', [\App\Http\Controllers\Frontend\BookController::class, 'checkOutOrder']);
    // checkout page
});

Route::get('/admin', function() {
   return view('admin.index');
});
