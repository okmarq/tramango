<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::apiResource('hotels', HotelController::class);
Route::apiResource('flights',FlightController::class);
Route::apiResource('statuses', StatusController::class);
Route::apiResource('roles', RoleController::class);

Route::group(['middleware'=> ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
