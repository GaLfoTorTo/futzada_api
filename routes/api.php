<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//CONTROLLERS
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GameController;

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

//CRIAR USUÁRIO
Route::post('/user/create', [UserController::class, 'create'])->name('create');
//ROTA DE LOGIN
Route::post('/login', [AuthController::class, 'login'])->name('login');

//ROTAS AUTENTICADAS (TOKEN JWT)
Route::middleware('auth:api')->group(function () {
    Route::get('/home', [HomeController::class, 'home']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // EVENTO
    Route::prefix('events')->group(function () {
        // SALA (STREAM)
        Route::prefix('/room')->group(function () {
            Route::post('stream',[RoomController::class, 'stream']);
            Route::post('join',  [RoomController::class, 'join']);
            Route::post('exit',  [RoomController::class, 'exit']);
        });
    });

    // PARTIDAS
    Route::prefix('games/{game}')->group(function () {
        Route::post('start', [GameController::class, 'start']);
        Route::post('pause', [GameController::class, 'pause']);
        Route::post('finish',[GameController::class, 'finish']);
    });
});