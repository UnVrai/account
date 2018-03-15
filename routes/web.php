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


Route::post('print/common', 'OrderPrintController@common');
Route::post('print/debt', 'OrderPrintController@debt');
Route::resource('orders', 'CommonOrderController', ['except' => [
    'show', 'edit', 'update'
]]);
Route::resource('debts', 'DebtOrderController', ['except' => [
    'show', 'edit', 'update'
]]);
Route::get('debts/{id}','DebtOrderController@index');
Route::resource('debtors', 'DebtorController');
Route::resource('expenses', 'ExpenseController', ['except' => [
    'show', 'edit', 'update'
]]);
Route::resource('incomes', 'IncomeController');

Route::get('reports', 'ReportsController');
Route::get('reports/{type}', 'ReportsController');
Route::get('account', 'AccountController');
Route::get('account/{type}', 'AccountController');
Route::get('repay/{id}', 'RepayController@create');
Route::post('repay', 'RepayController@store');
Route::get('setting', 'SettingController@show');
Route::post('setting', 'SettingController@update');

Route::get('/', function () {
    return redirect('orders/create');
});
