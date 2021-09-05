<?php
// Switch between the included languages
Route::get('locale/{locale?}', 'LocaleController@change')->name('locale.change');

// Contact Us
Route::post('/contact_us', 'ContactUsController@send')->name('contact_us');

// To view img no need to login
Route::get('image/{path}', 'ImageController@show')->where('path', '.*')->name('image.show');

Route::group(['middleware' => ['ajax']], function(){
	// Use php helper functions from js
	Route::get('helper/getFromPHPHelper', 'Admin\AjaxController@ajaxGetFromPHPHelper')->name('helper.getFromPHPHelper');

	Route::get('cart/ajax/getTaxRate', 'Admin\ShippingZoneController@ajaxGetTaxRate')->name('ajax.getTaxRate');
	Route::post('shop/ajax/bank', 'Admin\ShopController@ajaxBankStore')->name('ajax.bankshopstore')->middleware('ajax');
});

Route::get('address/ajax/getCountryStates', 'AddressController@ajaxCountryStates')->name('ajax.getCountryStates')->middleware('ajax');
Route::get('shipping/ajax/getshippingcourier', 'AddressController@ajaxShippingCourier')->name('ajax.getShippingCourier')->middleware('ajax');
Route::get('checkout/ajax/getpaymentmidtransurl', 'OrderController@ajaxpaymentmidtrans')->name('ajax.getPaymidtransUrl')->middleware('ajax');

Route::group(['middleware' => ['auth']], function(){
	include('common/Image.php');
	include('common/Attachment.php');
	include('common/Address.php');
	include('common/Search.php');
});
