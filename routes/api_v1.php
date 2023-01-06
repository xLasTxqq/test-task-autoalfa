<?php

use App\Http\Controllers\Api\v1\ActionController;
use App\Http\Controllers\Api\v1\AuthorController;
use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\GenreController;
use App\Http\Controllers\Api\v1\GradeController;
use App\Http\Controllers\Api\v1\PermissionController;
use App\Http\Controllers\Api\v1\PublisherController;
use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\SubscriberController;
use App\Http\Controllers\Api\v1\UserController;
use App\Models\User;
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

Route::middleware('auth:sanctum')->group(
    function () {

        Route::group(['middleware' => ['permission:' . User::PERMISSION_CREATE_UPDATE_DELETE_BOOKS]], function () {
            Route::apiResource('genre', GenreController::class)->only(['store', 'destroy']);
            Route::apiResource('author', AuthorController::class)->only(['store', 'destroy']);
            Route::apiResource('publisher', PublisherController::class)->only(['store', 'destroy']);
            Route::apiResource('book', BookController::class)->only(['store', 'update', 'destroy']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_CREATE_DELETE_USERS]], function () {
            Route::apiResource('role', RoleController::class)->only(['index']);
            Route::apiResource('user', UserController::class)->only(['index', 'destroy']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_UPDATE_OTHERS_PASSWORD]], function () {
            Route::apiResource('user', UserController::class)->only(['update']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_SUBSCRIBE_TO_BOOKS]], function () {
            Route::apiResource('subscriber', SubscriberController::class)->only(['store', 'destroy']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_COMMENT_AND_RATE_BOOKS]], function () {
            Route::apiResource('comment', CommentController::class)->only(['store', 'destroy']);
            Route::apiResource('grade', GradeController::class)->only(['store', 'destroy']);
        });

        Route::group(['middleware' => [
            'permission:' . User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS . "|" . User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS
        ]], function () {
            Route::apiResource('action', ActionController::class)->only(['index', 'destroy']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_RESERVE_AND_CANCEL_RESERVE_BOOKS]], function () {
            Route::apiResource('action', ActionController::class)->only(['store']);
        });

        Route::group(['middleware' => ['permission:' . User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS]], function () {
            Route::apiResource('action', ActionController::class)->only(['update']);
        });

        Route::apiResource('permission', PermissionController::class)->only(['index']);
    }
);

Route::apiResource('book', BookController::class)->only(['index', 'show']);
Route::apiResource('genre', GenreController::class)->only(['index', 'show']);
Route::apiResource('author', AuthorController::class)->only(['index', 'show']);
Route::apiResource('publisher', PublisherController::class)->only(['index', 'show']);

require __DIR__ . '/api_v1_auth.php';
