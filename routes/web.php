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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'MyShopp', 'namespace' => 'V1'], function () {
    //Criando ROTA para o controller ProdutoController
    Route::get('produto/lista', 'ProdutoController@index')->name('produto.lista');
    Route::post('produto/store', 'ProdutoController@store')->name('produto.store');
});