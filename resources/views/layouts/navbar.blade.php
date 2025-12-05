@php
    \Carbon\Carbon::setLocale('id');
@endphp

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">

        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-white" href="javascript:;">KKA Learning</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    {{ $title ?? 'Dashboard' }}
                </li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">
                {{ $title ?? 'Dashboard' }}
            </h6>
        </nav>

        {{-- LOGIKA USER --}}
        @php
            $authUser = null;
            $role = '';
            if (Auth::guard('web')->check()) {
                $authUser = Auth::guard('web')->user();
                $role = 'Guru';
                $name = $authUser->name;
            } elseif (Auth::guard('siswa')->check()) {
                $authUser = Auth::guard('siswa')->user();
                $role = 'Siswa';
                $name = $authUser->nama_siswa;
            }

            $avatarPath =
                $authUser && $authUser->avatar ? asset('storage/' . $authUser->avatar) : asset('assets/img/team-2.jpg');
        @endphp

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            {{-- AREA TENGAH: TANGGAL, JAM & SEARCH --}}
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                {{-- Tanggal & Jam --}}
                <div class="text-white me-3 d-none d-sm-block font-weight-bold text-sm text-nowrap">
                    <i class="ni ni-calendar-grid-58 me-1"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                    <span class="mx-1">|</span>
                    <i class="ni ni-time-alarm me-1"></i>
                    {{ now()->format('H:i') }} WIB
                </div>

                {{-- Search Input --}}
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Cari sesuatu...">
                </div>
            </div>

            {{-- AREA KANAN --}}
            <ul class="navbar-nav justify-content-end">

                {{-- [PERBAIKAN 2] Mengatur ulang posisi/padding agar lebih ke kanan --}}

                {{-- Ikon Notifikasi --}}
                {{-- Saya ubah class px-3 agar jaraknya konsisten dan lebih rapi ke kanan --}}
                <li class="nav-item dropdown px-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ni ni-bell-55 cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle me-3">
                                            <i class="ni ni-bulb-61 text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Info Baru:</span> Kuis Algoritma rilis
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i> Baru saja
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Ikon Pengaturan --}}
                <li class="nav-item px-1 d-flex align-items-center">
                    <a href="{{ $role == 'Guru' ? route('profile.edit') : route('siswa.profile.edit') }}"
                        class="nav-link text-white p-0" data-bs-toggle="tooltip" title="Pengaturan Akun">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                {{-- Profil User --}}
                <li class="nav-item d-flex align-items-center ps-2">
                    <a href="{{ $role == 'Guru' ? route('profile.edit') : route('siswa.profile.edit') }}"
                        class="nav-link text-white font-weight-bold px-0">
                        <img src="{{ $avatarPath }}" class="avatar avatar-sm rounded-circle me-1"
                            style="object-fit: cover; border: 2px solid white;">
                        <span class="d-sm-inline d-none ms-1">{{ $name ?? 'Pengguna' }}</span>
                    </a>
                </li>

                {{-- Hamburger Menu (Mobile) --}}
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
