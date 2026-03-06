<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\EventController;
use App\Models\Peserta;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalPeserta   = Peserta::count();
    $totalEvent     = Event::count();
    $eventAktif     = Event::where('status', 'Aktif')->count();
    $eventSelesai   = Event::where('status', 'Selesai')->count();
    $pesertaTerbaru = Peserta::orderBy('id', 'desc')->take(5)->get();

    return view('dashboard', compact(
        'totalPeserta',
        'totalEvent',
        'eventAktif',
        'eventSelesai',
        'pesertaTerbaru'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('users.index');

Route::get('/peserta', [PesertaController::class, 'index'])
    ->middleware(['auth'])
    ->name('peserta.index');

Route::resource('peserta', PesertaController::class)
    ->middleware(['auth']);

Route::resource('event', EventController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

require __DIR__.'/auth.php';