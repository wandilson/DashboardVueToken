<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function(){


    /**
     * Rotas de Configurações
     */
    Route::prefix('config')->group(function() {

        // Retorna dados do usuário logado e gerencia tokens
        Route::get('loadUser', 'Api\Common\TokenCtrl@userAuth');
        Route::get('tokens', 'Api\Common\TokenCtrl@listTokens');
        Route::delete('tokens/{id}', 'Api\Common\TokenCtrl@remove');


        // Gerenciar Users
        Route::get('users', 'Api\Common\UserCtrl@list');
        Route::post('users', 'Api\Common\UserCtrl@create');
        Route::put('users', 'Api\Common\UserCtrl@update');
        Route::delete('users/{id}', 'Api\Common\UserCtrl@delete');
        Route::post('users/disable', 'Api\Common\UserCtrl@disable');

        Route::get('uf', 'Api\Common\UserCtrl@uf');
        Route::get('city/{id}', 'Api\Common\UserCtrl@city');


        // Logout
        Route::post('logout', 'Api\Common\LoginCtrl@logout');

    });


    /**
     * Rotas Para gerenciar Banco
     */
    Route::prefix('app')->group(function() {
        Route::get('bank', 'Api\App\BankCtrl@list');
        Route::post('bank', 'Api\App\BankCtrl@create');
        Route::put('bank', 'Api\App\BankCtrl@update');
        Route::delete('bank/{id}', 'Api\App\BankCtrl@delete');

        Route::get('category', 'Api\App\CategoryCtrl@list');
        Route::post('category', 'Api\App\CategoryCtrl@create');
        Route::put('category', 'Api\App\CategoryCtrl@update');
        Route::delete('category/{id}', 'Api\App\CategoryCtrl@delete');

        Route::get('cost-center', 'Api\App\CostCenterCtrl@list');
        Route::post('cost-center', 'Api\App\CostCenterCtrl@create');
        Route::put('cost-center', 'Api\App\CostCenterCtrl@update');
        Route::delete('cost-center/{id}', 'Api\App\CostCenterCtrl@delete');


    });

});




/**
 * Ao termino do registro, autentica o usuário
 */
Route::post('/register', 'Api\Common\RegisterCtrl@register');


/**
 * Autenticação/Redefine
 */
Route::get('login', 'Api\Common\LoginCtrl@index')->name('login');;
Route::post('login', 'Api\Common\LoginCtrl@login');
Route::post('redefine-password', 'Api\Common\RedefinePassCtrl@redefine');