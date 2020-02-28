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
    return view('welcome');
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

 /**Generar la ruta para acceder al controlador y a su metodo*/
/*
Route::get('/correspondencia', 'CapturaCorrespondenciaController@index'); 
Route::get('/correspondencia/create', 'CapturaCorrespondenciaController@create');
*/

/** Genera la rutas necesarias para acceder al controlador */

/*
modificar la ruta para evitar el registro y el reset del password
Auth::routes(['register'=>false, 'reset'=>false]);
*/

//Ruta para las API
Route::apiResource('pensamientos', 'PensamientoController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function(){

    /** le agregamos la funcion middleware para impedir que el usuario pase si no esta logueado */

    //correspondencia
    Route::post('correspondencia/store', 'CapturaCorrespondenciaController@store')->name('correspondencia.store')
            ->middleware('can:correspondencia.create');

    Route::get('correspondencia', 'CapturaCorrespondenciaController@index')->name('correspondencia.index')
            ->middleware('can:correspondencia.index');

    Route::get('correspondencia/create', 'CapturaCorrespondenciaController@create')->name('correspondencia.create')
            ->middleware('can:correspondencia.create');

    Route::put('correspondencia/{id}', 'CapturaCorrespondenciaController@update')->name('correspondencia.update')
            ->middleware('can:correspondencia.edit');

    Route::get('correspondencia/{id}', 'CapturaCorrespondenciaController@show')->name('correspondencia.show')
            ->middleware('can:correspondencia.show');

    Route::delete('correspondencia/{id}', 'CapturaCorrespondenciaController@destroy')->name('correspondencia.destroy')
            ->middleware('can:correspondencia.destroy');

    Route::get('correspondencia/{id}/edit', 'CapturaCorrespondenciaController@edit')->name('correspondencia.edit')
            ->middleware('can:correspondencia.edit');

    //Generar PDF
    Route::get('imprimir/{id}', 'CapturaCorrespondenciaController@exportpdf')->name('correspondencia.pdf')
            ->middleware('can:correspondencia.pdf');

    Route::put('correspondencia/status/{id}', 'CapturaCorrespondenciaController@status')->name('correspondencia.status')
            ->middleware('can:correspondencia.status');
    
    
    //Promotores y remitentes
    Route::post('promoremit/store', 'PromoremitController@store')->name('promoremit.store')
            ->middleware('can:promoremit.create');

    Route::get('promoremit', 'PromoremitController@index')->name('promoremit.index')
            ->middleware('can:promoremit.index');

    Route::get('promoremit/create', 'PromoremitController@create')->name('promoremit.create')
            ->middleware('can:promoremit.create');

    Route::put('promoremit/{id}', 'PromoremitController@update')->name('promoremit.update')
            ->middleware('can:promoremit.edit');

    Route::get('promoremit/{id}', 'PromoremitController@show')->name('promoremit.show')
            ->middleware('can:promoremit.show');

    Route::delete('promoremit/{id}', 'PromoremitController@destroy')->name('promoremit.destroy')
            ->middleware('can:promoremit.destroy');

    Route::get('promoremit/{id}/edit', 'PromoremitController@edit')->name('promoremit.edit')
            ->middleware('can:promoremit.edit');
    //Peticion ajax para autorrelleno de formulario correspondencia
    Route::post('promoremit/{id}','PromoremitController@getajax')->name('promoremit.getajax');


    //Destinatario
    Route::post('destinatario/store', 'DestinatarioController@store')->name('destinatario.store')
            ->middleware('can:destinatario.create');

    Route::get('destinatario', 'DestinatarioController@index')->name('destinatario.index')
            ->middleware('can:destinatario.index');

    Route::get('destinatario/create', 'DestinatarioController@create')->name('destinatario.create')
            ->middleware('can:destinatario.create');

    Route::put('destinatario/{id}', 'DestinatarioController@update')->name('destinatario.update')
            ->middleware('can:destinatario.edit');

    Route::get('destinatario/{id}', 'DestinatarioController@show')->name('destinatario.show')
            ->middleware('can:destinatario.show');

    Route::delete('destinatario/{id}', 'DestinatarioController@destroy')->name('destinatario.destroy')
            ->middleware('can:destinatario.destroy');

    Route::get('destinatario/{id}/edit', 'DestinatarioController@edit')->name('destinatario.edit')
            ->middleware('can:destinatario.edit');


    //Expedientes
    Route::post('expedientes/store', 'ExpedienteController@store')->name('expedientes.store')
            ->middleware('can:expedientes.create');

    Route::get('expedientes', 'ExpedienteController@index')->name('expedientes.index')
            ->middleware('can:expedientes.index');

    Route::get('expedientes/create', 'ExpedienteController@create')->name('expedientes.create')
            ->middleware('can:expedientes.create');

    Route::put('expedientes/{id}', 'ExpedienteController@update')->name('expedientes.update')
            ->middleware('can:expedientes.edit');

    Route::get('expedientes/{id}', 'ExpedienteController@show')->name('expedientes.show')
            ->middleware('can:expedientes.show');

    Route::delete('expedientes/{id}', 'ExpedienteController@destroy')->name('expedientes.destroy')
            ->middleware('can:expedientes.destroy');

    Route::get('expedientes/{id}/edit', 'ExpedienteController@edit')->name('expedientes.edit')
            ->middleware('can:expedientes.edit');


    //Dirigido
    Route::post('dirigido/store', 'DirigidoController@store')->name('dirigido.store')
            ->middleware('can:dirigido.create');

    Route::get('dirigido', 'DirigidoController@index')->name('dirigido.index')
            ->middleware('can:dirigido.index');

    Route::get('dirigido/create', 'DirigidoController@create')->name('dirigido.create')
            ->middleware('can:dirigido.create');

    Route::put('dirigido/{id}', 'DirigidoController@update')->name('dirigido.update')
            ->middleware('can:dirigido.edit');

    Route::get('dirigido/{id}', 'DirigidoController@show')->name('dirigido.show')
            ->middleware('can:dirigido.show');

    Route::delete('dirigido/{id}', 'DirigidoController@destroy')->name('dirigido.destroy')
            ->middleware('can:dirigido.destroy');

    Route::get('dirigido/{id}/edit', 'DirigidoController@edit')->name('dirigido.edit')
            ->middleware('can:dirigido.edit');


    //tipo documentos
    Route::post('tipodocumento/store', 'TipodocController@store')->name('tipodocumento.store')
            ->middleware('can:tipodocumento.create');

    Route::get('tipodocumento', 'TipodocController@index')->name('tipodocumento.index')
            ->middleware('can:tipodocumento.index');

    Route::get('tipodocumento/create', 'TipodocController@create')->name('tipodocumento.create')
            ->middleware('can:tipodocumento.create');

    Route::put('tipodocumento/{id}', 'TipodocController@update')->name('tipodocumento.update')
            ->middleware('can:tipodocumento.edit');

    Route::get('tipodocumento/{id}', 'TipodocController@show')->name('tipodocumento.show')
            ->middleware('can:tipodocumento.show');

    Route::delete('tipodocumento/{id}', 'TipodocController@destroy')->name('tipodocumento.destroy')
            ->middleware('can:tipodocumento.destroy');

    Route::get('tipodocumento/{id}/edit', 'TipodocController@edit')->name('tipodocumento.edit')
            ->middleware('can:tipodocumento.edit');

    //usuarios
    Route::get('users', 'UserController@index')->name('users.index')
            ->middleware('can:users.index');

    Route::put('users/{id}', 'UserController@update')->name('users.update')
            ->middleware('can:users.update');

    Route::get('users/{id}', 'UserController@show')->name('users.show')
            ->middleware('can:users.show');

    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy')
            ->middleware('can:users.destroy');

    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit')
            ->middleware('can:users.edit');

    //Roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
     ->middleware('can:roles.create');

    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('can:roles.index');

    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('can:roles.create');

    Route::put('roles/{id}', 'RoleController@update')->name('roles.update')
        ->middleware('can:roles.edit');

    Route::get('roles/{id}', 'RoleController@show')->name('roles.show')
        ->middleware('can:roles.show');

    Route::delete('roles/{id}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('can:roles.destroy');

    Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('can:roles.edit');

});