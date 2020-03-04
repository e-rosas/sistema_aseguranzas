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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('insurers', 'InsurerController');
    Route::resource('services', 'ServiceController');
    Route::resource('discounts', 'DiscountController');
    Route::resource('beneficiaries', 'BeneficiaryController');
    Route::resource('insurees', 'InsureeController');
    Route::resource('invoices', 'InvoiceController', ['except' => ['update']]);
    Route::resource('categories', 'CategoryController');
    Route::resource('items', 'ItemController');
    Route::resource('calls', 'CallController');
    Route::resource('payments', 'PaymentController');

    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::post('insurees', ['as' => 'persondata.storeinsuree', 'uses' => 'PersonDataController@storeInsuree']);
    Route::post('beneficiaries', ['as' => 'persondata.storebeneficiary', 'uses' => 'PersonDataController@storeBeneficiary']);
    Route::patch('person_data', ['as' => 'persondata.update', 'uses' => 'PersonDataController@update']);
    Route::patch('invoices_updateperson', ['as' => 'invoice.updateperson', 'uses' => 'InvoiceController@updatePersonData']);
    Route::patch('invoices_update', ['as' => 'invoice.update', 'uses' => 'InvoiceController@update']);
    Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');
    Route::post('patients/search', 'SearchPatientController@search')->name('patients.search');
    Route::post('services/search', 'SearchProductController@searchService')->name('services.search');
    Route::post('services/find', 'SearchProductController@findService')->name('services.find');

    Route::post('invoice_services', 'InvoiceServiceController@getInvoiceServices')->name('invoiceservices.get');

    Route::post('invoices/search', 'InvoiceController@search')->name('invoices.search');
    Route::post('beneficiaries/search', 'SearchPatientController@searchBeneficiary')->name('beneficiaries.search');
    Route::post('beneficiaries/find', 'SearchPatientController@findBeneficiary')->name('beneficiaries.find');
    Route::post('insurees/find', 'SearchPatientController@findInsuree')->name('insurees.find');
    Route::post('insurees/searchIndex', 'SearchPatientController@searchInsureeIndex')->name('insurees.searchIndex');
    Route::post('services/searchIndex', 'SearchProductController@searchServiceIndex')->name('services.searchIndex');

    Route::post('discounts/get', 'DiscountsInvoiceController@discounts')->name('discounts.get');
    Route::post('invoices/adddiscounts', 'DiscountsInvoiceController@addAppliedDiscounts')->name('invoices.discounts');

    Route::post('items/search', 'SearchProductController@searchItem')->name('items.search');
    Route::post('items/find', 'SearchProductController@findItem')->name('items.find');

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
