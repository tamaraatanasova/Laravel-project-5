<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestMatchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('teams', TeamController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('matches', MatchController::class);
});

Route::get('matches', [GuestMatchController::class, 'index'])->name('matches.index');

require __DIR__.'/auth.php';
