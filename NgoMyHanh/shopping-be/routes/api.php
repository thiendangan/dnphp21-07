<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ImageController;





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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/product')->group(function () {
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::post('/delete', [ProductController::class, 'delete']);
    Route::post('/detail', [ProductController::class, 'find']);
    
    Route::post('/list', [ProductController::class, 'list']);
    Route::post('/search', [ProductController::class, 'search']);
});
Route::prefix('/type')->group(function () {
    Route::post('/detail', [TypeController::class, 'find']);
    Route::get('/list', [TypeController::class, 'list']);
});
Route::prefix('/image')->group(function () {
    Route::post('/upload', [ImageController::class, 'upload']);
});
