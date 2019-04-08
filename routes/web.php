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


Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastrar']);


Route::get('/login', ['uses' => 'Controller@fazerLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);


Route::get('user/movement', ['as' => 'movement.index', 'uses' => 'MovementsController@index']);
Route::get('movement', ['as' => 'movement.application', 'uses' => 'MovementsController@application']);
Route::post('movement', ['as' => 'movement.application.store', 'uses' => 'MovementsController@storeApplication']);
Route::get('movement/all', ['as' => 'movement.all', 'uses' => 'MovementsController@all']);

Route::resource('user', 'UsersController');
Route::resource('instituicao', 'InstituicaosController');
Route::resource('group', 'GroupsController');
Route::resource('instituicao.product', 'ProductsController');

Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);

