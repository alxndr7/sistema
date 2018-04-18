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
