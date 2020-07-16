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
    // return redirect('/login');
    return view('splash');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/dashboard', 'DashboardController');

Route::resource('/transactions', 'TransactionsController');

Route::get('/accounts/new', 'AccountsController@new')->name('account.new');
Route::get('/accounts/new/{any}', 'AccountsController@new')->name('account.new');

Route::resource('/accounts', 'AccountsController');

Route::resource('/reporting', 'ReportingController');

Route::resource('/profile', 'ProfileController');

Route::resource('/settings', 'SettingsController');

Route::resource('/admin/dashboard', 'Admin\DashboardController');

Route::resource('/admin/settings', 'Admin\SettingsController');






