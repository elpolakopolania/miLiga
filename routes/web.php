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

Auth::routes();

Route::middleware(['auth'])->group(function() {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource('perfil', 'PerfilController', ['only' => [
    'edit', 'update', 'index'
  ]]);
  Route::get('homologar/descargar/{id}/{firmado}/{tipo?}','HomologarController@descargar');
  Route::get('homologar/crear/{id}', 'HomologarController@crear');
  Route::get('homologar/solicitudes', 'HomologarController@solicitudes');
  Route::get('homologar/listar_asignaturas', 'HomologarController@listar_asignaturas');
  Route::resource('homologar', 'HomologarController');
  Route::get('solicitud/listar_solicitudes', 'SolicitudController@listar_solicitudes');
  Route::resource('solicitud', 'SolicitudController');
  Route::post('adenda/homologar','AdendaController@homologar');
  Route::post('adenda/cargar_firma','AdendaController@cargar_firma');
  Route::resource('adenda', 'AdendaController');
});
