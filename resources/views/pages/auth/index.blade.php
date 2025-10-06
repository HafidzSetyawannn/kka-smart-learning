<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        SD Negeri Ngambon 1
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"
        integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .card-header h4,
        .btn-primary {
            font-family: 'Lilita One', sans-serif;
            letter-spacing: 0.07em;
            font-size: 1.1rem;
        }

        .card-header h4 {
            font-size: 2rem;
        }

        .input-group-text {
            border-right: 0;
            background-color: #fff;
        }

        .form-control {
            border-left: 0;
        }

        .input-group .form-control:focus {
            border-left: 0;
            box-shadow: none;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-text-fill-color: #495057;
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .input-group .form-control {
            padding-left: 0.5rem;
        }
    </style>
</head>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Belajar Yuk!</h4>
                                    <p class="mb-0">Masukkan nama pengguna dan kata sandimu ya.</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3 input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="email" class="form-control form-control-lg"
                                                placeholder="Nama Pengguna" required autofocus>
                                        </div>
                                        <div class="mb-3 input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                placeholder="Kata Sandi" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary w-100 mt-4 mb-0">Ayo
                                                Masuk!</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Belum punya akun?
                                        <a href="javascript:;"
                                            class="text-primary text-gradient font-weight-bold">Daftar di sini</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/background-login.png') }}');
                                background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <div class="position-relative text-center">
                                    <h2 class="mt-5 text-white lilita-one-regular" style="font-size: 2.5rem;">
                                        Selamat Datang!
                                    </h2>
                                    <p class="text-white h5" style="font-family: 'Nunito', sans-serif;">
                                        Ayo mulai belajar Koding dan Kecerdasan Artifisial jadi lebih seru!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
</body>

</html>
