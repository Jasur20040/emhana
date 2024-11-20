<?php

use App\Http\Controllers\Admin\ClientMaketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Test\TestLanguageController;
use App\Http\Controllers\Admin\Test\TestSubjectController;
use App\Http\Controllers\Admin\Test\TestQuestionController;
use App\Http\Controllers\Admin\Test\FullTestController;
use App\Http\Controllers\Admin\MaketController;
use App\Http\Controllers\Admin\ShriftController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\AdminAuthController;
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
//Route::middleware('adminAuth')->group(function () {
//    Route::resource('roles', RoleController::class)->except(['show'])->names('roles');
//});

Route::get('/', [ClientMaketController::class, 'index'])->name('index');



Route::resource('maket', MaketController::class)->except(['show'])->names('maket');
Route::resource('shrift', ShriftController::class)->except(['show'])->names('shrift');
Route::resource('type', TypeController::class)->except(['show'])->names('type');
Route::resource('clientMaket', ClientMaketController::class)->only(['index', 'destroy'])->names('clientMaket');

Route::get('/download', [ClientMaketController::class, 'downloadFile']);

Route::get('/profile', [AdminAuthController::class, 'profile'])->name('profile.edit');
Route::post('/profile/update/{id}', [AdminAuthController::class, 'updateProfile'])->name('profile.update');