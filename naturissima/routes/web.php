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
Route::get('/products/clientDownloadFile/{code}', 'ProductController@clientDownloadProductFile')->name('product.client_download');

Auth::routes();
Route::get('/', "HomeController@index");
Route::get('/legal/terminos_y_condiciones', "LegalController@terms_and_conditions")->name('terms_and_conditions');
Route::get('/legal/aviso_privacidad', "LegalController@privacy_disclaimer")->name('privacy_disclaimer');
Route::get('/test', 'TestController@index');
Route::resource('/store','ProductController');
Route::resource('/contacto','ContactController');
Route::resource('/bibliography','BibliographyController')->middleware('is_admin');
Route::get('/admin/non_categorized_products','ProductController@nonCategorizedProducts');
Route::post('/email/resend/{order}','OpenPayController@send_email')->name("resend_email");
Route::get('/ajax_get_appoinments_from_date/{date?}','AppoinmentController@ajax_get_appoinments_from_date');
Route::resource('/appoinments','AppoinmentController');
Route::resource('/orders','OrderController');

Route::post('/product_category/ajaxUpdate/{id?}','ProductCategoryController@ajaxUpdate')->name('product_category.ajaxUpdate');
Route::post('/product_category/ajaxDelete','ProductCategoryController@ajaxDelete')->name('product_category.ajaxDelete');
Route::get('/product_category/ajaxGet/{text}','ProductCategoryController@ajaxGet')->name('product_category.ajaxGet');
Route::resource('/product_category','ProductCategoryController');

Route::post('/tienda/manage_cart','ProductController@AJAX_manageCart');
// Route::post('/quicklogin','LoginController@quickLogin');
Route::get('/checkout','ProductController@checkout');
Route::get('/category/{viewcategory}','ProductCategoriesController@viewCategory');
Route::get('/helper/ajax_get_municipalities_id_by_name/{municipality_id}','CheckoutController@ajax_get_municipality_id_by_name');
Route::get('/helper/ajax_get_municipalities_from_state_id/{municipality_id}','CheckoutController@ajax_get_municipalities_by_state_id');
Route::get('/helper/ajax_get_estate_id_by_name/{state_name}','CheckoutController@ajax_get_estate_id_by_name');
// Route::get('/store/{viewcategory?}','ProductCategoriesController@index')->name("store.index");

Route::post('/charge', 'OpenPayController@store');
Route::get('/detalles_de_compra/{id}/{mail_status?}', 'OpenPayController@detalles_de_compra')->name('openpay.detalles_de_compra');

Route::get('/parametrizacion', 'ParametrizationController@index')->name("parametrization.index");
Route::get('/create_appointment_for_product/{product_id}', 'AppoinmentController@create_appointment_for_product');
Route::post('/revision', 'OpenPayController@revision');
Route::get('/historial_busquedas', 'SearchHistoryController@index')->name("search_history.index");
Route::get('/ajax_get_remaining_times_from_date/{date?}', 'AppoinmentController@ajax_get_remaining_times_from_date');
Route::get('/time', function(){
	dd(date("Y-m-d H:m:s",time()));
});

Route::resource('users', 'UsersController');
Route::put('users/{id}', 'UsersController@update')->name('users.update');

Route::get('/downloadProductFile/{product}', 'ProductController@downloadProductFile')->name('product.download_file');

Route::get('/home', function(){return view('home');})->name('home');
