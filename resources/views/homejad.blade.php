@extends('main')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active"><i class="fa fa-dashboard"></i></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/home') }}">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text"><strong>Jurnal hari ini</strong></div>
                                    <div class="stat-digit">{{ $jurnalTodayCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/homeizin') }}">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text"><strong>Izin hari ini</strong></div>
                                    <div class="stat-digit">{{ $izinTodayCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/homejad') }}">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text"><strong>Jadwal hari ini</strong></div>
                                    <div class="stat-digit">{{ $jadwalTodayCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/home') }}">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-danger"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text"><strong>Rekap hari ini</strong></div>
                                    <div class="stat-digit">{{ $jurnalTodayCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Jadwal</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Kelas</th>
                                            <th>Nama Guru</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwalToday as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->jam->jam }}</td>
                                                <td>{{ $item->mapel->mapel }}</td>
                                                <td>{{ $item->kelas->kelas }}</td>
                                                <td>{{ $item->guru->nama }}</td>
                                                <td>
                                                    @if ($item->status === 'B')
                                                        Belum mengisi
                                                    @elseif($item->status === 'S')
                                                        Sudah mengisi Jurnal
                                                    @elseif($item->status === 'I')
                                                        Sudah Mengisi Izin
                                                    @else
                                                        {{ $item->status }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
    </div>
@endsection
