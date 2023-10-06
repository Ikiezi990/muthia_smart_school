<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\TagihanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/tagihan-siswa', function () {
    return view('menusiswa.tagihan');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/kelas', [KelasController::class, 'store']);
Route::get('/kelas', [KelasController::class, 'index'])->name("kelas.index");
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit']);
Route::put('/kelas/{id}', [KelasController::class, 'update']);
Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

Route::post('/tagihan', [TagihanController::class, 'store']);
Route::get('/tagihan', [TagihanController::class, 'index'])->name("Tagihan.index");
Route::get('/tagihan/{id}/edit', [TagihanController::class, 'edit']);
Route::put('/tagihan/{id}', [TagihanController::class, 'update']);
Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy']);

Route::get('/angkatan', [AngkatanController::class, 'index'])->name('angkatan.index');
Route::post('/angkatan', [AngkatanController::class, 'store'])->name('angkatan.store');
Route::get('/angkatan/{id}/edit', [AngkatanController::class, 'edit'])->name('angkatan.edit');
Route::put('/angkatan/{id}', [AngkatanController::class, 'update'])->name('angkatan.update');
Route::delete('/angkatan/{id}', [AngkatanController::class, 'destroy'])->name('angkatan.destroy');


use App\Http\Controllers\JurusanController;

Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::post('/jurusan', [JurusanController::class, 'store']);
Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit']);
Route::put('/jurusan/{id}', [JurusanController::class, 'update']);
Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy']);

use App\Http\Controllers\SiswaController;

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa', [SiswaController::class, 'store']);
Route::get('/siswa/{id}', [SiswaController::class, 'show']);
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit']);
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

use App\Http\Controllers\MapelController;

Route::prefix('mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index'])->name('mapel.index');
    Route::post('/', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/{id}', [MapelController::class, 'update'])->name('mapel.update');
    Route::delete('/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');
});

use App\Http\Controllers\GuruController;

Route::group(['prefix' => 'guru'], function () {
    Route::get('/', [GuruController::class, 'index'])->name('guru.index');
    Route::post('/', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
});

use App\Http\Controllers\TabunganController;

Route::group(['prefix' => 'tabungan'], function () {
    Route::get('/create', [TabunganController::class, 'create'])->name('tabungan.create');
    Route::get('/', [TabunganController::class, 'index'])->name('tabungan.index');
    Route::get('/{siswaId}', [TabunganController::class, 'show'])->name('tabungan.show');
    Route::post('/', [TabunganController::class, 'store'])->name('tabungan.store');
    Route::get('/{tabunganId}/edit', [TabunganController::class, 'edit'])->name('tabungan.edit');
    Route::put('/{tabunganId}', [TabunganController::class, 'update'])->name('tabungan.update');
    Route::delete('/{tabunganId}', [TabunganController::class, 'destroy'])->name('tabungan.destroy');
});

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

use App\Http\Controllers\JadwalController;

Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

use App\Http\Controllers\TransaksiController;

Route::get('/transaksi', [TransaksiController::class, 'showKelas'])->name('transaksi.kelas');
Route::get('/transaksi/siswa/{kelasId}', [TransaksiController::class, 'showSiswa'])->name('transaksi.siswa');
Route::get('/transaksi/tagihan/{siswaId}', [TransaksiController::class, 'showTagihan'])->name('transaksi.tagihan');
Route::get('/transaksi/create/{siswaId}', [TransaksiController::class, 'createTransaksi'])->name('transaksi.create');
Route::post('/transaksi/store', [TransaksiController::class, 'storeTransaksi'])->name('transaksi.store');


Route::get('/about', function () {
    return view('about');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/tabungansiswa', function () {
    return view('menusiswa.tabungan.index');
});

Route::get('/absensi/guru/index', [AbsensiController::class, 'index'])->name('absensi.guru.index');
Route::get('/absensi/guru/detail/{kelasId}/{jadwalId}', [AbsensiController::class, 'list_absen'])->name('absensi.guru.detail');
Route::post('/absensi/guru/detail/{kelasId}/{jadwalId}', [AbsensiController::class, 'storeBulk'])->name('absensi.storeBulk');
Route::get('/absensi/guru/tanggal', [AbsensiController::class, 'historyAbsensiTanggal'])->name('absensi.tanggal');
Route::get('/absensi/siswa/tanggal', [AbsensiController::class, 'historyAbsensiTanggalSiswa'])->name('absensi.tanggal.siswa');
Route::post('/get-student-attendance', [AbsensiController::class, 'getStudentAttendance'])->name('student.attendance');
Route::post('/get-student-attendance-siswa', [AbsensiController::class, 'getStudentAttendanceSiswa'])->name('student.attendance.siswa');
Route::post('/get-student-attendance-siswa', [AbsensiController::class, 'getStudentAttendanceSiswa'])->name('student.attendance.siswa');

use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\KinerjaSiswaController;
use App\Http\Controllers\SuratController;

// List Kinerja records
Route::get('/kinerja', [KinerjaController::class, 'index'])->name('kinerja.index');

// Show the create Kinerja form
Route::get('/kinerja/create', [KinerjaController::class, 'create'])->name('kinerja.create');

// Store a new Kinerja record
Route::post('/kinerja', [KinerjaController::class, 'store'])->name('kinerja.store');

// Show the edit Kinerja form
Route::get('/kinerja/{id}/edit', [KinerjaController::class, 'edit'])->name('kinerja.edit');

// Update an existing Kinerja record
Route::put('/kinerja/{id}', [KinerjaController::class, 'update'])->name('kinerja.update');

// Delete a Kinerja record
Route::delete('/kinerja/{id}', [KinerjaController::class, 'destroy'])->name('kinerja.destroy');

Route::get('/kinerja-siswa', [KinerjaSiswaController::class, 'index'])->name('kinerja-siswa.index');
Route::get('/kinerja-siswa/{id}/edit', [KinerjaSiswaController::class, 'edit'])->name('kinerja-siswa.edit');
Route::get('/kinerja-siswa/{id}', [KinerjaSiswaController::class, 'show'])->name('kinerja-siswa.show');
Route::post('/kinerja-siswa', [KinerjaSiswaController::class, 'store'])->name('kinerja-siswa.store');
Route::put('/kinerja-siswa/{id}', [KinerjaSiswaController::class, 'update'])->name('kinerja-siswa.update');
Route::delete('/kinerja-siswa/{id}', [KinerjaSiswaController::class, 'destroy'])->name('kinerja-siswa.destroy');

Route::resource('surat', SuratController::class);
Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');
