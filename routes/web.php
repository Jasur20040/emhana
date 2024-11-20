<?php

use App\Http\Controllers\Admin\ClientMaketController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Admin/home');
// })->name('index');

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('adminLoginShow');
    Route::post('/login', [AdminAuthController::class, 'adminLoginForm'])->name('adminLoginForm');
});
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Route::get('/', [HomeController::class, 'index'])->name('index');

Route::resource('suret', ClientController::class)->except(['create', 'edit', 'store', 'show', 'index'])->names('suret');

Route::get('/', [ClientController::class, 'types']);
Route::get('/suretgo', [ClientController::class, 'types']);

Route::get('/suret/{slug?}', [ClientController::class, 'index'])->name('suret.index');
Route::get('/suret/{type}/{id}', [ClientController::class, 'edit'])->name('suret.edit');

Route::get('/destroy/clientsImages', [ClientMaketController::class, 'destroyClientImages']);