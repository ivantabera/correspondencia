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

Route::get('/', function () {
    return view('auth.login');
});

/**Muestra la vista directamente desde la ruta*/
/*
Route::get('/correspondencia', function () {
    return view('correspondencia.index');
});
Route::get('/correspondencia/crear', function () {
    return view('correspondencia.crear');
});
*/

 /**Generar la ruta para acceder al controlador y muestre la vista*/
/*
Route::get('/correspondencia', 'CapturaCorrespondenciaController@index'); 
Route::get('/correspondencia/create', 'CapturaCorrespondenciaController@create');
*/

/** Genera la rutas necesarias para acceder al controlador */
/** le agregamos la funcion middleware para inpedir que el usuario pase si no esta logueado */
Route::resource('correspondencia', 'CapturaCorrespondenciaController')->middleware('auth');

Route::resource('promoremit', 'PromoremitController')->middleware('auth');

Route::resource('destinatario', 'DestinatarioController')->middleware('auth');

Route::resource('expedientes', 'ExpedienteController')->middleware('auth');

/*
modificar la ruta para evitar el registro y el reset del password
Auth::routes(['register'=>false, 'reset'=>false]);
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
