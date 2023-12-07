<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TimeEntryController;

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

Route::middleware('auth:sanctum')->group( function(){
    Route::apiResource('/chamados', BacklogController::class);
    Route::apiResource('/chamados/tarefas', TaskController::class);
    Route::apiResource('backlogs.tasks', TaskController::class)->only(['store']);

    Route::apiResource('/projetos', SystemController::class);

    Route::get('/user', function (Request $request) {

        return $request->user();
    });

    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/logout', [LogoutController::class, 'logout']);

});


// Route::apiResource('/chamados', BacklogController::class);
// Route::apiResource('/tarefas', TaskController::class);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/teste', [UserController::class, 'teste']);
Route::apiResource('/apontamentos', [TimeEntryController::class]);







