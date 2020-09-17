<?php

use App\Exports\CustomersExport;
use App\Exports\ExpensesExport;
use App\Exports\incomesExport;
use App\Exports\ProposalsExport;
use App\Exports\SalesExport;
use App\Exports\TasksExport;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//rutas especificas
//clientes
Route::get('/cliente', 'customerController@index')->name('cliente');
Route::get('/cliente/{id}', 'customerController@show')->name('cliente.detalle');
Route::post('/cliente/crear', 'customerController@store')->name('cliente.crear');
Route::post('/cliente/actualizar', 'customerController@update')->name('cliente.actualizar');

Route::get('/cliente-a-clientes', 'customerController@follow')->name('cliente-a-clientes');

//propuestas
Route::get('/propuesta', 'proposalController@index')->name('propuesta');
Route::get('/propuestas', 'proposalController@indexproposal')->name('propuestas');
Route::get('/propuesta/{id}', 'proposalController@show')->name('propuesta.detalle');
Route::post('/propuesta/crear', 'proposalController@store')->name('propuesta.crear');
Route::post('/propuesta/actualizar/{id}', 'proposalController@update')->name('propuesta.actualizar');

Route::post('/accion/propuesta/crear', 'actionProposalController@store')->name('accion.crear');
Route::post('/accion/propuesta/actualizar/{id}', 'actionProposalController@update')->name('accion.actualizar');
Route::get('/accion/propuesta/eliminar/{id}', 'actionProposalController@destroy')->name('accion.eliminar');

//tareas
Route::get('/tarea', 'taskController@index')->name('tarea');
Route::get('/tareas', 'taskController@indextask')->name('tareas');
Route::get('/tarea/{id}', 'taskController@show')->name('tarea.detalle');
Route::post('/tarea/crear', 'taskController@store')->name('tarea.crear');
Route::post('/tarea/actualizar/{id}', 'taskController@update')->name('tarea.actualizar');

Route::post('/accion/tarea/crear', 'actionTaskController@store')->name('acciontask.crear');
Route::post('/accion/tarea/actualizar/{id}', 'actionTaskController@update')->name('acciontask.actualizar');
Route::get('/accion/tarea/eliminar/{id}', 'actionTaskController@destroy')->name('acciontask.eliminar');

//egresos
Route::get('/egreso', 'expenseController@index')->name('egreso');
Route::get('/egresos', 'expenseController@indexexpenses')->name('egresos');
Route::get('/egreso/{id}', 'expenseController@show')->name('egreso.detalle');
Route::post('/egreso/crear', 'expenseController@store')->name('egreso.crear');
Route::post('/egreso/actualizar/{id}', 'expenseController@update')->name('egreso.actualizar');

Route::post('/egresos/categoria/crear', 'typeofexpenseController@store')->name('categotia.crear');

//ventas
Route::get('/venta', 'saleController@index')->name('venta');
Route::get('/ventas', 'saleController@indexsales')->name('ventas');
Route::get('/venta/{id}', 'saleController@show')->name('venta.detalle');
Route::post('/venta/crear', 'saleController@store')->name('venta.crear');
Route::post('/venta/actualizar/{id}', 'saleController@update')->name('venta.actualizar');

//cartera
Route::get('/cartera', 'walletController@index')->name('cartera');
Route::get('/cartera/actualizar/{id}', 'walletController@update')->name('cartera.actualizar');

Route::get('/cobros-y-pagos', 'walletController@collectionandpayment')->name('cobros-y-pagos');

//ingresos
Route::get('/ingreso', 'incomeController@index')->name('ingreso');
Route::get('/ingresos', 'incomeController@indexIncomes')->name('ingresos');
Route::post('/ingreso/crear', 'incomeController@store')->name('ingreso.crear');
//imagenes
Route::get('/loadimage/{filename}', 'imageController@getImage')->name('loadimage');
Route::post('/upload', 'imageController@upload');

Route::get('/cuenta', 'mycountController@index')->name('cuenta');
Route::post('/user/update', 'userController@update')->name('user.update');

//payu
Route::get('/response', 'payuController@response')->name('response');
Route::post('/confirmation', 'payuController@confirmation')->name('confirmation');

//reportes
Route::get('/reporte', 'reportController@index')->name('reporte');


//exports a excel
Route::get('/download/clientes', function(){
    return (new CustomersExport)->download('clientes.xlsx');
});

Route::get('/download/propuestas', function(){
    return (new ProposalsExport)->download('propuestas.xlsx');
});

Route::get('/download/tareas', function(){
    return (new TasksExport)->download('tareas.xlsx');
});

Route::get('/download/ventas', function(){
    return (new SalesExport)->download('ventas.xlsx');
});

Route::get('/download/egresos', function(){
    return (new ExpensesExport)->download('egresos.xlsx');
});

Route::get('/download/ingresos', function(){
    return (new incomesExport)->download('ingresos.xlsx');
});