<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') SI-Jurline</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/scss/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Style umum form */
        .form-control {
            background-color: #F5DEB3;
            /* Background coklat muda */
            color: #8B4513;
            /* Teks coklat tua */
        }

        /* Style select2 dropdown */
        .select2-container--default .select2-selection--multiple {
            background-color: #F5DEB3;
            border: 1px solid #8B4513;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #8B4513;
            /* Background pilihan yang dipilih */
            color: #ffffff;
            /* Teks putih untuk pilihan yang dipilih */
            border-radius: 4px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #CD853F;
            /* Warna pilihan yang disorot */
            color: white;
        }

        /* Mengatur hover dan fokus */
        .form-control:hover,
        .form-control:focus {
            border-color: #8B4513;
            /* Warna border saat fokus */
            box-shadow: none;
        }

        .select2-container--default .select2-selection--single {
            background-color: #F5DEB3 !important;
            color: #8B4513 !important;
            border: 1px solid #F5DEB3;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #8B4513 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            color: #8B4513 !important;
        }

        body,
        .sidebar {
            font-family: 'Poppins', sans-serif;
        }

        .page-header {
            margin-top: 15px background-color: #000000;
            /* Ganti dengan warna yang diinginkan */
            border-radius: 8px;
            /* Ganti dengan nilai radius yang diinginkan */
            padding: 15px;
            /* Padding untuk memberi ruang di dalam elemen */
            margin-bottom: 20px;
            /* Jarak bawah dari elemen lain */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan jika diinginkan */
        }

        .badge {
            padding: 0.4em 0.6em;
            /* Atur padding sesuai kebutuhan */
            font-size: 0.9em;
            /* Ukuran font */
            color: white;
            /* Warna teks */
        }

        .card,
        .table {
            border-radius: 0.5rem;
            /* Atur radius sesuai keinginan */
            border-radius: 15px;
            overflow: hidden;
            /* Pastikan border-radius berfungsi */
            /* Membuat sudut rounded */
        }

        .table th {
            text-align: center;
            /* Memusatkan teks di header */
        }

        .table td {}

        .btn {
            border-radius: 10px;
            /* Membuat tombol lebih rounded */
        }

        /*buton*/
        /* From Uiverse.io by gharsh11032000 */
        .button {
            cursor: pointer;
            position: relative;
            padding: 10px 24px;
            font-size: 12px;
            color: #91665a;
            border: 2px solid #91665a;
            border-radius: 34px;
            background-color: transparent;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            overflow: hidden;
        }

        .button::before {
            content: '';
            position: absolute;
            inset: 0;
            margin: auto;
            width: 50px;
            height: 50px;
            border-radius: inherit;
            scale: 0;
            color: #91665a !important;
            z-index: -1;
            background-color: #91665a;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .button:hover::before {
            scale: 3;
        }

        .button:hover {
            color: #ffffff;
            scale: 1.1;
            box-shadow: 0 0px 20px rgba(193, 163, 98, 0.4);
        }

        .button:active {
            scale: 1;
        }



        .table-coklat {
            /* Coklat Muda */
            color: white;
            /* Teks berwarna putih */
        }

        .table-coklat th {
            background-color: #6F4E37;
            /* Coklat Tua untuk header */
            color: white;
            /* Teks berwarna putih untuk header */
        }

        /* Atur warna sidebar menjadi coklat gelap */
        #left-panel {
            background-color: #6F4E37;
            /* Coklat gelap */
            color: white;
        }

        #left-panel .navbar-nav li a {
            color: white;
            /* Warna teks di dalam sidebar */
        }

        #left-panel .navbar-nav li a:hover {
            background-color: #6F4E37;
            /* Warna ketika di hover */
            color: #f8f9fa;
        }

        .navbar-header {
            background-color: #6F4E37;
        }





        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Atur warna background pada panel kanan */
        #right-panel {
            background-color: #c26732 !important;
            /* Coklat gelap */
            color: white;
            /* Warna teks agar kontras */
        }

        /* Atur warna navbar di bagian atas */
        .header {
            background-color: #6F4E37 !important;
            /* Coklat lebih gelap untuk navbar */
            color: white;
        }

        /* Atur warna konten di dalam panel kanan */
        #right-panel .content {
            background-color: #c26732 !important;
            /* Warna coklat medium untuk konten */
            color: white;
        }

        /* Atur warna link dan hover efek di dalam konten */
        #right-panel a {
            color: #f8f9fa !important;
        }

        #right-panel a:hover {
            color: #e0e0e0 !important;
            text-decoration: none;
        }

        .breadcrumbs {
            background-color: #c26732 !important;
        }

        .breadcrumb {
            background-color: #c26732 !important;
        }

        .page-header {
            background-color: #c26732 !important;
        }

        .page-title {
            background-color: #c26732 !important;
        }

        /* Menetapkan font untuk sidebar */
        .left-panel {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Jika ingin mengatur font untuk semua teks di dalam navbar */
        .navbar {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Untuk ikon dalam menu */
        .navbar-nav .nav-link {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Gaya untuk tabel */
        #bootstrap-data-table {
            border-radius: 8px;
            /* Membuat sudut tabel membulat */
            overflow: hidden;
            /* Agar sudut membulat terlihat */
            background-color: #f5f5f5;
            /* Warna latar belakang tabel */
        }

        #bootstrap-data-table th {
            background-color: #c26732;
            /* Warna coklat untuk header tabel */
            color: white;
            /* Warna teks putih untuk kontras */
            padding: 10px;
            /* Menambah padding di header */
        }

        #bootstrap-data-table td {
            background-color: #fff;
            /* Warna putih untuk sel tabel */
            padding: 10px;
            /* Menambah padding di sel */
        }

        #bootstrap-data-table tr:nth-child(even) {
            background-color: #e0e0e0;
            /* Warna latar belakang untuk baris genap */
        }

        #bootstrap-data-table tr:hover {
            background-color: #d7ccc8;
            /* Warna saat hover */
        }

        .btn-warning {
            background-color: #c26732;
            /* Warna latar belakang tombol */
            border-color: #c26732;
            /* Warna border tombol */
        }

        .btn-warning:hover {
            background-color: #c26732;
            /* Warna latar belakang tombol saat hover */
        }

        .card-body {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Menambahkan bayangan */
            border-radius: 8px;
            /* Sudut membulat */
            transition: box-shadow 0.3s ease;
            /* Animasi saat hover */
        }

        .card-body:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            /* Bayangan lebih dalam saat hover */
        }

        #left-panel {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Efek shadow */
            /* Sudut membulat */
            transition: box-shadow 0.3s ease;
            /* Animasi saat hover */
        }

        #left-panel:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            /* Shadow lebih dalam saat hover */
        }

        #main-menu {
            background-color: #c26732 !important;
        }

        .text-white {
            color: white;
            /* Mengubah warna teks menjadi putih */
        }

        .sub-menu {
            background-color: #b17d58 !important;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .header {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            /* Shadow ringan */
            /* Menambah ruang di dalam div */
            /* Membuat sudut rounded */
        }

        /* Media Query untuk Mobile */
        @media (max-width: 768px),
        (min-width: 768px) and (max-width: 1024px) {
            .navbar {
                padding-bottom: 4%;
                background-color: #6F4E37;
            }

            #main-menu {
                padding-top: 4%;
            }

            .navbar-header {
                padding-top: 4%;
            }

            .left-panel {
                width: 100%;
                position: fixed;
                z-index: 1000;
            }

            .right-panel {
                margin-left: 0;
                padding-top: 60px;
                /* Adjust top space for the mobile header */
            }

            table {
                font-size: 8px;
                /* Ukuran font tabel lebih kecil */
            }

            td,
            th {
                padding: 8px;
                /* Mengurangi padding di sel */
            }

            img {
                width: 60px;
                /* Mengurangi ukuran gambar di kolom foto */
            }

            .btn-sm {
                padding: 4px 8px;
                /* Ukuran tombol aksi lebih kecil */
                font-size: 10px;
            }

            .pagination-container {
                font-size: 12px;
            }

            td,
            tr {
                /* Membungkus teks ke baris baru */
                max-width: 100px;
                /* Batasi lebar kolom */
                max-height: 15px font-size: 5px
            }
        }
    </style>
