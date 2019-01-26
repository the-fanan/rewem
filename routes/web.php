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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/login', function() {
    return redirect('/');
})->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//Auth::routes();
/*Route::group(['prefix' => 'test'], function(){
    Route::get('mailer', 'TestController@mailer');
});*/

/**
 * ============ User Related routes =================
 */
Route::group(['prefix' => 'user'], function(){
    
    Route::get('dashboard', 'UserController@showDashboard')->name('dashboard');

    
});
/**
 * ============ Group Related Routes ================
 */
Route::group(['prefix' => 'group'], function(){
    Route::get('manage-group', 'GroupController@showManageGroup')->name('group.manage.show');
    Route::post('create-group', 'GroupController@createGroup')->name('group.create');

    Route::get('manage-group-member', 'GroupController@showManageGroupMember')->name('group-member.manage.show');
    Route::post('create-group-member', 'GroupController@createGroupMember')->name('group-member.create');
    Route::post('search-group-member', 'GroupController@searchGroupMember')->name('group-member.search');
});