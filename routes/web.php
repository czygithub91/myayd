<?php

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

Route::get('/test-success-response', [\App\Http\Controllers\TestController::class, 'testSuccessResponse']);
Route::get('/test-exception-response', [\App\Http\Controllers\TestController::class, 'testExceptionResponse']);


Route::get('/return-request-content', [\App\Http\Controllers\TestController::class, 'returnRequestContent']);
Route::get('/return-expected-error', [\App\Http\Controllers\TestController::class, 'returnExpectedError']);
Route::get('/return-unexpected-error', [\App\Http\Controllers\TestController::class, 'returnUnexpectedError']);

Route::get('/check-valid-string', [\App\Http\Controllers\TestController::class, 'checkValidString']);
