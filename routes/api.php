<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
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


// Public routes - no need for authentication
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
// The route for SEARCH
Route::get('/products/search/{name}', [ProductController::class, 'search']);


// Protected routes - authentication required
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/logout', [AuthController::class, 'logout']);
});

// first the data from the controller and then the method in use

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
