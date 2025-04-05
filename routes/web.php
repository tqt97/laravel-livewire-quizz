<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('quiz/{quiz}/{slug?}', [HomeController::class, 'show'])->name('quiz.show');

Route::get('results/{test}', [ResultController::class, 'show'])->name('results.show');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('results', [ResultController::class, 'index'])->name('results.index');

});

require __DIR__.'/auth.php';
