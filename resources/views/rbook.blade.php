@extends('layouts.web')

@section('content')
    <div class="animate__animated animate__slideInUp bg-white py-4 px-3 rounded">
        <div class="row" style="row-gap: 20px">
            <div class="col-lg-3 col-md-5 col-sm-6">
                <figure class="cover-container">
                    <img src="{{ $book->cover->getUrl() }}" class="book-cover rounded shadow-sm" alt="{{ $book->title }}" />
                </figure>
            </div>
            <div class="col-lg-9 col-md-7 col-sm-6">
                <h2 class="font-weight-normal" style="color: #222;font-size:26px">{{ $book->title }}</h2>
                <small class="price font-weight-bold" style="color: #222;font-size: 20px">${{ $book->price }}</small>
                <h5 class="font-weight-lighter mt-2" style="color: #222;font-size: 15px"><span
                        class="text-primary">{{ $book->author->name }}</span> - {{ $book->published_date }}</h5>
                <p>
                    {!! Markdown::parse($book->description) !!}
                </p>
                <div class="checkout d-flex" style="column-gap: 16px">
                    <div class="quantityform d-flex gap-3">
                        <a class="quantity__minus">
                            <span><i class="fa-solid fa-minus"></i></span>
                        </a>
                        <input name="quantity1" type="text" class="quantity__input" value="01">
                        <a class="quantity__plus">
                            <span><i class="fa-solid fa-plus"></i></span>
                        </a>
                    </div>
                    <a id="addToCart" class="btn btn-success btn-block" href="#">
                        Add To Cart
                    </a>
                </div>
            </div>
        </div>

        {{--    Comments box --}}
        <div class="row mt-5">
            <div id="commentBox" class="container w-100">
                <h4 class="mb-1 font-figtree">Comments</h4>
                @auth
                    <div class="row mb-3">
                        <div class="col-12">
                            <form id="addComment" method="POST">
                                <textarea type="text" id="comment" class="input" placeholder="Write a comment"></textarea>
                                <button class='primaryContained w-100' type="submit">
                                    Add Comment
                                </button>
                            </form>
                        </div><!--End Row -->
                    </div><!-- End col -->
                @else
                    <div class="row">
                        <div class="col-12">
                            <p class="text-danger py-2 px-4 border rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                You need to log in to comment!
                            </p>
                        </div>
                    </div>
                @endauth
                <div class="row">
                    <div class="col-12">
                        <div class="comment" id="comments"></div><!--End Comment-->
                    </div><!--End col -->
                </div><!-- End row -->
            </div><!--End Container -->
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <x-comment :book="$book" />
    <x-book-detail :book="$book" />
@endpush
