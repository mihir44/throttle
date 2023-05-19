<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


$rate_limit_route = env('RATE_LIMIT_PER_REQUEST');
Route::middleware(['web', "throttle:{$rate_limit_route},0.0167"])->group(function () {
    Route::get('', [OrganizationController::class, 'hello'] )->name('image.get'); 
});
