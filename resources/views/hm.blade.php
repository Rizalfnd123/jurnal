<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') SI-Jurline</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.3.1/css/themify-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 400px;
            /* Atur tinggi peta */
            width: 100%;
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
    </style>
</head>

<body class="bg-amber-900">
    <!-- Navbar -->
    <nav class="bg-amber-800 p-4 shadow-md z-20 relative bg bg-opacity-80 backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button id="navbar-toggle" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="text-white text-lg font-semibold ml-2">Si-Jurline</a>
            </div>

            <div class="relative">
                <button id="profile-dropdown" class="flex items-center">
                    <img src="{{ asset('style/images/admin.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full">
                </button>
                <div id="dropdown-menu"
                    class="absolute right-0 mt-2 w-48 bg-amber-600 text-white rounded-md shadow-lg hidden">
                    <a href="#" class="block px-4 py-2 hover:bg-amber-500">Profil</a>
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
                <li><a href="{{ url('home') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-house ms-2"></i> Home</a></li>
                <li class="relative">
                    <a href="#" id="data-dropdown"
                        class="py-2 hover:bg-amber-600 rounded flex items-center justify-between">
                        <span><i class="fa fa-folder ms-2"></i> Data Umum</span>
                        <i class="fas fa-chevron-down me-2"></i>
                    </a>
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
                </li>
                <li><a href="{{ url('guru') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Guru</a></li>
                <li><a href="{{ url('siswas') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-user ms-2"></i> Data Siswa</a></li>
                <li><a href="{{ url('mengajar') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-bars ms-2"></i> Jadwal Mengajar</a>
                </li>
                <li><a href="{{ url('jurnal') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
                            class="fa fa-book ms-2"></i> Data Jurnal</a></li>
                <li><a href="{{ url('izin') }}" class="block py-2 hover:bg-amber-600 rounded"> <i
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
                        <li><a href="{{ url('rkbm') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-file ms-2"></i> Rekap KBM</a></li>
                        <li><a href="{{ url('rjurnal') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Jurnal</a></li>
                        <li><a href="{{ url('rizin') }}" class="block py-2 px-4 hover:bg-amber-600 rounded"><i
                                    class="fa fa-folder ms-2"></i> Rekap Izin</a></li>
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
    function showPosition(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    console.log("Latitude: " + lat + ", Longitude: " + lon); // Tambahkan ini untuk debug

    // Menggunakan Nominatim untuk mendapatkan alamat
    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Tambahkan ini untuk debug

            const address = data.address;
            let desa = address.village || address.suburb || 'Tidak ditemukan';
            let kecamatan = address.neighbourhood || 'Tidak ditemukan';
            let kota = address.city || address.town || address.county || 'Tidak ditemukan';

            // Menampilkan lokasi
            document.getElementById("location").innerHTML = `
                <p>Desa: ${desa}</p>
                <p>Kecamatan: ${kecamatan}</p>
                <p>Kota: ${kota}</p>
            `;

            // Inisialisasi Peta
            const map = L.map('map').setView([lat, lon], 13);
            L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under ODbL.'
}).addTo(map);

            L.marker([lat, lon]).addTo(map).bindPopup('Anda berada di sini').openPopup();
        })
        .catch(error => console.error('Error:', error));
}


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
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
                document.getElementById("location").innerHTML = `
                <p>Desa: ${desa}</p>
                <p>Kecamatan: ${kecamatan}</p>
                <p>Kota: ${kota}</p>
            `;
            })
            .catch(error => console.error('Error:', error));
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
    document.getElementById('data-dropdown').addEventListener('click', function(event) {
        event.preventDefault();
        const dropdownMenu = document.getElementById('data-dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Menghilangkan dropdown jika mengklik di luar dropdown
    window.addEventListener('click', function(event) {
        const dropdownMenu = document.getElementById('data-dropdown-menu');
        const dataDropdown = document.getElementById('data-dropdown');
        if (!dataDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
    // JavaScript untuk mengontrol dropdown "Data" dengan klik
    document.getElementById('rekap-dropdown').addEventListener('click', function(event) {
        event.preventDefault();
        const dropdownMenu = document.getElementById('rekap-dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Menghilangkan dropdown jika mengklik di luar dropdown
    window.addEventListener('click', function(event) {
        const dropdownMenu = document.getElementById('rekap-dropdown-menu');
        const dataDropdown = document.getElementById('rekap-dropdown');
        if (!dataDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

</html>