</head>

<body>
    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>

    <aside id="left-panel" class="left-panel mb-3">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="nav-toggle-btn">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand ml-2 mb-2" href="">Si-Jurline</a>
                </div>

                <div class="d-flex align-items-center">
                    <a href="#" class="mr-3">
                        <img class="user-avatar rounded-circle img-fluid" src="{{ asset('style/images/admin.jpg') }}"
                            style="width: 40px; height: 40px;">
                    </a>
                    <button class="btn btn-sm btn-danger">
                        <a href="{{ url('') }}" class="text-white">Logout</a>
                    </button>
                </div>
            </div>
            <div id="main-menu"
                class="main-menu collapse navbar-collapse bg-amber-900 text-white shadow-lg rounded-md p-4">
                <ul class="nav flex flex-col space-y-3">
                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('home') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-house"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <!-- Dropdown Data Umum -->
                    <li class="menu-item-has-children dropdown relative">
                        <a href="#" onclick="toggleDropdown(this)"
                            class="flex items-center space-x-2 p-2 rounded hover:bg-amber-800 transition-colors duration-300 text-white">
                            <i class="menu-icon fa fa-laptop"></i>
                            <span>Data Umum</span>
                        </a>
                        <ul
                            class="sub-menu bg-amber-900 text-white p-2 rounded-md space-y-2 absolute hidden transition-all duration-300 shadow-md">
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder mr-2"></i><a href="{{ url('mapel') }}" class="text-white">Mata
                                    Pelajaran</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('kelas') }}" class="text-white"> Kelas</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('jam') }}" class="text-white"> Jam</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('tapel') }}" class="text-white"> Tahun
                                    Ajaran</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('semester') }}" class="text-white">
                                    Semester</a>
                            </li>
                        </ul>
                    </li>

                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('guru') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-user"></i>
                            <span>Data Guru</span>
                        </a>
                    </li>

                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('siswas') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-user"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>

                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('mengajar') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-bars"></i>
                            <span>Jadwal Mengajar</span>
                        </a>
                    </li>

                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('jurnal') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-book"></i>
                            <span>Data Jurnal</span>
                        </a>
                    </li>

                    <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                        <a href="{{ url('izin') }}" class="flex items-center space-x-2 text-white">
                            <i class="menu-icon fa fa-circle-info"></i>
                            <span>Data Izin Guru</span>
                        </a>
                    </li>

                    <!-- Dropdown Data Rekap -->
                    <li class="menu-item-has-children dropdown relative">
                        <a href="#" onclick="toggleDropdown(this)"
                            class="flex items-center space-x-2 p-2 rounded hover:bg-amber-800 transition-colors duration-300 text-white">
                            <i class="menu-icon fa fa-folder-open"></i>
                            <span>Data Rekap</span>
                        </a>
                        <ul
                            class="sub-menu bg-amber-900 text-white p-2 rounded-md space-y-2 absolute hidden transition-all duration-300 shadow-md">
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-file"></i><a href="{{ url('rkbm') }}" class="text-white"> Rekap
                                    KBM</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-file"></i><a href="{{ url('rjurnal') }}" class="text-white"> Rekap
                                    Jurnal</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-file"></i><a href="{{ url('rizin') }}" class="text-white"> Rekap
                                    Izin</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-file"></i><a href="{{ url('rabsen') }}" class="text-white"> Rekap
                                    Absensi</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>


    <div id="right-panel" class="right-panel">

        @yield('breadcrumbs')

        @yield('content')
    </div>
    @yield('scripts')
