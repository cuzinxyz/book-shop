@extends('layouts.web')

@section('content')
    <div class="animate__animated animate__slideInUp bg-white py-4 px-3 rounded">
        <div class="row" style="row-gap: 20px">
            <div class="col-lg-3 col-md-5 col-sm-6">
                <figure class="cover-container">
                    <img src="{{ $book->cover->getUrl() }}" class="book-cover rounded shadow-sm" alt="{{ $book->title }}"/>
                </figure>
            </div>
            <div class="col-lg-9 col-md-7 col-sm-6">
                <h2 class="font-weight-normal" style="color: #222;font-size:26px">{{ $book->title }}</h2>
                <small class="price font-weight-bold" style="color: #222;font-size: 20px">${{ $book->price }}</small>
                <h5 class="font-weight-lighter mt-2" style="color: #222;font-size: 15px"><span class="text-primary">{{ $book->author->name }}</span> - {{ $book->published_date }}</h5>
                <p>
                    {!! Markdown::parse($book->description) !!}
                </p>
                <div class="checkout">
                    <a href="{{ route('library.book.buy', $book->id) }}" class="btn btn-warning btn-block"
                       onclick="sendSaleToGa()">Buy for {{ $book->price }} credits</a>
                </div>
            </div>
        </div>

        {{--    Comments box--}}
        <div class="row mt-5">
            <div id="commentBox" class="container w-100">
                <h4 class="mb-1 font-figtree">Comments</h4>
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
    <style>
        .comment {
            display: block;
            transition: all .21s;
        }

        .commentClicked {
            min-height: 0px;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 5px 10px
        }

        #commentBox p {
            margin: 16px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #f1f1f1;
        }

        #commentBox p:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        #commentBox textarea {
            width: 100%;
            border: none;
            background: #E8E8E8;
            padding: 5px 10px;
            height: 100px;
            border-radius: 5px 5px 0px 0px;
            border-bottom: 2px solid #016BA8;
            transition: all 0.5s;
            margin-top: 15px;
        }

        button.primaryContained {
            background: #016ba8;
            color: #fff;
            padding: 10px 10px;
            border: none;
            margin-top: 0px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 4px;
            box-shadow: 0px 2px 6px 0px rgba(0, 0, 0, 0.25);
            transition: 1s all;
            font-size: 10px;
            border-radius: 5px;
        }

        button.primaryContained:hover {
            background: #9201A8;
        }
    </style>
@endpush

@push('scripts')
    <x-comment :book="$book" />
@endpush
