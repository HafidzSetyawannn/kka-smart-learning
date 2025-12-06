<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>Login Guru - KKA Smart Learning</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        .lilita-font {
            font-family: 'Lilita One', sans-serif;
            letter-spacing: 1px;
        }

        .custom-field {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #ffffff;
            border: 1px solid #d9dde2;
            border-radius: 12px;
            padding: 12px 16px;
            transition: .2s ease;
        }

        .custom-field:focus-within {
            border-color: #5e72e4;
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.15);
        }

        .custom-field svg {
            width: 20px;
            height: 20px;
            fill: #3f4a5a;
            opacity: 0.8;
        }

        .custom-field input {
            border: none;
            outline: none;
            width: 100%;
            background: transparent;
            font-size: 15px;
            color: #3f4a5a;
        }

        .custom-field input::placeholder {
            color: #9aa1b1;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            box-shadow: 0 0 0 1000px #ffffff inset !important;
            background-color: #ffffff !important;
            color: #000 !important;
        }

        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0;
            z-index: 1;
            /* Di atas background, di bawah teks */
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            /* Kotak transparan */
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }
    </style>

</head>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">

                        {{-- FORM LOGIN --}}
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder text-primary lilita-font" style="font-size: 2rem;">
                                        Halo Bapak/Ibu Guru
                                    </h4>
                                    <p class="mb-0 text-sm text-secondary">
                                        Silakan masukkan email dan password untuk mengelola pembelajaran.
                                    </p>
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        {{-- EMAIL --}}
                                        <div class="mb-3">
                                            <div class="custom-field">
                                                <!-- ICON EMAIL -->
                                                <svg viewBox="0 0 24 24">
                                                    <path
                                                        d="M3 4h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 2v12h18V6H3zm2 3h6v2H5V9zm0 4h4v2H5v-2z" />
                                                </svg>

                                                <input type="email" name="email" placeholder="Masukkan Email"
                                                    required autofocus>
                                            </div>
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="mb-3">
                                            <div class="custom-field">
                                                <!-- ICON LOCK -->
                                                <svg viewBox="0 0 24 24">
                                                    <path
                                                        d="M17 8V7a5 5 0 0 0-10 0v1H5v14h14V8h-2zm-8-1a3 3 0 0 1 6 0v1H9V7zm3 5a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
                                                </svg>

                                                <input type="password" name="password" placeholder="Masukkan Password"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-gradient-primary w-100 mt-4 mb-0">
                                                Masuk
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        <a href="{{ route('home') }}"
                                            class="text-primary font-weight-bold d-flex align-items-center justify-content-center">
                                            <i class="ni ni-bold-left me-2"></i> Kembali ke Beranda
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- GAMBAR SAMPING --}}
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                                        background-size: cover;">

                                <span class="mask bg-gradient-primary opacity-6" style="z-index: 0;"></span>

                                {{-- Animasi Partikel --}}
                                <ul class="circles">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>

                                <div class="position-relative z-index-2">
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative"
                                        style="font-family: 'Nunito', sans-serif; line-height: 1.6;">
                                        "Anak-anak hidup dan tumbuh sesuai kodratnya sendiri.
                                        Pendidik hanya dapat merawat dan menuntun tumbuhnya kodrat itu."
                                    </h4>

                                    <p class="text-white position-relative"
                                        style="font-family: 'Nunito', sans-serif; line-height: 1.6;">
                                        - Ki Hajar Dewantara -
                                    </p>

                                    <br><br>

                                    <p class="text-white position-relative"
                                        style="font-family: 'Nunito', sans-serif; line-height: 1.6;">
                                        Website KKA Smart Learning hadir untuk membantu Bapak/Ibu Guru
                                        membimbing generasi digital menuju masa depan yang lebih cerah.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Scripts --}}
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>

</body>

</html>
