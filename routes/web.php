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

Auth::routes();
Route::post('/searchmakeup', 'makeupcontroller@search');
Route::post('/feedback', 'makeupcontroller@feedback');
Route::get('/all', 'makeupcontroller@all');
Route::get('/makeup-list', 'makeupcontroller@makeupMenu')->name('makeup_menu');
Route::get('/makeup-details/{id}', 'makeupcontroller@makeup_details')->name('details');
Route::get('cart','makeupcontroller@carthandler');
Route::post('removecart/{id}','makeupcontroller@removecart');
Route::post('updatecart/{id}','makeupcontroller@updatecart');
Route::get('carts/{id}','makeupcontroller@cart');
Route::get('/about-us', 'Admin\DashboardController@aboutUs');
Route::get('/how-to-order', 'Admin\DashboardController@howToOrder');

Route::get('/artist-details/{id}', 'artistController@artist_details')->name('details');
Route::get('book/{id}','artistController@book');


Route::group(['middleware'=>['auth','artist']], function(){

    Route::get('/artist-dashboard', 'artistController@artistDashboard');
});


Route::group(['middleware'=>['auth','admin']], function(){

		Route::get('/dashboard', 'Admin\DashboardController@dashboard');
		Route::get('registered','Admin\DashboardController@registered');
		Route::post('userdelete','Admin\DashboardController@userdelete');
		Route::get('useredit/{id}','Admin\DashboardController@useredit');
		Route::post('submitform','Admin\DashboardController@submitform');
		Route::get('makeupcategory','Admin\DashboardController@makeupcategory');

		Route::post('submitcategory','Admin\DashboardController@submitcategory');

		Route::get('categorydelete/{id}','Admin\DashboardController@categorydelete');

		Route::get('district','Admin\DashboardController@district');

		Route::post('adddistrict','Admin\DashboardController@addDistrict');

		Route::get('districtdelete/{id}','Admin\DashboardController@districtDelete');

		Route::get('city','Admin\DashboardController@city');

		Route::post('addcity','Admin\DashboardController@addCity');

		Route::get('citydelete/{id}','Admin\DashboardController@cityDelete');

		Route::get('makeupmenu','Admin\DashboardController@makeupmenu');
		Route::get('addmakeup','Admin\DashboardController@addmakeup');
		Route::post('submitaddmakeup','Admin\DashboardController@submitaddmakeup');

		Route::get('makeupedit/{id}','Admin\DashboardController@makeupedit');
		Route::get('makeupdelete/{id}','Admin\DashboardController@makeupdelete');

		Route::post('submiteditmakeup','Admin\DashboardController@submiteditmakeup');

		Route::get('orders','Admin\DashboardController@orders');
		Route::post('update-order','Admin\DashboardController@updateorder');

		Route::post('search','Admin\DashboardController@search');
		Route::get('view-order-details/{id}','Admin\DashboardController@vieworders');


});

	Route::get('/', 'makeupcontroller@index')->name('frontend.home');



Route::group(['middleware'=>['auth','user']], function(){

	Route::get('myorders','makeupcontroller@orders')->name('myorders');
	Route::post('ordermakeup','makeupcontroller@ordermakeup')->name('ordermakeup');


	Route::get('checkout','makeupcontroller@checkout');
	Route::get('your-detail/{id}','makeupcontroller@yourdetail');

	Route::post('get-city','makeupcontroller@getCity')->name('getcity');

	Route::post('invoice', 'makeupcontroller@invoice');
	Route::get('order-details', 'makeupcontroller@order_details');

	Route::get('cancel_order/{id}', 'makeupcontroller@cancel_order');

	Route::get('profile','makeupcontroller@profile');
	Route::post('editaddress','makeupcontroller@editAddress');

	Route::get('recommendation','makeupcontroller@recommendation');
	Route::post('/rating', 'makeupcontroller@rating')->name('rating');



});
