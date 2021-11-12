<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArduinoListOfEquipmentController;
use App\Http\Controllers\ArduinoEquipmentRecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/list-of-equipments');
Route::resource('/list-of-equipments', ArduinoListOfEquipmentController::class);
Route::resource('/equipment-records', ArduinoEquipmentRecordController::class);