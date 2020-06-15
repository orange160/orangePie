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

// ?? 此条路由不起作用，why ??
Route::get('/robots.txt', 'HomeController@getRobots');

// Authenticated routes...
Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'HomeController@index')->name('home');

    // Profile
    Route::get('/profile', 'Auth\ProfileController@getProfile')->name('profile');
    Route::post('/profile', 'Auth\ProfileController@postProfile');
    Route::post('/profile_pwd', 'Auth\ProfileController@changePassword');

    // Group
    Route::group(['prefix' => 'group'], function (){
        Route::get('/', 'GroupController@getGroupForm');
        Route::post('/', 'GroupController@storeGroup');
        Route::get('{slug}', 'GroupController@show');

        Route::get('{groupSlug}/create-project', 'ProjectController@create');
        Route::post('{groupSlug}/create-project', 'ProjectController@store');
    });

    // Project
    Route::group(['prefix' => 'project'], function (){
       Route::get('{slug}', 'ProjectController@show');

       Route::get('{slug}/interface', 'ProjectController@showInterface');
       Route::get('{slug}/activity', 'ProjectController@showActivity');
       Route::get('{slug}/member', 'ProjectController@showMember');
       Route::get('{slug}/settings', 'ProjectController@showSettings');
    });
});


// Login/Logout routes
Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@getRegister')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::fallback('HomeController@getNotFound');