</body>
<script>
    function toggleDropdown(element) {
        // Dapatkan elemen dropdown (sub-menu) dari elemen parent-nya
        const dropdown = element.nextElementSibling;

        // Toggle kelas 'hidden' untuk menampilkan atau menyembunyikan dropdown
        dropdown.classList.toggle('hidden');
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Hapus overlay saat halaman sepenuhnya dimuat
        var loadingOverlay = document.getElementById("loading-overlay");
        if (loadingOverlay) {
            loadingOverlay.style.display = "none";
        }
    });
    // Fungsi untuk membuka/menutup sidebar saat tombol toggler diklik
    function toggleSidebar() {
        const sidebar = document.getElementById('left-panel');
        const mainMenu = document.getElementById('main-menu');

        if (sidebar.classList.contains('collapsed')) {
            sidebar.classList.remove('collapsed'); // Tampilkan sidebar
        } else {
            sidebar.classList.add('collapsed'); // Sembunyikan sidebar
        }
    }

    // Fungsi untuk menutup sidebar ketika item di sidebar diklik
    function closeSidebar() {
        const sidebar = document.getElementById('left-panel');
        sidebar.classList.add('collapsed'); // Tambahkan class collapsed untuk menyembunyikan sidebar
    }


    $(document).ready(function() {
        // Fungsi untuk membuka modal dan mengisi data form
        $('.btn-edit').on('click', function() {
            // Mengambil data dari atribut data- di tombol edit
            let id = $(this).data('id');
            let hari = $(this).data('hari');
            let jam_id = $(this).data('jam_id');
            let jamselesai_id = $(this).data('jamselesai_id');
            let kelas_id = $(this).data('kelas_id');
            let mapel_id = $(this).data('mapel_id');
            let semester_id = $(this).data('semester_id');
            let tapel_id = $(this).data('tapel_id');
            let guru_id = $(this).data('guru_id');

            // Mengisi form di modal dengan data yang diambil
            $('#editForm').attr('action', '/mengajar/' + id); // Set form action URL
            $('#hari').val(hari);
            $('#jam_id').val(jam_id);
            $('#jamselesai_id').val(jamselesai_id);
            $('#kelas_id').val(kelas_id);
            $('#mapel_id').val(mapel_id);
            $('#semester_id').val(semester_id);
            $('#tapel_id').val(tapel_id);
            $('#guru_id').val(guru_id);

            // Membuka modal edit
            $('#editModal').modal('show');
        });

        // Optional: Inisialisasi Select2 jika digunakan untuk select box dengan search real-time
        $('.select2-kelas, .select2-mapel, .select2-guru').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: '-- pilih --'
        });
    });



    $(document).ready(function() {
        // Select2 untuk Kelas
        $('.select2-kelas').select2({
            placeholder: "-- pilih --",
            allowClear: true,
            ajax: {
                url: '/search-kelas',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.kelas,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Select2 untuk Mata Pelajaran
        $('.select2-mapel').select2({
            placeholder: "-- pilih --",
            allowClear: true,
            ajax: {
                url: '/search-mapel',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.mapel,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Select2 untuk Guru
        $('.select2-guru').select2({
            placeholder: "-- pilih --",
            allowClear: true,
            ajax: {
                url: '/search-guru',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
    const navToggleBtn = document.getElementById('nav-toggle-btn');
    const mainMenu = document.getElementById('main-menu');

    navToggleBtn.addEventListener('click', function() {
        // Toggle class 'collapse' untuk expand/close
        mainMenu.classList.toggle('collapse');
    });
</script>

</html>
