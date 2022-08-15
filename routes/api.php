<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleSalesController;
use App\Models\Car;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login',[AuthController::class, 'login']);
    Route::group(['middleware' => ['jwt']], function () {

        Route::group(['prefix' => 'vehicle'], function () {
            Route::get('',[VehicleController::class, 'index']);
            Route::get('{id}',[VehicleController::class, 'detail']);
        });

        Route::group(['prefix' => 'sales'], function () {
            Route::get('',[VehicleSalesController::class, 'index']);
            Route::get('{vehicleId}',[VehicleSalesController::class, 'listSaleByVehicle']);
            Route::post('',[VehicleSalesController::class, 'store']);
        });

    });
});
