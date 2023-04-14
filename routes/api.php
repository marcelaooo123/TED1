<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
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
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

// rotas para User ✔
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}',  [UserController::class, 'show']);
Route::middleware('auth:sanctum')->put('/users/{id}',  [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/users/{id}',  [UserController::class, 'destroy']);

// emprestimo
Route::get('/loans', [LoanController::class, 'index']);
Route::get('/loans/{id}',  [LoanController::class, 'show']);
Route::post('/loans',  [LoanController::class, 'store']);
Route::middleware('auth:sanctum')->put('/loans/{id}',  [LoanController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/loans/{id}',  [LoanController::class, 'destroy']);

// rotas para Copy
Route::get('/copies', [CopyController::class, 'index']);
Route::get('/copies/{id}', [CopyController::class, 'show']);
Route::post('/copies', [CopyController::class, 'store']);
Route::put('/copies/{id}', [CopyController::class, 'uptade']);
Route::put('/emprestimo/{id}', [CopyController::class, 'emprestimo']);
Route::delete('/copies/{id}', [CopyController::class, 'destroy']);
