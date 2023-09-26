<?php

use App\Http\Controllers\api\InventoryController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {

    //user
route::post('register', [PlayerController::class, 'register'])->name('register');
route::post('login', [PlayerController::class, 'login'])->name('login');

//rfid
route::post('store-plant', [InventoryController::class, 'storePlant'])->name('store-plant');
route::post('redeem', [InventoryController::class, 'redeem'])->name('redeem');

});