<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CandidatoController;

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

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [CandidatoController::class, 'cadastro']);
Route::get('/lista', [CandidatoController::class, 'lista']);
Route::get('/candidato/{id}', [CandidatoController::class, 'candidato']);
Route::post('/atualizar/{id}', [CandidatoController::class, 'atualizar']);
Route::delete('/deletar/{id}', [CandidatoController::class, 'deletar']);