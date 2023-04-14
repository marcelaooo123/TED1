<?php

use App\Http\Controllers\Auth\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login',  [RegisterController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout',  [RegisterController::class, 'logout']);


// rotas para Book ✔
Route::get('/books', 'App\Http\Controllers\BookController@index');
Route::get('/books/{id}', 'App\Http\Controllers\BookController@show');
Route::post('/books', 'App\Http\Controllers\BookController@store');
Route::put('/books/{id}', 'App\Http\Controllers\BookController@update');
Route::delete('/books/{id}', 'App\Http\Controllers\BookController@destroy');

// rotas para User ✔
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
Route::middleware('auth:sanctum')->put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::middleware('auth:sanctum')->delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');

// emprestimo 
Route::get('/loans', 'App\Http\Controllers\LoanController@index');
Route::get('/loans/{id}', 'App\Http\Controllers\LoanController@show');
Route::post('/loans', 'App\Http\Controllers\LoanController@store');
Route::middleware('auth:sanctum')->put('/loans/{id}', 'App\Http\Controllers\LoanController@update');
Route::middleware('auth:sanctum')->delete('/loans/{id}', 'App\Http\Controllers\LoanController@destroy');

// rotas para Copy
Route::get('/copies', 'App\Http\Controllers\CopyController@index');
Route::get('/copies/{id}', 'App\Http\Controllers\CopyController@show');
Route::post('/copies', 'App\Http\Controllers\CopyController@store');
Route::put('/copies/{id}', 'App\Http\Controllers\CopyController@update');
Route::put('/emprestimo/{id}', 'App\Http\Controllers\CopyController@emprestimo');
Route::delete('/copies/{id}', 'App\Http\Controllers\CopyController@destroy');
