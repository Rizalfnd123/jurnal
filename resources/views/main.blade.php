<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') SI-Jurline</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ asset('style/assets/css/normaize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
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


        .card,
        .table {
            border-radius: 15px;
            /* Membuat sudut rounded */
        }

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
        @media (max-width: 768px) {

            /* Sesuaikan sidebar menjadi collapsible */
            #left-panel {
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
                height: auto;
                z-index: 1000;
                transition: left 0.3s ease;
            }

            #left-panel.collapsed {
                left: -100%;
            }

            /* Konten akan mengambil 100% lebar */
            #right-panel {
                margin-left: 0;
                padding: 10px;
            }

            .header-menu {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            /* Perkecil padding dan margin */
            .card,
            .table,
            .page-header,
            .breadcrumbs {
                padding: 10px;
                margin: 10px 0;
            }

            .menu-item-has-children .sub-menu {
                position: relative;
                left: 0;
                width: 100%;
            }

            .navbar-brand {
                font-size: 18px;
            }

            .filter-form {
                padding: 10px;
                font-size: 12px;
            }

            /* Sesuaikan ukuran font dan margin */
            body,
            .sidebar,
            .navbar,
            .content {
                font-size: 14px;
            }

            /* Atur tabel agar bisa di-scroll horizontal */
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="true" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="">Si-Jurline</a>
                <a class="navbar-brand hidden" href=""></a>
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

                    <li class="menu-item-has-children dropdown relative group">
                        <a href="#" onclick="toggleDropdown(this)"
                            class="flex items-center space-x-2 p-2 rounded hover:bg-amber-800 transition-colors duration-300 text-white">
                            <i class="menu-icon fa fa-laptop"></i>
                            <span>Data Umum</span>
                        </a>
                        <ul
                            class="sub-menu bg-amber-900 text-white p-2 rounded-md space-y-2 absolute hidden group-hover:block transition-all duration-300 shadow-md">
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder mr-2"></i><a href="{{ url('mapel') }} " class="text-white">Mata Pelajaran</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('kelas') }}"class="text-white">
                                    Kelas</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('jam') }}"class="text-white">
                                    Jam</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('tapel') }}"class="text-white">
                                    Tahun
                                    Ajaran</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300">
                                <i class="fa fa-folder"></i><a href="{{ url('semester') }}"class="text-white">
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

                    <li class="menu-item-has-children dropdown relative group">
                        <a href="#" onclick="toggleDropdown(this)"
                            class="flex items-center space-x-2 p-2 rounded hover:bg-amber-800 transition-colors duration-300 text-white">
                            <i class="menu-icon fa fa-folder-open"></i>
                            <span>Data Rekap</span>
                        </a>
                        <ul
                            class="sub-menu bg-amber-900 text-white p-2 rounded-md space-y-2 absolute hidden group-hover:block transition-all duration-300 shadow-md">
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300"><i
                                    class="fa fa-file"></i><a href="{{ url('rkbm') }}"class="text-white"> Rekap
                                    KBM</a></li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300"><i
                                    class="fa fa-file"></i><a href="{{ url('rjurnal') }}"class="text-white"> Rekap
                                    Jurnal</a>
                            </li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300"><i
                                    class="fa fa-file"></i><a href="{{ url('rizin') }}"class="text-white"> Rekap
                                    Izin</a></li>
                            <li class="hover:bg-amber-800 p-2 rounded transition-colors duration-300"><i
                                    class="fa fa-file"></i><a href="{{ url('rabsen') }}"class="text-white"> Rekap
                                    Absensi</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </aside><!-- /#left-panel -->

    <div id="right-panel" class="right-panel ">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    {{-- <a id="menuToggle" class="menutoggle pull-left bg-secondary"><i class="fa fa fa-tasks "></i></a> --}}
                    <div class="header-left">
                        {{-- <button class="search-trigger"><i class="fa fa-search"></i></button> --}}
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                        <div class="dropdown for-notification">
                            {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button> --}}
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">

                    <div class="user-area dropdown float-right">
                        <button class="button me-3 ">
                            <a href="{{ url('') }}">Logout</a>
                        </button>

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('style/images/admin.jpg') }}">

                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>


                    <div class="language-select dropdown" id="language-select">
                        {{-- <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language"
                            aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-id"></i>
                        </a> --}}
                        <div class="dropdown-menu" aria-labelledby="language">

                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-id"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-jp"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->

        @yield('breadcrumbs')

        @yield('content')




    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Hapus overlay saat halaman sepenuhnya dimuat
        var loadingOverlay = document.getElementById("loading-overlay");
        if (loadingOverlay) {
            loadingOverlay.style.display = "none";
        }
    });

    function toggleDropdown(element) {
        // Dapatkan elemen dropdown (ul) yang bersifat saudara (sibling) dari elemen <a>
        const dropdown = element.nextElementSibling;

        // Toggle class hidden untuk menampilkan/menyembunyikan dropdown
        dropdown.classList.toggle('hidden');
    }
</script>

</script>

</html>
