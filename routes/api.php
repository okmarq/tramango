<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelOptionController;
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
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware'=> ['auth:sanctum']], function() {
    Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register.admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResource('bookings',BookingController::class);
    Route::apiResource('flights',FlightController::class);
    Route::apiResource('hotels', HotelController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('tours', TourController::class);
    Route::apiResource('travels', TravelOptionController::class);
    Route::apiResource('users', UserController::class);
});
