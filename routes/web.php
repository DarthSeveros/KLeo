<?php

use App\Http\Controllers\ObraController;
use App\Http\Controllers\CapituloController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
*
* Route::get('/', function () {
*    return view('');
* });
*/

Auth::routes();

Route::controller(ObraController::class)->group(function() {
    Route::get('/{categoria?}', 'index')->name('obras.index');
    Route::get('obras/crear', 'create')->name('obras.create')->middleware(['auth']);
    Route::get('obras/follow', 'following')->name('obras.following')->middleware('auth');
    Route::get('obras/{id}', 'show')->name('obras.show');
    Route::get('obras/{id}/edit', 'edit')->name('obras.edit')->middleware(['auth']);

    Route::get('obras/{obra}/follow','follow')->name('obras.follow')->middleware('auth');
    

    Route::post('obras', 'store')->name('obras.store')->middleware(['auth']);

    Route::patch('obras/{id}', 'update')->middleware('auth')->name('obras.update');

    Route::delete('obras/{id}', 'destroy')->name('obras.delete')->middleware('auth');
});

Route::controller(CapituloController::class)->group(function() {
    Route::get('capitulos/crear/{obra}', 'create')->name('capitulos.create')->middleware(['auth']);
    Route::get('capitulos/{id}', 'show')->name('capitulos.show');
    Route::get('capitulos/{id}/edit', 'edit')->name('capitulos.edit')->middleware(['auth']);

    Route::post('capitulos/{obra}', 'store')->name('capitulos.store')->middleware(['auth']);

    Route::patch('capitulos/{id}', 'update')->middleware('auth')->name('capitulos.update');

    Route::delete('capitulos/{capitulo}', 'destroy')->name('capitulos.delete')->middleware('auth');
});

Route::controller(UserController::class)->group(function() {
    Route::get('users/{user}', 'show')->name('users.show');
});


require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
