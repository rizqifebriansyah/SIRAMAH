<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuSehatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ErmController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login');
Route::post('register', [LoginController::class, 'register'])->middleware('guest')->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('cariunit', [LoginController::class, 'cariunit'])->name('cariunit');

Route::post('ambildatapasien', [ErmController::class, 'ambildatapasien'])->middleware('auth')->name('ambildatapasien');
Route::post('detailpasien', [ErmController::class, 'detailpasien'])->middleware('auth')->name('detailpasien');
Route::post('formcppt', [ErmController::class, 'formcppt'])->middleware('auth')->name('formcppt');
Route::post('Hasilpemeriksaanpenunjang', [ErmController::class, 'Hasilpemeriksaanpenunjang'])->middleware('auth')->name('Hasilpemeriksaanpenunjang');
Route::post('detaillast_kj', [ErmController::class, 'detaillast_kj'])->middleware('auth')->name('detaillast_kj');
Route::post('detail_asskep', [ErmController::class, 'detail_asskep'])->middleware('auth')->name('detail_asskep');
Route::post('tindakanhariini', [ErmController::class, 'tindakanhariini'])->middleware('auth')->name('tindakanhariini');
Route::post('orderhariini', [ErmController::class, 'orderhariini'])->middleware('auth')->name('orderhariini');
Route::post('resumemedis', [ErmController::class, 'resumemedis'])->middleware('auth')->name('resumemedis');
Route::post('cekresume', [ErmController::class, 'cekresume'])->middleware('auth')->name('cekresume');

//perawat
Route::group(['middleware' => ['hak_akses:2','auth']], function () {
    Route::get('/perawat', [ErmController::class, 'indexPerawat'])->name('perawat');
    Route::post('/formperawat', [ErmController::class, 'formperawat'])->name('formperawat');
    Route::get('/erm/{kodekunjungan}', [ErmController::class, 'indexErmPerawat'])->name('indexErmPerawat');
    Route::post('/simpanpemeriksaanperawat', [ErmController::class, 'simpanformperawat'])->name('simpanpemeriksaanperawat');   
    Route::post('/simpansignature_perawat', [ErmController::class, 'simpansignature_perawat'])->name('simpansignature_perawat');
});

//dokter
Route::group(['middleware' => ['hak_akses:3','auth']], function () {
    Route::get('/dokter', [ErmController::class, 'indexDokter'])->name('dokter');
    Route::post('/formdokter', [ErmController::class, 'formdokter'])->name('formdokter');
    Route::post('/riwayatpengobatan', [ErmController::class, 'riwayatpengobatan'])->name('riwayatpengobatan');
    Route::post('/terapitindakan', [ErmController::class, 'terapitindakan'])->name('terapitindakan');
    Route::post('/simpanlayanan', [ErmController::class, 'simpanlayanan'])->name('simpanlayanan');
    Route::post('/simpanorder', [ErmController::class, 'simpanorder'])->name('simpanorder');
    Route::post('/orderpenunjang', [ErmController::class, 'orderpenunjang'])->name('orderpenunjang');
    Route::post('/tindaklanjut', [ErmController::class, 'tindaklanjut'])->name('tindaklanjut');
    Route::post('/ambillayanan', [ErmController::class, 'ambillayanan'])->name('ambillayanan');
    Route::post('/batalorder', [ErmController::class, 'batalorder'])->name('batalorder');
    Route::post('/returorder', [ErmController::class, 'returorder'])->name('returorder');
    Route::post('/formtindaklanjut', [ErmController::class, 'formtindaklanjut'])->name('formtindaklanjut');
    Route::get('/erm/dokter/{kodekunjungan}', [ErmController::class, 'indexErmDokter'])->name('indexErmDokter');
    Route::post('/simpanpemeriksaandokter', [ErmController::class, 'simpanpemeriksaandokter'])->name('simpanpemeriksaandokter');
    Route::post('/bataltindakan', [ErmController::class, 'bataltindakan'])->name('bataltindakan');
    Route::post('/returtindakan', [ErmController::class, 'returtindakan'])->name('returtindakan');
    Route::post('/pasienpulang', [ErmController::class, 'pasienpulang'])->name('pasienpulang');
    Route::post('/pasienranap', [ErmController::class, 'pasienranap'])->name('pasienranap');
    Route::post('/simpansignature', [ErmController::class, 'simpansignature'])->name('simpansignature');
});
