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

Route::get('create/common', 'CreateOrderController@common');
Route::get('create/debt', 'CreateOrderController@debt');
Route::post('print/common', 'OrderPrintController@common');
Route::post('print/debt', 'OrderPrintController@debt');
Route::resource('debtors', 'DebtorController');

Route::get('/', function () {
    return redirect('create/common');
});
