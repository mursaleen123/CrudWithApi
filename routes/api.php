<?php

use App\Http\Controllers\EmployeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('index',[EmployeController::class,'index'])->name('crud.index');
Route::get('index',[EmployeController::class,'index']);
Route::post('create/',[EmployeController::class,'create'])->name('crud.create');
Route::get('delete/{id}',[EmployeController::class,'destroy'])->name('crud.delete');
