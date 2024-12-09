<?php

use App\Models\Mengajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\RkbmController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\InvalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RizinController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\RabsenController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RjurnalController;
use App\Http\Controllers\AuthguruController;
use App\Http\Controllers\GuruAuthController;
use App\Http\Controllers\MengajarController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\AbsenguruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalhariController;
use App\Http\Controllers\RabsenguruController;
use App\Http\Controllers\AbsensiharianController;

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked succesfully.';
});


// Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/absenguru', [AbsensiController::class, 'store'])->name('absenguru.store');

    Route::get('/getKelas/{tapel_id}', [KelasController::class, 'getKelasByTapel']);
    Route::put('mengajar/update', [MengajarController::class, 'update'])->name('mengajar.update');

    Route::get('/search-kelas', [KelasController::class, 'search']);
    Route::get('/search-mapel', [MapelController::class, 'search']);
    Route::get('/search-guru', [GuruController::class, 'search']);
    Route::get('guru/data', [GuruController::class, 'data'])->name('guru.data');

    Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
    Route::post('/mengajar/import', [MengajarController::class, 'import'])->name('mengajar.import');
    Route::get('siswas/import', [SiswaController::class, 'import'])->name('siswas.import');
    Route::post('siswas/import', [SiswaController::class, 'importPost'])->name('siswas.import.post');

    Route::get('export-pdf', [RkbmController::class, 'exportPdf'])->name('export.pdf');
    Route::get('export-jurnal', [RjurnalController::class, 'exportPdf'])->name('export.jurnal');
    Route::get('export-pdf', [RizinController::class, 'exportPdf'])->name('export.pdf');
    Route::get('export-absen', [RizinController::class, 'exportPdf'])->name('export.absen');

    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/homejad', [DashboardController::class, 'jadwal'])->name('homejad');
    Route::get('/homeizin', [DashboardController::class, 'izin'])->name('homeizin');
    Route::get('/homeabsen', [DashboardController::class, 'absen'])->name('homeabsen');


    Route::get('/rkbm', 'App\Http\Controllers\RkbmController@data');
    Route::get('/filter', 'App\Http\Controllers\RkbmController@filter');

    Route::get('/rizin', 'App\Http\Controllers\RizinController@data');
    Route::get('/ifilter', 'App\Http\Controllers\RizinController@filter');
    Route::get('rizin/filter', [RizinController::class, 'filter'])->name('rizin.filter');

    Route::get('/rjurnal', 'App\Http\Controllers\RjurnalController@data');
    Route::get('rjurnal/filter', [RjurnalController::class, 'filter'])->name('rjurnal.filter');

    Route::get('/rabsen', 'App\Http\Controllers\RabsenController@data');
    Route::get('rabsen/filter', [RabsenController::class, 'filter'])->name('rabsen.filter');

    Route::get('/rabsenguru', 'App\Http\Controllers\RabsenguruController@data');
    Route::get('rabsenguru/filter', [RabsenguruController::class, 'filter'])->name('rabsenguru.filter');

    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');


    Route::get('/jfilter', 'App\Http\Controllers\RjurnalController@filter');

    Route::get('/mapel', 'App\Http\Controllers\MapelController@data');
    Route::get('/mapel/add', 'App\Http\Controllers\MapelController@add');
    Route::post('/mapel', 'App\Http\Controllers\MapelController@addprocess');
    Route::get('/mapel/edit/{id}', 'App\Http\Controllers\MapelController@edit');
    Route::patch('/mapel/{id}', 'App\Http\Controllers\MapelController@editprocess');
    Route::delete('/mapel/{id}', 'App\Http\Controllers\MapelController@delete');

    Route::get('/kelas', 'App\Http\Controllers\KelasController@data');
    Route::get('/kelas/add', 'App\Http\Controllers\KelasController@add');
    Route::post('/kelas', 'App\Http\Controllers\KelasController@addprocess');
    Route::get('/kelas/edit/{id}', 'App\Http\Controllers\KelasController@edit');
    Route::patch('/kelas/{id}', 'App\Http\Controllers\KelasController@editprocess');
    Route::delete('/kelas/{id}', 'App\Http\Controllers\KelasController@delete');

    Route::get('/semester', 'App\Http\Controllers\SemesterController@data');
    Route::get('/semester/add', 'App\Http\Controllers\SemesterController@add');
    Route::post('/semester', 'App\Http\Controllers\SemesterController@addprocess');
    Route::get('/semester/edit/{id}', 'App\Http\Controllers\SemesterController@edit');
    Route::patch('/semester/{id}', 'App\Http\Controllers\SemesterController@editprocess');
    Route::delete('/semester/{id}', 'App\Http\Controllers\SemesterController@delete');

    Route::get('/jam', 'App\Http\Controllers\JamController@data');
    Route::get('/jam/add', 'App\Http\Controllers\JamController@add');
    Route::post('/jam', 'App\Http\Controllers\JamController@addprocess');
    Route::get('/jam/edit/{id}', 'App\Http\Controllers\JamController@edit');
    Route::patch('/jam/{id}', 'App\Http\Controllers\JamController@editprocess');
    Route::delete('/jam/{id}', 'App\Http\Controllers\JamController@delete');

    Route::get('/tapel', 'App\Http\Controllers\TapelController@data');
    Route::get('/tapel/add', 'App\Http\Controllers\TapelController@add');
    Route::post('/tapel', 'App\Http\Controllers\TapelController@addprocess');
    Route::get('/tapel/edit/{id}', 'App\Http\Controllers\TapelController@edit');
    Route::patch('/tapel/{id}', 'App\Http\Controllers\TapelController@editprocess');
    Route::delete('/tapel/{id}', 'App\Http\Controllers\TapelController@delete');

    Route::get('/guru', 'App\Http\Controllers\GuruController@data');
    Route::get('/guru/add', 'App\Http\Controllers\GuruController@add');
    Route::post('/guru', 'App\Http\Controllers\GuruController@addprocess');
    Route::get('/guru/edit/{id}', 'App\Http\Controllers\GuruController@edit');
    Route::patch('/guru/{id}', 'App\Http\Controllers\GuruController@editprocess');
    Route::delete('/guru/{id}', 'App\Http\Controllers\GuruController@delete');

    Route::resource('/siswas', 'App\Http\Controllers\SiswasController');

    Route::resource('/mengajar', 'App\Http\Controllers\MengajarController');

    Route::resource('/izin', 'App\Http\Controllers\IzinController');
    Route::get('izin/create/{id}', [IzinController::class, 'create'])->name('izin.create');

    Route::resource('/jurnal', JurnalController::class);
    Route::get('jurnal/create/{id}', [JurnalController::class, 'create'])->name('jurnal.create');

    Route::get('/jadwal-hari-ini', [JadwalhariController::class, 'showJadwalHariIni']);
