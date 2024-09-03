<?php

use App\Livewire\ShowCart;
use Illuminate\Support\Facades\Route;
use App\Livewire\Sights;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//redirect / to sights 
Route::redirect('/', '/sights');

Route::name('sights.')->prefix('sights')->group(function () {
    Route::get('/', Sights\Index::class)->name('index');
    Route::get('/{sight}', Sights\Show::class)->name('show')->middleware(['auth']);
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/cart', ShowCart::class)->middleware(['auth']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
