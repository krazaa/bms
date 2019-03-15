<?php

//Start Vendors routes
Route::prefix('vendors.')->group(function () {
    Route::get('/', 'vendors\VendorController@index')->name('vendors');
    Route::get('/GetVendors', 'vendors\VendorController@GetVendors')->name('vendors.GetVendors');
    Route::get('/check', 'vendors\VendorController@check')->name('vendors.check');
});
//End vendors routes

//Start products routes
Route::prefix('products.')->group(function () {
    Route::get('autos/', 'products\AutosProductController@index')->name('products.autos');
    Route::get('autos/newproduct', 'products\AutosProductController@NewProductFrom')->name('products.autos.newproduct');
    Route::get('autos/GetAutosProducts/', 'products\AutosProductController@GetAutosProducts')->name('products.autos.GetAutosProducts');
    Route::get('autos/SearchAutosProduct/', 'products\AutosProductController@SearchAutosProduct')->name('products.autos.SearchAutosProduct');
    Route::get('autos/ShowAutosSingle/{id}', 'products\AutosProductController@ShowAutosSingle')->name('products.autos.ShowAutosSingle');
    Route::get('autos/ShowSingle/{id}', 'products\AutosProductController@ShowSingle')->name('products.autos.ShowSingle');
    Route::get('autos/ShowEdit/{id}', 'products\AutosProductController@ShowEdit')->name('products.autos.ShowEdit');
    Route::get('autos/ProductRemove/{id}', 'products\AutosProductController@ProductRemove')->name('products.autos.ProductRemove');
    
    //Electronic
    Route::get('electronic/', 'products\ElectronicProductController@index')->name('products.electronic');
    
});
//End products routes

//Start Purchase Orders routes
Route::prefix('purchase-order.')->group(function () {
    Route::get('autos/', 'purchaseorders\AutosPurchaseOrdersController@index')->name('purchase-order.autos');
    
    //Electronic
    Route::get('electronic/', 'purchaseorders\ElectronicPurchaseOrdersController@index')->name('purchase-order.electronic');
    
});
//End Purchase Orders routes

//Start Settings routes
Route::prefix('settings.')->group(function () {
    Route::get('/company', 'SettingController@index')->name('settings.company');
    Route::get('/branches', 'SettingController@index2')->name('settings.branches');
	Route::get('/getsetting', 'SettingController@GetSetting')->name('getsetting');
	Route::post('/updatesetting', 'SettingController@UpdateSetting')->name('updatesetting');
});
//End Settings routes



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

Route::get('/gg', function(){

return \App\modules\Autoproduct::with('vendorinfo')->get();

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('manage/users', 'manage\UserController@index')->name('manage.users');
Route::get('manage/users/create', 'manage\UserController@create')->name('manage.create');
Route::get('manage/users/show/{id}', 'manage\UserController@show')->name('manage.show');
Route::post('manage/users/store', 'manage\UserController@store')->name('manage.store');

Route::get('manage/users/SearchUsers', 'manage\UserController@SearchUsers')->name('manage.SearchUsers');

// branches
Route::get('manage/branches', 'manage\UserController@GetBranches')->name('manage.branches');

// Roles
Route::get('manage/roles', 'manage\UserController@GetRoles')->name('manage.roles');

//for vue
Route::get('manage/getusers', 'manage\UserController@Getusers')->name('manage.getusers');
Route::get('manage/users/singleuser/{id}', 'manage\UserController@GetSingleUser')->name('manage.singleuser');