// });

Route::middleware(['auth:guru'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'show'])->name('profil');
    Route::get('/homeguru', [DashboardController::class, 'indexguru']);
    Route::get('/home-izin', [AuthguruController::class, 'homeizin']);
    Route::get('/home-jadwal', [AuthguruController::class, 'homejadwal']);
    Route::post('/absen-guru', [AbsenguruController::class, 'store'])->name('absen-guru');
    Route::get('/jadwal-guru', [AuthguruController::class, 'jadwal'])->name('jadwal-guru');
    Route::get('/jurnal-guru', [AuthguruController::class, 'jurnal'])->name('jurnal-guru');
    Route::get('/jadwal-hari-ini-guru', [AuthguruController::class, 'showJadwalHariIni']);
    Route::get('jurnal-guru/create/{id}', [AuthguruController::class, 'create'])->name('jurnal-guru.create');
    Route::post('/jurnal-guru', 'App\Http\Controllers\AuthguruController@store');
    Route::get('/jurnal-guru/{id}/edit', 'App\Http\Controllers\AuthguruController@edit');
    Route::patch('/jurnal-guru/{id}', 'App\Http\Controllers\AuthguruController@update');
    Route::delete('/jurnal-guru/{id}', 'App\Http\Controllers\AuthguruController@destroy');
    Route::get('image-preview-guru/{type}/{id}', [AuthguruController::class, 'imagePreview'])->name('image-guru.preview');
    Route::get('/izin-guru', [AuthguruController::class, 'izin'])->name('izin-guru');
    Route::get('izin-guru/create/{id}', [AuthguruController::class, 'createizin'])->name('izin.create');
    Route::post('/izin-guru', 'App\Http\Controllers\AuthguruController@storeizin');
    Route::get('/izin-guru/{id}/edit', 'App\Http\Controllers\AuthguruController@editizin');
    Route::patch('/izin-guru/{id}', 'App\Http\Controllers\AuthguruController@updateizin');
    Route::delete('/izin-guru/{id}', 'App\Http\Controllers\AuthguruController@destroyizin');
    Route::get('/jurnal-guru-rekap', [AuthguruController::class, 'rekapjurnal'])->name('jurnal-guru.rekap');
    Route::get('/jurnal-guru-rekap-filter', [AuthguruController::class, 'filterjurnal'])->name('jurnal-guru.filter');
    Route::get('/izin-guru-rekap', [AuthguruController::class, 'rekapizin'])->name('izin-guru.rekap');
    Route::get('/izin-guru-rekap-filter', [AuthguruController::class, 'filterizin'])->name('izin-guru.filter');
    Route::get('/kbm-guru-rekap', [AuthguruController::class, 'rekapkbm'])->name('kbm-guru.rekap');
    Route::get('/kbm-guru-rekap-filter', [AuthguruController::class, 'filterkbm'])->name('kbm-guru.filter');
    Route::get('/absensi-guru-rekap', [AuthguruController::class, 'rekapabsensi'])->name('absensi-guru.rekap');
    Route::get('/absensi-rekap-filter', [AuthguruController::class, 'filterabsensi'])->name('absensi-guru.filter');
});

