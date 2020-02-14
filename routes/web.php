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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('insurers', 'InsurerController');
    Route::resource('services', 'ServiceController');
    Route::resource('discounts', 'DiscountController');
    Route::resource('beneficiaries', 'BeneficiaryController');
    Route::resource('insurees', 'InsureeController');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::post('insurees', ['as' => 'persondata.storeinsuree', 'uses' => 'PersonDataController@storeInsuree']);
    Route::post('beneficiaries', ['as' => 'persondata.storebeneficiary', 'uses' => 'PersonDataController@storeBeneficiary']);
    //Route::get('insurees/search', 'InsureeController@search')->name('insurees.search');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
