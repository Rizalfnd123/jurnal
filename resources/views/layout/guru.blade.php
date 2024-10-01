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
            color: #91665a;
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



        /* Style untuk form filter */
        .filter-form {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-form .form-group {
            margin-bottom: 1rem;
        }

        .filter-form .form-control {
            border-radius: 4px;
            border-color: #ced4da;
        }

        .filter-form .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .filter-form label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .filter-form .btn {
            margin-top: 1rem;
        }

        .filter-form .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .filter-form .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        /* Style untuk overlay loading */
        #loading-overlay {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        /* Loader animation */
        .loader {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
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

        #main-menu .navbar-nav {
            background-color: #6F4E37;
        }

        /* Untuk dropdown menu Data Umum */
        .menu-item-has-children .sub-menu {
            background-color: #6F4E37 !important;
            /* Warna hitam */
            color: white !important;
        }

        .menu-item-has-children .sub-menu a {
            color: white !important;
            /* Warna teks putih */
        }

        .menu-item-has-children .sub-menu a:hover {
            background-color: #6F4E37 !important;
            /* Warna hitam keabu-abuan ketika hover */
            color: #f8f9fa !important;
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
            background-color: #ECB176 !important;
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
            background-color: #ECB176 !important;
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
            background-color: #ECB176 !important;
        }

        .breadcrumb {
            background-color: #ECB176 !important;
        }

        .page-header {
            background-color: #ECB176 !important;
        }

        .page-title {
            background-color: #ECB176 !important;
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
            background-color: #ECB176;
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
            background-color: #ECB176;
            /* Warna latar belakang tombol */
            border-color: #ECB176;
            /* Warna border tombol */
        }

        .btn-warning:hover {
            background-color: #ECB176;
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

        .header{
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            /* Shadow ringan */
            /* Menambah ruang di dalam div */
            /* Membuat sudut rounded */
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

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('home') }}"> <i class="menu-icon fa fa-dashboard"></i>Home </a>
                    </li>
                    {{-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Data Umum</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('mapel') }}">Data Mapel</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('kelas') }}">Data Kelas</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('jam') }}">Data Jam</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('tapel') }}">Data Tahun
                                    Pelajaran</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('semester') }}">Data Semester</a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ url('guru') }}"> <i class="menu-icon fa fa-puzzle-piece"></i>Data Guru</a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ url('siswas') }}"> <i class="menu-icon fa fa-puzzle-piece"></i>Data Siswa</a>
                    </li> --}}
                    <li>
                        <a href="{{ url('mengajar') }}"> <i class="menu-icon fa fa-puzzle-piece"></i>Jadwal
                            Mengajar</a>
                    </li>
                    <li>
                        <a href="{{ url('jurnal') }}"> <i class="menu-icon fa fa-puzzle-piece"></i>Data Jurnal</a>
                    </li>
                    <li>
                        <a href="{{ url('izin') }}"> <i class="menu-icon fa fa-puzzle-piece"></i>Data Izin Guru</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Data Rekap</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('rkbm') }}">Rekap KBM</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('rjurnal') }}">Rekap Jurnal</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('rizin') }}">Rekap izin</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('rabsen') }}">Rekap Absensi</a></li>
                        </ul>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    {{-- <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a> --}}
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
</script>

</script>

</html>
