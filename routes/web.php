<?php


Route::get('page-unauthorized', ['as' => 'unauthorized', 'uses' => 'Frontend\Dashboard\HomeController@unauthorized']);

Route::get('page-forbidden', ['as' => 'forbidden', 'uses' => 'Frontend\Dashboard\HomeController@forbidden']);

Route::get('page-notfound', ['as' => 'notfound', 'uses' => 'Frontend\Dashboard\HomeController@notfound']);

Route::get('internal-server-error', ['as' => 'server_error', 'uses' => 'Frontend\Dashboard\HomeController@server_error']);

Route::get('admin', ['as' => 'admin', 'uses' => 'Admin\AdminController@index']);

Route::post('admin-login', ['as'=>'admin_login' ,'uses'=>'Admin\AdminController@Check_login']);

Route::get('logout', ['as' => 'logout', 'uses' => 'Admin\AdminController@logout']);
