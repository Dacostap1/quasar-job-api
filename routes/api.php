<?php

use App\Http\Controllers\Api\ApplyController;
use App\Http\Controllers\Api\JobController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/jobs', [JobController::class, 'index']);
  Route::post('/jobs', [JobController::class, 'store']);

  Route::get('/apply', [ApplyController::class, 'index']);
  Route::post('/apply', [ApplyController::class, 'store']);
});
