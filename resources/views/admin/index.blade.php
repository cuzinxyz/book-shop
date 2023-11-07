<!DOCTYPE html>
<html>

<head>
    <title>Mini Admin Panel - Coding Debugging</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;600;700;800&display=swap">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- My Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="admin-panel clearfix">
        @include('admin.components.sidebar')

        <div class="main">
            <ul class="topbar clearfix">
                <li><a href="#dashboard"><i class="fas fa-home"></i></a></li>
                <li><a href="#users"><i class="fas fa-user"></i></a></li>
                <li><a href="#settings"><i class="fas fa-code"></i></a></li>
            </ul>
            <div class="mainContent clearfix">

                @include('admin.components.dashboard')

                @include('admin.components.order')

                @include('admin.components.books')

                @include('admin.components.authors')

                @include('admin.components.users')

            </div>
            <ul class="statusbar">
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li class="logout"><a href="#dashboard"><i class="fas fa-home"></i></a></li>
                <li class="profiles-setting"><a href="#users"><i class="fas fa-user"></i></a></li>
            </ul>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/admin-panel.js') }}"></script>

    @stack('scripts')
</body>

</html>
