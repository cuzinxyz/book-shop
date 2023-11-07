@extends('layouts.app')

@section('title')
    | My Library
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <section class="order-history-wrapper pt-90 pb-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="history-title">
                                    <h4 class="heading-4 font-weight-500 title">My Library</h4>
                                    <p class="paragraph-small">You have
                                        <strong>{{ auth()->user()->wallet->credits }}</strong> credits</p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-9">

                                <div class="row">
                                    @foreach ($books as $book)
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card mb-3">
                                                <a href="{{ route('library.book', $book->slug) }}">
                                                    <img src="{{ $book->cover->getUrl() }}" class="card-img-top"
                                                        alt="{{ $book->title }}" />
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $book->title }}</h5>
                                                    <p class="card-text">
                                                        <small class="text-muted">{{ $book->author->name }} -
                                                            {{ $book->published_date }}</small>
                                                    </p>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="{{ route('library.book', $book->slug) }}"
                                                        class="btn btn-success btn-block">Read Book</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
