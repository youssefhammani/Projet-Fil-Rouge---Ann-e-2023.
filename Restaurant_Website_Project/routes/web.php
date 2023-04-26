<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PDFController;

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
    return view('home.front');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('home', 'home.front')->name('');
    Route::view('about', 'home.front')->name('home');
    // Route::view('menu', 'home.menu')->name('');
    Route::get('menu', [ProductController::class, 'getProducts']);
    Route::view('contact', 'home.contact')->name('');
    Route::view('events', 'home.events')->name('');
    Route::get('events', [EventController::class, 'getEvents']);
    Route::view('chefs', 'home.chefs')->name('');
    Route::view('gallery', 'home.gallery')->name('');
    Route::view('book-a-table', 'home.book-a-table')->name('');
    // Route::view('gallery', 'home.front')->name('home');
    Route::view('test', 'home.gallery')->name('');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('CheckAdmin');

// Route::get('buying', function () {
//     return view('home.buying');
// });

// Route::prefix('admin')->group(function() {
//     Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
//     Route::get('/categories', [CategoryController::class, 'index']);
//     Route::get('add-category', [CategoryController::class, 'create']);
//     Route::post('add-category', [CategoryController::class, 'store']);
//     Route::get('edit-category/{category_id}', [CategoryController::class, 'edit']);
//     Route::put('update-category/{category_id}', [CategoryController::class, 'update']);
//     Route::get('delete-category/{category_id}', [CategoryController::class, 'destroy']);

// });

// Route::post('Cat',[CategoryController::class,'store'])->name('catt');
Route::group(
    [
        'prefix' => 'admin/categories',
        'as' => 'admin.categories.',
        'middleware' => 'CheckAdmin',
        'controller' => CategoryController::class,
    ],
    function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create');
        Route::post('/', 'store');
        Route::get('{id}/edit', 'edit');
        Route::put('{id}', 'update');
        // Route::delete('{id}', 'destroy')->name('destroy');
        Route::get('{id}', 'destroy');
    },
);

Route::middleware(['auth', 'verified'])->group(function () {
Route::group(
    [
        'prefix' => 'admin/products',
        'as' => 'admin.products.',
        'middleware' => 'CheckAdmin',
        'controller' => ProductController::class,
    ],
    function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create');
        Route::post('/', 'store');
        Route::get('{id}/edit', 'edit');
        Route::put('{id}', 'update');
        Route::get('{id}', 'destroy');
    },
);
});

Route::middleware(['auth', 'verified'])->group(function () {
Route::group(
    [
        'prefix' => 'admin/events',
        'middleware' => 'CheckAdmin',
        'controller' => EventController::class,
    ],
    function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::get('{id}', 'destroy')->name('delete');
    },
);
});

Route::middleware(['auth', 'verified'])->group(function () {
Route::group(
    [
        'prefix' => 'admin/users',
        'middleware' => 'CheckAdmin',
        'controller' => DashboardController::class,
    ],
    function () {
        Route::get('/', 'getUsers')->name('users.get');
        Route::get('{id}/edit', 'editUsers');
        Route::get('checkout', 'checkOut');
        Route::get('{id}', 'deleteOreder');
        Route::get('{id}/done', 'doneOreder');
    },
);
});

Route::middleware(['auth', 'verified'])->group(function () {
Route::group(
    [
        'prefix' => 'admin/booking',
        'as' => 'booking.',
        'controller' => TableController::class,
    ],
    function () {
        Route::get('/', 'index')->name('index');
        // Route::get('create', 'create')->name('create');
        // Route::post('/', 'store')->name('store');
        Route::get('{id}/edit', 'edit')->name('Edit');
        Route::put('{id}', 'update')->name('Update');
        Route::get('{id}', 'destroy')->name('Delete');
    },
);
});

Route::middleware(['auth', 'verified'])->group(function () {
Route::group(['controller' => TableController::class], function () {
    Route::post('book-a-table', 'store')->name('booking');
    // Route::get('create', 'create');
});
});

Route::group(
    [
        'controller' => DashboardController::class,
    ],
    function () {
        Route::get('basket/{id}', 'AddToCart');
        Route::get('cart', 'show');
        // Route::get('confirmation', 'confirm')->name('stripe.post');
    },
);

Route::middleware(['auth', 'verified'])->group(function () {
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
});

Route::view('/oui','oui');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Basket', [DashboardController::class, 'Basket'])->name('Basket');
    Route::get('/buying1', [DashboardController::class, 'getOrders']);
    Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF']);
    // route::get('Profile/{id}', [DashboardController::class, 'userInfo']);
    Route::view('Profile','home.profile');

});
