<?php

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

//Route::get('email','EmailController@index');

Route::get('/', function () {
    return redirect('login');
});

Route::get('correo', 'CorreoController@index');
Route::get('borrar', 'CorreoController@borrar');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('mis_ligas', 'LigaController@mis_ligas');
    Route::get('grupos_liga/{id}', 'GrupoController@grupos_liga');
    Route::get('equipo_liga/{id}', 'EquipoController@equipo_liga');
    Route::get('ligas', 'LigaController@listar_ligas');
    Route::get('grupos', 'GrupoController@listar');
    Route::get('equipos', 'EquipoController@listar');
    Route::get('delegados', 'DelegadoController@listar');
    Route::get('jugadores', 'JugadorController@listar');
    Route::get('delegadoNumDoc/{numDoc}', 'DelegadoController@showNumdoc');
    Route::get('jugadorNumDoc/{numDoc}', 'JugadorController@showNumdoc');
    Route::get('rondas/{liga_id}', 'PartidoController@listar_rondas');
    Route::get('combinarFechas/{liga_id}/{idaVuelta?}', 'PartidoController@combinar');
    Route::resource('/liga', 'LigaController');
    Route::resource('/grupo', 'GrupoController');
    Route::resource('/equipo', 'EquipoController');
    Route::resource('/delegado', 'DelegadoController');
    Route::resource('/jugador', 'JugadorController');
    Route::resource('/partido', 'PartidoController');
    Route::resource('/cronologia', 'CronologiaController');
});
