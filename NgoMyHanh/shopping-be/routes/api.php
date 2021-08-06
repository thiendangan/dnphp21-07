<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;






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
    // dd("ok");
    // dd($request);
    return $request->user();
});
Route::prefix('/user')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});
Route::prefix('/product')->group(function () {
    Route::post('/create', [ProductController::class, 'create']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::post('/delete', [ProductController::class, 'delete']);
    Route::post('/detail', [ProductController::class, 'find']);
    
    Route::post('/list', [ProductController::class, 'list']);
    Route::post('/search', [ProductController::class, 'search']);
    Route::post('/test', [ProductController::class, 'test']);

});
Route::prefix('/type')->group(function () {
    Route::post('/detail', [TypeController::class, 'find']);
    Route::get('/list', [TypeController::class, 'list']);
});
Route::prefix('/sub-type')->group(function () {
    Route::post('/list', [SubTypeController::class, 'listByTypeId']);
});
Route::prefix('/image')->group(function () {
    Route::post('/upload', [ImageController::class, 'upload']);
});
