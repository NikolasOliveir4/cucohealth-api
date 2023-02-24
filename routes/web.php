<?php

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



Route::prefix('clientes')->group(function () {
    Route::get('','ClienteController@listAll');
    Route::post('','ClienteController@create');
    Route::put('/{id}','ClienteController@update');
    Route::put('delete/{id}','ClienteController@delete');
    Route::get('search','ClienteController@search');
    Route::get('cpfcnpj','ClienteController@searchCpfCnpj');
    });
