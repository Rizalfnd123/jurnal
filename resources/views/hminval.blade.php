<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') SI-Jurline</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.3.1/css/themify-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map {
            height: 250px;
            width: 100%;
            z-index: 1;
            position: relative;
            /* Atur lebar peta */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset('../style/images/bg.png') }}');
            background-size: cover;
            background-position: center;
        }

        td .btn {
            display: inline-block;
            margin-right: 5px;
        }

        .sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
        }

        .transition-transform {
            transition: transform 0.3s ease-in-out;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-amber-900">
    <!-- Navbar -->
    <!-- Navbar di template layout -->
    <nav class="bg-amber-800 p-4 shadow-md z-20 sticky top-0 bg-opacity-80 backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <!-- Sidebar toggle dan nama aplikasi -->
            <div class="flex items-center">
                <button id="navbar-toggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="text-white text-lg font-semibold ml-2">Si-Jurline</a>
            </div>

            <!-- Dropdown untuk Profil -->
            <div class="relative">
                <button id="profile-dropdown" class="flex items-center">
                    {{-- @if (auth()->guard('guru')->check()) --}}
                    <!-- Tampilkan foto profil guru jika yang login adalah guru -->
                    <img src="{{ asset('style/images/admin.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full">
                    {{-- @endif --}}
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown-menu"
                    class="absolute right-0 mt-2 w-48 bg-amber-600 text-white rounded-md shadow-lg hidden">
                    {{-- @if (auth()->guard('guru')->check())
                        <a href="{{ route('profile.guru') }}" class="block px-4 py-2 hover:bg-amber-500">Profil</a>
                    @endif --}}
                    <!-- Link Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 hover:bg-amber-500">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <aside id="sidebar"
        class="bg-amber-800 text-white w-64 h-[calc(100%-64px)] fixed left-0 top-16 transform -translate-x-full transition-transform duration-300 z-10 bg bg-opacity-80 backdrop-blur-sm">
        <div class="p-4">
            <ul class="mt-4">
                <li><a href="{{ url('homeinval') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-house ms-2"></i> Home</a></li>
                <li class="relative">
                    {{-- <a href="#" id="data-dropdown"
                        class="py-2 hover:bg-amber-600 rounded flex items-center justify-between">
                        <span><i class="fa fa-folder ms-2"></i> Data Umum</span>
                        <i class="fas fa-chevron-down me-2"></i>
                    </a> --}}
                    <!-- Dropdown menu -->
                    <ul id="data-dropdown-menu"
                        class="absolute left-0 mt-2 w-48 bg-amber-700 text-white rounded-md shadow-lg hidden">
                        <li><a href="{{ url('mapel') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-file ms-2"></i> Mata Pelajaran</a></li>
                        <li><a href="{{ url('kelas') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Kelas</a></li>
                        <li><a href="{{ url('jam') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Jam</a></li>
                        <li><a href="{{ url('tapel') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Tahun Ajaran</a></li>
                        <li><a href="{{ url('semester') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Semester</a></li>
                    </ul>
                    {{-- </li>
                <li><a href="{{ url('guru') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Guru</a></li>
                <li><a href="{{ url('siswas') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Siswa</a></li> --}}
                {{-- <li><a href="{{ url('invaljadwal') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-bars ms-2"></i> Jadwal Mengajar</a> --}}
                    {{-- </li>
                <li><a href="{{ url('jurnal') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-book ms-2"></i> Data Jurnal</a></li> --}}
                <li><a href="{{ url('invalizin') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-circle-info ms-2"></i> Data Izin Guru</a>
                </li>
                <li class="relative">
                    <a href="#" id="rekap-dropdown"
                        class="py-2 hover:bg-amber-600 rounded flex items-center justify-between">
                        <span><i class="fa fa-folder ms-2"></i> Data Rekap</span>
                        <i class="fas fa-chevron-down me-2"></i>
                    </a>
                    <!-- Dropdown menu -->
                    <ul id="rekap-dropdown-menu"
                        class="absolute left-0 mt-2 w-48 bg-amber-700 text-white rounded-md shadow-lg hidden">
                        {{-- <li><a href="{{ url('rkbm') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-file ms-2"></i> Rekap KBM</a></li> --}}
                        {{-- <li><a href="{{ url('rjurnal') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Jurnal</a></li> --}}
                        <li><a href="{{ url('invalrizin') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Izin</a></li>
                        {{-- <li><a href="{{ url('rabsenguru') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Absensi Guru</a></li> --}}
                        {{-- <li><a href="{{ url('rabsen') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Absensi</a></li> --}}
                    </ul>
                </li>

            </ul>
        </div>
    </aside>
    <div class="p-6">

        @yield('breadcrumbs')

        @yield('content')
    </div>
    @yield('scripts')
</body>
<script>
    const sekolahLat = -7.1366338; // Ganti dengan latitude sekolah
    const sekolahLon = 112.7271187; // Ganti dengan longitude sekolah
    const radiusMax = 0.10; // Radius maksimal dalam kilometer
    // Menghitung jarak menggunakan Haversine formula
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam kilometer
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Jarak dalam kilometer
    }
    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        // Menggunakan Nominatim untuk mendapatkan alamat
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
            .then(response => response.json())
            .then(data => {
                const address = data.address;
                let desa = address.village || address.suburb || 'Tidak ditemukan';
                let kecamatan = address.neighbourhood || 'Tidak ditemukan';
                let kota = address.city || address.town || address.county || 'Tidak ditemukan';
                // Menampilkan lokasi
                document.getElementById('desa').innerText = desa;
                document.getElementById('kecamatan').innerText = kecamatan;
                document.getElementById('kota').innerText = kota;
                document.getElementById('lat').innerText = lat;
                document.getElementById('lon').innerText = lon;
                // Inisialisasi Peta
                const map = L.map('map').setView([lat, lon], 18);
                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map);
                // Marker user location
                L.marker([lat, lon]).addTo(map).bindPopup('Anda berada di sini').openPopup();
                // Radius marker untuk sekolah
                const sekolahMarker = L.circle([sekolahLat, sekolahLon], {
                    color: 'green',
                    fillColor: '#0f0',
                    fillOpacity: 0.2,
                    radius: radiusMax * 1000 // dalam meter
                }).addTo(map);
                // Menghitung jarak user ke sekolah
                const distance = calculateDistance(lat, lon, sekolahLat, sekolahLon);
                // Logika untuk menampilkan atau menyembunyikan tombol absensi
                if (distance <= radiusMax) {
                    document.getElementById('absen-container').classList.remove('hidden');
                    document.getElementById('radiusMessage').innerText = '';
                } else {
                    document.getElementById('absen-container').classList.add('hidden');
                    document.getElementById('radiusMessage').innerText =
                        'Maaf, Anda harus berada di dalam jarak sekolah untuk memunculkan tombol absen.';
                }
            })
            .catch(error => console.error('Error:', error));
    }
    // Meminta lokasi pengguna
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation tidak support di perangkat ini.");
        }
    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }
    getLocation();
    document.getElementById('navbar-toggle').onclick = function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    };
    document.getElementById('profile-dropdown').onclick = function() {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.classList.toggle('hidden');
    };
    // Menutup dropdown ketika mengklik di luar
    window.onclick = function(event) {
        if (!event.target.matches('#profile-dropdown') && !event.target.matches('#profile-dropdown img')) {
            const dropdown = document.getElementById('dropdown-menu');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    };
    // JavaScript untuk mengontrol dropdown "Data" dengan klik
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownTrigger = document.getElementById('data-dropdown');
        if (dropdownTrigger) {
            dropdownTrigger.addEventListener('click', function(event) {
                event.preventDefault();
                const dropdownMenu = document.getElementById('data-dropdown-menu');
                dropdownMenu.classList.toggle('hidden');
            });
        }
    });
    // Menghilangkan dropdown jika mengklik di luar dropdown
    window.addEventListener('click', function(event) {
        const dropdownMenu = document.getElementById('data-dropdown-menu');
        const dataDropdown = document.getElementById('data-dropdown');
        if (!dataDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownTrigger = document.getElementById('rekap-dropdown');
        if (dropdownTrigger) {
            dropdownTrigger.addEventListener('click', function(event) {
                event.preventDefault();
                const dropdownMenu = document.getElementById('rekap-dropdown-menu');
                dropdownMenu.classList.toggle('hidden');
            });
        }
    });
    document.querySelector('input[name="tanggal"]').addEventListener('input', function(e) {
        // Validasi sederhana untuk format tanggal `dd/mm/yyyy`
        const value = e.target.value;
        const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/(\d{4})$/;
        
        if (!regex.test(value) && value.length === 10) {
            alert("Format tanggal harus dd/mm/yyyy");
            e.target.value = ""; // kosongkan jika format salah
        }
    });
</script>
</html>
