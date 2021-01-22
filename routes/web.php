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

Auth::routes(['verify' => true]);

Route::get('/cron/daily-transactions', 'CronController@pullDailyTransactions');
Route::get('/cron/map-institutions', 'CronController@mapInstitutions');

// Route::post('/onboarding', 'OnboardingController@save');
Route::put('onboarding', 'OnboardingController@update')->middleware('verified');
Route::get('onboarding/transactions/{account_id}', 'OnboardingController@transactions')->middleware('verified');
Route::resource('/onboarding', 'OnboardingController')->middleware('verified');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/dashboard', 'DashboardController');

Route::resource('/transactions', 'TransactionsController');

Route::get('/accounts/new', 'AccountsController@new')->name('account.new');
Route::get('/accounts/new/{any}', 'AccountsController@new')->name('account.new');
Route::get('/accounts/new/{any}/{id}', 'AccountsController@new')->name('account.new');
Route::post('/accounts/manual', 'AccountsController@manualAccount')->name('accounts.manual');
Route::post('/accounts/{id}/sync', 'AccountsController@sync')->name('account.sync');

Route::resource('/accounts', 'AccountsController');

Route::resource('/reporting', 'ReportingController');

Route::resource('/budgets', 'BudgetsController');

Route::resource('/profile', 'ProfileController');

Route::get('/settings/billing', 'SettingsController@billingPortal');
Route::post('/settings/billing/change-plan', 'SettingsController@changePlan');
Route::post('/settings/billing/card', 'SettingsController@attachCard');
Route::post('/settings/billing/update-profile', 'SettingsController@updateProfile');

Route::resource('/what-if', 'WhatIfController');

Route::resource('/money-savers', 'MoneySaversController');

Route::resource('admin/money-savers', 'Admin\MoneySaversController');
Route::resource('admin/money-saver-types', 'Admin\MoneySaverTypesController');

Route::resource('/settings', 'SettingsController');

Route::resource('/admin/dashboard', 'Admin\DashboardController');

Route::resource('/admin/settings', 'Admin\SettingsController');

Route::resource('/institutions', 'InstitutionsController');

Route::get('/search/accounts', 'SearchController@accounts');
Route::get('/search/transactions', 'SearchController@transactions');
Route::resource('/search', 'SearchController');

Route::get('/mx/accounts', 'MXController@accounts');
Route::get('/mx/institutions', 'MXController@institutions');
Route::post('/mx/accounts', 'MXController@createAccount');
Route::get('/mx/widget', 'MXController@widget');
Route::get('/mx/members', 'MXController@members');
Route::get('/mx/members/{guid}', 'MXController@members');
Route::get('/mx/members/{member_guid}', 'MXController@showMember');
Route::get('/mx/members/{member_guid}/remove', 'MXController@removeMember');
Route::get('/mx/members/{member_guid}/remove/{user_guid}', 'MXController@removeMember');
Route::get('/mx/members/{member_guid}/link', 'MXController@attachMemberAcount');
Route::get('/mx/transactions/{member_guid}', 'MXController@transactions');
Route::resource('/mx', 'MXController');
