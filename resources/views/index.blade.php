@extends('layouts.web')

@push('styles')
    <style>
        .book-item {
            display: flex;
            flex-direction: column;
            border-radius: 8px
        }

        .book-item img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-title {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-family: "alibaba-sans", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #222;
            font-size: 14px;
        }

        .card-body {
            background: #fff;
            padding: 12px;
        }

        .card-footer {
            background: #fff;
        }
    </style>
@endpush

@section('content')
{{-- @dd($books) --}}
    <div class="row animate__animated animate__slideInDown">
        <div class="search-input-container mb-5">
            <form id="form-search" method="POST">
                <input type="text" id="search" class="search-input" placeholder="search...">
                <span class="search-icon">
                    <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2"
                                stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                </span>
            </form>
        </div>
    </div>
    <div class="row animate__animated animate__fadeIn" id="list-book" style="row-gap: 20px">
        @foreach ($books as $book)
            {{-- @dd($book) --}}
            <div class="col-12 col-lg-3 col-md-4 col-sm-6 book-item">
                {{-- <div class="card mb-3"> --}}
                <a href="{{ route('book', $book->slug) }}">
                    <img class="branwdo w-100" data-src="{{ $book->cover->getUrl('thumb') }}" class="card-img-top"
                        alt="{{ $book->title }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <small class="price">${{ $book->price }}</small>
                        <p class="card-text">
                            <small class="text-muted">{{ $book->author->name }}</small>
                        </p>
                    </div>
                </a>
                {{-- </div> --}}
            </div>
        @endforeach

        @if($books->count() <= 0)
            <p style="font-size:20px">Chưa có sản phẩm nào cả!</p>
        @endif
    </div>

    @push('scripts')
        <script>
            let images = document.querySelectorAll(".branwdo");
            lazyload(images);

            $(document).ready(function() {
                $("#form-search").on("submit", function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('search') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            search: $("#search").val()
                        },
                        success: function(data) {
                            const response = data.books

                            var booksList = "";
                            $.each(response, function(key, book) {
                                booksList += `
                                <div class="col-lg-3 col-md-4 col-sm-12 book-item">
                                    <a href="/book/${book.slug}">
                                        <img class="branwdo w-100" data-src="{{ config('app.url') }}/storage/${book.media[0].id}/conversions/${book.media[0].name}-thumb.jpg" alt="${book.title}" src="{{ config('app.url') }}/storage/${book.media[0].id}/conversions/${book.media[0].name}-thumb.jpg">
                                        <div class="card-body">
                                            <h5 class="card-title">${book.title}</h5>
                                            <small class="price">$${book.price}</small>
                                            <p class="card-text">
                                                <small class="text-muted">${book.author.name}</small>
                                            </p>
                                        </div>
                                    </a>
                                </div>`;
                            })
                            $("#list-book").html(`
                                <div class="dot-spinner">
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                    <div class="dot-spinner__dot"></div>
                                </div>
                            `);
                            setTimeout(() => {
                                $("#list-book").html(booksList)
                            }, 200);
                        }
                    })
                })
            });
        </script>
    @endpush
@endsection
