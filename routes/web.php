<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
// Content Controllers
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UnduhanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\AgendaController;
// Public Controllers
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan semua route untuk aplikasi Anda.
|
*/

// // Halaman Publik (Welcome)
// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/berita', [PublicController::class, 'berita'])->name('public.berita');
Route::get('/berita/{berita}', [PublicController::class, 'beritaShow'])->name('public.berita.show');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri');
Route::get('/agenda', [AgendaController::class, 'index'])->name('public.agenda');
Route::get('/agenda/{agenda}', [AgendaController::class, 'show'])->name('public.agenda.show');
Route::get('/pejabat', [PublicController::class, 'pejabat'])->name('public.pejabat');
Route::get('/profil/visi-misi', [PublicController::class, 'visiMisi'])->name('public.visi-misi');
Route::get('/unduhan', [PublicController::class, 'unduhan'])->name('public.unduhan');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');
Route::post('/kontak', [PublicController::class, 'kontakStore'])->name('public.kontak.store');



/*
|--------------------------------------------------------------------------
| Admin & Auth Routes
|--------------------------------------------------------------------------
*/

// Grup untuk semua halaman yang memerlukan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Route untuk Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP UNTUK SEMUA ROUTE PANEL ADMIN ---
    Route::prefix('admin')->group(function () {
        // Upload gambar untuk TinyMCE
        Route::post('/upload-image', [BeritaController::class, 'uploadImage'])->name('admin.upload-image');
        
        // Menggunakan middleware 'can' untuk memeriksa permission
        Route::resource('beritas', BeritaController::class)->middleware('can:manage news');
        Route::resource('galeri', GaleriController::class)->middleware('can:manage gallery');
        Route::resource('unduhan', UnduhanController::class)->middleware('can:manage downloads');
        Route::resource('agenda', AdminAgendaController::class)->names('admin.agenda')->middleware('can:manage downloads');
        Route::get('agenda/{agenda}/download', [AdminAgendaController::class, 'download'])->name('admin.agenda.download')->middleware('can:manage downloads');
        Route::resource('visi-misi', VisiMisiController::class)->names('admin.visi-misi')->middleware('can:manage hero');
        Route::post('visi-misi/{visiMisi}/activate', [VisiMisiController::class, 'activate'])->name('admin.visi-misi.activate')->middleware('can:manage hero');
        Route::post('visi-misi/{visiMisi}/deactivate', [VisiMisiController::class, 'deactivate'])->name('admin.visi-misi.deactivate')->middleware('can:manage hero');
        Route::resource('kontak', KontakController::class)->only(['index', 'show', 'destroy'])->middleware('can:manage contacts');
        Route::resource('hero', HeroController::class)->middleware('can:manage hero');
        Route::resource('pejabat', PejabatController::class)->middleware('can:manage officials');
        Route::resource('users', UserController::class)->middleware('can:manage users');
    });
});

// Route untuk autentikasi (login, logout, dll.)
require __DIR__ . '/auth.php';
