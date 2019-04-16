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

Route::get('/', function () { return view('home'); });
Route::get('/contacto', function () { return view('contacto'); });
Route::post('/contacto', function () { return view('contacto'); });

Auth::routes();

Route::get('/obtenerCategorias', 'CategoriaController@show');
Route::get('/obtenerPoleras', 'PoleraController@show');
Route::post('/atleta/registrar', 'AtletaController@store');
Route::post('/atleta/registrar/wepay', 'AtletaController@storeWebPay');
Route::post('/venta/registrar', 'VentaController@store');

Route::post('/venta/finalizar', 'VentaController@index');

Route::middleware(['auth'])->group(function () {

    Route::get('/cache', function() {
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        return 'DONE'; //Return anything
    });
    
    Route::get('/admin', 'HomeController@index')->name('intranet');

    //Rutas de categorías
    Route::get('/categorias', 'CategoriaController@index');
    Route::post('/categoria/registrar', 'CategoriaController@store');
    Route::post('/categoria/actualizar', 'CategoriaController@update');
    Route::post('/categoria/eliminar', 'CategoriaController@destroy');
    Route::get('/categoria/seleccionarPolera', 'CategoriaController@seleccionarPolera');

    //Rutas de poleras
    Route::get('/poleras', 'PoleraController@index');
    Route::post('/polera/registrar', 'PoleraController@store');
    Route::post('/polera/actualizar', 'PoleraController@update');
    Route::post('/polera/eliminar', 'PoleraController@destroy');
    Route::get('/polera/seleccionarPolera', 'PoleraController@seleccionarPolera');

    //Rutas de atletas
    Route::get('/atletas', 'AtletaController@index');
    Route::get('/atletasIndividual', 'AtletaController@indexIndividual');
    Route::get('/atletasDuplas', 'AtletaController@indexDuplas');
    Route::get('/atletasTrios', 'AtletaController@indexTrios');
    Route::get('/atletasPendientes', 'AtletaController@indexPendientes');
    Route::get('/atletasInvitados', 'AtletaController@indexInvitados');
    Route::post('/atleta/actualizar', 'AtletaController@update');
    Route::post('/atleta/registrarInvitado', 'AtletaController@registrarInvitado');
    Route::post('/atleta/eliminar', 'AtletaController@destroy');
    Route::get('/atleta/selectAtleta', 'AtletaController@selectAtleta');
    Route::post('/atleta/actualizarInvitado', 'AtletaController@actualizarInvitado');
    

    Route::post('/venta/anular', 'VentaController@anular');
    Route::post('/venta/confirmar', 'VentaController@confirmar');


    //Rutas de ventas
    Route::get('/ventas', 'VentaController@indexVentas');
    Route::post('/venta/eliminarAtleta', 'VentaController@eliminarAtleta');
    Route::post('/venta/eliminarVenta', 'VentaController@eliminarVenta');
});






