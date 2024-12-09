<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <nav class="bg-amber-800 p-4 shadow-md z-20 sticky top-0 bg-opacity-80 backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button id="navbar-toggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="text-white text-lg font-semibold ml-2">Si-Jurline</a>
            </div>

            <div class="relative">
                <button id="profile-dropdown" class="flex items-center">
                    <img src="{{ asset('images/' . ($guru->foto ?? 'admin.jpg')) }}" alt="Profile"
                        class="w-8 h-8 rounded-full">
                </button>
                <div id="dropdown-menu"
                    class="absolute right-0 mt-2 w-48 bg-amber-600 text-white rounded-md shadow-lg hidden">
                    {{-- <a href="{{ route('profil') }}" class="block px-4 py-2 hover:bg-amber-500">Profil</a> --}}
                    <a href="{{ url('') }}" class="block px-4 py-2 hover:bg-amber-500">Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Sidebar -->
    <aside id="sidebar"
        class="bg-amber-800 text-white w-64 h-[calc(100%-64px)] fixed left-0 top-16 transform -translate-x-full transition-transform duration-300 z-10 bg bg-opacity-80 backdrop-blur-sm">
        <div class="p-4">
            <ul class="mt-4">
                <li><a href="{{ url('homebk') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-house ms-2"></i> Home</a></li>
                <li class="relative">
                    {{-- <a href="#" id="data-dropdown"
                        class="py-2 hover:bg-amber-600 rounded flex items-center justify-between">
                        <span><i class="fa fa-folder ms-2"></i> Data Umum</span>
                        <i class="fas fa-chevron-down me-2"></i>
                    </a> --}}
                    <!-- Dropdown menu -->
                    {{-- <ul id="data-dropdown-menu"
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
                    </ul> --}}
                </li>
                {{-- <li><a href="{{ url('guru') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Guru</a></li> --}}
                <li><a href="{{ url('/siswa-bk') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Siswa</a></li>
                <li><a href="{{ url('absensiharian') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Absen Harian Siswa</a></li>
                <li><a href="{{ url('rekapabsensi') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Rekap Absen Siswa</a></li>
                {{-- <li><a href="{{ url('mengajar') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-bars ms-2"></i> Jadwal Mengajar</a>
                </li>
                <li><a href="{{ url('jurnal') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-book ms-2"></i> Data Jurnal</a></li>
                <li><a href="{{ url('izin') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-circle-info ms-2"></i> Data Izin Guru</a>
                </li> --}}
                <li class="relative">
                    {{-- <a href="#" id="rekap-dropdown"
                        class="py-2 hover:bg-amber-600 rounded flex items-center justify-between">
                        <span><i class="fa fa-folder ms-2"></i> Data Rekap</span>
                        <i class="fas fa-chevron-down me-2"></i>
                    </a> --}}
                    <!-- Dropdown menu -->
                    <ul id="rekap-dropdown-menu"
                        class="absolute left-0 mt-2 w-48 bg-amber-700 text-white rounded-md shadow-lg hidden">
                        <li><a href="{{ url('rkbm') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-file ms-2"></i> Rekap KBM</a></li>
                        <li><a href="{{ url('rjurnal') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Jurnal</a></li>
                        <li><a href="{{ url('rizin') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Izin</a></li>
                        <li><a href="{{ url('rabsen') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Absensi</a></li>
                        <li><a href="{{ url('rabsen') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Absensi</a></li>
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
    const sekolahLat = -7.1367123; // Ganti dengan latitude sekolah
    const sekolahLon = 112.7271187; // Ganti dengan longitude sekolah
    const radiusMax = 0.10; // Radius maksimal dalam kilometer

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam kilometer
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Jarak dalam kilometer
    }

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
            .then(response => response.json())
            .then(data => {
                const address = data.address;
                document.getElementById('desa').innerText = address.village || 'Tidak ditemukan';
                document.getElementById('kecamatan').innerText = address.neighbourhood || 'Tidak ditemukan';
                document.getElementById('kota').innerText = address.city || 'Tidak ditemukan';
                document.getElementById('lat').innerText = lat;
                document.getElementById('lon').innerText = lon;

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

                const distance = calculateDistance(lat, lon, sekolahLat, sekolahLon);

                if (distance <= radiusMax) {
                    document.getElementById('absensiBtn').classList.remove('hidden');
                    document.getElementById('radiusMessage').innerText = '';
                } else {
                    document.getElementById('absensiBtn').classList.add('hidden');
                    document.getElementById('radiusMessage').innerText =
                        'Maaf, Anda harus berada di dalam jarak sekolah untuk memunculkan tombol absen.';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function updateLocationAndSubmitForm() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lokasi = `${position.coords.latitude}, ${position.coords.longitude}`;
                document.getElementById('lokasiInput').value = lokasi;
                document.getElementById('absenForm').submit();
            }, error => {
                console.error("Gagal mendapatkan lokasi:", error);
                document.getElementById('absensiStatus').innerText = 'Gagal mendapatkan lokasi.';
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    // Event listener untuk klik tombol absensi
    const absensiBtn = document.getElementById('absensiBtn');
    if (absensiBtn) {
        absensiBtn.onclick = function(event) {
            event.preventDefault();
            updateLocationAndSubmitForm();
        };
    }


    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }


    // Logika tambahan untuk toggle sidebar dan dropdown
    document.getElementById('navbar-toggle').onclick = function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    };

    document.getElementById('profile-dropdown').onclick = function() {
        document.getElementById('dropdown-menu').classList.toggle('hidden');
    };

    window.onclick = function(event) {
        if (!event.target.matches('#profile-dropdown') && !event.target.matches('#profile-dropdown img')) {
            const dropdown = document.getElementById('dropdown-menu');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    };
</script>


</html>
