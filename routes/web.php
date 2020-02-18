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
Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');
Route::post('patients/search', 'SearchPatientController@search')->name('patients.search');
Route::post('services/search', 'SearchProductController@searchService')->name('services.search');
Route::post('services/find', 'SearchProductController@findService')->name('services.find');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('insurers', 'InsurerController');
    Route::resource('services', 'ServiceController');
    Route::resource('discounts', 'DiscountController');
    Route::resource('beneficiaries', 'BeneficiaryController');
    Route::resource('insurees', 'InsureeController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('item_categories', 'ItemCategoryController');
    Route::resource('items', 'ItemController');
    Route::resource('calls', 'CallController');
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::post('insurees', ['as' => 'persondata.storeinsuree', 'uses' => 'PersonDataController@storeInsuree']);
    Route::post('beneficiaries', ['as' => 'persondata.storebeneficiary', 'uses' => 'PersonDataController@storeBeneficiary']);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
