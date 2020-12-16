<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;

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

// rota de login do funcionario
Route::post('funcionarios/login', [FuncionarioController::class, 'login']);
Route::get('produtos/getProdutos', [ProdutoController::class, 'getProdutos']);
Route::get('fornecedor/getFornecedor', [FornecedorController::class, 'getFornecedor']);
Route::resource('funcionarios', FuncionarioController::class);
Route::resource('fornecedor', FornecedorController::class );
Route::resource('produtos', ProdutoController::class );


