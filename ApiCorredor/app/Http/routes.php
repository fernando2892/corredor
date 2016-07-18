<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
	return view('welcome');
});
Route::post('validaLogin', 'usuarioController@validaLogin');
Route::post('insertarModificarTomador', 'usuarioController@insertarModificarTomador');
Route::post('consultarSesion', 'usuarioController@validarSesion');
Route::post('consultarCliente', 'usuarioController@consultarCliente');
Route::post('consultarClienteDatos', 'usuarioController@consultarClienteDatos');
Route::post('consultaPoliza1', 'PolizaController@consultarPoliza');
Route::post('insertarPoliza1', 'PolizaController@insertarPoliza');
Route::post('renovarPoliza', 'PolizaController@renovarPoliza');
Route::post('modificarPoliza1', 'PolizaController@modificarPoliza');
Route::post('comboEmpresa', 'EmpresaController@comboEmpresa');
Route::post('comboRamo', 'RamoController@comboRamo');
Route::post('comboParentesco', 'ParentescoController@comboParentesco');
Route::post('comboFinanciamiento', 'FinanciamientoController@comboFinanciamiento');
Route::post('comboIntermediario', 'usuarioController@comboIntermediario');
Route::post('montoNegocioIntermediario', 'usuarioController@montoNegocioIntermediario');
Route::post('cargarArchivos', 'PolizaController@cargarArchivos');
Route::get('consultaPolizaFiltrosAll', 'PolizaController@consultaPolizaFiltrosAll');
Route::get('consultaDatosReporte', 'PolizaController@consultaDatosReporte');
Route::post('consultaPolizaFiltros', 'PolizaController@consultaPolizaFiltros');
Route::post('consultarClientePoliza', 'usuarioController@consultarClientePoliza');
Route::post('consultarClientesPoliza', 'usuarioController@consultarClientesPoliza');
Route::post('fechaVigencia', 'UtilidadesController@fechaVigencia');
Route::post('modificarFechaBd', 'UtilidadesController@modificarFechaBd');
Route::post('modificarFechaVista', 'UtilidadesController@modificarFechaVista');
Route::post('agregarRecibo', 'PolizaController@agregarRecibo');
Route::post('compararFecha', 'PolizaController@compararFecha');
Route::post('validarSesion', 'usuarioController@validarSesion');
Route::post('cerrarSesion', 'usuarioController@cerrarSesion');
Route::post('consultaPolizaHistorico', 'PolizaController@consultaPolizaHistorico');
Route::post('consultaReciboHistorico', 'PolizaController@consultaReciboHistorico');
Route::get('eliminarClientePoliza', 'ClientePolizaController@eliminarClientePoliza');
Route::post('subirArchivos', 'ClientePolizaController@subirArchivos');
Route::get("test-email", 'EmailController@test');