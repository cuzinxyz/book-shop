@extends('layouts.app')

@section('title')
    | New Book
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>New Book</h5>
                        <a href="{{ URL::previous() }}" class="btn btn-danger btn-sm">Back</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="title"><strong>Title:</strong></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="enter title"
                                            name="title" id="title" required autofocus />
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price"><strong>Price:</strong></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="enter price"
                                            name="price" id="price" min="0" step="0.10" required />
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="published_date"><strong>Published Date:</strong></label>
                                        <input type="text" class="form-control @error('published_date') is-invalid @enderror" placeholder="ex: 20/08/2022"
                                            name="published_date" id="published_date" required placeholder="19xx" />
                                        @error('published_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><strong>Description:</strong></label>
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="author_id"><strong>Author:</strong></label>
                                        <select name="author_id" class="form-control" id="author_id">
                                            <option value="" selected disabled>Pick an author</option>
                                            @foreach ($authors as $id => $author)
                                                <option value="{{ $id }}">{{ $author }}</option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cover"><strong>Book Cover:</strong></label>
                                        <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                            name="cover" id="cover" required />
                                        @error('cover')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex" style="gap: 10px">
                                        <strong>Publish:</strong>
                                        <input class="tgl tgl-ios" id="publish" type="checkbox" name="publish"
                                            value="1" />
                                        <label class="tgl-btn" for="publish"></label>

                                        @error('publish')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Kind of book</strong></label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_of_book"
                                                id="exampleRadios1" value="ebook">
                                            <label class="form-check-label" for="exampleRadios1">
                                                e-Book
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_of_book"
                                                id="exampleRadios2" value="rbook" checked>
                                            <label class="form-check-label" for="exampleRadios2">
                                                Book
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group pdf-upload">
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <button type="submit" class="btn btn-outline-primary btn-block">Publish book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
@endpush

@push('scripts')
    <script>
        //    markdown editor
        var simplemde = new SimpleMDE({
            element: document.getElementById("description")
        });

        const radioButtons = document.querySelectorAll('input[name="type_of_book"]');

        // console.log(radioButtons);
        let selectedBook;
        for (const radioButton of radioButtons) {
            radioButton.addEventListener("change", () => {


                if (radioButton.checked) {
                    selectedBook = radioButton.value;
                    // console.log(selectedBook);
                    if (selectedBook == 'ebook') {
                        document.querySelector(".pdf-upload").style.display = "block"
                        document.querySelector(".pdf-upload").innerHTML = `
                        <label for="pdf"><strong>Book File (pdf):</strong></label>
                        <input type="file" id="pdf" class="form-control" name="pdf_file" accept="application/pdf" />
                        `;
                    } else {
                        document.querySelector(".pdf-upload").style.display = "none"
                    }
                }



            })
        }
    </script>
@endpush
