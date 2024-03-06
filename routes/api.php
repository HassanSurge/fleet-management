<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VehicleController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('vehicles', VehicleController::class);
});

Route::apiResource('categories', CategoryController::class);

Route::get('/test', function () {
  $payload = [
    'iss' => env('APP_URL'),
    'aud' => 'Simplebooks',
    'sub' => 'my_user_id',
    'exp' => Carbon::now()->addMinutes(2)->unix(),
    'iat' => Carbon::now()->unix(),
    'type' => 'Bearer',
    'jti' => 'Store in DB, unique ID for the token',
  ];

  return response()->json([
    'key' => JWT::encode($payload, env('APP_KEY'), 'HS256'),
  ]);
});

Route::get('/verify/{key}', function (string $key) {
  $response = JWT::decode($key, new Key(env('APP_KEY'), 'HS256'));

  return response()->json([
    'data' => $response
  ]);
});
