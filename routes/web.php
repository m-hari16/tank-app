<?php

use App\Http\Controllers\Web\TankA;
use Illuminate\Support\Facades\Route;

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
    return view('page.home.home');
});

/**
 * Page View Routes
 */
Route::get('/', function () {
    return view('page.home.index');
});
Route::get('/tank/51-58', [TankA::class, 'index'])->name('tankA.index');

/**
 * Form Handler Routes
 */
Route::post('/tank/51-58', [TankA::class, 'calculate'])->name('tankA.calculate');