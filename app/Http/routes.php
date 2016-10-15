<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.checkrole'], function(){

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', ['as' => 'admin.categories.index', 'uses' => 'CategoriesController@index']);
        Route::get('create', ['as' => 'admin.categories.create', 'uses' =>'CategoriesController@create']);
        Route::get('edit/{id}', ['as' => 'admin.categories.edit', 'uses' =>'CategoriesController@edit']);
        Route::post('store', ['as' => 'admin.categories.store', 'uses' =>'CategoriesController@store']);
        Route::post('update/{id}', ['as' => 'admin.categories.update', 'uses' =>'CategoriesController@update']);
    });

    Route::group(['prefix' => 'clients'], function(){
        Route::get('/', ['as' => 'admin.clients.index', 'uses' => 'ClientsController@index']);
        Route::get('create', ['as' => 'admin.clients.create', 'uses' =>'ClientsController@create']);
        Route::get('edit/{id}', ['as' => 'admin.clients.edit', 'uses' =>'ClientsController@edit']);
        Route::post('store', ['as' => 'admin.clients.store', 'uses' =>'ClientsController@store']);
        Route::post('update/{id}', ['as' => 'admin.clients.update', 'uses' =>'ClientsController@update']);
    });

    Route::group(['prefix' => 'products'], function(){
        Route::get('/', ['as' => 'admin.products.index', 'uses' => 'ProductsController@index']);
        Route::get('create', ['as' => 'admin.products.create', 'uses' =>'ProductsController@create']);
        Route::get('edit/{id}', ['as' => 'admin.products.edit', 'uses' =>'ProductsController@edit']);
        Route::post('store', ['as' => 'admin.products.store', 'uses' =>'ProductsController@store']);
        Route::post('update/{id}', ['as' => 'admin.products.update', 'uses' =>'ProductsController@update']);
    });

    Route::group(['prefix' => 'orders'], function(){

        Route::get('/', ['as' => 'admin.orders.index', 'uses' => 'OrdersController@index']);
        Route::get('/{id}', ['as' => 'admin.orders.edit', 'uses' => 'OrdersController@edit']);
        Route::post('update/{id}', ['as' => 'admin.orders.update', 'uses' => 'OrdersController@update']);

    });

    Route::group(['prefix' => 'cupoms'], function(){
        Route::get('/', ['as' => 'admin.cupoms.index', 'uses' => 'CupomsController@index']);
        Route::get('create', ['as' => 'admin.cupoms.create', 'uses' =>'CupomsController@create']);
        Route::get('edit/{id}', ['as' => 'admin.cupoms.edit', 'uses' =>'CupomsController@edit']);
        Route::post('store', ['as' => 'admin.cupoms.store', 'uses' =>'CupomsController@store']);
        Route::post('update/{id}', ['as' => 'admin.cupoms.update', 'uses' =>'CupomsController@update']);
    });
});

Route::group(['prefix' => 'customer'], function(){

    Route::get('order', ['as' => 'order.index', 'uses' =>'CheckoutController@index']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'CheckoutController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' =>'CheckoutController@store']);

});


Route::auth();

Route::get('/home', ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/teste', ['as' => 'index', 'uses' => 'HomeController@teste']);

//teste oauth2
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix' => 'api', 'middleware' => 'oauth',  'as' => 'api.'], function(){

    Route::group(['prefix' => 'client', 'middleware' => 'oauth.checkrole:client', 'as' => 'client.'],   function(){


        Route::resource('order',
            'Api\Client\ClientCheckoutController', [
                'except' => ['create', 'edit', 'destroy']
        ]);



        /* Route::get('order', function(){

            return ['pegando dados'];

        });

        Route::post ('order', function(){

            return ['criando dados'];

        });

        Route::put('order', function(){

            return ['atualizando dados integralmente'];

        });

        Route::patch('order', function(){

            return ['atualizando dados parcialmente'];

        });

        Route::delete('order', function(){

            return ['excluido dados'];

        });

        Route::get('pedidos', function() {

            return [
                'id' => 1,
                'client' => 'Luiz Carlos - Client',
                'total' => 10

            ];


        });

    });
    */



     /*

    Route::get('pedidos', function(){

        return [

            'id' => 1,
            'client' => 'Luiz Carlos',
            'total' => 10

        ];  */

    });

    Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'],   function(){

        Route::resource('order',
            'Api\Deliveryman\DeliverymanCheckoutController', [
                'except' => ['create', 'edit', 'destroy', 'store']
        ]);

        Route::patch('order/{id}/update-status', ['uses' =>
            'Api\DeliveryMan\DeliverymanCheckoutController@updateStatus'
        ]);





    });



});