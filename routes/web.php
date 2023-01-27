<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendaController;

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

Route::get('/', [LoginController::class, 'login']);
Route::post('/usuario/cadastrar', [LoginController::class, 'cadastrar']);
Route::post('/usuario/login', [LoginController::class, 'logar']);
Route::get('/usuario/logout', [LoginController::class, 'deslogar']);

Route::get('/agenda/minha', [AgendaController::class, 'render'])->middleware('usuarioFiltro');
Route::post('/contato/cadastrar', [AgendaController::class, 'novoContato'])->middleware('usuarioFiltro');