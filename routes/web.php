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

Route::group([
    'prefix' => 'loja',
    'middleware'=> 'auth', 
    'namespace' => 'V1',
], function () {
    Route::get('loja/produtos', 'ProdutoController@listaProduto')->name('loja.produtos');
    //Criando ROTA para o controller ProdutoController
    Route::get('produto/lista', 'ProdutoController@index')->name('produto.lista');
    Route::post('produto/store', 'ProdutoController@store')->name('produto.store');

    Route::get('cupom/desconto/listar', 'CupomDescontoController@index')->name('cupom.desconto.listar');
    Route::post('cupom/desconto/store', 'CupomDescontoController@store')->name('cupom.desconto.store');
    
    //Criando as ROTAS para o carrinho de compras
    Route::get('carrinho/listar', 'CarrinhoController@index')->name('carrinho.listar');
    
    Route::get('carrinho/show/{value}', 'CarrinhoController@show')->name('carrinho.show');
    Route::get('carrinho/adicionar/{value}', 'CarrinhoController@adicionar')->name('carrinho.adicionar');

    Route::delete('carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
    Route::post('carrinho/remover/', 'CarrinhoController@remover')->name('carrinho.remover');
});