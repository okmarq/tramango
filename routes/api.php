<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\UserController;
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

Route::apiResource('flights',FlightController::class);
Route::apiResource('hotels', HotelController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('statuses', StatusController::class);
Route::apiResource('tours', TourController::class);
Route::apiResource('users', UserController::class);

Route::group(['middleware'=> ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
