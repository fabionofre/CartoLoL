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

Route::resources([
	'campeonatos' => 'CampeonatoController',
	'usuarios' => 'UserController',
	'equipes' => 'EquipeController',
	'atletas' => 'AtletaController',
    'funcoes' => 'FuncaoController',
    'acoes' => 'AcaoController',
    'regras-pontuacao' => 'RegraPontuacaoController',
    'escalacoes' => 'EscalacaoController',
    'pontuacoes' => 'PontuacaoController',
    'ligas' => 'LigaController',
    'participantes-liga' => 'ParticipanteLigaController'
]);

Route::get('minha-pontuacao/{id}', 'PontuacaoController@minhaPontuacao');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [
        'uses' => 'AuthController@login',
        'as' => 'login'
    ]);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', [
        'uses' => 'AuthController@register',
        'as' => 'register'
    ]);
    
});