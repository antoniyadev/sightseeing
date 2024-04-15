<?php

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
    Route::get('/{sight}', Sights\Show::class)->name('show');
});
