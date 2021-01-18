<?php


/*********** start the reseller route ********************/

Route::get('/_reseller/login','Reseller\LoginController@loginView')->name('reseller.login');
Route::post('/_reseller/login','Reseller\LoginController@login')->name('reseller.login');
Route::get('/_reseller/registration','Reseller\LoginController@showRegister')->name('reseller.register.display');
Route::post('/_reseller/registration','Reseller\LoginController@register')->name('reseller.register');


Route::group([

    'prefix'=>'Reseller',
    'middleware'=>['reseller'],
    'namespace'=>'Reseller',
    
],function (){

    Route::get('/dashboard','HomeController@index')->name('dashboard.reseller');
    Route::get('/logout','LoginController@logout')->name('logout.reseller');
    Route::get('/edit/profile','HomeController@editProfile')->name('edit.profile.reseller');
    Route::post('/update/profile','HomeController@UpdateProfile')->name('update.profile.reseller');
    Route::get('/view/profile','HomeController@viewProfile')->name('view.profile.reseller');
    Route::get('/change/password','HomeController@changePassword')->name('change.profile.reseller.password');
    Route::get('order/search/reseller','OrderController@orderSearch')->name('order.search.reseller');




    /*********** start the reseller order route ********************/

    Route::get('/order/index','OrderController@index')->name('index.order.reseller');
    Route::get('/customer/search/{id}','OrderController@customerSearch')->name('reseller.customer.search');
    Route::get('/product/find/{id}','OrderController@productFind')->name('product.find.reseller');
        // Route::get('/find/product/attrbute/wise/variant/{id}','OrderController@attributeWisevariant')->name('product.find.reseller');

    Route::post('/save/order','OrderController@orderSave')->name('order.save.reseller');
    Route::get('/create/order','OrderController@create')->name('order.create.reseller');
    Route::get('wholesale/create/order','OrderController@wholeSale')->name('order.wholesale.create.reseller');
    Route::get('view/reseller/order/{id}','OrderController@orderView')->name('view.order.reseller');
    Route::get('cancel/reseller/order/{id}','OrderController@cancelOrder')->name('cancel.order.reseller');
    
    
    /*********** start the reseller payment route ********************/
    Route::get('/payment/index','OrderController@payment')->name('resellerWise.payment');
    Route::get('details/payment/{id}','OrderController@paymentDetails')->name('details.resellerWise.payment');

        





});

Route::get('/reseller/home','Reseller\HomeController@home')->name('home.reseller');


Route::get('/reseller/home','Reseller\HomeController@home')->name('home.reseller');
Route::post('/password/reset','Reseller\LoginController@passwordReset')->name('reseller.password.reset');
Route::post('/code/verification','Reseller\LoginController@codeVerification')->name('code.verification');
Route::post('/new/password/resller','Reseller\LoginController@changePassword')->name('new.password.reset.reseller');

Route::get('/reseller/register','Reseller\LoginController@showRegister')->name('reseller.register');
Route::post('/reseller/register','Reseller\LoginController@register')->name('reseller.register');

