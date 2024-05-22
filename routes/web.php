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
Route::post('/searchitem', 'makeupcontroller@search');
Route::post('/feedback', 'makeupcontroller@feedback');
Route::get('/all', 'makeupcontroller@all');
Route::get('/makeup-details/{id}', 'makeupcontroller@makeup_details')->name('details');
Route::get('cart','makeupcontroller@carthandler');
Route::post('removecart/{id}','makeupcontroller@removecart');
Route::post('updatecart/{id}','makeupcontroller@updatecart');
Route::get('carts/{id}','makeupcontroller@cart');
Route::get('/about-us', 'Admin\DashboardController@aboutUs');

Route::get('/artist-details/{id}', 'artistController@artist_details')->name('details');
Route::get('appointment/{id}', 'artistController@appointment')->name('appointment');
Route::post('appointment/store', 'artistController@storeAppointment')->name('appointment.store');
Route::post('appointments/{id}/cancel', 'artistController@cancelAppointment')->name('appointment.cancel');

Route::group(['middleware'=>['auth','artist']], function(){

    Route::get('/artist-dashboard', 'artistController@artistDashboard');
    Route::get('registered-user','artistController@registered');
    Route::post('updateuser','artistController@updateuser');
    Route::post('deleteuser','artistController@deleteuser');
    Route::get('edituser/{id}', 'artistController@useredit');
    Route::get('appointments', 'artistController@appointments')->name('appointments');
    Route::post('appointsdelete', 'artistController@appointsdelete')->name('appointsdelete');
    Route::get('confirm-appointment/{id}', 'artistController@confirmAppointment')->name('confirmAppointment');
    Route::get('/my-profile', 'artistController@show')->name('myProfile');

    Route::get('profile/edit', 'artistController@editprofile')->name('editProfile');
    Route::post('profile/update', 'artistController@updateprofile')->name('updateProfile');

});


Route::group(['middleware'=>['auth','admin']], function(){

		Route::get('/dashboard', 'Admin\DashboardController@dashboard');
		Route::get('registered','Admin\DashboardController@registered');
		Route::post('userdelete','Admin\DashboardController@userdelete');
		Route::get('useredit/{id}','Admin\DashboardController@useredit');
		Route::post('submitform','Admin\DashboardController@submitform');

		Route::get('artists','Admin\DashboardController@artistshow');
		Route::post('artistdelete','Admin\DashboardController@artistdelete');

		Route::get('appoints','Admin\DashboardController@appointshow');
		Route::post('appointdelete','Admin\DashboardController@appointdelete');


		Route::get('makeupcategory','Admin\DashboardController@makeupcategory');

		Route::post('submitcategory','Admin\DashboardController@submitcategory');

		Route::delete('categorydelete/{id}','Admin\DashboardController@categorydelete');

		Route::get('district','Admin\DashboardController@district');

		Route::post('adddistrict','Admin\DashboardController@addDistrict');

		Route::delete('districtdelete/{id}','Admin\DashboardController@districtDelete');

		Route::get('city','Admin\DashboardController@city');

		Route::post('addcity','Admin\DashboardController@addCity');

		Route::delete('citydelete/{id}','Admin\DashboardController@cityDelete');

		Route::get('makeupmenu','Admin\DashboardController@makeupmenu');
		Route::get('addmakeup','Admin\DashboardController@addmakeup');
		Route::post('submitaddmakeup','Admin\DashboardController@submitaddmakeup');

		Route::get('makeupedit/{id}','Admin\DashboardController@makeupedit');
		Route::get('makeupdelete/{id}','Admin\DashboardController@makeupdelete');

		Route::post('submiteditmakeup','Admin\DashboardController@submiteditmakeup');

		Route::get('orders','Admin\DashboardController@orders');
		Route::post('update-order','Admin\DashboardController@updateorder');

		Route::post('view-order','Admin\DashboardController@search');
		Route::get('view-order-details/{id}','Admin\DashboardController@vieworders');


});

	Route::get('/', 'makeupcontroller@index')->name('frontend.home');




Route::group(['middleware'=>['auth','user']], function(){

	Route::get('myorders','makeupcontroller@orders')->name('myorders');
	Route::get('myappointments','artistController@myappointments')->name('myappointments');
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
