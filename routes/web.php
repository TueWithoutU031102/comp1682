<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Manager\TypeController;
use App\Http\Controllers\Manager\TableController;
use App\Http\Controllers\Manager\MenuController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'customer'], function () {
    /////// CUSTOMER ///////

    Route::get('index', [CustomerController::class, 'index'])->name('books.index');
    Route::group(['prefix' => 'booking'], function () {
        Route::get('bookForm', [CustomerController::class, 'bookForm']);

        Route::post('store', [CustomerController::class, 'store']);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('orderForm', [CustomerController::class, 'orderForm']);

        Route::get('detailDish/{id}', [CustomerController::class, 'detailDish']);

        Route::get('addToCart/{id}', [CustomerController::class, 'addToCart'])->name('addToCart');

        Route::get('showCart', [CustomerController::class, 'showCart'])->name('showCart');

        Route::post('updateCart', [CustomerController::class, 'updateCart'])->name('updateCart');

        Route::post('deleteCart', [CustomerController::class, 'deleteCart'])->name('deleteCart');

        Route::post('submitCart', [CustomerController::class, 'submitCart'])->name('submitCart');
    });

    // Route::get("showAcc/{id}", [Controller::class, 'showAcc']);

    // Route::get("editAcc/{id}", [Controller::class, 'showFormEditAccount']);

    // Route::post("editAcc/{id}", [Controller::class, 'updateAcc']);

    // Route::post("deleteAcc/{user}", [Controller::class, 'delete']);
});

Route::group(['prefix' => 'manager'], function () {
    Route::get('index', [ManagerController::class, 'index'])->name('manager.index');
    Route::prefix('menus')->group(function () {
        Route::get('index', [MenuController::class, 'index'])->name('manager.menu.index');
        Route::get('create', [MenuController::class, 'create'])->name('manager.menu.create');
        Route::post('store', [MenuController::class, 'store'])->name('manager.menu.store');
        Route::get('/{menu}', [MenuController::class, 'show'])->name('manager.menu.show');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('manager.menu.edit');
        Route::post('/{menu}/update', [MenuController::class, 'update'])->name('manager.menu.update');
        Route::post('/{menu}/destroy', [MenuController::class, 'destroy'])->name('manager.menu.destroy');
    });
    Route::prefix('tables')->group(function () {
        Route::get('index', [TableController::class, 'index'])->name('manager.table.index');
        Route::get('create', [TableController::class, 'create'])->name('manager.table.create');
        Route::post('store', [TableController::class, 'store'])->name('manager.table.store');
        Route::get('/{table}/edit', [TableController::class, 'edit'])->name('manager.table.edit');
        Route::post('/{table}/update', [TableController::class, 'update'])->name('manager.table.update');
        Route::post('/{table}/destroy', [TableController::class, 'destroy'])->name('manager.table.destroy');
    });
    Route::prefix('types')->group(function () {
        Route::get('index', [TypeController::class, 'index'])->name('manager.type.index');
        Route::get('create', [TypeController::class, 'create'])->name('manager.type.create');
        Route::post('store', [TypeController::class, 'store'])->name('manager.type.store');
        Route::get('/{type}/edit', [TypeController::class, 'edit'])->name('manager.type.edit');
        Route::post('/{type}/update', [TypeController::class, 'update'])->name('manager.type.update');
        Route::post('/{type}/destroy', [TypeController::class, 'destroy'])->name('manager.type.destroy');
    });
    Route::prefix('books')->group(function () {
        Route::get('index', [ManagerController::class, 'index'])->name('manager.book.index');
    });
});

Route::group(['prefix' => 'staff'], function () {
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