// Route::middleware(['auth', 'role:BK'])->group(function () {
    Route::get('/absensiharian', [AbsensiharianController::class, 'absen'])->name('absensiharian.index');
    Route::get('/homebk', [AbsensiharianController::class, 'home'])->name('absensiharian.homebk');
    Route::post('/absensiharian/store', [AbsensiharianController::class, 'store'])->name('absensiharian.store');
    Route::get('/siswa-bk', [AbsensiharianController::class, 'siswa'])->name('absensiharian.siswa');
    Route::get('/rekapabsensi', [AbsensiharianController::class, 'rekap'])->name('absensiharian.rekap');
    Route::get('/rekapabsensi/detail/{hari}/{tanggal}/{kelas}', [AbsensiharianController::class, 'detailRekap'])->name('absensiharian.detailrekap');
    Route::put('/absensiharian/update/{id}', [AbsensiharianController::class, 'update'])->name('absensiharian.update');
// });


// Route::middleware(['auth', 'role:inval'])->group(function () {
Route::get('/homeinval', [InvalController::class, 'home'])->name('inval.homeinval');
Route::get('/invaljadwal', [InvalController::class, 'jadwal'])->name('inval.jadwal');
Route::get('/invalizin', [InvalController::class, 'izin'])->name('inval.izin');
Route::get('/invaljadwalhariini', [InvalController::class, 'showJadwalHariIni']);
Route::get('invalizin/create/{id}', [InvalController::class, 'create'])->name('izin.create');
Route::post('/invalizin', 'App\Http\Controllers\InvalController@store');
Route::get('/invalizin/{id}/edit', 'App\Http\Controllers\InvalController@edit');
Route::patch('/invalizin/{id}', 'App\Http\Controllers\InvalController@update');
Route::delete('/invalizin/{id}', 'App\Http\Controllers\InvalController@destroy');
Route::get('image-preview/{type}/{id}', [InvalController::class, 'imagePreview'])->name('image.preview');
Route::get('/invalrizin', [InvalController::class, 'rekap'])->name('inval.rizin');
Route::get('/inval-rizin-filter', [InvalController::class, 'filter'])->name('inval.filter');
// });

// Route::middleware(['auth', 'role:pimpinan'])->group(function () {
Route::get('/homepimpinan', [PimpinanController::class, 'home'])->name('pimpinan.home');
Route::get('/pimpinan-guru', [PimpinanController::class, 'guru'])->name('pimpinan.guru');
Route::get('/pimpinan-siswa', [PimpinanController::class, 'siswa'])->name('pimpinan.siswa');
Route::get('/pimpinan-jadwal', [PimpinanController::class, 'jadwal'])->name('pimpinan.jadwal');
Route::get('/pimpinan-rekap-absen-guru', [PimpinanController::class, 'rekap'])->name('pimpinan.rekap');
Route::get('/pimpinan-filter', [PimpinanController::class, 'filter'])->name('pimpinan.filter');
// });

Route::get('/', [SesiController::class, 'index'])->name('login');
Route::post('/', [SesiController::class, 'login']);
Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
//o8xt~U+pI~