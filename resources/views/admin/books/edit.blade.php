@extends('layouts.app')

@section('title')
    | Edit Book
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit Book</h5>
                        <a href="{{ URL::previous() }}" class="btn btn-danger btn-sm">Back</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.books.update', $book->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <label for="title"><strong>Title:</strong></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $book->title }}" id="title" required autofocus />
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price"><strong>Price:</strong></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price" value="{{ $book->price }}" id="price" min="0"
                                            step="0.10" required />
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="published_date"><strong>Published Date:</strong></label>
                                        <input type="text"
                                            class="form-control @error('published_date') is-invalid @enderror"
                                            name="published_date" value="{{ $book->published_date }}" id="published_date"
                                            required placeholder="19xx" />
                                        @error('published_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><strong>Description:</strong></label>
                                        <textarea name="description" id="description">{{ $book->description }}</textarea>
                                    </div>
                                    <hr />
                                    <button type="submit" class="btn btn-outline-primary btn-block">UPDATE</button>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    {{-- author  --}}
                                    <div class="form-group">
                                        <label for="author_id"><strong>Author:</strong></label>
                                        <select name="author_id" class="form-control" id="author_id">
                                            @foreach ($authors as $id => $author)
                                                <option value="{{ $id }}"
                                                    {{ $book->author_id == $id ? 'selected' : '' }}>{{ $author }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- cover --}}
                                    <div class="form-group">
                                        <label for="cover"><strong>Book Cover:</strong></label>
                                        <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                            name="cover" id="cover" />
                                        @error('cover')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- publish --}}
                                    <div class="form-group d-flex" style="gap: 10px">
                                        <strong>Publish:</strong>
                                        <input class="tgl tgl-ios" id="publish" type="checkbox" name="publish"
                                            value="1" {{ $book->publish ? 'checked' : '' }} />
                                        <label class="tgl-btn" for="publish"></label>

                                        @error('publish')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img class="rounded shadow-sm" src="{{ $book->cover->getUrl('thumb') }}" alt="">
                                    </div>
                                </div>

                            </div>
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
    </script>
@endpush
