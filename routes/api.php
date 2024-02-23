<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Section2Controller;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\FooterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);


Route::get('/about', [SectionController::class, 'tampilAbout']);
Route::get('/pelayanan', [SectionController::class, 'tampilPelayanan']);
Route::post('/tambah_about', [SectionController::class, 'tambahAbout']);
Route::post('/tambah_services', [SectionController::class, 'tambahServices']);
Route::put('/edit_about/{id}', [SectionController::class, 'editAbout']);
Route::put('/edit_services/{id}', [SectionController::class, 'editServices']);
Route::delete('/hapus_section/{id}', [SectionController::class, 'hapusSection']);


Route::get('/hero', [Section2Controller::class, 'tampilHero']);
Route::get('/visi', [Section2Controller::class, 'tampilVisi']);
Route::post('/tambah_section2', [Section2Controller::class, 'tambahSection2']);
Route::post('/edit_section/{id}', [Section2Controller::class, 'editSection2']);
Route::delete('/hapus_section2/{id}', [Section2Controller::class, 'hapusSection2']);


Route::get('/galeri', [GaleriController::class, 'tampilGaleri']);
Route::post('/tambah_galeri', [GaleriController::class, 'tambahGaleri']);
Route::post('/edit_galeri/{id}', [GaleriController::class, 'editGaleri']);
Route::delete('/hapus_galeri/{id}', [GaleriController::class, 'hapusGaleri']);


Route::get('/staff', [StaffController::class, 'tampilStaff']);
Route::post('/tambah_staff', [StaffController::class, 'tambahStaff']);
Route::post('/edit_staff/{id}', [StaffController::class, 'editStaff']);
Route::delete('/hapus_staff/{id}', [StaffController::class, 'hapusStaff']);


Route::get('/pengumuman', [PengumumanController::class, 'tampilPengumuman']);
Route::post('/tambah_pengumuman', [PengumumanController::class, 'tambahPengumuman']);
Route::post('/edit_pengumuman/{id}', [PengumumanController::class, 'editPengumuman']);
Route::delete('/hapus_pengumuman/{id}', [PengumumanController::class, 'hapusPengumuman']);


Route::get('/dokter', [DokterController::class, 'tampilDokter']);
Route::post('/tambah_dokter', [DokterController::class, 'tambahDokter']);
Route::post('/edit_dokter/{id}', [DokterController::class, 'editDokter']);
Route::delete('/hapus_dokter/{id}', [DokterController::class, 'hapusDokter']);


Route::get('/daftar', [DaftarController::class, 'tampilDaftar']);
Route::post('/daftar_pasien', [DaftarController::class, 'tambahDaftarPasien']);
Route::post('/edit_status/{id}', [DaftarController::class, 'editStatus']);
Route::delete('/hapusDaftar_pasien/{id}', [DaftarController::class, 'hapusDaftarPasien']);


Route::get('/footer', [FooterController::class, 'tampilFooter']);
Route::post('/tambah_footer', [FooterController::class, 'tambahFooter']);
Route::post('/edit_footer/{id}', [FooterController::class, 'editFooter']);
Route::delete('/hapus_footer/{id}', [FooterController::class, 'hapusFooter']);





