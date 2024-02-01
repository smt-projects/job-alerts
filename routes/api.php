<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailLogsController;

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

Route::post('deliveries', [EmailLogsController::class, 'getdeliveries'])->name('deliveries');
Route::post('nodeliveries', [EmailLogsController::class, 'getNotdelivered'])->name('nodeliveries');

Route::post('postmarkdeliveries', [EmailLogsController::class, 'getpostmarkdeliveries'])->name('postmarkdeliveries');
Route::post('postmarknodeliveries', [EmailLogsController::class, 'getpostmarkNotdelivered'])->name('postmarknodeliveries');

Route::get('getversion', [EmailLogsController::class, 'getversion'])->name('getversion');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
