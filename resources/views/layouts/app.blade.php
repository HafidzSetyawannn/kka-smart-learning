<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        KKA Smart Learning
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}?v=2.1.0" rel="stylesheet" />

    <style>
        .sidenav .navbar-nav .nav-item .nav-link.active {
            background-color: #3C5078 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .sidenav .navbar-nav .nav-link.active span.nav-link-text,
        .sidenav .navbar-nav .nav-link.active i {
            color: white !important;
            opacity: 1 !important;
        }

        .sidenav .navbar-nav .nav-link.active .icon {
            background-image: none !important;
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .sidenav .navbar-nav>.nav-item.mt-3 {
            margin-top: 1rem !important;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>

    @include('layouts.sidebar')

    <main class="main-content position-relative border-radius-lg d-flex flex-column min-vh-100">

        @include('layouts.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>

        @include('layouts.footer')

    </main>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}?v=2.1.0"></script>
</body>

</html>
