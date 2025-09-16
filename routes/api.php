<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GaleriApiController;
use App\Http\Controllers\Api\UnduhanApiController;
use App\Http\Controllers\Api\PejabatApiController;
use App\Http\Controllers\Api\KontakApiController;
use App\Http\Controllers\Api\HeroApiController;
use App\Http\Controllers\Api\AgendaApiController;
use App\Http\Controllers\Api\VisiMisiApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// routes/api.php

// Endpoint publik untuk login
Route::post('/login', [AuthController::class, 'login']);

// Berita
Route::get('/beritas', [BeritaApiController::class, 'index']);
Route::get('/beritas/{berita}', [BeritaApiController::class, 'show']);

// Galeri
Route::get('/galeris', [GaleriApiController::class, 'index']); 
Route::get('/galeris/{galeri}', [GaleriApiController::class, 'show']);

// Unduhan
Route::get('/unduhans', [UnduhanApiController::class, 'index']);

// Agenda
Route::get('/agendas', [AgendaApiController::class, 'index']);
Route::get('/agendas/{agenda}', [AgendaApiController::class, 'show']);
Route::get('/agendas/{agenda}/download', [AgendaApiController::class, 'download'])->name('api.agendas.download');

// Pejabat/Struktur Organisasi
Route::get('/pejabats', [PejabatApiController::class, 'index']);
Route::get('/pejabats/{pejabat}', [PejabatApiController::class, 'show']);

// Hero/Banner Slides
Route::get('/heroes', [HeroApiController::class, 'index']);
Route::get('/heroes/{hero}', [HeroApiController::class, 'show']);

// Visi & Misi
Route::get('/visi-misi', [VisiMisiApiController::class, 'index']);
Route::get('/visi-misi/active', [VisiMisiApiController::class, 'active']);
Route::get('/visi-misi/{visiMisi}', [VisiMisiApiController::class, 'show']);

// Kontak (publik untuk mengirim pesan)
Route::post('/kontaks', [KontakApiController::class, 'store']);

// Grup untuk endpoint yang memerlukan token
Route::middleware('auth:sanctum')->group(function () {
    // Autentikasi & Profil
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'getProfile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::put('/profile/password', [AuthController::class, 'updatePassword']);

    // Berita Management
    Route::post('/beritas', [BeritaApiController::class, 'store']);
    Route::put('/beritas/{berita}', [BeritaApiController::class, 'update']);
    Route::delete('/beritas/{berita}', [BeritaApiController::class, 'destroy']);

    // Galeri Management
    Route::post('/galeris', [GaleriApiController::class, 'store']);
    Route::delete('/galeris/{galeri}', [GaleriApiController::class, 'destroy']);

    // Unduhan Management
    Route::post('/unduhans', [UnduhanApiController::class, 'store']);
    Route::delete('/unduhans/{unduhan}', [UnduhanApiController::class, 'destroy']);

    // Agenda Management
    Route::post('/agendas', [AgendaApiController::class, 'store']);
    Route::put('/agendas/{agenda}', [AgendaApiController::class, 'update']);
    Route::delete('/agendas/{agenda}', [AgendaApiController::class, 'destroy']);

    // Pejabat Management
    Route::post('/pejabats', [PejabatApiController::class, 'store']);
    Route::put('/pejabats/{pejabat}', [PejabatApiController::class, 'update']);
    Route::delete('/pejabats/{pejabat}', [PejabatApiController::class, 'destroy']);

    // Hero/Banner Management
    Route::post('/heroes', [HeroApiController::class, 'store']);
    Route::put('/heroes/{hero}', [HeroApiController::class, 'update']);
    Route::post('/heroes/{hero}/image', [HeroApiController::class, 'updateImage']);
    Route::delete('/heroes/{hero}', [HeroApiController::class, 'destroy']);

    // Visi & Misi Management
    Route::post('/visi-misi', [VisiMisiApiController::class, 'store']);
    Route::put('/visi-misi/{visiMisi}', [VisiMisiApiController::class, 'update']);
    Route::delete('/visi-misi/{visiMisi}', [VisiMisiApiController::class, 'destroy']);
    Route::post('/visi-misi/{visiMisi}/activate', [VisiMisiApiController::class, 'activate']);
    Route::post('/visi-misi/{visiMisi}/deactivate', [VisiMisiApiController::class, 'deactivate']);

    // Kontak Management (admin only)
    Route::get('/kontaks', [KontakApiController::class, 'index']);
    Route::get('/kontaks/{kontak}', [KontakApiController::class, 'show']);
    Route::delete('/kontaks/{kontak}', [KontakApiController::class, 'destroy']);
});