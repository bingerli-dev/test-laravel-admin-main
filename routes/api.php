<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthCheckController;

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

Route::get('/health-check', [HealthCheckController::class, 'check']);
Route::get('/health-check/log', [HealthCheckController::class, 'checkLog']);
Route::get('/health-check/main', [HealthCheckController::class, 'checkMain']);
Route::get('/health-check/cloudwatch', [HealthCheckController::class, 'checkCloudWatch']);