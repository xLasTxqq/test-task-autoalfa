<?php

use App\Http\Controllers\Api\v1\ActionController;
use App\Http\Controllers\Api\v1\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('can:update_and_delete_books')->group(function () {
        Route::get('/book', [BookController::class, 'store'])->name('api.v1.book.index');
        Route::get('/book/create', [BookController::class, 'store'])->name('api.v1.book.create');
        Route::get('/book/update', [BookController::class, 'update'])->name('api.v1.book.update');
        Route::get('/book/delete/{id}', [BookController::class, 'destroy'])->name('api.v1.book.delete');
    });
    Route::middleware(['can:book_and_cancel', 'can:give_and_take_books'])->group(function () {
        Route::get('action', [ActionController::class, 'index'])->name('api.v1.action.index');
        Route::delete('action/{id}', [ActionController::class, 'destroy'])->name('api.v1.action.destroy');
    });

    Route::middleware('can:book_and_cancel')
        ->post('action', [ActionController::class, 'store'])
        ->name('api.v1.action.store');

    Route::middleware('can:give_and_take_books')
        ->put('action/{id}', [ActionController::class, 'update'])
        ->name('api.v1.action.update');
});
