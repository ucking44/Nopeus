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

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    ///////////////////////////////// COMPANY'S ROUTE ///////////////////////////////////

    Route::get('/company', 'CompanyController@index')->name('company');

    Route::post('/save-company', 'CompanyController@store')->name('save-company');

    Route::get('/edit-company/{company}', 'CompanyController@edit')->name('edit-company');

    Route::put('/update-company/{company}', 'CompanyController@update')->name('update-company');

    Route::delete('/delete-company/{company}', 'CompanyController@destroy')->name('delete-company');


    //////////////////////////////// EMPLOYEE'S ROUTE //////////////////////////////////

    Route::get('/employee', 'EmployeeController@index')->name('employee');

    Route::post('/save-employee', 'EmployeeController@store')->name('save-employee');

    Route::get('/edit-employee/{employee}', 'EmployeeController@edit')->name('edit-employee');

    Route::put('/update-employee/{employee}', 'EmployeeController@update')->name('update-employee');

    Route::delete('/delete-employee/{employee}', 'EmployeeController@destroy')->name('delete-employee');



});
