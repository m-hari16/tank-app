<?php

use App\Http\Controllers\Web\TankA;
use App\Http\Controllers\Web\TankB;
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

/**
 * Page View Routes
 */
Route::get('/', function () {
    return view('page.home.index');
});
Route::get('/tank-a/51-58', [TankA::class, 'index'])->name('tankA.index');
Route::get('/tank-b/{tank_identity}', [TankB::class, 'index'])->name('tankB.index');

/**
 * Form Handler Routes
 */
Route::post('/tank/51-58', [TankA::class, 'calculate'])->name('tankA.calculate');
Route::post('/tank/201-204', [TankB::class, 'calculate'])->name('tankB.calculate');