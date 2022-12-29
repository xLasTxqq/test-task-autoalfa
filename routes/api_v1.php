<?php

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
        Route::get('/book/create', [BookController::class, 'store'])->name('api.v1.book.create');
        Route::get('/book/update', [BookController::class, 'update'])->name('api.v1.book.update');
        Route::get('/book/delete', [BookController::class, 'destroy'])->name('api.v1.book.delete');
    });
    Route::middleware('can:give_and_take_books')->group(function () {
        Route::get('/action/create/giving', [BookController::class, 'update'])->name('api.v1.action.update');
        Route::get('/action/create/taking', [BookController::class, 'destroy'])->name('api.v1.action.delete');
    });
    Route::get('/action/create/booking', [BookController::class, 'store'])->name('api.v1.book.create');
});
