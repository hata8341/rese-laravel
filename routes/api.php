<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReserveController;
use App\Models\Reserve;

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

Route::prefix('v1')->group(function () {
    Route::group([
        'middleware' => ['auth:api'],
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
        Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh'])->withoutMiddleware(['auth:api']);
        Route::get('/user', [AuthController::class, 'me']);
    });
});

Route::apiResource('/v1/store', StoreController::class)->only(['index', 'show']);

Route::apiResource('/v1/reserve', ReserveController::class)->only(['store', 'show', 'update', 'destroy']);
Route::get('/v1/reserveDatetime', [ReserveController::class, 'reserveDatetime']);


Route::post('/v1/like', [LikeController::class, 'store']);
Route::delete('/v1/like', [LikeController::class, 'destroy']);
Route::get('/v1/like', [LikeController::class, 'hasLike']);
Route::get('/v1/myLike', [LikeController::class, 'myHasLike']);