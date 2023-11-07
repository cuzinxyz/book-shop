<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }} | Your favorite book store</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/web.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/fonts.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AminateCSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Toastr library -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

    <!-- Styles -->
    @stack('styles')
</head>

<body>
    <div class="load-relative">
        <div class="load-animation">
            <div class="three-body">
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
                <div class="three-body__dot"></div>
            </div>
        </div>
    </div>

    <div id="app">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links d-flex align-items-center">
                    @auth
                        <a href="#" id="btnMiniCart">
                            <i class="fa-solid fa-cart-shopping fsz-10"></i> <span class="badge badge-danger"
                                id="cartQty">0</span>
                        </a>

                        <div class="modal fade show" id="miniCartModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered animate__animated animate__bounceIn"
                                role="document">
                                <div class="modal-content border-0" style="border-radius: 16px">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Your Shopping Cart
                                        </h5>
                                        <button type="button" class="closeCart border-0" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-image">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="miniCartBooks">
                                                {{-- books here --}}
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <h5>Total: <span class="price text-success" id="cartSubTotal">0$</span></h5>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-between">
                                        <button type="button" class="btn btn-sm btn-light closeCart"
                                            data-dismiss="modal">Close
                                        </button>
                                        <button type="button" id="checkout"
                                            class="btn btn-outline-success">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/library') }}">
                            Profile
                            <span class="badge badge-dark">$ {{ Auth::user()->wallet->credits }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container-fluid banner">
                <div class="container header-navbar animate__animated animate__bounce">
                    <a href="/">Book store</a>
                    @php
                        $slug = \App\Models\Book::select('slug')
                            ->inRandomOrder()
                            ->pluck('slug')
                            ->first();
                    @endphp
                    <a href="{{ route('book', $slug) }}">Random book</a>
                    <a href="#">About us</a>
                </div>
            </div>

            <div class="container my-5 py-3 rounded">
                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger bg-danger text-white alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        {!! $message !!}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>

        <div class="container-fluid bg-white">
            <div class="container">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-4 border-top">
                    <p class="mb-0 text-muted">© 2023 BookStore, Inc</p>

                    <ul class="nav justify-content-end">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                    </ul>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lazyload.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @stack('scripts')

    <x-minicart />

</body>

</html>
