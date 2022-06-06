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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/birthday', [App\Http\Controllers\HomeController::class, 'birthdayNotification'])->name('birthday');

Route::group(['middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () {
    Route::get('/dashboard','Dashboard\DashboardController@index')->name('dashboard');




    /*
    |--------------------------------------------------------------------------
    | User CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'user.', 'prefix' => 'user',], function () {
        Route::get('', 'User\UserController@index')->name('index')->middleware('permission:user-index');
        Route::get('user-data', 'User\UserController@getAllData')->name('data')->middleware('permission:user-data');
        Route::get('create', 'User\UserController@create')->name('create')->middleware('permission:user-create');
        Route::post('', 'User\UserController@store')->name('store')->middleware('permission:user-store');
        Route::get('{user}/edit', 'User\UserController@edit')->name('edit')->middleware('permission:user-edit');
        Route::put('{user}', 'User\UserController@update')->name('update')->middleware('permission:user-update');
        Route::get('user/{id}/destroy', 'User\UserController@destroy')->name('destroy')->middleware('permission:user-delete');
        Route::get('update-profile', 'User\UserController@profileUpdate')->name('profileUpdate');
        Route::post('update-profile/{id}', 'User\UserController@profileUpdateStore')->name('updateProfile');
    });

    /*
    |--------------------------------------------------------------------------
    | Role CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'role.', 'prefix' => 'role',], function () {
        Route::get('', 'Role\RoleController@index')->name('index')->middleware('permission:role-index');
        Route::get('role-data', 'Role\RoleController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Role\RoleController@create')->name('create')->middleware('permission:role-create');
        Route::post('', 'Role\RoleController@store')->name('store')->middleware('permission:role-store');
        Route::get('{role}/edit', 'Role\RoleController@edit')->name('edit')->middleware('permission:role-edit');
        Route::put('{role}', 'Role\RoleController@update')->name('update')->middleware('permission:role-update');
        Route::get('role/{id}/destroy', 'Role\RoleController@destroy')->name('destroy')->middleware('permission:role-delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Permission CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'permission.', 'prefix' => 'permission',], function () {
        Route::get('', 'Permission\PermissionController@index')->name('index')->middleware('permission:role-index');
        Route::get('permission-data', 'Permission\PermissionController@getAllData')->name('data')->middleware('permission:role-data');
        Route::get('create', 'Permission\PermissionController@create')->name('create')->middleware('permission:permission-create');
        Route::post('', 'Permission\PermissionController@store')->name('store')->middleware('permission:role-store');
        Route::get('{permission}/edit', 'Permission\PermissionController@edit')->name('edit')->middleware('permission:permission-edit');
        Route::put('{permission}', 'Permission\PermissionController@update')->name('update')->middleware('permission:role-update');
        Route::get('permission/{id}/destroy', 'Permission\PermissionController@destroy')->name('destroy')->middleware('permission:permission-delete');
    });


    Route::group(['as'=>'common.', 'prefix'=>'common'], function(){
        Route::post('provinces', 'Common\CommonController@getProvincesByCountryId')->name('province.countryId');
        Route::post('districts', 'Common\CommonController@getDistrictsByProvinceId')->name('district.provinceId');
    });



    /*
    |--------------------------------------------------------------------------
    | Customers CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'customer.', 'prefix' => 'customer',], function () {
        Route::get('', 'Customer\CustomerController@index')->name('index');
        Route::get('customer-data', 'Customer\CustomerController@getAllData')->name('data');
        Route::get('create', 'Customer\CustomerController@create')->name('create');
        Route::post('', 'Customer\CustomerController@store')->name('store');
        Route::get('{customer}/show','Customer\CustomerController@show')->name('show');
        Route::get('{customer}/edit', 'Customer\CustomerController@edit')->name('edit');
        Route::put('{customer}', 'Customer\CustomerController@update')->name('update');
        Route::get('/{id}/destroy', 'Customer\CustomerController@destroy')->name('delete');
        Route::post('get-perm-province','Customer\CustomerController@getPermanentProvince')->name('get_perm_province');
        Route::post('get-perm-district','Customer\CustomerController@getPermanentDistrict')->name('get_perm_district');
        Route::post('get-perm-municipality','Customer\CustomerController@getPermanentMunicipality')->name('get_perm_municipality');

    });

    /*
    |--------------------------------------------------------------------------
    | RoomType CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'room.', 'prefix' => 'room',], function () {
        Route::get('', 'RoomType\RoomTypeController@index')->name('index');
        Route::get('room-data', 'RoomType\RoomTypeController@getAllData')->name('data');
        Route::get('create', 'RoomType\RoomTypeController@create')->name('create');
        Route::post('', 'RoomType\RoomTypeController@store')->name('store');
        Route::get('{room}/show','RoomType\RoomTypeController@show')->name('show');
        Route::get('{room}/edit', 'RoomType\RoomTypeController@edit')->name('edit');
        Route::put('{room}', 'RoomType\RoomTypeController@update')->name('update');
        Route::get('/{id}/destroy', 'RoomType\RoomTypeController@destroy')->name('destroy');


    });

    /*
    |--------------------------------------------------------------------------
    | Check-In CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'checkin.', 'prefix' => 'checkin',], function () {
        Route::get('', 'CheckIn\CheckInController@index')->name('index');
        Route::get('checkin-data', 'CheckIn\CheckInController@getAllData')->name('data');
        Route::get('create', 'CheckIn\CheckInController@create')->name('create');
        Route::post('', 'CheckIn\CheckInController@store')->name('store');
        Route::get('{checkin}/show','CheckIn\CheckInController@show')->name('show');
        Route::get('{checkin}/edit', 'CheckIn\CheckInController@edit')->name('edit');
        Route::put('{checkin}', 'CheckIn\CheckInController@update')->name('update');
        Route::get('/{id}/destroy', 'CheckIn\CheckInController@destroy')->name('delete');
        Route::post('get-room-price','CheckIn\CheckInController@getRoomTypePrice')->name('get_room_price');
        Route::post('add-checkout','CheckIn\CheckInController@addCheckOut')->name('add_checkout');
        Route::get('{checkin}/generate-bill','CheckIn\CheckInController@generateBill')->name('generate_bill');
        Route::post('generate-bill','CheckIn\CheckInController@storeGenerateBill')->name('store_generated_bill');
        Route::get('/{id}/delete-bill','CheckIn\CheckInController@deleteBill')->name('bill_delete');
        Route::get('{checkin}/generate-invoice','CheckIn\CheckInController@generateInvoice')->name('generate_invoice');
        Route::post('/publish-invoice','CheckIn\CheckInController@publishInvoice')->name('publish_invoice');



    });

    /*
    |--------------------------------------------------------------------------
    | Reports CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'report.', 'prefix' => 'report',], function () {
        Route::get('', 'Report\ReportController@index')->name('index');
        Route::get('report-data', 'Report\ReportController@getAllData')->name('data');
        Route::get('get-reports-by-parameter', 'Report\ReportController@getReportsByParameter')->name('get_reports_by_parameter');

    });

    /*
    |--------------------------------------------------------------------------
    | Loan CRUD
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['as' => 'credit.', 'prefix' => 'credit',], function () {
        Route::get('', 'Credit\CreditController@index')->name('index');
        Route::get('credit-data', 'Credit\CreditController@getAllData')->name('data');
        Route::get('create', 'Credit\CreditController@create')->name('create');
        Route::post('', 'Credit\CreditController@store')->name('store');
        Route::get('{credit}/show','Credit\CreditController@show')->name('show');
        Route::get('{credit}/edit', 'Credit\CreditController@edit')->name('edit');
        Route::put('{credit}', 'Credit\CreditController@update')->name('update');
        Route::get('/{id}/destroy', 'Credit\CreditController@destroy')->name('destroy');
    });

});
