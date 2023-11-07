<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $books = Book::latest()->get();

        // return response()->json($books);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $authors = Author::pluck('name', 'id');

        return view('admin.books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $valid = $request->except('cover');

        if($request->pdf_file) {
            $filename = time() . "." . $request->pdf_file->getClientOriginalExtension();
            $request->pdf_file->storeAs('pdf_uploads', $filename, 'public');

            $valid['pdf_file'] = $filename;
            $valid['type_of_book'] = 'ebook';
        }
        // dd($valid['pdf_file']);

        $book = Book::create($valid);
        if ($request->cover) {
            $book->addMedia($request->file('cover'))
            ->toMediaCollection('book');
        }

        return to_route('admin.books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        $book->load('author');

        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        $authors = Author::pluck('name', 'id');

        return view('admin.books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $book = Book::findOrFail($id);

        $book->update($request->all());

        if (!$request->publish) {
            $book->update(['publish' => 0]);
        }

        if ($request->cover) {
            if($book->cover) {
                $book->cover->delete();
            }

            $book->addMedia($request->file('cover'))->toMediaCollection('book');
        }

        return to_route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        // return response()->json([
        //     'message' => 'Deleted Successfully'
        // ]);
        return to_route('admin.books.index');
    }
}
