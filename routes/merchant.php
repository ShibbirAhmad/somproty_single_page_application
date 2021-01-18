<?php 

//route for merchant login and registration and authorizatoin 
Route::post('api/merchant/login','Merchant\LoginController@check_login') ;
Route::get('api/merchant/login/session/check','Merchant\LoginController@check_session') ;
Route::post('api/merchant/register','Merchant\LoginController@register_merchant')->name('merchant.register');

Route::post('api/merchant/password/reset/send/code','Merchant\LoginController@send_reset_code');
Route::post('api/merchant/verify/reset/code/{phone}','Merchant\LoginController@merchant_reset_code_verified');
Route::post('api/merchant/new/password/set/{phone}','Merchant\LoginController@merchant_set_new_password');



Route::group([ 
                'middleware' => 'merchant', 
                'namespace' => 'Merchant' 
            ],function(){
            
        Route::get('api/merchant/logout','LoginController@logout') ;   
        Route::get('api/merchant/products','ProductController@index');    
        Route::post('api/merchant/product/store','ProductController@store_product');    
        
        // route for dashboard data 
         Route::get('api/get/merchant/dashboard/data','HomeController@get_dashboard_highlight_info');

        //start the others  route . to load other data of products 
        Route::get('api/product/others', 'OthersController@others');    

       //depended route
        Route::get('api/category/wise/subCategory/{id}', 'CategoryController@categoryWiseSubCategory');
        Route::get('api/subCategory/wise/subSubCategory/{id}', 'SubCategoryController@subCategoryWiseSubCategory');
        Route::get('api/attribute/wise/variant/{id}', 'AttributeAndVariantController@attributeWiseVariant');  
        
        //route for search product, edit product and delete product if it pending situation
        Route::get('api/merchant/search/product/{search}','ProductController@search_products');
        Route::get('api/merchant/get/edit/product/{id}','ProductController@get_edit_product');
        Route::post('api/merchant/edit/product/{id}','ProductController@edit_product');
        Route::get('api/merchant/delete/existing/product/image/{id}','ProductController@delete_product_image');
        Route::get('api/merchant/delete/product/{id}','ProductController@delete_product');
        
        //route for merchant order
        Route::get('api/merchant/order','OrderController@get_merchant_order');
        Route::get('api/merchant/order/view/{id}','OrderController@merchant_order_details');
        
        //merchant profile route 
        Route::get('api/get/single/merchant','HomeController@get_current_merchant') ;
        Route::post('api/get/single/merchant/update','HomeController@current_merchant_update') ;
        Route::post('api/get/single/merchant/password/update','LoginController@current_merchant_password_update') ;

});


Route::get('/merchant/backend/{any}', function () {

    return view('merchant.app');

})->where('any', '^(?!api\/)[\/\w\.\,-]*');















?>