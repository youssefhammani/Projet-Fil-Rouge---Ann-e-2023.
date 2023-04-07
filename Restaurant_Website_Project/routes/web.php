<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('home', 'home.front')->name('');
    Route::view('about', 'home.front')->name('home');
    Route::view('menu', 'home.menu')->name('');
    Route::view('contact', 'home.contact')->name('');
    Route::view('events', 'home.events')->name('');
    Route::view('chefs', 'home.chefs')->name('');
    Route::view('gallery', 'home.gallery')->name('');
    Route::view('book-a-table', 'home.book-a-table')->name('');
    Route::view('gallery', 'home.front')->name('home');
    Route::view('gallery', 'home.front')->name('home');
});

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('add-category', [CategoryController::class, 'create']);
    Route::post('add-category', [CategoryController::class, 'store']);

});