<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\consumirApiMoedas;

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

Route::post('/dashboard', 
    [consumirApiMoedas::class, 'convert']
)->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', 
    [consumirApiMoedas::class, 'get']
)->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
