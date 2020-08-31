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
Route::group(
	//['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],
	['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],
	function () {
		Route::get('dashboard', 'DashboardController@index');
		Route::resource('categories', 'CategoryController');
		
		Route::resource('products', 'ProductController');
		Route::get('products/{productID}/images', 'ProductController@images')->name('products.images');
		Route::get('products/{productID}/add-image', 'ProductController@addImage')->name('products.add_image');
		Route::post('products/images/{productID}', 'ProductController@uploadImage')->name('products.upload_image');
		Route::delete('products/images/{imageID}', 'ProductController@removeImage')->name('products.remove_image');

		Route::resource('attributes', 'AttributeController');
		Route::get('attributes/{attributeID}/options', 'AttributeController@options')->name('attributes.options');
		Route::get('attributes/{attributeID}/add-option', 'AttributeController@add_option')->name('attributes.add_option');
		Route::post('attributes/options/{attributeID}', 'AttributeController@store_option')->name('attributes.store_option');
		Route::delete('attributes/options/{optionID}', 'AttributeController@remove_option')->name('attributes.remove_option');
		Route::get('attributes/options/{optionID}/edit', 'AttributeController@edit_option')->name('attributes.edit_option');
		Route::put('attributes/options/{optionID}', 'AttributeController@update_option')->name('attributes.update_option');

	}
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
