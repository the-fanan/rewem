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

Route::group(['prefix' => 'user'], function(){
    Route::get('dashboard', 'UserController@showDashboard')->name('dashboard');
    Route::get('manage-group', 'UserController@showManageGroup')->name('group.manage.show');
    Route::get('manage-group-admin', 'UserController@showManageGroupAdmin')->name('group-admin.manage.show');
});