<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>

        {{-- Link Brand mengarah ke dashboard yang sesuai --}}
        <a class="navbar-brand m-0"
            href="{{ Auth::guard('siswa')->check() ? route('siswa.dashboard') : route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" width="26px" height="26px"
                class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">KKA Smart Learning</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            {{-- ============================================================== --}}
            {{-- MENU KHUSUS GURU (ADMIN) --}}
            {{-- ============================================================== --}}
            @if (Auth::guard('web')->check())
                {{-- Dashboard Guru --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                {{-- Manajemen Materi --}}
                <li class="nav-item">
                    @php
                        $isMateriMenu = request()->routeIs('materi.*') || request()->routeIs('kelas.materi.*');
                    @endphp
                    <a class="nav-link {{ $isMateriMenu ? 'active' : '' }}" href="{{ route('materi.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Materi</span>
                    </a>
                </li>

                {{-- Manajemen Soal --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kuis.*') ? 'active' : '' }}"
                        href="{{ route('kuis.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-controller text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Soal</span>
                    </a>
                </li>

                {{-- Manajemen Siswa --}}
                <li class="nav-item">
                    @php
                        $isKelasMenu = request()->routeIs('kelas.*') || request()->routeIs('siswas.*');
                    @endphp
                    <a class="nav-link {{ $isKelasMenu ? 'active' : '' }}" href="{{ route('kelas.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-hat-3 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Siswa</span>
                    </a>
                </li>

                {{-- Evaluasi Siswa --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('evaluasi.*') ? 'active' : '' }}"
                        href="{{ route('evaluasi.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-chart-pie-35 text-dark text-sm opacity-10"></i> {{-- Ganti icon chart pie biar cocok --}}
                        </div>
                        <span class="nav-link-text ms-1">Evaluasi Siswa</span>
                    </a>
                </li>

                {{-- Pengaturan Akun Guru --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pengaturan Akun</h6>
                </li>

                <li class="nav-item">
                    {{-- Route mengarah ke 'profile.edit' milik Guru --}}
                    <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                        href="{{ route('profile.edit') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profil Saya</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form id="logout-form-guru" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="confirmLogout('logout-form-guru')">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Keluar</span>
                    </a>
                </li>

                {{-- ============================================================== --}}
                {{-- MENU KHUSUS SISWA --}}
                {{-- ============================================================== --}}
            @elseif(Auth::guard('siswa')->check())
                {{-- Dashboard Siswa --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}"
                        href="{{ route('siswa.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                {{-- Menu Materi Siswa --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.materi.*') ? 'active' : '' }}"
                        href="{{ route('siswa.materi.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-book-bookmark text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Materi Belajar</span>
                    </a>
                </li>

                {{-- Menu Kuis Siswa --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.kuis.*') ? 'active' : '' }}"
                        href="{{ route('siswa.kuis.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-controller text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Latihan Soal</span>
                    </a>
                </li>

                {{-- Pengaturan Akun Siswa --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Akun Siswa</h6>
                </li>

                <li class="nav-item">
                    <form id="logout-form-siswa" method="POST" action="{{ route('siswa.logout') }}"
                        style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#" onclick="confirmLogout('logout-form-siswa')">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-button-power text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Keluar</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</aside>
