<?php

use App\Http\Resources\ActionBookCollection;
use App\Http\Resources\ActionCollection;
use App\Http\Resources\ActionResource;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\SubscriberResource;
use App\Models\Action;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Publisher;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return true;
});
