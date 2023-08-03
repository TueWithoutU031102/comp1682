<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
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
    });

    // Route::get("showAcc/{id}", [Controller::class, 'showAcc']);

    // Route::get("editAcc/{id}", [Controller::class, 'showFormEditAccount']);

    // Route::post("editAcc/{id}", [Controller::class, 'updateAcc']);

    // Route::post("deleteAcc/{user}", [Controller::class, 'delete']);
});

Route::group(['prefix' => 'manager'], function () {
    Route::get('index', [ManagerController::class, 'index'])->name('index');
    Route::group(['prefix' => 'menu'], function () {
        Route::get('indexMenu', [ManagerController::class, 'menu'])->name('indexMenu');

        Route::get('formMenu', [ManagerController::class, 'createFormMenu']);

        Route::post('createMenu', [ManagerController::class, 'createMenu']);

        Route::get('detailMenu/{id}', [ManagerController::class, 'detailMenu']);

        Route::get('editMenu/{id}', [ManagerController::class, 'editFormMenu']);

        Route::post('editMenu/{id}', [ManagerController::class, 'editMenu']);

        Route::post('deleteMenu/{menu}', [ManagerController::class, 'deleteMenu']);
    });
    Route::group(['prefix' => 'type'], function () {
        Route::get('indexType', [ManagerController::class, 'type'])->name('indexType');

        Route::get('formType', [ManagerController::class, 'createFormType']);

        Route::post('createType', [ManagerController::class, 'createType']);

        Route::get('editType/{id}', [ManagerController::class, 'editFormType']);

        Route::post('editType/{id}', [ManagerController::class, 'editType']);

        Route::post('deleteType/{type}', [ManagerController::class, 'deleteType']);
    });
    Route::group(['prefix' => 'booking'], function () {
        Route::get('indexBooking', [ManagerController::class, 'booking'])->name('indexBooking');
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
