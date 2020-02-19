<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/clientes', 'ClienteController')->middleware('cors');
Route::apiResource('/veiculos', 'VeiculoController')->middleware('cors');
Route::apiResource('/vendedores', 'VendedorController')->middleware('cors');
Route::apiResource('/vendas', 'VendaController')->middleware('cors');
Route::get('/veiculosAll','VeiculoController@indexAll')->middleware('cors');
