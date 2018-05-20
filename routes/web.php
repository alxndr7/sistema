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
Route::get('/holamundo', function () {
    return view('hola');
});
Route::get('/productos', function () {
    return view('productos/productos');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuarios', 'Usuarios\UsuariosController@index');
Route::get('/trabajadores', 'Trabajadores\TrabajadoresController@index');
Route::get('/home5', 'HomeController@funcion_home');
Route::post('/form_guardar_trabajador','Trabajadores\TrabajadoresController@guardar_trabajador');
Route::post('/form_actualizar_trabajador','Trabajadores\TrabajadoresController@actualizar_trabajador');
Route::post('/form_actualizar_estado','Trabajadores\TrabajadoresController@actualizar_estado_trabajador');
Route::get('/get_trabajador_por_id','Trabajadores\TrabajadoresController@get_trabajador_por_id');



/* --------- ROUTES DECO -------- */
Route::get('/decodificadores','Decos\DecosController@index');
Route::post('/form_guardar_deco','Decos\DecosController@guardar_deco');
Route::get('/get_deco_por_id','Decos\DecosController@deco_por_id');
Route::post('/form_actualizar_deco','Decos\DecosController@actualizar_deco');
Route::post('/form_eliminar_deco','Decos\DecosController@eliminar_deco');

/* --------- ROUTES MATERIALES-------- */
Route::get('/materiales','Materiales\MaterialesController@index');
Route::post('/form_guardar_material','Materiales\MaterialesController@guarda_material');
Route::get('/get_material_por_id','Materiales\MaterialesController@material_por_id');
Route::post('/form_actualizar_material','Materiales\MaterialesController@actualizar_material');
Route::post('/form_eliminar_material','Materiales\MaterialesController@eliminar_material');

/* --------- ROUTES ALMACEN-------- */

Route::get('/almacen','Almacen\AlmacenController@index');
Route::post('/form_guardar_io','Almacen\AlmacenController@guardar_io');

/* --------- ROUTES CONTROL DIARIO-------- */
Route::get('/control_diario','ControlDiario\ControlDiarioController@index');
Route::post('/form_guardar_asignacion','ControlDiario\ControlDiarioController@form_guardar_asignacion');
Route::get('/get_modal_decos','ControlDiario\ControlDiarioController@get_modal_decos');
Route::get('/get_modal_materiales','ControlDiario\ControlDiarioController@get_modal_materiales');
Route::get('/get_modal_validar','ControlDiario\ControlDiarioController@get_modal_validar');
Route::post('/form_validar_asignacion','ControlDiario\ControlDiarioController@form_validar_asignacion');
Route::get('/get_deco_x_serie','ControlDiario\ControlDiarioController@get_deco_x_serie');

/* --------- ROUTES COMISIONES-------- */
Route::get('/comision','Comisiones\ComisionesController@index');
Route::get('/get_comision_por_id','Comisiones\ComisionesController@get_comision_por_id');
Route::post('/form_actualizar_comision','Comisiones\ComisionesController@form_actualizar_comision');

/* --------- ROUTES REPORTES-------- */
Route::get('/reportes','Reportes\ReportesController@index');
Route::get('/get_comision_por_fecha','Reportes\ReportesController@get_comision_por_fecha');


/* --------- ROUTES HISTORIAL-------- */
Route::get('/historial','HistorialAsignacion\HistorialAsignacionController@index');