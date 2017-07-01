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
Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {
    // Backpack\MenuCRUD
    CRUD::resource('menu-item', 'MenuItemCrudController');
    //  CRUD resources and other admin routes
    CRUD::resource('ship', 'ShipCrudController');
    CRUD::resource('location', 'LocationCrudController');
    CRUD::resource('town', 'TownCrudController');
    CRUD::resource('fish', 'FishCrudController');
    CRUD::resource('businessType', 'BusinessTypeCrudController');
    CRUD::resource('shipType', 'shipTypeCrudController');
    CRUD::resource('dailyOperation', 'dailyOperationCrudController');
    CRUD::resource('license', 'LicenseCrudController');
    CRUD::resource('renewal', 'RenewalCrudController');

    Route::get('report/dailyOperation', 'ReportController@dailyOperation');
    Route::get('report/license', 'ReportController@license');
    Route::get('report/renewal', 'ReportController@renewal');
    Route::get('report/print', 'ReportController@print_license');
    Route::get('report/{id}/print', 'ReportController@show_print_license');
});
