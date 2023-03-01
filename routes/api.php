<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ReserveBookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'users' => UserController::class,
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'publishers' => PublisherController::class,
    'reserves' => ReserveController::class,
    'userTypes' => UserTypeController::class,
    'reservesBooks' => ReserveBookController::class
]);