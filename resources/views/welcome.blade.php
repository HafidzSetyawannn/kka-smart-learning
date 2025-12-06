<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>KKA Smart Learning - Selamat Datang</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .lilita-font {
            font-family: 'Lilita One', sans-serif;
            letter-spacing: 1.5px;
        }

        .nunito-font {
            font-family: 'Nunito', sans-serif;
        }

        body {
            background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #5e72e4, #11cdef);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #ffffff;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .glass-card:hover {
            transform: translateY(-15px) scale(1.02);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 45px rgba(31, 38, 135, 0.5);
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            font-size: 2.5rem;
            color: white;
            transition: all 0.4s ease;
        }

        .teacher-icon {
            background: linear-gradient(45deg, #f5365c, #fb6340);
            box-shadow: 0 4px 20px rgba(245, 54, 92, 0.4);
        }

        .student-icon {
            background: linear-gradient(45deg, #11cdef, #2dce89);
            box-shadow: 0 4px 20px rgba(17, 205, 239, 0.4);
        }

        .glass-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(10deg);
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #302b63;
            transform: translateY(-3px);
        }

        .slide-in-bottom {
            animation: slideInBottom 1s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }

        @keyframes slideInBottom {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .navbar-brand,
        .footer p {
            color: rgba(255, 255, 255, 0.8) !important;
        }
    </style>
</head>

<body class="">
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent">
        <div class="container justify-content-center">
            <a class="navbar-brand font-weight-bolder text-lg lilita-font" href="{{ route('home') }}"
                style="letter-spacing: 2px;">
                <i class="fas fa-brain me-2"></i> KKA SMART LEARNING
            </a>
        </div>
    </nav>

    <main class="main-content mt-0">
        <div class="page-header min-vh-45 pt-5 pb-0 m-3 border-radius-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center mx-auto slide-in-bottom">
                        <i class="fas fa-rocket text-white mb-4"
                            style="font-size: 4rem; text-shadow: 0 0 20px rgba(255,255,255,0.3);"></i>
                        <h1 class="text-white mb-3 mt-2 lilita-font"
                            style="font-size: 4rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                            Selamat Datang!
                        </h1>
                        <p class="text-lead text-white nunito-font opacity-9"
                            style="font-size: 1.3rem; font-weight: 300;">
                            Siap menjelajahi dunia <strong>Koding</strong> & <strong>Kecerdasan Artifisial</strong>?
                            <br>
                            Pilih peranmu untuk memulai petualangan!
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row justify-content-center mt-4">
                <div class="col-xl-4 col-lg-5 col-md-6 mb-4 slide-in-bottom delay-2">
                    <div class="card glass-card h-100 p-4 text-center">
                        <div class="icon-wrapper teacher-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="text-white lilita-font mb-3">Akses Guru</h3>
                        <p class="text-white opacity-8 nunito-font mb-4">
                            Kelola kelas, buat materi pembelajaran, susun kuis interaktif, dan pantau progres siswa.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-glass btn-lg w-100 mb-0 mt-auto">
                            Masuk Guru <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 col-md-6 mb-4 slide-in-bottom delay-3">
                    <div class="card glass-card h-100 p-4 text-center">
                        <div class="icon-wrapper student-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3 class="text-white lilita-font mb-3">Akses Siswa</h3>
                        <p class="text-white opacity-8 nunito-font mb-4">
                            Mulai belajar dengan seru, kerjakan tantangan koding, dan raih prestasi tertinggimu!
                        </p>
                        <a href="{{ route('siswa.login') }}" class="btn btn-glass btn-lg w-100 mb-0 mt-auto">
                            Masuk Siswa <i class="fas fa-rocket ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</body>

</html>
