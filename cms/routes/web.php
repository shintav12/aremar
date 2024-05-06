<?php

use Illuminate\Support\Facades\Route;
use App\DataTable\DTHelper;

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


Route::get('/', ["as" => "index", "uses" => "LoginController@index"]);
Route::post('/process_login', ["as" => "login", "uses" => "LoginController@login"]);
Route::any('/logout', ["as" => "logout", "uses" => 'LoginController@logout']);
DTHelper::BuildRoutes('auth_role', 'AuthRoleController', 'verify_permissions', 'auth_role');
DTHelper::BuildRoutes('auth_user', 'AuthUserController', 'verify_permissions', 'auth_user');
DTHelper::BuildRoutes('categories', 'CategoryController', 'verify_permissions', 'categories');
DTHelper::BuildRoutes('metals', 'MetalsController', 'verify_permissions', 'metals');
DTHelper::BuildRoutes('sections', 'SectionController', 'verify_permissions', 'sections');
DTHelper::BuildRoutes('collections', 'CollectionController', 'verify_permissions', 'collections');
DTHelper::BuildRoutes('products', 'ProductController', 'verify_permissions', 'products');
DTHelper::BuildRoutes('orders', 'OrderController', 'verify_permissions', 'orders');
DTHelper::BuildRoutes('offers', 'OfferController', 'verify_permissions', 'offers');
DTHelper::BuildRoutes('contacts', 'ContactController', 'verify_permissions', 'contact');

Route::group(['prefix' => 'auth_role', 'middleware' => 'verify_permissions'], function () {
    Route::post('save_perms', 'AuthRoleController@permissionsSave')->name('auth_role_save_perms');
    Route::get('perms/{id?}', 'AuthRoleController@perms')->name('auth_role_perms');
});
