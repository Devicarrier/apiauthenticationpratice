<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
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

/**Authentication */
Route::post('/register', [ApiAuthenticationController::class,'register']);
Route::post('/login', [ApiAuthenticationController::class,'login']);
Route::get('/detail', [ApiAuthenticationController::class,'detail'])->middleware('auth:sanctum');
/** Employee  */
Route::get('employees',[EmployeeController::class,'index']);
Route::post('employees-store',[EmployeeController::class,'store']);
Route::get('employees-show/{id}',[EmployeeController::class,'show']);
Route::post('employees-update/{id}',[EmployeeController::class,'update']);
Route::delete('employees-delete/{id}',[EmployeeController::class,'destroy']);

