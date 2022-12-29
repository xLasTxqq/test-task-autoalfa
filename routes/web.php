<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientActionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerActionController;
use App\Models\Publisher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//CRUD FOR USER
Route::middleware('can:update_password')
    ->resource('users', UserController::class)
    ->only(['index', 'update', 'edit', 'destroy']);

Route::middleware('can:update_and_delete_users')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

//CRUD FOR BOOK
Route::middleware('can:update_and_delete_books')->group(function () {
    Route::resource('book', BookController::class)->except(['index']);
});
Route::get('/', [BookController::class, 'index'])->name('book.index');

//CRUD FOR ACTION
Route::middleware(['can:book_and_cancel', 'can:give_and_take_books'])->group(function () {
    Route::get('action', [ActionController::class, 'index'])
        ->name('action.index');
    Route::delete('action/{id}', [ActionController::class, 'destroy'])
        ->name('action.destroy');
});

Route::middleware('can:book_and_cancel')
    ->post('action', [ActionController::class, 'store'])
    ->name('action.store');

Route::middleware('can:give_and_take_books')
    ->put('action/{id}', [ActionController::class, 'update'])
    ->name('action.update');

//CRUD SUBSCRIBE

Route::middleware('can:book_and_cancel')
    ->post('subscribe', [SubscribeController::class, 'store'])
    ->name('subscribe.store');

Route::middleware('can:book_and_cancel')
    ->post('grades', [GradeController::class, 'store'])
    ->name('grade.store');

Route::middleware('can:book_and_cancel')
    ->post('comment', [CommentController::class, 'store'])
    ->name('comment.store');

//CREATE GENRE, PUBLISHER, AUTHOR
Route::middleware('can:update_and_delete_books')->group(function () {
    Route::resource('author', AuthorController::class)->only(['create', 'store']);
    Route::resource('genre', GenreController::class)->only(['create', 'store']);
    Route::resource('publisher', PublisherController::class)->only(['create', 'store']);
});
// });
require __DIR__ . '/auth.php';
