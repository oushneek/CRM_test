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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


// Auth Middleware Routes
Route::group(['namespace' => 'App\Http\Controllers','middleware' => ['auth']], function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // Company CRUD Routes

    Route::get('companies', 'CompanyController@index')->name('company.index');
    Route::get('company/create', 'CompanyController@create')->name('company.create');
    Route::post('company/store', 'CompanyController@store')->name('company.store');
    Route::get('company/{id}/show', 'CompanyController@show')->name('company.show');
    Route::get('company/{id}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('company/{id}/update', 'CompanyController@update')->name('company.update');
    Route::delete('company/{id}/delete', 'CompanyController@destroy')->name('company.delete');

    // Employee CRUD Routes

    Route::get('employees/{company_id}', 'EmployeeController@index')->name('employee.index');
    Route::get('employee/create', 'EmployeeController@create')->name('employee.create');
    Route::post('employee/store', 'EmployeeController@store')->name('employee.store');
    Route::get('employee/{id}/show', 'EmployeeController@show')->name('employee.show');
    Route::get('employee/{id}/edit', 'EmployeeController@edit')->name('employee.edit');
    Route::put('employee/{id}/update', 'EmployeeController@update')->name('employee.update');
    Route::delete('employee/{id}/delete', 'EmployeeController@destroy')->name('employee.delete');

});
