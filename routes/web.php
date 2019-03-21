<?php


Auth::routes();

//Route::prefix('bms')->group(function () {

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('{path}', "HomeController@index")->where('path', '([A-z\d-\/_.]+)?' );


//Start Vendors routes
Route::prefix('vendors.')->group(function () {
    //Route::get('/', 'vendors\VendorController@index')->name('vendors');
    Route::get('/GetVendors', 'vendors\VendorController@GetVendors')->name('vendors.GetVendors');
    Route::get('/create', 'vendors\VendorController@create')->name('vendors.create');
    Route::post('/VendorStore', 'vendors\VendorController@VendorStore')->name('vendors.VendorStore');
    Route::get('/SearchVendor', 'vendors\VendorController@SearchVendor')->name('vendors.SearchVendor');
    Route::get('/VendorSearch', 'vendors\VendorController@VendorSearch')->name('vendors.VendorSearch');
});
//End vendors routes

//Start Agents routes
Route::prefix('agents.')->group(function () {
    Route::get('/AgentsListGet', 'agents\AgentController@AgentsListGet')->name('agents.AgentsListGet');
    Route::get('/AgentSearch', 'agents\AgentController@AgentSearch')->name('agents.AgentSearch');
    Route::get('/AgentEdit/{id}', 'agents\AgentController@AgentEdit')->name('agents.AgentEdit');
    Route::get('/AgentED/{id}', 'agents\AgentController@AgentED')->name('agents.AgentED');
    Route::get('/AgentDelete/{id}', 'agents\AgentController@AgentDelete')->name('agents.AgentDelete');
    Route::get('/CheckCompany', 'agents\AgentController@AvailabilityCheck')->name('agents.CheckCompany');
    Route::post('/AgentStore', 'agents\AgentController@AgentStore')->name('agents.AgentStore');
    Route::post('/AgentUpdate/{id}', 'agents\AgentController@AgentUpdate')->name('agents.AgentUpdate');
    
});
//End Agents routes

//Start CategoriesController
Route::prefix('categories.')->group(function () {
    
    Route::get('/GetCategories', 'category\CategoriesController@index')->name('categories.GetCategories');
    Route::get('/create', 'category\CategoriesController@create')->name('categories.create');
    Route::post('/CatStore', 'category\CategoriesController@CatStore')->name('categories.CatStore');
    Route::get('/CatSearch', 'category\CategoriesController@CatSearch')->name('categories.CatSearch');
    Route::get('/SearchCat', 'category\CategoriesController@SearchCat')->name('categories.SearchCat');
});
//End CategoriesController

//Start cogs
Route::prefix('cogs.')->group(function () {
    
    Route::get('/AcCheck', 'cogs\CogController@AcCheck')->name('cogs.AcCheck');
    Route::get('/CogsList', 'cogs\CogController@CogsList')->name('cogs.CogsList');
    Route::get('/AcEdit/{id}', 'cogs\CogController@AcEdit')->name('cogs.AcEdit');
    Route::get('/AcCat', 'cogs\CogController@AcCat')->name('cogs.AcCat');
    Route::get('/AcTypes', 'cogs\CogController@AcTypes')->name('cogs.AcTypes');
    Route::get('/GetMainAcc', 'cogs\CogController@GetMainAcc')->name('cogs.GetMainAcc');
    Route::get('/GetSubAcc', 'cogs\CogController@GetSubAcc')->name('cogs.GetSubAcc');
    Route::post('/CogStoreAcc', 'cogs\CogController@CogStoreAcc')->name('cogs.CogStoreAcc');
    
});
//End cogs


//Start products routes
Route::prefix('products.')->group(function () {
    Route::get('/', 'products\ProductController@Products')->name('products');
    Route::get('autos/', 'products\AutosProductController@index')->name('products.autos');
    Route::get('autos/newproduct', 'products\AutosProductController@NewProductFrom')->name('products.autos.newproduct');
    Route::get('autos/GetAutosProducts/', 'products\AutosProductController@GetAutosProducts')->name('products.autos.GetAutosProducts');
    Route::get('autos/SearchAutosProduct/', 'products\AutosProductController@SearchAutosProduct')->name('products.autos.SearchAutosProduct');
    Route::get('autos/SearchCode/', 'products\AutosProductController@SearchCode')->name('products.autos.SearchCode');
    Route::get('autos/ShowAutosSingle/{id}', 'products\AutosProductController@ShowAutosSingle')->name('products.autos.ShowAutosSingle');
    Route::get('autos/ShowSingle/{id}', 'products\AutosProductController@ShowSingle')->name('products.autos.ShowSingle');
    Route::get('autos/ShowEdit/{id}', 'products\AutosProductController@ShowEdit')->name('products.autos.ShowEdit');
    Route::get('autos/ShowEditFrm/{id}', 'products\AutosProductController@ShowAutosEdit')->name('products.autos.ShowEditFrm');
    Route::post('autos/AutosUpdate/{id}', 'products\AutosProductController@AutosUpdate')->name('products.autos.AutosUpdate');
    Route::get('autos/AutoShow/{id}', 'products\AutosProductController@AutoShow')->name('products.autos.AutoShow');
    
    Route::post(
        'autos/AutoProductStore', 
        'products\AutosProductController@AutoProductStore'
                )
    ->name('products.autos.AutoProductStore');

    Route::get('autos/ProductRemove/{id}', 'products\AutosProductController@ProductRemove')->name('products.autos.ProductRemove');
    
    //Electronic
    Route::get('/electronic/GetElectronic', 'products\ElectronicProductController@index')->name('products.electronic.GetElectronic');
    Route::get('/electronic/create', 'products\ElectronicProductController@create')->name('products.electronic.create');
    Route::post('/electronic/ElecStore', 'products\ElectronicProductController@ElecStore')->name('products.electronic.ElectStore');
    Route::get('/electronic/ElecSearch', 'products\ElectronicProductController@ElecSearch')->name('products.electronic.ElectSearch');
    Route::get('/electronic/SearchElec', 'products\ElectronicProductController@SearchElec')->name('products.electronic.SearchElec');
    Route::get('/electronic/ShowSingle/{id}', 'products\ElectronicProductController@ShowSingle')->name('products.electronic.ShowSingle');

    
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
	Route::get('/getsetting', 'SettingController@GetSetting')->name('getsetting');
	Route::post('/updatesetting', 'SettingController@UpdateSetting')->name('updatesetting');

    // Branches
    Route::get('/branches', 'settings\BranchesController@index')->name('settings.branches');
    Route::get('/branches/GetBranches', 'settings\BranchesController@GetBranches')->name('settings.branches.GetBranches');
    //Route::get('/branches/newbranch', 'settings\BranchesController@create')->name('settings.branches.newbranch');
    Route::post('/branches/branchstore', 'settings\BranchesController@store')->name('settings.branches.branchstore');
    //Route::get('/branches/editbranch/{id}', 'settings\BranchesController@edit')->name('settings.branches.editbranch');
    Route::get('/branches/ShowSingle/{id}', 'settings\BranchesController@ShowSingle')->name('settings.branches.ShowSingle');
    Route::post('branches/branchupdate/{id}', 'settings\BranchesController@BranchUpdate')->name('settings.branches.branchupdate');
    Route::get('branches/removebranch/{id}', 'settings\BranchesController@destroy')->name('settings.branches.removebranch');
});
//End Settings routes



//dashboard

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
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

return \App\modules\Cogcategory::get();

});







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


// bms path end
//});