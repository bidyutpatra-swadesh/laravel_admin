<?php
Route::group(['as'=>'admin::','prefix'=>'cpanel/admin','middleware' => ['web','AdminMiddleWare','revalidate']], function () {

    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\Dashboard\DashboardController@dashboard']);

    Route::get('changePassForm', ['as' => 'changePassForm', 'uses' => 'Admin\AdminController@changePassForm']);

    Route::post('ChangePass', ['as' => 'ChangePass', 'uses' => 'Admin\AdminController@ChangePass']);

    Route::get('profile/{id}', ['as' => 'profile', 'uses' => 'Admin\AdminController@profile']);

    Route::post('update-profile', ['as' => 'updateProfile', 'uses' => 'Admin\AdminController@updateProfile']);

    /* Users route start*/

    Route::get('manage-user', ['as' => 'manageUser', 'middleware' => ['permission:view-user'], 'uses' => 'Admin\User\UserController@index']);
    Route::get('add-user', ['as' => 'addUser', 'middleware' => ['permission:add-user'], 'uses' => 'Admin\User\UserController@addUser']);
    Route::post('save-user', ['as' => 'saveUser','middleware' => ['permission:add-user'], 'uses' => 'Admin\User\UserController@saveUser']);
    Route::get('/edit-user/{id}', ['as' => 'editUser', 'middleware' => ['permission:view-user'], 'uses' => 'Admin\User\UserController@editUser']);
    Route::post('/update-user', ['as' => 'updateUser', 'middleware' => ['permission:update-user'], 'uses' => 'Admin\User\UserController@updateUser']);
    Route::get('/del-user/{id}', ['as' => 'delUser', 'middleware' => ['permission:delete-user'], 'uses' => 'Admin\User\UserController@delUser']);
    Route::post('active_inactive_user', ['as' => 'active_inactive_user', 'middleware' => ['permission:delete-user'], 'uses' => 'Admin\User\UserController@active_inactive_user']);

    /* Users route end*/

    /* Admin Users route start*/

    Route::get('manage-admin-user', ['as' => 'manageAdminUser', 'middleware' => ['permission:view-admin-user'], 'uses' => 'Admin\User\UserController@admin_index']);
    Route::get('add-admin-user', ['as' => 'addAdminUser', 'middleware' => ['permission:add-admin-user'], 'uses' => 'Admin\User\UserController@addAdminUser']);
    Route::post('save-admin-user', ['as' => 'saveAdminUser','middleware' => ['permission:add-admin-user'], 'uses' => 'Admin\User\UserController@saveAdminUser']);
    Route::get('/edit-admin-user/{id}', ['as' => 'editAdminUser', 'middleware' => ['permission:view-admin-user'], 'uses' => 'Admin\User\UserController@editAdminUser']);
    Route::post('/update-admin-user', ['as' => 'updateAdminUser', 'middleware' => ['permission:update-admin-user'], 'uses' => 'Admin\User\UserController@updateAdminUser']);
    Route::get('/del-admin-user/{id}', ['as' => 'delAdminUser', 'middleware' => ['permission:delete-admin-user'], 'uses' => 'Admin\User\UserController@delAdminUser']);
    Route::post('active_inactive_admin_user', ['as' => 'active_inactive_admin_user', 'middleware' => ['permission:delete-admin-user'], 'uses' => 'Admin\User\UserController@active_inactive_admin_user']);

    /* Admin Users route end*/

    /* Role route start*/

    Route::get('manage-role', ['as' => 'manageRole', 'middleware' => ['permission:view-role'], 'uses' => 'Admin\Role\RoleController@index']);
    Route::get('add-role', ['as' => 'addRole', 'middleware' => ['permission:add-role'], 'uses' => 'Admin\Role\RoleController@addRole']);
    Route::post('save-role', ['as' => 'saveRole','middleware' => ['permission:add-role'], 'uses' => 'Admin\Role\RoleController@saveRole']);
    Route::get('/edit-role/{id}', ['as' => 'editRole', 'middleware' => ['permission:view-role'], 'uses' => 'Admin\Role\RoleController@editRole']);
    Route::post('/update-role', ['as' => 'updateRole', 'middleware' => ['permission:update-role'], 'uses' => 'Admin\Role\RoleController@updateRole']);
    Route::get('/del-role/{id}', ['as' => 'delRole', 'middleware' => ['permission:delete-role'], 'uses' => 'Admin\Role\RoleController@delRole']);

 /* Role route end*/
});