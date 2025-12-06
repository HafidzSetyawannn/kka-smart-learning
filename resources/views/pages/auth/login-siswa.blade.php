<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>Login Siswa - KKA Smart Learning</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    {{-- Icons --}}
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    {{-- Main CSS --}}
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .lilita-font {
            font-family: 'Lilita One', sans-serif;
            letter-spacing: 1px;
        }

        .input-group {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background-color: #fff;
            border: 1px solid #d2d6da;
        }

        .input-group-text {
            border: none;
            background-color: transparent;
            padding-right: 10px;
            color: #adb5bd;
            transition: all 0.3s ease;
        }

        .form-control {
            border: none;
            padding-left: 0;
            background-color: transparent !important;
            height: auto;
        }

        .form-control:focus {
            box-shadow: none;
        }

        /* Efek fokus */
        .input-group:focus-within {
            border-color: #11cdef;
            box-shadow: 0 0 0 2px rgba(17, 205, 239, 0.2);
        }

        .input-group:focus-within .input-group-text {
            color: #11cdef;
        }

        /* Hapus warna autofill ungu Chrome */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #000 !important;
            caret-color: #000;
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
            border-color: #11cdef;
            /* warna fokus siswa */
            box-shadow: 0 0 0 3px rgba(17, 205, 239, 0.15);
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

        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            background-color: #fff !important;
            -webkit-text-fill-color: #000 !important;
        }

        /* --- ANIMASI FLOATING SHAPES (UNTUK SISWA) --- */
        .shapes-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            animation: float 20s infinite linear;
            bottom: -150px;
        }

        /* Variasi Bentuk */
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-duration: 25s;
            border-radius: 50%;
        }

        /* Lingkaran */
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            left: 20%;
            animation-duration: 20s;
            animation-delay: 2s;
            transform: rotate(45deg);
        }

        /* Kotak */
        .shape:nth-child(3) {
            width: 90px;
            height: 90px;
            left: 35%;
            animation-duration: 30s;
            animation-delay: 4s;
            border-radius: 50%;
        }

        .shape:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 50%;
            animation-duration: 22s;
            animation-delay: 0s;
            transform: rotate(45deg);
        }

        .shape:nth-child(5) {
            width: 70px;
            height: 70px;
            left: 65%;
            animation-duration: 28s;
            animation-delay: 6s;
            border-radius: 50%;
        }

        .shape:nth-child(6) {
            width: 100px;
            height: 100px;
            left: 80%;
            animation-duration: 35s;
            animation-delay: 3s;
            transform: rotate(45deg);
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
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
                        {{-- KOLOM KIRI: Form Login Siswa --}}
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder text-info lilita-font" style="font-size: 2rem;">Halo
                                        Siswa👋</h4>
                                    <p class="mb-0 text-sm text-secondary font-weight-bold">Masukkan NIS dan Password
                                        Kamu ya.</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('siswa.login') }}">
                                        @csrf

                                        {{-- Input NIS --}}
                                        <div class="mb-3">
                                            <div class="custom-field">
                                                <!-- ICON IDENTITAS (SAMA SEPERTI LOGIN GURU) -->
                                                <svg viewBox="0 0 24 24">
                                                    <path
                                                        d="M3 4h18a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 2v12h18V6H3zm2 3h6v2H5V9zm0 4h4v2H5v-2z" />
                                                </svg>

                                                <input type="text" name="nis"
                                                    placeholder="Nomor Induk Siswa (NIS)" required autofocus>
                                            </div>
                                        </div>


                                        {{-- Input Password --}}
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



                                        {{-- Tombol Masuk --}}
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg bg-info btn-lg w-100 mt-4 mb-0 text-white">Masuk</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        <a href="{{ route('home') }}"
                                            class="text-info font-weight-bold d-flex align-items-center justify-content-center">
                                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- KOLOM KANAN: Gambar Ilustrasi --}}
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-info h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{ asset('assets/img/background-login.png') }}');
                                        background-size: cover; background-position: center;">

                                <span class="mask bg-gradient-info opacity-6" style="z-index: 0;"></span>

                                {{-- [ANIMASI] BENTUK MENGAMBANG --}}
                                <div class="shapes-container">
                                    <div class="shape"></div>
                                    <div class="shape"></div>
                                    <div class="shape"></div>
                                    <div class="shape"></div>
                                    <div class="shape"></div>
                                    <div class="shape"></div>
                                </div>

                                <div class="position-relative z-index-2 text-center">
                                    <h2 class="mt-5 text-white lilita-font" style="font-size: 2.5rem;">
                                        “Ayo mulai petualanganmu!🚀
                                    </h2>
                                    <p class="text-white h5 mt-3"
                                        style="font-family: 'Nunito', sans-serif; line-height: 1.6;">
                                        Belajar Koding dan Kecerdasan Artifisial dengan permainan, tantangan, dan
                                        hal-hal seru lainnya!”
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
