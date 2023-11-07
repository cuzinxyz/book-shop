@extends('layouts.app')

@section('title')
    | Read book
@endsection

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="col-md-9 col-sm-12">
            <iframe src="{{ asset("storage/pdf_uploads/" . $book->pdf_file) }}" width="100%">
            </iframe>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <style>iframe { min-height: 100vh }</style>
@endpush
