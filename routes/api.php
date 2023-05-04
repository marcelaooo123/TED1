<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
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


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login',  [RegisterController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout',  [RegisterController::class, 'logout']);


// rotas para Book ✔
Route::middleware('auth:sanctum')->get('/books', [BookController::class, 'index']);
Route::middleware('auth:sanctum')->get('/books/{id}', [BookController::class, 'show']);
Route::middleware('auth:sanctum')->post('/books', [BookController::class, 'store']);
Route::middleware('auth:sanctum')->put('/books/{id}', [BookController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/books/{id}', [BookController::class, 'destroy']);

// rotas para User ✔
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/users/{id}',  [UserController::class, 'show']);
Route::middleware('auth:sanctum')->put('/users/{id}',  [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/users/{id}',  [UserController::class, 'destroy']);

// emprestimo
Route::middleware('auth:sanctum')->get('/loans', [LoanController::class, 'index']);
Route::middleware('auth:sanctum')->get('/loans/{id}',  [LoanController::class, 'show']);
Route::middleware('auth:sanctum')->post('/loans',  [LoanController::class, 'store']);
Route::middleware('auth:sanctum')->put('/loans/{id}',  [LoanController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/loans/{id}',  [LoanController::class, 'destroy']);

// rotas para Copy
Route::middleware('auth:sanctum')->get('/copies', [CopyController::class, 'index']);
Route::middleware('auth:sanctum')->get('/copies/{id}', [CopyController::class, 'show']);
Route::middleware('auth:sanctum')->post('/copies', [CopyController::class, 'store']);
Route::middleware('auth:sanctum')->put('/copies/{id}', [CopyController::class, 'update']);
Route::middleware('auth:sanctum')->put('/emprestimo/{id}', [CopyController::class, 'emprestimo']);
Route::middleware('auth:sanctum')->delete('/copies/{id}', [CopyController::class, 'destroy']);
