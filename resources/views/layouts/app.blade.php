<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ config('app.url') . '/css/app.css' }}" rel="stylesheet">
    <link href="{{ config('app.url') . '/fonts/fonts.css' }}" rel="stylesheet">

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

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-logo" href="{{ url('/') }}">
                    BookStore
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('library.index') }}" class="nav-link">My Library</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('library.order') }}" class="nav-link">My Order</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (auth()->user()->isAdmin())
                                <li class="nav-item dropdown" x-data="{ open: false }" @click.outside="open = false">
                                    <a class="nav-link dropdown-toggle text-danger" href="#" @click="open = !open">
                                        Manager <span class="caret"></span>
                                    </a>
                                    <div x-show="open" class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('admin.users.index') }}" class="dropdown-item">Users</a>
                                        <a href="{{ route('admin.roles.index') }}" class="dropdown-item">Roles</a>
                                        <a href="{{ route('admin.plans.index') }}" class="dropdown-item">Plans</a>
                                        <a href="{{ route('admin.authors.index') }}" class="dropdown-item">Authors</a>
                                        <a href="{{ route('admin.books.index') }}" class="dropdown-item">Books</a>
                                        <a href="{{ route('admin.order.index') }}" class="dropdown-item">Order</a>
                                    </div>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <strong>Credits</strong>
                                    <span class="badge badge-dark">{{ Auth::user()->wallet->credits }}</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown" x-data="{ open: false }" @click.outside="open = false">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" @click="open = !open">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" x-show="open">
                                    <a class="dropdown-item" href="{{ route('wallet.index') }}">
                                        My Wallet
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>
