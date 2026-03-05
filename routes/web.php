<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesertaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('users.index');

Route::get('/tables', function () {
    return view('tables');
})->middleware(['auth'])->name('tables');


Route::get('/peserta', [PesertaController::class, 'index'])
    ->middleware(['auth'])
    ->name('peserta.index');

Route::resource('peserta', PesertaController::class)
    ->middleware(['auth']);

require __DIR__.'/auth.php';