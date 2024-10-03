<?php

use Illuminate\Support\Facades\Route;

use App\Models\Mengajar;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RkbmController;
use App\Http\Controllers\RjurnalController;
use App\Http\Controllers\RabsenController;
use App\Http\Controllers\RizinController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\JadwalhariController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SesiController;

Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');

Route::get('siswas/import', [SiswaController::class, 'import'])->name('siswas.import');
Route::post('siswas/import', [SiswaController::class, 'importPost'])->name('siswas.import.post');


Route::get('export-pdf', [RkbmController::class, 'exportPdf'])->name('export.pdf');
Route::get('export-jurnal', [RjurnalController::class, 'exportPdf'])->name('export.jurnal');
Route::get('export-pdf', [RizinController::class, 'exportPdf'])->name('export.pdf');
Route::get('export-absen', [RizinController::class, 'exportPdf'])->name('export.absen');

Route::get('/', [SesiController::class, 'index']);
Route::get('/logout', [SesiController::class, 'logout']);
Route::post('/', [SesiController::class, 'login']);
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/homeguru', [DashboardController::class, 'indexguru']);
Route::get('/homejad', [DashboardController::class, 'jadwal'])->name('homejad');
Route::get('/homeizin', [DashboardController::class, 'izin'])->name('homeizin');


Route::get('ome', function () {

    $jurnal = Mengajar::all();
    return view('home', compact('jurnal'));
});

Route::get('/rkbm', 'App\Http\Controllers\RkbmController@data');
Route::get('/filter', 'App\Http\Controllers\RkbmController@filter');

Route::get('/rizin', 'App\Http\Controllers\RizinController@data');
Route::get('/ifilter', 'App\Http\Controllers\RizinController@filter');
Route::get('rizin/filter', [RizinController::class, 'filter'])->name('rizin.filter');

Route::get('/rjurnal', 'App\Http\Controllers\RjurnalController@data');
Route::get('rjurnal/filter', [RjurnalController::class, 'filter'])->name('rjurnal.filter');

Route::get('/rabsen', 'App\Http\Controllers\RabsenController@data');
Route::get('rabsen/filter', [RabsenController::class, 'filter'])->name('rabsen.filter');

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
