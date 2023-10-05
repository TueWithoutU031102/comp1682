<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\CheckinController;
use App\Http\Controllers\Manager\TypeController;
use App\Http\Controllers\Manager\TableController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Manager\MenuController as ManagerMenuController;
use App\Http\Controllers\Customer\BookController as CustomerBookController;
use App\Http\Controllers\Manager\BookController as ManagerBookController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
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
})->name('index');
Route::prefix('admins')->group(function () {
    Route::prefix('manages')->group(function () {
        Route::get('index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/{user}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/{user}/update', [AdminController::class, 'update'])->name('admin.update');
        Route::post('/{user}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
    });
});
Route::prefix('customers')->group(function () {
    /////// CUSTOMER ///////
    Route::get('index', [CustomerController::class, 'index'])->name('customer.index');
    Route::prefix('books')->group(function () {
        Route::get('create', [CustomerBookController::class, 'create'])->name('customer.book.create');
        Route::post('store', [CustomerBookController::class, 'store'])->name('customer.book.store');
    });
    Route::prefix('menus')->group(function () {
        Route::get('index', [CustomerMenuController::class, 'index'])->name('customer.menu.index');
        Route::get('/{menu}', [CustomerMenuController::class, 'show'])->name('customer.menu.show');
    });
    Route::prefix('orders')->group(function () {
        Route::get('add/{menu}', [CustomerOrderController::class, 'add'])->name('customer.order.add');
        Route::get('show', [CustomerOrderController::class, 'show'])->name('customer.order.show');
        Route::post('update', [CustomerOrderController::class, 'update'])->name('customer.order.update');
        Route::post('remove', [CustomerOrderController::class, 'remove'])->name('customer.order.remove');
        Route::post('store', [CustomerOrderController::class, 'store'])->name('customer.order.store');
    });
    Route::prefix('checkins')->group(function () {
        Route::get('index/{table}', [CheckinController::class, 'index'])->name('customer.checkin.index');
        Route::get('notice', [CheckinController::class, 'notice'])->name('customer.checkin.notice');
        Route::get('tables/{table}', [CheckinController::class, 'create'])->name('customer.checkin.table');
        Route::post('store/{table}', [CheckinController::class, 'store'])->name('customer.checkin.store');
        //xử lý check in:
        //Đối với table k có session, cho phép người dùng tao session và chuyển hướng người dùng sang trang order
    });
});

Route::prefix('managers')->group(function () {
    Route::get('index', [ManagerController::class, 'index'])->name('manager.index');
    Route::prefix('menus')->group(function () {
        Route::get('index', [ManagerMenuController::class, 'index'])->name('manager.menu.index');
        Route::get('create', [ManagerMenuController::class, 'create'])->name('manager.menu.create');
        Route::post('store', [ManagerMenuController::class, 'store'])->name('manager.menu.store');
        Route::get('/{menu}', [ManagerMenuController::class, 'show'])->name('manager.menu.show');
        Route::get('/{menu}/edit', [ManagerMenuController::class, 'edit'])->name('manager.menu.edit');
        Route::post('/{menu}/update', [ManagerMenuController::class, 'update'])->name('manager.menu.update');
        Route::post('/{menu}/destroy', [ManagerMenuController::class, 'destroy'])->name('manager.menu.destroy');
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
        Route::get('index', [ManagerBookController::class, 'index'])->name('manager.book.index');
    });
});

Route::prefix('staffs')->group(function () {
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